<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_group_template_option".
*
    * @property string $productGroupTemplateOptionId
    * @property string $productGroupTemplateId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property ProductGroupOption[] $productGroupOptions
            * @property ProductGroupTemplate $productGroupTemplate
            * @property ProductSuppliersOption[] $productSuppliersOptions
    */
class ProductGroupTemplateOptionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_group_template_option';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productGroupTemplateId', 'title', 'createDateTime'], 'required'],
            [['productGroupTemplateId', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['productGroupTemplateId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroupTemplateMaster::className(), 'targetAttribute' => ['productGroupTemplateId' => 'productGroupTemplateId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productGroupTemplateOptionId' => Yii::t('product_group_template_option', 'Product Group Template Option ID'),
    'productGroupTemplateId' => Yii::t('product_group_template_option', 'Product Group Template ID'),
    'title' => Yii::t('product_group_template_option', 'Title'),
    'description' => Yii::t('product_group_template_option', 'Description'),
    'status' => Yii::t('product_group_template_option', 'Status'),
    'createDateTime' => Yii::t('product_group_template_option', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_group_template_option', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductGroupOptions()
    {
    return $this->hasMany(ProductGroupOptionMaster::className(), ['productGroupTemplateOptionId' => 'productGroupTemplateOptionId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductGroupTemplate()
    {
    return $this->hasOne(ProductGroupTemplateMaster::className(), ['productGroupTemplateId' => 'productGroupTemplateId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductSuppliersOptions()
    {
    return $this->hasMany(ProductSuppliersOptionMaster::className(), ['productGroupTemplateOptionId' => 'productGroupTemplateOptionId']);
    }
}
