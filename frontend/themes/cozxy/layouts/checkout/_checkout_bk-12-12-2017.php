<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

$this->title = 'YOUR SHIPPING & BILLING ADDRESS';
$this->params['breadcrumbs'][] = $this->title;
\frontend\assets\CheckoutAsset::register($this);
$pickingId = rand(0, 9999);
?>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <?php
        $form = ActiveForm::begin([
                    'id' => 'default-shipping-address',
                    'action' => Yii::$app->homeUrl . 'checkout/summary',
                    'options' => ['class' => 'space-bottom'],
                    'enableClientValidation' => false,
        ]);
        ?>
        <!-- Cart -->
        <div class="col-lg-9 col-md-8 cart-body">
            <div class="row">
                <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
                    <p class="size20 size18-xs">YOUR SHIPPING & BILLING ADDRESS</p>
                </div>
                <div class="col-xs-12 bg-white">

                    <div class="cart-detail">
                        <div class="row">
                            <div class="col-lg-12">
                                Choose shipping type : &nbsp; &nbsp; &nbsp;
                                <?= Html::radio('shipping', ((isset($order->pickingId) && !empty($order->pickingId)) || !isset($order->shippingFirstname)) ? true : false, ['value' => 1, 'class' => 'shippingOption']) ?>
                                Ship to CozxyBox
                                <!--   <a href="chk-edit1.php" class="pull-right btn-g999 p-edit">Edit</a></div><div class="col-xs-12 size6">&nbsp;-->
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <?= Html::radio('shipping', (isset($order->shippingFirstname) && !isset($order->pickingId)) ? true : false, ['value' => 2, 'class' => 'shippingOption']) ?>
                                Ship to address
                            </div>
                            <div class="col-lg-12">
                                &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp;&nbsp; &nbsp; &nbsp;  &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;  &nbsp;&nbsp; &nbsp; &nbsp;  &nbsp;&nbsp; &nbsp; &nbsp;
                                <a href="" data-toggle="modal" data-target="#LockerModal" style="font-size: 12px;"><u>What's this?</u></a>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping -->
                    <div class="cart-detail" id="shipToCozxyBox">
                        <div class="col-lg-12" style="padding-left:0px;">
                            <h3>Ship to CozxyBox <span class="small"><a href="<?= Url::to(['/checkout/ship-to-cozxy-box']) ?>" target="_blank">view all</a></span></h3>
                        </div>
                        <div class="col-lg-12" style="margin-top: -10px;">
                            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                        </div>

                        <div class="row fc-g999">
                            <div class="col-md-4 col-xs-12">

                                <?php
                                $a = "ssssss";
                                echo $form->field($pickingPoint, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                                    //'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->asArray()->all(), 'stateId', 'localName'),
                                    //'data' => \common\models\costfit\PickingPoint::availableProvince(),
                                    'data' => yii\helpers\ArrayHelper::map(common\models\costfit\PickingPoint::availableProvince(), 'stateId', function($stateId) {
                                                return \common\models\costfit\PickingPoint::provinceName($stateId);
                                            }),
                                    'hideSearch' => true,
                                    'pluginOptions' => [
                                        'placeholder' => 'Select Province',
                                        'loadingText' => 'Loading Province ...',
                                        'allowClear' => true
                                    ],
                                    'options' => ['placeholder' => 'Select Province ...',
                                        'name' => 'provinceId', 'id' => 'stateId'],
                                ])->label(FALSE);
                                ?>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?php
                                ///throw new \yii\base\Exception(1111);
                                echo Html::hiddenInput('input-type-11', $pickingPoint->amphurId, ['id' => 'input-type-11']);
                                echo Html::hiddenInput('input-type-22', $pickingPoint->amphurId, ['id' => 'input-type-22']);
                                if (isset($pickingPoint->amphurId)) {
                                    //echo 'edit';
                                    echo Html::hiddenInput('input-type-33', 'edit', ['id' => 'input-type-33']);
                                } else {
                                    //echo 'add';
                                    echo Html::hiddenInput('input-type-33', 'add', ['id' => 'input-type-33']);
                                }

                                echo $form->field($pickingPoint, 'amphurId')->widget(DepDrop::classname(), [
                                    //'data' => isset($pickingPoint->amphurId) ? [$pickingPoint->amphurId => $pickingPoint->citie->localName . '/' . $pickingPoint->citie->cityName] : [],
                                    'options' => ['placeholder' => 'Select ...', 'name' => 'amphurId', 'id' => 'amphurId'],
                                    'type' => DepDrop::TYPE_DEFAULT,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        'depends' => ['stateId'],
                                        'url' => Url::to(['child-amphur-address-picking-point-checkouts']),
                                        'loadingText' => 'Loading amphur ...',
                                        'params' => ['input-type-11', 'input-type-22', 'input-type-33'],
                                        'initialize' => TRUE,
                                    ]
                                ])->label(FALSE);
                                ?>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?php
                                //echo 'p : ' . $pickingPoint->provinceId;
                                //echo 'a : ' . $pickingPoint->amphurId;
                                //echo 'pp ' . $pickingPoint->pickingId;
                                //echo Html::hiddenInput('input-type-13', $pickingPointLockersCool->provinceId, ['id' => 'input-type-13']);
                                //echo Html::hiddenInput('input-type-23', $pickingPointLockersCool->amphurId, ['id' => 'input-type-23']);
                                echo Html::hiddenInput('input-type-13', $pickingPoint->provinceId, ['id' => 'input-type-13']);
                                echo Html::hiddenInput('input-type-23', $pickingPoint->amphurId, ['id' => 'input-type-23']);
                                echo Html::hiddenInput('picking-point-33', $pickingPoint->pickingId, ['id' => 'picking-point-33']);
                                echo Html::hiddenInput('lockers-cool-input-type-33', '1', ['id' => 'lockers-cool-input-type-33']);
                                echo $form->field($pickingPoint, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
//                                  'model' => $pickingId,
                                    //'data' => [$pickingPoint->pickingId => $pickingPoint->title],
                                    'attribute' => 'pickingId',
                                    'options' => ['placeholder' => 'Select ...', 'id' => 'LcpickingId', 'name' => 'LcpickingId'],
                                    'type' => DepDrop::TYPE_DEFAULT,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        'depends' => ['amphurId'],
                                        'url' => Url::to(['child-picking-point']),
                                        'loadingText' => 'Loading picking point ...',
                                        'params' => ['input-type-13', 'input-type-23', 'picking-point-33', 'lockers-cool-input-type-33'],
                                        'initialize' => TRUE,
                                    ]
                                ])->label(FALSE);
                                ?>
                            </div>
                        </div>

                        <div class="size18">&nbsp;</div>

                        <div class="row fc-g999">
                            <div class="col-xs-12">
                                <h4>Address</h4>
                                <div id="map-address-cozxy-box">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <h4>Map</h4>
                                <div id="map" style="height:450px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-detail login-box" id="shipToAddress">
                        <h3>Ship to address</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <?php // throw new \yii\base\Exception($model->scenario);      ?>
                                <?= $form->field($order, 'shippingFirstname')->textInput(['class' => 'fullwidth', 'placeholder' => 'FIRSTNAME'])->label(false); ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($order, 'shippingLastname')->textInput(['class' => 'fullwidth', 'placeholder' => 'LASTNAME'])->label(false); ?>
                            </div>
                        </div>

                        <?= $form->field($order, 'shippingAddress')->textarea(['class' => 'fullwidth', 'placeholder' => 'ADDRESS'])->label(false); ?>

                        <div class="row">
                            <div class="col-md-3">
                                <?php
                                echo $form->field($order, 'shippingProvinceId')->widget(kartik\select2\Select2::classname(), [
                                    //'options' => ['id' => 'address-countryid'],
                                    'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId='THA' AND stateId in (1,2,3,58,4,59)")->orderBy('localName')->asArray()->all(), 'stateId', function($stateId) {
                                                return \common\models\costfit\PickingPoint::provinceName($stateId);
                                            }),
                                    'hideSearch' => true,
                                    'pluginOptions' => [
                                        'placeholder' => 'Select province',
                                        'loadingText' => 'Loading Province ...',
                                    ],
                                    'options' => ['placeholder' => 'Select Province ...'],
                                ])->label(FALSE);
                                ?>
                            </div>
                            <div class="col-md-3">
                                <?php
                                echo Html::hiddenInput('input-type-11', $order->shippingAmphurId, ['id' => 'input-type-11']);
                                echo Html::hiddenInput('input-type-22', $order->shippingAmphurId, ['id' => 'input-type-22']);
                                echo Html::hiddenInput('input-type-33', '1', ['id' => 'input-type-33']);
                                echo $form->field($order, 'shippingAmphurId')->widget(DepDrop::classname(), [
                                    //'data' => [$order->shippingAmphurId => $order->shippingCities->localName],

                                    'options' => ['placeholder' => 'Select Amphur'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
//                                            'initialize' => true,
                                        'depends' => ['order-shippingprovinceid'],
                                        'url' => Url::to(['child-amphur-address']),
                                        'loadingText' => 'Loading amphur ...',
                                        'params' => ['input-type-11', 'input-type-22', 'input-type-33']
                                    ]
                                ])->label(FALSE);
                                ?>
                            </div>
                            <div class="col-md-3">
                                <?php
                                echo Html::hiddenInput('input-type-13', $order->shippingDistrictId, ['id' => 'input-type-13']);
                                echo Html::hiddenInput('input-type-33', $order->shippingDistrictId, ['id' => 'input-type-33']);
                                echo Html::hiddenInput('input-type-34', '1', ['id' => 'input-type-34']);
                                echo $form->field($order, 'shippingDistrictId')->widget(DepDrop::classname(), [
                                    //'data' => [$order->shippingDistrictId => $order->shippingDistrict->localName],

                                    'options' => ['placeholder' => 'Select District'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        //'initialize' => true,
                                        'depends' => ['order-shippingamphurid'],
                                        'url' => Url::to(['child-district-address']),
                                        'loadingText' => 'Loading district ...',
                                        'params' => ['input-type-13', 'input-type-33', 'input-type-34']
                                    ]
                                ])->label(FALSE);
                                ?>
                            </div>
                            <div class="col-md-3">
                                <?php
                                echo $form->field($order, 'shippingZipcode')->widget(DepDrop::classname(), [
                                    'data' => [$order->shippingZipcode => $order->shippingZipcode],
                                    'options' => ['placeholder' => 'Select ...'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        'depends' => ['order-shippingdistrictid'],
                                        //                                            'initialize' => true,
                                        //'initDepends' => ['address-countryid'],
                                        'url' => Url::to(['child-zipcode-address']),
                                        'loadingText' => 'Loading zipcode ...',
                                        'params' => ['input-type-14', 'input-type-42', 'input-type-42']
                                    ]
                                ])->label(FALSE);
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?php // throw new \yii\base\Exception($model->scenario);      ?>
                                <?= $form->field($order, 'shippingTel')->textInput(['class' => 'fullwidth', 'placeholder' => 'PHONE'])->label(false); ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($order, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'EMAIL'])->label(false); ?>
                            </div>
                        </div>

                    </div>

                    <!-- Billing -->
                    <div class="cart-detail">
                        <div class="row">
                            <div class="col-lg-12">
                                Billing Address

                                <a href="#" class="pull-right p-edit btn-yellow" data-toggle="modal" data-target=".bs-example-modal-lg">+

                                    New Billing Address</a></div>
                            <div class="col-xs-12 size6">
                            </div>
                        </div>

                        <div class="size18">&nbsp;</div>

                        <div class="row fc-g999 address-checkouts">
                            <div class="col-lg-1 col-md-2 col-sm-3">Billing:</div>
                            <div class="col-lg-11 col-md-10 col-sm-9">
                                <?php
                                echo $form->field($order, 'addressId')->widget(kartik\select2\Select2::classname(), [
                                    'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Address::find()
                                                    ->asArray()->where(['userId' => Yii::$app->user->identity->userId])->all(), 'addressId', function ($model, $defaultValue, $index = 0) {
                                        $index = $index++;

                                        return 'Billing Address :' . $model['firstname'] . ' ' . $model['lastname'];
                                    }),
                                    'hideSearch' => true,
                                    'pluginOptions' => [
                                        'placeholder' => 'Select...',
                                        'loadingText' => 'Loading Billing Address ...',
                                    ],
                                    'options' => ['placeholder' => 'Select Billing Address ...', 'id' => 'addressId', 'name' => 'addressId'],
                                ])->label(FALSE);
                                ?>
                            </div>

                            <div class="size14">&nbsp;</div>

                            <div class="col-xs-3 col-md-2 col-sm-3 ">Name:</div>
                            <div class="col-xs-9 col-md-10 col-sm-9 name-show"><?= isset($defaultAddress) ? $defaultAddress->firstname . ' ' . $defaultAddress->lastname : '&nbsp;' ?></div>
                            <div class="size6">&nbsp;</div>
                            <div class="col-xs-3 col-md-2 col-sm-3">Address:</div>
                            <div class="col-xs-9 col-md-10 col-sm-9 address-show">
                                <?//= isset($defaultAddress) ? $defaultAddress->address . ', ' . $defaultAddress->district->localName . ', ' . $defaultAddress->cities->localName . ', ' . $defaultAddress->states->localName . ', ' . $defaultAddress->countries->localName . ', ' . $defaultAddress->zipcode : '&nbsp;' ?>
                                <?php
                                if (isset($defaultAddress)) {
                                    $address = $defaultAddress->address;
                                    if (isset($defaultAddress->district)) {
                                        $districtLocalName = $defaultAddress->district->localName;
                                    } else {
                                        $districtLocalName = '';
                                    }
                                    if (isset($defaultAddress->cities)) {
                                        $citiesLocalName = $defaultAddress->cities->localName;
                                    } else {
                                        $citiesLocalName = '';
                                    }
                                    //$defaultAddress->states->localName . ', ' . $defaultAddress->countries->localName . ', ' . $defaultAddress->zipcode
                                    if (isset($defaultAddress->states)) {
                                        $statesLocalName = $defaultAddress->states->localName;
                                    } else {
                                        $statesLocalName = '';
                                    }
                                    if (isset($defaultAddress->countries)) {
                                        $countriesLocalName = $defaultAddress->countries->localName;
                                    } else {
                                        $countriesLocalName = '';
                                    }
                                    if (isset($defaultAddress->zipcode)) {
                                        $zipcode = $defaultAddress->zipcodes->zipcode;
                                    } else {
                                        $zipcode = '';
                                    }

                                    echo $address . ', ' . $districtLocalName . ', ' . $citiesLocalName . ', ' . $statesLocalName . ', ' . $countriesLocalName . ', ' . $zipcode;
                                }
                                ?>
                            </div>
                            <div class="size6">&nbsp;</div>
                            <div class="col-xs-3 col-md-2 col-sm-3">Email:</div>
                            <div class="col-xs-9 col-md-10 col-sm-9 email-show">
                                <?= isset($defaultAddress) ? $defaultAddress->email : '&nbsp;' ?>
                            </div>
                            <div class="size6">&nbsp;</div>
                            <div class="col-xs-3 col-md-2 col-sm-3">Tel:</div>
                            <div class="col-xs-9 col-md-10 col-sm-9 tel-show">
                                <?= isset($defaultAddress) && ($defaultAddress->tel != '' || $defaultAddress->tel != null) ? $defaultAddress->tel : '<input type="text" name="tel" id="tel"><span class="text-danger" id="enterTel"> Please enter your mobile phone.</span>' ?>
                                <?php if (isset($defaultAddress) && ($defaultAddress->tel != '' || $defaultAddress->tel != null)) { ?>
                                    <input type="hidden" id="checkTel" value="<?= $defaultAddress->tel ?>">
                                <?php } ?>
                            </div>
                            <div class="size6">&nbsp;</div>
                            <div class="col-xs-3 col-md-2 col-sm-3">&nbsp;</div>
                            <div class="col-xs-9 col-md-10 col-sm-9 tel-show">
                                <input type="checkbox" id="checkBillingTax" value="0" name="checkTax">&nbsp;&nbsp;&nbsp;To get the full tax invoice for tax reductions, please fill in your tax code (national ID)<br>
                                <input type="text" name="billingTax" id="inputBillingTax" class="form-control" style="display:none;" required="true">
                                <div id="billingTaxText"></div>
                            </div>
                            <div class="size12">&nbsp;</div>
                        </div>
                    </div>

                    <!-- E -->
                    <div class="col-xs-12 text-right">
                        <a href="<?= Url::to(['/cart']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">BACK</a>
                        &nbsp;
                        <input type="hidden" name="orderId" value="<?= $order->orderId ?>">

                        <a href="#" class="b btn-yellow" id="checkoutBtn">CONTINUE TO PAYMENT METHOD</a>
                    </div>
                    <div class="size12 size10-xs">&nbsp;</div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <!-- Total -->
        <div class="col-lg-3 col-md-4">

            <?=
            $this->render('_checkout_total', [
                'order' => $order, 'addressId'
            ])
            ?>
        </div>

    </div>
