<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 16:29
 */
declare(strict_types=1);

namespace rest\controllers\actions\orderDocument;

use rest\models\view\OrderDocument;
use yii\base\Action;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * Class DeleteAction
 * @package rest\controllers\actions\orderDocument
 */
class DeleteAction extends Action
{
    public function run($id)
    {
        $order = OrderDocument::findOne($id);

        if (!$order) {
            throw new NotFoundHttpException('Document not found.');
        }

        $order->delete();
        Yii::$app->response->setStatusCode(204);
    }
}
