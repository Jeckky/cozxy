<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
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
    <?php
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
    ])->label('ประเทศ');
    ?>
    <?php
    echo Html::hiddenInput("countryDDId", $countryId, ['id' => "countryDDId"]);
    ?>
</div>

<div class="form-group col-lg-6 col-md-6 col-sm-6">
    <?php
    // Child level 1
    //echo Html::hiddenInput('model_id1', '2526', ['id' => 'model_id1']);
    echo $form->field($address, 'provinceId')->widget(DepDrop::classname(), [
        // 'data' => [2526 => 'จังหวัดปทุมธานี'], // ensure at least the preselected value is available
        'options' => ['placeholder' => 'Select ...', 'id' => $stateId],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        //'pluginEvents' => [
        //  'change' => 'function() { $("#' . $stateId . '").trigger("change"); }',
        //],
        'pluginOptions' => [
            'depends' => [$countryId],
            'url' => Url::to(['child-states']),
            'loadingText' => 'Loading province ...',
            //'tags' => '2526',
            'initialize' => true,
        //'params' => ['model_id1']
        ]
    ])->label('จังหวัด');
    ?>
    <?php
    echo Html::hiddenInput("statesDDId", $stateId, ['id' => "statesDDId"]);
    ?>
</div>

<div class="form-group col-lg-6 col-md-6 col-sm-6">
    <?php
    // Child level 2
    //echo Html::hiddenInput('model_id2', '79745', ['id' => 'model_id2']);
    echo $form->field($address, 'amphurId')->widget(DepDrop::classname(), [
        //'data' => [79683 => 'เขตพระโขนง'], // ensure at least the preselected value is available
        'options' => ['placeholder' => 'Select ...', 'id' => $cityId],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => [$stateId],
            'url' => Url::to(['child-amphur']),
            'loadingText' => 'Loading amphur ...',
            'initialize' => true,
        ]
    ])->label('เขต/อำเภอ');
    ?>
    <?php
    echo Html::hiddenInput("amphurDDId", $cityId, ['id' => "amphurDDId"]);
    ?>
</div>



<?php ActiveForm::end(); ?>