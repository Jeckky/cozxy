<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use frontend\models\DisplayMyStory;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\Product;
use common\models\costfit\ProductImageSuppliers;
use common\models\costfit\ProductShelf;
use common\models\costfit\Currency;
use common\models\dbworld\Countries;

class StoryController extends MasterController {

    public function actionIndex($hash = FALSE) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $productSuppId = isset($params['productSupplierId']) ? $params['productSupplierId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;

        /*
         * Product Post View : Count Story
         */
        $productViews = new \common\models\costfit\ProductPostView();
        $productViews->productPostId = $productPostId;
        $productViews->userId = isset(Yii::$app->user->identity->userId) ? Yii::$app->user->identity->userId : NULL;
        $cookies = Yii::$app->request->cookies;
        if (isset($cookies['orderToken'])) {
            $productViews->token = $cookies['orderToken']->value;
        } else {
            $productViews->token = NULL;
        }
        $productViews->updateDateTime = new \yii\db\Expression('NOW()');
        $productViews->createDateTime = new \yii\db\Expression('NOW()');
        $productViews->save(FALSE);

        //throw new \yii\base\Exception(print_r($params, true));

        $ViewsRecentStories = DisplayMyStory::productViewsRecentStories($productPostId);
        $productPost = \common\models\costfit\ProductPost::find()->where("productPostId=" . $productPostId)->one();
        $popularStories = DisplayMyStory::popularStories($productPostId); //ที่มีการให้ดาว
        $popularStoriesNoneStar = DisplayMyStory::popularStoriesNoneStar($productPostId); //ที่ไม่มีการให้ดาว
        $urlSeeAll = $this->createUrl($productPostId, $productSuppId, $productId);
        $sort = '';

        $currency = ArrayHelper::map(Currency::find()->where("status=1")->orderBy('createDateTime')->all(), 'currencyId', 'title');
        $country = ArrayHelper::map(Countries::find()->where("1")->all(), 'countryId', 'countryName');
        $model = new Currency();

        $comparePrice = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::comparePrice($productPostId, isset($_GET['currencyId']) ? $_GET['currencyId'] : NULL, $sort)]);
        $modelComparePrices = new \common\models\costfit\ProductPostComparePrice();
        return $this->render('@app/themes/cozxy/layouts/story/_story', compact(
        'modelComparePrices', 'country', 'productSuppId', 'ViewsRecentStories', 'productPost', 'popularStories', 'urlSeeAll', 'popularStoriesNoneStar', 'currency', 'model', 'comparePrice')
        );
    }

    public function actionWriteYourStory($hash) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $productSuppId = isset($params['productSuppId']) ? $params['productSuppId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;
        // throw new \yii\base\Exception(print_r($params, true));
        $productSupplier = ProductSuppliers::find()->where("productSuppId=" . $productSuppId)->one();
        $productSuppImg = ProductImageSuppliers::find()->where("productSuppId=" . $productSupplier->productSuppId)->one();
        $model = new \common\models\costfit\ProductPost(['scenario' => 'write_your_story']);
        $modelComparePrice = new \common\models\costfit\ProductPostComparePrice(['scenario' => 'write_your_story']);
        $shelf = ArrayHelper::map(ProductShelf::find()->where("userId=" . Yii::$app->user->identity->userId . " and status=1")
        ->orderBy('createDateTime')
        ->all(), 'productShelfId', 'title');
        $currency = ArrayHelper::map(Currency::find()->where("status=1")
        ->orderBy('createDateTime')
        ->all(), 'currencyId', 'title');
        $country = ArrayHelper::map(Countries::find()->where("1")
        ->all(), 'countryId', 'countryName');

        return $this->render('@app/themes/cozxy/layouts/story/_write_your_story', [
            'productSupplier' => $productSupplier,
            'image' => isset($productSuppImg) ? $productSuppImg->image : '',
            'shelf' => $shelf,
            'currency' => $currency,
            'country' => $country,
            'model' => $model, 'modelComparePrice' => $modelComparePrice
        ]);
    }

    public function actionWriteStory() {
        if (isset($_POST['ProductPost'])) {
            $productSuppId = $_POST["productSuppId"];
            $parentId = ProductSuppliers::productParentId($productSuppId)->productId;
            $checkRepeatedlyStory = \common\models\costfit\ProductPost::find()->where('userId=' . Yii::$app->user->identity->userId . ' and productId=' . $parentId)->one(); // ตรวจสอบว่าเคยโพส Story เรื่องนี้ยัง
            if (isset($checkRepeatedlyStory)) {
                return $this->redirect(Yii::$app->homeUrl);
            } else {
                $isPublic = Yii::$app->request->post('isPublic');
                $shelf = new \common\models\costfit\ProductPost();

                $shelf->productId = $parentId;
                // $shelf->productSuppId = $_POST["ProductPost"]["productSuppId"];
                $shelf->productSelfId = 0;
                $shelf->userId = Yii::$app->user->identity->userId;
                $shelf->title = $_POST["ProductPost"]["title"];
                $shelf->description = $_POST["ProductPost"]["description"];

                if ($isPublic == 'on') {
                    $shelf->isPublic = 1;
                } else {
                    $shelf->isPublic = 0;
                }
                $shelf->status = 1;
                $shelf->createDateTime = new \yii\db\Expression('NOW()');
                $shelf->updateDateTime = new \yii\db\Expression('NOW()');
                /* $imageObj = \yii\web\UploadedFile::getInstanceByName("story[image]");
                  if (isset($imageObj) && !empty($imageObj)) {
                  $folderName = "stroy";
                  $file = $imageObj->name;

                  $filenameArray = explode('.', $file);
                  $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                  $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[count($filenameArray) - 1];
                  $urlFile = $urlFolder . $fileName;
                  $shelf->image = 'images/' . $folderName . "/" . $fileName;

                  if (!file_exists($urlFolder)) {
                  mkdir($urlFolder, 0777);
                  }
                  } */
                if ($shelf->save(false)) {
                    /*
                     * เพิ่มข้อมูล Compare Price
                     * modified by Taninut.Bm via Surasuk
                     * แยก Table ProductPostComparePrice จาก ProductPost
                     * Update : 07/05/2017
                     */
                    $comparePrice = new \common\models\costfit\ProductPostComparePrice();
                    $comparePrice->productPostId = Yii::$app->db->lastInsertID;
                    $comparePrice->userId = Yii::$app->user->identity->userId;
                    $comparePrice->productId = $parentId;
                    $comparePrice->shopName = $_POST["ProductPostComparePrice"]["shopName"];
                    $comparePrice->price = $_POST["ProductPostComparePrice"]["price"];
                    $comparePrice->country = $_POST["ProductPostComparePrice"]["country"];
                    $comparePrice->currency = $_POST["ProductPostComparePrice"]["currency"];
                    $comparePrice->latitude = $_POST["ProductPostComparePrice"]["latitude"];
                    $comparePrice->longitude = $_POST["ProductPostComparePrice"]["longitude"];
                    $comparePrice->status = 1;
                    $comparePrice->createDateTime = new \yii\db\Expression('NOW()');
                    $comparePrice->updateDateTime = new \yii\db\Expression('NOW()');
                    if ($comparePrice->save(false)) {

                    }
                    // if (isset($imageObj) && $imageObj->saveAs($urlFile)) {
                    $porductSupplier = ProductSuppliers::find()->where("productSuppId=" . $_POST["productSuppId"])->one();
                    $productSuppId = $porductSupplier->encodeParams(['productId' => $porductSupplier->productId, 'productSupplierId' => $porductSupplier->productSuppId]);
                    return $this->redirect(Yii::$app->homeUrl . 'product/' . $productSuppId);
                    // } else {
                    // }
                }
            }
        }
    }

    public function actionRatingPost() {
        $rate = \common\models\costfit\ProductPostRating::find()->where("productPostId=" . $_POST['postId'] . " and userId=" . $_POST['userId'])
        ->orderBy("productPostRatingId DESC")
        ->one();
        if (isset($rate)) {
            if ($rate->status == 1) {
                $rate->status = 2;
                $rate->updateDateTime = new \yii\db\Expression('NOW()');
                $rate->save(false);
            }
        }
        $rating = new \common\models\costfit\ProductPostRating();

        $res = [];
        $rating->productPostId = $_POST['postId'];
        $rating->userId = $_POST['userId'];
        $rating->score = $_POST['rate'];
        $rating->status = 1;
        $rating->createDateTime = new \yii\db\Expression('NOW()');
        $rating->updateDateTime = new \yii\db\Expression('NOW()');
        if ($rating->save(false)) {
            $res['status'] = true;
        } else {
            $res['status'] = false;
        }
        return json_encode($res);
    }

    public function actionViewPost() {
        $res = [];
        $productPost = \common\models\costfit\ProductPost::find()->where("productPostId=" . $_POST["postId"])->one();
        if ($productPost->userId != Yii::$app->user->identity->userId) {
            $productPostView = new \common\models\costfit\ProductPostView();
            $productPostView->userId = Yii::$app->user->identity->userId;
            $productPostView->productPostId = $_POST["postId"];
            $productPostView->createDateTime = new \yii\db\Expression('NOW()');
            $productPostView->updateDateTime = new \yii\db\Expression('NOW()');
            $flag = false;
            if ($productPostView->save(false)) {
                $res['status'] = true;
            } else {
                $res['status'] = false;
            }
        } else {
            $res['status'] = false;
        }
        return json_encode($res);
    }

    public function checkViewTime($postId) {
        $flag = false;
        $lastView = \common\models\costfit\ProductPost::find()->where("productPostId=" . $postId . " and userId=" . Yii::$app->user->identity->userId)
        ->orderBy('createDateTime DESC')
        ->one();

        if (isset($lastView)) {
            $now = date('Y-m-d H:i:s');
            $time_diff = strtotime($now) - strtotime($time);
            $time_diff_m = floor(($time_diff % 3600) / 60);
            if ($time_diff_m > 5) {
                return false;
            } else {
                return true;
            }
        } else {
            $flag = false;
        }
    }

    public function actionShopDetail() {
        return $this->render('@app/themes/cozxy/layouts/story/_shop_detail');
    }

    public function actionComparePrice() {
        //return $this->render('@app/themes/cozxy/layouts/story/_shop_detail');
        $productId = $_POST["productId"];
        $currencyId = $_POST["currencyId"];
        // throw new \yii\base\Exception($currencyId);
        $res = [];
        $productPost = \common\models\costfit\ProductPost::find()->where("productId=" . $productId . " and currency=" . $currencyId);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $productPost
        ]);
        $res["dataProvider"] = $dataProvider;
        return json_encode($res);
    }

    public function actionSeeMore($hash = FALSE) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $productSuppId = isset($params['productSupplierId']) ? $params['productSupplierId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $seeMore = new \yii\data\ArrayDataProvider(['allModels' => \frontend\models\FakeFactory::productStoryAll($n = false, $productId, $productSuppId)]);
        $otherProducts = new ArrayDataProvider(['allModels' => \frontend\models\FakeFactory::productOtherProducts()]);
        return $this->render('index', compact('seeMore', 'otherProducts'));
    }

    public function createUrl($productPostId, $productSuppId, $productId) {
        $value = new \common\models\costfit\ProductPost();
        return Yii::$app->homeUrl . 'story/see-more/' . $value->encodeParams(['productPostId' => $productPostId, 'productId' => $productId, 'productSupplierId' => $productSuppId]);
    }

    public function actionUpdateStories($hash) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $productSuppId = isset($params['productSuppId']) ? $params['productSuppId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;
        // throw new \yii\base\Exception(print_r($params, true));

        if (isset($_POST["ProductPost"])) {
            $isPublic = Yii::$app->request->post('isPublic');
            $model = \common\models\costfit\ProductPost::find()->where('productPostId=' . $productPostId)->one();
            $model->attributes = $_POST['ProductPost'];
            //$productSuppId = $_POST["productSuppId"];
            //$parentId = ProductSuppliers::productParentId($productSuppId)->productId;
            $model->productId = $productId;
            // $shelf->productSuppId = $_POST["ProductPost"]["productSuppId"];
            $model->productSelfId = 0;
            $model->userId = Yii::$app->user->identity->userId;
            $model->title = $_POST["ProductPost"]["title"];
            $model->description = $_POST["ProductPost"]["description"];
            $model->shopName = $_POST["ProductPost"]["shopName"];
            $model->price = $_POST["ProductPost"]["price"];
            $model->country = $_POST["ProductPost"]["country"];
            $model->currency = $_POST["ProductPost"]["currency"];
            if ($isPublic == 'on') {
                $model->isPublic = 1;
            } else {
                $model->isPublic = 0;
            }
            $model->status = 1;
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            /* $imageObj = \yii\web\UploadedFile::getInstanceByName("story[image]");
              if (isset($imageObj) && !empty($imageObj)) {
              $folderName = "stroy";
              $file = $imageObj->name;

              $filenameArray = explode('.', $file);
              $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
              $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[count($filenameArray) - 1];
              $urlFile = $urlFolder . $fileName;
              $shelf->image = 'images/' . $folderName . "/" . $fileName;

              if (!file_exists($urlFolder)) {
              mkdir($urlFolder, 0777);
              }
              } */
            if ($model->save(false)) {
                // if (isset($imageObj) && $imageObj->saveAs($urlFile)) {
                //$porductSupplier = ProductSuppliers::find()->where("productSuppId=" . $productSuppId)->one();
                $productSuppId = $model->encodeParams(['productId' => $productId, 'productSupplierId' => $productSuppId]);
                return $this->redirect([Yii::$app->homeUrl . 'product/' . $productSuppId]);
                // } else {
                // }
            }
        } else {
            $productSupplier = ProductSuppliers::find()->where("productSuppId=" . $productSuppId)->one();
            //$productSuppImg = ProductImageSuppliers::find()->where("productSuppId=" . $productSupplier->productSuppId)->one();
            $productSuppImg = \common\helpers\DataImageSystems::DataImageMaster($productSupplier->productId, $productSupplier->productSuppId, 'Svg555x340');
            $model = \common\models\costfit\ProductPost::find()->where('productPostId=' . $productPostId)->one();
            $model->scenario = 'write_your_story';
            $shelf = ArrayHelper::map(ProductShelf::find()->where("userId=" . Yii::$app->user->identity->userId . " and status=1")
            ->orderBy('createDateTime')
            ->all(), 'productShelfId', 'title');
            $currency = ArrayHelper::map(Currency::find()->where("status=1")
            ->orderBy('createDateTime')
            ->all(), 'currencyId', 'title');
            $country = ArrayHelper::map(Countries::find()->where("1")
            ->all(), 'countryId', 'countryName');

            return $this->render('@app/themes/cozxy/layouts/story/_write_your_story', [
                'productSupplier' => $productSupplier,
                'image' => $productSuppImg,
                'shelf' => $shelf,
                'currency' => $currency,
                'country' => $country,
                'model' => $model
            ]);
        }
    }

    public function actionSortCompareStories() {
        $currencyId = Yii::$app->request->post('currency');
        $status = Yii::$app->request->post('status');
        $postId = Yii::$app->request->post('postId');
        $sort = Yii::$app->request->post('sort');
        $productId = Yii::$app->request->post('productId');
        $modelComparePrices = new \common\models\costfit\ProductPostComparePrice();
        $productPost = \common\models\costfit\ProductPostComparePrice::find()->where("productPostId=" . $postId . ' and productId=' . $productId)->one();
        $currency = ArrayHelper::map(Currency::find()->where("status=1")->orderBy('createDateTime')->all(), 'currencyId', 'title');
        $country = ArrayHelper::map(Countries::find()->where("1")->all(), 'countryId', 'countryName');
        if ($currencyId != '') {
            //$comparePrice = DisplayMyStory::comparePrice($productPost->productId, $_GET['currencyId']);
            $comparePrice = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::comparePrice($postId, $currencyId, $sort)]);
        } else {
            // $comparePrice = DisplayMyStory::comparePrice($productPost->productId, null);
            $comparePrice = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::comparePrice($postId, null, $sort)]);
        }
        if ($sort === 'SORT_DESC') {
            $sort = 'SORT_ASC';
            $icon = 'down';
        } elseif ($sort === 'SORT_ASC') {
            $sort = 'SORT_DESC';
            $icon = 'up';
        } else {
            //$sort = '';
            //$icon = '';
            $sort = 'SORT_ASC';
            $icon = 'down';
        }
        return $this->renderAjax('@app/themes/cozxy/layouts/story/compare_price', ['modelComparePrices' => $modelComparePrices, 'country' => $country, 'sort' => $sort, 'icon' => $icon, 'productPostId' => $postId, 'currency' => $currency, 'comparePrice' => $comparePrice, 'productPost' => $productPost, 'currencyId' => $currencyId]);
    }

    public function actionComparePriceStoryModified() {
        $postId = Yii::$app->request->post('postId');
        $comparePrice = \common\models\costfit\ProductPostComparePrice::find()->where('comparePriceId =' . $postId)->one();

        if (isset($comparePrice)) {
            return json_encode($comparePrice->attributes);
        } else {
            return FALSE;
        }
    }

    public function actionComparePriceStory() {
        $productPostId = Yii::$app->request->post('productPostId');
        $shopName = Yii::$app->request->post('shopName');
        $price = Yii::$app->request->post('price');
        $country = Yii::$app->request->post('country');
        $currency = Yii::$app->request->post('currency');
        $statusPrice = Yii::$app->request->post('statusPrice');
        $productId = Yii::$app->request->post('productId');
        $comparePriceId = Yii::$app->request->post('comparePriceId');

        $latitude = Yii::$app->request->post('latitude');
        $longitude = Yii::$app->request->post('longitude');

        $parentId = $productId; //ProductSuppliers::productParentId($productSuppId)->productId;
        if ($statusPrice == 'edit') {
            $update = \common\models\costfit\ProductPostComparePrice::updateAll(
            [ 'shopName' => $shopName, 'shopName' => $shopName, 'price' => $price,
                'country' => $country, 'currency' => $currency, 'latitude' => $latitude, 'longitude' => $longitude], ['userId' => Yii::$app->user->identity->userId,
                'productPostId' => $productPostId,
                'comparePriceId' => $comparePriceId]
            );
        } else if ($statusPrice == 'add') {
            /*
             * เพิ่มข้อมูล Story : Product Post Compare Price
             */
            $storyComparePrice = new \common\models\costfit\ProductPostComparePrice();
            $storyComparePrice->userId = Yii::$app->user->identity->userId;
            $storyComparePrice->productId = $parentId;
            $storyComparePrice->productPostId = $productPostId;
            $storyComparePrice->shopName = $shopName;
            $storyComparePrice->price = $price;
            $storyComparePrice->country = $country;
            $storyComparePrice->currency = $currency;
            $storyComparePrice->latitude = $latitude;
            $storyComparePrice->longitude = $longitude;
            $storyComparePrice->status = 1;
            $storyComparePrice->createDateTime = new \yii\db\Expression('NOW()');
            $storyComparePrice->updateDateTime = new \yii\db\Expression('NOW()');
            if ($storyComparePrice->save(false)) {
                $comparePriceId = Yii::$app->db->lastInsertID;
            }
        }

        $comparePrice = \common\models\costfit\ProductPostComparePrice::find()->where("comparePriceId=" . $comparePriceId)->one();
        $products = [];

        $products['comparePriceChange'] = [
            'comparePriceId' => $comparePrice['comparePriceId'],
            'userId' => $comparePrice['userId'],
            'productPostId' => $comparePrice['productPostId'],
            'country' => $comparePrice['country'],
            'shopName' => $comparePrice['shopName'],
            'price' => number_format($comparePrice['price'], 2),
            'LocalPrice' => "THB " . number_format(\common\models\costfit\Currency::ToThb($comparePrice['currency'], $price), 2)
        ];

        return json_encode($products['comparePriceChange']);
    }

}
