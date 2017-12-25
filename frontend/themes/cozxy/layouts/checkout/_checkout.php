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

                    <div class="cart-detail login-box" id="shipToAddress">
                        <h4>SHIP TO</h4>

                        <?php if ($shipTo == 2): ?>
                            <div class="row address-checkouts">
                                <div class="col-xs-3 col-md-2 col-sm-3 ">Name:</div>
                                <div class="col-xs-9 col-md-10 col-sm-9 name-show"><?= $order->shippingFirstname . ' ' . $order->shippingLastname ?></div>
                                <div class="size6">&nbsp;</div>
                                <div class="col-xs-3 col-md-2 col-sm-3">Address:</div>
                                <div class="col-xs-9 col-md-10 col-sm-9 address-show">
                                    <?= $order->shippingAddress . ' ' . $order->shippingDistrict->localName . ' ' . $order->shippingCities->localName . ' ' . $order->shippingProvince->localName . ' ' . isset($order->shippingZipcodeRelation->zipcode) ? $order->shippingZipcodeRelation->zipcode : ''; ?>
                                </div>
                                <div class="size6">&nbsp;</div>
                                <div class="col-xs-3 col-md-2 col-sm-3">Email:</div>
                                <div class="col-xs-9 col-md-10 col-sm-9 email-show">
                                    <?= $order->email ?>
                                </div>
                                <div class="size6">&nbsp;</div>
                                <div class="col-xs-3 col-md-2 col-sm-3">Tel:</div>
                                <div class="col-xs-9 col-md-10 col-sm-9 tel-show">
                                    <?= $order->shippingTel ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row ">
                                <div class="form-horizontal col-sm-12" role="form">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">
                                            <img src="http://www.cozxy.com/images/subscribe/cozxy-map.png">
                                        </label>
                                        <div class="col-sm-10">
                                            <h4><?= isset($shipToCozxyBoxNew->title) ? $shipToCozxyBoxNew->title : '' ?></h4>
                                            <span style="color:#928c8c;"><?= isset($shipToCozxyBoxNew->description) ? $shipToCozxyBoxNew->description : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-1 control-label">
                                            &nbsp;
                                        </label>
                                        <div class="col-sm-11">
                                            <div id="map" style="height:450px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div>

                                </div>
                            </div>
                        <?php endif; ?>

                    </div>

                    <!-- Billing -->
                    <div class="cart-detail">
                        <div class="row">
                            <div class="col-lg-12">
                                Billing Address
                                <a href="#" class="pull-right p-edit btn-yellow" data-toggle="modal" data-target=".bs-example-modal-lg">+ New Billing Address</a></div>
                            <div class="col-xs-12 size6">
                            </div>
                        </div>

                        <div class="size18">&nbsp;</div>

                        <div class="row fc-g999 address-checkouts">
                            <div class="col-lg-1 col-md-2 col-sm-3">Billing:</div>
                            <div class="col-lg-11 col-md-10 col-sm-9">
                                <?php
                                //echo '<pre>';
                                //print_r($myAddress);
                                echo $form->field($order, 'addressId')->widget(kartik\select2\Select2::classname(), [
                                    'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Address::find()
                                                    ->where('userId=' . Yii::$app->user->identity->userId . ' and type!=4')
                                                    ->all(), 'addressId', function ($model, $defaultValue, $index = 0) {
                                                $index = $index++;
                                                //echo '<pre>';
                                                //print_r($model);
                                                $myAddress = $model->address;
                                                $myListAddress = $myAddress . ' ' . $model->district['districtName'] . ' ' . $model->cities['cityName'] . ' ' . $model->states['stateName'] . ' ' . $model->countries['countryName'] . ' ' . $model->zipcodes['zipcode'];
                                                return $model['firstname'] . ' ' . $model['lastname'] . ' : ' . $myListAddress;
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
                            <div class="col-xs-9 col-md-10 col-sm-9">
                                <input type="checkbox" id="checkBillingTax" value="0" name="checkTax">&nbsp;&nbsp;&nbsp;To get the full tax invoice for tax reductions, please fill in your tax code (national ID)<br>
                                <!--<input type="text" name="billingTax" id="inputBillingTax" class="form-control" style="display:none;" required="true">-->
                                <input type="text" name="inputBillingTax" id="inputBillingTax" class="form-control" style="display:none;">
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
                        <input type="hidden" name="lat_value" id="lat_value" value="0">
                        <input type="hidden" name="lon_value" id="lon_value" value="0">
                        <input type="hidden" name="start" id="start" value="0">
                        <input type="hidden" name="LcpickingId" id="LcpickingId" value="<?= isset($shipToCozxyBoxNew['pickingId']) ? $shipToCozxyBoxNew['pickingId'] : '' ?>">
                        <input type="hidden" name="shipping" value="<?= $shipTo ?>">
                        <!--<a href="#" class="b btn-yellow" id="checkoutBtn">CONTINUE TO PAYMENT METHOD</a>-->
                        <button type="submit" class="b btn-yellow">CONTINUE TO PAYMENT METHOD</button>
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
                        <div class="col-md-6 field-address-tel-unique">
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
<?php if ($shipTo == 1) { ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
    <script src="https://www.ninenik.com/js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">

        var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
        var latMe;
        var lngMe;
        var lat;
        var long;
        var p;
        function initMap() {

            GGM = new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11,
                center: {lat: 13.761728449950002, lng: 100.6527900695800},
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.TOP_CENTER
                },
                zoomControl: true,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.LEFT_CENTER
                },
                scaleControl: true,
                streetViewControl: true,
                streetViewControlOptions: {
                    position: google.maps.ControlPosition.LEFT_TOP
                },
                fullscreenControl: true
            });

            directionsDisplay.setMap(map);
            var onChangeHandler = function () {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            };
            //alert(onChangeHandler);
            //document.getElementById('start').addEventListener('change', onChangeHandler);
            //document.getElementById('LcpickingId').addEventListener('change', onChangeHandler);

            var startUserCozxy = new google.maps.LatLng(<?= $_REQUEST['start'] ?>);
            var marker = new google.maps.Marker({
                map: map,
                position: startUserCozxy
            });
            $("#start").val(<?= $_REQUEST['start'] ?>);
            map.panTo(startUserCozxy); // ให้แผนที่แสดงไปที่ตัว marker

            calculateAndDisplayRoute(directionsService, directionsDisplay);
            // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
            GGM.event.addListener(map, 'zoom_changed', function () {
                $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
            });
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {

            //var LcpickingId = $('#LcpickingId').val();
            //var fields = LcpickingId.split('-');
            //var pickingId = fields[0];
            //var latlongMap = fields[1];
            var latlongMap = <?= $shipToCozxyBoxNew['latitude'] ?> + ',' +<?= $shipToCozxyBoxNew['longitude'] ?>;
            //alert('start :' + $('#start').val());
            //alert('latlongMap:' + latlongMap);
            directionsService.route({
                origin: '<?= $shipTostart ?>', //document.getElementById('start').value,
                //destination: document.getElementById('LcpickingId').value,
                destination: latlongMap,
                travelMode: 'DRIVING'
            }, function (response, status) {
                if (status === 'OK') {
                    //alert(status);
                    directionsDisplay.setDirections(response);
                    //$('#continue-pick-up').html('<input type="hidden" name="pickingId-lats-longs" value="' + pickingId + '-' + latlongMap + '">');
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }



        function attachInstructionText(stepDisplay, marker, text, map) {
            google.maps.event.addListener(marker, 'click', function () {
                // Open an info window when the marker is clicked on, containing the text
                // of the step.
                stepDisplay.setContent(text);
                stepDisplay.open(map, marker);
            });
        }



        $(function () {
            // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
            // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
            // v=3.2&sensor=false&language=th&callback=initialize
            //	v เวอร์ชัน่ 3.2
            //	sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
            //	language ภาษา th ,en เป็นต้น
            //	callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize
            $("<script/>", {
                "type": "text/javascript",
                src: "//maps.google.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&v=3.2&sensor=false&language=th&callback=initMap"
            }).appendTo("body");
        });

    </script>
<?php } ?>
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
