<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_spacial_project".
*
    * @property string $userSpacialProjectId
    * @property string $supplierId
    * @property string $userId
    * @property string $orderGroupId
    * @property string $orderId
    * @property string $supplierSpacialProjectId
    * @property string $spacialCode
    * @property string $spacialPercent
    * @property string $image
    * @property string $remark
    * @property integer $reQuestNo
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UserSpacialProjectMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_spacial_project';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['supplierId', 'userId', 'orderGroupId', 'orderId', 'supplierSpacialProjectId', 'createDateTime'], 'required'],
            [['supplierId', 'userId', 'orderGroupId', 'orderId', 'supplierSpacialProjectId', 'reQuestNo', 'status'], 'integer'],
            [['spacialPercent'], 'number'],
            [['remark'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['spacialCode'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userSpacialProjectId' => Yii::t('user_spacial_project', 'User Spacial Project ID'),
    'supplierId' => Yii::t('user_spacial_project', 'Supplier ID'),
    'userId' => Yii::t('user_spacial_project', 'User ID'),
    'orderGroupId' => Yii::t('user_spacial_project', 'Order Group ID'),
    'orderId' => Yii::t('user_spacial_project', 'Order ID'),
    'supplierSpacialProjectId' => Yii::t('user_spacial_project', 'Supplier Spacial Project ID'),
    'spacialCode' => Yii::t('user_spacial_project', 'Spacial Code'),
    'spacialPercent' => Yii::t('user_spacial_project', 'Spacial Percent'),
    'image' => Yii::t('user_spacial_project', 'Image'),
    'remark' => Yii::t('user_spacial_project', 'Remark'),
    'reQuestNo' => Yii::t('user_spacial_project', 'Re Quest No'),
    'status' => Yii::t('user_spacial_project', 'Status'),
    'createDateTime' => Yii::t('user_spacial_project', 'Create Date Time'),
    'updateDateTime' => Yii::t('user_spacial_project', 'Update Date Time'),
];
}
}
