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
?>
<style>
    /* css กำหนดความกว้าง ความสูงของแผนที่ */
    #map_canvas {
        width:550px;
        height:400px;
        margin:auto;
        /*  margin-top:100px;*/
    }
    #infowindow-content {
        display: none;
    }
    #map_canvas #infowindow-content {
        display: inline;
    }
</style>
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
                                Ship To CozxyBox
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
                            <h3>Ship To CozxyBox <span class="small"><a href="<?= Url::to(['/checkout/ship-to-cozxy-box']) ?>" target="_blank">view all</a></span></h3>
                        </div>
                        <div class="col-lg-12" style="margin-top: 10px; margin-bottom: 20px;">
                            At Cozxy, we want our customer to be in control of the way they shop, especially the way you receive your shopping orders. COZXYBOXS are self-service delivery lockers we send
                            shopping bags to,so that you can pick them up on your way home whenever you are free.
                        </div>

                        <div class="row fc-g999" style="padding: 40px;">
                            <div class="col-md-12 col-xs-12">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Select Province</label>
                                    <div class="col-sm-6">
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
                                            'options' => ['placeholder' => 'Select ...', 'id' => 'LcpickingId', 'name' => 'LcpickingId'],
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
                                <h4>COZXYBOX pick up location search results</h4>
                                <div id="map-address-cozxy-box" style=" margin-bottom: 5px;">
                                    &nbsp;Result for "Show All"
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
                                <div id="map"></div>
                                <!--<div id="infowindow-content">
                                     <img id="place-icon" src="" height="16" width="16">
                                     <span id="place-name"  class="title"></span><br>
                                     Place ID <span id="place-id"></span><br>
                                     <span id="place-address"></span>
                                 </div>-->
                                <input type="hidden" name="lat_value" id="lat_value" value="0">
                                <input type="hidden" name="lon_value" id="lon_value" value="0">
                                <input type="hidden" name="start" id="start" value="0">
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
                                    COZXYBOX Pickup location offer package pickup as self-service COZXYBOX Lockers and at staffed locations. Please enter address, postal code, landmark, or Amazon Locker name.
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="cart-detail login-box" id="shipToAddress">
                        <h3>Ship to address</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <?php // throw new \yii\base\Exception($model->scenario);          ?>
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
                                <?php // throw new \yii\base\Exception($model->scenario);          ?>
                                <?= $form->field($order, 'shippingTel')->textInput(['class' => 'fullwidth', 'placeholder' => 'PHONE'])->label(false); ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($order, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'EMAIL'])->label(false); ?>
                            </div>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
