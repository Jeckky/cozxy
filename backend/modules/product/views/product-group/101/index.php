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


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>



    <div class="panel panel-default" >
        <div class="panel-heading" style="background-color: #000;vertical-align: middle;">
            <div class="row">
                <div class="col-md-6">
                    <span class="panel-title"><h3 style="color:#ffcc00;vertical-align: middle;"><?= $this->title ?></h3></span>
                </div>
                <div class="col-md-6" style="vertical-align: bottom;">
                    <div class="btn-group pull-right" >
                        <?=
                        Html::a('Create New Product Group', ['create?step=1'], ['class' => 'btn btn-success',
                            'style' => 'height:35px;color:#FFF;']) . " "
                        ?>

                        <?=
                        Html::a('Choose Product Group', ['index?supplier=1'], ['class' => 'btn btn-primary',
                            'style' => 'height:35px;color:#FFF;'])
                        ?>

                        <?=
                        Html::a('My Product Group', ['index'], ['class' => 'btn btn-warning',
                            'style' => 'height:35px;color:#FFF;'])
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                'method' => 'POST',
                'options' => ['class' => 'panel panel-default form-horizontal'],
            ]);
            ?>
            <div class="row">
                <div class="col-md-1">
                    <h5>ค้นหา Title</h5>
                </div>
                <div class="col-md-2">
                    <?php
                    //echo '<label class="control-label">Provinces</label>';
                    $title = isset($_POST["title"]) ? $_POST["title"] : ''; //isset($_POST['BrandId'] ? $_POST['BrandId'] : '');
                    echo Html::textInput("title", $title, ['class' => 'form-control']);
                    ?>
                </div>
                <?php if (!isset($_GET["supplier"])): ?>
                    <div class="col-md-1">
                        <h5>ค้นหา Status</h5>
                    </div>
                    <div class="col-md-2">
                        <?php
                        //echo '<label class="control-label">Provinces</label>';
                        $status = isset($_POST["status"]) ? $_POST["status"] : ''; //isset($_POST['BrandId'] ? $_POST['BrandId'] : '');
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
                <div class="col-md-1">
                    <h5>ค้นหา Category</h5>
                </div>
                <div class="col-md-2">
                    <?php
                    //echo '<label class="control-label">Provinces</label>';
                    $categoryId = isset($_POST["CategoryId"]) ? $_POST["CategoryId"] : ''; //isset($_POST['BrandId'] ? $_POST['BrandId'] : '');
                    echo kartik\select2\Select2::widget([
                        'name' => 'categoryId',
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
                <div class="col-md-2">
                    <?php
                    $brandId = isset($_POST["BrandId"]) ? $_POST["BrandId"] : ''; //isset($_POST['BrandId'] ? $_POST['BrandId'] : '');
//echo '<label class="control-label">Provinces</label>';
                    echo kartik\select2\Select2::widget([
                        'name' => 'brandId',
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
                <input type="hidden" name="productGroupId" value="<?= isset($productGroupId) ? $productGroupId : '' ?>">
                <div class="col-md-2">
                    <button class="btn btn-info" type="submit">Search Product Group</button>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php if (isset($dataProvider)): ?>
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
                            'options' => ['style' => 'width:10%'],
                            'value' => function ($model) {
                                return $model->title;
                            }
                        ],
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
                            'value' => function ($model) {
                                return isset($model->createDateTime) ? $this->context->dateThai($model->createDateTime, 1) : NULL;
                            }
                        ],
                        ['attribute' => 'status',
                            'options' => [
                                'style' => 'width:7%'
                            ],
                            'value' => function ($model) {
                                return ($model->status == 1) ? "Approve" : ($model->status == 99 ? "Wait Approve" : "Draft at Step " . $model->step );
                            }
                        ],
                        // 'updateDateTime',
                        ['class' => 'yii\grid\ActionColumn',
                            'header' => 'Actions',
                            'options' => [
                                'style' => 'width:5%'
                            ],
                            'template' => '{update} {delete}',
                            'buttons' => [
//                            'view' => function ($url, $model) {
//                                return Html::a('<i class="fa fa-eye"></i>', $url, [
//                                    'title' => Yii::t('yii', 'view'),
//                                ]);
//                            },
                                'update' => function ($url, $model) {
                                    if (Yii::$app->user->identity->type == 4 || Yii::$app->user->identity->type == 5) {
                                        if ($model->status = 1 && $model->userId != Yii::$app->user->id) {
                                            return Html::a('<i class="fa fa-eye"></i>', ["view", 'productGroupId' => $model->productId], [
                                                'title' => Yii::t('yii', 'update'),
                                            ]);
                                        } else {
                                            return Html::a('<i class="fa fa-pencil"></i>', ["create", 'step' => 1, 'productGroupId' => $model->productId], [
                                                'title' => Yii::t('yii', 'update'),
                                            ]);
                                        }
                                    } else {
                                        if ($model->status == 0) {
                                            return Html::a('<i class="fa fa-pencil"></i>', ["create", 'step' => $model->step, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->productId], [
                                                'title' => Yii::t('yii', 'update'),
                                            ]);
                                        } else {
                                            return Html::a('<i class="fa fa-pencil"></i>Product', ["create", 'step' => 4, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->productId], [
                                                'title' => Yii::t('yii', 'update')]);
                                        }
                                    }
                                },
                                'delete' => function ($url, $model) {
                                    if (($model->status == 0 || $model->status == 99) && $model->userId == Yii::$app->user->id) {
                                        return Html::a('<i class="fa fa-trash-o"></i>', ['delete-product-group', 'id' => $model->productId], [
                                            'title' => Yii::t('yii', 'Delete'),
                                            'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                            'data-method' => 'post',
                                        ]);
                                    }
                                },
                            ]
                        ],
                    ],
                ]);
                ?>
            <?php endif; ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
