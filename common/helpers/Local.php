<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * Description of Local
 *
 * @author it
 */
class Local {

    //put your code here


    public static function Cities($amphurId) {
        $localNamecitie = \common\models\dbworld\Cities::find()->where("cityId = '" . $amphurId . "' ")->one();
        return $localNamecitie;
    }

    public static function States($provinceId) {
        $localNamestate = \common\models\dbworld\States::find()->where("stateId = '" . $provinceId . "' ")->one();
        return $localNamestate;
    }

    public static function Countries($countryId) {
        $localNamecountrie = \common\models\dbworld\Countries::find()->where("countryId = '" . $countryId . "' ")->one();
        return $localNamecountrie;
    }

    public static function District($districtId) {
        $localNamedistrict = \common\models\dbworld\District::find()->where("districtId = '" . $districtId . "' ")->one();
        return $localNamedistrict;
    }

}
