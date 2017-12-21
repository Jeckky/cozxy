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

function strip_tags_content($text) {
    return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
}

//echo '<pre>';
//print_r($order->attributes['orderId']);
//echo 'orderId :' . $order->attributes['orderId'] . '<br>';
//echo 'addressId :' . $order->attributes['addressId'] . '<br>';
//echo 'pickingId :' . $order->attributes['pickingId'] . '<br>';
//echo 'shippingChooseActive : ' . $shippingChooseActive . '<br>';
//echo $_SERVER['HTTP_REFERER'];
?>
<style>
    /* css กำหนดความกว้าง ความสูงของแผนที่
    #map_canvas {
        width:550px;
        height:400px;
        margin:auto;
        /*margin-top:100px;
    }
    #infowindow-content {
        display: none;
    }
    #map_canvas #infowindow-content {
        display: inline;
    }*/
</style>

<style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        -webkit-animation-name: fadeIn; /* Fade in the background */
        -webkit-animation-duration: 0.4s;
        animation-name: fadeIn;
        animation-duration: 0.4s
    }

    /* Modal Content */
    .modal-content {
        position: fixed;
        bottom: 0;
        background-color: #fefefe;
        width: 100%;
        -webkit-animation-name: slideIn;
        -webkit-animation-duration: 0.4s;
        animation-name: slideIn;
        animation-duration: 0.4s
    }

    /* The Close Button */
    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }

    .modal-body {padding: 2px 16px;}

    .modal-footer {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }

    /* Add Animation */
    @-webkit-keyframes slideIn {
        from {bottom: -300px; opacity: 0}
        to {bottom: 0; opacity: 1}
    }

    @keyframes slideIn {
        from {bottom: -300px; opacity: 0}
        to {bottom: 0; opacity: 1}
    }

    @-webkit-keyframes fadeIn {
        from {opacity: 0}
        to {opacity: 1}
    }

    @keyframes fadeIn {
        from {opacity: 0}
        to {opacity: 1}
    }


    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
    }

    #infowindow-content .title {
        font-weight: bold;
    }

    #infowindow-content {
        display: none;
    }

    #map #infowindow-content {
        display: inline;
    }

    .pac-card {
        margin: 10px 0px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }

    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        /*margin-left: 12px;*/
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        /*width: 400px;*/
        width: 100%;

    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        font-size: 12px;
        font-weight: 200;
        padding: 6px 12px;

    }
