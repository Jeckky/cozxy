<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

$this->title = 'YOUR SHIPPING & BILLING ADDRESS';
$this->params['breadcrumbs'][] = $this->title;
\frontend\assets\ShipCozxyBoxAsset::register($this);
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


<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <?php
        $form = ActiveForm::begin([
                    'id' => 'default-ship-cozxy-box',
                    //'action' => Yii::$app->homeUrl . 'checkout/summary',
                    'action' => $shippingChooseActive == 1 ? Yii::$app->homeUrl . 'checkout' : Yii::$app->homeUrl . 'checkout',
                    'options' => ['class' => 'space-bottom'],
                    'enableClientValidation' => false,
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
                                <?= Html::radio('shipping', $shippingChooseActive == 1 ? true : false, ['value' => 1, 'class' => 'shippingOption', 'id' => 'shipping']) ?>
                                Ship To CozxyBox
                                <!--   <a href="chk-edit1.php" class="pull-right btn-g999 p-edit">Edit</a></div><div class="col-xs-12 size6">&nbsp;-->
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <?//= Html::radio('shipping', (isset($order->shippingFirstname) && !isset($order->pickingId)) ? true : false, ['value' => 2, 'class' => 'shippingOption']) ?>
                                <?= Html::radio('shipping', $shippingChooseActive == 2 ? true : false, ['value' => 2, 'class' => 'shippingOption', 'id' => 'shipping']) ?>
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
                    <div class="cart-detail" id="shipToCozxyBox" <?= $shippingChooseActive == 2 ? 'style=" visibility: hidden; position: absolute; top: -9999px;  left: -9999px;"' : '' ?>>
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
                            <div class="col-xs-12 location-pick-up col-lg-4 col-md-4">
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
                            <div class="col-xs-12  col-lg-8 col-md-4">
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
                    <!--visibility: hidden vs. display: none -->
                    <div class="cart-detail login-box" id="shipToAddress" <?= $shippingChooseActive == 1 ? 'style=" visibility: hidden;  position: absolute; top: -9999px;  left: -9999px;"' : '' ?>>
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
                        <a href="javascript:shipCozxyBox()" class="b btn-yellow" id="checkoutBtn">CONTINUE TO PAYMENT METHOD</a>
                        <!--<button type="submit" class="b btn-yellow check-out <?php echo $shippingChooseActive == 2 ? 'continue-ship-to-address' : '' ?>" >CONTINUE TO CHECK OUT</button>-->
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
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="<?//= Yii::$app->homeUrl ?>themes/cozxy/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="<?//= Yii::$app->homeUrl ?>themes/cozxy/js/MapCozxyBox.js" type="text/javascript"></script>
<script async defer
        src="https:////maps.google.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&v=3.2&sensor=false&language=th&libraries=places&callback=initMap">
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
