<?php

namespace frontend\controllers;

use common\models\costfit\Product;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use frontend\models\DisplaySearch;
use frontend\models\FakeFactory;
use frontend\models\DisplayMyCategory;
use yii\data\ArrayDataProvider;

class SearchController extends MasterController {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($title, $hash = FALSE) {

        if (isset($_GET['c']) && !empty($_GET['c'])) {
            $category = $_GET['c'];
            $categorySearchId = '';
        } else {
            $k = base64_decode(base64_decode($hash));
            $params = \common\models\ModelMaster::decodeParams($hash);
            $categoryId = $params['categoryId'];
            /* หา Categories Parent Children */
            $test2 = \frontend\controllers\CategoriesController::actionTreeSubToApiElastic($categoryId);

            foreach ($test2 as $key => $value) {
                $categoryArray[$key][] = $value['categoryId'];
                if (isset($value['Children'])) {
                    foreach ($value['Children'] as $key => $items) {
                        $categoryArray[$key][] = $items['categoryId'];
                        if (isset($items['Children'])) {
                            foreach ($items['Children'] as $key => $sub) {
                                $categoryArray[$key] = $sub['categoryId'];
                            }
                        }
                    }
                }
            }
            $cateToElasticx = '';
            if (isset($categoryArray)) {
                foreach ($categoryArray as $key => $value) {
                    $cateToElastic = '';
                    foreach ($value as $key => $item) {
                        $cateToElastic .= $item . ',';
                    }
                    $cateToElasticx .= $cateToElastic;
                }
                $categorySearchId = $cateToElasticx . $categoryId;
            } else {
                $categorySearchId = $categoryId;
            }

            $productStory = new ArrayDataProvider(['allModels' => \frontend\models\FakeFactory::productStoryViewsMore(99, $categoryId), 'pagination' => ['defaultPageSize' => 16]]);
        }


        $serverName = $_SERVER['SERVER_NAME'];
        $categorySearchId = isset($categorySearchId) ? $categorySearchId : $ConfigpParameter['categoryId'];
        $ConfigpParameter = $this->ConfigpParameter('searching');
        $statusStockData = $ConfigpParameter['statusStockData'];

        $Eparameter = array(
            'search' => $ConfigpParameter['search'],
            'status' => $ConfigpParameter['status'],
            'brandId' => $ConfigpParameter['brandId'],
            'categoryId' => $categorySearchId,
            'mins' => $ConfigpParameter['mins'],
            'maxs' => $ConfigpParameter['maxs'],
            'size' => 12,
            'pages' => $ConfigpParameter['pages'],
            'has_supplier' => 'true',
            'serverName' => $serverName
        );
        $EparameterNotSale = array(
            'search' => $ConfigpParameter['search'],
            'status' => $ConfigpParameter['status'],
            'brandId' => $ConfigpParameter['brandId'],
            'categoryId' => $categorySearchId,
            'mins' => $ConfigpParameter['mins'],
            'maxs' => $ConfigpParameter['maxs'],
            'size' => 12,
            'pages' => $ConfigpParameter['pages'],
            'has_supplier' => 'false',
            'serverName' => $serverName
        );

        /*
         * สินค้ามีใน Stock
         */
        /* 1. ส่ง data ไป get ข้อมูลของ apiโคเชน */
        $searchElastic = \common\helpers\ApiElasticSearch::searchProduct($Eparameter);
        //echo 'perPage : ' . $perPage;
        $dataProvider = new ArrayDataProvider([
            //'key' => 'productid',
            'allModels' => $searchElastic['data'],
            /* 'sort' => [
              'attributes' => ['total', 'took', 'size', 'page', 'data'],
              ], */
            'pagination' => [
                'pageSize' => $searchElastic['size'],
            ],
        ]);
        /* end 1 */
        /*
         * 2. เอา productid ไปหา MIN(pps.price) as minPrice , MAX(pps.price) as maxPrice เพราะโคเชนส่งมาครั้งละ 10 row
         */
        foreach ($dataProvider->allModels as $key => $value) {
            $productid[] = $value['productId'];
            $brandid[] = $value['brandId'];
            //$productid['brandid'] = $value['brandid'];
        }
        if (isset($productid) && count($productid) > 0) {
            $productid = $productid;
        } else {
            $productid = NULL;
        }
        if (isset($brandid)) {
            $brandid = $brandid;
        } else {
            $brandid = NULL;
        }

        $catPrice = DisplaySearch::findAllPriceSearch($ConfigpParameter['search'], $productid);
        /* end 2 */
        /*
         * สินค้าไม่มีใน Stock
         */
        $searchElasticNotSalse = \common\helpers\ApiElasticSearch::searchProduct($EparameterNotSale);
        $dataProviderNotSalse = new ArrayDataProvider([
            //'key' => 'productid',
            'allModels' => $searchElasticNotSalse['data'],
            /* 'sort' => [
              'attributes' => ['total', 'took', 'size', 'page', 'data'],
              ], */
            'pagination' => [
                'pageSize' => $searchElasticNotSalse['size'],
            ],
        ]);
        /* end 1 */
        /*
         * 2. เอา productid ไปหา MIN(pps.price) as minPrice , MAX(pps.price) as maxPrice เพราะโคเชนส่งมาครั้งละ 10 row
         */
        //$productid[] = '';
        foreach ($dataProviderNotSalse->allModels as $key => $value) {
            $productidSup[] = $value['productId'];
            $brandidSup[] = $value['brandId'];
            //$productid['brandid'] = $value['brandid'];
        }
        if (isset($productidSup) && count($productidSup) > 0) {
            $productidSup = $productid;
        } else {
            $productidSup = NULL;
        }
        if (isset($brandidSup)) {
            $brandidSup = $brandid;
        } else {
            $brandidSup = NULL;
        }
        /*
         * สินค้าที่มีใน Stock
         * 3.หา paginate
         */

