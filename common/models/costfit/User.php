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

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
            ['email', 'unique'],
            'tel' => [['tel'], 'string'], //, 'min' => 8
            ['newPassword', 'string', 'min' => 8],
            ['password', 'string', 'min' => 8],
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
        ]);
    }

    public function scenarios() {
        return [
            self::COZXY_REGIS => ['email', 'password', 'confirmPassword', 'acceptTerm'],
            self::COZXY_PROFILE => ['currentPassword', 'newPassword', 'rePassword', ['currentPassword', 'newPassword', 'rePassword']],
            self::COZXY_USER_BACKEND => ['firstname', 'lastname', 'password', 'email', 'type', 'gender'],
            self::COZXY_EDIT_PROFILE => ['firstname', 'lastname', 'gender', 'tel' => [['tel'], 'integer'], 'birthDate', 'acceptTerm']
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
        $detail = Address::find()->where("userId=" . $userId . " and isDefault=1")->one();
        if (isset($detail) && !empty($detail)) {
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
            if ($tel == true) {
                $address = $text->address . " " . $district . " " . $city . " " . $state . " " . $id . "<br>TEL. " . $text->tel . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax. " . $text->fax;
            } else {
                $address = $text->address . " " . $district . " " . $city . " " . $state . " " . $id;
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

}
