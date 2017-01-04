<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "order_detail_template".
*
    * @property string $orderDetailTemplateId
    * @property string $supplierId
    * @property string $title
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Supplier $supplier
    */
class OrderDetailTemplateMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'order_detail_template';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['supplierId', 'title', 'createDateTime'], 'required'],
            [['supplierId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 45],
            [['supplierId'], 'exist', 'skipOnError' => true, 'targetClass' => SupplierMaster::className(), 'targetAttribute' => ['supplierId' => 'supplierId']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'orderDetailTemplateId' => Yii::t('order_detail_template', 'Order Detail Template ID'),
    'supplierId' => Yii::t('order_detail_template', 'Supplier ID'),
    'title' => Yii::t('order_detail_template', 'Title'),
    'status' => Yii::t('order_detail_template', 'Status'),
    'createDateTime' => Yii::t('order_detail_template', 'Create Date Time'),
    'updateDateTime' => Yii::t('order_detail_template', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSupplier()
    {
    return $this->hasOne(SupplierMaster::className(), ['supplierId' => 'supplierId']);
    }
}
