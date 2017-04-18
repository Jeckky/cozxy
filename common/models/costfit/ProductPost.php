<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPostMaster;

/**
 * This is the model class for table "product_post".
 *
 * @property string $productPostId
 * @property string $productSuppId
 * @property string $brandId
 * @property string $userId
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductPost extends \common\models\costfit\master\ProductPostMaster {

    /**
     * @inheritdoc
     */
    const STATUS_PRIVATE = 1;
    const STATUS_PUBLIC = 2;
    const STATUS_DELETE = 3;
    const COZXY_POST_REVIRES = 'review_post';

    public function rules() {
        return array_merge(parent::rules(), [
            [['description'], 'required', 'on' => self::COZXY_POST_REVIRES],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'username',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
        ]);
    }

    public static function findStatusArray() {
        return [
            self::STATUS_PRIVATE => "ส่วนตัว",
            self::STATUS_PUBLIC => "สาธารณะ",
//            self::STATUS_DELETE => "ลบ",
        ];
    }

    public static function getStatusText($status) {
        $res = $this->findStatusArray();
        if (isset($res[$status])) {
            return $res[$status];
        } else {
            return NULL;
        }
    }

}
