<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\SectionItemMaster;

/**
 * This is the model class for table "section_item".
 *
 * @property string $sectionItemId
 * @property integer $sectionId
 * @property integer $productId
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class SectionItem extends \common\models\costfit\master\SectionItemMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public static function checkItemInSection($sectionId, $productId, $productSuppId) {
        $item = SectionItem::find()->where("sectionId=" . $sectionId . " and productId=" . $productId . " and productSuppId=" . $productSuppId)->one();
        if (isset($item)) {
            return 1;
        } else {
            return 0;
        }
    }

}
