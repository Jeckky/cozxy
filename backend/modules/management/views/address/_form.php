<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\costfit;
use yii\jui\DatePicker;
use common\models\costfit\User;
use common\models\costfit\Country;
use common\models\costfit\Province;
use common\models\costfit\Amphur;
use common\models\costfit\District;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

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

        <?= $form->field($model, 'company', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'tax', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]) ?>

        <?= $form->field($model, 'address', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => true])->textArea(['rows' => '6']) ?>

        <?php
        $catList = yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId = 'THA'")->asArray()->all(), 'stateId', 'stateName');
        echo $form->field($model, 'provinceId')->dropDownList($catList, ['id' => 'cat-id']);

        // Child level 2
        echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
            'options' => ['id' => 'subcat-id'],
            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
            'pluginOptions' => [
                'initialize' => true,
                'depends' => ['cat-id'],
                'placeholder' => 'Select...',
                'url' => Url::to(['child-amphur-address'])
            ]
        ]);

        // Child level 3
        echo $form->field($model, 'districtId')->widget(DepDrop::classname(), [
            'options' => ['id' => 'subsubcat-id'],
            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
            'pluginOptions' => [
                'initialize' => true,
                'depends' => ['subcat-id'],
                'placeholder' => 'Select...',
                'url' => Url::to(['child-district-address'])
            ]
        ]);
        ?>

        <?= $form->field($model, 'zipcode', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 10]) ?>

        <?= $form->field($model, 'fax', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 45]) ?>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<?php $this->registerJs("
           init.push(function () {
            if (!$('html').hasClass('ie8')) {
                $('#pickingpoint-address').summernote({
                    height: 200,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
            }
        });

", \yii\web\View::POS_END); ?>