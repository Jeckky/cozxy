<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "section_item".
*
    * @property string $sectionItemId
    * @property integer $sectionId
    * @property integer $productId
    * @property integer $productSuppId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class SectionItemMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'section_item';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['sectionId', 'productId', 'productSuppId'], 'required'],
            [['sectionId', 'productId', 'productSuppId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'sectionItemId' => Yii::t('section_item', 'Section Item ID'),
    'sectionId' => Yii::t('section_item', 'Section ID'),
    'productId' => Yii::t('section_item', 'Product ID'),
    'productSuppId' => Yii::t('section_item', 'Product Supp ID'),
    'status' => Yii::t('section_item', 'Status'),
    'createDateTime' => Yii::t('section_item', 'Create Date Time'),
    'updateDateTime' => Yii::t('section_item', 'Update Date Time'),
];
}
}