        //echo $ConfigpParameter['brandId'];
        //$productFilterBrand = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyBrand::MyFilterBrand($ConfigpParameter['categoryId'])]);
        $productFilterBrand = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyBrand::MyFilterBrandNew($brandid)]);
        /* 3.หา paginate */
        $perPage = round($searchElastic['total'] / 12, 0, PHP_ROUND_HALF_UP);
        $item_per_page = 12; //$searchElastic['size'];
        $current_page = isset($ConfigpParameter['pages']) ? $ConfigpParameter['pages'] : 1;
        $total_records = $searchElastic['total'];
        $total_pages = $perPage;
        //search=&brandName=3,51,42&mins=100&maxs=100&categoryId=&pages=18
        $paginate = \common\helpers\ApiElasticSearch::paginate($item_per_page, $current_page, $total_records, $total_pages, $ConfigpParameter['search'], $ConfigpParameter['brandId'], $ConfigpParameter['mins'], $ConfigpParameter['maxs'], $categorySearchId, 'stock');
        /*
         * สินค้าที่ไม่มีใน Stock
         * 3.หา paginate
         */
        $perPageNoStock = round($searchElasticNotSalse['total'] / 12, 0, PHP_ROUND_HALF_UP);
        $item_per_page_no_stock = 12; //$searchElastic['size'];
        $current_page_no_stock = isset($ConfigpParameter['pages']) ? $ConfigpParameter['pages'] : 1;
        $total_records_no_stock = $searchElasticNotSalse['total'];
        $total_pages_no_stock = $perPageNoStock;
        //search=&brandName=3,51,42&mins=100&maxs=100&categoryId=&pages=18
        $paginateNoStock = \common\helpers\ApiElasticSearch::paginate($item_per_page_no_stock, $current_page_no_stock, $total_records_no_stock, $total_pages_no_stock, $ConfigpParameter['search'], $ConfigpParameter['brandId'], $ConfigpParameter['mins'], $ConfigpParameter['maxs'], $categorySearchId, 'nostock');

        if (isset($ConfigpParameter['pages'])) {
            return $this->renderAjax('@app/themes/cozxy/layouts/elastic/_product_item_rev1_json_render', compact('statusStockData', 'dataProviderNotSalse', 'paginate', 'paginateNoStock', 'ConfigpParameter', 'dataProvider', 'searchElastic', 'productFilterBrand', 'catPrice', 'perPage'));
        } else {
            if (isset($_GET['type'])) {
                return $this->renderAjax('@app/themes/cozxy/layouts/elastic/_product_item_rev1_json_render', compact('statusStockData', 'dataProviderNotSalse', 'paginate', 'paginateNoStock', 'ConfigpParameter', 'dataProvider', 'searchElastic', 'productFilterBrand', 'catPrice', 'perPage'));
            } else {
                return $this->render('@app/views/elastic/index_search_json', compact('title', 'dataProviderNotSalse', 'paginate', 'paginateNoStock', 'ConfigpParameter', 'searchElastic', 'dataProvider', 'productFilterBrand', 'catPrice', 'perPage'));
            }
        }
    }

    public function actionIndex1($title, $hash = FALSE) {
        if (isset($_GET['c']) && !empty($_GET['c'])) {
            $category = $_GET['c'];
        } else {
            $k = base64_decode(base64_decode($hash));
            $params = \common\models\ModelMaster::decodeParams($hash);
            $categoryId = $params['categoryId'];

            $productStory = new ArrayDataProvider(['allModels' => \frontend\models\FakeFactory::productStoryViewsMore(99, $categoryId), 'pagination' => ['defaultPageSize' => 16]]);
        }

//echo 'categoryId :' . $categoryId;
//$productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(9, $categoryId)]);
        $catPrice = DisplaySearch::findAllPrice($categoryId);
//        $productCanSell = new ArrayDataProvider(
//        [
//            'allModels' => DisplaySearch::productSearchCategory('', $categoryId, '', ''),
//            'pagination' => ['defaultPageSize' => 15],
//        ]);
//
//        $productNotSell = new ArrayDataProvider(
//        [
//            'allModels' => DisplaySearch::productSearchCategoryNotSale('', $categoryId, '', ''),
//            'pagination' => ['defaultPageSize' => 15],
//        ]);
        $productSupplierId = '';

        $productFilterBrand = new ArrayDataProvider(
                [
            'allModels' => \frontend\models\DisplayMyBrand::MyFilterBrand($categoryId)
        ]);

//$productCanSell = Product::productForSaleByCategory($categoryId);
        $productCanSell = Product::productForSale(12, $categoryId);
        $productNotSell = Product::productForNotSale(12, $categoryId);


//print_r($productNotSell);

        if ($categoryId != 'undefined') {
            $site = 'category';
        } else {
            $category = FALSE;
            $site = 'brand';
        }
        $promotions = Product::productPromotion(12, $categoryId);
        return $this->render('index', compact('promotions', 'site', 'productStory', 'productCanSell', 'category', 'categoryId', 'productSupplierId', 'productNotSell', 'productFilterBrand', 'title', 'catPrice'));
    }

    public function actionCozxyProduct() {
//$category = Yii::$app->request->post('search');
//$productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(9, FALSE)]);
//return $this->render('index', compact('productCanSell', 'category'));
        $search_hd = Yii::$app->request->get('search');

        $categoryId = NULL;

        /* $productCanSell = new ArrayDataProvider(
          [
          'allModels' => DisplaySearch::productSearch($category, 12, FALSE),
          'pagination' => ['defaultPageSize' => 12],
          ]); */
        $productCanSell = DisplaySearch::productSearch($search_hd, 12, FALSE);


        /* $productNotSell = new ArrayDataProvider(
          [
          'allModels' => DisplaySearch::productSearchNotSale($category, 12, FALSE),
          'pagination' => ['defaultPageSize' => 12],
          ]); */

        $productNotSell = DisplaySearch::productSearchNotSale($search_hd, 12, FALSE);


        $productFilterBrand = new ArrayDataProvider(
                [
            'allModels' => \frontend\models\DisplayMyBrand::MyFilterBrand($categoryId)
        ]);
        $site = 'brand';

        $catPrice = DisplaySearch::findAllPriceSearch($search_hd);
        return $this->render('index_search', compact('site', 'catPrice', 'productCanSell', 'category', 'categoryId', 'productNotSell', 'productFilterBrand', 'search_hd'));
    }

    public function actionBrand($hash = FALSE) {

        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $brandId = $params['brandId'];
        if (isset($brandId) && !empty($brandId)) {
            $brand = \common\models\costfit\Brand::find()->where('brandId=' . $brandId)->one();
            if (isset($brand)) {
                $title = $brand['title'];
            } else {
                $title = '';
            }
        } else {
            $title = '';
        }


        //echo 'categoryId :' . $categoryId;

        $serverName = $_SERVER['SERVER_NAME'];

        $ConfigpParameter = $this->ConfigpParameter('searching');
        $statusStockData = $ConfigpParameter['statusStockData'];

        $EbrandId = isset($brandId) ? $brandId : $ConfigpParameter['brandId'];

        $Eparameter = array(
            'search' => $ConfigpParameter['search'],
            'status' => $ConfigpParameter['status'],
            'brandId' => $EbrandId,
            'categoryId' => $ConfigpParameter['categoryId'],
            'mins' => $ConfigpParameter['mins'],
            'maxs' => $ConfigpParameter['maxs'],
            'size' => 12,
            'pages' => $ConfigpParameter['pages'],
            'has_supplier' => 'true',
            'serverName' => $serverName
        );
        $EparameterNotSale = array(
            'search' => $ConfigpParameter['search'],
            'status' => $ConfigpParameter['status'],
            'brandId' => $EbrandId,
            'categoryId' => $ConfigpParameter['categoryId'],
            'mins' => $ConfigpParameter['mins'],
            'maxs' => $ConfigpParameter['maxs'],
            'size' => 12,
            'pages' => $ConfigpParameter['pages'],
            'has_supplier' => 'false',
            'serverName' => $serverName
        );
        /*
         * สินค้ามีใน Stock
         */
        /* 1. ส่ง data ไป get ข้อมูลของ apiโคเชน */
        $searchElastic = \common\helpers\ApiElasticSearch::searchProduct($Eparameter);
        //echo 'perPage : ' . $perPage;
        $dataProvider = new ArrayDataProvider([
            //'key' => 'productid',
            'allModels' => $searchElastic['data'],
            /* 'sort' => [
              'attributes' => ['total', 'took', 'size', 'page', 'data'],
              ], */
            'pagination' => [
                'pageSize' => $searchElastic['size'],
            ],
        ]);
        /* end 1 */
        /*
         * 2. เอา productid ไปหา MIN(pps.price) as minPrice , MAX(pps.price) as maxPrice เพราะโคเชนส่งมาครั้งละ 10 row
         */
        foreach ($dataProvider->allModels as $key => $value) {
            $productid[] = $value['productId'];
            $brandid[] = $value['brandId'];
            //$productid['brandid'] = $value['brandid'];
        }
        if (isset($productid) && count($productid) > 0) {
            $productid = $productid;
        } else {
            $productid = NULL;
        }
        if (isset($brandid)) {
            $brandid = $brandid;
        } else {
            $brandid = NULL;
        }

        $catPrice = DisplaySearch::findAllPriceSearch($ConfigpParameter['search'], $productid);
        /* end 2 */
        /*
         * สินค้าไม่มีใน Stock
         */
        $searchElasticNotSalse = \common\helpers\ApiElasticSearch::searchProduct($EparameterNotSale);
        $dataProviderNotSalse = new ArrayDataProvider([
            //'key' => 'productid',
            'allModels' => $searchElasticNotSalse['data'],
            /* 'sort' => [
              'attributes' => ['total', 'took', 'size', 'page', 'data'],
              ], */
            'pagination' => [
                'pageSize' => $searchElasticNotSalse['size'],
            ],
        ]);
        /* end 1 */
        /*
         * 2. เอา productid ไปหา MIN(pps.price) as minPrice , MAX(pps.price) as maxPrice เพราะโคเชนส่งมาครั้งละ 10 row
         */
        //$productid[] = '';
        foreach ($dataProviderNotSalse->allModels as $key => $value) {
            $productidSup[] = $value['productId'];
            $brandidSup[] = $value['brandId'];
            //$productid['brandid'] = $value['brandid'];
        }
        if (isset($productidSup) && count($productidSup) > 0) {
            $productidSup = $productid;
        } else {
            $productidSup = NULL;
        }
        if (isset($brandidSup)) {
            $brandidSup = $brandid;
        } else {
            $brandidSup = NULL;
        }
        /*
         * สินค้าที่มีใน Stock
         * 3.หา paginate
         */
        //$productFilterBrand = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyBrand::MyFilterBrand($ConfigpParameter['categoryId'])]);
        $productFilterBrand = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyBrand::MyFilterBrandNew($brandid)]);
        /* 3.หา paginate */
        $perPage = round($searchElastic['total'] / 12, 0, PHP_ROUND_HALF_UP);
        $item_per_page = 12; //$searchElastic['size'];
        $current_page = isset($ConfigpParameter['pages']) ? $ConfigpParameter['pages'] : 1;
        $total_records = $searchElastic['total'];
        $total_pages = $perPage;
        //search=&brandName=3,51,42&mins=100&maxs=100&categoryId=&pages=18
        $paginate = \common\helpers\ApiElasticSearch::paginate($item_per_page, $current_page, $total_records, $total_pages, $ConfigpParameter['search'], $EbrandId, $ConfigpParameter['mins'], $ConfigpParameter['maxs'], $ConfigpParameter['categoryId'], 'stock');
        /*
         * สินค้าที่ไม่มีใน Stock
         * 3.หา paginate
         */
        $perPageNoStock = round($searchElasticNotSalse['total'] / 12, 0, PHP_ROUND_HALF_UP);
        $item_per_page_no_stock = 12; //$searchElastic['size'];
        $current_page_no_stock = isset($ConfigpParameter['pages']) ? $ConfigpParameter['pages'] : 1;
        $total_records_no_stock = $searchElasticNotSalse['total'];
        $total_pages_no_stock = $perPageNoStock;
        //search=&brandName=3,51,42&mins=100&maxs=100&categoryId=&pages=18
        $paginateNoStock = \common\helpers\ApiElasticSearch::paginate($item_per_page_no_stock, $current_page_no_stock, $total_records_no_stock, $total_pages_no_stock, $ConfigpParameter['search'], $EbrandId, $ConfigpParameter['mins'], $ConfigpParameter['maxs'], $ConfigpParameter['categoryId'], 'nostock');

        if (isset($ConfigpParameter['pages'])) {
            return $this->renderAjax('@app/themes/cozxy/layouts/elastic/_product_item_rev1_json_render', compact('statusStockData', 'dataProviderNotSalse', 'paginate', 'paginateNoStock', 'ConfigpParameter', 'dataProvider', 'searchElastic', 'productFilterBrand', 'catPrice', 'perPage'));
        } else {
            if (isset($_GET['type'])) {
                return $this->renderAjax('@app/themes/cozxy/layouts/elastic/_product_item_rev1_json_render', compact('statusStockData', 'dataProviderNotSalse', 'paginate', 'paginateNoStock', 'ConfigpParameter', 'dataProvider', 'searchElastic', 'productFilterBrand', 'catPrice', 'perPage'));
            } else {
                return $this->render('@app/views/elastic/index_search_json', compact('title', 'dataProviderNotSalse', 'paginate', 'paginateNoStock', 'ConfigpParameter', 'searchElastic', 'dataProvider', 'productFilterBrand', 'catPrice', 'perPage'));
            }
        }
    }

    public function actionFilterPrice() {
        $mins = Yii::$app->request->post('mins');
        $maxs = Yii::$app->request->post('maxs');
        $categoryId = Yii::$app->request->get('categoryId');
        $brand = Yii::$app->request->post('brand');
        $FilterPrice = [];
//$productFilterPrice = new ArrayDataProvider(['allModels' => DisplaySearch::productSearchCategory(9, $categoryId, $mins, $maxs)]);
        $productFilterPriceNotsale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productFilterAll($categoryId, $brand, $mins, $maxs, 'Notsale'),
            'pagination' => ['defaultPageSize' => 12]
        ]);
        $productFilterPriceCansale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productFilterAll($categoryId, $brand, $mins, $maxs, 'Cansale'),
            'pagination' => ['defaultPageSize' => 12]
        ]);
