<?php

use yii\helpers\Url;
use kartik\select2\Select2;

\frontend\assets\CheckoutAsset::register($this);
?>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
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
                            <div class="col-md-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        Ship to : <span class="size18">address <?php echo $pickingMap['title'] ?></span>
                                    </div>
                                </div>

                                <div class="row fc-g999">
                                    <?php if ($order->pickingId != 0): ?>
                                        <div class="col-xs-12">
                                            <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
                                            <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&sensor=true" type="text/javascript"></script>
                                            <script type="text/javascript">

                                                var map;
                                                var geocoder;
                                                var marker;
                                                var people = new Array();
                                                var latlng;
                                                var infowindow;

                                                $(document).ready(function () {
                                                    ViewCustInGoogleMap();
                                                });

                                                function ViewCustInGoogleMap() {

                                                    var mapOptions = {
                                                        center: new google.maps.LatLng(<?php echo $pickingMap['latitude'] ?>, <?php echo $pickingMap['longitude'] ?>), // Coimbatore = (11.0168445, 76.9558321)
                                                        zoom: 11,
                                                        //mapTypeId: 'hybrid'
                                                    };
                                                    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

                                                    // Get data from database. It should be like below format or you can alter it.

                                                    var data = '[{ "DisplayText": "<?php echo $pickingMap['title'] ?>", "ADDRESS": " <?php $myAddressInSummary['myAddresss']['address'] ?>", "LatitudeLongitude": "<?php echo $pickingMap['latitude'] ?>, <?php echo $pickingMap['longitude'] ?>", "MarkerId": "Customer" },\n\
                                                    { "DisplayText": "<?php echo $pickingMap['title'] ?>", "ADDRESS": "<?php $myAddressInSummary['myAddresss']['address'] ?>", "LatitudeLongitude": "<?php echo $pickingMap['latitude'] ?>, <?php echo $pickingMap['longitude'] ?>", "MarkerId": "Customer"}]';

                                                    people = JSON.parse(data);

                                                    for (var i = 0; i < people.length; i++) {
                                                        setMarker(people[i]);
                                                    }

                                                }

                                                function setMarker(people) {
                                                    geocoder = new google.maps.Geocoder();
                                                    infowindow = new google.maps.InfoWindow();
                                                    if ((people["LatitudeLongitude"] == null) || (people["LatitudeLongitude"] == 'null') || (people["LatitudeLongitude"] == '')) {
                                                        geocoder.geocode({'address': people["Address"]}, function (results, status) {
                                                            if (status == google.maps.GeocoderStatus.OK) {
                                                                latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                                                                marker = new google.maps.Marker({
                                                                    position: latlng,
                                                                    map: map,
                                                                    draggable: false,
                                                                    html: people["DisplayText"],
                                                                    icon: "images/marker/" + people["MarkerId"] + ".png"
                                                                });
                                                                //marker.setPosition(latlng);
                                                                //map.setCenter(latlng);
                                                                google.maps.event.addListener(marker, 'click', function (event) {
                                                                    infowindow.setContent(this.html);
                                                                    infowindow.setPosition(event.latLng);
                                                                    infowindow.open(map, this);
                                                                });
                                                            } else {
                                                                alert(people["DisplayText"] + " -- " + people["Address"] + ". This address couldn't be found");
                                                            }
                                                        });
                                                    } else {
                                                        var latlngStr = people["LatitudeLongitude"].split(",");
                                                        var lat = parseFloat(latlngStr[0]);
                                                        var lng = parseFloat(latlngStr[1]);
                                                        latlng = new google.maps.LatLng(lat, lng);
                                                        marker = new google.maps.Marker({
                                                            position: latlng,
                                                            map: map,
                                                            draggable: false, // cant drag it
                                                            html: people["DisplayText"]    // Content display on marker click
                                                                    //icon: "images/marker.png"       // Give ur own image
                                                        });
                                                        //marker.setPosition(latlng);
                                                        //map.setCenter(latlng);
                                                        google.maps.event.addListener(marker, 'click', function (event) {
                                                            infowindow.setContent(this.html);
                                                            infowindow.setPosition(event.latLng);
                                                            infowindow.open(map, this);
                                                        });
                                                    }
                                                }

                                            </script>
                                            <h4>Map</h4>
                                            <div id="map-canvas" style=" width:100%;height:300px;border:0;"> </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-lg-2 col-md-2 col-sm-12">Name:</div>
                                        <div class="col-lg-10 col-md-10 col-sm-12"><?= $order->shippingFirstname . ' ' . $order->shippingLastname ?></div>
                                        <div class="size6">&nbsp;</div>
                                        <div class="col-lg-2 col-md-3 col-sm-12">Address:</div>
                                        <div class="col-lg-10 col-md-9 col-sm-12">
                                            <?= $order->shippingAddress ?>&nbsp;
                                            <?= $order->shippingDistrict->localName ?>&nbsp;
                                            <?= $order->shippingCities->localName ?>&nbsp;
                                            <?= $order->shippingProvince->localName ?>&nbsp;
                                        </div>
                                        <div class="size12">&nbsp;</div><div class="col-lg-2 col-md-2 col-sm-12">Tel:</div>
                                        <div class="col-lg-10 col-md-10 col-sm-12"><?= $order->shippingTel ?></div>
                                        <div class="size6">&nbsp;</div><div class="col-lg-2 col-md-2 col-sm-12">Email:</div>
                                        <div class="col-lg-10 col-md-10 col-sm-12"><?= $order->email ?></div>
                                        <div class="size6">&nbsp;</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        Billing Address
                                    </div>
                                </div>

                                <div class="row fc-g999">

                                    <div class="col-lg-2 col-md-2 col-sm-12">Name:</div>
                                    <div class="col-lg-10 col-md-10 col-sm-12"><?php echo $myAddressInSummary['myAddresss']['firstname'] ?> <?php echo $myAddressInSummary['myAddresss']['lastname'] ?></div>
                                    <div class="size6">&nbsp;</div>
                                    <div class="col-lg-2 col-md-3 col-sm-12">Address:</div>
                                    <div class="col-lg-10 col-md-9 col-sm-12">
                                        <?php echo $myAddressInSummary['myAddresss']['address'] ?>&nbsp;
                                        <?php echo $myAddressInSummary['myAddresss']['amphur'] ?>&nbsp;
                                        <?php echo $myAddressInSummary['myAddresss']['district'] ?>&nbsp;
                                        <?php echo $myAddressInSummary['myAddresss']['province'] ?>&nbsp;
                                        <?php echo $myAddressInSummary['myAddresss']['zipcode'] ?>&nbsp;
                                        <?php echo $myAddressInSummary['myAddresss']['country'] ?>&nbsp;
                                    </div>
                                    <div class="size12">&nbsp;</div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Cart Items-->
                    <?php
                    foreach ($this->params['cart']['items'] as $item) {
                        // throw new \yii\base\Exception(print_r($item["image"], true));
                        echo $this->render('_checkout_item', compact('item'));
                    }
                    ?>
                    <div class="col-xs-12 text-right">
                        <a href="<?= Url::to(['/cart']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">BACK</a>
                        &nbsp;
                        <input type="hidden" name="orderId" value="<?= $order->orderId ?>">
                    </div>
                    <div class="size12 size10-xs">&nbsp;</div>
                </div>

            </div>

        </div>

        <!-- Total -->
        <div class="col-lg-3 col-md-4">
            <?= $this->render('_checkout_total', ['order' => $order, 'addressId' => $addressId, 'userPoint' => $userPoint]) ?>

        </div>

    </div>
</div>

<div class="size12 size10-xs">&nbsp;</div>
