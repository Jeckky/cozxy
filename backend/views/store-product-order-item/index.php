<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\costfit\search\StoreProductOrderItem */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Product Order Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-product-order-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Store Product Order Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'storeProductOrderItemId',
            'orderId',
            'productId',
            'storeProductId',
            'quantity',
            // 'price',
            // 'total',
            // 'status',
            // 'createDateTime',
            // 'updateDateTime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
