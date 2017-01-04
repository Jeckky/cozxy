<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "supplier_content_group".
*
    * @property string $supplierContentGroupId
    * @property string $supplierId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class SupplierContentGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'supplier_content_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['supplierId', 'title', 'createDateTime'], 'required'],
            [['supplierId', 'sortOrder', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'supplierContentGroupId' => Yii::t('supplier_content_group', 'Supplier Content Group ID'),
    'supplierId' => Yii::t('supplier_content_group', 'Supplier ID'),
    'title' => Yii::t('supplier_content_group', 'Title'),
    'description' => Yii::t('supplier_content_group', 'Description'),
    'image' => Yii::t('supplier_content_group', 'Image'),
    'sortOrder' => Yii::t('supplier_content_group', 'Sort Order'),
    'status' => Yii::t('supplier_content_group', 'Status'),
    'createDateTime' => Yii::t('supplier_content_group', 'Create Date Time'),
    'updateDateTime' => Yii::t('supplier_content_group', 'Update Date Time'),
];
}
}
