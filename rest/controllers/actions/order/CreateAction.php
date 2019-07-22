<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 11:17
 */
declare(strict_types=1);

namespace rest\controllers\actions\order;

use rest\models\OrderForm;
use Yii;
use yii\base\Action;

/**
 * Class CreateAction
 * @package rest\controllers\actions\document
 */
class CreateAction extends Action
{
    public function run()
    {
        $request = \Yii::$app->request->post();
        $model = new OrderForm();
        $model->setAttributes($request);

        if (!$model->create()) {
            Yii::$app->response->setStatusCode(422);
            return $model->errors;
        }

        Yii::$app->response->setStatusCode(201);
        return $model->getOrder();
    }
}
