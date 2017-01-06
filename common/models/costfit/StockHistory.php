<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\StockHistoryMaster;

/**
* This is the model class for table "stock_history".
*
    * @property string $stockHistoryId
    * @property integer $orderItemId
    * @property integer $productSuppId
    * @property integer $quantity
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class StockHistory extends \common\models\costfit\master\StockHistoryMaster{
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
