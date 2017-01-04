<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\TaninutMaster;

/**
* This is the model class for table "taninut".
*
    * @property integer $id
    * @property string $name
    * @property string $Taninutcol
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Taninut extends \common\models\costfit\master\TaninutMaster{
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
