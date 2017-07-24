<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "po".
*
    * @property string $poId
    * @property string $supplierId
    * @property string $poNo
    * @property string $summary
    * @property string $receiveDate
    * @property string $receiveBy
    * @property string $arranger
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PoMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'po';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['supplierId', 'receiveBy', 'arranger', 'status'], 'integer'],
            [['summary'], 'number'],
            [['receiveDate', 'createDateTime', 'updateDateTime'], 'safe'],
            [['createDateTime'], 'required'],
            [['poNo'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'poId' => Yii::t('po', 'Po ID'),
    'supplierId' => Yii::t('po', 'Supplier ID'),
    'poNo' => Yii::t('po', 'Po No'),
    'summary' => Yii::t('po', 'Summary'),
    'receiveDate' => Yii::t('po', 'Receive Date'),
    'receiveBy' => Yii::t('po', 'Receive By'),
    'arranger' => Yii::t('po', 'Arranger'),
    'status' => Yii::t('po', 'Status'),
    'createDateTime' => Yii::t('po', 'Create Date Time'),
    'updateDateTime' => Yii::t('po', 'Update Date Time'),
];
}
}
