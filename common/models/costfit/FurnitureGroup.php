<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\FurnitureGroupMaster;

/**
* This is the model class for table "furniture_group".
*
    * @property string $furnitureGroupId
    * @property string $categoryId
    * @property string $category2Id
    * @property string $title
    * @property string $description
    * @property string $price
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Furniture[] $furnitures
    */

class FurnitureGroup extends \common\models\costfit\master\FurnitureGroupMaster{
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
