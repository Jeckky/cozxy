<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

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
            <?= $form->field($model, 'productGroupTemplateId')->dropDownList($productGroupTemplateFilter) ?>
            <hr>
            <div class="col-lg-12 col-md-12 col-sm-12" >
                <h4>*กรุณาสร้างไฟล์ Excel ที่มีคอลัมม์เรียงลำดับตามรูปแบบด้านล่าง</h4>
                <div class="col-lg-12 col-md-12 col-sm-12" id="templateColumn"style="height: 100px;border: #cccccc solid thin;padding-top: 20px;font-size: 11pt;">
                    <?php
                    if (isset($firstTemplate) && $firstTemplate != '') {
                        echo $firstTemplate;
                    }
                    ?>
                </div>

            </div>
            <div class="col-lg-12 col-md-12 col-sm-12" style="padding-top: 20px;font-size: 12pt;">
                <input class="btn btn-lg btn-warning" type="file" name="fileCsv[csv]" value="Upload" style="float: left;" required="true">
                <input type="hidden" name="fileCsv[csv]" value="">&nbsp;&nbsp;&nbsp;<b>Upload file .xls,csv : </b>
            </div>

<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>