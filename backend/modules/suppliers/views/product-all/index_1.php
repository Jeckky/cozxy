<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
?>
<h1>Product ของ My Prodcut/index</h1>
<div class="panel panel-info">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">Search</div>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $form = yii\widgets\ActiveForm::begin([
                    'options' => ['class' => 'form-product-my-prodcut', 'id' => 'form-product-my-prodcut', 'enctype' => 'multipart/form-data'],
        ]);
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        ?>

        <div class ="col-sm-12">

            <div class ="col-sm-4">
                <?= Html::input('text', 'title', isset($title) ? $title : '', ['class' => 'form-control', 'id' => 'title', 'onchange' => 'selectChange(this,"title")']) ?>
                <p>
                    <br><code>*** พิมพ์คำที่ค้นหาแล้วกดEnter</code>
                </p>
            </div>

            <div class ="col-sm-4">
                <?php
                //echo '<label class="control-label">Provinces</label>';

                $CategoryId = isset($_POST["CategoryId"]) ? $_POST["CategoryId"] : ''; //isset($_POST['BrandId'] ? $_POST['BrandId'] : '');
                echo kartik\select2\Select2::widget([
                    'name' => 'CategoryId',
                    'value' => isset($CategoryId) ? $CategoryId : '',
                    'data' => common\models\costfit\Category::findCategoryArrayWithMultiLevelBackend(),
                    //'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Category::find()->all(), 'categoryId', 'title'),
                    'options' => ['placeholder' => 'Select or Search User Category ...', 'id' => 'CategoryId', 'onchange' => 'selectChange(this,"category")'], //, 'onchange' => 'this.form.submit()'
                    'pluginOptions' => [
                        'tags' => true,
                        'placeholder' => 'Select or Search ...',
                        'loadingText' => 'Loading Category ...',
                        'initialize' => true,
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
            <div class ="col-sm-4">
                <?php
                $brandId = isset($_POST["BrandId"]) ? $_POST["BrandId"] : ''; //isset($_POST['BrandId'] ? $_POST['BrandId'] : '');
                //echo '<label class="control-label">Provinces</label>';
                echo kartik\select2\Select2::widget([
                    'name' => 'BrandId',
                    'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Brand::find()->all(), 'brandId', 'title'),
                    'value' => isset($brandId) ? $brandId : '',
                    'options' => ['placeholder' => 'Select or Search User Brand ...', 'id' => 'BrandId', 'onchange' => 'selectChange(this,"brand")'], //, 'onchange' => 'this.form.submit()'
                    'pluginOptions' => [
                        'tags' => true,
                        'placeholder' => 'Select or Search ...',
                        'loadingText' => 'Loading Brand ...',
                        'allowClear' => true
                    //'initialize' => true,
                    ],
                ]);
                ?>
            </div>
            <div class ="col-sm-4">
                -
            </div>
            <div class =" col-sm-4">
                -
            </div>
            <div class ="col-sm-12"><br>
               <!-- &nbsp;&nbsp;&nbsp;<button type="submit" class="btn"><i class="fa fa-search"></i> ค้นหา</button>-->
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
                    'headerOptions' => ['style' => 'width:15%'],
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