</div>

<div class="size32">&nbsp;</div>
<style type="text/css">
    hr{
        margin-top: 0px;
    }
    .form-billing-my-account-top{
        margin-top: -35px;
    }
    #address-isdefault .radioNewCozxy  {
        margin-left: 50px;
    }
    footer .form-modal-footer{
        padding: 15px;
        text-align: center;
        border-top: 0px solid #e5e5e5;
    }
</style>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title " id="gridSystemModalLabel"><?php echo strtoupper('Add New Billing Address') ?></h4>
            </div>
            <!-- Cart -->
            <div class="row">

                <?php
                $form = ActiveForm::begin([
                            'id' => 'default-add-new-billing-address',
                            'options' => ['class' => 'login-box'],
                ]);
                ?>
                <!-- Details -->
                <div class="col-md-10 col-md-offset-1">
                    <div class="size24">&nbsp;</div>
                    <!--<div class="form-group">-->
                        <!--<label for="exampleInputEmail1"><?//php echo strtoupper('Billing type *'); ?></label>
                        <div class="select-style">
                            <select name="co-organization" id="co-country" class="valid col-md-12" onchange="organization(this)">
                                <option value="personal">Individual</option>
                    <!--<option value="company">Legal Entity (Company)</option>
                        </select>
                    </div>-->
                    <!--<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company (option)</label>
                                <?//php echo $form->field($NewBilling, 'company')->textInput(['disabled' => 'true', 'class' => 'fullwidth', 'placeholder' => 'COMPANY'])->label(FALSE); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tax </label>
                                <?//php echo $form->field($NewBilling, 'tax')->textInput(['disabled' => 'true', 'class' => 'fullwidth', 'placeholder' => 'TAX'])->label(FALSE); ?>
                            </div>
                        </div>
                    </div>-->
                    <!--<br><br>-->
                    <!--</div>-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo strtoupper('First Name'); ?></label>
                                <?= $form->field($NewBilling, 'firstname')->textInput(['class' => 'fullwidth', 'placeholder' => 'FIRST NAME', 'value' => isset($getUserInfo['firstname']) ? $getUserInfo['firstname'] : ''])->label(false); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo strtoupper('Last Name'); ?></label>
                                <?= $form->field($NewBilling, 'lastname')->textInput(['class' => 'fullwidth', 'placeholder' => 'LAST NAME', 'value' => isset($getUserInfo['lastname']) ? $getUserInfo['lastname'] : ''])->label(false); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo strtoupper('Mobile Phone Number*'); ?></label>
                                <?php echo $form->field($NewBilling, 'tel')->textInput(['class' => 'fullwidth', 'placeholder' => 'Mobile Phone Number', 'value' => isset($getUserInfo['tel']) ? $getUserInfo['tel'] : ''])->label(false); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo strtoupper('E-mail Address'); ?></label>
                                <?php echo $form->field($NewBilling, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'E-mail Address', 'value' => isset($getUserInfo['email']) ? $getUserInfo['email'] : ''])->label(false); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-11" style="margin-left: 15px;">
                    <div class="form-group">
                        <?php echo strtoupper('Address') ?>
                        <hr>
                    </div>
                </div>

                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo strtoupper('Countries'); ?></label>
                                <?php
                                echo $form->field($NewBilling, 'countryId')->widget(kartik\select2\Select2::classname(), [
                                    //'options' => ['id' => 'address-countryid'],
                                    'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', function($countryId) {
                                                return common\models\dbworld\Countries::CountryName($countryId);
                                            }),
                                    'pluginOptions' => [
                                        'placeholder' => 'Select...',
                                        'loadingText' => 'Loading country ...',
                                    ],
                                    'options' => ['placeholder' => 'Select country ...'],
                                ])->label(FALSE);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo strtoupper('Province'); ?></label>
                                <?php
                                echo Html::hiddenInput('input-type-1', $NewBilling->provinceId, ['id' => 'input-type-1']);
                                echo Html::hiddenInput('input-type-2', $NewBilling->provinceId, ['id' => 'input-type-2']);
                                echo Html::hiddenInput('input-type-3', 'edit', ['id' => 'input-type-3']);
                                echo $form->field($NewBilling, 'provinceId')->widget(DepDrop::classname(), [
                                    'data' => [$NewBilling->provinceId => $NewBilling->provinceId],
                                    'options' => ['placeholder' => 'Select ...'],
                                    //'options' => ['id' => 'address-provinceidxxx'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        //'initialize' => true,
                                        'depends' => ['address-countryid'],
                                        'url' => Url::to(['child-states-address']),
                                        'loadingText' => 'Loading province ...',
                                        'params' => ['input-type-1', 'input-type-2', 'input-type-3']
                                    ]
                                ])->label(FALSE);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo strtoupper('City'); ?></label>
                                <?php
                                echo Html::hiddenInput('input-type-11', $NewBilling->amphurId, ['id' => 'input-type-11']);
                                echo Html::hiddenInput('input-type-22', $NewBilling->amphurId, ['id' => 'input-type-22']);
                                echo Html::hiddenInput('input-type-33', $hash, ['id' => 'input-type-33']);
                                echo $form->field($NewBilling, 'amphurId')->widget(DepDrop::classname(), [
                                    //'data' => [9 => 'Savings'],
                                    'options' => ['placeholder' => 'Select ...'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        //'initialize' => true,
                                        'depends' => ['address-provinceid'],
                                        'url' => Url::to(['child-amphur-address']),
                                        'loadingText' => 'Loading amphur ...',
                                        'params' => ['input-type-11', 'input-type-22', 'input-type-33']
                                    ]
                                ])->label(FALSE);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo strtoupper('District'); ?></label>
                                <?php
                                echo Html::hiddenInput('input-type-13', $NewBilling->districtId, ['id' => 'input-type-13']);
                                echo Html::hiddenInput('input-type-33', $NewBilling->districtId, ['id' => 'input-type-33']);
                                echo Html::hiddenInput('input-type-34', $hash, ['id' => 'input-type-34']);
                                echo $form->field($NewBilling, 'districtId')->widget(DepDrop::classname(), [
                                    //'data' => [9 => 'Savings'],
                                    'options' => ['placeholder' => 'Select ...'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        //'initialize' => true,
                                        'depends' => ['address-amphurid'],
                                        'url' => Url::to(['child-district-address']),
                                        'loadingText' => 'Loading district ...',
                                        'params' => ['input-type-13', 'input-type-33', 'input-type-34']
                                    ]
                                ])->label(FALSE);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo strtoupper('Zipcode'); ?></label>
                                <?php
                                echo Html::hiddenInput('input-type-14', $NewBilling->districtId, ['id' => 'input-type-14']);
                                echo Html::hiddenInput('input-type-42', $NewBilling->districtId, ['id' => 'input-type-42']);
                                echo Html::hiddenInput('input-type-44', $hash, ['id' => 'input-type-44']);
                                echo $form->field($NewBilling, 'zipcode')->widget(DepDrop::classname(), [
                                    //'data' => [12 => 'Savings A/C 2'],
                                    'options' => ['placeholder' => 'Select ...'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        'depends' => ['address-districtid'],
                                        //'initialize' => true,
                                        //'initDepends' => ['address-countryid'],
                                        'url' => Url::to(['child-zipcode-address']),
                                        'loadingText' => 'Loading zipcode ...',
                                        'params' => ['input-type-14', 'input-type-42', 'input-type-42']
                                    ]
                                ])->label(FALSE);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo strtoupper('Address'); ?></label>
                                <?= $form->field($NewBilling, 'address')->textarea(['class' => 'fullwidth', 'placeholder' => 'ADDRESS'])->label(false); ?>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-11" style="margin-left: 15px;">
                    <div class="form-group">
                        <?php echo strtoupper('Default address') ?>
                        <hr>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                        <div class="form-group">
                            <?php echo $form->field($NewBilling, 'isDefault')->inline(true)->radioList([1 => 'YES', 0 => 'NO'], ['itemOptions' => ['class' => 'radioNewCozxy', 'id' => 'address-isDefault']])->label(false); ?>
                        </div>
                    </div>
                </div>

                <div class="size24">&nbsp;</div>

            </div>

            <div class="modal-footer form-modal-footer" style=" border-top: 0px solid #e5e5e5; text-align: center;">
                <a href="#" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px" data-dismiss="modal" aria-label="Close">CANCEL</a>
                &nbsp;
                <a href="javascript:checkoutNewBilling()" class="b btn-yellow" id="acheckoutNewBillingz" data-loading-text="<i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i> Processing New Billing" style="padding:12px 32px; margin:24px auto 12px">SAVE</a>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$this->registerCss('
#map {
            height: 450px;
        }
