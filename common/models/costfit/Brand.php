<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\BrandMaster;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "brand".
 *
 * @property string $brandId
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $status
 * @property integer $parentId
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Brand extends \common\models\costfit\master\BrandMaster {

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
        return array_merge(parent::attributeLabels(), [
            'Access', 'sumResult'
        ]);
    }

    public function getRootCategorys() {
        return $this->hasMany(Category::className(), ['brandId' => 'brandId'], ["parentId" => 0]);
    }

    public static function allAvailableBrands() {
        $brands = self::find()
                ->select('brand.image as image, brand.brandId as brandId, brand.title as title')
                ->leftJoin('product p', 'p.brandId=brand.brandId')
                ->where('p.parentId is not null')
                ->andWhere(['p.approve' => 'approve'])
                ->andWhere(['p.status' => 1])
                ->groupBy('brand.brandId')
                ->orderBy(new \yii\db\Expression('rand()'));
        // ->all();
        return new ActiveDataProvider([
            'query' => $brands,
            'pagination' => [
                'pageSize' => 100,
            ]
        ]);
        //return $brands;
    }

    public static function popularBrands($n = null) {
        $pb = Brand::find()
                ->select(' brand.image as image, brand.brandId as brandId, brand.title as title, count(brand.brandId) , sum(p.result) as sumResult ')
                ->leftJoin('product_suppliers p', 'p.brandId=brand.brandId')
                ->where("`p`.`approve`='approve'")
                ->groupBy('brand.brandId')
                ->orderBy([
                    'sumResult' => SORT_DESC //Need this line to be fixed
                ])
                ->limit(20);
        return new ActiveDataProvider([
            'query' => $pb,
            'pagination' => [
                'pageSize' => isset($n) ? $n : 20,
            ]
        ]);
    }

    public static function brandId($title) {
        $brand = Brand::find()->where("title='" . $title . "' and status=1")->one();
        return $brand->brandId;
    }

}
