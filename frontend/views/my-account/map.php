<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="map"></div>
<?php
$point = \common\models\costfit\PickingPoint::find()->where("pickingId=20")->one();
$lat = $point->latitude;
$lng = $point->longitude;
$this->registerCss('
#map {
   width: 600px;
   height: 300px;
   background-color: grey;
        }
');

$this->registerJs('
 var map;
function initMap() {
        var uluru = {lat: ' . $lat . ', lng: ' . $lng . '};
        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 17,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }', \yii\web\View::POS_HEAD);
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&callback=initMap', ['depends' => ['yii\web\YiiAsset']]);
?>
