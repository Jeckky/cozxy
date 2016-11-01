<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\costfit\Menu;
use common\models\costfit\Level;

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

        <?= $form->field($model, 'name', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 50]) ?>

        <?= $form->field($model, 'link', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>


        <?//= $form->field($model, 'parent', ['options' => ['class' => 'row form-group']])->dropDownList(ArrayHelper::map(Menu::find()->all(), 'menuId', 'name'), ['prompt' => '-- Select Parent --']) ?>

        <?php
        echo $form->field($model, 'parents')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(Menu::find()->all(), 'menuId', 'name'),
            'pluginOptions' => [
                'loadingText' => '-- Select Parent --',
            ],
            'options' => [
                'id' => 'parents',
                'class' => 'required'
            ],
        ])->label('Parent');

        //http://demos.krajee.com/widget-details/select2
        $datav = [
            "red" => "red",
            "green" => "green",
            "blue" => "blue",
            "orange" => "orange",
            "white" => "white",
            "black" => "black",
            "purple" => "purple",
            "cyan" => "cyan",
            "teal" => "teal"
        ];
        if (isset($_GET['id'])) {
            $datas = \common\models\costfit\Menu::find()->where('menuId=' . $_GET['id'])->one();
            $data = \common\models\costfit\Level::find()->select('GROUP_CONCAT(name) as name')->where('levelId in (' . $datas['levelId'] . ')')->one();

            $datax = yii\helpers\ArrayHelper::map(\common\models\costfit\Level::find()->asArray()->all(), 'levelId', 'name');
        } else {
            $datax = yii\helpers\ArrayHelper::map(\common\models\costfit\Level::find()->asArray()->all(), 'levelId', 'name');
        }

        echo $form->field($model, 'levelId')->widget(Select2::classname(), [
            'value' => ['admin', ''], // initial value
            'data' => $datax,
            'maintainOrder' => true,
            'pluginOptions' => [
                'loadingText' => 'Loading level ...',
                'tags' => true,
                'maximumInputLength' => 10
            ],
            'options' => [
                //'placeholder' => 'Select level ...',
                'id' => 'level',
                'class' => 'required',
                'multiple' => true
            ],
        ])->label('Level');

        $data = [
            "red" => "red",
            "green" => "green",
            "blue" => "blue",
            "orange" => "orange",
            "white" => "white",
            "black" => "black",
            "purple" => "purple",
            "cyan" => "cyan",
            "teal" => "teal"
        ];
        echo '<label class="control-label">Test Tag Multiple</label>';
        echo Select2::widget([
            'name' => 'color_2a',
            'value' => ['teal', 'green', 'red'], // initial value (will be ordered accordingly and pushed to the top)
            'data' => $data,
            'maintainOrder' => true,
            'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);
        ?>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
