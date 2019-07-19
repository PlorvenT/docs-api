<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 19.07.2019
 * Time: 15:24
 */

namespace backend\controllers;

use backend\components\BaseController;
use Yii;
use common\models\search\ClientSearch;
use common\models\Client;
use yii\web\NotFoundHttpException;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends BaseController
{
    /**
     * Lists all Client models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Client model.
     * @param string $clientSiteId
     * @param integer $client1cId
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($clientSiteId, $client1cId)
    {
        return $this->render('view', [
            'model' => $this->findModel($clientSiteId, $client1cId),
        ]);
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $clientSiteId
     * @param integer $client1cId
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($clientSiteId, $client1cId)
    {
        if (($model = Client::findOne(['clientSiteId' => $clientSiteId, 'client1cId' => $client1cId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
