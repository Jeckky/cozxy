<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\FurnitureMaster;

/**
* This is the model class for table "furniture".
*
    * @property string $furnitureId
    * @property string $furnitureGroupId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property FurnitureGroup $furnitureGroup
            * @property FurnitureItem[] $furnitureItems
    */

class Furniture extends \common\models\costfit\master\FurnitureMaster{
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
