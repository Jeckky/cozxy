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
    const USER_TYPE_CONTENT = 5;
    const USER_TYPE_MYACCOUNT = 6;
    //const USER_STATUS_CHECKOUTS = 2;
    //const USER_STATUS_E_PAYMENT_DRAFT = 3;
    //const USER_STATUS_COMFIRM_PAYMENT = 4;
    // const USER_STATUS_E_PAYMENT_SUCCESS = 5;

    const COZXY_REGIS = 'register';
    const COZXY_PROFILE = 'profile';
    const COZXY_USER_BACKEND = 'user_backend';
    const COZXY_EDIT_PROFILE = 'editinfo';
    const COZXY_CONFIRM = 'verification';
    const COZXY_CONFIRM_BOOTH = 'ConfirmRegisterBooth';

    /**
     * User Type bit
     */
    const USER_CUSTOMER = 0x1;
    const USER_BACKEND = 0x2;
    const USER_SUPPLIER = 0x4;
    const USER_CONTENT = 0x8;
    const USER_ACCOUNT = 0x10;
    const USER_FINANCE = 0x20;
    const USER_BOOTH = 0x40;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
            ['firstname', 'required'],
            ['lastname', 'required'],
            ['email', 'unique'],
            'tel' => [['tel'], 'number'], //, 'min' => 8
            ['tel', 'string', 'length' => [10]],
            ['newPassword', 'string', 'min' => 8],
            ['password', 'string', 'min' => 6],
            ['password', 'required', 'message' => 'OTP cannot be blank.'],
            ['rePassword', 'required', 'message' => 'Re Password must be equal to "New Password".'],
//            ['email', 'uniqueEmail'],
            ['email', 'email'],
//            ['email', 'exist', 'targetAttribute' => 'username', 'targetClass' => '\common\models\cosfit\User'],
            [['email', 'password', 'confirmPassword', 'acceptTerm'], 'required', 'on' => self::COZXY_REGIS],
