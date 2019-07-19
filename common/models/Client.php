<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 19.07.2019
 * Time: 15:14
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property string $clientSiteId
 * @property int $client1cId
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $companyName
 * @property string $communicateChannel
 * @property string $createdAt
 *
 * @property Order[] $orders
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clientSiteId', 'client1cId', 'name', 'phone'], 'required'],
            [['client1cId'], 'integer'],
            [['createdAt'], 'safe'],
            [['clientSiteId', 'name', 'email', 'phone', 'companyName', 'communicateChannel'], 'string', 'max' => 50],
            [['clientSiteId', 'client1cId'], 'unique', 'targetAttribute' => ['clientSiteId', 'client1cId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clientSiteId' => 'Client Site ID',
            'client1cId' => 'Client1c ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'companyName' => 'Company Name',
            'communicateChannel' => 'Communicate Channel',
            'createdAt' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['clientSiteId' => 'clientSiteId', 'client1cId' => 'client1cId']);
    }
}
