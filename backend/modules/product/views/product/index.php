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
        <div class="well">
            <form method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Search</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <?= Html::dropDownList("Product[brandId]", isset($_POST["Product"]['brandId']) ? $_POST["Product"]['brandId'] : NULL, yii\helpers\ArrayHelper::map(\common\models\costfit\Brand::find()->all(), "brandId", "title"), ['class' => 'form-control', 'prompt' => '-- Select Brand --']) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= Html::dropDownList("Product[categoryId]", isset($_POST["Product"]['categoryId']) ? $_POST["Product"]['categoryId'] : NULL, yii\helpers\ArrayHelper::map(\common\models\costfit\Category::find()->all(), "categoryId", "title"), ['class' => 'form-control', 'prompt' => '-- Select Category --']) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= Html::textInput("Product[title]", isset($_POST["Product"]['title']) ? $_POST["Product"]['title'] : NULL, ['class' => 'form-control', 'placeHolder' => 'Type Product Name..']) ?>
                    </div>
                    <div class="col-lg-2">
                        <?= Html::submitButton("Search", ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </form>
        </div>

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
                    'isbn',
                    'code',
                    'title',
                    'tags',
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
                            'view' => function ($url, $model) {
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
                            'image' => function($url, $model) {
                                return Html::a('<br><u>Image</u>', ['/product/product-image', 'productId' => $model->productId], [
                                    'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },
                            'price' => function($url, $model) {
                                return Html::a('<br><u>Price</u>', ['/product/product-price', 'productId' => $model->productId], [
                                    'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },
                            'promotion' => function($url, $model) {
                                return Html::a('<br><u>Promotion</u>', ['/product/product-promotion', 'productId' => $model->productId], [
                                    'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
