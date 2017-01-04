<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "promotion".
*
    * @property string $promotionId
    * @property string $partnerTypeId
    * @property string $title
    * @property string $description
    * @property string $creatorId
    * @property string $startDateTime
    * @property string $endDateTime
    * @property string $percent
    * @property string $value
    * @property string $accumulation
    * @property integer $type
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PromotionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'promotion';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['partnerTypeId', 'title', 'startDateTime', 'endDateTime', 'type', 'createDateTime'], 'required'],
            [['partnerTypeId', 'creatorId', 'type', 'status'], 'integer'],
            [['description'], 'string'],
            [['startDateTime', 'endDateTime', 'createDateTime', 'updateDateTime'], 'safe'],
            [['percent', 'value', 'accumulation'], 'number'],
            [['title'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'promotionId' => Yii::t('promotion', 'Promotion ID'),
    'partnerTypeId' => Yii::t('promotion', 'Partner Type ID'),
    'title' => Yii::t('promotion', 'Title'),
    'description' => Yii::t('promotion', 'Description'),
    'creatorId' => Yii::t('promotion', 'Creator ID'),
    'startDateTime' => Yii::t('promotion', 'Start Date Time'),
    'endDateTime' => Yii::t('promotion', 'End Date Time'),
    'percent' => Yii::t('promotion', 'Percent'),
    'value' => Yii::t('promotion', 'Value'),
    'accumulation' => Yii::t('promotion', 'Accumulation'),
    'type' => Yii::t('promotion', 'Type'),
    'image' => Yii::t('promotion', 'Image'),
    'status' => Yii::t('promotion', 'Status'),
    'createDateTime' => Yii::t('promotion', 'Create Date Time'),
    'updateDateTime' => Yii::t('promotion', 'Update Date Time'),
];
}
}
