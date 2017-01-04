<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserFavouriteMaster;

/**
* This is the model class for table "user_favourite".
*
    * @property string $userFavouriteId
    * @property string $userId
    * @property string $brandId
    * @property string $brandModelId
    * @property string $category1Id
    * @property string $category2Id
    * @property string $productId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class UserFavourite extends \common\models\costfit\master\UserFavouriteMaster{
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
