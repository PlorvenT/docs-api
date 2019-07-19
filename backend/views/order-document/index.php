<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrderDocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-document-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'orderId',
            'name',
            'type',
            'statusForOrder',
            'statusForAct',
            //'file',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>

</div>