//
        $category = \common\models\costfit\Category::findOne($categoryId)->title;
        $promotions = Product::productPromotion(12, $categoryId, $brand, $mins, $maxs);
        return $this->renderAjax("_product_list", [
                    'productFilterPriceNotsale' => $productFilterPriceNotsale,
                    'productFilterPriceCansale' => $productFilterPriceCansale,
                    'category' => $category,
                    'categoryId' => $categoryId, 'promotions' => $promotions
        ]);
    }

    public function actionFilterPriceBrand() {
        $mins = Yii::$app->request->post('mins');
        $maxs = Yii::$app->request->post('maxs');
        $brandId = Yii::$app->request->post('brandId');
        $brandName = "";

//$productFilterPrice = new ArrayDataProvider(['allModels' => DisplaySearch::productSearchCategory(9, $categoryId, $mins, $maxs)]);
        $productFilterPriceNotsale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productFilterAll($categoryId = false, $brandId, $mins, $maxs, 'Notsale'),
            'pagination' => ['defaultPageSize' => 12]
        ]);
        $productFilterPriceCansale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productFilterAll($categoryId = false, $brandId, $mins, $maxs, 'Cansale'),
            'pagination' => ['defaultPageSize' => 12]
        ]);
//
// throw new \yii\base\Exception($mins . ',' . $maxs);
        $brand = \common\models\costfit\Brand::find()->where("brandId=" . $brandId)->one();
        if (isset($brandId)) {
            $brandName = $brand->title;
        }
        $promotions = Product::productPromotion(12, '', $brandId);
        return $this->renderAjax("_product_list_brand", [
                    'productFilterPriceNotsale' => $productFilterPriceNotsale,
                    'productFilterPriceCansale' => $productFilterPriceCansale,
                    'brandName' => $brandName,
                    'brandId' => $brandId, 'promotions' => $promotions
        ]);
    }

    public function actionFilterPriceAll() {
        $mins = Yii::$app->request->post('mins');
        $maxs = Yii::$app->request->post('maxs');
        $search = Yii::$app->request->post('search');
        $productFilterPriceNotsale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productFilterAllSearch($search, $mins, $maxs, $sort = false, $type = false, 'Notsale'),
            'pagination' => ['defaultPageSize' => 12]
        ]);
        $productFilterPriceCansale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productFilterAllSearch($search, $mins, $maxs, $sort = false, $type = false, 'Cansale'),
            'pagination' => ['defaultPageSize' => 12]
        ]);
