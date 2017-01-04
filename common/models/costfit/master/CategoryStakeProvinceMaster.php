<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "category_stake_province".
*
    * @property string $id
    * @property string $categoryId
    * @property string $stake
    * @property string $provinceId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CategoryStakeProvinceMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'category_stake_province';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['categoryId', 'stake', 'provinceId', 'createDateTime'], 'required'],
            [['categoryId', 'provinceId', 'status'], 'integer'],
            [['stake'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('category_stake_province', 'ID'),
    'categoryId' => Yii::t('category_stake_province', 'Category ID'),
    'stake' => Yii::t('category_stake_province', 'Stake'),
    'provinceId' => Yii::t('category_stake_province', 'Province ID'),
    'status' => Yii::t('category_stake_province', 'Status'),
    'createDateTime' => Yii::t('category_stake_province', 'Create Date Time'),
    'updateDateTime' => Yii::t('category_stake_province', 'Update Date Time'),
];
}
}
