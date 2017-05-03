<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
?>
<style type="text/css">
    .selection{
        display: block;
        width: 100%;
        /*height: 46px;*/
        padding: 6px 12px;
        font-size: 1em;
        font-weight: 300;
        line-height: 1.42857143;
        color: #292c2e;
        background: transparent;
        border: 1px solid rgba(255,212,36,.9);
        border-radius: 0;
        box-shadow: none;

    }
    .select2-container--krajee .select2-selection{
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        background-color: #fff;
        /* border: 1px solid #ccc;*/
        border-radius: 4px;
        color: #555555;
        font-size: 14px;
        outline: 0;
        border: none;
        border-color: transparent;
    }
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        /*height: 28px;*/
        user-select: none;
        -webkit-user-select: none;
    }
    .select2-container--krajee .select2-selection {
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        background-color: #fff;
        border: 0px solid rgba(204, 204, 204, 0);
        border-radius: 0px;
        color: #555555;
        font-size: 14px;
        outline: 0;
    }
    .select2-container--krajee .select2-selection--single .select2-selection__arrow {
        border: none;
        /* border-left: 1px solid #aaa; */
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
        position: absolute;
        height: 32px;
        top: 6px;
        right: -2px;
        width: 20px;
    }
    .select2-container--krajee.select2-container--disabled .select2-selection, .select2-container--krajee.select2-container--disabled .select2-selection--multiple .select2-selection__choice {
        background-color: #f5f5f5;
    }
    .select2-container--krajee .select2-selection--single .select2-selection__rendered {
        color: #000;
        padding: 0;
    }
    .select2-container--krajee .select2-selection--single .select2-selection__placeholder {
        color: #000;
    }
    .select2-container--krajee .select2-dropdown {
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        border-color: #66afe9;
        overflow-x: hidden;
        margin-top: -1px;
        padding: 15px;
    }
</style>
<?php
//$formName = (isset($type) && $type == 1) ? "formBilling" : "formShipping";
//echo $formName;
//if (isset($isUpdate)) {
//$formName.="Update";
//}
//<form id="checkout-form" method="post" novalidate="novalidate">
$form = ActiveForm::begin([
    'id' => 'checkout-form',
    'validateOnSubmit' => true,
    'options' => ['class' => "space-bottom formBilling"],
]);

$countryId = rand(0, 9999);
$stateId = rand(0, 9999);
$cityId = rand(0, 9999);
$districtId = rand(0, 9999);
$zipcodeId = rand(0, 9999);
?>
<div id="formBilling">
    <h3>Billing address</h3>
    <div class="form-group">
        <div id="address-hidden" class="address-hidden"></div>
    </div>
    <div class="form-group form-group-billing">
        <?php
        // echo '<pre>';
        //print_r(yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'countryName'));
        // Top most parent
        echo $form->field($address, 'countryId')->widget(kartik\select2\Select2::classname(), [
            'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->where("countryId='THA'")->asArray()->all(), 'countryId', 'localName'),
            'pluginOptions' => [
                // 'placeholder' => 'Select...',
                'loadingText' => 'Loading country ...',
            //'data' => ['THA' => 'ไทย'],
            //'initialize' => true,
            ],
            'options' => [
                //'placeholder' => 'Select country ...',
                'id' => $countryId,
                'class' => 'required'
            ],
        ])->label('Country');
        ?>
        <?php
        echo Html::hiddenInput("countryDDId", $countryId, ['id' => "countryDDId"]);
        ?>
    </div>
    <?php
    echo Html::hiddenInput("Address[userId]", (!Yii::$app->user->isGuest) ? Yii::$app->user->id : 0);
    echo html::hiddenInput("Address[typeForm]", 'formBilling');
    ?>
    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="co-first-name">Firstname *</label>
            <?= Html::textInput("Address[firstname]", NULL, ["class" => "form-control input-sm required", 'placeHolder' => 'First name', 'id' => 'firstname']) ?>
            <?php
