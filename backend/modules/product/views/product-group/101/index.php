<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Groups Wizard Create';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-group-index">


    <?php Pjax::begin(['id' => 'product-grid-view']); ?>
    <?php
    $user_group_Id = Yii::$app->user->identity->user_group_Id;
    $userRe = str_replace('[', '', str_replace(']', '', $user_group_Id));
    $userEx = explode(',', $userRe);
    $ress = array_search(26, $userEx);
    ?>

    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #000;vertical-align: middle;">
            <div class="row">
                <div class="col-md-6">
                    <span class="panel-title"><h3 style="color:#ffcc00;vertical-align: middle;"><?= $this->title ?></h3></span>
                </div>
                <div class="col-md-6" style="vertical-align: bottom;">
                    <div class="btn-group pull-right">
                        <?=
                        Html::a('+ Product Group', ['create?step=1'], ['class' => 'btn btn-success btn-sm',
                            'style' => '']) . " "
                        ?>

                        <?=
                        Html::a('Choose Product Group', ['index?supplier=1'], ['class' => 'btn btn-primary btn-sm',
                            'style' => ''])
                        ?>

                        <?=
                        Html::a('My Product Group', ['index'], ['class' => 'btn btn-warning btn-sm',
                            'style' => ''])
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">

            <div class="panel panel-default">
                <div class="panel-heading">ค้นหา</div>
                <?php
                $form = ActiveForm::begin([
                    'method' => 'GET',
                    'action' => isset($_GET["supplier"]) ? ['index?supplier=1'] : ['index'],
                    'options' => ['class' => 'form-horizontal'],
                ]);
                ?>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Title</label>
                            <?php
                            //echo '<label class="control-label">Provinces</label>';
                            $title = isset($_GET["title"]) ? $_GET["title"] : ''; //isset($_GET['BrandId'] ? $_GET['BrandId'] : '');
                            echo Html::textInput("title", $title, ['class' => 'form-control']);
                            ?>
                        </div>
                        <?php if (!isset($_GET["supplier"])): ?>
                            <div class="col-md-3">
                                <label for="">Status</label>
                                <?php
                                //echo '<label class="control-label">Provinces</label>';
                                $status = isset($_GET["status"]) ? $_GET["status"] : ''; //isset($_GET['BrandId'] ? $_GET['BrandId'] : '');
                                echo kartik\select2\Select2::widget([
                                    'name' => 'status',
                                    'value' => $status,
                                    'data' => [-1 => 'Draft', 99 => 'Wait Approve', 1 => 'Approve'],
                                    //'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Category::find()->all(), 'categoryId', 'title'),
                                    'options' => ['placeholder' => 'Select or Search User Status ...', 'id' => 'status'], //, 'onchange' => 'this.form.submit()'
                                    'pluginOptions' => [
                                        'tags' => true,
                                        'placeholder' => 'Select or Search ...',
                                        'loadingText' => 'Loading Status ...',
                                        'initialize' => true,
                                    ],
                                ]);
                                ?>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-3">
                            <label for="">Category</label>
                            <?php
                            //echo '<label class="control-label">Provinces</label>';
                            $categoryId = isset($_GET["categoryId"]) ? $_GET["categoryId"] : ''; //isset($_GET['BrandId'] ? $_GET['BrandId'] : '');
                            echo kartik\select2\Select2::widget([
                                'name' => 'categoryId',
                                'value' => $categoryId,
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

                        <div class="col-md-3">
                            <label for="">Brand</label>
                            <?php
                            $brandId = isset($_GET["brandId"]) ? $_GET["brandId"] : ''; //isset($_GET['BrandId'] ? $_GET['BrandId'] : '');
                            //echo '<label class="control-label">Provinces</label>';
                            echo kartik\select2\Select2::widget([
                                'name' => 'brandId',
                                'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Brand::find()->all(), 'brandId', 'title'),
                                'value' => $brandId,
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
                    </div>

                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-info" type="submit">Search Product Group</button>
                    <a href="<?= !isset($_GET['supplier']) ? Yii::$app->homeUrl . "product/product-group" : Yii::$app->homeUrl . "product/product-group/index?supplier=1" ?>" class="btn btn-danger" data-pjax="0"><i class="glyphicon glyphicon-refresh"></i>Reset</a>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

            <?php if (isset($dataProvider)): ?>
                <?php
                //throw new \yii\base\Exception(print_r($dataProvider, TRUE));
                //throw new \yii\base\Exception($dataProvider->getCount());
                ?>

                <?php
                $form = ActiveForm::begin([
                    'method' => 'GET',
                    'id' => 'multi-delete',
                    'action' => Yii::$app->homeUrl . 'product/product-group/multiple-delete',
                    'options' => ['class' => 'form-horizontal'],
                ]);
                ?>
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
//                    'productGroupId',
                        ['attribute' => 'title',
                            'format' => "raw",
                            'options' => ['style' => 'width:40%'],
                            'value' => function ($model) {
                                return $model->title;
                            }
                        ],
                        ['attribute' => 'Image',
                            'format' => "raw",
                            'value' => function ($model) {
                                return isset($model->images->image) ? Html::img(Yii::$app->homeUrl . $model->images->image, ["style" => "width:80px;height:80px;"]) : null;
                            }
                        ],
                        ['attribute' => 'supplier',
                            'visible' => ($ress !== FALSE) ? TRUE : FALSE,
                            'format' => "raw",
                            'options' => ['style' => 'width:15%'],
                            'value' => function ($model) {
                                if (isset($model->productSuppUserId)) {
                                    $supp = common\models\costfit\User::findOne($model->productSuppUserId);
                                    $text = "Email : " . $supp->username . "<br>ชื่อ :" . $supp->firstname . " " . $supp->lastname;
                                } else {
                                    $text = "Master";
                                }
                                return $text;
                            }
                        ],
                        ['attribute' => 'Market Price',
                            'visible' => ($ress !== FALSE) ? TRUE : FALSE,
                            'format' => "raw",
                            'options' => ['style' => 'width:15%'],
                            'value' => function ($model) {
                                return number_format($model->price, 2);
                            }
                        ],
//                        ['attribute' => 'userId',
//                            'format' => "raw",
//                            'options' => ['style' => 'width:10%'],
//                            'value' => function ($model) {
//                                return $model->suppUser;
//                            }
//                        ],
//                        ['attribute' => 'description',
//                            'format' => "raw",
//                            'options' => ['style' => 'width:20%'],
//                            'value' => function ($model) {
//                                return $model->description;
//                            }
//                        ],
//                    ['attribute' => 'specification',
//                        'format' => "raw",
//                        'options' => ['style' => 'width:20%'],
//                        'value' => function ($model) {
//                            return $model->specification;
//                        }
//                    ],
                        ['attribute' => 'createDateTime',
                            'options' => [
                                'style' => 'width:10%'
                            ],
                            'value' => function ($model) {
                                return isset($model->createDateTime) ? $this->context->dateThai($model->createDateTime, 1) : NULL;
                            }
                        ],
                        ['attribute' => 'status',
                            'options' => [
                                'style' => 'width:7%'
                            ],
                            'visible' => ($ress !== FALSE) ? FALSE : TRUE,
                            'value' => function ($model) {
                                return ($model->status == 1) ? "Approve" : ($model->status == 99 ? "Wait Approve" : "Draft at Step " . $model->step);
                            }
                        ],
                        // 'updateDateTime',
                        ['class' => 'yii\grid\CheckboxColumn'],
                        ['class' => 'yii\grid\ActionColumn',
                            'header' => 'Actions',
                            'options' => [
                                'style' => 'width:5%'
                            ],
                            'template' => '{update} {deleteOne}',
                            'buttons' => [
                                'update' => function ($url, $model) use ($ress) {
                                    if (Yii::$app->user->identity->type == 2 || Yii::$app->user->identity->type == 3) {
                                        if ($model->status == 1 || $model->status == 99) {
//                                            if ($model->userId != Yii::$app->user->id) {
                                            $productId = isset($model->productId) ? $model->productId : $model->productTempId;
                                            $products = common\models\costfit\Product::find()->where("parentId = " . $productId)->count();

                                            if ($model->status == 1 && $products == 0) {
                                                $productSupps = 1;
                                                $productSupps = common\models\costfit\ProductSuppliers::find()
                                                ->join("RIGHT JOIN", "product p", "p.productId = product_suppliers.productId")
                                                ->where("product_suppliers.userId= " . Yii::$app->user->id . " AND p.parentId = " . $productId)->count();
                                                if ($productSupps == 0) {
                                                    return Html::a('<i class="fa fa-plus"></i>Create', ["create", 'step' => 1, 'productGroupId' => isset($model->productId) ? $model->productId : $model->productTempId], [
                                                        'title' => Yii::t('yii', 'update')]);
                                                } else {
                                                    return Html::a('<i class="fa fa-eye"></i>', ["view", 'productGroupId' => isset($model->productId) ? $model->productId : $model->productTempId], [
                                                        'title' => Yii::t('yii', 'update'),
                                                    ]);
                                                }
                                            } else {
                                                return Html::a('<i class="fa fa-eye"></i>', ["view", 'productGroupId' => isset($model->productId) ? $model->productId : $model->productTempId, 'productGroupTemplateId' => $model->productGroupTemplateId, 'step' => $model->step], [
                                                    'title' => Yii::t('yii', 'update'),
                                                ]);
                                            }
                                        } elseif ($model->status != 99) {
                                            return Html::a('<i class="fa fa-pencil"></i>Product', ["create", 'step' => $model->step, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => isset($model->productId) ? $model->productId : $model->productTempId], [
                                                'title' => Yii::t('yii', 'update')]);
                                        }
                                    } elseif ($model->status == 0) {
                                        return Html::a('<i class="fa fa-pencil"></i>', ["create", 'step' => $model->step, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => isset($model->productId) ? $model->productId : $model->productTempId], [
                                            'title' => Yii::t('yii', 'update'),
                                        ]);
                                    } else {
                                        if ($ress !== FALSE) {
                                            return Html::a('<i class="fa fa-eye"></i>', ["view", 'productGroupId' => isset($model->productId) ? $model->productId : $model->productTempId, 'userId' => isset($model->productSuppUserId) ? $model->productSuppUserId : 0, 'productGroupTemplateId' => $model->productGroupTemplateId, 'step' => $model->step], [
                                                'title' => Yii::t('yii', 'update'),
                                            ]);
                                        } else {
                                            return Html::a('<i class="fa fa-pencil"></i>Product', ["create", 'step' => 4, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => isset($model->productId) ? $model->productId : $model->productTempId], [
                                                'title' => Yii::t('yii', 'update')]);
                                        }
                                    }
                                },
                                'deleteOne' => function ($url, $model) {
//                                    if (($model->status == 0) && $model->userId == Yii::$app->user->id) {
                                    //$param = 'id=';
                                    /* '&&categoryId=' . isset($_GET["categoryId"]) ? $_GET["categoryId"] : '' .
                                      '&&title=' . isset($_GET["title"]) ? $_GET["title"] : '' .
                                      '&&supplier=' . isset($_GET["supplier"]) ? $_GET["supplier"] : '' .
                                      '&&status=' . isset($_GET["status"]) ? $_GET["status"] : ''; */
                                    // throw new \yii\base\Exception($param);
                                    // return '<a href="' . Yii::$app->homeUrl . 'product/product-group/delete-product-group?' . $param . '"><i class="fa fa-trash-o"></i></a>';
                                    /* return Html::a('<i class="fa fa-trash-o"></i>', ['delete-product-group',
                                      'brandId' => isset($_GET["brandId"]) ? $_GET["brandId"] : '',
                                      'categoryId' => isset($_GET["categoryId"]) ? $_GET["categoryId"] : '',
                                      'title' => isset($_GET["title"]) ? $_GET["title"] : '',
                                      'supplier' => isset($_GET["supplier"]) ? $_GET["supplier"] : '',
                                      'status' => isset($_GET["status"]) ? $_GET["status"] : '',
                                      'id' => isset($model->productId) ? $model->productId : $model->productTempId
                                      ], [
                                      'title' => Yii::t('yii', 'Delete'),
                                      'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                      ]); */
                                    return yii\bootstrap\Html::a('<i class="fa fa-trash-o"></i>', ['product-group/delete-product-group'], [
                                        'data' => [
                                            'confirm' => 'Are you sure to delete this item?',
                                            'params' => [
                                                'brandId' => isset($_GET["brandId"]) ? $_GET["brandId"] : '',
                                                'categoryId' => isset($_GET["categoryId"]) ? $_GET["categoryId"] : '',
                                                'title' => isset($_GET["title"]) ? $_GET["title"] : '',
                                                'supplier' => isset($_GET["supplier"]) ? $_GET["supplier"] : '',
                                                'status' => isset($_GET["status"]) ? $_GET["status"] : '',
                                                'id' => isset($model->productId) ? $model->productId : $model->productTempId
                                            ]
                                        ]
                                    ]);
                                },
                            ]
                        ],
                    ],
                ]);
                ?>
                <?php if (isset($_GET["brandId"])) {//ส่งไปยัง multiple delete เพื่อกลับมาหน้าเดิมแล้ว fillter ไม่หาย  ?>
                    <input type="hidden" name="brandId" value="<?= $_GET["brandId"] ?>">
                    <?php
                }
                if (isset($_GET["categoryId"])) {
                    ?>
                    <input type="hidden" name="categoryId" value="<?= $_GET["categoryId"] ?>">
                    <?php
                }
                if (isset($_GET["title"])) {
                    ?>
                    <input type="hidden" name="title" value="<?= $_GET["title"] ?>">
                    <?php
                }
                if (isset($_GET["supplier"])) {
                    ?>
                    <input type="hidden" name="supplier" value="<?= $_GET["supplier"] ?>">
                    <?php
                }
                if (isset($_GET["status"])) {
                    ?>
                    <input type="hidden" name="status" value="<?= $_GET["status"] ?>">
                <?php }
                ?>

                <?php ActiveForm::end(); ?>
                <div class="btn btn-danger pull-right" id="multi">Multiple Delete</div>
            <?php endif; ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
<?php
/* $js = "$(document).on('click', '#multi', function (e) {
  if(confirm(Are you sure to delete selected items?)){
  $('#multi-delete').submit();
  }else{
  return false;
  }
  });"; */
$js = "$(document).on('click', '#multi', function (e) {
  if (confirm('Are you sure to delete selected items?')) {
  $('#multi-delete').submit();
  }else{
  return false;
  }
});";
$this->registerJs($js);
?>