<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 14:18
 */
declare(strict_types=1);

namespace rest\controllers\actions\order;

use rest\models\view\Order;
use rest\models\OrderForm;
use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;

/**
 * Class UpdateAction
 * @package rest\controllers\actions\order
 */
class UpdateAction extends Action
{
    public function run($id)
    {
        $order = Order::findOne($id);

        if (!$order) {
            throw new NotFoundHttpException("Order not found.");
        }

        $request = \Yii::$app->request->post();
        $model = new OrderForm($order);
        $model->setAttributes($request);

        if (!$model->create()) {
            Yii::$app->response->setStatusCode(422);
            return $model->errors;
        }

        Yii::$app->response->setStatusCode(200);
        return $model->getOrder();
    }
}