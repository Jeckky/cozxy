<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\User;
use common\models\costfit\ProductGroup;
use common\models\costfit\Brand;
use common\models\costfit\Category;

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
        'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-9">{input}</div>',
            'labelOptions' => [
                'class' => 'col-sm-3 control-label'
            ]
        ]
    ]);
    ?>


    <div class="panel-heading">
        <span class="panel-title">อัพโหลดรูปภาพ</span>
    </div>

    <div class="panel-body">
        <?= $form->errorSummary($model) ?>


        <div class="note note-info uidemo-note">
            <h4>
                อัพโหลดรูปภาพ..
            </h4>
        </div>
        <!-- 49.1. $DROPZONEJS_EXAMPLE =====================================================================

                Example
        -->
        <div class="row">
            <div class="col-md-12">
                <?php
                echo \kato\DropZone::widget([
                    'options' => [
                        'url' => \yii\helpers\Url::to(['upload', 'id' => $_GET['id']]),
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
                ?>

            </div>
        </div>
        <!--
        <div class="row">
            <a id="uidemo-dropzonejs-example" href="#uidemo-dropzonejs-example" class="header-2">Example</a>
            <div class="col-md-12">
                <div id="dropzonejs-example" class="dropzone-box">
                    <div class="dz-default dz-message">
                        <i class="fa fa-cloud-upload"></i>
                        Drop files in here<br><span class="dz-text-small">or click to pick manually</span>
                    </div>
                    <form action="upload-image">
                        <div class="fallback">
                            <input name="file" type="file" multiple="" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        -->
        <br><br><br>
        <div class="form-group col-sm-12 text-right">
            <!--<button class="btn wizard-prev-step-btn  btn-lg">Prev</button>-->
            <?= Html::submitButton($model->isNewRecord ? 'Next step' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
            <a class="btn btn-primary wizard-next-step-btn  btn-lg" href="<?php Yii::$app->homeUrl ?>index">Skip</a>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
