<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "picking_point".
*
    * @property integer $pickingId
    * @property integer $pickingItemsId
    * @property string $title
    * @property string $description
    * @property string $countryId
    * @property string $provinceId
    * @property string $amphurId
    * @property integer $status
    * @property integer $type
    * @property integer $isDefault
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PickingPointMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'picking_point';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['pickingId', 'pickingItemsId', 'createDateTime'], 'required'],
            [['pickingId', 'pickingItemsId', 'provinceId', 'amphurId', 'status', 'type', 'isDefault'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'description', 'countryId'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pickingId' => Yii::t('picking_point', 'Picking ID'),
    'pickingItemsId' => Yii::t('picking_point', 'Picking Items ID'),
    'title' => Yii::t('picking_point', 'Title'),
    'description' => Yii::t('picking_point', 'Description'),
    'countryId' => Yii::t('picking_point', 'Country ID'),
    'provinceId' => Yii::t('picking_point', 'Province ID'),
    'amphurId' => Yii::t('picking_point', 'Amphur ID'),
    'status' => Yii::t('picking_point', 'Status'),
    'type' => Yii::t('picking_point', 'Type'),
    'isDefault' => Yii::t('picking_point', 'Is Default'),
    'createDateTime' => Yii::t('picking_point', 'Create Date Time'),
    'updateDateTime' => Yii::t('picking_point', 'Update Date Time'),
];
}
}
