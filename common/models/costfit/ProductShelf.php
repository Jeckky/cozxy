<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductShelfMaster;

/**
* This is the model class for table "product_shelf".
*
    * @property string $productShelfId
    * @property string $title
    * @property integer $userId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ProductShelf extends \common\models\costfit\master\ProductShelfMaster{
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
