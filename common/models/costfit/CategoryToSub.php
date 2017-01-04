<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CategoryToSubMaster;

/**
* This is the model class for table "category_to_sub".
*
    * @property string $id
    * @property string $brandModelId
    * @property string $categoryId
    * @property string $subCategoryId
    * @property integer $isTheme
    * @property integer $isSet
    * @property integer $isType
    * @property integer $sortOrder
    * @property string $description
    * @property string $payCondition
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class CategoryToSub extends \common\models\costfit\master\CategoryToSubMaster{
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
