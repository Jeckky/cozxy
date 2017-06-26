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
use common\models\costfit\StoreProductGroup;

/**
 * Description of Po
 *
 * @author it , Taninut.Bm
 * create date : 27/03/2017
 * Support Suppliers.
 * emial : taninut.b@cozxy.com , sodapew17@gmial.com
 */
class ReturnProduct {
    /*
     * หารายการของใบ Po
     */

    public static function returnDate($updateDateTime) {
        $now = date('Y-m-d H:i:s');
        $date = (strtotime($now) - strtotime($updateDateTime)) / ( 60 * 60 * 24 );
        if ($date <= 7) {
            return true;
        } else {
            return false;
        }
    }

}
