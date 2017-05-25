<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_group_template".
*
    * @property string $productGroupTemplateId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Product[] $products
            * @property ProductGroupTemplateOption[] $productGroupTemplateOptions
    */
class ProductGroupTemplateMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_group_template';
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
    'productGroupTemplateId' => Yii::t('product_group_template', 'Product Group Template ID'),
    'title' => Yii::t('product_group_template', 'Title'),
    'description' => Yii::t('product_group_template', 'Description'),
    'status' => Yii::t('product_group_template', 'Status'),
    'createDateTime' => Yii::t('product_group_template', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_group_template', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProducts()
    {
    return $this->hasMany(ProductMaster::className(), ['productGroupTemplateId' => 'productGroupTemplateId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductGroupTemplateOptions()
    {
    return $this->hasMany(ProductGroupTemplateOptionMaster::className(), ['productGroupTemplateId' => 'productGroupTemplateId']);
    }
}
