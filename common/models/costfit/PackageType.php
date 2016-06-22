<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PackageTypeMaster;

/**
* This is the model class for table "package_type".
*
    * @property string $packageTypeId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class PackageType extends \common\models\costfit\master\PackageTypeMaster{
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
