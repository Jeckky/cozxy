<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "margin".
*
    * @property string $marginId
    * @property string $brandId
    * @property string $categoryId
    * @property string $supplierId
    * @property string $percent
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class MarginMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'margin';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['brandId', 'categoryId', 'supplierId', 'status'], 'integer'],
            [['percent', 'createDateTime'], 'required'],
            [['percent'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'marginId' => Yii::t('margin', 'Margin ID'),
    'brandId' => Yii::t('margin', 'Brand ID'),
    'categoryId' => Yii::t('margin', 'Category ID'),
    'supplierId' => Yii::t('margin', 'Supplier ID'),
    'percent' => Yii::t('margin', 'Percent'),
    'status' => Yii::t('margin', 'Status'),
    'createDateTime' => Yii::t('margin', 'Create Date Time'),
    'updateDateTime' => Yii::t('margin', 'Update Date Time'),
];
}
}
