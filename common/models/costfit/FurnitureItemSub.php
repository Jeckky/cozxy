<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\FurnitureItemSubMaster;

/**
* This is the model class for table "furniture_item_sub".
*
    * @property string $furnitureItemSubId
    * @property string $furnitureItemId
    * @property string $code
    * @property string $description
    * @property string $image
    * @property integer $quantity
    * @property string $unit
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property FurnitureItem $furnitureItem
    */

class FurnitureItemSub extends \common\models\costfit\master\FurnitureItemSubMaster{
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
