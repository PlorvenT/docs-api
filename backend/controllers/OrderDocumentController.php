<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 19.07.2019
 * Time: 16:00
 */

namespace backend\controllers;

use Yii;
use common\models\OrderDocument;
use common\models\search\OrderDocumentSearch;
use backend\components\BaseController;
use yii\web\NotFoundHttpException;

/**
 * OrderDocumentController implements the CRUD actions for OrderDocument model.
 */
class OrderDocumentController extends BaseController
{
    /**
     * Lists all OrderDocument models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderDocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderDocument model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the OrderDocument model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderDocument the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderDocument::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
