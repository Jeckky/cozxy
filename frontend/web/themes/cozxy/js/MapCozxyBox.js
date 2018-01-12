/*
 * Create date :  12/01/2018
 * Create By : Taninut.Bm
 */
var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
var latMe;
var lngMe;
var lat;
var long;
var p;
var $baseUrl = window.location.protocol + "//" + window.location.host;
if (window.location.host == 'localhost' || window.location.host == 'dev') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/cozxy/frontend/web/';
} else if (window.location.host == '192.168.100.8' || window.location.host == '192.168.100.20') {
//console.log($baseUrl);
    var str = window.location.pathname;
    var res = str.split("/");

    $baseUrl = window.location.protocol + "//" + window.location.host + '/' + res[1] + '/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
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
    var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
    var iconBaseCozxy = 'http://localhost/cozxy/frontend/web/images/subscribe/';
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

    function getData() {
        return $.ajax({
            url: $baseUrl + 'ship-cozxy-box/cozxy-box-json',
            type: 'GET'
        });
    }

    function handleData(data) {
        //console.log(data);
        var features = JSON.parse(data);
        features.forEach(function (feature) {
            var mapDiv = document.getElementById('map');
            //console.log(feature.position);
            // We add a DOM event here to show an alert if the DIV containing the
            // map is clicked.
            /* google.maps.event.addDomListener(icons[feature.type].icon, 'click', function() {
             window.alert('Map was clicked!');
             });*/
            //var position = feature.position;
            //var textPosition = position.toString().replace('"', '\\"')
            var positionS = new google.maps.LatLng(feature.latitudes, feature.longitudes);
            alert(positionS);
            //console.log(positionS);
            var marker = new google.maps.Marker({
                position: positionS,
                icon: icons[feature.type].icon,
                map: map,
                title: feature.location,
                content: feature.contentString,
            });
            //console.log(marker);

            google.maps.event.addDomListener(marker, 'click', function () {
                //window.alert('Map was clicked!');
                //pickUpClick(feature.position, directionsService, directionsDisplay);
                //console.log('test 2018');
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

    }

    getData().done(handleData);

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
    var iconBaseCozxy = 'http://localhost/cozxy/frontend/web/images/subscribe/';
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

    function getData() {
        return $.ajax({
            url: $baseUrl + 'ship-cozxy-box/cozxy-box-json',
            type: 'GET'
        });
    }

    function handleData(data) {
        //console.log(data);
        var features = JSON.parse(data);
        features.forEach(function (feature) {
            var mapDiv = document.getElementById('map');
            //console.log(feature.position);
            // We add a DOM event here to show an alert if the DIV containing the
            // map is clicked.
            /* google.maps.event.addDomListener(icons[feature.type].icon, 'click', function() {
             window.alert('Map was clicked!');
             });*/
            //var position = feature.position;
            //var textPosition = position.toString().replace('"', '\\"')
            var positionS = new google.maps.LatLng(feature.latitudes, feature.longitudes);
            //alert(positionS);
            //console.log(positionS);
            var marker = new google.maps.Marker({
                position: positionS,
                icon: icons[feature.type].icon,
                map: map,
                title: feature.location,
                content: feature.contentString,
            });
            //console.log(marker);

            google.maps.event.addDomListener(marker, 'click', function () {
                //window.alert('Map was clicked!');
                //pickUpClick(feature.position, directionsService, directionsDisplay);
                //console.log('test 2018');
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

    }

    getData().done(handleData);

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
    var iconBaseCozxy = 'http://localhost/cozxy/frontend/web/images/subscribe/';
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
    function getData() {
        return $.ajax({
            url: $baseUrl + 'ship-cozxy-box/cozxy-box-json',
            type: 'GET'
        });
    }

    function handleData(data) {
        //console.log(data);
        var features = JSON.parse(data);
        features.forEach(function (feature) {
            var mapDiv = document.getElementById('map');
            //console.log(feature.position);
            // We add a DOM event here to show an alert if the DIV containing the
            // map is clicked.
            /* google.maps.event.addDomListener(icons[feature.type].icon, 'click', function() {
             window.alert('Map was clicked!');
             });*/
            //var position = feature.position;
            //var textPosition = position.toString().replace('"', '\\"')
            var positionS = new google.maps.LatLng(feature.latitudes, feature.longitudes);
            //console.log(positionS);
            var marker = new google.maps.Marker({
                position: positionS,
                icon: icons[feature.type].icon,
                map: map,
                title: feature.location,
                content: feature.contentString,
            });
            //console.log(marker);

            google.maps.event.addDomListener(marker, 'click', function () {
                //window.alert('Map was clicked!');
                //pickUpClick(feature.position, directionsService, directionsDisplay);
                //console.log('test 2018');
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

    }

    getData().done(handleData);
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
            var path = $baseUrl + "ship-cozxy-box/location-pick-up-click";
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
                        var path = $baseUrl + "ship-cozxy-box/location-picking-point";
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
                                    var path = $baseUrl + "ship-cozxy-box/location-pick-up";
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
            var path = $baseUrl + "ship-cozxy-box/location-pick-up-click";
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
                        var path = $baseUrl + "ship-cozxy-box/location-picking-point";
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
                                    var path = $baseUrl + "ship-cozxy-box/location-pick-up";
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
        anchorPoint: new google.maps.Point(0, -29),
        icon: customIcon({
            fillColor: '#2ecc71'
        }), label: labels[labelIndex++ % labels.length]
    });
    autocomplete.addListener('place_changed', function () {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        //console.log(place);
        if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        } else {
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

function NotAllowMap(start, latlongMap, status) { // if not allow map function

    if (start == 0) {
//console.log(latlongMap);
//console.log(map.getZoom());
        var llMap = latlongMap.split(',');
        $("#lat_value").val(llMap[0]);
        $("#lon_value").val(llMap[1]);
        //$("#zoom_value").val(map.getZoom());
        $("#start").val(latlongMap);
        //alert(latlongMap);
        //console.log(latlongMap + ':' + llMap[0] + ':' + llMap[1]);
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

}
);