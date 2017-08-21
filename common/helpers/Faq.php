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
 * Description of Booth
 * Create By Taninut.bm
 * Create Date : 7/03/2017
 * @author it
 */
class Faq {

    //put your code here
    public static function Faqs($title) {
        $faq = \common\models\costfit\Content::find()->where("lower(title)='" . $title . "'")->one();
        if (isset($faq)) {
            return $faq->description;
        } else {
            return '';
        }
    }

}
