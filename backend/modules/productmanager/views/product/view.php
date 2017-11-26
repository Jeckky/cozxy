<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$productId = $model->productId;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($model->parentId !== NULL): ?>
            <?= Html::a('Go Back', ['view', 'id' => $model->parentId], ['class' => 'btn']) ?>
        <?php else: ?>
            <?= Html::a('Go Back', ['index', 'id' => $model->parentId], ['class' => 'btn']) ?>
        <?php endif; ?>
        <?= Html::a('Update', ['update', 'id' => $model->productId], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->productId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'brandId',
            'categoryId',
            'isbn:ntext',
            'code',
            'title',
            'status',
            'approve',
            'shortDescription:html',
            'description:html',
            'specification:html',
        //            'createDateTime',
        //            'updateDateTime',
        //            'approve',
        //            'approveCreateBy',
        //            'receiveType',
        //            'productGroupTemplateId',
        //            'productId',
        //            'userId',
        //            'parentId',
        //            'suppCode',
        //            'merchantCode',
        //            'optionName',
        //            'width',
        //            'height',
        //            'depth',
        //            'weight',
        //            'price',
        //            'unit',
        //            'smallUnit',
        //            'tags',
        //            'productSuppId',
        //            'approvecreateDateTime',
        //            'step',
        ],
    ])
    ?>

    <hr>

    <?php if ($model->parentId === NULL): ?>
        <?php if (!$model->hasProductSuppliers()): ?>
            <?php
            if ($checkAuth == 'Partner') {
                ?>
                <p>
                    <?= Html::a('Create Product Suppliers', Url::to(['create-product-suppliers', 'id' => $model->productId]), ['class' => 'btn btn-warning btn-block btn-lg']) ?>
                </p>
            <?php } ?>
        <?php endif; ?>
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#products" aria-controls="home" role="tab" data-toggle="tab">Products</a></li>
                <?php
                if ($checkAuth == 'Partner') {
                    ?>
                    <li role="presentation">
                        <a href="#productSuppliers" aria-controls="profile" role="tab" data-toggle="tab">ProductSuppliers</a>
                    </li>
                <?php } ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="products">
                    <?php Pjax::begin(); ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        //                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'header' => 'Image',
                                'value' => function($model) {
                                    return Yii::$app->homeUrl . $model->images->imageThumbnail1;
                                },
                                'format' => 'image'
                            ],
                            [
                                'attribute' => 'title',
                                'value' => function ($model) {
                                    return mb_substr($model->title, 0, 40);
                                },
                            ],
                            'isbn:ntext',
                            'price',
                            //                'code',
                            //                'status',
                            //                'approve',
                            // 'createDateTime',
                            // 'updateDateTime',
                            // 'productSuppId',
                            // 'approveCreateBy',
                            // 'approvecreateDateTime',
                            // 'receiveType',
                            //             'productGroupTemplateId',
                            [
                                'header' => 'Options',
                                'value' => function ($model) {
                                    return implode(', ', $model->productOptions());
                                },
                            ],
                            // 'step',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {update} {image} {delete}',
                                'buttons' => [
                                    'image' => function ($url, $model, $index) {
                                        return Html::a('<i class="fa fa-picture-o"></i>', Url::to(['create-product-images', 'id' => $model->productId]));
                                    }
                                ]
                            ],
                        ],
                    ]);
                    ?>
                    <?php Pjax::end(); ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="productSuppliers">
                    <?=
                    GridView::widget([
                        'dataProvider' => $productSupplierDataProvider,
                        //                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'header' => 'Image',
                                'value' => function($model) {
                                    return Yii::$app->homeUrl . $model->product->images->imageThumbnail1;
                                },
                                'format' => 'image'
                            ],
                            [
                                'attribute' => 'title',
                                'value' => function ($model) {
                                    return mb_substr($model->title, 0, 40);
                                },
                            ],
                            'isbn:ntext',
                            [
                                'attribute' => 'price',
                                'value' => function ($model) {
                                    return $model->productPriceSuppliers->price;
                                }
                            ],
                            'quantity',
                            'result',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => ($checkAuth == 'Partner') ? '{stock} {price} {delete}' : '',
                                'buttons' => [
                                    'stock' => function ($url, $model, $index) {
                                        return Html::a('Stock', Url::to(Url::home() . 'productmanager/product-suppliers/stock?id=' . $model->productSuppId), ['class' => 'btn btn-info btn-xs']);
                                    },
                                    'price' => function ($url, $model, $index) {
                                        return Html::a('Price', Url::to(Url::home() . 'productmanager/product-suppliers/price?id=' . $model->productSuppId), ['class' => 'btn btn-warning btn-xs']);
                                    },
                                ]
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>

        </div>

    <?php endif; ?>

    <?php if ($model->parentId !== NULL): ?>
        <?= $this->render('_image_grid', ['productId' => $model->productId]) ?>
    <?php endif; ?>
</div>
