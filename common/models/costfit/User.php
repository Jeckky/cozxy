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
    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'acceptTerm'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

}
