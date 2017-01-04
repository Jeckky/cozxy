<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserSpacialProjectMaster;

/**
* This is the model class for table "user_spacial_project".
*
    * @property string $userSpacialProjectId
    * @property string $supplierId
    * @property string $userId
    * @property string $orderGroupId
    * @property string $orderId
    * @property string $supplierSpacialProjectId
    * @property string $spacialCode
    * @property string $spacialPercent
    * @property string $image
    * @property string $remark
    * @property integer $reQuestNo
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class UserSpacialProject extends \common\models\costfit\master\UserSpacialProjectMaster{
/**
* @inheritdoc
*/
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
