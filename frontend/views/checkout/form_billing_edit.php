<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
?>
<style type="text/css">

</style>
<?php
$formName = (isset($type) && $type == 1) ? "formBilling" : "formShipping";
//echo $formName;
if (isset($isUpdate)) {
    $formName.="Update";
}

$form = ActiveForm::begin([
    'id' => 'default-shipping-address',
    'options' => ['class' => 'space-bottom'],
]);

$countryId = rand(0, 9999);
$stateId = rand(0, 9999);
$cityId = rand(0, 9999);
$districtId = rand(0, 9999);
?>
<div id="<?= $formName; ?>">
    <h3><?= (isset($type) && $type == 1) ? "Billing" : "Shipping" ?> address</h3>

    <div class="form-group">
        <?php
        echo '<label class="control-label">ประเทศ</label>';
        echo kartik\select2\Select2::widget([
            'name' => $countryId,
            'value' => ['THA'], // initial value
            'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'countryName'),
            'options' => ['placeholder' => 'Select country ...', 'id' => $countryId],
            'pluginOptions' => [
                'tags' => true,
                'placeholder' => 'Select...',
                'loadingText' => 'Loading country ...',
            ],
        ]);
        /*
          // echo '<pre>';
          //print_r(yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'countryName'));
          // Top most parent
          echo $form->field($address, 'countryId')->widget(kartik\select2\Select2::classname(), [
          //'options' => ['id' => 'address-countryid'],
          //'value' => 'THA', // initial value
          'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'countryName'),
          'pluginOptions' => [
          'placeholder' => 'Select...',
          'loadingText' => 'Loading country ...',
          'tags' => true,
          //'value' => 'Thailand',
          ],
          'options' => ['placeholder' => 'Select country ...', 'id' => $countryId],
          ])->label('ประเทศ'); */
        ?>
    </div>
    <?php
    echo Html::hiddenInput("Address[userId]", (!Yii::$app->user->isGuest) ? Yii::$app->user->id : 0);
    echo html::hiddenInput("Address[typeForm]", $formName);
    ?>

    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="co-first-name">ชื่อ *</label>
            <?= Html::textInput("Address[firstname]", NULL, ["class" => "form-control input-sm", 'placeHolder' => 'First name', 'id' => 'firstname']) ?>
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
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php
            // Child level 1
            echo $form->field($address, 'provinceId')->widget(DepDrop::classname(), [
                'data' => ['2524' => 'จังหวัดสมุทรปราการ   '],
                'options' => ['placeholder' => 'Select ...', 'id' => $stateId],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => [$countryId],
                    'url' => Url::to(['child-states']),
                    'loadingText' => 'Loading province ...',
                    'params' => ['2524' => 'จังหวัดสมุทรปราการ']
                ]
            ])->label('จังหวัด');
            ?>

        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php
            // Child level 2
            echo $form->field($address, 'amphurId')->widget(DepDrop::classname(), [
                //'data' => [9 => 'Savings'],
                'options' => ['placeholder' => 'Select ...', 'id' => $cityId],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => [$stateId],
                    'url' => Url::to(['child-amphur']),
                    'loadingText' => 'Loading amphur ...',
                ]
            ])->label('เขต/อำเภอ');
            ?>
        </div>

    </div>
    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php
            // Child level 3
            echo $form->field($address, 'districtId')->widget(DepDrop::classname(), [
                //'data' => [12 => 'Savings A/C 2'],
                'options' => ['placeholder' => 'Select ...', 'id' => $districtId],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => [$cityId],
                    'initialize' => true,
                    'initDepends' => [$countryId],
                    'url' => Url::to(['child-district']),
                    'loadingText' => 'Loading district ...',
                ]
            ])->label('แขวง/ตำบล');
            ?>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php echo $form->field($address, 'zipcode')->textInput(['class' => 'form-control input-sm', 'id' => 'zipcode'])->label('รหัสไปรษณีย์'); ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php echo $form->field($address, 'email')->textInput(['class' => 'form-control input-sm', 'id' => 'email'])->label('อีเมล์'); ?>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php echo $form->field($address, 'tel')->textInput(['class' => 'form-control input-sm', 'id' => 'tel'])->label('โทร'); ?>
        </div>
    </div>
    <?php
    if (isset($isUpdate)) {
        echo Html::submitButton('Save', ['class' => (isset($type) && $type == 1) ? "btn btn-success updateBillingSave" : "btn btn-success updateShippingSave", 'name' => 'btn-checkout-' . $formName]);
        //echo Html::a("Save", "#", ['id' => 'btn-checkout-' . $formName, 'name' => 'btn-checkout-' . $formName, 'class' => (isset($type) && $type == 1) ? "btn btn-success updateBillingSave" : "btn btn-success updateShippingSave"]);
        echo Html::a("Cancel", "#", ['class' => (isset($type) && $type == 1) ? "btn btn-danger updateBillingCancel" : "btn btn-danger updateShippingCancel"]);
    } else {
        echo Html::submitButton('Save', ['class' => (isset($type) && $type == 1) ? "btn btn-success createBillingSave" : "btn btn-success createShippingSave", 'name' => 'btn-checkout-' . $formName]);
        //echo Html::a("Save", "#", ['id' => 'btn-checkout-' . $formName, 'name' => 'btn-checkout-' . $formName, 'class' => (isset($type) && $type == 1) ? "btn btn-success createBillingSave" : "btn btn-success createShippingSave"]);
        echo Html::a("Cancel", "#", ['class' => (isset($type) && $type == 1) ? "btn btn-danger createBillingCancel" : "btn btn-danger createShippingCancel"]);
    }
    ?>
    <?php ActiveForm::end(); ?>
</div>



