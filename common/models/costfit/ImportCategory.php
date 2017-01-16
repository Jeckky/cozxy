<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ImportCategoryMaster;

/**
* This is the model class for table "import_category".
*
    * @property string $categoryId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $parentId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ImportCategory extends \common\models\costfit\master\ImportCategoryMaster{
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
