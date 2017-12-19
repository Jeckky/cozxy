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
        $pickingPointActiveMap = \common\models\costfit\PickingPoint::find()->where('status =1 and `latitude` is not null and `longitude` is not null')->all();
        foreach ($pickingPointActiveMap as $key => $value) {
            $activeMap['position'] = $value->latitude . ',' . $value->longitude;
            $activeMap['type'] = 'cozxy';
            $activeMap['location'] = $value->title;
            $activeMap['contentString'] = $value->description;
            $activeMap['pickingId'] = $value->pickingId;
            $activeMap['latitudes'] = $value->latitude;
            $activeMap['longitudes'] = $value->longitude;
        }

        return \yii\helpers\Json::encode($activeMap);
    }

}
