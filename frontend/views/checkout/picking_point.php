<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

$form = ActiveForm::begin([
            'id' => 'default-shipping-address',
            'validateOnSubmit' => true,
            'options' => ['class' => "space-bottom"],
        ]);

$countryId = rand(0, 9999);
$stateId = rand(0, 9999);
$cityId = rand(0, 9999);
$districtId = rand(0, 9999);
?>

<div class=" col-lg-12 col-md-12 col-sm-12">
    <?php /*
      // Top most parent
      echo $form->field($address, 'provinceId')->widget(kartik\select2\Select2::classname(), [
      //'options' => ['id' => 'address-countryid'],
      'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'countryName'),
      'pluginOptions' => [
      'placeholder' => 'Select...',
      'loadingText' => 'Loading country ...',
      //'initialize' => true,
      ],
      'data' => ['THA' => 'ประเทศไทย'],
      'options' => [
      'placeholder' => 'Select country ...',
      'id' => $countryId,
      ],
      ])->label('ประเทศ'); */
    ?>
    <?php
    //echo Html::hiddenInput("countryDDId", $countryId, ['id' => "countryDDId"]);
    ?>
</div>

<div class="form-group col-lg-6 col-md-6 col-sm-6">
    <?php
// Child level 1

    echo $form->field($address, 'provinceId')->widget(kartik\select2\Select2::classname(), [
        'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId = 'THA'")->asArray()->all(), 'stateId', 'stateName'),
        'pluginOptions' => [
            'placeholder' => 'Select...',
            'loadingText' => 'Loading states ...',
        ],
        'options' => ['placeholder' => 'Select states ...'],
    ])->label('เลือกจังหวัด');
    ?>
    <?php
    echo Html::hiddenInput("statesDDId", $stateId, ['id' => "statesDDId"]);
    ?>
</div>

<div class="form-group col-lg-6 col-md-6 col-sm-6">
    <?php
    // Child level 2
    echo $form->field($address, 'amphurId')->widget(DepDrop::classname(), [
        //'data' => [9 => 'Savings'],
        'options' => ['placeholder' => 'Select ...'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'initialize' => true,
            'depends' => ['address-provinceid'],
            'url' => Url::to(['child-amphur-address']),
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
    test's.. picking point items DepDrop
</div>

<?php ActiveForm::end(); ?>