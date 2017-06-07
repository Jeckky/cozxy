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
        $productSuppId = isset($params['productSuppId']) ? $params['productSuppId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;
        $ViewsRecentStories = DisplayMyStory::productViewsRecentStories($productPostId);
        $productPost = \common\models\costfit\ProductPost::find()->where("productPostId=" . $productPostId)->one();
        $popularStories = DisplayMyStory::popularStories($productPostId); //ที่มีการให้ดาว
        $popularStoriesNoneStar = DisplayMyStory::popularStoriesNoneStar($productPostId); //ที่ไม่มีการให้ดาว
        $urlSeeAll = $this->createUrl($productPostId, $productSuppId, $productId);
        $currency = ArrayHelper::map(Currency::find()->where("status=1")
                                ->orderBy('createDateTime')
                                ->all(), 'currencyId', 'title');
        $model = new Currency();
        if (isset($_GET['currencyId'])) {
            $comparePrice = DisplayMyStory::comparePrice($productPost->productId, $_GET['currencyId']);
        } else {
            $comparePrice = DisplayMyStory::comparePrice($productPost->productId, null);
        }

        return $this->render('@app/themes/cozxy/layouts/story/_story', compact('ViewsRecentStories', 'productPost', 'popularStories', 'urlSeeAll', 'popularStoriesNoneStar', 'currency', 'model', 'comparePrice'));
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
        $model = new \common\models\costfit\ProductPost();
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
        if (isset($_POST['shopName'])) {
            $shelf = new \common\models\costfit\ProductPost();

            $productSuppId = $_POST["productSuppId"];
            $parentId = ProductSuppliers::productParentId($productSuppId)->productId;
            $shelf->productId = $parentId;
            $shelf->productSelfId = $_POST["shelf"];
            $shelf->userId = Yii::$app->user->identity->userId;
            $shelf->title = $_POST["title"];
            $shelf->description = $_POST["ProductPost"]["description"];
            $shelf->shopName = $_POST["shopName"];
            $shelf->price = $_POST["price"];
            $shelf->country = $_POST["country"];
            $shelf->currency = $_POST["currency"];
            // $shelf->image = $_POST["image"];
            if ($_POST["isPublic"] == 'on') {
                $shelf->isPublic = 1;
            } else {
                $shelf->isPublic = 0;
            }
            $shelf->status = 1;
            $shelf->createDateTime = new \yii\db\Expression('NOW()');
            $shelf->updateDateTime = new \yii\db\Expression('NOW()');
            $imageObj = \yii\web\UploadedFile::getInstanceByName("story[image]");
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
            }
            if ($shelf->save(false)) {
                if (isset($imageObj) && $imageObj->saveAs($urlFile)) {
                    $porductSupplier = ProductSuppliers::find()->where("productSuppId=" . $_POST["productSuppId"])->one();
                    $productSuppId = $porductSupplier->encodeParams(['productId' => $porductSupplier->productId, 'productSupplierId' => $porductSupplier->productSuppId]);
                    return $this->redirect([Yii::$app->homeUrl . 'product/' . $productSuppId]);
                } else {

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
        $seeMore = new \yii\data\ArrayDataProvider(['allModels' => \frontend\models\FakeFactory::productStoryAll($n = false, $productId)]);
        $otherProducts = new ArrayDataProvider(['allModels' => \frontend\models\FakeFactory::productOtherProducts()]);
        return $this->render('index', compact('seeMore', 'otherProducts'));
    }

    public function createUrl($productPostId, $productSuppId, $productId) {
        $value = new \common\models\costfit\ProductPost();
        return Yii::$app->homeUrl . 'story/see-more/' . $value->encodeParams(['productPostId' => $productPostId, 'productId' => $productId, 'productSupplierId' => $productSuppId]);
    }

}
