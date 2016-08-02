<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Update Prices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="update-price-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Update Price', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'updatePriceId',
            'productPriceOtherWebId',
            'price',
            'status',
            'createDateTime',
            // 'updateDateTime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
