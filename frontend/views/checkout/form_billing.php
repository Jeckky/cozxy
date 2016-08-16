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
        border: 1px solid #03a9f4;
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
$formName = (isset($type) && $type == 1) ? "formBilling" : "formShipping";
//echo $formName;
if (isset($isUpdate)) {
    $formName.="Update";
}

$form = ActiveForm::begin([
            'id' => 'default-shipping-address',
            'validateOnSubmit' => true,
            'options' => ['class' => "space-bottom $formName"],
        ]);

$countryId = rand(0, 9999);
$stateId = rand(0, 9999);
$cityId = rand(0, 9999);
$districtId = rand(0, 9999);
?>
<div id="<?= $formName; ?>">
    <h3><?= (isset($type) && $type == 1) ? "Billing" : "Shipping" ?> address</h3>
    <div class="form-group">
        <div id="address-hidden" class="address-hidden"></div>
    </div>
    <div class="form-group form-group<?= (isset($type) && $type == 1) ? "-billing" : "-shipping" ?>">
        <?php
        /* echo '<label class="control-label">ประเทศ</label>';
          echo kartik\select2\Select2::widget([
          'name' => 'Address[countryId]',
          // 'value' => ['THA'], // initial value
          'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'countryName'),
          'options' => ['placeholder' => 'Select country ...', 'id' => $countryId],
          'pluginOptions' => [
          'tags' => true,
          'placeholder' => 'Select...',
          'loadingText' => 'Loading country ...',
          'initialize' => true,
          ],
          ]); */

        // echo '<pre>';
        //print_r(yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'countryName'));
        // Top most parent
        echo $form->field($address, 'countryId')->widget(kartik\select2\Select2::classname(), [
            //'options' => ['id' => 'address-countryid'],
            'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'countryName'),
            'pluginOptions' => [
                'placeholder' => 'Select...',
                'loadingText' => 'Loading country ...',
            //'initialize' => true,
            ],
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
    <?php
    echo Html::hiddenInput("Address[userId]", (!Yii::$app->user->isGuest) ? Yii::$app->user->id : 0);
    echo html::hiddenInput("Address[typeForm]", $formName);
    ?>

    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="co-first-name">ชื่อ *</label>
            <?= Html::textInput("Address[firstname]", NULL, ["class" => "form-control input-sm required", 'placeHolder' => 'First name', 'id' => 'firstname']) ?>
            <?php
//            echo $form->field($address, 'firstname')->textInput();
            ?>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="co-last-name">นามสกุล *</label>
            <?= Html::textInput("Address[lastname]", NULL, ["class" => "form-control input-sm", 'placeHolder' => 'Last name', 'id' => 'lastname']) ?>
        </div>
    </div>
    <div class="form-group">

        <label for="co-company-name">บริษัท</label>
        <?= Html::textInput("Address[company]", NULL, ["class" => "form-control input-sm", 'placeHolder' => 'Company name', 'id' => 'company']) ?>
    </div>
    <div class="form-group">
        <label for="co-str-adress">ที่อยู่ *</label>
        <?= Html::textarea("Address[address]", NULL, ["class" => "form-control input-sm", 'rows' => 3, 'placeHolder' => 'Address', 'id' => 'address']) ?>
    </div>

    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6 form-group<?= (isset($type) && $type == 1) ? "-billing" : "-shipping" ?>">
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
            ])->label('จังหวัด');
            ?>
            <?php
            echo Html::hiddenInput("statesDDId", $stateId, ['id' => "statesDDId"]);
            ?>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6 form-group<?= (isset($type) && $type == 1) ? "-billing" : "-shipping" ?>">
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
            ])->label('เขต/อำเภอ');
            ?>
            <?php
            echo Html::hiddenInput("amphurDDId", $cityId, ['id' => "amphurDDId"]);
            ?>
        </div>

    </div>
    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6 form-group<?= (isset($type) && $type == 1) ? "-billing" : "-shipping" ?>">
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
            ])->label('แขวง/ตำบล');
            ?>
            <?php
            echo Html::hiddenInput("districtDDId", $districtId, ['id' => "districtDDId"]);
            ?>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php echo $form->field($address, 'zipcode')->textInput(['class' => 'form-control input-sm', 'id' => 'zipcode'])->label('รหัสไปรษณีย์'); ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">

            <?//= Html::textInput("Address[email]", NULL, ["class" => "form-control input-sm", 'placeHolder' => 'Email adress', 'id' => 'email']) ?>
            <?php echo $form->field($address, 'email')->textInput(['class' => 'form-control input-sm', 'id' => 'email'])->label('อีเมล์'); ?>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php echo $form->field($address, 'tel')->textInput(['class' => 'form-control input-sm', 'id' => 'tel'])->label('โทร'); ?>
        </div>

    </div>

    <?php
    if (isset($isUpdate)) {
        echo Html::submitButton('Save', ['class' => (isset($type) && $type == 1) ? "btn btn-success updateBillingSave" : "btn btn-success updateShippingSave", 'name' => 'btn-checkout-' . $formName]);
//        echo Html::a("Save", "#", ['name' => 'btn-checkout-' . $formName, 'class' => (isset($type) && $type == 1) ? "btn btn-success updateBillingSave" : "btn btn-success updateShippingSave", 'onClick' => "$('#$formName').submit()"]);
        echo Html::a("Cancel", "#", ['class' => (isset($type) && $type == 1) ? "btn btn-danger updateBillingCancel" : "btn btn-danger updateShippingCancel"]);
    } else {
        echo Html::submitButton('Save', ['class' => (isset($type) && $type == 1) ? "btn btn-success createBillingSave" : "btn btn-success createShippingSave", 'name' => 'btn-checkout-' . $formName]);
        //echo Html::a("Save", "#", ['id' => 'btn-checkout-' . $formName, 'name' => 'btn-checkout-' . $formName, 'class' => (isset($type) && $type == 1) ? "btn btn-success createBillingSave" : "btn btn-success createShippingSave"]);
        echo Html::a("Cancel", "#", ['class' => (isset($type) && $type == 1) ? "btn btn-danger createBillingCancel" : "btn btn-danger createShippingCancel"]);
    }
    ?>
    <?php ActiveForm::end(); ?>
</div>



