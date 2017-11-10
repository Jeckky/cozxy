<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\productmanager\models\search\Product */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //            'productId',
            //            'userId',
            //            'parentId',
            [
                'attribute' => 'title',
                'value' => function ($model) {
                    return mb_substr($model->title, 0, 40);
                },
            ],
            [
                'attribute' => 'brandId',
                'value' => function ($model) {
                    return isset($model->brand) ? $model->brand->title : '';
                },
                'filter' => $brandFilter
            ],
            [
                'attribute' => 'categoryId',
                'value' => function ($model) {
                    return isset($model->category) ? $model->category->title : '';
                },
                'filter' => $categoryFilter
            ],
            'isbn:ntext',
            'code',
            // 'suppCode',
            // 'merchantCode',
            // 'optionName',
            // 'shortDescription:ntext',
            // 'description:ntext',
            // 'specification:ntext',
            // 'width',
            // 'height',
            // 'depth',
            // 'weight',
            // 'price',
            // 'unit',
            // 'smallUnit',
            // 'tags',
//            'status',
//            'approve',
            'createDateTime',
//            'updateDateTime',
            // 'productSuppId',
            // 'approveCreateBy',
            // 'approvecreateDateTime',
            // 'receiveType',
            // 'productGroupTemplateId',
            // 'step',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
