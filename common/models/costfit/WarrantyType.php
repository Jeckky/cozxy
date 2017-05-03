<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\WarrantyTypeMaster;

/**
* This is the model class for table "warranty_type".
*
    * @property string $warrantyTypeId
    * @property string $title
    * @property string $defimition
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class WarrantyType extends \common\models\costfit\master\WarrantyTypeMaster{
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
