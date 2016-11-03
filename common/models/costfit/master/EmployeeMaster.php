<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "employee".
*
    * @property integer $employeeId
    * @property string $employeeCode
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    * @property integer $isFirstLogin
    * @property string $username
    * @property string $password
    * @property string $email
    * @property integer $prefix
    * @property string $prefixOther
    * @property string $fnTh
    * @property string $lnTh
    * @property string $nickName
    * @property string $fnEn
    * @property string $lnEn
    * @property integer $gender
    * @property string $citizenId
    * @property string $citizenIdExpire
    * @property string $accountNo
    * @property string $ext
    * @property string $mobile
    * @property integer $employeeLevelId
    * @property string $position
    * @property integer $companyId
    * @property string $companyValue
    * @property integer $branchId
    * @property integer $branchValue
    * @property integer $companyDivisionId
    * @property string $managerId
    * @property string $startDate
    * @property string $proDate
    * @property string $transferDate
    * @property string $endDate
    * @property string $birthDate
    * @property integer $isSale
    * @property integer $isEngineer
    * @property integer $leaveQuota
    * @property string $leaveRemain
    * @property integer $isManager
    * @property string $lastChangePasswordDateTime
    * @property integer $loginFailed
*/
class EmployeeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'employee';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['employeeCode', 'createDateTime', 'username', 'password', 'email', 'prefix', 'fnTh', 'lnTh', 'fnEn', 'lnEn', 'gender', 'employeeLevelId', 'position', 'companyId', 'companyValue', 'branchId', 'branchValue', 'companyDivisionId', 'managerId', 'startDate', 'proDate', 'transferDate', 'endDate', 'birthDate', 'lastChangePasswordDateTime', 'loginFailed'], 'required'],
            [['status', 'isFirstLogin', 'prefix', 'gender', 'employeeLevelId', 'companyId', 'companyValue', 'branchId', 'branchValue', 'companyDivisionId', 'isSale', 'isEngineer', 'leaveQuota', 'isManager', 'loginFailed'], 'integer'],
            [['createDateTime', 'updateDateTime', 'startDate', 'proDate', 'transferDate', 'endDate', 'birthDate', 'lastChangePasswordDateTime'], 'safe'],
            [['leaveRemain'], 'number'],
            [['employeeCode', 'username', 'ext', 'managerId'], 'string', 'max' => 10],
            [['password', 'prefixOther'], 'string', 'max' => 40],
            [['email', 'fnTh', 'fnEn'], 'string', 'max' => 80],
            [['lnTh', 'lnEn', 'position'], 'string', 'max' => 120],
            [['nickName'], 'string', 'max' => 45],
            [['citizenId', 'citizenIdExpire', 'accountNo'], 'string', 'max' => 50],
            [['mobile'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['employeeCode'], 'unique'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'employeeId' => Yii::t('employee', 'Employee ID'),
    'employeeCode' => Yii::t('employee', 'Employee Code'),
    'status' => Yii::t('employee', 'Status'),
    'createDateTime' => Yii::t('employee', 'Create Date Time'),
    'updateDateTime' => Yii::t('employee', 'Update Date Time'),
    'isFirstLogin' => Yii::t('employee', 'Is First Login'),
    'username' => Yii::t('employee', 'Username'),
    'password' => Yii::t('employee', 'Password'),
    'email' => Yii::t('employee', 'Email'),
    'prefix' => Yii::t('employee', 'Prefix'),
    'prefixOther' => Yii::t('employee', 'Prefix Other'),
    'fnTh' => Yii::t('employee', 'Fn Th'),
    'lnTh' => Yii::t('employee', 'Ln Th'),
    'nickName' => Yii::t('employee', 'Nick Name'),
    'fnEn' => Yii::t('employee', 'Fn En'),
    'lnEn' => Yii::t('employee', 'Ln En'),
    'gender' => Yii::t('employee', 'Gender'),
    'citizenId' => Yii::t('employee', 'Citizen ID'),
    'citizenIdExpire' => Yii::t('employee', 'Citizen Id Expire'),
    'accountNo' => Yii::t('employee', 'Account No'),
    'ext' => Yii::t('employee', 'Ext'),
    'mobile' => Yii::t('employee', 'Mobile'),
    'employeeLevelId' => Yii::t('employee', 'Employee Level ID'),
    'position' => Yii::t('employee', 'Position'),
    'companyId' => Yii::t('employee', 'Company ID'),
    'companyValue' => Yii::t('employee', 'Company Value'),
    'branchId' => Yii::t('employee', 'Branch ID'),
    'branchValue' => Yii::t('employee', 'Branch Value'),
    'companyDivisionId' => Yii::t('employee', 'Company Division ID'),
    'managerId' => Yii::t('employee', 'Manager ID'),
    'startDate' => Yii::t('employee', 'Start Date'),
    'proDate' => Yii::t('employee', 'Pro Date'),
    'transferDate' => Yii::t('employee', 'Transfer Date'),
    'endDate' => Yii::t('employee', 'End Date'),
    'birthDate' => Yii::t('employee', 'Birth Date'),
    'isSale' => Yii::t('employee', 'Is Sale'),
    'isEngineer' => Yii::t('employee', 'Is Engineer'),
    'leaveQuota' => Yii::t('employee', 'Leave Quota'),
    'leaveRemain' => Yii::t('employee', 'Leave Remain'),
    'isManager' => Yii::t('employee', 'Is Manager'),
    'lastChangePasswordDateTime' => Yii::t('employee', 'Last Change Password Date Time'),
    'loginFailed' => Yii::t('employee', 'Login Failed'),
];
}
}
