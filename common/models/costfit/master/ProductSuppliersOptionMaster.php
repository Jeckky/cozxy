<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_suppliers_option".
*
    * @property string $productSuppliersOptionId
    * @property string $productGroupOptionId
    * @property string $value
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property string $product_productId
    * @property string $productGroupTemplateOptionId
    *
            * @property Product $productProduct
            * @property ProductGroupTemplateOption $productGroupTemplateOption
            * @property ProductGroupOption $productGroupOption
    */
class ProductSuppliersOptionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_suppliers_option';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productGroupOptionId', 'value', 'createDateTime', 'product_productId', 'productGroupTemplateOptionId'], 'required'],
            [['productGroupOptionId', 'status', 'product_productId', 'productGroupTemplateOptionId'], 'integer'],
            [['value'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['product_productId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductMaster::className(), 'targetAttribute' => ['product_productId' => 'productId']],
            [['productGroupTemplateOptionId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroupTemplateOptionMaster::className(), 'targetAttribute' => ['productGroupTemplateOptionId' => 'productGroupTemplateOptionId']],
            [['productGroupOptionId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroupOptionMaster::className(), 'targetAttribute' => ['productGroupOptionId' => 'productGroupOptionId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productSuppliersOptionId' => Yii::t('product_suppliers_option', 'Product Suppliers Option ID'),
    'productGroupOptionId' => Yii::t('product_suppliers_option', 'Product Group Option ID'),
    'value' => Yii::t('product_suppliers_option', 'Value'),
    'status' => Yii::t('product_suppliers_option', 'Status'),
    'createDateTime' => Yii::t('product_suppliers_option', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_suppliers_option', 'Update Date Time'),
    'product_productId' => Yii::t('product_suppliers_option', 'Product Product ID'),
    'productGroupTemplateOptionId' => Yii::t('product_suppliers_option', 'Product Group Template Option ID'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductProduct()
    {
    return $this->hasOne(ProductMaster::className(), ['productId' => 'product_productId']);
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
    public function getProductGroupOption()
    {
    return $this->hasOne(ProductGroupOptionMaster::className(), ['productGroupOptionId' => 'productGroupOptionId']);
    }
}
