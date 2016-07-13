<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserMaster;

/**
 * This is the model class for table "user".
 *
 * @property string $userId
 * @property string $username
 * @property string $hash_password
 * @property string $firstname
 * @property string $password
 * @property string $lastname
 * @property string $email
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property Address[] $addresses
 * @property Order[] $orders
 * @property Product[] $products
 */
class User extends \common\models\costfit\master\UserMaster
{

    public $confirmPassword;
    public $acceptTerm;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            ['email', 'unique'],
//            ['email', 'uniqueEmail'],
            ['email', 'email'],
//            ['email', 'exist', 'targetAttribute' => 'username', 'targetClass' => '\common\models\cosfit\User'],
            [['email', 'password', 'confirmPassword', 'acceptTerm'], 'required', 'on' => 'register'],
//            ['email', 'unique', 'targetClass' => '\common\models\costfit\User', 'message' => 'this email address has already been taken'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Confirm Passwords don't match"]
//            ['email', 'exist']
        ]);
    }

    public function uniqueEmail($attribute, $email)
    {
        throw new \yii\base\Exception($email);
        $user = static::findOne(['email' => Yii::$app->encrypter->encrypt($email)]);
        if (count($user) > 0)
            $this->addError($attribute, 'This email is already in use".');
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), [
//            'acceptTerm',
//            'confirmPassword'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
        ]);
    }

    public static function getIsExistWishlist($productId)
    {
        $ws = \common\models\costfit\Wishlist::find()->where("productId =" . $productId . " AND userId = " . \Yii::$app->user->id)->one();
        if (isset($ws)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillingAddresses()
    {
        return $this->hasMany(AddressMaster::className(), ['userId' => 'userId'])->where('address.type=1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingAddresses()
    {
        return $this->hasMany(AddressMaster::className(), ['userId' => 'userId'])->where('address.type=2');
    }

}
