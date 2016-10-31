<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\EmployeeMaster;

/**
* This is the model class for table "employee".
*
    * @property string $employeeId
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
    * @property string $branchValue
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

class Employee extends \common\models\costfit\master\EmployeeMaster{
/**
* @inheritdoc
*/
public function rules()
{
return array_merge(parent::rules(), []);
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return array_merge(parent::attributeLabels(), []);
}
}
