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
class User extends \common\models\costfit\master\UserMaster {

    public $confirmPassword;
    public $acceptTerm;
    public $currentPassword;
    public $newPassword;
    public $rePassword;

    const USER_REGISTER = 0;
    const USER_CONFIRM_EMAIL = 1;

    //const USER_STATUS_CHECKOUTS = 2;
    //const USER_STATUS_E_PAYMENT_DRAFT = 3;
    //const USER_STATUS_COMFIRM_PAYMENT = 4;
    // const USER_STATUS_E_PAYMENT_SUCCESS = 5;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
            ['email', 'unique'],
//            ['email', 'uniqueEmail'],
            ['email', 'email'],
//            ['email', 'exist', 'targetAttribute' => 'username', 'targetClass' => '\common\models\cosfit\User'],
            [['email', 'password', 'confirmPassword', 'acceptTerm'], 'required', 'on' => 'register'],
//            ['email', 'unique', 'targetClass' => '\common\models\costfit\User', 'message' => 'this email address has already been taken'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Confirm Passwords don't match"],
//            ['email', 'exist']
            [['firstname', 'lastname', 'acceptTerm'], 'required', 'on' => 'editinfo'],
            // [['currentPassword', 'newPassword', 'rePassword'], 'required'],
            [['currentPassword', 'newPassword', 'rePassword'], 'required', 'on' => 'profile'],
            // ['currentPassword', 'findPasswords'],
            ['rePassword', 'compare', 'compareAttribute' => 'newPassword', 'on' => 'profile'],
        ]);
    }

    public function uniqueEmail($attribute, $email) {
        // throw new \yii\base\Exception($email);
        $user = static::findOne(['email' => Yii::$app->encrypter->encrypt($email)]);
        if (count($user) > 0)
            $this->addError($attribute, 'This email is already in use".');
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
//            'acceptTerm',
//            'confirmPassword'
            'currentPassword',
            'newPassword',
            'rePassword',
            'orderHistory',
            'orderSummary',
            'searchUser'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'username' => 'Email',
            'firstname' => 'Name',
            'orderHistory' => 'Order History',
            'orderSummary' => 'Order Summary'
        ]);
    }

    public function findAllStatusArray() {
        return [
            self::USER_REGISTER => "ยังไม่ยืนยันผ่านอีเมลล์",
            self::USER_CONFIRM_EMAIL => "ยืนยันผ่านแล้ว",
        ];
    }

    public function getStatusText($status) {
        $res = $this->findAllStatusArray($status);
        if (isset($res[$status])) {
            return $res[$status];
        } else {
            return NULL;
        }
    }

    public static function getIsExistWishlist($productId) {
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
    public function getBillingAddresses() {
        return $this->hasMany(AddressMaster::className(), ['userId' => 'userId'])->where('address.type=1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingAddresses() {
        return $this->hasMany(AddressMaster::className(), ['userId' => 'userId'])->where('address.type=2');
    }

    public function updateProfile($email, $userId) {
        return 'ok';
    }

    public function getFullName() {
        $fullName = '';
        if (isset($this->firstname)) {
            $fullName = $this->firstname . "  " . $this->lastname;
        }
        return $fullName;
    }

    public function getOrderSummary() {
        $summary = 0;
        $orders = Order::find()->where("userId=" . $this->userId)->all();
        if (isset($orders)) {
            foreach ($orders as $order)
                $summary+=$order->summary;
        }
        return $summary;
    }

}
