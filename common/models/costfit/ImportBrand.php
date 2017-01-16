<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ImportBrandMaster;

/**
* This is the model class for table "import_brand".
*
    * @property string $brandId
    * @property string $userId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $status
    * @property string $parentId
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ImportBrand extends \common\models\costfit\master\ImportBrandMaster{
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
