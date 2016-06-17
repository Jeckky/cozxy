<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'image',
                        'format' => 'html',
                        'value' => function($model) {
                            return isset($model->productImages[0]) ? yii\bootstrap\Html::img(Yii::$app->homeUrl . $model->productImages[0]->image, ['style' => 'width:150px']) : NULL;
                        }
                    ],
                    [
                        'attribute' => 'brandId',
                        'value' => function($model) {
                            return isset($model->brand) ? $model->brand->title : NULL;
                        }
                    ],
                    [
                        'attribute' => 'categoryId',
                        'value' => function($model) {
                            return isset($model->category) ? $model->category->title : NULL;
                        }
                    ],
//                    'userId',
                    [
                        'attribute' => 'productGroupId',
                        'value' => function($model) {
                            return isset($model->productGroup) ? $model->productGroup->title : NULL;
                        }
                    ],
                    [
                        'attribute' => 'categoryId',
                        'value' => function($model) {
                            return isset($model->category) ? $model->category->title : NULL;
                        }
                    ],
                    'code',
                    'title',
                    // 'optionName',
                    // 'description:ntext',
                    // 'width',
                    // 'height',
                    // 'depth',
                    // 'weight',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete} {image} {price} {promotion}',
                        'buttons' => [
                            'image' => function($url, $model) {
                                return Html::a('<br><u>Image</u>', ['/store/product-image', 'productId' => $model->productId], [
                                    'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },
                            'price' => function($url, $model) {
                                return Html::a('<br><u>Price</u>', ['/store/product-price', 'productId' => $model->productId], [
                                    'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },
                            'promotion' => function($url, $model) {
                                return Html::a('<br><u>Promotion</u>', ['/store/product-promotion', 'productId' => $model->productId], [
                                    'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
