<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\MarginMaster;

/**
 * This is the model class for table "margin".
 *
 * @property string $marginId
 * @property string $brandId
 * @property string $categoryId
 * @property string $supplierId
 * @property string $percent
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Margin extends \common\models\costfit\master\MarginMaster
{

    public $category1Id;
    public $category2Id;
    public $category3Id;

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

    public static function getSystemMargin($returnText = FALSE)
    {
        $res = NULL;
        $model = \common\models\costfit\Margin::find()->where("brandId is NULL AND categoryId is null AND supplierId is null AND status = 1")->orderBy("marginId DESC")->one();
        if (isset($model)) {
            if (!$returnText) {
                $res = $model;
            } else {
                $res = $model->percent;
            }
        }
        return $res;
    }

    public static function getSupplierMargin($supplierId, $returnText = FALSE)
    {
        $res = NULL;
        $model = \common\models\costfit\Margin::find()->where("supplierId =" . $supplierId . " AND status = 1")->orderBy("marginId DESC")->one();
        if (isset($model)) {
            if (!$returnText) {
                $res = $model;
            } else {
                $res = $model->percent;
            }
        }
        return $res;
    }

    public static function getBrandMargin($brandId, $returnText = FALSE)
    {
        $res = NULL;
        $model = \common\models\costfit\Margin::find()->where("brandId = $brandId AND categoryId is null AND supplierId is null AND status = 1")->orderBy("marginId DESC")->one();
        if (isset($model)) {
            if (!$returnText) {
                $res = $model;
            } else {
                $res = $model->percent;
            }
        }
        return $res;
    }

    public static function getCategoryMargin($categoryId, $returnText = FALSE)
    {
        $res = NULL;
        $model = \common\models\costfit\Margin::find()->where("brandId is NULL AND categoryId = $categoryId AND supplierId is null AND status = 1")->orderBy("marginId DESC")->one();
        if (isset($model)) {
            if (!$returnText) {
                $res = $model;
            } else {
                $res = $model->percent;
            }
        }
        return $res;
    }

    public static function getProductSuppMargin($productSuppId)
    {
        $res = NULL;
        $model = ProductSuppliers::find()->where("approve = 'approve' AND productSuppId = $productSuppId")->one();

        $systemMatgin = self::getSystemMargin(TRUE);
        $brandMargin = self::getBrandMargin($model->brandId, TRUE);
        $categoryMargin = self::getCategoryMargin($model->categoryId, TRUE);

        if (isset($brandMargin)) {

            $res = $categoryMargin - $brandMargin;
        } else {
            $res = $categoryMargin;
        }

        if (isset($res)) {
            return $res;
        } else {
            if (isset($systemMatgin)) {
                return $systemMatgin;
            } else {
                throw new \yii\web\HttpException(500, 'Please Setup Cozxy Margin');
            }
        }
    }

}
