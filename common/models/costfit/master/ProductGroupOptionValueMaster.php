<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "product_group_option_value".
*
    * @property string $productGroupOptionValueId
    * @property string $productGroupOptionId
    * @property string $productGroupId
    * @property string $productId
    * @property string $productGroupTemplateId
    * @property string $value
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property ProductGroupOption $productGroupOption
            * @property Product $product
    */
class ProductGroupOptionValueMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'product_group_option_value';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['productGroupOptionId', 'productGroupId', 'productId', 'productGroupTemplateId', 'createDateTime'], 'required'],
            [['productGroupOptionId', 'productGroupId', 'productId', 'productGroupTemplateId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['value'], 'string', 'max' => 200],
            [['productGroupOptionId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroupOptionMaster::className(), 'targetAttribute' => ['productGroupOptionId' => 'productGroupOptionId']],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductMaster::className(), 'targetAttribute' => ['productId' => 'productId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'productGroupOptionValueId' => Yii::t('product_group_option_value', 'Product Group Option Value ID'),
    'productGroupOptionId' => Yii::t('product_group_option_value', 'Product Group Option ID'),
    'productGroupId' => Yii::t('product_group_option_value', 'Product Group ID'),
    'productId' => Yii::t('product_group_option_value', 'Product ID'),
    'productGroupTemplateId' => Yii::t('product_group_option_value', 'Product Group Template ID'),
    'value' => Yii::t('product_group_option_value', 'Value'),
    'status' => Yii::t('product_group_option_value', 'Status'),
    'createDateTime' => Yii::t('product_group_option_value', 'Create Date Time'),
    'updateDateTime' => Yii::t('product_group_option_value', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductGroupOption()
    {
    return $this->hasOne(ProductGroupOptionMaster::className(), ['productGroupOptionId' => 'productGroupOptionId']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProduct()
    {
    return $this->hasOne(ProductMaster::className(), ['productId' => 'productId']);
    }
}
