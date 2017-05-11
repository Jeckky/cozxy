<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\StatesMaster;

/**
* This is the model class for table "states".
*
    * @property integer $stateId
    * @property string $code
    * @property string $stateName
    * @property string $localName
    * @property string $geographyId
    * @property string $countryId
    * @property double $latitude
    * @property double $longitude
*/

class States extends \common\models\costfit\master\StatesMaster{
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
