<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "warranty_period".
*
    * @property string $warrantyPeriodId
    * @property string $title
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class WarrantyPeriodMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'warranty_period';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['status'], 'integer'],
            [['createDateTime'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'warrantyPeriodId' => Yii::t('warranty_period', 'Warranty Period ID'),
    'title' => Yii::t('warranty_period', 'Title'),
    'status' => Yii::t('warranty_period', 'Status'),
    'createDateTime' => Yii::t('warranty_period', 'Create Date Time'),
    'updateDateTime' => Yii::t('warranty_period', 'Update Date Time'),
];
}
}
