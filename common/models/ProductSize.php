<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 04.09.2019
 * Time: 8:55
 */
declare(strict_types=1);

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_size".
 *
 * @property int $id
 * @property int $product_id
 * @property string $guid
 * @property string $price
 * @property string $marking_content
 * @property array $images
 *
 * @property Product $product
 */
class ProductSize extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_size';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'guid', 'price', 'marking_content'], 'required'],
            [['product_id'], 'integer'],
            [['price'], 'number'],
            [['marking_content'], 'string'],
            [['images'], 'safe'],
            [['guid'], 'string', 'max' => 50],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'guid' => 'Guid',
            'price' => 'Price',
            'marking_content' => 'Marking Content',
            'images' => 'Images',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