');

$this->registerJs('
        var map;
        function initMap() {
            var myLatLng = { lat: 13.8713948, lng: 100.6151315 };
            map = new google.maps.Map(document.getElementById("map"), {
                center: myLatLng,
                zoom: 16
            });

            var marker = new google.maps.Marker({
                map: map,
                position: myLatLng,
                title: "Hello World!"
            });
        }



function changeMap(lats, lngs) {

    var myLatLng = {lat: Number(lats), lng: Number(lngs)};// get ค่ามาจาก address แต่เป็น String ต้องเปลียนให้เป็น Number
    console.log(myLatLng);
    //document.getElementById("map").innerHTML = "Paragraph changed!";
    //$(".cart-detail").find("#map").html("xxxxxx");
    map = new google.maps.Map(document.getElementById("map"), {
        center: myLatLng,
        zoom: 11,
        /*mapTypeId: "hybrid"*/
    });

    var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: "Hello World!"
    });
}
', \yii\web\View::POS_HEAD);

$this->registerJs('
    $("#LcpickingId").change(function (event, id, value) {
    prev_val = $(this).val();

    $.ajax({
        type: "POST",
        url: $baseUrl + "checkout/map-images-google",
        data: {"pickingIds": prev_val},
        success: function (data, status)
        {
            if (data != "") {
                if (status == "success") {
                    var JSONObject = JSON.parse(data);
                    $("#map-address-cozxy-box").html(JSONObject.description);
                    /* Map Google in latitude and longitude for cozxy*/
                    changeMap(JSONObject.latitude, JSONObject.longitude);

                } else {

                }
            }
        }
    });
});


    if($("input[name=shipping]:checked").val() == 1) {
        $("#shipToAddress").hide();
    } else {
        $("#shipToCozxyBox").hide();
        $("#shipToAddress").show();
    }

    $("input[name=shipping]").change(function(e){
        var shipTo = $(this).val();
        if(shipTo == 2) {
            $("#shipToCozxyBox").hide();
            $("#shipToAddress").show();
        } else {
            $("#shipToAddress").hide();
            $("#shipToCozxyBox").show();
        }
    });

    $(" #order-shippingtel").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don\'t do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var a = regex.test(email);
        return a;
    }

    $("#checkoutBtn").on("click", function(e){
        e.preventDefault();
        var error = 0;
        var pickingId, addressId, shippingFirstname, shippingLastname, shippingAddress, shippingProvince, shippingAmphur, shippingDistrict, shippingZipcode, shippingTel, shippingEmail;
        var shipTo =  $("input[name=shipping]:checked").val();

        if(shipTo ==1) {
            //ship to CozxyBox
            pickingId = $.trim($("#LcpickingId").val());
            amphurId = $.trim($("#amphurId").val());
            stateId = $.trim($("#stateId").val());

            if((!pickingId) || (pickingId.length = 0)) {
                $(".field-LcpickingId p").html("<span class=\"text-danger\">Please select picking location.</span>");
                error++;
                $("html, body").animate({ scrollTop: 200 }, 600);
            } else {
                $(".field-LcpickingId p").html("");
            }

            if((!amphurId) || (amphurId.length = 0)) {
                $(".field-amphurId p").html("<span class=\"text-danger\">Please select amphur.</span>");
                error++;
                $("html, body").animate({ scrollTop: 200 }, 600);
            } else {
                $(".field-amphurId p").html("");
            }

            if((!stateId) || (stateId.length = 0)) {
                $(".field-stateId p").html("<span class=\"text-danger\">Please select province.</span>");
                error++;
                $("html, body").animate({ scrollTop: 200 }, 600);
            } else {
                $(".field-stateId p").html("");
            }

        } else {
            //ship to address
            shippingFirstname = $.trim($("#order-shippingfirstname").val());
            if((!shippingFirstname) || (shippingFirstname.length = 0)) {
                $(".field-order-shippingfirstname p").html("<span class=\"text-danger\">Please fill your first name.</span>");
                error++;
            } else {
                $(".field-order-shippingfirstname p").html("");
            }

            shippingLastname = $.trim($("#order-shippinglastname").val());
            if((!shippingLastname) || (shippingLastname.length = 0)) {
                $(".field-order-shippinglastname p").html("<span class=\"text-danger\">Please fill your last name.</span>");
                error++;
            } else {
                $(".field-order-shippinglastname p").html("");
            }

            shippingAddress = $.trim($("#order-shippingaddress").val());
            if((!shippingAddress) || (shippingAddress.length = 0)) {
                $(".field-order-shippingaddress p").html("<span class=\"text-danger\">Please fill your address.</span>");
                error++;
            } else {
                $(".field-order-shippingaddress p").html("");
            }

            shippingProvince = $.trim($("#order-shippingprovinceid").val());
            if((!shippingProvince) || (shippingProvince.length = 0)) {
                $(".field-order-shippingprovinceid p").html("<span class=\"text-danger\">Please select your province.</span>");
                error++;
            } else {
                $(".field-order-shippingprovinceid p").html("");
            }

            shippingAmphur = $.trim($("#order-shippingamphurid").val());
            if((!shippingAmphur) || (shippingAmphur.length = 0)) {
                $(".field-order-shippingamphurid p").html("<span class=\"text-danger\">Please select your amphur</span>");
                error++;
            } else {
                $(".field-order-shippingamphurid p").html("");
            }

            shippingDistrict = $.trim($("#order-shippingdistrictid").val());
            if((!shippingDistrict) || (shippingDistrict.length = 0)) {
                $(".field-order-shippingdistrictid p").html("<span class=\"text-danger\">Please select your district.</span>");
                error++;
            } else {
                $(".field-order-shippingdistrictid p").html("");
            }

            shippingTel = $.trim($("#order-shippingtel").val());
            if((!shippingTel) || (shippingTel.length = 0)) {
                $(".field-order-shippingtel p").html("<span class=\"text-danger\">Please fill your phone number.</span>");
                error++;
            } else {
                $(".field-order-shippingtel p").html("");
            }

            shippingEmail = $.trim($("#order-email").val());
            if((!shippingEmail) || (shippingEmail.length = 0)) {
                $(".field-order-email p").html("<span class=\"text-danger\">Please fill your e-mail.</span>");
                error++;
            } else if(!isEmail(shippingEmail)) {
                  $(".field-order-email p").html("<span class=\"text-danger\">Invalid e-mail.</span>");
                error++;
            } else {
                $(".field-order-email p").html("");
            }
        }

        addressId = $.trim($("#addressId").val());
        checkBilling=$("#checkBillingTax").val();
        tax=$.trim($("#inputBillingTax").val());
        if(checkBilling==1 && tax==""){
                $("#billingTaxText").html("<span class=\"text-danger\">Please select billing address.</span>");
                error++;
        }else{
                $("#billingTaxText").html("");
        }
        checkTel = $.trim($("#checkTel").val());
        tel = $.trim($("#tel").val());
            if(checkTel==0 && tel=="") {
                $("#enterTel").html("<span class=\"text-danger\">* Please enter your mobile phone.</span>");
                error++;
            } else {
                $("#enterTel").html("");
            }

        if((!addressId) || (addressId.length = 0)) {
            $(".field-addressId p").html("<span class=\"text-danger\">Please select billing address.</span>");
            error++;
        } else {
            $(".field-addressId p").html("");
        }
        if(error == 0) {
            $("#default-shipping-address").submit();
        }
    });

', \yii\web\View::POS_END);

$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&callback=initMap', ['depends' => ['yii\web\YiiAsset']]);
?>
<div class="modal fade" id="LockerModal" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeWishlistModal"><i class="fa fa-times"></i>
                </button>
                <h3>COZXYBOX</h3>
            </div>
            <div class="modal-body" style="padding: 40px;">
                <?= common\helpers\Faq::Faqs('Locker') ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
