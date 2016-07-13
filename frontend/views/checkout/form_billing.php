<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<?php
$formName = (isset($type) && $type == 1) ? "formBilling" : "formShipping";
if (isset($isUpdate)) {
    $formName.="Update";
}
$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data', 'id' => $formName],
    'fieldConfig' => [
//        'template' => '{label}<div class="col-sm-9">{input}</div>',
        'labelOptions' => [
//            'class' => 'col-sm-3 control-label'
        ]
    ]
]);
?>
<h3><?= (isset($type) && $type == 1) ? "Billing" : "Shipping" ?> address</h3>
<div class="form-group">
    <label for="address_countryId">Country *</label>
    <div class="select-style">
<!--        <select name="co-country input-sm" id="co-country">
            <option>Australia</option>
            <option>Belgium</option>
            <option>Germany</option>
            <option>United Kingdom</option>
            <option>Switzerland</option>
            <option>USA</option>
        </select>-->
        <?= Html::dropDownList("Address[countryId]", isset($address->countryId) ? $address->countryId : "THA", ArrayHelper::map(common\models\dbworld\Countries::find()->all(), 'countryId', 'countryName')); ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-6 col-md-6 col-sm-6">
        <label for="co-first-name">First Name *</label>
        <input type="text" class="form-control input-sm" id="co-first-name" name="co-first-name" placeholder="First name" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-sm-6">
        <label for="co-last-name">Last Name *</label>
        <input type="text" class="form-control input-sm" id="co-last-name" name="co-last-name" placeholder="Last name" required>
    </div>
</div>
<div class="form-group">
    <label for="co-company-name">Company name</label>
    <input type="text" class="form-control input-sm" id="co-company-name" name="co-company-name" placeholder="Company name">
</div>
<div class="form-group">
    <label for="co-str-adress">Adress *</label>
    <input type="text" class="form-control input-sm" id="co-str-adress" name="co-str-adress" placeholder="Street adress" required>
</div>
<div class="form-group">
    <label class="sr-only" for="co-appartment">Appartment</label>
    <input type="text" class="form-control input-sm" id="co-appartment" name="co-appartment" placeholder="Appartment" required>
</div>
<div class="form-group">
    <label for="co-city">Town/ city *</label>
    <input type="text" class="form-control input-sm" id="co-city" name="co-city" placeholder="Town/ city" required>
</div>
<div class="row">
    <div class="form-group col-lg-6 col-md-6 col-sm-6">
        <label for="co-state">County/ state</label>
        <input type="text" class="form-control input-sm" id="co-state" name="co-state" placeholder="County/ state">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-sm-6">
        <label for="co_postcode">Postcode *</label>
        <input type="text" class="form-control input-sm" id="co_postcode" name="co_postcode" placeholder="Postcode/ ZIP" required>
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-6 col-md-6 col-sm-6">
        <label for="co-email">Email *</label>
        <input type="email" class="form-control input-sm" id="co-email" name="co-email" placeholder="Email adress" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-sm-6">
        <label for="co_phone">Phone *</label>
        <input type="text" class="form-control input-sm" id="co_phone" name="co_phone" placeholder="Phone number" required>
    </div>
</div>

<?php
if (isset($isUpdate)) {
    echo Html::submitButton("Save", ['class' => (isset($type) && $type == 1) ? "btn btn-success updateBillingSave" : "btn btn-success updateShippingSave"]);
    echo Html::a("Cancel", "", ['class' => (isset($type) && $type == 1) ? "btn btn-danger updateBillingCancel" : "btn btn-danger updateShippingCancel"]);
}
?>

<?php ActiveForm::end(); ?>

