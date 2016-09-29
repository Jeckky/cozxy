<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Item Packings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-item-packing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order Item Packing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'orderItemPackingId',
            'orderItemId',
            'bagNo',
            'quantity',
            'status',
            // 'createDateTime',
            // 'updateDateTime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
