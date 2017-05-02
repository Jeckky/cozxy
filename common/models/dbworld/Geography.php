<?php

namespace common\models\dbworld;

use Yii;
use \common\models\dbworld\master\GeographyMaster;

/**
* This is the model class for table "geography".
*
    * @property string $geographyId
    * @property string $name
    * @property string $nameEn
*/

class Geography extends \common\models\dbworld\master\GeographyMaster{
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
