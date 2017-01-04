<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\FurnitureItemMaster;

/**
* This is the model class for table "furniture_item".
*
    * @property string $furnitureItemId
    * @property string $furnitureId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $plan
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Furniture $furniture
            * @property FurnitureItemSub[] $furnitureItemSubs
    */

class FurnitureItem extends \common\models\costfit\master\FurnitureItemMaster{
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
