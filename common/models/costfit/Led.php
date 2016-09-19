<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\LedMaster;

/**
 * This is the model class for table "led".
 *
 * @property string $ledId
 * @property string $code
 * @property string $ip
 * @property string $shelf
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Led extends \common\models\costfit\master\LedMaster
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
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
        ]);
    }

    public function getLedItems()
    {
        return $this->hasMany(LedItem::className(), ['ledId' => 'ledId'])->orderBy("led_item.sortOrder ASC");
    }

}
