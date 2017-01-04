<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_partner_promotion".
*
    * @property string $id
    * @property string $userId
    * @property string $partnerPromotionId
    * @property integer $status
*/
class UserPartnerPromotionMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_partner_promotion';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['userId', 'partnerPromotionId'], 'required'],
            [['userId', 'partnerPromotionId', 'status'], 'integer'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('user_partner_promotion', 'ID'),
    'userId' => Yii::t('user_partner_promotion', 'User ID'),
    'partnerPromotionId' => Yii::t('user_partner_promotion', 'Partner Promotion ID'),
    'status' => Yii::t('user_partner_promotion', 'Status'),
];
}
}
