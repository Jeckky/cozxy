<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use common\models\costfit\Section;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Update Sections';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #000;color: #ffcc33;">
        <div class="row">
            <div class="col-md-6" style="font-size: 20pt;"> <?= Html::encode($this->title) ?></div>
            <div class="col-md-6">
                <div class="btn-group pull-right">

                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $form = ActiveForm::begin([
                    'options' => ['enctype' => 'multipart/form-data'],
                    'action' => ['section/update?id=' . $model->sectionId]
        ]);
        ?>
        <div class="col-lg-12 col-md-12" style="border: #cccccc solid thin;margin-top: 10px;margin-bottom: 30px;padding: 15px;">
            <div class="col-lg-12 col-md-12">
                <?= $form->field($model, 'title')->textInput(['maxlength' => 200, 'require' => true]) ?>
            </div>

            <div class="col-lg-12 col-md-12">
                <?php
                echo $form->field($model, 'description')->widget(CKEditor::className(), [
                    'editorOptions' => [
                        // 'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                        'inline' => false, //по умолчанию false
                        'contentsLangDirection' => 'th',
                        'height' => 200,
                        'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
                    ],
                ]);
                ?>
            </div>
            <div class="col-lg-12 col-md-12 text-center">
                <div class="col-lg-12 col-md-12 text-center">
                    <hr>
                    <h4><b>Type</b></h4>
                    <br>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <input type="radio" name="Section[type]" value="1" required="true">&nbsp;&nbsp;&nbsp;<label>Web</label>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <input type="radio" name="Section[type]" value="2" required="true">&nbsp;&nbsp;&nbsp;<label>Mobile</label>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <input type="radio" name="Section[type]" value="3" required="true">&nbsp;&nbsp;&nbsp;<label>Web & Mobile</label>
                </div>
                <div class="col-lg-12 col-md-12 text-center">
                    <hr>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 text-center">
                <div class="col-lg-12 col-md-12 text-center">

                    <h4><b>Upload Image</b></h4>
                    <br>
                </div>
                <div class="col-lg-12 col-md-12 text-center" >
                    <div id="ImgPreview"></div>
                    <?= $form->field($model, 'image')->fileInput()->label('') ?>
                </div>
                <div class="col-lg-12 col-md-12 text-center">
                    <br>
                    <hr>
                </div>
            </div>
            <div class="col-lg-12 col-md-12" style="margin-bottom: 10px;">
                <b>Show</b>&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="Section[status]">
            </div>
            <button type="submit" class="btn btn-primary col-lg-12 col-md-12"><b>UPDATE SECTION</b></button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
