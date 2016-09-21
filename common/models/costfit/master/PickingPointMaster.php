<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "picking_point".
*
    * @property integer $pickingId
    * @property string $title
    * @property string $countryId
    * @property string $provinceId
    * @property string $amphurId
    * @property integer $status
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
            [['provinceId', 'amphurId', 'status', 'isDefault'], 'integer'],
            [['createDateTime'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'countryId'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'pickingId' => Yii::t('picking_point', 'Picking ID'),
    'title' => Yii::t('picking_point', 'Title'),
    'countryId' => Yii::t('picking_point', 'Country ID'),
    'provinceId' => Yii::t('picking_point', 'Province ID'),
    'amphurId' => Yii::t('picking_point', 'Amphur ID'),
    'status' => Yii::t('picking_point', 'Status'),
    'isDefault' => Yii::t('picking_point', 'Is Default'),
    'createDateTime' => Yii::t('picking_point', 'Create Date Time'),
    'updateDateTime' => Yii::t('picking_point', 'Update Date Time'),
];
}
}
