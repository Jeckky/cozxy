<?php

namespace frontend\modules\mobile\controllers;

use common\models\costfit\Category;
use common\models\costfit\ContentGroup;
use common\models\costfit\ProductPriceSuppliers;
use common\models\costfit\ProductSupplier;
use \common\models\costfit\ProductSuppliers;
use common\models\costfit\ProductImageSuppliers;
use frontend\controllers\MasterController;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `mobile` module
 */
class HomeController extends MasterController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $bannerGroup = ContentGroup::find()->where("lower(title) = 'banner' and status=1")->one();
        $banners = $bannerGroup->contents;
        $res['banners'] = ArrayHelper::map($banners, 'contentId', 'image');

        $pCanSales = ProductSuppliers::find()
            ->join("LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where('product_suppliers.approve="approve" and product_suppliers.result > 0 AND product_price_suppliers.status =1 AND product_price_suppliers.price > 0')
            ->orderBy(new Expression('rand()'))
            ->all();

        $i = 0;
        foreach ($pCanSales as $pCanSale) {
            $res['pCanSale'][$i]['productSuppId'] = $pCanSale->productSuppId;

            $productImages = ProductImageSuppliers::find()->where('productSuppId=' . $pCanSale->productSuppId)->orderBy('ordering asc')->one();
            $productPrice = ProductPriceSuppliers::find()->where('productSuppId=' . $pCanSale->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();

            $res['pCanSale'][$i]['price'] = $productPrice->price;
            $res['pCanSale'][$i]['image'] = isset($productImages->image) ? Yii::$app->homeUrl . $productImages->image : Yii::$app->homeUrl . "/images/ContentGroup/DUHWYsdXVc.png";

            $res['pCanSale'][$i]['category'] = $pCanSale->category->title;
            $res['pCanSale'][$i]['title'] = $pCanSale->title;
            $res['pCanSale'][$i]['hash'] = $pCanSale->encodeParams([
                'productId' => $pCanSale->productId,
                'productSupplierId' => $pCanSale->productSuppId
            ]);

            $i++;
        }

        $pNotSales = ProductSuppliers::find()
            ->where('result = 0 and  approve="approve"')
            ->orderBy(new Expression('rand()'))
            ->limit(10)
            ->all();

        $i = 0;
        foreach ($pNotSales as $pNotSale) {
            $res['pNotSale'][$i]['productSuppId'] = $pNotSale->productSuppId;

            $productImages = ProductImageSuppliers::find()->where('productSuppId=' . $pNotSale->productSuppId)->orderBy('ordering asc')->one();
            $this->writeToFile('/tmp/pNotSale', $pNotSale->productSuppId);
            $res['pNotSale'][$i]['image'] = isset($productImages->image) ? Yii::$app->homeUrl . $productImages->image : Yii::$app->homeUrl . "/images/ContentGroup/DUHWYsdXVc.png";

            $res['pNotSale'][$i]['category'] = $pNotSale->category->title;
            $res['pNotSale'][$i]['title'] = $pNotSale->title;
            $res['pNotSale'][$i]['hash'] = $pNotSale->encodeParams([
                'productId' => $pNotSale->productId,
                'productSupplierId' => $pCanSale->productSuppId
            ]);


            $i++;
        }

        $popCats = Category::find()
            ->join("INNER JOIN", 'show_category sc', 'sc.categoryId = category.categoryId')
            ->where('sc.type = 2')->orderBy(new Expression('rand()'))
            ->limit(3)
            ->all();

        $i = 0;
        foreach ($popCats as $popCat) {
            $res['popCat'][$i] = [
                'title' => $popCat->createTitle(),
                'image' => isset($popCat->image) && !empty($popCat->image) ? Yii::$app->homeUrl.$popCat->image :  Yii::$app->homeUrl.'"images/ContentGroup/DUHWYsdXVc.png',
                'hash' => $popCat->encodeParams(['categoryId' => $popCat->categoryId])
            ];

            $i++;
        }

        print_r(Json::encode($res));
    }
}
