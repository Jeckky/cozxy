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
                                    Choose shipping type :
                                    <?= Html::radio('shipping', (isset($order->pickingId) && !empty($order->pickingId )) ? false : true, ['value' => 1, 'class' => 'shippingOption']) ?>
                                    Ship to CozxyBox
                                    <!--   <a href="chk-edit1.php" class="pull-right btn-g999 p-edit">Edit</a></div><div class="col-xs-12 size6">&nbsp;-->

                                    <?= Html::radio('shipping', (isset($order->pickingId) && !empty($order->pickingId )) ? true : false, ['value' => 2, 'class' => 'shippingOption']) ?>
                                    Ship to address
                                </div>
                            </div>
                        </div>

                        <!-- Shipping -->
                        <div class="cart-detail" id="shipToCozxyBox">
                            <h3>Ship to CozxyBox <span class="small"><a href="#">view all</a></span></h3>
                            <div class="row fc-g999">
                                <div class="col-md-4 col-xs-12">
                                    <?php
                                    echo $form->field($pickingPoint, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                                        // 'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->asArray()->all(), 'stateId', 'localName'),
                                        'data' => \common\models\costfit\PickingPoint::availableProvince(),
                                        'pluginOptions' => [
                                            'placeholder' => 'Select Province',
                                            'loadingText' => 'Loading Province ...',
                                        ],
                                        'options' => ['placeholder' => 'Select Province ...', 'name' => 'provinceId', 'id' => 'stateId'],
                                    ])->label(FALSE);
                                    ?>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <?php
                                    //                                    echo Html::hiddenInput('input-type-11', $model->amphurId, ['id' => 'input-type-11']);
                                    //                                    echo Html::hiddenInput('input-type-22', $model->amphurId, ['id' => 'input-type-22']);
                                    //                                    echo Html::hiddenInput('input-type-33', 'add', ['id' => 'input-type-33']);
                                    echo $form->field($pickingPoint, 'amphurId')->widget(DepDrop::classname(), [
                                        'data' => [$pickingPoint->amphurId=>$pickingPoint->citie->localName],
                                        'options' => ['placeholder' => 'Select ...', 'name' => 'amphurId', 'id' => 'amphurId'],
                                        'type' => DepDrop::TYPE_SELECT2,
                                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                        'pluginOptions' => [
                                            'depends' => ['stateId'],
                                            'url' => Url::to(['child-amphur-address-picking-point-checkouts']),
                                            'loadingText' => 'Loading amphur ...',
                                            //                                            'params' => ['input-type-11', 'input-type-22', 'input-type-33'],
                                            'initialize' => false,
                                        ]
                                    ])->label(FALSE);
                                    ?>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <?php
                                    echo Html::hiddenInput('input-type-13', $pickingPointLockersCool->provinceId, ['id' => 'input-type-13']);
                                    echo Html::hiddenInput('input-type-23', $pickingPointLockersCool->amphurId, ['id' => 'input-type-23']);
                                    echo Html::hiddenInput('lockers-cool-input-type-33', '1', ['id' => 'lockers-cool-input-type-33']);
                                    echo $form->field($pickingPoint, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
//                                        'model' => $pickingId,
                                        'data'=>[$pickingPoint->pickingId=>$pickingPoint->title],
                                        'attribute' => 'pickingId',
                                        'options' => ['placeholder' => 'Select ...', 'id' => 'LcpickingId', 'name' => 'LcpickingId'],
                                        'type' => DepDrop::TYPE_SELECT2,
                                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                        'pluginOptions' => [
                                            'depends' => ['amphurId'],
                                            'url' => Url::to(['child-picking-point']),
                                            'loadingText' => 'Loading picking point ...',
                                            'params' => ['input-type-13', 'input-type-23', 'lockers-cool-input-type-33'],
                                            //                                        'initialize' => false,
                                        ]
                                    ])->label(FALSE);
                                    ?>
                                </div>
                            </div>

                            <div class="size18">&nbsp;</div>

                            <div class="row fc-g999">
                                <div class="col-xs-12">
                                    <h4>Map</h4>
                                    <div id="map" style="height:200px;"></div>

                                </div>
                            </div>
                        </div>

                        <div class="cart-detail login-box" id="shipToAddress">
                            <h3>Ship to address</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <?php // throw new \yii\base\Exception($model->scenario); ?>
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
                                        'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId='THA' AND stateId in (1,2,3,58,4,59)")->orderBy('localName')->asArray()->all(), 'stateId', 'localName'),
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
                                    echo $form->field($order, 'shippingAmphurId')->widget(DepDrop::classname(), [
                                        'data' => [$order->shippingAmphurId => $order->shippingCities->localName],
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
                                    echo $form->field($order, 'shippingDistrictId')->widget(DepDrop::classname(), [
                                        'data' => [$order->shippingDistrictId => $order->shippingDistrict->localName],
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
                                    <?php // throw new \yii\base\Exception($model->scenario); ?>
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
                                    <a href="#" class="pull-right btn-g999 p-edit" data-toggle="modal" data-target=".bs-example-modal-lg">+
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
                                            ->asArray()->where('userId=' . Yii::$app->user->identity->userId)->all(), 'addressId', function ($model, $defaultValue, $index = 0) {
                                            $index = $index++;

                                            return 'Billing Address :' . $model['firstname'] . ' ' . $model['lastname'];
                                        }),
                                        'pluginOptions' => [
                                            'placeholder' => 'Select...',
                                            'loadingText' => 'Loading Billing Address ...',
                                        ],
                                        'options' => ['placeholder' => 'Select Billing Address ...', 'id' => 'addressId', 'name' => 'addressId'],
                                    ])->label(FALSE);
                                    ?>
                                </div>

                                <div class="size14">&nbsp;</div>

                                <div class="col-lg-1 col-md-2 col-sm-3 ">Name:</div>
                                <div class="col-lg-11 col-md-10 col-sm-9 name-show">none</div>
                                <div class="size6">&nbsp;</div>
                                <div class="col-lg-1 col-md-2 col-sm-3">Address:</div>
                                <div class="col-lg-11 col-md-10 col-sm-9 address-show"> none</div>
                                <div class="size12">&nbsp;</div>
                            </div>
                        </div>

                        <!-- E -->
                        <div class="col-xs-12 text-right">
                            <a href="<?= Url::to(['/cart']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">BACK</a>
                            &nbsp;
                            <input type="hidden" name="orderId" value="<?= $order->orderId ?>">

                            <input type="submit" value="CONTINUE TO PAYMENT METHOD" class="b btn-yellow" id="checkoutBtn">
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

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="gridSystemModalLabel">+ Add New Billing Address</h4>
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

                        <div class="form-group">
                            <label for="exampleInputEmail1">Billing type *</label>
                            <div class="select-style">
                                <select name="co-organization" id="co-country" class="valid col-md-12" onchange="organization(this)">
                                    <option value="personal">Individual</option>
                                    <option value="company">Legal Entity (Company)</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Company (option)</label>
                                        <?php echo $form->field($NewBilling, 'company')->textInput(['disabled' => 'true', 'class' => 'fullwidth', 'placeholder' => 'COMPANY'])->label(FALSE); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tax </label>
                                        <?php echo $form->field($NewBilling, 'tax')->textInput(['disabled' => 'true', 'class' => 'fullwidth', 'placeholder' => 'TAX'])->label(FALSE); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <?= $form->field($NewBilling, 'firstname')->textInput(['class' => 'fullwidth', 'placeholder' => 'FIRSTNAME'])->label(false); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <?= $form->field($NewBilling, 'lastname')->textInput(['class' => 'fullwidth', 'placeholder' => 'LASTNAME'])->label(false); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <?= $form->field($model, 'address')->textarea(['class' => 'fullwidth', 'placeholder' => 'ADDRESS'])->label(false); ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Countries</label>
                                    <?php
                                    echo $form->field($NewBilling, 'countryId')->widget(kartik\select2\Select2::classname(), [
                                        //'options' => ['id' => 'address-countryid'],
                                        'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\Countries::find()->asArray()->all(), 'countryId', 'localName'),
                                        'pluginOptions' => [
                                            'placeholder' => 'Select...',
                                            'loadingText' => 'Loading country ...',
                                        ],
                                        'options' => ['placeholder' => 'Select country ...'],
                                    ])->label(FALSE);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Province</label>
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
                                    <label for="exampleInputEmail1">City</label>
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
                                    <label for="exampleInputEmail1">District</label>
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
                                    <label for="exampleInputEmail1">Zipcode</label>
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
                        </div>
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <?php echo $form->field($NewBilling, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'Email'])->label(false); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mobile Number</label>
                                        <?php echo $form->field($NewBilling, 'tel')->textInput(['class' => 'fullwidth', 'placeholder' => 'Mobile Number'])->label(false); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Default address</label>
                                <?php echo $form->field($NewBilling, 'isDefault')->radioList([1 => 'Yes', 0 => 'No'], ['itemOptions' => ['class' => 'radio', 'id' => 'address-isDefault']])->label(false); ?>
                            </div>

                        </div>

                        <div class="size24">&nbsp;</div>
                    </div>
                </div>

                <div class="modal-footer">
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
            height: 300px;
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
        mapTypeId: "hybrid"
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
            
            if((!pickingId) || (pickingId.length = 0)) {
                $(".field-LcpickingId p").html("<span class=\"text-danger\">Please select picking location.</span>");
                error++;
            } else {
                $(".field-LcpickingId p").html("");
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