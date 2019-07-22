<?php

use common\models\Order;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'clientSiteId',
            'client1cId',
            'clientName',
            'clientEmail:email',
            'clientPhone',
            'clientCompany',
            'clientCommunicateChannel',
            'status',
            'orderedAt',
            'paymentMethod',
            'price',
            [
                'label' => 'extraData',
                'format' => 'raw',
                'value' => function (Order $order) {
                    return '<code>' . $order->extraData . '</code>';
                }
            ],
        ],
    ]) ?>

</div>
