<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\DistrictMaster;

/**
* This is the model class for table "district".
*
    * @property string $districtId
    * @property string $districtCode
    * @property string $districtName
    * @property integer $amphurId
    * @property integer $provinceId
    * @property integer $geographyId
    *
            * @property OrderGroup[] $orderGroups
            * @property Supplier[] $suppliers
    */

class District extends \common\models\costfit\master\DistrictMaster{
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
