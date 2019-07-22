<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 16:35
 */
declare(strict_types=1);

namespace rest\controllers\actions\orderDocument;

use rest\models\view\OrderDocument;
use yii\base\Action;
use yii\data\ActiveDataProvider;

/**
 * Class IndexAction
 * @package rest\controllers\actions\orderDocument
 */
class IndexAction extends Action
{
    public function run($orderId)
    {
        $documentQuery = OrderDocument::find()->where(['orderId' => $orderId]);

        $dataProvider = new ActiveDataProvider();
        $dataProvider->query = $documentQuery;

        return $dataProvider;
    }
}
