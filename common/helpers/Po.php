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
 * Description of Po
 *
 * @author it , Taninut.Bm
 * create date : 27/03/2017
 * Support Suppliers.
 * emial : taninut.b@cozxy.com , sodapew17@gmial.com
 */
class Po {
    /*
     * หารายการ Order ที่ ORDER_STATUS_E_PAYMENT_SUCCESS แล้ว
     */

    public static function PoSuppliers($token) {
        $poSuppliers = \common\models\costfit\Order::find()->where("status=" . \common\models\costfit\Order::ORDER_STATUS_CREATEPO)->all();
        return isset($poSuppliers) ? $poSuppliers : NULL;
    }

}
