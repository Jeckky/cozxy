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
        ]);
        ?>
        <!-- Cart -->
        <div class="col-lg-9 col-md-8 cart-body">
            <div class="row">
                <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
                    <p class="size20 size18-xs">YOUR SHIPPING & BILLING ADDRESS</p>
                </div>
                <div class="col-xs-12 bg-white">

                    <!-- Shipping -->
                    <div class="cart-detail">
                        <div class="row">
                            <div class="col-lg-12">
                                Shipping Address
                                <!--   <a href="chk-edit1.php" class="pull-right btn-g999 p-edit">Edit</a></div><div class="col-xs-12 size6">&nbsp;-->
                            </div>
                        </div>
                        <div class="size18">&nbsp;</div>

                        <div class="row fc-g999">
                            <div class="col-md-4 col-xs-12">
                                <?php
                                echo $form->field($model, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                                    'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->asArray()->all(), 'stateId', 'localName'),
                                    'pluginOptions' => [
                                        'placeholder' => 'Select...',
                                        'loadingText' => 'Loading States ...',
                                    ],
                                    'options' => ['placeholder' => 'Select States ...', 'name' => 'provinceId', 'id' => 'stateId'],
                                ])->label(FALSE);
                                ?>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?php
                                echo Html::hiddenInput('input-type-11', $model->amphurId, ['id' => 'input-type-11']);
                                echo Html::hiddenInput('input-type-22', $model->amphurId, ['id' => 'input-type-22']);
                                echo Html::hiddenInput('input-type-33', 'add', ['id' => 'input-type-33']);
                                echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
                                    //'data' => [9 => 'Savings'],
                                    'options' => ['placeholder' => 'Select ...', 'name' => 'amphurId', 'id' => 'amphurId'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
//                                        'initialize' => false,
                                        'depends' => ['stateId'],
                                        'url' => Url::to(['child-amphur-address-picking-point-checkouts']),
                                        'loadingText' => 'Loading amphur ...',
                                        'params' => ['input-type-11', 'input-type-22', 'input-type-33']
                                    ]
                                ])->label(FALSE);
                                ?>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?php
                                echo Html::hiddenInput('input-type-13', $pickingPointLockersCool->provinceId, ['id' => 'input-type-13']);
                                echo Html::hiddenInput('input-type-23', $pickingPointLockersCool->amphurId, ['id' => 'input-type-23']);
                                echo Html::hiddenInput('lockers-cool-input-type-33', '1', ['id' => 'lockers-cool-input-type-33']);
                                echo $form->field($pickingPointLockersCool, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                                    'model' => $pickingId,
                                    'attribute' => 'pickingId',
                                    'options' => ['placeholder' => 'Select ...', 'id' => 'LcpickingId', 'name' => 'LcpickingId'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
//                                        'initialize' => false,
                                        'depends' => ['amphurId'],
                                        'url' => Url::to(['child-picking-point']),
                                        'loadingText' => 'Loading picking point ...',
                                        'params' => ['input-type-13', 'input-type-23', 'lockers-cool-input-type-33']
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
                                echo $form->field($model, 'addressId')->widget(kartik\select2\Select2::classname(), [
                                    'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Address::find()
                                    ->asArray()->where('userId=' . Yii::$app->user->identity->userId)->all(), 'addressId', function($model, $defaultValue, $index = 0) {
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
                            <div class="col-lg-11 col-md-10 col-sm-9 address-show"> none </div>
                            <div class="size12">&nbsp;</div>
                        </div>
                    </div>

                    <!-- E -->
                    <div class="col-xs-12 text-right">
                        <a href="<?= Url::to(['/cart']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">BACK</a>
                        &nbsp;
                        <input type="hidden" name="orderId" value="<?= $order->orderId ?>">
                        <input type="submit" value="CONTINUE TO PAYMENT METHOD" class="b btn-yellow">
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
                'order' => $order
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
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
                                <option value="personal">Individual </option>
                                <option value="company">Legal Entity (Company)</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Compnay (option)</label>
                                    <?php echo $form->field($model, 'company')->textInput([ 'disabled' => 'true', 'class' => 'fullwidth', 'placeholder' => 'COMPANY'])->label(FALSE); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tax </label>
                                    <?php echo $form->field($model, 'tax')->textInput([ 'disabled' => 'true', 'class' => 'fullwidth', 'placeholder' => 'TAX'])->label(FALSE); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <?= $form->field($model, 'firstname')->textInput(['class' => 'fullwidth', 'placeholder' => 'FIRSTNAME'])->label(false); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <?= $form->field($model, 'lastname')->textInput(['class' => 'fullwidth', 'placeholder' => 'LASTNAME'])->label(false); ?>
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
                                echo $form->field($model, 'countryId')->widget(kartik\select2\Select2::classname(), [
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
                                echo Html::hiddenInput('input-type-1', $model->provinceId, ['id' => 'input-type-1']);
                                echo Html::hiddenInput('input-type-2', $model->provinceId, ['id' => 'input-type-2']);
                                echo Html::hiddenInput('input-type-3', 'edit', ['id' => 'input-type-3']);
                                echo $form->field($model, 'provinceId')->widget(DepDrop::classname(), [
                                    'data' => [$model->provinceId => $model->provinceId],
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
                                echo Html::hiddenInput('input-type-11', $model->amphurId, ['id' => 'input-type-11']);
                                echo Html::hiddenInput('input-type-22', $model->amphurId, ['id' => 'input-type-22']);
                                echo Html::hiddenInput('input-type-33', $hash, ['id' => 'input-type-33']);
                                echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
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
                                echo Html::hiddenInput('input-type-13', $model->districtId, ['id' => 'input-type-13']);
                                echo Html::hiddenInput('input-type-33', $model->districtId, ['id' => 'input-type-33']);
                                echo Html::hiddenInput('input-type-34', $hash, ['id' => 'input-type-34']);
                                echo $form->field($model, 'districtId')->widget(DepDrop::classname(), [
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
                                echo Html::hiddenInput('input-type-14', $model->districtId, ['id' => 'input-type-14']);
                                echo Html::hiddenInput('input-type-42', $model->districtId, ['id' => 'input-type-42']);
                                echo Html::hiddenInput('input-type-44', $hash, ['id' => 'input-type-44']);
                                echo $form->field($model, 'zipcode')->widget(DepDrop::classname(), [
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
                                    <?php echo $form->field($model, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'Email'])->label(false); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile Number</label>
                                    <?php echo $form->field($model, 'tel')->textInput(['class' => 'fullwidth', 'placeholder' => 'Mobile Number'])->label(false); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Default address</label>
                            <?php echo $form->field($model, 'isDefault')->radioList([1 => 'Yes', 0 => 'No'], ['itemOptions' => ['class' => 'radio']])->label(false); ?>
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
            var myLatLng = { lat: -25.363, lng: 131.044 };
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

');

$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&callback=initMap', ['depends' => ['yii\web\YiiAsset']]);
?>