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

        //throw new \yii\base\Exception(print_r($params, true));
        $productSuppId = isset($params['productSupplierId']) ? $params['productSupplierId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;
        $ViewsRecentStories = DisplayMyStory::productViewsRecentStories($productPostId);
        $productPost = \common\models\costfit\ProductPost::find()->where("productPostId=" . $productPostId)->one();
        $popularStories = DisplayMyStory::popularStories($productPostId); //ที่มีการให้ดาว
        $popularStoriesNoneStar = DisplayMyStory::popularStoriesNoneStar($productPostId); //ที่ไม่มีการให้ดาว
        $urlSeeAll = $this->createUrl($productPostId, $productSuppId, $productId);
        $sort = '';

        $currency = ArrayHelper::map(Currency::find()->where("status=1")->orderBy('createDateTime')->all(), 'currencyId', 'title');
        $model = new Currency();
        if (isset($_GET['currencyId'])) {
            //$comparePrice = DisplayMyStory::comparePrice($productPost->productId, $_GET['currencyId']);
            $comparePrice = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::comparePrice($productPost->productId, $_GET['currencyId'], $sort)]);
        } else {
            // $comparePrice = DisplayMyStory::comparePrice($productPost->productId, null);
            $comparePrice = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::comparePrice($productPost->productId, null, $sort)]);
        }

        //echo '<pre>';
        //print_r($comparePrice);

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

        return $this->render('@app/themes/cozxy/layouts/story/_story', compact('productSuppId', 'ViewsRecentStories', 'productPost', 'popularStories', 'urlSeeAll', 'popularStoriesNoneStar', 'currency', 'model', 'comparePrice'));
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
            'model' => $model
        ]);
    }

    public function actionWriteStory() {
        if (isset($_POST['ProductPost'])) {
            $isPublic = Yii::$app->request->post('isPublic');
            $shelf = new \common\models\costfit\ProductPost();

            $productSuppId = $_POST["productSuppId"];
            $parentId = ProductSuppliers::productParentId($productSuppId)->productId;
            $shelf->productId = $parentId;
            // $shelf->productSuppId = $_POST["ProductPost"]["productSuppId"];
            $shelf->productSelfId = 0;
            $shelf->userId = Yii::$app->user->identity->userId;
            $shelf->title = $_POST["ProductPost"]["title"];
            $shelf->description = $_POST["ProductPost"]["description"];
            $shelf->shopName = $_POST["ProductPost"]["shopName"];
            $shelf->price = $_POST["ProductPost"]["price"];
            $shelf->country = $_POST["ProductPost"]["country"];
            $shelf->currency = $_POST["ProductPost"]["currency"];
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
                // if (isset($imageObj) && $imageObj->saveAs($urlFile)) {
                $porductSupplier = ProductSuppliers::find()->where("productSuppId=" . $_POST["productSuppId"])->one();
                $productSuppId = $porductSupplier->encodeParams(['productId' => $porductSupplier->productId, 'productSupplierId' => $porductSupplier->productSuppId]);
                return $this->redirect([Yii::$app->homeUrl . 'product/' . $productSuppId]);
                // } else {
                // }
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
            $model->createDateTime = new \yii\db\Expression('NOW()');
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

        $productPost = \common\models\costfit\ProductPost::find()->where("productPostId=" . $postId)->one();
        $currency = ArrayHelper::map(Currency::find()->where("status=1")->orderBy('createDateTime')->all(), 'currencyId', 'title');

        if ($currencyId != '') {
            //$comparePrice = DisplayMyStory::comparePrice($productPost->productId, $_GET['currencyId']);
            $comparePrice = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::comparePrice($productId, $currencyId, $sort)]);
        } else {
            // $comparePrice = DisplayMyStory::comparePrice($productPost->productId, null);
            $comparePrice = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::comparePrice($productId, null, $sort)]);
        }
        if ($sort === 'SORT_DESC') {
            $sort = 'SORT_ASC';
            $icon = 'down';
        } elseif ($sort === 'SORT_ASC') {
            $sort = 'SORT_DESC';
            $icon = 'up';
        } else {
            $sort = '';
            $icon = '';
        }
        return $this->renderAjax('@app/themes/cozxy/layouts/story/compare_price', ['sort' => $sort, 'icon' => $icon, 'productPostId' => $postId, 'currency' => $currency, 'comparePrice' => $comparePrice, 'productPost' => $productPost, 'currencyId' => $currencyId]);
    }

}