//
// throw new \yii\base\Exception($mins . ',' . $maxs);

        return $this->renderAjax("_product_list_all_search", [
                    'productFilterPriceNotsale' => $productFilterPriceNotsale,
                    'productFilterPriceCansale' => $productFilterPriceCansale,
                    'search' => $search,
        ]);
    }

    public function actionFilterBrand() {
//echo ;;l
        $mins = Yii::$app->request->post('mins');
        $maxs = Yii::$app->request->post('maxs');
        $brand = Yii::$app->request->post('brand');
        $categoryId = Yii::$app->request->get('categoryId');
        $search = Yii::$app->request->post('search');
        if (isset($_GET['brandName']) && !empty($_GET['brandName']) && $_GET['brandName'] != '') {
            $brand = Yii::$app->request->get('brandName');
            $brand = substr($brand, 0, -1);
            $brandTxt = explode(",", $brand);
            $brand = array_map('trim', explode(",", $brand));
        }
        if ($categoryId != 'undefined') {
            $categoryId = Yii::$app->request->get('categoryId');
        } else {
            $category = FALSE;
        }
        $productFilterPriceNotsale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productFilterAlls($categoryId, $brand, $mins, $maxs, 'Notsale'),
            'pagination' => ['defaultPageSize' => 9]
        ]);

        $productFilterPriceCansale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productFilterAlls($categoryId, $brand, $mins, $maxs, 'Cansale'),
            'pagination' => ['defaultPageSize' => 9]
        ]);

        if ($categoryId != 'undefined') {
            $category = \common\models\costfit\Category::findOne($categoryId)->title;
            $site = 'category';
            $promotions = Product::productPromotion(12, $categoryId, $brand);
        } else {
            $category = FALSE;
            $site = 'brand';
            $promotions = Product::productPromotion(12, '', $brand);
        }
