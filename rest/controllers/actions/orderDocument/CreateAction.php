<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 15:21
 */
declare(strict_types=1);

namespace rest\controllers\actions\orderDocument;

use rest\models\view\OrderDocument;
use yii\base\Action;
use Yii;
use yii\web\UploadedFile;

/**
 * Class CreateAction
 * @package rest\controllers\actions\orderDocument
 */
class CreateAction extends Action
{
    public function run()
    {
        $document = new OrderDocument();

        $document->setAttributes(\Yii::$app->request->post());
        $document->file = UploadedFile::getInstanceByName( 'file');
        if (!$document->upload() || !$document->save()) {
            Yii::$app->response->setStatusCode(422);
            return $document->errors;
        }

        Yii::$app->response->setStatusCode(201);
        return $document;
    }
}