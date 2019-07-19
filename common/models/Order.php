<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 19.07.2019
 * Time: 15:15
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $clientSiteId
 * @property int $client1cId
 * @property string $status
 * @property string $orderedAt
 * @property string $paymentMethod
 * @property string $price
 * @property string $extraData
 *
 * @property Client $clientSite
 * @property OrderDocument[] $orderDocuments
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clientSiteId', 'client1cId', 'status', 'orderedAt', 'paymentMethod', 'price'], 'required'],
            [['client1cId'], 'integer'],
            [['orderedAt'], 'safe'],
            [['price'], 'number'],
            [['extraData'], 'string'],
            [['clientSiteId', 'status', 'paymentMethod'], 'string', 'max' => 50],
            [['clientSiteId', 'client1cId'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['clientSiteId' => 'clientSiteId', 'client1cId' => 'client1cId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clientSiteId' => 'Client Site ID',
            'client1cId' => 'Client1c ID',
            'status' => 'Status',
            'orderedAt' => 'Ordered At',
            'paymentMethod' => 'Payment Method',
            'price' => 'Price',
            'extraData' => 'Extra Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientSite()
    {
        return $this->hasOne(Client::class, ['clientSiteId' => 'clientSiteId', 'client1cId' => 'client1cId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDocuments()
    {
        return $this->hasMany(OrderDocument::class, ['orderId' => 'id']);
    }
}