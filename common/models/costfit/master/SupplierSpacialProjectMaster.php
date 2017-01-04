<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "supplier_spacial_project".
*
    * @property string $supplierSpacialProjectId
    * @property string $supplierId
    * @property string $code
    * @property string $title
    * @property string $description
    * @property string $image
    * @property string $percent
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class SupplierSpacialProjectMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'supplier_spacial_project';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['supplierId', 'code', 'title', 'percent'], 'required'],
            [['supplierId', 'status'], 'integer'],
            [['description'], 'string'],
            [['percent'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['code'], 'string', 'max' => 50],
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
    'supplierSpacialProjectId' => Yii::t('supplier_spacial_project', 'Supplier Spacial Project ID'),
    'supplierId' => Yii::t('supplier_spacial_project', 'Supplier ID'),
    'code' => Yii::t('supplier_spacial_project', 'Code'),
    'title' => Yii::t('supplier_spacial_project', 'Title'),
    'description' => Yii::t('supplier_spacial_project', 'Description'),
    'image' => Yii::t('supplier_spacial_project', 'Image'),
    'percent' => Yii::t('supplier_spacial_project', 'Percent'),
    'status' => Yii::t('supplier_spacial_project', 'Status'),
    'createDateTime' => Yii::t('supplier_spacial_project', 'Create Date Time'),
    'updateDateTime' => Yii::t('supplier_spacial_project', 'Update Date Time'),
];
}
}
