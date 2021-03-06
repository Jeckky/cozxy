<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Suppliers';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
//echo Yii::$app->user->identity->type;
if (Yii::$app->user->identity->type != 2 && Yii::$app->user->identity->type != 3) {
    header("location: /auth");
    exit(0);
}


//throw new \yii\base\Exception($categoryId);
?>
<div class="product-suppliers-index">

    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'method' => 'GET',
                        'action' => ['index'],
                        'options' => ['class' => ' form-horizontal', 'enctype' => 'multipart/form-data'],
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-9">{input}</div>',
                            'labelOptions' => [
                                'class' => 'col-sm-3 control-label  '
                            ]
                        ]
            ]);
            ?>
            <div class="row">
                <div class="col-md-1">
                    <h5>ค้นหา Category</h5>
                </div>
                <div class="col-md-3">
                    <?php
                    //echo '<label class="control-label">Provinces</label>';
                    $CategoryId = isset($_GET["CategoryId"]) ? $_GET["CategoryId"] : ''; //isset($_POST['BrandId'] ? $_POST['BrandId'] : '');
                    echo kartik\select2\Select2::widget([
                        'name' => 'CategoryId',
                        'value' => $categoryId == '' ? '' : $categoryId,
                        'data' => common\models\costfit\Category::findCategoryArrayWithMultiLevelBackend(),
                        //'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Category::find()->all(), 'categoryId', 'title'),
                        'options' => ['placeholder' => 'Select or Search User Category ...', 'id' => 'CategoryId'], //, 'onchange' => 'this.form.submit()'
                        'pluginOptions' => [
                            'tags' => true,
                            'placeholder' => 'Select or Search ...',
                            'loadingText' => 'Loading Category ...',
                            'initialize' => true,
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-1">
                    <h5>ค้นหา Brand</h5>
                </div>
                <div class="col-md-3">
                    <?php
                    $brandId = isset($_GET["BrandId"]) ? $_GET["BrandId"] : ''; //isset($_POST['BrandId'] ? $_POST['BrandId'] : '');
                    //echo '<label class="control-label">Provinces</label>';
                    echo kartik\select2\Select2::widget([
                        'name' => 'BrandId',
                        'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Brand::find()->all(), 'brandId', 'title'),
                        'value' => $brandId == '' ? '' : $brandId,
                        'options' => ['placeholder' => 'Select or Search User Brand ...', 'id' => 'BrandId'], //, 'onchange' => 'this.form.submit()'
                        'pluginOptions' => [
                            'tags' => true,
                            'placeholder' => 'Select or Search ...',
                            'loadingText' => 'Loading Brand ...',
                        //'initialize' => true,
                        ],
                    ]);
                    ?>
                </div>
                <input type="hidden" value="<?= isset($productGroupId) ? $productGroupId : '' ?>">
                <div class="col-md-2">
                    <button class="btn btn-info" type="submit">Search Product Suppliers</button>
                </div>
            </div>

        </div>
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Suppliers', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <script> $.pjax.reload({container: '#employee-grid-view'});</script>
            <?php
//Pjax::begin(['id' => 'employee-grid-view']);
            Pjax::begin(['id' => 'employee-grid-view', 'enablePushState' => FALSE, 'clientOptions' => [
                    'method' => 'POST']]);
            ?>
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'id' => 'employee-grid-view',
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'productId',
                    //'userId',
                    //'productGroupId',
                    /* [
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
                      //'isbn',
                      ['attribute' => 'isbn',
                      'label' => 'isbn',
                      //'contentOptions' => ['style' => 'width:70px;
                      min-width:70px;
                      '],
                      ],
                      'code',
                      //'title', */
                    [
                        'attribute' => 'isbn & code',
                        'format' => 'html',
                        'value' => function($model) {
                            return '<div class = "col-sm-12"><strong>isbn : </strong>' . $model->isbn . '</div>'
                                    . '<div class = "col-sm-12"><strong>code : </strong> ' . $model->code . '</div>'
                            ;
                        }
                    ],
                    [
                        'attribute' => 'รายละเอียดสินค้า',
                        'format' => 'raw',
                        'value' => function($model) {
                            $title = $model->title;
                            $category = isset($model->category) ? \common\models\costfit\Category::getRootText($model->categoryId, TRUE) : NULL;
                            $brand = isset($model->brand) ? $model->brand->title : NULL;
                            $url = isset($model->url) ? Html::a('url brand', $model->url, ['target' => '_blank', 'data-pjax' => "0"]) : 'ไม่ระบุ';
                            //$count = common\models\costfit\ProductPageViews::find()->where('productSuppId=' . $model->productSuppId)->count();

                            return '<strong>Title : </strong><a href="http://www.cozxy.com/products/' . $model->encodeParams(['productId' => $model->productId, 'productSupplierId' => $model->productSuppId])
                                    . '">' . $title . '</a><br>'
                                    . '<strong>Category : </strong> ' . $category . '<br>'
                                    . '<strong>Brand : </strong>' . $brand . '<br>'
                                    . '<strong>Url : </strong>' . $url . '<br>'
                                    . '<strong>เข้าชม : </strong>' . common\models\costfit\ProductPageViews::find()->where('productSuppId=' . $model->productSuppId)->count() . ' ครั้ง'
                            ;
                        }
                    ],
                    // 'optionName',
                    // 'shortDescription:ntext',
                    // 'description:ntext',
                    // 'specification:ntext',
                    // 'width',
                    // 'height',
                    // 'depth',
                    // 'weight',
                    'quantity',
                    [
                        'attribute' => 'คงเหลือ',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a($model->result . ' ชิ้น(<i class="fa fa-plus-circle" aria-hidden="true" class="success"></i>เพิ่มจำนวนสินค้า)', Yii::$app->homeUrl . "suppliers/product-total-suppliers/create?productSuppId=" . $model->productSuppId . '&total=addup', [
                                        'title' => Yii::t('app', 'เพิ่มจำนวนสินค้า'), 'class' => 'text-center']);
                        }
                    ],
                    [
                        'attribute' => 'ราคาล่าสุด',
                        'format' => 'html',
                        'value' => function($model) {
                            return $model->priceSuppliers;
                        }
                    ],
                    [
                        'attribute' => 'ราคา',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a('<i class="fa fa-plus-circle" aria-hidden="true" class="success"></i>เพิ่มราคาใหม่', Yii::$app->homeUrl . "suppliers/product-price-suppliers?productSuppId=" . $model->productSuppId, [
                                        'title' => Yii::t('app', 'เพิ่มราคาใหม่'), 'class' => 'text-center']);
                        }
                    ],
                    //'approve',
                    [
                        'attribute' => 'สถานะอนุมัติ',
                        'format' => 'html',
                        'value' => function($model) {
                            if ($model->approve == 'old') {
                                $txt = '<span class="text-warning">รออนุมัติ (' . common\helpers\CozxyUnity::TimeElapsedString($model->createDateTime) . ')</span>';
                            } else if ($model->approve == 'approve') {
                                $txt = '<span class="text-success">อนุมัติแล้ว</span>';
                            } else if ($model->approve == 'new') {
                                $txt = '<span class="text-warning">รออนุมัติ (' . common\helpers\CozxyUnity::TimeElapsedString($model->createDateTime) . ')</span>';
                            } else {
                                $txt = '<span class="text-danger">แจ้งเจ้าหน้าที่ (' . common\helpers\CozxyUnity::TimeElapsedString($model->createDateTime) . ')</span>';
                            }
                            return $txt;
                        }
                    ],
                    [
                        'attribute' => 'Duplicates',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a('<i class="fa fa-plus-circle" aria-hidden="true" class="success"></i>duplicate', Yii::$app->homeUrl . "suppliers/product-suppliers/duplicate-product?productSuppId=" . $model->productSuppId, [
                                        'title' => Yii::t('app', 'duplicate product'), 'class' => 'text-left']);
                        }
                    ],
                    // 'unit',
                    // 'smallUnit',
                    // 'tags',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    //'image',
                    [
                        'attribute' => 'image',
                        'format' => 'html',
                        'value' => function($model) {
                            $productImageSupplers = common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $model->productSuppId)->orderBy('ordering asc')->limit(1)->one();
                            if (isset($productImageSupplers)) {
                                //echo $productImageSupplers->imageThumbnail2;
                                return Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรูปภาพใหม่ <i class="fa fa-picture-o"></i>', Yii::$app->homeUrl . "suppliers/product-suppliers/image-form?productSuppId=" . $model->productSuppId, [
                                            'title' => Yii::t('app', 'image'), 'class' => 'text-center']) .
                                        Html::img(Yii::$app->homeUrl . $productImageSupplers->imageThumbnail2, ['style' => 'width:137px;height:130px', 'class' => 'img-responsive']);
                            } else {
                                return Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรูปภาพใหม่ <i class="fa fa-picture-o"></i>', Yii::$app->homeUrl . "suppliers/product-suppliers/image-form?productSuppId=" . $model->productSuppId, [
                                            'title' => Yii::t('app', 'image'), 'class' => 'text-center']);
                            }
                        },
                        'contentOptions' => ['style' => 'width:100px;  min-width:100px;  '],
                    ],
                    /*
                      [
                      'attribute' => 'Smart',
                      'format' => 'html',
                      'value' => function($model) {
                      return Html::a('<i class="fa fa-btc"></i> เพิ่มราคาขายและราคาค่าจัดส่ง', Yii::$app->homeUrl . "suppliers/product-price-suppliers?productSuppId=" . $model->productSuppId, [
                      'title' => Yii::t('app', 'image'), 'class' => 'text-center']);
                      }
                      ], */
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete} {post}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                if (isset($_GET['BrandId']) && !empty($_GET['BrandId'])) {
                                    $brandId = $_GET['BrandId'];
                                } else {
                                    $brandId = '';
                                }
                                if (isset($_GET['CategoryId']) && !empty($_GET['CategoryId'])) {
                                    $categoryId = $_GET['CategoryId'];
                                } else {
                                    $categoryId = '';
                                }
                                if (isset($_GET['productGroupId']) && !empty($_GET['productGroupId'])) {
                                    $productGroupId = $_GET['productGroupId'];
                                } else {
                                    $productGroupId = '';
                                }
                                return Html::a('<i class="fa fa-eye"></i>', $url . '&CategoryId=' . $categoryId . '&BrandId=' . $brandId . '&productGroupId=' . $productGroupId, [
                                            'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                            'update' => function ($url, $model) {
                                if (isset($_GET['BrandId']) && !empty($_GET['BrandId'])) {
                                    $brandId = $_GET['BrandId'];
                                } else {

                                    $brandId = '';
                                }
                                if (isset($_GET['CategoryId']) && !empty($_GET['CategoryId'])) {
                                    $categoryId = $_GET['CategoryId'];
                                } else {

                                    $categoryId = '';
                                }
                                if (isset($_GET['productGroupId']) && !empty($_GET['productGroupId'])) {
                                    $productGroupId = $_GET['productGroupId'];
                                } else {
                                    $productGroupId = '';
                                }
                                return Html::a('<i class="fa fa-pencil"></i>', $url . '&CategoryId=' . $categoryId . '&BrandId=' . $brandId . '&productGroupId=' . $productGroupId, [
                                            'title' => Yii::t('yii', 'update'),
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                if (isset($_GET['BrandId']) && !empty($_GET['BrandId'])) {
                                    $brandId = $_GET['BrandId'];
                                } else {

                                    $brandId = '';
                                }
                                if (isset($_GET['CategoryId']) && !empty($_GET['CategoryId'])) {
                                    $categoryId = $_GET['CategoryId'];
                                } else {

                                    $categoryId = '';
                                }
                                if (isset($_GET['productGroupId']) && !empty($_GET['productGroupId'])) {
                                    $productGroupId = $_GET['productGroupId'];
                                } else {
                                    $productGroupId = '';
                                }
                                return Html::a('<i class="fa fa-trash-o"></i>', $url . '&CategoryId=' . $categoryId . '&BrandId=' . $brandId . '&productGroupId=' . $productGroupId, [
                                            'title' => Yii::t('yii', 'Delete'),
                                            'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                            'data-method' => 'post',
                                ]);
                            },
                            'post' => function($url, $model) {
                                return Html::a('<br><u>Post</u>', ['/suppliers/product-post', 'productSuppId' => $model->productSuppId], [
                                            'title' => Yii::t('app', 'Change today\'s lists'), 'target' => '_blank', 'data-pjax' => 0]);
                            },
                        ]
                    ],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
