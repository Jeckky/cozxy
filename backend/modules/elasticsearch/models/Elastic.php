<?php

namespace backend\modules\elasticsearch\models;

use backend\modules\productmanager\models\ProductSuppliers;
use common\models\costfit\ProductPriceSuppliers;
use yii\base\Model;
use common\models\User;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * Signup form
 */
class Elastic extends Model
{
    public $url;
    public $data = [];

    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    public static function connect($url, $data = [], $requestMethod)
    {
        $curl = curl_init($url);
//        curl_setopt($curl, CURLOPT_POST, true);
        if($data !== []) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, Json::encode($data));
        }

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestMethod);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-type: application/json",
        ]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);
        return $result;
    }

    public static function getElasticUrl()
    {
        return \Yii::$app->params['ElasticUrl'];
    }

    /**
     * Product
     */
    public static function product($productId)
    {
        $url = self::getElasticUrl() . 'products/' . $productId;

        return self::connect($url, [], self::METHOD_GET);
    }

    public static function createProduct($productModel)
    {
        $productId = $productModel->productId;
        $url = self::getElasticUrl() . 'products/' . $productModel->productId;

        return self::connect($url, self::prepareProductData($productModel), self::METHOD_POST);
    }

    public static function updateProduct($productId, $data = [])
    {
        settype($productId, 'int');
        $url = self::getElasticUrl() . 'products/' . $productId;

        return self::connect($url, $data, self::METHOD_PUT);
    }

    public static function deleteProduct($productId)
    {
        $url = self::getElasticUrl() . 'products/' . $productId;

        return self::connect($url, [], self::METHOD_DELETE);
    }

    public static function prepareProductData($productModel)
    {
//        $productModel = Product::findOne($productId);

        $res = $productModel->attributes;

        settype($res['productId'], 'int');
        settype($res['userId'], 'int');
        settype($res['parentId'], 'int');
        settype($res['brandId'], 'int');
        settype($res['categoryId'], 'int');
        settype($res['productGroupTemplateId'], 'int');
        settype($res['price'], 'double');
        settype($res['step'], 'int');

        $res['description'] = trim(preg_replace('/\s+/', ' ', strip_tags($productModel->description)));
        $res['specification'] = trim(preg_replace('/\s+/', ' ', strip_tags($productModel->specification)));

        $image = isset($productModel->images->image) ? Url::home(true) . $productModel->images->image : '';
        $imageThumbnail1 = isset($productModel->images->imageThumbnail1) ? Url::home(true) . $productModel->images->imageThumbnail1 : '';
        $imageThumbnail2 = isset($productModel->images->imageThumbnail2) ? Url::home(true) . $productModel->images->imageThumbnail2 : '';

        $res['image'] = $image;
        $res['imageThumbnail1'] = $imageThumbnail1;
        $res['imageThumbnail2'] = $imageThumbnail2;

        $createDateTime = explode(' ', $res['createDateTime']);
        $res['createDateTime'] = $createDateTime[0] . 'T' . $createDateTime[1] . '.000Z';

        $updateDateTime = explode(' ', $res['updateDateTime']);
        $res['updateDateTime'] = $updateDateTime[0] . 'T' . $updateDateTime[1] . '.000Z';
        $approvecreateDateTime = explode(' ', $res['approvecreateDateTime']);
        $res['approvecreateDateTime'] = $approvecreateDateTime[0] . 'T' . $approvecreateDateTime[1] . '.000Z';
        return $res;
    }

    /**
     * Product Supplier
     */
    public static function productSupplier($productSuppliersModel)
    {

    }

    public static function createProductSupplier($productSuppliersModel)
    {
        $url = self::getElasticUrl() . 'products/' . $productSuppliersModel->productId . '/suppliers/' . $productSuppliersModel->productSuppId;

        return self::connect($url, self::prepareProductSupplierData($productSuppliersModel), self::METHOD_POST);
    }

    public static function updateProductSupplier($productSuppliersModel)
    {
        $url = self::getElasticUrl() . 'products/' . $productSuppliersModel->productId . '/suppliers/' . $productSuppliersModel->productSuppId;

        return self::connect($url, self::prepareProductSupplierData($productSuppliersModel), self::METHOD_PUT);
    }

    public static function deleteProductSupplier($productSuppliersModel)
    {
        $url = self::getElasticUrl() . 'products/' . $productSuppliersModel->productId . '/suppliers/' . $productSuppliersModel->productSuppId;

        return self::connect($url, [], self::METHOD_DELETE);
    }

    public static function prepareProductSupplierData($productSuppliersModel)
    {
        $productPriceSuppliers = ProductPriceSuppliers::find()->where(['productSuppId'=>$productSuppliersModel->productSuppId, 'status'=>1])->one();
        $price = $productPriceSuppliers->price;
        settype($price, 'double');

        $res = [
            'result' => $productSuppliersModel->result,
            'price' => $price,
            'status' => $productSuppliersModel->status,
        ];

        return $res;
    }
}
