<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
?>

<?php
$formName = (isset($type) && $type == 1) ? "formBilling" : "formShipping";
if (isset($isUpdate)) {
    $formName.="Update";
}
?>
<?php
$form = ActiveForm::begin([
            'id' => 'default-shipping-address',
            'options' => ['class' => 'space-bottom'],
        ]);
?>
<div id="<?= $formName; ?>">
    <h3><?= (isset($type) && $type == 1) ? "Billing" : "Shipping" ?> address</h3>
    <div class="form-group">

        <?php
        // Top most parent
        echo $form->field($address, 'countryId')->widget(kartik\select2\Select2::classname(), [
            //'options' => ['id' => 'address-countryid'],
            'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'countryName'),
            'pluginOptions' => [
                'placeholder' => 'Select...',
                'loadingText' => 'Loading country ...',
            ],
            'options' => ['placeholder' => 'Select country ...'],
        ])->label('Country');
        ?>

        <label for="address_countryId">ประเทศ *</label>
        <div class="select-style">
            <?//= Html::dropDownList("Address[countryId]", isset($address->countryId) ? $address->countryId : "THA", ArrayHelper::map(common\models\dbworld\Countries::find()->all(), 'countryId', 'countryName'), ['disabled' => 'disabled']); ?>
        </div>
    </div>
    <?php echo \yii\bootstrap\Html::hiddenInput("Address[userId]", (!Yii::$app->user->isGuest) ? Yii::$app->user->id : 0); ?>

    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="co-first-name">ชื่อ *</label>
            <!--<input type="text" class="form-control input-sm" id="co-first-name" name="co-first-name" placeholder="First name" required>-->
            <?= Html::textInput("Address[firstname]", NULL, ["class" => "form-control input-sm", 'placeHolder' => 'First name']) ?>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="co-last-name">นามสกุล *</label>
            <!--<input type="text" class="form-control input-sm" id="co-last-name" name="co-last-name" placeholder="Last name" required>-->
            <?= Html::textInput("Address[lastname]", NULL, ["class" => "form-control input-sm", 'placeHolder' => 'Last name']) ?>
        </div>
    </div>
    <div class="form-group">
        <label for="co-company-name">บริษัท</label>
        <!--<input type="text" class="form-control input-sm" id="co-company-name" name="co-company-name" placeholder="Company name">-->
        <?= Html::textInput("Address[company]", NULL, ["class" => "form-control input-sm", 'placeHolder' => 'Company name']) ?>
    </div>
    <div class="form-group">
        <label for="co-str-adress">ที่อยู่ *</label>
        <!--<input type="text" class="form-control input-sm" id="co-str-adress" name="co-str-adress" placeholder="Street adress" required>-->
        <?= Html::textarea("Address[address]", NULL, ["class" => "form-control input-sm", 'rows' => 3, 'placeHolder' => 'Address']) ?>
    </div>
    <!--<div class="form-group">
        <label class="sr-only" for="co-appartment">Appartment</label>
        <input type="text" class="form-control input-sm" id="co-appartment" name="co-appartment" placeholder="Appartment" required>
    </div>-->
    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php
            // Child level 1
            echo $form->field($address, 'provinceId')->widget(DepDrop::classname(), [
                //'data' => [6 => 'Bank'],
                'options' => ['placeholder' => 'Select ...'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['address-countryid'],
                    'url' => Url::to(['child-states']),
                    'loadingText' => 'Loading province ...',
                ]
            ])->label('States');
            ?>
            <label for="co-city">จังหวัด *</label>
            <!--<input type="text" class="form-control input-sm" id="co-city" name="co-city" placeholder="Town/ city" required>-->
            <div class="select-style">
                <?//=
                kartik\select2\Select2::widget([
                'name' => 'Address[stateId]',
                'value' => NULL,
                'data' => ArrayHelper::map(common\models\dbworld\States::find()->where("countryId ='THA'")->all(), 'stateId', 'stateName'),
                'options' => ['multiple' => FALSE, //'placeholder' => 'Select states ...'
                'class' => (isset($type) && $type == 1) ? "stateBilling" : "stateShipping"
                ]
                ]);
                ?>
                <?//= Html::dropDownList("Address[stateId]", isset($address->countryId) ? $address->countryId : "THA", ArrayHelper::map(common\models\dbworld\States::find()->where("countryId ='THA'")->all(), 'stateId', 'stateName'), ['required' => 'required']); ?>
            </div>
        </div><div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php
            // Child level 2
            echo $form->field($address, 'amphurId')->widget(DepDrop::classname(), [
                //'data' => [9 => 'Savings'],
                'options' => ['placeholder' => 'Select ...'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['address-provinceid'],
                    'url' => Url::to(['child-amphur']),
                    'loadingText' => 'Loading amphur ...',
                ]
            ])->label('Cities');
            ?>
            <label for="co-city">อำเภอ *</label>
            <div class="select-style" id="<?= (isset($type) && $type == 1) ? "cityBillingDiv" : "cityShippingDiv" ?>">
                <?//=
                kartik\select2\Select2::widget([
                'name' => 'Address[cityId]',
                'value' => NULL,
                //                'data' => ArrayHelper::map(common\models\dbworld\Cities::find()->all(), 'cityId', 'cityName'),
                'options' => ['multiple' => FALSE, 'placeholder' => 'เลือกอำเภอ ...',
                'class' => (isset($type) && $type == 1) ? "cityBilling" : "cityShipping"
                ]
                ]);
                ?>
                <?//= Html::dropDownList("Address[amphurId]", isset($address->countryId) ? $address->countryId : "THA", ArrayHelper::map(common\models\dbworld\States::find()->where("countryId ='THA'")->all(), 'stateId', 'stateName'), ['required' => 'required']); ?>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <?php
            // Child level 3
            echo $form->field($address, 'districtId')->widget(DepDrop::classname(), [
                //'data' => [12 => 'Savings A/C 2'],
                'options' => ['placeholder' => 'Select ...'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['address-amphurid'],
                    //'initialize' => true,
                    //'initDepends' => ['address-countryid'],
                    'url' => Url::to(['child-district']),
                    'loadingText' => 'Loading district ...'
                ]
            ])->label('District');
            ?>
            <label for="co-state">ตำบล *</label>
            <!--<input type="text" class="form-control input-sm" id="co-state" name="co-state" placeholder="County/ state">-->
            <div class="select-style" id="<?= (isset($type) && $type == 1) ? "districtBillingDiv" : "districtShippingDiv" ?>">

                <? //=
                kartik\select2\Select2::widget([
                'name' => 'Address[districtId]',
                'value' => NULL,
                //                'data' => ArrayHelper::map(common\models\dbworld\District::find()->all(), 'districtId', 'districtName'),
                'options' => ['multiple' => FALSE, 'placeholder' => 'เลือกตำบล ...',
                'class' => (isset($type) && $type == 1) ? "districtBilling" : "districtShipping"
                ]
                ]);
                ?>
            </div>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="co_postcode">รหัสไปรษณีย์ *</label>
            <!--<input type="text" class="form-control input-sm" id="co_postcode" name="co_postcode" placeholder="Postcode/ ZIP">-->
            <?php echo $form->field($address, 'zipcode'); ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="co-email">อีเมล์ *</label>
            <!--<input type="email" class="form-control input-sm" id="co-email" name="co-email" placeholder="Email adress" required>-->
            <?= Html::textInput("Address[email]", NULL, ["class" => "form-control input-sm", 'placeHolder' => 'Email adress']) ?>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <label for="co_phone">โทร *</label>
            <!--<input type="text" class="form-control input-sm" id="co_phone" name="co_phone" placeholder="Phone number" required>-->
            <? //= Html::textInput("Address[tel]", NULL, ["class" => "form-control input-sm", 'placeHolder' => 'Phone number']) ?>
            <?php echo $form->field($address, 'tel'); ?>
        </div>
    </div>

    <?php
    if (isset($isUpdate)) {
        echo Html::a("Save", "#", ['class' => (isset($type) && $type == 1) ? "btn btn-success updateBillingSave" : "btn btn-success updateShippingSave"]);
        echo Html::a("Cancel", "#", ['class' => (isset($type) && $type == 1) ? "btn btn-danger updateBillingCancel" : "btn btn-danger updateShippingCancel"]);
    } else {
        echo Html::a("Save", "#", ['class' => (isset($type) && $type == 1) ? "btn btn-success createBillingSave" : "btn btn-success createShippingSave"]);
        echo Html::a("Cancel", "#", ['class' => (isset($type) && $type == 1) ? "btn btn-danger createBillingCancel" : "btn btn-danger createShippingCancel"]);
    }
    ?>
    <?php ActiveForm::end(); ?>
</div>



