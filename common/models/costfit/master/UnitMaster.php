<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "unit".
*
    * @property string $unitId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Product[] $products
            * @property Product[] $products0
    */
class UnitMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'unit';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'unitId' => Yii::t('unit', 'Unit ID'),
    'title' => Yii::t('unit', 'Title'),
    'description' => Yii::t('unit', 'Description'),
    'status' => Yii::t('unit', 'Status'),
    'createDateTime' => Yii::t('unit', 'Create Date Time'),
    'updateDateTime' => Yii::t('unit', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProducts()
    {
    return $this->hasMany(ProductMaster::className(), ['smallUnit' => 'unitId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProducts0()
    {
    return $this->hasMany(ProductMaster::className(), ['unit' => 'unitId']);
    }
}
