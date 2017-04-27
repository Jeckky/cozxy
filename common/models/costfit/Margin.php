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

    public static function getSystemMargin()
    {
        $model = \common\models\costfit\Margin::find()->where("brandId is NULL AND categoryId is null AND supplierId is null AND status = 1")->orderBy("marginId DESC")->one();
        if (isset($model)) {
            return $model;
        } else {
            return NULL;
        }
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

}
