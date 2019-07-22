<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 12:28
 */
declare(strict_types=1);

namespace rest\controllers\actions\order;

use common\models\Order;
use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;

/**
 * Class DeleteAction
 * @package rest\controllers\actions\order
 */
class DeleteAction extends Action
{
    /**
     * @param $id
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function run($id)
    {
        $order = Order::findOne($id);

        if (!$order) {
            throw new NotFoundHttpException('Order not found.');
        }

        $order->delete();
        Yii::$app->response->setStatusCode(204);
    }
}
