<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Price Other Webs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-price-other-web-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Price Other Web', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'productPriceOtherWebId',
            'productId',
            'webId',
            'url:url',
            'parameter',
            // 'status',
            // 'createDateTime',
            // 'updateDateTime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
