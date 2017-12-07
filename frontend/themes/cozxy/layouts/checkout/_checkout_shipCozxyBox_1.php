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
                            </div>
                            <div class=" text-center" style="margin-top: 10px;">
                                <button type="button" class="btn btn-default btn-lg">&nbsp;&nbsp;&nbsp;&nbsp;SEARCH&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
                            <div class="col-xs-4">
                                <?php
                                echo \yii\widgets\ListView::widget([
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
                                ]);
                                ?>
                            </div>
                            <div class="col-xs-8">
                                <div id="map_canvas"></div>
                                 <div id="showDD" style="margin:auto;padding-top:5px;width:550px;"> 
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
                                <!--<h4>Result for "Ladproa 20"</h4>-->
                                <div id="map" style="height:450px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-detail login-box" id="shipToAddress">
                        <h3>Ship to address</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <?php // throw new \yii\base\Exception($model->scenario);         ?>
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
                                <?php // throw new \yii\base\Exception($model->scenario);         ?>
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

<script type="text/javascript">
    var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
    var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
    function initialize() { // ฟังก์ชันแสดงแผนที่
        GGM = new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
        // กำหนดจุดเริ่มต้นของแผนที่
        var my_Latlng = new GGM.LatLng(13.761728449950002, 100.6527900695800);
        var my_mapTypeId = GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
        // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
        var my_DivObj = $("#map_canvas")[0];
        // กำหนด Option ของแผนที่
        var myOptions = {
            zoom: 13, // กำหนดขนาดการ zoom
            center: my_Latlng, // กำหนดจุดกึ่งกลาง
            mapTypeId: my_mapTypeId // กำหนดรูปแบบแผนที่
        };
        map = new GGM.Map(my_DivObj, myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map



        // เรียกใช้คุณสมบัติ ระบุตำแหน่ง ของ html 5 ถ้ามี
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = new GGM.LatLng(position.coords.latitude, position.coords.longitude);
                var infowindow = new GGM.InfoWindow({
                    map: map,
                    position: pos,
                    content: 'คุณอยู่ที่นี่.'
                });

                var my_Point = infowindow.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker
                $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
                map.setCenter(pos);
            }, function () {
                // คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน
            });
        } else {
            // คำสั่งทำงาน ถ้า บราวเซอร์ ไม่สนับสนุน ระบุตำแหน่ง
        }

        // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
        GGM.event.addListener(map, 'zoom_changed', function () {
            $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
        });

    }
    $(function () {
        // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
        // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
        // v=3.2&sensor=false&language=th&callback=initialize
        //  v เวอร์ชัน่ 3.2
        //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
        //  language ภาษา th ,en เป็นต้น
        //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize
        $("<script/>", {
            "type": "text/javascript",
            src: "//maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"
        }).appendTo("body");
    });
</script>