</style>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <?php
        $form = ActiveForm::begin([
                    'id' => 'default-shipping-address',
                    //'action' => Yii::$app->homeUrl . 'checkout/summary',
                    'action' => $shippingChooseActive == 1 ? Yii::$app->homeUrl . 'checkout' : Yii::$app->homeUrl . 'checkout',
                    'options' => ['class' => 'space-bottom'],
                        //'enableClientValidation' => false,
        ]);
        ?>
        <!-- YOUR SHIPPING & BILLING ADDRESS -->
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
                                <?//= Html::radio('shipping', ((isset($order->pickingId) && !empty($order->pickingId)) || !isset($order->shippingFirstname)) ? true : false, ['value' => 1, 'class' => 'shippingOption']) ?>
                                <?= Html::radio('shipping', $shippingChooseActive == 1 ? true : false, ['value' => 1, 'class' => 'shippingOption']) ?>
                                Ship To CozxyBox
                                <!--   <a href="chk-edit1.php" class="pull-right btn-g999 p-edit">Edit</a></div><div class="col-xs-12 size6">&nbsp;-->
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <?//= Html::radio('shipping', (isset($order->shippingFirstname) && !isset($order->pickingId)) ? true : false, ['value' => 2, 'class' => 'shippingOption']) ?>
                                <?= Html::radio('shipping', $shippingChooseActive == 2 ? true : false, ['value' => 2, 'class' => 'shippingOption']) ?>
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
                    <div class="cart-detail" id="shipToCozxyBox" <?= $shippingChooseActive == 2 ? 'style=" display: none;"' : '' ?>>
                        <div class="col-lg-12" style="padding-left:0px;">
                            <h3>Ship To CozxyBox <span class="small"><a href="<?= Url::to(['/checkout/ship-to-cozxy-box']) ?>" target="_blank">view all</a></span></h3>
                        </div>
                        <div class="col-lg-12" style="margin-top: 10px; margin-bottom: 20px;">
                            At Cozxy, we want our customer to be in control of the way they shop, especially the way you receive your shopping orders. COZXYBOXS are self-service delivery lockers we send
                            shopping bags to,so that you can pick them up on your way home whenever you are free.
                        </div>

                        <div class="row fc-g999" style="padding: 40px;">
                            <div id="ship-to-cozxy-box-select">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Select Province</label>
                                        <div class="col-sm-6">
                                            <?php
                                            //echo $form->field($pickingPoint, 'provinceId')->textInput();
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
                                                    'name' => 'PickingPoint[provinceId]', 'id' => 'stateId'],
                                            ])->label(FALSE);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Select District</label>
                                        <div class="col-sm-6">
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
                                                'options' => ['placeholder' => 'Select ...', 'name' => 'PickingPoint[amphurId]', 'id' => 'amphurId'],
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
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Select Cozxybox</label>
                                        <div class="col-sm-6">
                                            <?php
                                            echo Html::hiddenInput('input-type-13', $pickingPoint->provinceId, ['id' => 'input-type-13']);
                                            echo Html::hiddenInput('input-type-23', $pickingPoint->amphurId, ['id' => 'input-type-23']);
                                            echo Html::hiddenInput('picking-point-33', $pickingPoint->pickingId, ['id' => 'picking-point-33']);
                                            echo Html::hiddenInput('lockers-cool-input-type-33', '1', ['id' => 'lockers-cool-input-type-33']);
                                            echo $form->field($pickingPoint, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                                                //'model' => $pickingId,
                                                //'data' => [$pickingPoint->pickingId => $pickingPoint->title],
                                                'attribute' => 'pickingId',
                                                'options' => ['placeholder' => 'Select ...', 'id' => 'LcpickingId', 'name' => 'PickingPoint[pickingId]'],
                                                'type' => DepDrop::TYPE_DEFAULT,
                                                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                                'pluginOptions' => [
                                                    'depends' => ['amphurId'],
                                                    'url' => Url::to(['child-picking-point-map']),
                                                    'loadingText' => 'Loading picking point ...',
                                                    'params' => ['input-type-13', 'input-type-23', 'picking-point-33', 'lockers-cool-input-type-33'],
                                                    'initialize' => TRUE,
                                                ]
                                            ])->label(FALSE);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" text-center" style="margin-top: 10px;">
                                <!--/*onclick="shipCozxyBox()"*/-->
                                <!--<button type="button" class="btn btn-default btn-lg" id="shipCozxyBox-Map">
                                    &nbsp;&nbsp;&nbsp;&nbsp;SEARCH&nbsp;&nbsp;&nbsp;&nbsp;
                                </button>-->
                            </div>
                        </div>

                        <div class="size18">&nbsp;</div>

                        <div class="row fc-g999">
                            <div class="col-xs-12">
                                <hr>
                                <!--<h4>COZXYBOX pick up location search results</h4>-->
                                <div id="map-address-cozxy-box" style=" margin-bottom: 5px;">
                                    &nbsp;Your COZXYBOX pick-up location: " <span id="title-location" style=" color: #0000ff;"></span> "
                                </div>
                                <hr>
                            </div>
                            <div class="col-xs-4 location-pick-up">
                                <?php
                                /* echo \yii\widgets\ListView::widget([
                                  'dataProvider' => $pickingPointActiveShow,
                                  'options' => [
                                  'tag' => false,
                                  ],
                                  'itemView' => function ($model, $key, $index, $widget) {
                                  return $this->render('@app/themes/cozxy/layouts/checkout/item/cozxyBox', ['model' => $model]);
                                  }, 'emptyText' => ' &nbsp; &nbsp; No results found.',
                                  //  'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                                  //'layout'=>"{summary}{pager}{items}"
                                  'layout' => "{items}",
                                  'itemOptions' => [
                                  'tag' => false,
                                  ],
                                  ]); */
                                ?>
                                <?//= $this->render('@app/themes/cozxy/layouts/checkout/item/locationPickUp', compact('pickingPointActiveShow')) ?>
                            </div>
                            <div class="col-xs-8">
                                <div class="pac-card" id="pac-card">
                                    <!--<div>-->
                                    <div id="title">
                                        <h5>
                                            Autocomplete Places Search Box using Google Maps
                                            <!--Autocomplete search location me-->
                                        </h5>
                                    </div>
                                    <!--<div id="type-selector" class="pac-controls">
                                        <input type="radio" name="type" id="changetype-all" checked="checked">
                                        <label for="changetype-all">All</label>

                                        <input type="radio" name="type" id="changetype-establishment">
                                        <label for="changetype-establishment">Establishments</label>

                                        <input type="radio" name="type" id="changetype-address">
                                        <label for="changetype-address">Addresses</label>

                                        <input type="radio" name="type" id="changetype-geocode">
                                        <label for="changetype-geocode">Geocodes</label>
                                    </div>
                                    <div id="strict-bounds-selector" class="pac-controls">
                                        <input type="checkbox" id="use-strict-bounds" value="">
                                        <label for="use-strict-bounds">Strict Bounds</label>
                                    </div>-->
                                    <!--</div>-->
                                    <div id="pac-containerx" style=" background-color: #5cb85c;">
                                        <input id="pac-input" class="fullwidth" type="text" placeholder="Enter a location me">
                                    </div>
                                </div>
                                <div id="map"></div>
                                <div id="infowindow-content">
                                    <img src="" width="16" height="16" id="place-icon">
                                    <span id="place-name"  class="title"></span><br>
                                    <span id="place-address"></span>
                                </div>

                                <input type="hidden" name="lat_value" id="lat_value" value="0">
                                <input type="hidden" name="lon_value" id="lon_value" value="0">
                                <input type="hidden" name="start" id="start" value="0">
                                <input type="hidden" name="zoom_value" id="zoom_value" value="0">
                                <input type="hidden" name="no_allow" id="no_allow" value="0">
                                <!-- <div id="showDD" style="margin:auto;padding-top:5px;width:550px;"> 
                                      <form id="form_get_detailMap" name="form_get_detailMap" method="post" action=""> 
                                            Latitude 
                                            <input name="lat_value" type="text" id="lat_value" value="0" />  <br />
                                            Longitude 
                                            <input name="lon_value" type="text" id="lon_value" value="0" />  <br />
                                          Zoom 
                                          <input name="zoom_value" type="text" id="zoom_value" value="0" size="5" /> 
                                          <br />
                                           <input type="submit" name="button" id="button" value="บันทึก" />
                                  </form> 
                                    </div>
                                    <h4>Result for "Ladproa 20"</h4>
                                    <div id="map" style="height:450px;"></div>
                                -->

                                <br>
                                <p style=" background-color: yellow; color: #000; line-height:50px;" class="size18">
                                    &nbsp;&nbsp;Search for a new COZXYBOX Pickup Location
                                </p>
                                <p>
                                    COZXYBOX Pickup location offer package pickup as self-service COZXYBOX Lockers and at staffed locations.
                                    Please enter address, postal code, landmark, or <span id="title-location-footer" style=" color: #0000ff;"></span>
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="cart-detail login-box" id="shipToAddress" <?= $shippingChooseActive == 1 ? 'style=" display: none;"' : '' ?>>
                        <h3>Ship to address</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <?php // throw new \yii\base\Exception($model->scenario);            ?>
                                <?=
                                $form->field($order, 'shippingFirstname')->textInput([
                                    'class' => 'fullwidth',
                                    'placeholder' => 'FIRSTNAME',
                                    'value' => $name["firstname"]
                                ])->label(false);
                                ?>
                            </div>
                            <div class="col-md-6">
                                <?=
                                $form->field($order, 'shippingLastname')->textInput([
                                    'class' => 'fullwidth',
                                    'placeholder' => 'LASTNAME',
                                    'value' => $name["lastname"]
                                ])->label(false);
                                ?>
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
                            <?//= $this->render('@app/themes/cozxy/layouts/checkout/item/ShipToAddress') ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?php // throw new \yii\base\Exception($model->scenario);              ?>
                                <?= $form->field($order, 'shippingTel')->textInput(['class' => 'fullwidth', 'placeholder' => 'PHONE'])->label(false); ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($order, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'EMAIL'])->label(false); ?>
                            </div>
                        </div>

                    </div>

                    <!-- E -->
                    <div class="col-xs-12 text-right">
                        <input type="hidden" name="orderId" value="<?= $order->orderId ?>">
                        <div id="continue-pick-up"></div>
                        <a href="<?= Url::to(['/cart']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">BACK</a>
                        <!--<a href="#" class="b btn-yellow" id="checkoutBtn">CONTINUE TO PAYMENT METHOD</a>-->
                        <button type="submit" class="b btn-yellow check-out <?php echo $shippingChooseActive == 2 ? 'continue-ship-to-address' : '' ?>" >CONTINUE TO CHECK OUT</button>
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
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>--> 
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
            document.getElementById('start').addEventListener('change', onChangeHandler);
            document.getElementById('LcpickingId').addEventListener('change', onChangeHandler);
            /*
             var onSelectChangeHandler = function () {
             //pickUp(directionsService, directionsDisplay);
             };
             //document.getElementById('pickUpId').addEventListener('click', onSelectChangeHandler);
             //document.getElementById("pickUpId").addEventListener("change", onSelectChangeHandler);
             document.getElementById("pickUpId").addEventListener("click", function () {
             pickUp(directionsService, directionsDisplay);
             });
             $(function () {
             //pickUpSet(p, lat, long, directionsService, directionsDisplay);
             });
             document.addEventListener("click", function () {
             // pickUpSet(p, lat, long, directionsService, directionsDisplay);
             });*/
            var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
            var iconBaseCozxy = '<?= Yii::$app->homeUrl ?>images/subscribe/';
            var icons = {
            parking: {
            //icon: iconBase + 'parking_lot_maps.png'
            icon: iconBase + 'parking_lot_maps.png'
            },
                    library: {
                    //icon: iconBase + 'library_maps.png'
                    icon: iconBase + 'library_maps.png'
                    },
                    info: {
                    //icon: iconBase + 'info-i_maps.png'
                    icon: iconBase + 'info-i_maps.png'
                    },
                    cozxy: {
                    icon: iconBaseCozxy + 'cozxy-map.png'
                    }
            };
            var features = [
<?php
foreach ($activeMap as $key => $value) {
    $order = array("\r\n", "\n", "\r");
    $replace = '';
    $description = str_replace($order, $replace, $value['description']);
    ?>{
                position: new google.maps.LatLng(<?= $value['latitude'] ?>, <?= $value['longitude'] ?>),
                        type: 'cozxy',
                        location: "<?= strip_tags($value['title']) ?>",
                        contentString: "<?= $description ?>",
                        pickingId:<?= $value['pickingId'] ?>,
                        latitudes : <?= $value['latitude'] ?>,
                        longitudes :<?= $value['longitude'] ?>
                }
                ,<?php } ?>
            ];
            features.forEach(function (feature) {
            var mapDiv = document.getElementById('map');
                    // We add a DOM event here to show an alert if the DIV containing the
                    // map is clicked.
                    /* google.maps.event.addDomListener(icons[feature.type].icon, 'click', function() {
                     window.alert('Map was clicked!');
                     });*/
                    var marker = new google.maps.Marker({
                    position: feature.position,
                            icon: icons[feature.type].icon,
                            map: map,
                            title: feature.location,
                            content: feature.contentString,
                    });
                    google.maps.event.addDomListener(marker, 'click', function () {
                    //window.alert('Map was clicked!');
                    //pickUpClick(feature.position, directionsService, directionsDisplay);
                    });
                    info = new google.maps.InfoWindow();
                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                    pickUpClick(map, feature.pickingId, feature.location, feature.latitudes, feature.longitudes, directionsService, directionsDisplay);
                            //info.setContent(feature.content);
                            //info.setContent('<div><strong>' + feature.location + '</strong><br>' +
                            //'Place ID: ' + feature.contentString + '</div>');
                            //info.open(map, marker);
                    }
                    })(marker));
            });
            // เรียกใช้คุณสมบัติ ระบุตำแหน่ง ของ html 5 ถ้ามี
            geoLocation(map, 'initMap', '', '');
            /****** Autocomplete *******/
            autocomplete(map);
            /*******Test Not Allow Map*************/
            //handleNoGeolocation(map);
            // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
            GGM.event.addListener(map, 'zoom_changed', function () {
            $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
            });
    }


    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
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
            var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
            var iconBaseCozxy = '<?= Yii::$app->homeUrl ?>images/subscribe/';
            var icons = {
            parking: {
            //icon: iconBase + 'parking_lot_maps.png'
            icon: iconBase + 'parking_lot_maps.png'
            },
                    library: {
                    //icon: iconBase + 'library_maps.png'
                    icon: iconBase + 'library_maps.png'
                    },
                    info: {
                    //icon: iconBase + 'info-i_maps.png'
                    icon: iconBase + 'info-i_maps.png'
                    },
                    cozxy: {
                    icon: iconBaseCozxy + 'cozxy-map.png'
                    }
            };
            var features = [
<?php
foreach ($activeMap as $key => $value) {
    $order = array("\r\n", "\n", "\r");
    $replace = '';
    $description = str_replace($order, $replace, $value['description']);
    ?>{
                position: new google.maps.LatLng(<?= $value['latitude'] ?>, <?= $value['longitude'] ?>),
                        type: 'cozxy',
                        location: "<?= strip_tags($value['title']) ?>",
                        contentString: "<?= $description ?>",
                        pickingId: "<?= $value['pickingId'] ?>",
                        latitudes: "<?= $value['latitude'] ?>",
                        longitudes: "<?= $value['longitude'] ?>",
                }
                ,
<?php } ?>
            ];
            features.forEach(function (feature) {
            var marker = new google.maps.Marker({
            position: feature.position,
                    icon: icons[feature.type].icon,
                    map: map,
                    title: feature.location,
                    content: feature.contentString,
            });
                    info = new google.maps.InfoWindow();
                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                    pickUpClick(map, feature.pickingId, feature.location, feature.latitudes, feature.longitudes, directionsService, directionsDisplay);
                            //info.setContent(feature.content);
                            //info.setContent('<div><strong>' + feature.location + '</strong><br>' +
                            //        'Place ID: ' + feature.contentString + '</div>');
                            //info.open(map, marker);
                    }
                    })(marker));
            });
            var LcpickingId = $('#LcpickingId').val();
            var fields = LcpickingId.split('-');
            var pickingId = fields[0];
            var latlongMap = fields[1];
            /*******If Not Allow Map*************/

            //var start = $("#start").val();
            var noAllow = $("#no_allow").val();
            NotAllowMap(noAllow, latlongMap, '-'); // If Not Allow Map Function
            /*if (start == 0){
             var llMap = latlongMap.split(',');
             $("#lat_value").val(llMap[0]);
             $("#lon_value").val(llMap[1]);
             $("#zoom_value").val(map.getZoom());
             $("#start").val(latlongMap);
             }*/
            //alert(latlongMap);
            directionsService.route({
            origin: $('#start').val(), //document.getElementById('start').value,
                    //destination: document.getElementById('LcpickingId').value,
                    destination: latlongMap,
                    travelMode: 'DRIVING'
            }, function (response, status) {
            if (status === 'OK') {
            directionsDisplay.setDirections(response);
                    $('#continue-pick-up').html('<input type="hidden" name="pickingId-lats-longs" value="' + pickingId + '-' + latlongMap + '">');
            } else {
            window.alert('Directions request failed due to ' + status);
            }
            });
    }

    function pickUpSet(p, lats, longs, directionsService, directionsDisplay) {
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
            //showLocationMap();
            var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
            var iconBaseCozxy = '<?= Yii::$app->homeUrl ?>images/subscribe/';
            var icons = {
            parking: {
            //icon: iconBase + 'parking_lot_maps.png'
            icon: iconBase + 'parking_lot_maps.png'
            },
                    library: {
                    //icon: iconBase + 'library_maps.png'
                    icon: iconBase + 'library_maps.png'
                    },
                    info: {
                    //icon: iconBase + 'info-i_maps.png'
                    icon: iconBase + 'info-i_maps.png'
                    },
                    cozxy: {
                    icon: iconBaseCozxy + 'cozxy-map.png'
                    }
            };
            var features = [
<?php
foreach ($activeMap as $key => $value) {
    $order = array("\r\n", "\n", "\r");
    $replace = '';
    $description = str_replace($order, $replace, $value['description']);
    ?>{
                position: new google.maps.LatLng(<?= $value['latitude'] ?>, <?= $value['longitude'] ?>),
                        type: 'cozxy',
                        location: "<?= strip_tags($value['title']) ?>",
                        contentString: "<?= $description ?>",
                        pickingId: "<?= $value['pickingId'] ?>",
                        latitudes: "<?= $value['latitude'] ?>",
                        longitudes: "<?= $value['longitude'] ?>",
                }
                ,<?php } ?>
            ];
            features.forEach(function (feature) {
            var marker = new google.maps.Marker({
            position: feature.position,
                    icon: icons[feature.type].icon,
                    map: map,
                    title: feature.location,
                    content: feature.contentString,
            });
                    info = new google.maps.InfoWindow();
                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                    pickUpClick(map, feature.pickingId, feature.location, feature.latitudes, feature.longitudes, directionsService, directionsDisplay);
                            //info.setContent(feature.content);
                            //info.setContent('<div><strong>' + feature.location + '</strong><br>' +
                            //'Place ID: ' + feature.contentString + '</div>');
                            //info.open(map, marker);
                    }
                    })(marker));
            });
            //alert(p + ':' + lats + ':' + longs + ':' + directionsService + ':' + directionsDisplay);
            var latlongMap = lats + ',' + longs;
            /*******If Not Allow Map*************/
            //var start = $("#start").val();
            var noAllow = $("#no_allow").val();
            NotAllowMap(noAllow, latlongMap, ','); // If Not Allow Map Function
            directionsService.route({
            origin: $('#start').val(), //document.getElementById('start').value,
                    //destination: document.getElementById('LcpickingId').value,
                    destination: latlongMap,
                    travelMode: 'DRIVING'
            }, function (response, status) {
            if (status === 'OK') {
            directionsDisplay.setDirections(response);
                    //alert('OK');
                    //continue-pick-up
                    $('#continue-pick-up').html('<input type="hidden" name="pickingId-lats-longs" value="' + p + '-' + lats + ',' + longs + '">');
                    var pickingId = p;
                    var path = "ship-cozxy-box/location-pick-up-click";
                    $.ajax({
                    url: path,
                            type: "POST",
                            //dataType: "JSON",
                            data: {'pickingId': pickingId},
                            success: function (data, status) {
                            //alert(status);
                            if (status == "success") {

                            $('.location-pick-up').html(data);
                                    //alert(location);
                                    $('#title-location').html(location);
                                    $('#title-location-footer').html(location);
                                    //$('#stateId').val(provinceId).trigger('change');
                                    //$('#amphurId').val(amphurId).trigger('change');
                                    //$('#LcpickingId').val(pickingId + '-' + latitudes + ',' + longitudes).trigger('change');
                                    //alert(data);
                                    var path = "ship-cozxy-box/location-picking-point";
                                    $.ajax({
                                    url: path,
                                            type: "POST",
                                            dataType: "JSON",
                                            data: {'pickingId': pickingId},
                                            success: function (data, status) {
                                            //alert(status + '::' + data.provinceId + '::' + data.amphurId + '::' + data.pickingId);
                                            if (status == "success") {
                                            $('#title-location').html(location);
                                                    $('#title-location-footer').html(location);
                                                    $('#stateId').val(data.provinceId).trigger('change');
                                                    $('#amphurId').removeAttr('disabled');
                                                    $('#amphurId').html('<option value="' + data.amphurId + '">' + data.titleEn + ' / ' + data.titleTh + '   </option>');
                                                    //$('#amphurId').val(data.amphurId).trigger('change');
                                                    $('#LcpickingId').removeAttr('disabled');
                                                    $('#LcpickingId').html('<option value="' + data.pickingId + '-' + data.latitudes + ',' + data.longitudes + '">' + data.title + '</option>');
                                                    //$('#LcpickingId').val(data.pickingId + '-' + data.latitudes + ',' + data.longitudes).trigger('change');
                                                    //alert(data);
                                                    $('#title-location').html(data.title);
                                                    $('#title-location-footer').html(location);
                                                    var ClickamphurId = data.amphurId;
                                                    var ClickprovinceId = data.provinceId;
                                                    //alert(ClickamphurId + '::' + ClickprovinceId);
                                                    var path = "ship-cozxy-box/location-pick-up";
                                                    $.ajax({
                                                    url: path,
                                                            type: "POST",
                                                            //dataType: "JSON",
                                                            data: {'stateId': ClickprovinceId, 'amphurId': ClickamphurId},
                                                            success: function (data, status) {
                                                            //alert(status + ':x:' + ClickamphurId);
                                                            if (status == "success") {
                                                            $('.location-pick-up').html(data);
                                                                    //alert(ClickprovinceId + '::' + ClickamphurId);
                                                            } else {
                                                            //alert(status);
                                                            }
                                                            }
                                                    });
                                            } else {
                                            //alert(status);
                                            }
                                            }
                                    });
                            } else {
                            //alert(status);
                            }
                            }
                    });
            } else {
            window.alert('Directions request failed due to ' + status);
            }
            });
    }

    function pickUpClick(map, pickingId, location, latitudes, longitudes, directionsService, directionsDisplay) {
    //console.log(map.getZoom());
    map.setZoom(11);
            var latlongMap = latitudes + ',' + longitudes;
            /*******If Not Allow Map*************/
            //var start = $("#start").val();
            var noAllow = $("#no_allow").val();
            NotAllowMap(noAllow, latlongMap, ','); //If Not Allow Map Function
            directionsService.route({
            origin: $('#start').val(), //document.getElementById('start').value,
                    //destination: document.getElementById('LcpickingId').value,
                    destination: latlongMap,
                    travelMode: 'DRIVING'
            }, function (response, status) {
            ///console.log(response);
            if (status === 'OK') {
            directionsDisplay.setDirections(response);
                    map.setZoom(11);
                    //alert('OK');
                    //continue-pick-up
                    $('#continue-pick-up').html('<input type="hidden" name="pickingId-lats-longs" value="' + pickingId + '-' + latitudes + ',' + longitudes + '">');
                    var path = "ship-cozxy-box/location-pick-up-click";
                    $.ajax({
                    url: path,
                            type: "POST",
                            //dataType: "JSON",
                            data: {'pickingId': pickingId},
                            success: function (data, status) {
                            //alert(status);
                            if (status == "success") {

                            $('.location-pick-up').html(data);
                                    $('#title-location').html(location);
                                    $('#title-location-footer').html(location);
                                    //$('#stateId').val(provinceId).trigger('change');
                                    //$('#amphurId').val(amphurId).trigger('change');
                                    //$('#LcpickingId').val(pickingId + '-' + latitudes + ',' + longitudes).trigger('change');
                                    //alert(data);
                                    var path = "ship-cozxy-box/location-picking-point";
                                    $.ajax({
                                    url: path,
                                            type: "POST",
                                            dataType: "JSON",
                                            data: {'pickingId': pickingId},
                                            success: function (data, status) {
                                            //alert(status + '::' + data.provinceId + '::' + data.amphurId + ':' + data.titleTh + '::' + data.pickingId);
                                            if (status == "success") {
                                            $('#title-location').html(location);
                                                    $('#title-location-footer').html(location);
                                                    $('#stateId').val(data.provinceId).trigger('change');
                                                    $('#amphurId').removeAttr('disabled');
                                                    $('#amphurId').html('<option value="' + data.amphurId + '">' + data.titleEn + ' / ' + data.titleTh + '   </option>');
                                                    //$('#amphurId').val(data.amphurId).trigger('change');
                                                    $('#LcpickingId').removeAttr('disabled');
                                                    $('#LcpickingId').html('<option value="' + data.pickingId + '-' + data.latitudes + ',' + data.longitudes + '">' + data.title + '</option>');
                                                    //$('#LcpickingId').val(data.pickingId + '-' + data.latitudes + ',' + data.longitudes).trigger('change');
                                                    //alert(data);
                                                    var ClickamphurId = data.amphurId;
                                                    var ClickprovinceId = data.provinceId;
                                                    //alert(ClickamphurId + '::' + ClickprovinceId);
                                                    var path = "ship-cozxy-box/location-pick-up";
                                                    $.ajax({
                                                    url: path,
                                                            type: "POST",
                                                            //dataType: "JSON",
                                                            data: {'stateId': ClickprovinceId, 'amphurId': ClickamphurId},
                                                            success: function (data, status) {
                                                            //alert(status + ':x:' + ClickamphurId);
                                                            if (status == "success") {
                                                            $('.location-pick-up').html(data);
                                                                    //alert(ClickprovinceId + '::' + ClickamphurId);
                                                            } else {
                                                            //alert(status);
                                                            }
                                                            }
                                                    });
                                            } else {
                                            //alert(status);
                                            }
                                            }
                                    });
                            } else {
                            //alert(status);
                            }
                            }
                    });
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

    function customIcon(opts) {
    return Object.assign({
    path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
            fillColor: '#34495e',
            fillOpacity: 1,
            strokeColor: '#000',
            strokeWeight: 2,
            scale: 1,
    }, opts);
    }

    function geoLocation(map, status, lat, lng) {
    //alert(map);
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
    var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var labelIndex = 0;
            var pos1 = new GGM.LatLng(position.coords.latitude, position.coords.longitude);
            /** autocomplete **/
            if (status == 'autocomplete') {

    var image = 'https://cdn4.iconfinder.com/data/icons/icocentre-free-icons/114/f-cross_256-32.png';
            var beachMarker = new google.maps.Marker({
            position: pos1,
                    map: map,
                    icon: image
            });
            var my_Point = beachMarker.getPosition();
            /*var flightPath = new google.maps.Marker({
             map:map,
             position: pos1, label: labels[labelIndex++ % labels.length],
             });*/
            //flightPath.setMap(null);
    } else {
    var image = 'https://cdn1.iconfinder.com/data/icons/free-98-icons/32/map-marker-48.png';
            /*var infowindow = new GGM.InfoWindow({
             position: pos1,
             //content: '<div class="size18 fc-red">คุณอยู่ที่นี่.</div>'
             });*/
            var infowindow1 = new GGM.InfoWindow();
            var markera = new google.maps.Marker({
            map: map,
                    position: pos1, label: labels[labelIndex++ % labels.length]
            });
            var my_Point = markera.getPosition();
            /*var my_Point = infowindow.getPosition();*/ // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
            map.panTo(my_Point); // ให้แผนที่แสดงไปที่ตัว marker
            $("#lat_value").val(my_Point.lat()); // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
            $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
            $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value

            latMe = my_Point.lat();
            lngMe = my_Point.lng();
            $("#start").val(latMe + ',' + lngMe);
            //alert(latMe + ',' + lngMe);
            map.setCenter(pos1);
    }
    $("#no_allow").val('1');
            //console.log(my_Point.lat());
    }, function () {
    // คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน
    //alert('ไม่ทำงาน');
    handleNoGeolocation(map); // ตรวจตำแหน่ง lat/lng ไม่ได้ ให้ใช้ค่าเริ่มต้น

    });
    } else {
    // คำสั่งทำงาน ถ้า บราวเซอร์ ไม่สนับสนุน ระบุตำแหน่ง
    handleNoGeolocation(map); // ตรวจตำแหน่ง lat/lng ไม่ได้ ให้ใช้ค่าเริ่มต้น

    }
    }

    function autocomplete(map) {
    var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var labelIndex = 0;
            var card = document.getElementById('pac-card');
            var input = document.getElementById('pac-input');
            var types = document.getElementById('type-selector');
            var strictBounds = document.getElementById('strict-bounds-selector');
            //map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
            var autocomplete = new google.maps.places.Autocomplete(input);
            // Bind the map's bounds (viewport) property to the autocomplete object,
            // so that the autocomplete requests use the current map bounds for the
            // bounds option in the request.
            autocomplete.bindTo('bounds', map);
            var infowindow = new google.maps.InfoWindow();
            var infowindowContent = document.getElementById('infowindow-content');
            infowindow.setContent(infowindowContent);
            var marker = new google.maps.Marker({
            map: map,
                    anchorPoint: new google.maps.Point(0, - 29),
                    icon: customIcon({
                    fillColor: '#2ecc71'
                    }), label: labels[labelIndex++ % labels.length]
            });
            autocomplete.addListener('place_changed', function() {
            infowindow.close();
                    marker.setVisible(false);
                    var place = autocomplete.getPlace();
                    //console.log(place);
                    if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
                    return;
            } else{
            //alert('auto complete :' + place.geometry.location.lat());
            // Place a draggable marker on the map
            /*var markerAuto = new google.maps.Marker({
             map: map,
             position: new google.maps.LatLng(13.8714014, 100.6173063),
             map: map,
             //draggable:true,
             //title:"Drag me!"
             });*/
            geoLocation(map, 'autocomplete', place.geometry.location.lat(), place.geometry.location.lng());
                    //markerAuto = false;
                    //markerAuto = [];
                    //marker = [];
                    //console.log(marker);
                    //var location = $("#start").val();
                    //alert(location);
                    $("#lat_value").val(place.geometry.location.lat()); // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                    $("#lon_value").val(place.geometry.location.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                    $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
                    //$("#zoom_value").val(map.setZoom(11)); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
                    latMe = place.geometry.location.lat();
                    lngMe = place.geometry.location.lng();
                    $("#start").val(latMe + ',' + lngMe);
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
                    map.setZoom(11); // Why 17? Because it looks good.
            } else {
            map.setCenter(place.geometry.location);
                    map.setZoom(11); // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
                    marker.setVisible(true);
                    var address = '';
                    if (place.address_components) {
            address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
            }

            infowindowContent.children['place-icon'].src = place.icon;
                    infowindowContent.children['place-name'].textContent = place.name;
                    infowindowContent.children['place-address'].textContent = address;
                    infowindow.open(map, marker);
            }
            );
            // Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.
            /*function setupClickListener(id, types) {
             var radioButton = document.getElementById(id);
             radioButton.addEventListener('click', function() {
             autocomplete.setTypes(types);
             });
             }*/

            /*setupClickListener('changetype-all', []);
             setupClickListener('changetype-address', ['address']);
             setupClickListener('changetype-establishment', ['establishment']);
             setupClickListener('changetype-geocode', ['geocode']);
             document.getElementById('use-strict-bounds')
             .addEventListener('click', function() {
             console.log('Checkbox clicked! New state=' + this.checked);
             autocomplete.setOptions({strictBounds: this.checked});
             });*/
    }

    function handleNoGeolocation(map) {

    var bangkokCozxy = new google.maps.LatLng(13.871395, 100.61732);
            $("#no_allow").val('0');
            /*map.setCenter(bangkokCozxy);
             var infowindow = new GGM.InfoWindow({
             position: bangkokCozxy,
             //content: '<div class="size18 fc-red">คุณอยู่ที่นี่.</div>'
             });
             var marker = new google.maps.Marker({
             map: map,
             position: bangkokCozxy
             });*/
            //$("#lat_value").val(13.871395); // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
            //$("#lon_value").val(100.61732); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
            $("#zoom_value").val(11); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
            latMe = 13.871395;
            lngMe = 100.61732;
            //$("#start").val(latMe + ',' + lngMe);
            //map.panTo(bangkokCozxy); // ให้แผนที่แสดงไปที่ตัว marker
            //$("#geo_data").html('lat: 13.755716<br />long: 100.501589');
    }

    function NotAllowMap(start, latlongMap, status){ // if not allow map function

    if (start == 0){
    console.log(latlongMap);
            //console.log(map.getZoom());
            var llMap = latlongMap.split(',');
            $("#lat_value").val(llMap[0]);
            $("#lon_value").val(llMap[1]);
            //$("#zoom_value").val(map.getZoom());
            $("#start").val(latlongMap);
            //alert(latlongMap);
            console.log(latlongMap + ':' + llMap[0] + ':' + llMap[1]);
    }
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
            src: "//maps.google.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&v=3.2&sensor=false&language=th&libraries=places&callback=initMap"
    }).appendTo("body");
    });</script>
 <!--<script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&callback=initMap">
    </script>-->
<?php $this->registerCss('
#map {
            height: 450px;
        }

'); ?>



<div class = "modal fade bs-example-modal-lg" tabindex = "-1" role = "dialog" aria-labelledby = "myLargeModalLabel" aria-hidden = "true" id = "myGoogleMap" >
    <div class = "modal-dialog" ><!-- Modal content-->
        <div class = "modal-content" >
            <div class = "modal-header" >
                <button type = "button" class = "close" data-dismiss = "modal" > × </button>
                <h4 class = "modal-title" > <i class = "fa fa-exclamation-circle" > </i>Your title goes here</h4 >
            </div>
            <div class = "modal-body" >
                Your content goes here
            </div>
            <div class = "modal-footer" >
                <button type = "button" class = "btn btn-default" data-dismiss = "modal" > Submit </button>
            </div>
        </div>

    </div>
</div>
