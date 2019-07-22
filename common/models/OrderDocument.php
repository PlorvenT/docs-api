<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 19.07.2019
 * Time: 15:16
 */

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "order_document".
 *
 * @property int $id
 * @property int $orderId
 * @property string $name
 * @property string $type
 * @property string $statusForOrder
 * @property string $statusForAct
 * @property string $fileName
 * @property string $fileHash
 *
 * @property Order $order
 */
class OrderDocument extends \yii\db\ActiveRecord
{
    //types
    public const TYPE_CONTRACT = 'договор';
    public const TYPE_ACCOUNT = 'счёт';
    public const TYPE_INVOICE = 'накладная';

    //statuses for order
    public const STATUS_FOR_ORDER_AGREEMENT = 'Согласование';
    public const STATUS_FOR_ORDER_EXCHANGE_OF_ORIGINALS = 'Обмен оригиналами';
    public const STATUS_FOR_ORDER_ORIGINAL_RECEIVED = 'Оригинал получен сторонами';

    //statuses for act
    public const STATUS_FOR_ACT_WAIT_FOR_SHIPMENT = 'Ждём отгрузки';
    public const STATUS_FOR_ACT_WAIT_ORIGINAL = 'Ждём оригинал';
    public const STATUS_FOR_ACT_RECEIVED_ORIGINAL = 'Оригинал получен';

    /**
     * @var array
     */
    public static $types = [
        self::TYPE_ACCOUNT,
        self::TYPE_CONTRACT,
        self::TYPE_INVOICE,
    ];

    /**
     * @var array
     */
    public static $statusesForOrder = [
        self::STATUS_FOR_ORDER_AGREEMENT,
        self::STATUS_FOR_ORDER_EXCHANGE_OF_ORIGINALS,
        self::STATUS_FOR_ORDER_ORIGINAL_RECEIVED,
    ];

    /**
     * @var array
     */
    public static $statusesForAct = [
        self::STATUS_FOR_ACT_WAIT_FOR_SHIPMENT,
        self::STATUS_FOR_ACT_WAIT_ORIGINAL,
        self::STATUS_FOR_ACT_RECEIVED_ORIGINAL,
    ];

    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orderId', 'name', 'type', 'statusForOrder', 'statusForAct'], 'required'],
            ['file', 'file'],
            ['file', 'required'],
            [['orderId'], 'integer'],
            [['name', 'type', 'statusForOrder', 'statusForAct'], 'string', 'max' => 50],
            [['fileName', 'fileHash'], 'string', 'max' => 255],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['orderId' => 'id']],
            [
                'type',
                'in',
                'range' => self::$types,
                'message' => "Допустимые значения: '" . implode("', '", self::$types) . "'.",
            ],
            [
                'statusForOrder',
                'in',
                'range' => self::$statusesForOrder,
                'message' => "Допустимые значения: '" . implode("', '", self::$statusesForOrder) . "'.",
            ],
            [
                'statusForAct',
                'in',
                'range' => self::$statusesForAct,
                'message' => "Допустимые значения: '" . implode("', '", self::$statusesForAct) . "'.",
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderId' => 'ID заказа',
            'name' => 'Название документа',
            'type' => 'Тип документа',
            'statusForOrder' => 'Статус для договора',
            'statusForAct' => 'Статус для акта',
            'fileName' => 'Файл документа',
            'fileHash' => 'File Hash(md5)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'orderId']);
    }

    /**
     * This method returns full file path for $filename.
     * If $filename not set then return filename for $this->fileHash
     *
     * @param string|null $filename
     * @return string
     */
    public function getFilePath(?string $filename = null): string
    {
        if (!$filename) {
            $filename = $this->fileHash;
        }
        return Yii::getAlias('@rest') . '/web/files/' . $filename;
    }

    /**
     * @return bool
     */
    public function upload(): bool
    {
        if ($this->validate()) {
            $this->fileName = $this->file->name;
            $newName = md5(time() . $this->file->tempName);
            $path = $this->getFilePath($newName);

            if ($this->file->saveAs($path)) {
                $this->deleteOldFile();
                $this->fileHash = $newName;
                return true;
            }

            return false;
        } else {
            return false;
        }
    }

    /**
     * This method deletes old file of exist
     */
    private function deleteOldFile(): void
    {
        $oldFile = $this->getOldAttribute('fileHash');
        if ($oldFile) {
            $filePath = $this->getFilePath($oldFile);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        $fileName = $this->getFilePath($this->fileHash);

        if (file_exists($fileName)) {
            unlink($fileName);
        }
        return parent::beforeDelete();
    }
}
