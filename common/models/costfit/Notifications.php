<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\NotificationsMaster;

/**
 * This is the model class for table "notifications".
 *
 * @property string $notiId
 * @property string $id
 * @property string $title
 * @property string $type
 * @property integer $status
 * @property string $parentId
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Notifications extends \common\models\costfit\master\NotificationsMaster {

    const NOTI_APPROVE = 1;

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

    public function findCheckoutStepArray() {
        return [
            self::NOTI_APPROVE => "Suppliers",
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
