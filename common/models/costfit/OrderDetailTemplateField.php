<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderDetailTemplateFieldMaster;

/**
* This is the model class for table "order_detail_template_field".
*
    * @property string $orderDetailTemplateFieldId
    * @property string $orderDetailTemplateId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class OrderDetailTemplateField extends \common\models\costfit\master\OrderDetailTemplateFieldMaster{
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
