<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\TempAmphurMaster;

/**
* This is the model class for table "_temp_amphur".
*
    * @property string $amphurId
    * @property string $amphurCode
    * @property string $amphurName
    * @property integer $geographyId
    * @property integer $provinceId
*/

class TempAmphur extends \common\models\costfit\master\TempAmphurMaster{
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
