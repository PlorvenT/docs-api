<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 11:46
 */
declare(strict_types=1);

namespace rest\models;

use common\models\Client;
use common\models\Order;
use yii\base\Model;
use yii\web\UnprocessableEntityHttpException;

/**
 * Class OrderForm
 * @package rest\models
 */
class OrderForm extends Model
{
    /**
     * @var int
     */
    public $clientSiteId;

    /**
     * @var string
     */
    public $client1cId;

    /**
     * @var string
     */
    public $clientName;

    /**
     * @var string
     */
    public $clientEmail;

    /**
     * @var string
     */
    public $clientPhone;

    /**
     * @var string
     */
    public $clientCompany;

    /**
     * @var string
     */
    public $clientCommunicateChannel;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $orderedAt;

    /**
     * @var string
     */
    public $paymentMethod;

    /**
     * @var string
     */
    public $price;

    /**
     * @var string
     */
    public $extraData;

    /**
     * @var Order
     */
    private $order;

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->order = new Order();
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['clientSiteId', 'client1cId', 'clientName', 'clientPhone', 'status', 'orderedAt', 'paymentMethod', 'price'], 'required'],
            [['client1cId'], 'integer'],
            ['orderedAt', 'datetime', 'format' => 'php:Y-m-d H:i:s', 'message' => 'Дожно быть в формате Y-m-d H:i:s'],
            [['price'], 'number'],
            [['extraData'], 'string'],
            [
                ['clientSiteId', 'clientName', 'clientEmail', 'clientPhone', 'clientCompany', 'clientCommunicateChannel', 'status', 'paymentMethod'],
                'string',
                'max' => 50,
            ],
        ];
    }

    /**
     * @return bool
     * @throws UnprocessableEntityHttpException
     */
    public function create(): bool
    {
        if (!$this->validate()) {
            return false;
        }
        $this->processClient();

        return $this->createOrder();
    }

    /**
     * @return Order|null
     */
    public function getOrder(): ?Order
    {
        return $this->order;
    }

    /**
     * @return bool
     * @throws UnprocessableEntityHttpException
     */
    private function createOrder(): bool
    {
        foreach ($this->getAttributes() as $attribute => $value) {
            $this->order->$attribute = $value;
        }

        if (!$this->order->save()) {
            \Yii::error($this->order->errors, 'app');
            throw new UnprocessableEntityHttpException('Order didn\'t saved');
        }

        return true;
    }

    /**
     * @throws UnprocessableEntityHttpException
     */
    private function processClient(): void
    {
        $client = Client::findOne(['clientSiteId' => $this->clientSiteId, 'client1cId' => $this->client1cId]);

        if (!$client) {
            $client = new Client();
        }

        $client->clientSiteId = $this->clientSiteId;
        $client->client1cId = $this->client1cId;
        $client->name = $this->clientName;
        $client->email = $this->clientEmail;
        $client->phone = $this->clientPhone;
        $client->communicateChannel = $this->clientCommunicateChannel;
        $client->companyName = $this->clientCompany;

        if (!$client->save()) {
            \Yii::error($client->errors, 'app');
            throw new UnprocessableEntityHttpException('Client didn\'t saved');
        }
    }
}