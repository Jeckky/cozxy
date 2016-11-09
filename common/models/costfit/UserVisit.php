<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserVisitMaster;

/**
 * This is the model class for table "user_visit".
 *
 * @property string $visit
 * @property string $userId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $lastvisitDate
 */
class UserVisit extends \common\models\costfit\master\UserVisitMaster {

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'countVisit', 'email', 'firstname', 'lastname'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

}
