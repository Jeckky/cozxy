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

    <div class="panel-heading">
        <span class="panel-title">อัพโหลดรูปภาพ</span>
        <div class="panel-heading-controls">
        </div> <!-- / .panel-heading-controls -->
    </div>

    <div class="panel-body">

        <div class="note note-info uidemo-note">
            <h4>
                อัพโหลดรูปภาพ.. <?php if (isset($_GET['productSuppId'])) { ?>
                    <code>
                        รูปด้านบนไม่แสดงให้กดปุ่ม ::
                    </code>
                <?php } ?>
            </h4>
        </div>
        <!-- 49.1. $DROPZONEJS_EXAMPLE ====   Example ==== -->
        <div class="row">
            <div class="col-md-12">
                <?php
                $csrfToken = \Yii::$app->request->getCsrfToken();
                echo \kato\DropZone::widget([
                    'options' => [
                        'url' => \yii\helpers\Url::to(['upload', 'id' => $id]),
                        'paramName' => 'image',
                        //'maxFilesize' => '200',
                        'clickable' => true,
                        'addRemoveLinks' => true,
                        'enqueueForUpload' => true,
                        'dictDefaultMessage' => "<h1><i class='fa fa-cloud-upload'></i><br>Drop files in here<h1><br><span class='dz-text-small'>or click to pick manually</span>",
                    ],
                    'clientEvents' => [
                        'sending' => "function(file, xhr, formData) {
                            uploadCount += 1;
                            console.log(file);
                        }",
                        'complete' => "function(file){
                            uploadCount -= 1;
//                            if(uploadCount == 0) {
                                //    location.reload();
                                $.pjax({container:'#image-grid-pjax'});
//                            }
                                myDropzone.removeFile(file);
                        }",
                        'removedfile' => "function(file){
                            //alert(file.name + ' is removed')
                        }"
                    ],
                ]);
                ?>
            </div>
        </div>
        <br><br><br>

    </div>
</div>
