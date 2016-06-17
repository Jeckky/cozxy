<?php

namespace common\models\costfit\master;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property string $addressId
 * @property string $userId
 * @property string $company
 * @property string $tax
 * @property string $address
 * @property string $countryId
 * @property string $provinceId
 * @property string $amphurId
 * @property string $zipcode
 * @property string $tel
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property User $user
 */
class AddressMaster extends \common\models\ModelMaster
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'createDateTime'], 'required'],
            [['userId', 'countryId', 'provinceId', 'amphurId', 'type', 'status'], 'integer'],
            [['address'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['company'], 'string', 'max' => 200],
            [['tax', 'tel'], 'string', 'max' => 45],
            [['zipcode'], 'string', 'max' => 10],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => UserMaster::className(), 'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'addressId' => 'Address ID',
            'userId' => 'User ID',
            'company' => 'Company',
            'tax' => 'Tax',
            'address' => 'Address',
            'countryId' => 'Country ID',
            'provinceId' => 'Province ID',
            'amphurId' => 'Amphur ID',
            'zipcode' => 'Zipcode',
            'tel' => 'Tel',
            'type' => 'Type',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserMaster::className(), ['userId' => 'userId']);
    }
}
