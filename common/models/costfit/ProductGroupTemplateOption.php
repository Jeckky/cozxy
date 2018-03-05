<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductGroupTemplateOptionMaster;

/**
 * This is the model class for table "product_group_template_option".
 *
 * @property string $productGroupTemplateOptionId
 * @property string $productGroupTemplateId
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property ProductGroupOption[] $productGroupOptions
 * @property ProductGroupTemplate $productGroupTemplate
 * @property ProductSuppliersOption[] $productSuppliersOptions
 */
class ProductGroupTemplateOption extends \common\models\costfit\master\ProductGroupTemplateOptionMaster {

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

    public static function getTitle($productGroupTemplateOptionId) {
        $model = ProductGroupTemplateOption::findOne($productGroupTemplateOptionId);
        return strtoupper($model->title);
    }

    public static function countOption($productGroupTemplateId) {
        return $model = count(ProductGroupTemplateOption::find()->where("productGroupTemplateId=" . $productGroupTemplateId)->all());
    }

    public static function saveOption($productGroupId, $templateId, $productId, $productSuppId, $productArr) {
        $productGroupOptions = ProductGroupOption::find()->where("productGroupId=$productGroupId")->all();
        if (!isset($productGroupOptions) || count($productGroupOptions) <= 0) {
            $productGroupTemplateOption = ProductGroupTemplateOption::find()->where("productGroupTemplateId=$templateId")->all();
            if (isset($productGroupTemplateOption) && count($productGroupTemplateOption) > 0) {
                foreach ($productGroupTemplateOption as $option):
                    $productGroupOption = new ProductGroupOption();
                    $productGroupOption->productGroupId = $productGroupId;
                    $productGroupOption->productGroupTemplateOptionId = $option->productGroupTemplateOptionId;
                    $productGroupOption->name = $option->title;
                    $productGroupOption->status = 1;
                    $productGroupOption->createDateTime = new \yii\db\Expression('NOW()');
                    $productGroupOption->updateDateTime = new \yii\db\Expression('NOW()');
                    $productGroupOption->save();
                endforeach;
            }
        }
        $options = ProductGroupOption::find()->where("productGroupId=$productGroupId")->all();
        $i = 19;
        foreach ($options as $p):
            if ($productArr[$i] != '') {
                $optionValue = new ProductGroupOptionValue();
                $optionValue->productGroupOptionId = $p->productGroupOptionId;
                $optionValue->productGroupTemplateOptionId = $p->productGroupTemplateOptionId;
                $optionValue->productGroupTemplateId = $templateId;
                $optionValue->productGroupId = $productGroupId;
                $optionValue->productId = $productId;
                $optionValue->productSuppId = $productSuppId;
                $optionValue->productGroupTemplateId = $templateId;
                $optionValue->value = $productArr[$i];
                $optionValue->status = 1;
                $optionValue->createDateTime = new \yii\db\Expression('NOW()');
                $optionValue->updateDateTime = new \yii\db\Expression('NOW()');
                $optionValue->save();
            }
            $i++;
        endforeach;
    }

    public static function templateId($title) {
        $template = ProductGroupTemplate::find()->where("title='" . $title . "'")->one();
        if (isset($template)) {
            return $template->productGroupTemplateId;
        } else {
            return null;
        }
    }

}
