<?php

namespace frontend\modules\fakedata\controllers;

use frontend\modules\fakedata\models\Product;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Default controller for the `fakedata` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSaleProduct()
    {
        $productModels = Product::saleProduct();
        $pds = [];

        $i = 0;
        foreach($productModels as $productModel) {
            $pds[$i] = [
                'title'=>$productModel->title,
                'productId'=>$productModel->productId,
                'salePrice'=>$productModel->salePrice,
                'marketPrice'=>$productModel->marketPrice,
                'brand'=>$productModel->brand->title,
                'thumbnail'=>\Yii::$app->homeUrl.$productModel->images->imageThumbnail1,
                'productSuppId'=>$productModel->productSupplierId,
                'maxQnty'=>$productModel->maxQnty,
                'receiveType'=>($productModel->receiveType) ? $productModel->receiveType : 1,
                'supplierId'=>$productModel->supplierId
            ];
            $i++;
        }

        echo Json::encode($pds);
    }

    public function actionNotSaleProduct()
    {
        $productModels = Product::notSaleProduct();
        $pds = [];

        $i = 0;
        foreach($productModels as $productModel) {
            $pds[$i] = [
                'title'=>$productModel->title,
                'productId'=>$productModel->productId,
                'marketPrice'=>$productModel->marketPrice,
                'brand'=>$productModel->brand->title,
                'thumbnail'=>\Yii::$app->homeUrl.$productModel->images->imageThumbnail1
            ];
            $i++;
        }

        echo Json::encode($pds);
    }
}
