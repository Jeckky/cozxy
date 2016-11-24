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
    const USER_BLOCK = 99;
    const USER_STATUS_GENDER_Female = 0;
    const USER_STATUS_GENDER_Male = 1;
    // const user type //
    const USER_TYPE_FRONTEND = 1;
    const USER_TYPE_BACKEND = 2;
    const USER_TYPE_FRONTEND_BACKEND = 3;
    const USER_TYPE_SUPPLIERS = 4;

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
            'tel' => [['tel'], 'string'],
//            ['email', 'uniqueEmail'],
            ['email', 'email'],
//            ['email', 'exist', 'targetAttribute' => 'username', 'targetClass' => '\common\models\cosfit\User'],
            [['email', 'password', 'confirmPassword', 'acceptTerm'], 'required', 'on' => 'register'],
//            ['email', 'unique', 'targetClass' => '\common\models\costfit\User', 'message' => 'this email address has already been taken'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Confirm Passwords don't match"],
//            ['email', 'exist']
            [
                ['firstname', 'lastname', 'gender', 'tel' => [['tel'], 'integer'], 'birthDate', 'acceptTerm'],
                'required', 'on' => 'editinfo'],
            // [['currentPassword', 'newPassword', 'rePassword'], 'required'],
            [['currentPassword', 'newPassword', 'rePassword'], 'required', 'on' => 'profile'],
            // ['currentPassword', 'findPasswords'],
            ['rePassword', 'compare', 'compareAttribute' => 'newPassword', 'on' => 'profile'],
            //['username', 'email'],
            [['firstname', 'lastname', 'password', 'email', 'type', 'gender'], 'required', 'on' => 'user_backend'],
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
            'USER_STATUS_GENDER_Female' => 'Order History',
            'orderSummary' => 'Order Summary'
        ]);
    }

    public function findAllStatusArray() {
        return [
            self::USER_REGISTER => "<span class='text-warning'>ยังไม่ยืนยันผ่านอีเมลล์</span>",
            self::USER_CONFIRM_EMAIL => "<span class='text-success'>ยืนยันผ่านแล้ว</span>",
            self::USER_BLOCK => "<span class='text-danger'>ถูกระงับ</span>",
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

    public function findAllGenderArray() {
        return [

            self::USER_STATUS_GENDER_Female => "เพศหญิง",
            self::USER_STATUS_GENDER_Male => "เพศชาย",
        ];
    }

    public function getGenderText($status) {
        $res = $this->findAllGenderArray($status);
        if (isset($res[$status])) {
            return $res[$status];
        } else {
            return NULL;
        }
    }

    // USER TYPE
    public function findAllTypeArray() {
        return [
            //const USER_TYPE_FRONTEND = 1;
            //const USER_TYPE_BACKEND = 2;
            //const USER_TYPE_FRONTEND_BACKEND = 3;
            self::USER_TYPE_FRONTEND => "<span class='text-primary'>frontend</span>",
            self::USER_TYPE_BACKEND => "<span class='text-success'>backend</span>",
            self::USER_TYPE_FRONTEND_BACKEND => "<span class='text-warning'>frontend and backend</span>",
            self::USER_TYPE_SUPPLIERS => "<span class='text-info'>Suppliers</span>"
        ];
    }

    public function getTypeText($status) {
        $res = $this->findAllTypeArray($status);
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

    public static function userName($id) {
        $user = User::find()->where("userId=" . $id)->one();
        if (isset($user) && !empty($user)) {
            return $user->firstname . " " . $user->lastname;
        } else {
            return '';
        }
    }

}
