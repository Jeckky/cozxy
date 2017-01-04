<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CategoryStakeProvinceMaster;

/**
* This is the model class for table "category_stake_province".
*
    * @property string $id
    * @property string $categoryId
    * @property string $stake
    * @property string $provinceId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class CategoryStakeProvince extends \common\models\costfit\master\CategoryStakeProvinceMaster{
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
