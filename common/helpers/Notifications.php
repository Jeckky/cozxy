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
 * Description of Notifications
 *
 * @author it
 * 4/1/2017 By Taninut.Bm
 */
class Notifications {

    //put your code here

    public static function NotificationsApprove($productSuppId) {
        $suppliers = \common\models\costfit\Notifications::find()->where('id=' . $productSuppId . ' and type =1')->orderBy('notiId desc')->one();
        return isset($suppliers) ? $suppliers->notiId : NULL;
    }

}