<script>
    var map, info;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            center: new google.maps.LatLng(13.847860, 100.604274),
            mapTypeId: 'roadmap'
        });

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
            {
                position: new google.maps.LatLng(13.817227246026727, 100.50787199179695),
                type: 'cozxy',
                location: 'Tesco Lotus Extra Ekamai Ramintra',
                contentString: 'ถนน ประดิษฐ์มนูธรรม แขวง ลาดพร้าว เขต ลาดพร้าว <br />กรุงเทพมหานคร ไทย <br />+66 2 935 9800 <br />www.facebook.com'
            }, {
                position: new google.maps.LatLng(13.881698194418705, 100.46672509179689),
                type: 'cozxy',
                location: 'Bangchak - Vibhavadi',
                contentString: '21/43-44 ถนนวิภาวดีรังสิต แขวงตลาดบางเขน เขต หลักสี่ <br />กรุงเทพมหานคร 10210 ประเทศไทย <br />+66 2 335 4999 <br />www.bangchak.co.th'
            }, {
                position: new google.maps.LatLng(13.850514153309353, 100.5255065917969),
                type: 'cozxy',
                location: 'Bangchak - Ekamai ramintra 4',
                contentString: '569 หมู่ - ถนนประดิษฐ์มนูธรรม แขวงลาดพร้าว เขต ลาดพร้าว <br />กรุงเทพมหานคร 10230 ประเทศไทย <br />+66 2 335 4999 <br />www.bangchak.co.th'
            }, {
                position: new google.maps.LatLng(13.753396636275411, 100.48291739179695),
                type: 'cozxy',
                location: 'Bangchak - Ekamai',
                contentString: '427/1 ซอยสุขุมวิท 63(เอกมัย) ถนนสุขุมวิท 63 แขวงคลองตันเหนือ เขตวัฒนา <br />กรุงเทพมหานคร 10250 ประเทศไทย <br />+66 2 335 4999 <br />www.bangchak.co.th'
            }, {
                position: new google.maps.LatLng(13.752173616376334, 100.51218199179687),
                type: 'cozxy',
                location: 'Bangchak - Pattanakarn 27',
                contentString: '1405 ถนนพัฒนาการ แขวง สวนหลวง เขต สวนหลวง <br />กรุงเทพมหานคร 10250 ประเทศไทย <br />+66 2 335 4999 <br />www.bangchak.co.th'
            }, {
                position: new google.maps.LatLng(13.751845037895192, 100.4663560917968),
                type: 'cozxy',
                location: 'Bangchak - Sukhumvit 39',
                contentString: '1/2 ซ.พร้อมศรี ถนนสุขุมวิท 39 แขวงคลองตันเหนือ เขตวัฒนา <br />กรุงเทพมหานคร 10250 ประเทศไทย <br />+66 2 335 4999 <br />www.bangchak.co.th'
            }, {
                position: new google.maps.LatLng(13.708053901294937, 100.5019578917969),
                type: 'cozxy',
                location: 'Bangchak - Sukhumvit 99 (coming soon)',
                contentString: '2999/1 ถนน สุขุมวิท แขวง บางจาก เขต พระโขนง <br />กรุงเทพมหานคร 10260 ประเทศไทย <br />+66 2 335 4999 <br />www.bangchak.co.th'
            }, {
                position: new google.maps.LatLng(13.75196263019403, 100.51759589179687),
                type: 'cozxy',
                location: 'Bangchak - Pattanakarn 34',
                contentString: '1348 ถนนพัฒนาการ แขวง สวนหลวง เขต สวนหลวง <br />กรุงเทพมหานคร 10250 ประเทศไทย <br />+66 2 335 4999 <br />www.bangchak.co.th'
            }, {
                position: new google.maps.LatLng(13.822871874561061, 100.51305459179684),
                type: 'cozxy',
                location: 'Bangchak - Ekamai ramintra 1',
                contentString: '28 ซ.โยธินพัฒนา หมู่ - ถนนคู่ขนานทางด่วนรามอินทรา-ลาดพร้าว แขวงคลองจั่น เขตบางกะปิ <br />กรุงเทพมหานคร 10240 ประเทศไทย <br />+66 2 335 4999 <br />www.bangchak.co.th'
            },
        ];

        // Create markers.
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
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&callback=initMap">
</script>
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


/* $this->registerJs('
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
  $("#map-address-cozxy-box").html(JSONObject.description);
  // Map Google in latitude and longitude for cozxy
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
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2, 4})+$/;
  var a = regex.test(email);
  return a;
  }

  $("#checkoutBtn").on("click", function(e){
  e.preventDefault();
  var error = 0;
  var pickingId, addressId, shippingFirstname, shippingLastname, shippingAddress, shippingProvince, shippingAmphur, shippingDistrict, shippingZipcode, shippingTel, shippingEmail;
  var shipTo = $("input[name=shipping]:checked").val();

  if(shipTo == 1) {
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
  checkBilling = $("#checkBillingTax").val();
  tax = $.trim($("#inputBillingTax").val());
  if(checkBilling == 1 && tax == ""){
  $("#billingTaxText").html("<span class=\"text-danger\">Please select billing address.</span>");
  error++;
  }else{
  $("#billingTaxText").html("");
  }
  checkTel = $.trim($("#checkTel").val());
  tel = $.trim($("#tel").val());
  if(checkTel == 0 && tel == "") {
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

  $this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&callback=initMap', ['depends' => ['yii\web\YiiAsset']]); */
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
