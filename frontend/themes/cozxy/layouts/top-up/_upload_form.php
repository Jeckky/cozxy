<?php

use frontend\assets\TopUpAsset;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\models\costfit\TopUp;
use common\models\costfit\User;
use jlorente\remainingcharacters\RemainingCharacters;
use kato\DropZone;

TopUpAsset::register($this);
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style type="text/css">
    .dropzone {
        position: relative;
        min-height: 284px;
        border: 3px dashed #ddd;
        border-radius: 3px;
        vertical-align: middle;
        width: 60%;
        cursor: pointer;
        padding: 0 15px 15px 0;
        -webkit-transition: all .2s;
        transition: all .2s;
    }
</style>

<div class="">
    <h2>Upload payment slip for "<?= $topUp->topUpNo ?>"</h2>
</div>
<div class="modal-body">
    <?php
    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']
    ]);
    /* echo \kato\DropZone::widget([
      'options' => [
      'maxFilesize' => '2',
      ],
      'clientEvents' => [
      'complete' => "function(file){console.log(file)}",
      'removedfile' => "function(file){alert(file.name + ' is removed')}"
      ],
      ]); */
    ?>
    <?php
    echo \kato\DropZone::widget([
        //'dropzoneContainer' => $topUp->topUpId,
        'options' => [
            'url' => \yii\helpers\Url::to(['upload', 'id' => $topUp->topUpId]),
            'paramName' => 'image',
            // 'maxFilesize' => '200',
            'clickable' => true,
            'addRemoveLinks' => true,
            'enqueueForUpload' => true,
            //'dictDefaultMessage' => 'asdfasdfa',
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
    <div class="form-group text-center">
                <!--<input type="file" id="inputImg" name="slipUpload[image]" class="btn btn-lg btn-warning"style="width: 525px;font-size: 10pt;height:75px"  required="true">-->

        <input type="hidden" name="topUpId" value="<?php $topUp->topUpId ?>">
        <?= yii\helpers\Html::submitButton('Upload', ['class' => 'btn btn-black', 'name' => 'Upload-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
