<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
//php composer.phar require --prefer-dist leandrogehlen/yii2-treegrid "*"
//use leandrogehlen\treegrid\TreeGrid;
use leandrogehlen\treegrid\TreeGrid;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ViewLevels */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="view-levels-form">

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

        <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100])->label('ชื่อระดับการเข้าถึง') ?>

        <?= $form->field($model, 'desc', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6', 'maxlength' => 200])->label('คำอธิบาย') ?>
        <?//= $form->field($model, 'ordering', ['options' => ['class' => 'row form-group']])->textInput() ?>

        <?//= $form->field($model, 'rules', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 5120]) ?>

        <div class="col-lg-12">
            <div class="col-sm-2 ">&nbsp;</div>
            <div class="col-sm-7 " for="viewlevels-rules" style="font-weight: bold;">
                เลือกกลุ่มที่เข้าใช้งาน
            </div>
            <div class="col-lg-12"><br></div>
            <div class="col-sm-3 ">&nbsp;</div>
            <div class="col-sm-5 ">
                <?php
                if ($actions == 'update') {
                    echo TreeGrid::widget([
                        'dataProvider' => $listViewLevels,
                        'keyColumnName' => 'user_group_Id',
                        'parentColumnName' => 'parent_id',
                        'parentRootValue' => '0', //first parentId value
                        'pluginOptions' => [
                        //'initialState' => 'collapsed',
                        ],
                        'columns' => [
                            [
                                'attribute' => 'ชื่อกลุ่ม',
                                'format' => 'raw',
                                'value' => function($data, $key, $index, $column) {
                                    $getUserGroup = common\models\costfit\ViewLevels::find()->select('rules')->where('viewLevelsId =' . $_GET['id'])->one();
                                    $ListMenuGroup = str_replace('[', '', str_replace(']', '', $getUserGroup->rules));
                                    $test = explode(',', $ListMenuGroup);
                                    if (in_array($data->user_group_Id, $test)) {
                                        $checked = 'checked';
                                    } else {
                                        $checked = ' ';
                                    }
                                    //return '<input type="checkbox" id="user_group_Id[]" name="Menu[user_group_Id][]" class"px" value="' . $data->user_group_Id . '" ' . $checked . '/> &nbsp;' . $data->name;
                                    return '<input type="checkbox" name="ViewLevels[user_group_Id][]" value="' . $data->user_group_Id . '" ' . $checked . '/> &nbsp;' . $data->name;
                                },
                            ],
                        // 'name',
                        //'user_group_Id',
                        //'parent_id',
                        //['class' => 'yii\grid\ActionColumn']
                        ]
                    ]);
                } else {
                    echo TreeGrid::widget([
                        'dataProvider' => $listViewLevels,
                        'keyColumnName' => 'user_group_Id',
                        'parentColumnName' => 'parent_id',
                        'parentRootValue' => '0', //first parentId value
                        'pluginOptions' => [
                        //'initialState' => 'collapsed',
                        ],
                        'columns' => [
                            [
                                'attribute' => 'ชื่อกลุ่ม',
                                'format' => 'raw',
                                'value' => function($data, $key, $index, $column) {
                                    return '<input type="checkbox" name="ViewLevels[user_group_Id][]" value="' . $data->user_group_Id . '" /> &nbsp;' . $data->name;
                                },
                            ],
                        // 'name',
                        //'user_group_Id',
                        //'parent_id',
                        //['class' => 'yii\grid\ActionColumn']
                        ]
                    ]);
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
