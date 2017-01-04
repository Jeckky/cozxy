<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "zipcodes".
*
    * @property integer $zipCodeId
    * @property string $districtCode
    * @property string $zipcode
*/
class ZipcodesMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'zipcodes';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['districtCode', 'zipcode'], 'required'],
            [['districtCode'], 'string', 'max' => 6],
            [['zipcode'], 'string', 'max' => 5],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'zipCodeId' => Yii::t('zipcodes', 'Zip Code ID'),
    'districtCode' => Yii::t('zipcodes', 'District Code'),
    'zipcode' => Yii::t('zipcodes', 'Zipcode'),
];
}
}
