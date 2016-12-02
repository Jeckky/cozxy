<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\costfit;
use yii\jui\DatePicker;
use common\models\costfit\User;
use common\models\costfit\ProductGroup;
use common\models\costfit\Brand;
use common\models\costfit\Category;
use kato\DropZone;
use yii\grid\GridView;
use yii\widgets\Pjax;

//use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductSuppliers */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .dropzone {
        position: relative;
        min-height: 284px;
        border: 3px dashed #ddd;
        border-radius: 3px;
        vertical-align: middle;
        width: 100%;
        cursor: pointer;
        padding: 0 15px 15px 0;
        -webkit-transition: all .2s;
        transition: all .2s;
    }
</style>
<div class="product-suppliers-form">
    <!-- Light info -->
    <?php
    $form = ActiveForm::begin([
        'options' => ['class' => 'panel panel-default form-horizontal ', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-9">{input}</div>',
            'labelOptions' => [
                'class' => 'col-sm-3 control-label'
            ]
        ]
    ]);
    ?>

    <div class="panel-heading">
        <span class="panel-title">อัพโหลดรูปภาพเพิ่มเติม</span>
        <div class="panel-heading-controls">
            <a href="/suppliers/product-suppliers">กลับหน้าหลัก</a>
        </div> <!-- / .panel-heading-controls -->
    </div>

    <div class="panel-body">
        <?php if (isset($_GET['productSuppId'])) { ?>
            <div class="panel panel-warning  ">
                <div class="panel-heading">
                    <span class="panel-title"> <h4>  รายการรูปภาพ ของ <strong><?php echo $productTitle->title ?></strong> </h4></span>
                </div>

                <div class="panel-body">
                    <div class="col-sm-12">
                        <?=
                        GridView::widget([
                            // 'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                            'dataProvider' => $dataProvider,
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
                                // 'updateDateTime',
                                ['class' => 'yii\grid\ActionColumn',
                                    'header' => 'Actions',
                                    'template' => '{view} {delete}',
                                    'buttons' => [
                                        'view' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-eye"></i>', Yii::$app->homeUrl . 'suppliers/product-image-suppliers/view?id=' . $model->productImageId . '&productSuppId=' . $_GET['productSuppId'], [
                                                'title' => Yii::t('yii', 'view'),
                                            ]);
                                        },
                                        'delete' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-trash-o"></i>', Yii::$app->homeUrl . 'suppliers/product-image-suppliers/delete?id=' . $model->productImageId . '&productSuppId=' . $_GET['productSuppId'], [
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
                </div>
            </div>
        <?php } ?>
        <?//= $form->errorSummary($model) ?>
        <div class="note note-info uidemo-note">
            <h4>
                อัพโหลดรูปภาพ.. <?php if (isset($_GET['productSuppId'])) { ?>
                    <code>
                        รูปด้านบนไม่แสดงให้กดปุ่ม ::
                    </code><a class="btn btn-warning btn-sm" href="/suppliers/product-suppliers/image-form?productSuppId=<?php echo $_GET['productSuppId']; ?>">Refresh ดูรูป</a>
                <?php } ?>
            </h4>
        </div>
        <!-- 49.1. $DROPZONEJS_EXAMPLE ====   Example ==== -->
        <div class="row">
            <div class="col-md-12">
                <?php
                if (isset($_GET['productSuppId'])) {
                    echo \kato\DropZone::widget([
                        'options' => [
                            'url' => \yii\helpers\Url::to(['upload', 'id' => $_GET['productSuppId']]),
                            'paramName' => 'image',
                            //'maxFilesize' => '200',
                            'clickable' => true,
                            'addRemoveLinks' => true,
                            'enqueueForUpload' => true,
                            'dictDefaultMessage' => "<h1><i class='fa fa-cloud-upload'></i><br>Drop files in here<h1><br><span class='dz-text-small'>or click to pick manually</span>",
                        ],
                        'clientEvents' => [
                            'sending' => "function(file, xhr, formData) {
                        //console.log(file);
                        }",
                            'complete' => "function(file){console.log(file)}",
                            'removedfile' => "function(file){alert(file.name + ' is removed')}"
                        ],
                    ]);
                } else {
                    echo \kato\DropZone::widget([
                        'options' => [
                            'url' => \yii\helpers\Url::to(['upload', 'id' => $_GET['productSuppId']]),
                            'paramName' => 'image',
                            //'maxFilesize' => '200',
                            'clickable' => true,
                            'addRemoveLinks' => true,
                            'enqueueForUpload' => true,
                            'dictDefaultMessage' => "<h1><i class='fa fa-cloud-upload'></i><br>Drop files in here<h1><br><span class='dz-text-small'>or click to pick manually</span>",
                        ],
                        'clientEvents' => [
                            'sending' => "function(file, xhr, formData) {
                        //console.log(file);
                        }",
                            'complete' => "function(file){console.log(file)}",
                            'removedfile' => "function(file){alert(file.name + ' is removed')}"
                        ],
                    ]);
                }
                ?>
            </div>
        </div>
        <br><br><br>
        <div class="form-group col-sm-12 text-right">
            <a class="btn wizard-prev-step-btn  btn-lg" href="/suppliers/product-suppliers">Prev</a>
            <a class="btn btn-success btn-lg" href="/suppliers/product-price-suppliers?productSuppId=<?php echo $_GET['productSuppId']; ?>">Next step</a>
            <a class="btn btn-primary wizard-next-step-btn  btn-lg" href="<?php Yii::$app->homeUrl ?>index">Skip</a>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <script>

    </script>
</div>
