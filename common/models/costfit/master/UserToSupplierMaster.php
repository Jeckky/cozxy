<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_to_supplier".
*
    * @property string $id
    * @property string $userId
    * @property string $supplierId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UserToSupplierMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_to_supplier';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'supplierId', 'createDateTime'], 'required'],
            [['userId', 'supplierId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('user_to_supplier', 'ID'),
    'userId' => Yii::t('user_to_supplier', 'User ID'),
    'supplierId' => Yii::t('user_to_supplier', 'Supplier ID'),
    'status' => Yii::t('user_to_supplier', 'Status'),
    'createDateTime' => Yii::t('user_to_supplier', 'Create Date Time'),
    'updateDateTime' => Yii::t('user_to_supplier', 'Update Date Time'),
];
}
}
