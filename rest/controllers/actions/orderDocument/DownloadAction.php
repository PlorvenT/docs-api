<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 16:41
 */
declare(strict_types=1);

namespace rest\controllers\actions\orderDocument;

use rest\models\view\OrderDocument;
use yii\base\Action;
use yii\web\NotFoundHttpException;

/**
 * Class DownloadAction
 * @package rest\controllers\actions\orderDocument
 */
class DownloadAction extends Action
{
    /**
     * @param $hash
     * @throws NotFoundHttpException
     */
    public function run($hash)
    {
        $document = OrderDocument::findOne(['fileHash' => $hash]);

        if (!$document) {
            throw new NotFoundHttpException('Document not found.');
        }

        \Yii::$app->response->sendFile($document->getFilePath(), $document->fileName);
    }
}