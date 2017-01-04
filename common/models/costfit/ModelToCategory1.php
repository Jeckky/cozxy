<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ModelToCategory1Master;

/**
* This is the model class for table "model_to_category1".
*
    * @property string $id
    * @property string $brandModelId
    * @property string $categoryId
    * @property integer $sortOrder
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ModelToCategory1 extends \common\models\costfit\master\ModelToCategory1Master{
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