<script src="https://www.ninenik.com/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script type="text/javascript">

    var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
    var latMe;
    var lngMe;
    var lat;
    var long;
    var p;
    function showLocationMap() {

    }
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
    var iconBaseCozxy = 'http://www.cozxy.com/images/subscribe/';
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
                contentString: "<?= $description ?>"
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
    //info.setContent(feature.content);
    info.setContent('<div><strong>' + feature.location + '</strong><br>' +
            'Place ID: ' + feature.contentString + '</div>');
    info.open(map, marker);
    }
    })(marker));
    });
    // เรียกใช้คุณสมบัติ ระบุตำแหน่ง ของ html 5 ถ้ามี
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
    var pos = new GGM.LatLng(position.coords.latitude, position.coords.longitude);
    var infowindow = new GGM.InfoWindow({
    //map: map,
    position: pos,
            //content: '<div class="size18 fc-red">คุณอยู่ที่นี่.</div>'
    });
    var marker = new google.maps.Marker({
    map: map,
            position: pos
    });
    var my_Point = infowindow.getPosition(); // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
    map.panTo(my_Point); // ให้แผนที่แสดงไปที่ตัว marker
    $("#lat_value").val(my_Point.lat()); // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
    $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
    $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
    latMe = my_Point.lat();
    lngMe = my_Point.lng();
    $("#start").val(latMe + ',' + lngMe);
    map.setCenter(pos);
    }, function () {
    // คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน
    alert('ไม่ทำงาน');
    });
    } else {
    // คำสั่งทำงาน ถ้า บราวเซอร์ ไม่สนับสนุน ระบุตำแหน่ง
    }

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
    var iconBaseCozxy = 'http://www.cozxy.com/images/subscribe/';
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
                contentString: "<?= $description ?>"
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
    //info.setContent(feature.content);
    info.setContent('<div><strong>' + feature.location + '</strong><br>' +
            'Place ID: ' + feature.contentString + '</div>');
    info.open(map, marker);
    }
    })(marker));
    });
    var LcpickingId = $('#LcpickingId').val();
    var fields = LcpickingId.split('-');
    var pickingId = fields[0];
    var latlongMap = fields[1];
    //alert(latlongMap);
    directionsService.route({
    origin: $('#start').val(), //document.getElementById('start').value,
            //destination: document.getElementById('LcpickingId').value,
            destination: latlongMap,
            travelMode: 'DRIVING'
    }, function (response, status) {
    if (status === 'OK') {
    directionsDisplay.setDirections(response);
    } else {
    window.alert('Directions request failed due to ' + status);
    }
    });
    }

    function pickUp(directionsService, directionsDisplay) {
    //alert('xxx');
    var pickUpId = $('#pickUpId').attr("data-id");
    alert(pickUpId);
    alert(pickUpId + '::' + directionsService + '::' + directionsDisplay);
    if (pickUpId != undefined) {
    var fields = pickUpId.split('-');
    var pickingId = fields[0];
    var lat = fields[1];
    var long = fields[2];
    //alert(pickingId + '::' + lat + '::' + long);
    //return  lat + ',' + long;
    var latlongMap = lat + ',' + long;
    //alert($('#start').val() + '::' + latlongMap);
    directionsService.route({
    origin: $('#start').val(), //document.getElementById('start').value,
            //destination: document.getElementById('LcpickingId').value,
            destination: latlongMap,
            travelMode: 'DRIVING'
    }, function (response, status) {
    if (status === 'OK') {
    directionsDisplay.setDirections(response);
    } else {
    window.alert('Directions request failed due to ' + status);
    }
    });
    }
    }

    function pickUpSet(p, lat, long, directionsService, directionsDisplay) {
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
    var iconBaseCozxy = 'http://www.cozxy.com/images/subscribe/';
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
                contentString: "<?= $description ?>"
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
    //info.setContent(feature.content);
    info.setContent('<div><strong>' + feature.location + '</strong><br>' +
            'Place ID: ' + feature.contentString + '</div>');
    info.open(map, marker);
    }
    })(marker));
    });
    //alert(p + ':' + lat + ':' + long + ':' + directionsService + ':' + directionsDisplay);
    var latlongMap = lat + ',' + long;
    directionsService.route({
    origin: $('#start').val(), //document.getElementById('start').value,
            //destination: document.getElementById('LcpickingId').value,
            destination: latlongMap,
            travelMode: 'DRIVING'
    }, function (response, status) {
    if (status === 'OK') {
    directionsDisplay.setDirections(response);
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

            <!--<script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&callback=initMap">
            </script>-->
<?php
$this->registerCss('
#map {
            height: 450px;
        }

');
$this->registerJs('if ($("input[name=shipping]:checked").val() == 1) {
        $("#shipToAddress").hide();
    } else {
        $("#shipToCozxyBox").hide();
        $("#shipToAddress").show();
    }

    $("input[name=shipping]").change(function (e) {
        var shipTo = $(this).val();
        if (shipTo == 2) {
            $("#shipToCozxyBox").hide();
            $("#shipToAddress").show();
        } else {
            $("#shipToAddress").hide();
            $("#shipToCozxyBox").show();
        }
    }); ', \yii\web\View::POS_END);
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
