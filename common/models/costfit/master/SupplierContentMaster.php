<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "supplier_content".
*
    * @property string $supplierContentId
    * @property string $supplierContentGroupId
    * @property string $title
    * @property string $description
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class SupplierContentMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'supplier_content';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['supplierContentGroupId', 'title', 'createDateTime'], 'required'],
            [['supplierContentGroupId', 'status'], 'integer'],
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
    'supplierContentId' => Yii::t('supplier_content', 'Supplier Content ID'),
    'supplierContentGroupId' => Yii::t('supplier_content', 'Supplier Content Group ID'),
    'title' => Yii::t('supplier_content', 'Title'),
    'description' => Yii::t('supplier_content', 'Description'),
    'image' => Yii::t('supplier_content', 'Image'),
    'status' => Yii::t('supplier_content', 'Status'),
    'createDateTime' => Yii::t('supplier_content', 'Create Date Time'),
    'updateDateTime' => Yii::t('supplier_content', 'Update Date Time'),
];
}
}