//            echo $form->field($address, 'firstname')->textInput();
            ?>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="co-last-name">Lastname *</label>
            <?= Html::textInput("Address[lastname]", NULL, ["class" => "form-control input-sm required", 'placeHolder' => 'Last name', 'id' => 'lastname']) ?>
        </div>
    </div>
    <div class="form-group">
        <label for="co-company-name">Company</label>
        <?= Html::textInput("Address[company]", NULL, ["class" => "form-control input-sm required", 'placeHolder' => 'Company name', 'id' => 'company']) ?>
    </div>
    <div class="form-group">
        <label for="co-str-adress">Address *</label>
        <?= Html::textarea("Address[address]", NULL, ["class" => "form-control input-sm required", 'rows' => 3, 'placeHolder' => 'Address', 'id' => 'address']) ?>
    </div>

    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6 form-group-billing">
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
                // 'tags' => '2526',
                //'initialize' => true,
                //'params' => ['model_id1']
                ]
            ])->label('Province');
            ?>
            <?php
            echo Html::hiddenInput("statesDDId", $stateId, ['id' => "statesDDId"]);
            ?>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6 form-group-billing">
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
                //'initialize' => true,
                ]
            ])->label('Amphur');
            ?>
            <?php
            echo Html::hiddenInput("amphurDDId", $cityId, ['id' => "amphurDDId"]);
            ?>
        </div>

    </div>
    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6 form-group-billing">
            <?php
            // Child level 3
            //echo Html::hiddenInput('model_id3', '395', ['id' => 'model_id3']);
            echo $form->field($address, 'districtId')->widget(DepDrop::classname(), [
                //'data' => [12 => 'Savings A/C 2'],
                'options' => ['placeholder' => 'Select ...', 'id' => $districtId],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => [$cityId],
                    //'initialize' => true,
                    //'initDepends' => ['address-countryid'],
                    'url' => Url::to(['child-district']),
                    'loadingText' => 'Loading district ...',
                //'initialize' => true,
                ]
            ])->label('District');
            ?>
            <?php
            echo Html::hiddenInput("districtDDId", $districtId, ['id' => "districtDDId"]);
            ?>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php
            // echo $form->field($address, 'zipcode')->textInput(['class' => 'form-control input-sm required', 'id' => 'zipcode'])->label('รหัสไปรษณีย์');
            echo Html::hiddenInput('input-type-14', $districtId, ['id' => 'input-type-14']);
            echo $form->field($address, 'zipcode')->widget(DepDrop::classname(), [
                //'data' => [12 => 'Savings A/C 2'],
                'options' => ['placeholder' => 'Select ...', 'id' => $zipcodeId],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => [$districtId],
                    //'initialize' => true,
                    //'initDepends' => ['address-countryid'],
                    'url' => Url::to(['child-zipcode-address']),
                    'loadingText' => 'Loading zipcode ...',
//                    'params' => ['input-type-14']
                ]
            ])->label('Zipcode');
            ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">

            <?//= Html::textInput("Address[email]", NULL, ["class" => "form-control input-sm", 'placeHolder' => 'Email adress', 'id' => 'email']) ?>
            <?php echo $form->field($address, 'email')->textInput(['class' => 'form-control input-sm required', 'id' => 'email'])->label('Email'); ?>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php echo $form->field($address, 'tel')->textInput(['class' => 'form-control input-sm required', 'id' => 'tel'])->label('Tel'); ?>
        </div>

    </div>

    <?php
    if (isset($isUpdate)) {
        echo Html::submitButton('Save', ['class' => (isset($type) && $type == 1) ? "btn btn-success updateBillingSave" : "btn btn-success updateShippingSave", 'name' => 'btn-checkoutformBilling']);
//        echo Html::a("Save", "#", ['name' => 'btn-checkout-' . $formName, 'class' => (isset($type) && $type == 1) ? "btn btn-success updateBillingSave" : "btn btn-success updateShippingSave", 'onClick' => "$('#$formName').submit()"]);
        echo Html::a("Cancel", "#", ['class' => (isset($type) && $type == 1) ? "btn btn-danger updateBillingCancel" : "btn btn-danger updateShippingCancel"]);
    } else {
        echo Html::submitButton('Save', ['class' => (isset($type) && $type == 1) ? "btn btn-success createBillingSave" : "btn btn-success createShippingSave", 'name' => 'btn-checkoutformBilling']);
        //echo Html::a("Save", "#", ['id' => 'btn-checkout-' . $formName, 'name' => 'btn-checkout-' . $formName, 'class' => (isset($type) && $type == 1) ? "btn btn-success createBillingSave" : "btn btn-success createShippingSave"]);
        echo Html::a("Cancel", "#", ['class' => (isset($type) && $type == 1) ? "btn btn-danger createBillingCancel" : "btn btn-danger createShippingCancel"]);
    }
    ?>
    <?php ActiveForm::end(); ?>
</div>



