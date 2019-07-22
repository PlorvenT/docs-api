<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 19.07.2019
 * Time: 16:56
 */

namespace rest\controllers\actions\client;

use rest\models\search\ClientForm;
use Yii;
use yii\base\Action;
use yii\data\ActiveDataProvider;

/**
 * Class IndexAction
 * @package rest\controllers\actions\client
 */
class IndexAction extends Action
{
    /**
     * @return array|ActiveDataProvider
     */
    public function run()
    {
        $searchForm = new ClientForm();
        $searchForm->setAttributes(\Yii::$app->request->get());

        if (!$searchForm->validate()) {
            Yii::$app->response->setStatusCode(422);
            return $searchForm->errors;
        }

        return $searchForm->getDataProvider();

    }
}
