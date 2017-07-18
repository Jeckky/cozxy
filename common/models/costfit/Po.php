<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\PoMaster;

/**
* This is the model class for table "po".
*
    * @property string $poId
    * @property string $supplierId
    * @property string $poNo
    * @property string $summary
    * @property string $receiveDate
    * @property integer $receiveBy
    * @property integer $arranger
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Po extends \common\models\costfit\master\PoMaster{
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
