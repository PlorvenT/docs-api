<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 19.07.2019
 * Time: 16:56
 */

namespace rest\controllers\actions\client;

use common\models\Client;
use yii\base\Action;
use yii\data\ActiveDataProvider;

/**
 * Class IndexAction
 * @package rest\controllers\actions\client
 */
class IndexAction extends Action
{
    /**
     * @return ActiveDataProvider
     */
    public function run()
    {
        $clientQuery = Client::find();

        $dataProvider = new ActiveDataProvider();
        $dataProvider->query = $clientQuery;

        return $dataProvider;
    }
}
