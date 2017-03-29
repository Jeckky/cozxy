<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PointUsedMaster;

/**
* This is the model class for table "point_used".
*
    * @property string $pointUsedId
    * @property integer $userId
    * @property integer $orderId
    * @property integer $point
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class PointUsed extends \common\models\costfit\master\PointUsedMaster{
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
