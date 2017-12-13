<?php

namespace common\models\costfit;

use Yii;
use yii\data\ActiveDataProvider;
use \common\models\costfit\master\SectionMaster;
use common\models\costfit\SectionItem;

/**
 * This is the model class for table "section".
 *
 * @property string $sectionId
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Section extends \common\models\costfit\master\SectionMaster {

    const SECTION_TYPE_WEB = 1;
    const SECTION_TYPE_MOBILE = 2;
    const SECTION_TYPE_BOTH = 3;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), [
            ['title', 'required'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public static function showSections() {
        $sections = Section::find()->where("status=1")
                ->orderBy("sort")
                ->limit(3)
                ->all();
        if (isset($sections) && count($sections) > 0) {
            return $sections;
        } else {
            return null;
        }
    }

    public static function productSection($n = NULL, $cat = false, $brandId = false, $sectionId, $mins = FALSE, $maxs = FALSE, $status = FALSE, $sort = FALSE) {
        //echo $brandId;
        $productSectionItems = "";
        $productSectionItem = '';
        $sectionItems = SectionItem::find()->where("sectionId =" . $sectionId . " and status=1")
                ->orderBy("createDateTime ASC")
                ->all();
        if (isset($sectionItems) && count($sectionItems) > 0) {
            foreach ($sectionItems as $item):
                $productSectionItems.= $item->productSuppId . ",";
                // $productSectionItem.= $item->productId . ",";
            endforeach;
            $productSectionItems = substr($productSectionItems, 0, -1);
        } else {
            return NULL;
        }
        //$productSectionItems = '1482,1483,1484,1485,1486,1487,1488,1489,1490,1491,1492,1494,1496,1497,1498,1499,1500,1501,1502,1504';
        $sortStr = ($status == "price") ? "pps.price " : (($status == "brand") ? "b.title " : "product_suppliers.updateDateTime ");
        if ($sort == 'SORT_ASC') {
            $sortStr .= 'asc';
        } else {
            $sortStr .= 'desc';
        }
        //throw new \yii\base\Exception($productSectionItems);
        $products = ProductSuppliers::find()
                ->select('*, product_suppliers.productSuppId as productSuppId, pps.price as price')
                ->join('LEFT JOIN', 'product p', 'product_suppliers.productId=p.productId')
                ->join(" LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = product_suppliers.productSuppId")
                ->where('p.productSuppId is null and p.parentId is not null and p.approve="approve" and p.status=1 and product_suppliers.approve="approve" and product_suppliers.status=1 and product_suppliers.result>0 AND pps.status =1 AND  pps.price > 0')
                ->andWhere(['in', 'product_suppliers.productSuppId', explode(',', $productSectionItems)])
                ->andWhere(($maxs > 100) ? 'pps.price ' . 'between ' . $mins . ' and ' . $maxs : " product_suppliers.result >= 0")
                ->limit($n)
                ->orderBy($sortStr);
        //->orderBy(new Expression('rand()') . " , pps.price");
        if (isset($cat) && !empty($cat)) {
            $products->leftJoin('category_to_product ctp', 'ctp.productId=p.productId');
            $products->andWhere(['ctp.categoryId' => $cat]);
        }
        if (Yii::$app->controller->id == 'search') {
            if (isset($brandId) && !empty($brandId)) {
                //if (isset($brandId)) {
                $products->leftJoin('brand b', 'b.brandId=product_suppliers.brandId');
                $products->andWhere(['b.brandId' => $brandId]);
            }
            if ($status == "brand" and ! isset($brandId)) {
                $products->leftJoin('brand b', 'b.brandId=product_suppliers.brandId');
            }
        }

        return new ActiveDataProvider([
            'query' => $products,
            'pagination' => [
            // 'pageSize' => isset($n) ? $n : 12,
            ]
        ]);
    }

    public static function CountProductSection($n = NULL, $cat = false, $brandId = false, $sectionId, $mins = FALSE, $maxs = FALSE, $status = FALSE, $sort = FALSE) {
        //echo $brandId;
        $productSectionItems = "";
        $productSectionItem = '';
        $sectionItems = SectionItem::find()->where("sectionId =" . $sectionId . " and status=1")
                ->orderBy("createDateTime ASC")
                ->all();
        if (isset($sectionItems) && count($sectionItems) > 0) {
            foreach ($sectionItems as $item):
                $productSectionItems.= $item->productSuppId . ",";
                // $productSectionItem.= $item->productId . ",";
            endforeach;
            $productSectionItems = substr($productSectionItems, 0, -1);
        } else {
            return NULL;
        }
        //$productSectionItems = '1482,1483,1484,1485,1486,1487,1488,1489,1490,1491,1492,1494,1496,1497,1498,1499,1500,1501,1502,1504';
        $sortStr = ($status == "price") ? "pps.price " : (($status == "brand") ? "b.title " : "product_suppliers.updateDateTime ");
        if ($sort == 'SORT_ASC') {
            $sortStr .= 'asc';
        } else {
            $sortStr .= 'desc';
        }
        //throw new \yii\base\Exception($productSectionItems);
        $products = ProductSuppliers::find()
                ->select('*, product_suppliers.productSuppId as productSuppId, pps.price as price')
                ->join('LEFT JOIN', 'product p', 'product_suppliers.productId=p.productId')
                ->join(" LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = product_suppliers.productSuppId")
                ->where('p.productSuppId is null and p.parentId is not null and p.approve="approve" and p.status=1 and product_suppliers.approve="approve" and product_suppliers.status=1 and product_suppliers.result>0 AND pps.status =1 AND  pps.price > 0')
                ->andWhere(['in', 'product_suppliers.productSuppId', explode(',', $productSectionItems)])
                ->andWhere(($maxs > 100) ? 'pps.price ' . 'between ' . $mins . ' and ' . $maxs : " product_suppliers.result >= 0")
                ->orderBy($sortStr)
                ->all();
        //->orderBy(new Expression('rand()') . " , pps.price");
        if (isset($cat) && !empty($cat)) {
            $products->leftJoin('category_to_product ctp', 'ctp.productId=p.productId');
            $products->andWhere(['ctp.categoryId' => $cat]);
        }
        if (Yii::$app->controller->id == 'search') {
            if (isset($brandId) && !empty($brandId)) {
                //if (isset($brandId)) {
                $products->leftJoin('brand b', 'b.brandId=product_suppliers.brandId');
                $products->andWhere(['b.brandId' => $brandId]);
            }
            if ($status == "brand" and ! isset($brandId)) {
                $products->leftJoin('brand b', 'b.brandId=product_suppliers.brandId');
            }
        }
        return count($products);
    }

}
