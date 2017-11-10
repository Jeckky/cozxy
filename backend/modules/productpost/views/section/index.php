<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use common\models\costfit\Section;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sections';
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

        <a href="#" onclick="$('#create-section').show();
                $('#create-link').hide();
                $('#hide-link').show();" id="create-link" class="pull-right">
            <h4><i class="glyphicon glyphicon-plus"></i> Create New Section</h4>
        </a>
        <a href="#" onclick="$('#create-section').hide();
                $('#create-link').show();
                $('#hide-link').hide();" id="hide-link" style="display: none;" class="pull-right">
            <h4><i class="glyphicon glyphicon-minus"></i> Create New Section</h4>
        </a>

        <div id="create-section" style="display: none;">
            <?php
            $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data'],
                        'action' => ['section/create']
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
                <button type="submit" class="btn btn-success col-lg-12 col-md-12"><b>CREATE NEW SECTION</b></button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <?php
        Pjax::begin(['id' => 'employee-grid-view']);
        ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                ['attribute' => 'Description',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->description;
                    }
                ],
                ['attribute' => 'Image',
                    'format' => 'raw',
                    'value' => function ($model) {

                        return $model->image != null ? '<img src="' . Yii::$app->homeUrl . $model->image . '" style="width:100px;height:100px;">' : null;
                    }
                ],
                ['attribute' => 'Type',
                    'value' => function ($model) {
                        if ($model->type == Section::SECTION_TYPE_WEB) {
                            return "Web";
                        } else if ($model->type == Section::SECTION_TYPE_MOBILE) {
                            return "Mobile";
                        } else if ($model->type == Section::SECTION_TYPE_BOTH) {
                            return "Web & Mobile";
                        } else {
                            return null;
                        }
                    }
                ],
                ['attribute' => 'Show',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $check = $model->status == 1 ? 'checked' : '';
                        $onclick = "onclick='javascript:showSection(" . $model->sectionId . ")'";
                        $checkBox = '<input type="checkbox" id="checkStatus' . $model->sectionId . '"' . $check . ' ' . $onclick . '>';
                        return $checkBox;
                    }
                ],
                ['attribute' => 'Create Date',
                    'value' => function ($model) {
                        return $this->context->dateThai($model->createDateTime, 2, false); //2=ตัวย่อ false=ไม่แสดงเวลา
                    }
                ],
                ['attribute' => 'Sort',
                    'format' => 'raw',
                    'value' => function ($model) use($total) {
                        $minus = ' <a href="javascript:orderingSection(' . $model->sectionId . ',' . $total . ',0)" class="btn btn-warning" style="font-size: 14pt;">-</a>&nbsp;&nbsp;&nbsp;';
                        $sort = '<span id="orderingSection' . $model->sectionId . '" style="font-size: 14pt;">' . $model->sort . '</span>&nbsp;&nbsp;&nbsp;';
                        $plus = '<a href="javascript:orderingSection(' . $model->sectionId . ',' . $total . ',1)" class="btn btn-success"style="font-size: 14pt;">+</a>';
                        return $minus . " " . $sort . " " . $plus;
                    }
                ],
                ['attribute' => 'Actions',
                    'format' => 'raw',
                    'value' => function ($model) {

                        $edit = '<a href="' . Yii::$app->homeUrl . 'productpost/section/update?id=' . $model->sectionId . '" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i> Edit </a>';
                        $delete = '<a href="javascript:confirmDel(' . $model->sectionId . ')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete </a>';
                        $product = '<a href="' . Yii::$app->homeUrl . 'productpost/section/add-product?id=' . $model->sectionId . '" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Products </a>';
                        return $product . '&nbsp;&nbsp;&nbsp;' . $edit . '&nbsp;&nbsp;&nbsp;' . $delete;
                    }
                ],
            /* ['class' => 'yii\grid\ActionColumn',
              'header' => 'Actions',
              'template' => '{delete}',
              'buttons' => [
              'delete' => function($model) {

              }
              ]
              ], */
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>
