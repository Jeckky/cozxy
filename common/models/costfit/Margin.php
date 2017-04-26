<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\MarginMaster;

/**
* This is the model class for table "margin".
*
    * @property string $marginId
    * @property string $brandId
    * @property string $categoryId
    * @property string $supplierId
    * @property string $percent
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Margin extends \common\models\costfit\master\MarginMaster{
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
