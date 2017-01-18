<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PointsRewardRankMaster;

/**
 * This is the model class for table "points_reward_rank".
 *
 * @property string $rankId
 * @property string $num1
 * @property string $num2
 * @property string $cash
 * @property string $points
 * @property integer $status
 * @property string $createBy
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class PointsRewardRank extends \common\models\costfit\master\PointsRewardRankMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'num1' => 'ราคาเริ่มต้น',
            'num2' => 'ถึงราคา',
            'cash' => 'เงินที่ได้',
            'points' => 'คะแนนที่ได้',
        ]);
    }

    public function findCheckoutStepArray() {
        return [
        ];
    }

    public function getCheckoutStepText($step) {
        $res = $this->findCheckoutStepArray();
        if (isset($res[$step])) {
            return $res[$step];
        } else {
            return NULL;
        }
    }

}
