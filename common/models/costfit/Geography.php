<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\GeographyMaster;

/**
* This is the model class for table "geography".
*
    * @property integer $geographyId
    * @property string $geographyName
*/

class Geography extends \common\models\costfit\master\GeographyMaster{
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
