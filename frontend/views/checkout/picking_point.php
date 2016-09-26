<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* $form = ActiveForm::begin([
  'id' => 'checkout-form-picking',
  //'validateOnSubmit' => true,
  'options' => ['class' => "space-bottom"],
  ]);
 */
$form = ActiveForm::begin(['action' => '#', 'id' => 'checkout-form-picking', 'method' => '', 'options' => ['class' => "space-bottom"]]);
$countryId = rand(0, 9999);
$stateId = rand(0, 9999);
$cityId = rand(0, 9999);
$districtId = rand(0, 9999);
$pickingId = rand(0, 9999);
?>
<style type="text/css">
    .main-title-picking-point{
        height: 80px;
    }
    .main-list-picking-point{
        height: 185px;
        overflow-y: auto;
    }
    .main-list-picking-point-detail{
        height: 102px;
        overflow-y: auto;
    }
</style>

<div class="form-group col-lg-12 col-md-12 col-sm-12">
    <!--<br>
    <a class="panel-toggle" href="#PickingPoint"><i></i>New Picking Point</a>
    -->
</div>
<div class="form-group col-lg-6 col-md-6 col-sm-6">
    <?php
// Child level 1
// Additional input fields passed as params to the child dropdown's pluginOptions
// echo Html::hiddenInput('input-type-1', $pickingPoint->provinceId, ['id' => 'input-type-1']);
// echo Html::hiddenInput('input-type-2', $pickingPoint->provinceId, ['id' => 'input-type-2']);
    echo $form->field($pickingPoint, 'provinceId')->widget(kartik\select2\Select2::classname(), [
        'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId = 'THA'")->asArray()->all(), 'stateId', 'stateName'),
        'pluginOptions' => [
            'placeholder' => 'Select...',
            'loadingText' => 'Loading states ...',
        ],
        'options' => ['placeholder' => 'Select states ...']
    ])->label('เลือกจังหวัด');
    ?>
    <?php
    echo Html::hiddenInput("statesDDId", $stateId, ['id' => "statesDDId"]);
    ?>
</div>

<div class="form-group col-lg-6 col-md-6 col-sm-6">
    <?php
// Child level 2
//echo Html::hiddenInput('input-type-11', $pickingPoint->amphurId, ['id' => 'input-type-11']);
//echo Html::hiddenInput('input-type-22', $pickingPoint->amphurId, ['id' => 'input-type-22']);
    echo $form->field($pickingPoint, 'amphurId')->widget(kartik\depdrop\DepDrop::classname(), [
        //'data' => [9 => 'Savings'],
        'options' => ['placeholder' => 'Select ...'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'class' => 'required',
            'initialize' => true,
            'depends' => ['pickingpoint-provinceid'],
            'url' => Url::to(['child-amphur-address-picking-point']),
            'loadingText' => 'Loading amphur ...',
            'params' => ['input-type-11', 'input-type-22']
        ]
    ])->label('เลือกอำเภอ/เขต');
    ?>
    <?php
    echo Html::hiddenInput("amphurDDId", $cityId, ['id' => "amphurDDId"]);
    ?>
</div>

<div class="form-group col-lg-6 col-md-6 col-sm-6">
    <?php
// Child level 3
    echo Html::hiddenInput('input-type-13', $pickingPoint->provinceId, ['id' => 'input-type-13']);
    echo Html::hiddenInput('input-type-23', $pickingPoint->amphurId, ['id' => 'input-type-23']);
    echo $form->field($pickingPoint, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
        //'data' => [9 => 'Savings'],
        'options' => ['placeholder' => 'Select ...'],
        'type' => DepDrop::TYPE_SELECT2,
        //'options' => ['multiple' => true],
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'initialize' => true,
            'depends' => ['pickingpoint-amphurid'],
            'url' => Url::to(['child-picking-point']),
            'loadingText' => 'Loading picking point ...',
            'params' => ['input-type-13', 'input-type-23']
        ]
    ])->label('เลือกจุดรับของ');
    ?>
    <?php
    echo Html::hiddenInput("pickingDDId", $pickingId, ['id' => "pickingDDId"]);
    ?>
</div>
<div class="form-group col-lg-12 col-md-12 col-sm-12">
    <?php
    //echo Html::submitButton('Save', ['class' => "btn btn-success createPickingSave", 'name' => 'btn-createPickingSave']);
    //echo Html::a("Cancel", "#", ['class' => "btn btn-danger createPickingCancel"]);
    ?>
</div>

<?php ActiveForm::end(); ?>