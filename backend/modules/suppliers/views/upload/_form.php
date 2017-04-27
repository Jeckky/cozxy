<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\User;
use kato\DropZone;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Upload */
/* @var $form yii\widgets\ActiveForm */
$title = "Upload Images";
?>

<div class="upload-form">

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
        <span class="panel-title"><?= $title ?></span>
    </div>

    <div class="panel-body">
        <?= $form->errorSummary($model) ?>

        <div class="row">
            <div class="col-md-12">
                <?php
                $csrfToken = \Yii::$app->request->getCsrfToken();

                echo \kato\DropZone::widget([
                    'options' => [
                        'url' => \yii\helpers\Url::to(['upload', 'id' => 1]),
                        'paramName' => 'image',
                        //'maxFilesize' => '200',
                        'clickable' => true,
                        'addRemoveLinks' => true,
                        'enqueueForUpload' => true,
                        'dictDefaultMessage' => "<h1><i class='fa fa-cloud-upload'></i><br>Drop files in here<h1><br><span class='dz-text-small'>or click to pick manually</span>",
                    ],
                    'clientEvents' => [
                        'sending' => "function(file, xhr, formData) {
                                        console.log(file);
                                        }",
                        'complete' => "function(file){console.log(file)}",
                        'removedfile' => "function(file){alert(file.name + ' is removed')}"
                    ],
                ]);
                ?>
            </div>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <div class="col-sm-12 text-right">
                <?= Html::submitButton($model->isNewRecord ? 'Finish' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
