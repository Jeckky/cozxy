<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductSuppliers */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-suppliers-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">With buttons</span>
            <div class="panel-heading-controls">
                <?= Html::a('Update', ['update', 'id' => $model->productId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
                <?=
                Html::a('Delete', ['delete', 'id' => $model->productId], [
                    'class' => 'btn btn-xs btn-outline btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </div> <!-- / .panel-heading-controls -->
        </div> <!-- / .panel-heading -->
        <div class="panel-body">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'productSuppId',
                    //'userId',
                    [
                        'attribute' => 'user',
                        'value' => common\models\costfit\ProductSuppliers::getUser($model->userId)
                    ],
                    'productGroupId',
                    //'brandId',
                    //'categoryId',
                    [
                        'attribute' => 'brand',
                        'value' => isset($model->brand) ? $model->brand->title : NULL
                    ],
                    [
                        'attribute' => 'category',
                        'value' => isset($model->category) ? $model->category->title : NULL
                    ],
                    'isbn:ntext',
                    'code',
                    'title',
                    'optionName',
                    'shortDescription:html',
                    'description:html',
                    'specification:html',
                    'width',
                    'height',
                    'depth',
                    'weight',
                    'quantity',
                    'unit',
                    'smallUnit',
                    'tags',
                    //'status',
                    //'createDateTime',
                    //'updateDateTime',
                    [
                        'attribute' => 'createDateTime',
                        'format' => 'raw',
                        'value' => $this->context->dateThai($model->createDateTime, 1, TRUE)
                    ],
                    [
                        'attribute' => 'updateDateTime',
                        'format' => 'raw',
                        'value' => $this->context->dateThai($model->updateDateTime, 1, TRUE)
                    ],
                ],
            ])
            ?>
        </div>

        <div class="panel-body">
            <?=
            GridView::widget([
                // 'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProviderImages,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'productImageId',
                    //'productSuppId',
                    [
                        'attribute' => 'image(Size 553px x 484px)',
                        'format' => 'html',
                        'value' => function($model) {
                            if (isset($model->image)) {
                                if (file_exists($_SERVER['DOCUMENT_ROOT'] . Yii::getAlias('@web') . '/' . $model->image)) {
                                    $imgBrand = Html::img(Yii::getAlias('@web') . '/' . $model->image, ['style' => 'width:60px;height:60px', 'class' => 'img-responsive']);
                                } else {
                                    $imgBrand = Html::img(Yii::getAlias('@web') . '/images/ContentGroup/DUHWYsdXVc.png', ['style' => 'width:60px;height:60px', 'class' => 'img-responsive']);
                                }
                            } else {
                                $imgBrand = Html::img(Yii::getAlias('@web') . '/images/ContentGroup/DUHWYsdXVc.png', ['style' => 'width:60px;height:60px', 'class' => 'img-responsive']);
                            }
                            return $imgBrand;
                        }
                    ],
                    //'description:ntext',
                    // 'image',
                    //'imageThumbnail1',
                    [
                        'attribute' => 'imageThumbnail1(Size 356px x 390px)',
                        'format' => 'html',
                        'value' => function($model) {

                            if (isset($model->image)) {
                                if (file_exists($_SERVER['DOCUMENT_ROOT'] . Yii::getAlias('@web') . '/' . $model->image)) {
                                    $imgBrand = Html::img(Yii::getAlias('@web') . '/' . $model->imageThumbnail1, ['style' => 'width:60px;height:60px', 'class' => 'img-responsive']);
                                } else {
                                    $imgBrand = Html::img(Yii::getAlias('@web') . '/images/ContentGroup/DUHWYsdXVc.png', ['style' => 'width:60px;height:60px', 'class' => 'img-responsive']);
                                }
                            } else {
                                $imgBrand = Html::img(Yii::getAlias('@web') . '/images/ContentGroup/DUHWYsdXVc.png', ['style' => 'width:60px;height:60px', 'class' => 'img-responsive']);
                            }
                            return $imgBrand;
                        }
                    ],
                    //'imageThumbnail2',
                    [
                        'attribute' => 'imageThumbnail2(Size 137px x 130px)',
                        'format' => 'html',
                        'value' => function($model) {
                            //echo '@web' . Yii::getAlias('@web');
                            if (isset($model->image)) {
                                if (file_exists($_SERVER['DOCUMENT_ROOT'] . Yii::getAlias('@web') . '/' . $model->image)) {
                                    $imgBrand = Html::img(Yii::getAlias('@web') . '/' . $model->imageThumbnail1, ['style' => 'width:60px;height:60px', 'class' => 'img-responsive']);
                                } else {
                                    $imgBrand = Html::img(Yii::getAlias('@web') . '/images/ContentGroup/DUHWYsdXVc.png', ['style' => 'width:60px;height:60px', 'class' => 'img-responsive']);
                                }
                            } else {
                                $imgBrand = Html::img(Yii::getAlias('@web') . '/images/ContentGroup/DUHWYsdXVc.png', ['style' => 'width:60px;height:60px', 'class' => 'img-responsive']);
                            }
                            return $imgBrand;
                        }
                    ],
                    // 'status',
                    // 'createDateTime',
                    [
                        'attribute' => 'createDateTime',
                        'format' => 'raw',
                        'value' => function($model) {
                            return is_null($model->createDateTime) ? '' : $this->context->dateThai($model->createDateTime, 1, TRUE);
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => ' ',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye"></i>', Yii::$app->homeUrl . 'suppliers/product-image-suppliers/view?id=' . $model->productImageId . '&productSuppId=' . $model->productSuppId, [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>

</div>
