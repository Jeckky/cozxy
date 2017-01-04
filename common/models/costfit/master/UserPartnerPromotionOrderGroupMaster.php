<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "user_partner_promotion_order_group".
*
    * @property string $userPartnerPromotionId
    * @property string $orderGroupId
*/
class UserPartnerPromotionOrderGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_partner_promotion_order_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['orderGroupId'], 'required'],
            [['orderGroupId'], 'integer'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'userPartnerPromotionId' => Yii::t('user_partner_promotion_order_group', 'User Partner Promotion ID'),
    'orderGroupId' => Yii::t('user_partner_promotion_order_group', 'Order Group ID'),
];
}
}
