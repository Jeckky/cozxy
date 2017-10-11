<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\productmanager\models\search\ProductSuppliers */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-suppliers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Suppliers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'productSuppId',
            'userId',
            'brandId',
            'categoryId',
            'isbn:ntext',
            // 'code',
            // 'suppCode',
            // 'merchantCode',
            // 'title',
            // 'optionName',
            // 'shortDescription:ntext',
            // 'description:ntext',
            // 'specification:ntext',
            // 'width',
            // 'height',
            // 'depth',
            // 'weight',
            // 'unit',
            // 'smallUnit',
            // 'tags',
            // 'status',
            // 'createDateTime',
            // 'updateDateTime',
            // 'quantity',
            // 'result',
            // 'approve',
            // 'productId',
            // 'approveCreateBy',
            // 'approvecreateDateTime',
            // 'receiveType',
            // 'url:url',
            // 'warrantyType',
            // 'warrantyPeriod',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
