<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\OrderDetailTemplateMaster;

/**
* This is the model class for table "order_detail_template".
*
    * @property string $orderDetailTemplateId
    * @property string $supplierId
    * @property string $title
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Supplier $supplier
    */

class OrderDetailTemplate extends \common\models\costfit\master\OrderDetailTemplateMaster{
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