//            ['email', 'unique', 'targetClass' => '\common\models\costfit\User', 'message' => 'this email address has already been taken'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Confirm Passwords don't match"],
//            ['email', 'exist']
            [
                ['firstname', 'lastname', 'gender', 'tel' => [['tel'], 'integer'], 'birthDate', 'acceptTerm'],
                'required', 'on' => self::COZXY_EDIT_PROFILE],
            // [['currentPassword', 'newPassword', 'rePassword'], 'required'],
            [['currentPassword', 'newPassword', 'rePassword'], 'required', 'on' => self::COZXY_PROFILE],
            // ['currentPassword', 'findPasswords'],
            ['rePassword', 'compare', 'compareAttribute' => 'newPassword', 'on' => self::COZXY_PROFILE],
            //['username', 'email'],
            [['firstname', 'lastname', 'password', 'email', 'type', 'gender'], 'required', 'on' => self::COZXY_USER_BACKEND],
            [['firstname', 'lastname', 'email', 'password', 'confirmPassword'], 'required', 'on' => 'register_new'],
            [['tel'], 'required', 'on' => self::COZXY_CONFIRM],
            [['password', 'email'], 'required', 'on' => self::COZXY_CONFIRM_BOOTH],
        ]);
    }

    public function scenarios() {
        return [
            self::COZXY_CONFIRM => ['tel'],
            self::COZXY_REGIS => ['email', 'password', 'confirmPassword', 'acceptTerm'],
            self::COZXY_PROFILE => ['currentPassword', 'newPassword', 'rePassword', ['currentPassword', 'newPassword', 'rePassword']],
            self::COZXY_USER_BACKEND => ['firstname', 'lastname', 'password', 'email', 'type', 'gender'],
            self::COZXY_EDIT_PROFILE => ['firstname', 'lastname', 'gender', 'tel' => [['tel'], 'integer'], 'birthDate', 'acceptTerm'],
            self::COZXY_CONFIRM_BOOTH => ['password', 'email']
        ];
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

    public function findAllGenderArrayEn() {
        return [
            self::USER_STATUS_GENDER_Female => "Female",
            self::USER_STATUS_GENDER_Male => "Male",
        ];
    }

    public function getGenderTextEn($status) {
        $res = $this->findAllGenderArrayEn($status);
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
            self::USER_TYPE_SUPPLIERS => "<span class='text-info'>Suppliers</span>",
            self::USER_TYPE_CONTENT => "<span class='text-info'>Content</span>",
            self::USER_TYPE_MYACCOUNT => "<span class='text-info'>ACCOUNT</span>"
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
        return $this->hasMany(Address::className(), ['userId' => 'userId'])->where('address.type=1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingAddresses() {
        return $this->hasMany(Address::className(), ['userId' => 'userId'])->where('address.type=2');
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
                $summary += $order->summary;
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

    public static function supplierDetail($userId) {
        //$detail = Address::find()->where("userId=" . $userId . " and isDefault=1")->one();
        $detail = Address::find()->where("userId=" . $userId . " and isDefault=1")
                ->orderBy("createDateTime DESC")
                ->one();
        if (isset($detail)) {
            return $detail;
        } else {
            return NULL;
        }
    }

    public static function supplierAddressText($addressId) {
        $text = Address::find()->where("addressId=" . $addressId . " and isDefault=1")->one();
        if (isset($text) && !empty($text)) {
            $districtId = \common\models\dbworld\District::find()->where("districtId=" . $text->districtId)->one();
            if (isset($districtId) && !empty($districtId)) {
                $district = $districtId->localName;
                $id = $districtId->cityId;
            } else {
                $district = '';
                $id = '';
            }
            $aumphur = \common\models\dbworld\Cities::find()->where("cityId=" . $text->amphurId)->one();
            if (isset($aumphur) && !empty($aumphur)) {
                $city = $aumphur->cityName;
            } else {
                $city = '';
            }
            $province = \common\models\dbworld\States::find()->where("stateId=" . $text->provinceId)->one();
            if (isset($province) && !empty($province)) {
                $state = $province->stateName;
            } else {
                $state = '';
            }
            $address = $text->address . " " . $district . "<br>" . $city . " " . $state . " " . $id . "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TEL " . $text->tel . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax " . $text->fax;
            return $address;
        } else {
            return NULL;
        }
    }

    public static function userAddressText($addressId, $tel = true) {
        $text = Address::find()->where("addressId=" . $addressId . " and isDefault=1")->one();
        if (isset($text) && !empty($text)) {
            $districtId = \common\models\dbworld\District::find()->where("districtId=" . $text->districtId)->one();
            if (isset($districtId) && !empty($districtId)) {
                $district = $districtId->localName;
                $id = $districtId->cityId;
            } else {
                $district = '';
                $id = '';
            }
            $aumphur = \common\models\dbworld\Cities::find()->where("cityId=" . $text->amphurId)->one();
            if (isset($aumphur) && !empty($aumphur)) {
                $city = $aumphur->localName;
            } else {
                $city = '';
            }
            $province = \common\models\dbworld\States::find()->where("stateId=" . $text->provinceId)->one();
            if (isset($province) && !empty($province)) {
                $state = $province->localName;
            } else {
                $state = '';
            }
            $zipcode = \common\models\dbworld\Zipcodes::find()->where("zipcodeId=" . $text->zipcode)->one();
            if (isset($zipcode) && !empty($zipcode)) {
                $zipcodes = $zipcode->zipcode;
            } else {
                $zipcodes = '';
            }
            if ($tel == true) {
                $address = $text->address . " " . $district . " " . $city . " " . $state . " " . $zipcodes . "<br>TEL. " . $text->tel . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax. " . $text->fax;
            } else {
                $address = $text->address . " " . $district . " " . $city . " " . $state . " " . $zipcodes;
            }
            return $address;
        } else {
            return NULL;
        }
    }

    public static function userTel($userId) {
        $user = User::find()->where("userId=" . $userId)->one();
        $tel = '';
        if (isset($user) && !empty($user)) {
            $tel = $user->tel;
        }
        return $tel;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles() {
        return $this->hasMany(\hscstudio\mimin\models\AuthAssignment::className(), [
                    'user_id' => 'userId',
        ]);
    }

    public static function getAvatar($userId) {
        $user = User::find()->where("userId=" . $userId)->one();
        if (isset($user['avatar'])) {
            if (file_exists(Yii::$app->basePath . "/web/images/user/avatar/" . $user['avatar'])) {
                $avatar = Yii::$app->homeUrl . "images/user/avatar/" . $user['avatar'];
            } else {
                $avatar = Yii::$app->homeUrl . 'images/user/avatar/15102837165a0519c4d1f007.74678703.png';
            }
        } else {
            $avatar = Yii::$app->homeUrl . 'images/user/avatar/15102837165a0519c4d1f007.74678703.png';
        }
        //$avatar = isset($user['avatar']) ? Yii::$app->homeUrl . "images/user/avatar/" . $user['avatar'] : Yii::$app->homeUrl . 'images/user/avatar/150952763159f9904f9095d6.52583311.jpg'; //
        return $avatar;
    }

    public static function getUserInfo($userId) {
        $user = User::find()->where("userId=" . $userId)->one();
        return $user;
    }

}
