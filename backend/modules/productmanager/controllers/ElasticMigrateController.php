<?php

namespace backend\modules\productmanager\controllers;

use backend\modules\productmanager\models\Product;
use backend\modules\productmanager\models\ProductSuppliers;
use backend\modules\elasticsearch\models\Elastic;
use common\models\costfit\ProductImage;
use yii\helpers\Json;
use yii\helpers\Url;

class ElasticMigrateController extends ProductManagerMasterController
{
    public function actionProduct($page)
    {
        $limit = 300;
        $time = explode(' ', microtime());
        $startTime = $time[0] + $time[1];
        $productModels = Product::find()
            ->from('product p')
            ->select('p.productId, p.code, p.isbn, p.parentId, p.status, p.approve, p.createDateTime, p.updateDateTime, p.brandId, c.categoryId, p.title, p.price, p.receiveType, p.productGroupTemplateId, p.description, p.specification, p.shortDescription')
            ->leftJoin('brand b', 'b.brandId=p.brandId')
            ->leftJoin('category c', 'c.categoryId=p.categoryId')
            ->where('p.parentId is not null and p.status=1')
            ->andWhere('b.brandId is not null')
            ->andWhere('c.categoryId is not null')
            ->orderBy(['p.productId' => SORT_ASC])
            ->offset($page * $limit)
            ->limit($limit)
            ->asArray()
            ->all();

        $time = explode(' ', microtime());
        $endTime = $time[0] + $time[1];
        $diffTime = $endTime - $startTime;
        $numProducts = sizeof($productModels);

        echo "<h1>Product Migrate</h1>";
        echo "<h3>$numProducts Products ($diffTime)</h3>";
        echo '<hr>';

        $i = 0;

        $time = explode(' ', microtime());
        $startTime = $time[0] + $time[1];
        $url = Elastic::getElasticUrl();

        foreach($productModels as $productModel) {

            settype($productModel['productId'], 'int');
            settype($productModel['parentId'], 'int');
            settype($productModel['status'], 'int');
            settype($productModel['brandId'], 'int');
            settype($productModel['categoryId'], 'int');
            settype($productModel['price'], 'float');
            settype($productModel['productGroupTemplateId'], 'int');

            $createDateTime = explode(' ', $productModel['createDateTime']);
            $productModel['createDateTime'] = $createDateTime[0] . 'T' . $createDateTime[1] . '.000Z';

            $updateDateTime = explode(' ', $productModel['updateDateTime']);
            $productModel['updateDateTime'] = $updateDateTime[0] . 'T' . $updateDateTime[1] . '.000Z';

            $productModel['image'] = '';
            $productModel['imageThumbnail1'] = '';
            $productModel['imageThumbnail2'] = '';

            //image
            $productImageModel = ProductImage::find()->where(['productId' => $productModel['productId']])->asArray()->one();
            if(isset($productImageModel)) {
                $productModel['image'] = 'https://www.cozxy.com/' . $productImageModel['image'];
                $productModel['imageThumbnail1'] = 'https://www.cozxy.com/' . $productImageModel['imageThumbnail1'];
                $productModel['imageThumbnail2'] = 'https://www.cozxy.com/' . $productImageModel['imageThumbnail2'];
            }

            Elastic::connect($url . 'products/' . $productModel['productId'], $productModel, Elastic::METHOD_POST);

            var_dump($productModel);
            $i++;
            echo '<hr>';
        }

        $time = explode(' ', microtime());
        $endTime = $time[0] + $time[1];
        $diffTime = $endTime - $startTime;

        echo "<h3>Migrate Time : $diffTime</h3>";
        echo "<h3>$i migrated products</h3>";
//        return $this->render('index', compact('productModels', 'diffTime'));
    }

    public function actionProductSupplier($page)
    {
        $limit = 200;
        $time = explode(' ', microtime());
        $startTime = $time[0] + $time[1];
        $productModels = ProductSuppliers::find()
            ->from('product_suppliers ps')
            ->select('ps.productId, ps.productSuppId, ps.result, ps.status, pps.price,')
            ->leftJoin('product_price_suppliers pps', 'ps.productSuppId=pps.productSuppId')
            ->where(['ps.status' => 1, 'ps.approve' => 'approve', 'pps.status' => 1])
            ->andWhere('ps.result > 0')
            ->orderBy(['ps.productSuppId' => SORT_ASC])
            ->offset($page * $limit)
            ->limit($limit)
            ->asArray()
            ->all();

        $time = explode(' ', microtime());
        $endTime = $time[0] + $time[1];
        $diffTime = $endTime - $startTime;
        $numProducts = sizeof($productModels);

        echo "<h1>Product Migrate</h1>";
        echo "<h3>$numProducts Products ($diffTime)</h3>";
        echo '<hr>';

        $i = 0;

        $time = explode(' ', microtime());
        $startTime = $time[0] + $time[1];
        $url = Elastic::getElasticUrl();

        foreach($productModels as $productModel) {
            $productId = $productModel['productId'];
            settype($productId, 'int');
            unset($productModel['productId']);
            $productSuppId = $productModel['productSuppId'];
            settype($productSuppId, 'int');
            unset($productModel['productSuppId']);


            settype($productModel['status'], 'int');
            settype($productModel['result'], 'int');
            settype($productModel['price'], 'float');

            Elastic::connect($url . 'products/' . $productId . '/suppliers/' . $productSuppId, $productModel, Elastic::METHOD_POST);
            $productModel['url'] = $url . 'products/' . $productId . '/suppliers/' . $productSuppId;

            var_dump($productModel);
            $i++;
            echo '<hr>';
        }
        $time = explode(' ', microtime());
        $endTime = $time[0] + $time[1];
        $diffTime = $endTime - $startTime;

        echo "<h3>Migrate Time : $diffTime</h3>";
        echo "<h3>$i migrated products</h3>";
//        return $this->render('product-supplier', compact('productModels', 'diffTime'));
    }

}