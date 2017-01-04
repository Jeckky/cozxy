<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\SupplierContentMaster;

/**
* This is the model class for table "supplier_content".
*
    * @property string $supplierContentId
    * @property string $supplierContentGroupId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class SupplierContent extends \common\models\costfit\master\SupplierContentMaster{
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
