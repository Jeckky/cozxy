<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\AmphurMaster;

/**
* This is the model class for table "amphur".
*
    * @property string $amphurId
    * @property string $amphurCode
    * @property string $amphurName
    * @property integer $geographyId
    * @property integer $provinceId
*/

class Amphur extends \common\models\costfit\master\AmphurMaster{
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
