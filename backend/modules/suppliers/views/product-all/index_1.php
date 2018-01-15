<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
?>
<h1>product ของ Suppliers/index</h1>
<div class="panel panel-info">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">Search</div>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $form = yii\widgets\ActiveForm::begin([
                    'options' => ['class' => 'form-horizontalx', 'enctype' => 'multipart/form-data'],
        ]);
        ?>

        <div class ="col-sm-4">
            -
        </div>
        <div class ="col-sm-4">
            -
        </div>
        <div class ="col-sm-4">
            -
        </div>
        <div class ="col-sm-4">
            -
        </div>
        <div class =" col-sm-4">
            -
        </div>
        <div class ="col-sm-12"><br>
            &nbsp;&nbsp;&nbsp;<button type="submit" class="btn"><i class="fa fa-search"></i> ค้นหา</button>
        </div>
        <?php yii\widgets\ActiveForm::end(); ?>

    </div>
</div>
<div class="panel-body">
    <?=
    GridView::widget([
        'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-hover'],
        'pager' => [
            'options' => ['class' => 'pagination pagination-xs']
        ],
        'options' => [
            'class' => 'table-light '
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'productId',
            //'userId',
            [
                'attribute' => 'user',
                'value' => function($model) {
                    //return $model->user['username'] . '(' . $model->productId . '::' . $model->parentId . ')';
                    if (isset($model->userIdSupp)) {

                        $userIdSupp = common\models\costfit\User::find()->where('userId=' . $model->userIdSupp)->one();
                        $userIdSupps = $userIdSupp['username'];
                    } else {
                        $userIdSupps = '-';
                    }
                    return $userIdSupps;
                }
            ],
            //'productGroupId ',
            [
                'attribute' => 'brand',
                'value' => function($model) {
                    return isset($model->brand) ? $model->brand->title : NULL;
                }
            ],
            [
                'attribute' => 'category',
                'value' => function($model) {
                    return isset($model->category) ? $model->category->title : NULL;
                }
            ],
            'isbn:ntext',
            //'code',
            [
                'attribute' => 'title',
                'headerOptions' => ['style' => 'width:20%'],
                'value' => function($model) {
                    return $model->title;
                }
            ],
            [
                'attribute' => 'mkt price',
                'value' => function($model) {
                    return number_format($model->price);
                }
            ],
            [
                'attribute' => 'selling price',
                'value' => function($model) {
                    return number_format($model->sellingPrice);
                }
            ],
            [
                'attribute' => 'stock',
                'value' => function($model) {
                    return $model->resultSupp;
                }
            ],
            [
                'attribute' => 'option detail',
                'value' => function($model) {
                    $productGroupOptionValue = common\models\costfit\ProductGroupOptionValue::find()->where('productGroupId=' . $model->parentId . ' and productId = ' . $model->productId)->all();
                    foreach ($productGroupOptionValue as $key => $value) {
                        //$productGroupOption = common\models\costfit\ProductGroupOption::find()->where('productGroupOptionId=' . $value->productGroupOptionId)->all();
                        //foreach ($productGroupOption as $key => $item) {
                        //return $item->name;
                        //}
                        return $value->value;
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{stock} {price} {view}  ',
                'buttons' => [
                    'stock' => function ($url, $model, $index) {
                        return Html::a('Stock', Url::to(Url::home() . 'productmanager/product-suppliers/stock?id=' . $model->productSuppId), ['class' => 'btn btn-info btn-xs']);
                    },
                    'price' => function ($url, $model, $index) {
                        return Html::a('Price', Url::to(Url::home() . 'productmanager/product-suppliers/price?id=' . $model->productSuppId), ['class' => 'btn btn-warning btn-xs']);
                    },
                    'view' => function($url, $model) {
                        return Html::a('<i class="fa fa-eye"></i>', $url, [
                                    'title' => Yii::t('yii', 'view'),
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                    'title' => Yii::t('yii', 'update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                    'data-method' => 'post',
                        ]);
                    },
                ]
            ],
        ],
    ]);
    ?>
</div>