<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 17:23
 */
declare(strict_types=1);

namespace rest\controllers\actions\orderDocument;

use rest\models\view\OrderDocument;
use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * Class UpdateAction
 * @package rest\controllers\actions\orderDocument
 */
class UpdateAction extends Action
{
    public function run($id)
    {
        $document = OrderDocument::findOne($id);

        if (!$document) {
            throw new NotFoundHttpException('Document not found.');
        }

        $document->setAttributes(\Yii::$app->request->post());
        $document->file = UploadedFile::getInstanceByName( 'file');
        if (!$document->upload() || !$document->save()) {
            Yii::$app->response->setStatusCode(422);
            return $document->errors;
        }

        Yii::$app->response->setStatusCode(200);
        return $document;
    }
}
