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
 * Description of RewardPoints
 *
 * @author it
 * 6/1/2017 Taninut.Bm
 *
 */
class RewardPoints {

    //put your code here
    public static function getRankMemberPoints($orderUserId, $orderOrderId, $orderSummary) {
        $GetPointsRewardRank = \common\models\costfit\PointsRewardRank::find()->where('num1 >= ' . $orderSummary . ' and  num2 <=' . $orderSummary)->one();
        if (isset($GetPointsRewardRank)) {
            $pointsMember = new \common\models\costfit\PointsRewardMember();
            $pointsMember->rankId = $GetPointsRewardRank->rankId;
            $pointsMember->userId = $orderUserId;
            $pointsMember->orderId = $orderOrderId;
            if ($pointsMember->save(FALSE)) {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

}
