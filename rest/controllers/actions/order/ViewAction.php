<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 12:37
 */
declare(strict_types=1);

namespace rest\controllers\actions\order;

use common\models\Order;
use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;

/**
 * Class ViewAction
 * @package rest\controllers\actions\order
 */
class ViewAction extends Action
{
    /**
     * @param $id
     * @return Order|null
     * @throws NotFoundHttpException
     */
    public function run($id)
    {
        $order = Order::findOne($id);

        if (!$order) {
            throw new NotFoundHttpException("Order not found.");
        }

        return $order;
    }
}
