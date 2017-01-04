<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProvinceMaster;

/**
* This is the model class for table "province".
*
    * @property string $provinceId
    * @property string $provinceCode
    * @property string $provinceName
    * @property integer $geographyId
    *
            * @property Supplier[] $suppliers
    */

class Province extends \common\models\costfit\master\ProvinceMaster{
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
