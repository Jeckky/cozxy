<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_group_option".
*
    * @property string $productGroupOptionId
    * @property string $productGroupId
    * @property string $productGroupTemplateOptionId
    * @property string $name
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Product $productGroup
            * @property ProductGroupTemplateOption $productGroupTemplateOption
            * @property ProductGroupOptionValue[] $productGroupOptionValues
            * @property ProductSuppliersOption[] $productSuppliersOptions
    */
class ProductGroupOptionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_group_option';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productGroupId', 'productGroupTemplateOptionId', 'createDateTime'], 'required'],
            [['productGroupId', 'productGroupTemplateOptionId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['productGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductMaster::className(), 'targetAttribute' => ['productGroupId' => 'productId']],
            [['productGroupTemplateOptionId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroupTemplateOptionMaster::className(), 'targetAttribute' => ['productGroupTemplateOptionId' => 'productGroupTemplateOptionId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productGroupOptionId' => Yii::t('product_group_option', 'Product Group Option ID'),
    'productGroupId' => Yii::t('product_group_option', 'Product Group ID'),
    'productGroupTemplateOptionId' => Yii::t('product_group_option', 'Product Group Template Option ID'),
    'name' => Yii::t('product_group_option', 'Name'),
    'status' => Yii::t('product_group_option', 'Status'),
    'createDateTime' => Yii::t('product_group_option', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_group_option', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductGroup()
    {
    return $this->hasOne(ProductMaster::className(), ['productId' => 'productGroupId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductGroupTemplateOption()
    {
    return $this->hasOne(ProductGroupTemplateOptionMaster::className(), ['productGroupTemplateOptionId' => 'productGroupTemplateOptionId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductGroupOptionValues()
    {
    return $this->hasMany(ProductGroupOptionValueMaster::className(), ['productGroupOptionId' => 'productGroupOptionId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductSuppliersOptions()
    {
    return $this->hasMany(ProductSuppliersOptionMaster::className(), ['productGroupOptionId' => 'productGroupOptionId']);
    }
}
