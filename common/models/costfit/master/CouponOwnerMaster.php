<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "coupon_owner".
*
    * @property string $couponOwnerId
    * @property string $code
    * @property string $name
    * @property string $description
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CouponOwnerMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'coupon_owner';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['code', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['code'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'couponOwnerId' => Yii::t('coupon_owner', 'Coupon Owner ID'),
    'code' => Yii::t('coupon_owner', 'Code'),
    'name' => Yii::t('coupon_owner', 'Name'),
    'description' => Yii::t('coupon_owner', 'Description'),
    'image' => Yii::t('coupon_owner', 'Image'),
    'status' => Yii::t('coupon_owner', 'Status'),
    'createDateTime' => Yii::t('coupon_owner', 'Create Date Time'),
    'updateDateTime' => Yii::t('coupon_owner', 'Update Date Time'),
];
}
}
