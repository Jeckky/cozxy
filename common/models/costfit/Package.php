<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PackageMaster;

/**
* This is the model class for table "package".
*
    * @property string $packageId
    * @property string $packageTypeId
    * @property string $title
    * @property string $description
    * @property string $width
    * @property string $height
    * @property string $depth
    * @property string $weight
    * @property string $maxWeight
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Package extends \common\models\costfit\master\PackageMaster{
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
