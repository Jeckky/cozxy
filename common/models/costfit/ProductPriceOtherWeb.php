<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPriceOtherWebMaster;

/**
 * This is the model class for table "product_price_other_web".
 *
 * @property integer $productPriceOtherWebId
 * @property integer $productId
 * @property integer $webId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductPriceOtherWeb extends \common\models\costfit\master\ProductPriceOtherWebMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    public function attributes() {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['price']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'webId' => 'Website'
        ]);
    }

    public function getWebName() {

        return $this->hasOne(Web::className(), ['webId' => 'webId']);
    }

    public function getProducts() {

        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

    public function getUpdatePrices() {
        return $this->hasOne(UpdatePrice::className(), ['productPriceOtherWebId' => 'productPriceOtherWebId'])->orderBy("updatePriceId DESC");
    }

    public function getLinkName() {
        $text = '';
        if (isset($this->url)) {
            $text = "<a href='" . $this->url . "' target='_blank'>" . $this->url . "</a>";
        }
        return $text;
    }

}
