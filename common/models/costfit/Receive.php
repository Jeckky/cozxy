<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ReceiveMaster;

/**
 * This is the model class for table "receive".
 *
 * @property string $receiveId
 * @property string $orderId
 * @property string $userId
 * @property string $pickingId
 * @property string $password
 * @property string $otp
 * @property integer $isUse
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Receive extends \common\models\costfit\master\ReceiveMaster
{

    /**
     * @inheritdoc
     */
    const ERROR_PASSWORD = 9999;

    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

}
