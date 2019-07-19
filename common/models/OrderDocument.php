<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 19.07.2019
 * Time: 15:16
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_document".
 *
 * @property int $id
 * @property int $orderId
 * @property string $name
 * @property string $type
 * @property string $statusForOrder
 * @property string $statusForAct
 * @property string $file
 *
 * @property Order $order
 */
class OrderDocument extends \yii\db\ActiveRecord
{
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
            [['orderId', 'name', 'type', 'statusForOrder', 'statusForAct', 'file'], 'required'],
            [['orderId'], 'integer'],
            [['name', 'type', 'statusForOrder', 'statusForAct'], 'string', 'max' => 50],
            [['file'], 'string', 'max' => 255],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['orderId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderId' => 'Order ID',
            'name' => 'Name',
            'type' => 'Type',
            'statusForOrder' => 'Status For Order',
            'statusForAct' => 'Status For Act',
            'file' => 'File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'orderId']);
    }
}