// throw new \yii\base\Exception($categoryId);
        return $this->renderAjax("_product_list_choose_brand", [
                    'promotions' => $promotions,
                    'productFilterPriceNotsale' => $productFilterPriceNotsale,
                    'productFilterPriceCansale' => $productFilterPriceCansale,
                    'category' => $category,
                    'categoryId' => $categoryId,
                    'brandId' => $brand,
                    'site' => $site,
                    'search' => $search
        ]);
    }

    public function actionSortCozxy() {
        $FilterPrice = [];
        $mins = Yii::$app->request->post('mins');
        $maxs = Yii::$app->request->post('maxs');
        $brand = Yii::$app->request->post('brand');
        $categoryId = Yii::$app->request->get('categoryId');
        $status = Yii::$app->request->post('status');
//        $sortBrand = Yii::$app->request->post('sortBrand');
//        $sortPrice = Yii::$app->request->post('sortPrice');
//        $sortNew = Yii::$app->request->post('sortNew');
        $sort = Yii::$app->request->post('sort');

        $productFilterPriceNotsale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productSortAlls($categoryId, $brand, $mins, $maxs, $status, $sort, 'Notsale'),
            'pagination' => ['defaultPageSize' => 12]
        ]);

        $productFilterPriceCansale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productSortAlls($categoryId, $brand, $mins, $maxs, $status, $sort, 'Cansale'),
            'pagination' => ['defaultPageSize' => 12]
        ]);

        $sortstatus = ($status == "price") ? "price" : (($status == "brand") ? "brand" : "new");

        if ($categoryId != '') {
            $category = \common\models\costfit\Category::findOne($categoryId)->title;
            $promotions = Product::productPromotion(12, $categoryId, $brand, $mins, $maxs, $status, $sort);
        } else {
            $category = '';
            $promotions = Product::productPromotion(12, '', $brand, $mins, $maxs, $status, $sort);
        }
