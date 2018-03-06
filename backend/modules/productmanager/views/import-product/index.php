<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use kato\DropZone;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\productmanager\models\search\Product */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Import Products';
$this->params['breadcrumbs'][] = $this->title;
$disabled = (Yii::$app->controller->action->id == 'update' && $model->parentId !== null) ? true : false;
?>
<div class="product-index">
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;"><?= Html::encode($this->title) ?></h3></span>
        </div>

        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'options' => [
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data'
                        ],
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-9">{input}</div>',
                            'labelOptions' => [
                                'class' => 'col-sm-3 control-label'
                            ]
                        ]
            ]);
            ?>
            <?php // $form->field($model, 'productGroupTemplateId')->dropDownList($productGroupTemplateFilter) ?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-top: 20px;font-size: 12pt;">
                        <input class="btn btn-lg btn-warning" type="file" name="fileCsv[csv]" style="float: left;">
                        <input type="hidden" name="fileCsv[csv]">&nbsp;&nbsp;&nbsp;<b>Upload file .csv  </b>

                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-top: 50px;font-size: 12pt;">
                        <button type="submit" class="btn btn-success"><b>UPLOAD</b></button>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="panel-heading" style="margin-bottom: 20px;">
                        <span class="panel-title">สถานะการอัพโหลดไฟล์รูปภาพ</span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12" style="border: #cccccc solid thin;height: 284px;font-size: 12pt;padding: 15px;">
                        <?php if ((isset($message) && $message != '') || (isset($dupplicate) && $dupplicate != '')) { ?>
                            <div class="col-lg-12 col-md-12 col-sm-12" style="height: 250px;text-align: left;">
                                <span style="font-size: 12pt;">
                                    <?= isset($message) && $message != '' ? '<hr>' . $message . '<hr>' : '' ?>
                                </span>

                            </div>
                        <?php } else {
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12" style="height: 250px;text-align: center;padding-top: 80px;">
                                <h3>เลือกไฟล์ที่ต้องการอัพโหลดข้อมูล ...</h3>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>