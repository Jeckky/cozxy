<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\SupplierSpacialProjectMaster;

/**
* This is the model class for table "supplier_spacial_project".
*
    * @property string $supplierSpacialProjectId
    * @property string $supplierId
    * @property string $code
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $percent
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class SupplierSpacialProject extends \common\models\costfit\master\SupplierSpacialProjectMaster{
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
