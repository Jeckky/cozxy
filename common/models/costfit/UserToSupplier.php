<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserToSupplierMaster;

/**
* This is the model class for table "user_to_supplier".
*
    * @property string $id
    * @property string $userId
    * @property string $supplierId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class UserToSupplier extends \common\models\costfit\master\UserToSupplierMaster{
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
