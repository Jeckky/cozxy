<!-- Content -->
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use leandrogehlen\treegrid\TreeGrid;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use mihaildev\ckeditor\CKEditor;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="page-messages-content box-cell valign-top">
    <div class="row">
        <div class="col-lg-6 col-md-6 pull-left text-left" style="color:#000;font-size: 18pt;">New message</div>
        <?php if (isset($errorMessage) && $errorMessage != '') { ?>
            <div class="col-lg-6 col-md-6 pull-right text-right" style="color:#ff6666;font-size: 16pt;"><?= $errorMessage ?></div>
        <?php }
        ?>
    </div>
    <div class="panel">
        <?php
        $form = ActiveForm::begin([
                    'id' => 'default-shipping-address',
                    'action' => $baseUrl . '/mailstore/verify-email/send-email',
                    'options' => [
                        'class' => 'space-bottom'
                    ],
        ]);
        ?>
        <div class="form-group">
            <label for="page-messages-new-from">From</label>
            <input type="text" class="form-control" id="page-messages-new-from" value="cozxy@cozxy.com" readonly>
        </div>

        <div class="form-group">
            <label for="page-messages-new-from">Email to</label>
            <?php
            echo kartik\widgets\Select2::widget([
                'model' => $user,
                'attribute' => 'email',
                'data' => $email,
                'options' => ['placeholder' => 'Select email ...',
                    'required' => true,
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true,
                ],
            ]);
            ?>
        </div>

        <div class="form-group">
            <label for="page-messages-new-subject">Subject</label>
            <input type="text" class="form-control" id="page-messages-new-subject" name="subject">
        </div>

        <hr class="panel-wide-block">

        <div class="form-group">
            <label for="page-messages-new-subject">Message</label>
            <?php
            echo CKEditor::widget([
                'model' => $user,
                'name' => 'message',
                'editorOptions' => [
                    'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                    //
                //'filebrowserUploadUrl' => Yii::$app->getUrlManager()->createUrl('/site/test'),
                    'contentsLangDirection' => 'th',
                    'height' => 400,
                    //'filebrowserBrowseUrl' => 'browse-images',
                    //'filebrowserUploadUrl' => 'upload-images',
                    //'extraPlugins' => ['imageuploader', 'image2'],
                    'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
                ],
            ]);
            ?>
        </div>

        <hr class="panel-wide-block">

        <div class="text-md-right">
            <a href="<?= Yii::$app->homeUrl ?>mailstore/verify-email" class="btn btn-warning"> << Back</a>&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-primary">Send message</button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<!-- / Content -->

<script>
    // -------------------------------------------------------------------------
    // Initialize page components

</script>