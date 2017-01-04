<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CategoryImageMaster;

/**
* This is the model class for table "category_image".
*
    * @property string $categoryImageId
    * @property string $categoryId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class CategoryImage extends \common\models\costfit\master\CategoryImageMaster{
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
