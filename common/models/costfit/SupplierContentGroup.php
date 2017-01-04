<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\SupplierContentGroupMaster;

/**
* This is the model class for table "supplier_content_group".
*
    * @property string $supplierContentGroupId
    * @property string $supplierId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class SupplierContentGroup extends \common\models\costfit\master\SupplierContentGroupMaster{
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
