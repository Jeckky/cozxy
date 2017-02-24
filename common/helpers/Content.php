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
 * Description of Content
 *
 * @author it
 * Creste BY : Taninut.Bm
 * Create Date : 24/02/2017
 */
class Content {

//put your code here
    public static function ContentLogo($type) {
        //logoImageTop : รูป logo header
        //logoImage : รูป logo ส่วน Footer
        // NEWS , contactFooter
        $content = \common\models\costfit\ContentGroup::find()->where("lower(title)='" . $type . "'")->one(); //common\models\costfit\ContentGroup::find()->where("lower(title)='" . $type . "'")->one();
        return $content;
    }

}
