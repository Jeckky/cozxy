<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

/**
 * Description of CozxyMap
 *
 * @author cozxy
 */
class CozxyMap {

    //put your code here
    public static function PickingPointJson() {
        $desc = array("\r\n", "\n", "\r");
        $replace = '';
        //$description = str_replace($order, $replace, $value['description']);
        $pickingPointActiveMap = \common\models\costfit\PickingPoint::find()->where('status =1 and `latitude` is not null and `longitude` is not null')->all();
        foreach ($pickingPointActiveMap as $key => $value) {
            $activeMap[$key]['position'] = 'new google.maps.LatLng(' . $value->latitude . ',' . $value->longitude . ')';
            $activeMap[$key]['type'] = 'cozxy';
            $activeMap[$key]['location'] = $value->title;
            $activeMap[$key]['contentString'] = str_replace($desc, $replace, $value->description);
            $activeMap[$key]['pickingId'] = $value->pickingId;
            $activeMap[$key]['latitudes'] = $value->latitude;
            $activeMap[$key]['longitudes'] = $value->longitude;
        }

        return \yii\helpers\Json::encode($activeMap);
    }

}
