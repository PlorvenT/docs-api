<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 14:52
 */
declare(strict_types=1);

namespace rest\models\view;

use common\models\Order as CommonOrder;

/**
 * Class Order
 * @package rest\models\view
 */
class Order extends CommonOrder
{
    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id',
            'clientSiteId',
            'client1cId',
            'clientName',
            'clientEmail',
            'clientPhone',
            'clientCompany',
            'clientCommunicateChannel',
            'status',
            'orderedAt',
            'paymentMethod',
            'price',
            'extraData' => function (Order $order) {
                if ($order->extraData) {
                    return json_decode($order->extraData);
                }
                return $this->extraData;
            },
        ];
    }
}