//echo 'categoryId:' . $categoryId;
//echo '<br>brand:' . $brand;
        return $this->renderAjax("_product_list", [
                    'productFilterPriceNotsale' => $productFilterPriceNotsale,
                    'productFilterPriceCansale' => $productFilterPriceCansale,
                    'category' => $category,
                    'categoryId' => $categoryId,
                    'sort' => $sort,
                    'sortstatus' => $sortstatus,
                    'promotions' => $promotions
        ]);
    }

    public function actionSortCozxyFixBrand() {
        $FilterPrice = [];
        $brandName = '';
        $mins = Yii::$app->request->post('mins');
        $maxs = Yii::$app->request->post('maxs');
        $brandId = Yii::$app->request->get('brandId');
        $status = Yii::$app->request->post('status');
//        $sortBrand = Yii::$app->request->post('sortBrand');
//        $sortPrice = Yii::$app->request->post('sortPrice');
//        $sortNew = Yii::$app->request->post('sortNew');
        $sort = Yii::$app->request->post('sort');

        $productFilterPriceNotsale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productSortAlls($categoryId = false, $brandId, $mins, $maxs, $status, $sort, 'Notsale'),
            'pagination' => ['defaultPageSize' => 12]
        ]);

        $productFilterPriceCansale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productSortAlls($categoryId = false, $brandId, $mins, $maxs, $status, $sort, 'Cansale'),
            'pagination' => ['defaultPageSize' => 12]
        ]);

        $sortstatus = ($status == "price") ? "price" : (($status == "brand") ? "brand" : "new");

        $brand = \common\models\costfit\Brand::find()->where("brandId=" . $brandId)->one();
        if (isset($brandId)) {
            $brandName = $brand->title;
        }
        $promotions = Product::productPromotion(12, '', $brandId);
        return $this->renderAjax("_product_list_brand", [
                    'productFilterPriceNotsale' => $productFilterPriceNotsale,
                    'productFilterPriceCansale' => $productFilterPriceCansale,
                    'brandName' => $brandName,
                    'brandId' => $brandId,
                    'sort' => $sort,
                    'sortstatus' => $sortstatus,
                    'promotions' => $promotions
        ]);
    }

    public function actionSortCozxySearch() {
        $FilterPrice = [];
        $brandName = '';
        $mins = Yii::$app->request->post('mins');
        $maxs = Yii::$app->request->post('maxs');
        $search = Yii::$app->request->post('search');
        $sort = Yii::$app->request->post('sort');
        $type = Yii::$app->request->post('type');
        $productFilterPriceNotsale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productFilterAllSearch($search, $mins, $maxs, $sort, $type, 'Cansale'),
            'pagination' => ['defaultPageSize' => 12]
        ]);
        $productFilterPriceCansale = new ArrayDataProvider([
            'allModels' => DisplaySearch::productFilterAllSearch($search, $mins, $maxs, $sort, $type, 'Cansale'),
            'pagination' => ['defaultPageSize' => 12]
        ]);

        $sortstatus = ($type == "price") ? "price" : (($type == "brand") ? "brand" : "new");

        return $this->renderAjax("_product_list_all_search", [
                    'productFilterPriceNotsale' => $productFilterPriceNotsale,
                    'productFilterPriceCansale' => $productFilterPriceCansale,
                    'search' => $search,
                    'sortstatus' => $sortstatus,
                    'sort' => $sort
        ]);
    }

    public function actionShowMoreProducts() {

        $catz = Yii::$app->request->post('cat');
        $countz = (int) Yii::$app->request->post('count');
        $startz = (int) Yii::$app->request->post('starts');
        $endz = (int) Yii::$app->request->post('ends');
        /*
          starts:0
          ends:90
         * */
        $FilterPrice = [];
        if ($countz <= $endz) {
            $endzShow = $countz;
        } else {
            $endzShow = $endz;
        }
        $productFilterPrice = new ArrayDataProvider(['allModels' => DisplaySearch::productSearchCategoryShowMore($startz, $endzShow, $catz)]);

        if (count($productFilterPrice->allModels) > 0) {
            foreach ($productFilterPrice->allModels as $key => $value) {
                $FilterPrice[$value['productSuppId']] = [
                    'brand' => $value['brand'],
                    'productSuppId' => $value['productSuppId'],
                    'image' => $value['image'],
                    'url' => $value['url'],
                    'brand' => $value['brand'],
                    'title' => $value['title'],
                    'price_s' => $value['price_s'],
                    'price' => $value['price'],
                    'maxQnty' => $value['maxQnty'],
                    'fastId' => $value['fastId'],
                    'productId' => $value['productId'],
                    'supplierId' => $value['supplierId'],
                    'receiveType' => $value['receiveType'],
                    'wishList' => $value['wishList']
                ];
            }
            //$FilterPrice = $FilterPrices;
        }
        //echo '<pre>';
        //print_r($productFilterPrice);
        return json_encode($FilterPrice);
    }

    public function actionElasticSearch() {
        //  --url 'http://45.76.157.59:3000/search?text=dry%20skin&brand_id=67,68&category_id=16'
        $serverName = $_SERVER['SERVER_NAME'];

        $ConfigpParameter = $this->ConfigpParameter('searching');
        $statusStockData = $ConfigpParameter['statusStockData'];

        $Eparameter = array(
            'search' => $ConfigpParameter['search'],
            'status' => $ConfigpParameter['status'],
            'brandId' => $ConfigpParameter['brandId'],
            'categoryId' => $ConfigpParameter['categoryId'],
            'mins' => $ConfigpParameter['mins'],
            'maxs' => $ConfigpParameter['maxs'],
            'size' => 12,
            'pages' => $ConfigpParameter['pages'],
            'has_supplier' => 'true',
            'serverName' => $serverName
        );
        $EparameterNotSale = array(
            'search' => $ConfigpParameter['search'],
            'status' => $ConfigpParameter['status'],
            'brandId' => $ConfigpParameter['brandId'],
            'categoryId' => $ConfigpParameter['categoryId'],
            'mins' => $ConfigpParameter['mins'],
            'maxs' => $ConfigpParameter['maxs'],
            'size' => 12,
            'pages' => $ConfigpParameter['pages'],
            'has_supplier' => 'false',
            'serverName' => $serverName
        );
        /*
         * สินค้ามีใน Stock
         */
        /* 1. ส่ง data ไป get ข้อมูลของ apiโคเชน */
        $searchElastic = \common\helpers\ApiElasticSearch::searchProduct($Eparameter);
        //echo 'perPage : ' . $perPage;
        $dataProvider = new ArrayDataProvider([
            //'key' => 'productid',
            'allModels' => $searchElastic['data'],
            /* 'sort' => [
              'attributes' => ['total', 'took', 'size', 'page', 'data'],
              ], */
            'pagination' => [
                'pageSize' => $searchElastic['size'],
            ],
        ]);
        /* end 1 */
        /*
         * 2. เอา productid ไปหา MIN(pps.price) as minPrice , MAX(pps.price) as maxPrice เพราะโคเชนส่งมาครั้งละ 10 row
         */
        foreach ($dataProvider->allModels as $key => $value) {
            $productid[] = $value['productId'];
            $brandid[] = $value['brandId'];
            //$productid['brandid'] = $value['brandid'];
        }
        if (isset($productid) && count($productid) > 0) {
            $productid = $productid;
        } else {
            $productid = NULL;
        }
        if (isset($brandid)) {
            $brandid = $brandid;
        } else {
            $brandid = NULL;
        }

        $catPrice = DisplaySearch::findAllPriceSearch($ConfigpParameter['search'], $productid);
        /* end 2 */
        /*
         * สินค้าไม่มีใน Stock
         */
        $searchElasticNotSalse = \common\helpers\ApiElasticSearch::searchProduct($EparameterNotSale);
        $dataProviderNotSalse = new ArrayDataProvider([
            //'key' => 'productid',
            'allModels' => $searchElasticNotSalse['data'],
            /* 'sort' => [
              'attributes' => ['total', 'took', 'size', 'page', 'data'],
              ], */
            'pagination' => [
                'pageSize' => $searchElasticNotSalse['size'],
            ],
        ]);
        /* end 1 */
        /*
         * 2. เอา productid ไปหา MIN(pps.price) as minPrice , MAX(pps.price) as maxPrice เพราะโคเชนส่งมาครั้งละ 10 row
         */
        //$productid[] = '';
        foreach ($dataProviderNotSalse->allModels as $key => $value) {
            $productidSup[] = $value['productId'];
            $brandidSup[] = $value['brandId'];
            //$productid['brandid'] = $value['brandid'];
        }
        if (isset($productidSup) && count($productidSup) > 0) {
            $productidSup = $productid;
        } else {
            $productidSup = NULL;
        }
        if (isset($brandidSup)) {
            $brandidSup = $brandid;
        } else {
            $brandidSup = NULL;
        }
        /*
         * สินค้าที่มีใน Stock
         * 3.หา paginate
         */
        $EbrandId = $ConfigpParameter['brandId'];
        //$productFilterBrand = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyBrand::MyFilterBrand($ConfigpParameter['categoryId'])]);
        $productFilterBrand = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyBrand::MyFilterBrandNew($brandid)]);
        /* 3.หา paginate */
        $perPage = round($searchElastic['total'] / 12, 0, PHP_ROUND_HALF_UP);
        $item_per_page = 12; //$searchElastic['size'];
        $current_page = isset($ConfigpParameter['pages']) ? $ConfigpParameter['pages'] : 1;
        $total_records = $searchElastic['total'];
        $total_pages = $perPage;
        //search=&brandName=3,51,42&mins=100&maxs=100&categoryId=&pages=18
        $paginate = \common\helpers\ApiElasticSearch::paginate($item_per_page, $current_page, $total_records, $total_pages, $ConfigpParameter['search'], $EbrandId, $ConfigpParameter['mins'], $ConfigpParameter['maxs'], $ConfigpParameter['categoryId'], 'stock');
        /*
         * สินค้าที่ไม่มีใน Stock
         * 3.หา paginate
         */
        $perPageNoStock = round($searchElasticNotSalse['total'] / 12, 0, PHP_ROUND_HALF_UP);
        $item_per_page_no_stock = 12; //$searchElastic['size'];
        $current_page_no_stock = isset($ConfigpParameter['pages']) ? $ConfigpParameter['pages'] : 1;
        $total_records_no_stock = $searchElasticNotSalse['total'];
        $total_pages_no_stock = $perPageNoStock;
        //search=&brandName=3,51,42&mins=100&maxs=100&categoryId=&pages=18
        $paginateNoStock = \common\helpers\ApiElasticSearch::paginate($item_per_page_no_stock, $current_page_no_stock, $total_records_no_stock, $total_pages_no_stock, $ConfigpParameter['search'], $EbrandId, $ConfigpParameter['mins'], $ConfigpParameter['maxs'], $ConfigpParameter['categoryId'], 'nostock');

        if (isset($ConfigpParameter['pages'])) {
            return $this->renderAjax('@app/themes/cozxy/layouts/elastic/_product_item_rev1_json_render', compact('statusStockData', 'dataProviderNotSalse', 'paginate', 'paginateNoStock', 'ConfigpParameter', 'dataProvider', 'searchElastic', 'productFilterBrand', 'catPrice', 'perPage'));
        } else {
            if (isset($_GET['type'])) {
                return $this->renderAjax('@app/themes/cozxy/layouts/elastic/_product_item_rev1_json_render', compact('statusStockData', 'dataProviderNotSalse', 'paginate', 'paginateNoStock', 'ConfigpParameter', 'dataProvider', 'searchElastic', 'productFilterBrand', 'catPrice', 'perPage'));
            } else {
                return $this->render('@app/views/elastic/index_search_json', compact('dataProviderNotSalse', 'paginate', 'paginateNoStock', 'ConfigpParameter', 'searchElastic', 'dataProvider', 'productFilterBrand', 'catPrice', 'perPage'));
            }
        }
        //return $this->render('index_search_json', compact('site', 'search', 'categoryId', 'brandId', 'searchElastic', 'dataProvider', 'productFilterBrand', 'catPrice'));
    }

    public function ConfigpParameter($type) {

        $statusStockData = Yii::$app->request->get('status');
        $mins = Yii::$app->request->get('mins');
        $maxs = Yii::$app->request->get('maxs');
        if ($mins == 100 && $maxs == 100) {
            $mins = '';
            $maxs = '';
        }
        $brand = Yii::$app->request->get('brand');
        $size = Yii::$app->request->get('size');
        $pages = Yii::$app->request->get('page');
        $status = 1;
        //print_r($brand);
        //$categoryId = Yii::$app->request->get('categoryId');
        $categoryId = Yii::$app->request->get('category');
        //$search = Yii::$app->request->get('search');
        $search = Yii::$app->request->get('search');
        if (isset($search)) {
            $search = Yii::$app->request->get('search');
        } else {
            $search = Yii::$app->request->post('search');
        }
        $brandName = Yii::$app->request->get('brandName');
        if ($type == 'searching') {
            $brandId = Yii::$app->request->get('brandName');
        } else {
            if (isset($_GET['brandName']) && !empty($_GET['brandName']) && $_GET['brandName'] != '') {
                $brand = Yii::$app->request->get('brandName');
                $brandId = substr($brand, 0, -1);
            } else {
                $brandId = NULL;
            }
        }

        if ($categoryId != 'undefined') {
            $categoryId = Yii::$app->request->get('category');
            $site = 'category';
        } else {
            $categoryId = NULL;
            $site = 'brand';
        }

        //echo 'xx :' . $brandId;

        $Eparameter = array(
            'search' => $search,
            'status' => $status,
            'brandId' => $brandId,
            'categoryId' => $categoryId,
            'mins' => $mins,
            'maxs' => $maxs,
            'size' => $size,
            'pages' => $pages,
            'site' => $site,
            'statusStockData' => $statusStockData
        );
        return $Eparameter;
    }

    public function actionEPaginate() {
        $page = $_GET['page'];
        $search = $_GET['search'];
        $brandName = $_GET['brandName'];
        $mins = $_GET['mins'];
        $maxs = $_GET['maxs'];
        $category = $_GET['category'];
        $Trecords = $_GET['Trecords'];
        $Tpages = $_GET['Tpages'];
        $item_per_page = 12;
        $current_page = $page;
        $total_records = $Trecords;
        $total_pages = $Tpages;
        $status = $_GET['status'];
        $paginate = \common\helpers\ApiElasticSearch::paginate($item_per_page, $current_page, $total_records, $total_pages, $search, $brandName, $mins, $maxs, $category, $status);
        echo $paginate;
    }

}
