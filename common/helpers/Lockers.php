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
 * Description of Lockers
 *
 * @author it
 *
 */
class Lockers {
    /*
     * แสดงสถานที่ตั้งของ Lockers
     * Create date : 16/1/2017
     * By Taninut.BM
     * emial : taninut.b@cozxy.com , sodapew17@gmial.com
     */

    //put your code here

    /*
     * Get ข้อมูลของ PickingPoint
     * Create Date : 25/01/2017
     * By : Taninut.Bm
     */
    public static function GetPickingPoint($pickingId) {
        $listPoint = \common\models\costfit\PickingPoint::find()->where("pickingId = '" . $pickingId . "'")->one();
        return isset($listPoint) ? $listPoint : NULL;
    }

    /*
     * Get ข้อมูลของ PickingPointItems
     * Create Date : 25/01/2017
     * By : Taninut.Bm
     */

    public static function GetPickingPointItems($pickingId) {
        $query = \common\models\costfit\PickingPointItems::find()
        ->where("picking_point_items.pickingId = '" . $pickingId . "'");
        return $query;
    }

    public static function GetPickingPointItemsParameters($pickingId, $code) {
        $listPointItems = \common\models\costfit\PickingPointItems::find()->where("pickingId = '" . $pickingId . "' and  code = '" . $code . "' ")->one();
        return $listPointItems;
    }

}
