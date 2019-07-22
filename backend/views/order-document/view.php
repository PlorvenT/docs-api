<?php

use common\models\OrderDocument;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OrderDocument */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Order Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="order-document-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'orderId',
            'name',
            'type',
            'statusForOrder',
            'statusForAct',
            'fileName',
            [
                'label' => 'fileHash',
                'format' => 'raw',
                'value' => function (OrderDocument $document) {
                    return Html::a($document->fileHash, '/files/' . $document->fileHash, ['target' => '_blank']);
                }
            ],
        ],
    ]) ?>

</div>
