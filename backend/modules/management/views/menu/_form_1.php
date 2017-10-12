<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\Menu;
use common\models\costfit\Level;
use leandrogehlen\treegrid\TreeGrid;
/* @var $this yii\web\View */
/* @var $model common\models\costfit\Menu */
/* @var $form yii\widgets\ActiveForm */
//use kartik\widgets\DepDrop;
//use kartik\widgets\Select2;
//use kartik\select2\Select2;
//use kartik\depdrop\DepDrop;
use kartik\widgets\Select2;
?>
<div class="menu-form">

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

        <?= $form->field($model, 'name', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 50])->label('ชื่อเมนู') ?>

        <?= $form->field($model, 'link', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'desc', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6', 'maxlength' => 200])->label('คำอธิบาย') ?>

        <?//= $form->field($model, 'parent', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Menu::find()->all(), 'menuId', 'name'), ['prompt' => '-- Select Parent --']) ?>

        <?php
        echo $form->field($model, 'parent_id')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(Menu::find()->all(), 'menuId', 'name'),
            'pluginOptions' => [
                'loadingText' => '-- Select Parent --',
            ],
            'options' => [
                'placeholder' => 'Select parent ...',
                'id' => 'parents',
                'class' => 'required'
            ],
        ])->label('Parent');

        //http://demos.krajee.com/widget-details/select2
        ?>

        <div class="col-sm-2 ">&nbsp;</div>
        <div class="col-sm-7 " for="viewlevels-rules" style="font-weight: bold;">
            เลือกกลุ่มที่เข้าใช้งาน
        </div>
        <div class="col-lg-12"><br></div>
        <div class="col-sm-3 ">&nbsp;</div>
        <div class="col-sm-5 ">
            <?php
            //echo $actions;
            //exit();
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
                            'attribute' => 'Name',
                            'format' => 'raw',
                            'value' => function($data, $key, $index, $column) {
                                $getUserGroup = common\models\costfit\Menu::find()->select('user_group_Id')->where('menuId =' . $_GET['id'])->one();
                                $ListMenuGroup = str_replace('[', '', str_replace(']', '', $getUserGroup->user_group_Id));
                                $test = explode(',', $ListMenuGroup);
                                if (in_array($data->user_group_Id, $test)) {
                                    $checked = 'checked';
                                } else {
                                    $checked = ' ';
                                }
                                return '<input type="checkbox" id="user_group_Id[]" name="Menu[user_group_Id][]" class"px" value="' . $data->user_group_Id . '" ' . $checked . '/> &nbsp;' . $data->name;
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
                            'attribute' => 'Name',
                            'format' => 'raw',
                            'value' => function($data, $key, $index, $column) {
                                return '<input type="checkbox" id="user_group_Id[]" name="Menu[user_group_Id][]" class"px" value="' . $data->user_group_Id . '" /> &nbsp;' . $data->name;
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

