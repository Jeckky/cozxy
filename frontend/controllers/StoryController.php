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
use common\models\costfit\FavoriteStory;
use common\models\costfit\ProductPost;

class StoryController extends MasterController {

    public function actionIndex($hash = FALSE) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);


        $productSuppId = isset($params['productSupplierId']) ? $params['productSupplierId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;
        /* $productPost = ProductPost::find()->where("productPostId=" . $params['productPostId'])->one();
          $productPost->totalView = count(\common\models\costfit\ProductPostView::find()->where("productPostId=" . $params['productPostId'])->all());
          $productPost->save(FALSE); *///test save totalView
        /*
         * Product Post View : Count Story
         */
        $canCountView = 0;
        if (isset($productPostId)) {
            $token = \common\helpers\Token::getViewToken();
            $canCountView = $this->countView($productPostId, $token);
            if ($canCountView == 1) {
                $productViews = new \common\models\costfit\ProductPostView(); //รอเชค user Id และเวลา
                $productViews->productPostId = $productPostId;
                $productViews->userId = isset(Yii::$app->user->identity->userId) ? Yii::$app->user->identity->userId : NULL;
                /* $cookies = Yii::$app->request->cookies;
                  if (isset($cookies['viewToken'])) {
                  $productViews->token = $cookies['viewToken']->value;
                  } else {
                  $productViews->token = NULL;
                  } */
                $productViews->token = $token;
                $productViews->updateDateTime = new \yii\db\Expression('NOW()');
                $productViews->createDateTime = new \yii\db\Expression('NOW()');
                $productViews->save(FALSE);
                $productPost = ProductPost::find()->where("productPostId=" . $params['productPostId'])->one();
                $productPost->totalScore += ProductPost::VIEW_SCORE;
                $productPost->totalView = count(\common\models\costfit\ProductPostView::find()->where("productPostId=" . $params['productPostId'])->all());
                $productPost->save(FALSE);
            }
        }
        //throw new \yii\base\Exception(print_r($params, true));
        $imgShowStory = '';
        $ViewsRecentStories = DisplayMyStory::productViewsRecentStories($productPostId);
        $productPost = \common\models\costfit\ProductPost::find()->where("product_post.productPostId=" . $productPostId . ' ')->one();
        $productSuppliers = \common\models\costfit\ProductSuppliers::find()->where('productId=' . $productPost->productId)->one();
        if (isset($productSuppliers)) {
            $productSuppId = $productSuppliers->productSuppId;
            $product_image = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSuppId)
                            ->orderBy('ordering asc')->one();
            if (isset($product_image)) {
                $imgShowStory = $product_image->image;
            }
        }

        // $product_image_suppliers = $productPost->attributes;
        //if (isset($product_image_suppliers['productId'])) {
        if (isset($productId)) {
            $product_image = \common\models\costfit\ProductImage::find()
                            ->where('productId=' . $productPost->productId)
                            ->orderBy('ordering asc')->one();

            if (isset($product_image)) {
                $imgShowStory = $product_image->image;
            }
        }
        //}
        // }
        //echo '<pre>';
        //print_r($product_image->attributes);
        $popularStories = DisplayMyStory::popularStories($productPostId); //ที่มีการให้ดาว
        $popularStoriesNoneStar = DisplayMyStory::popularStoriesNoneStar($productPostId); //ที่ไม่มีการให้ดาว
        $urlSeeAll = $this->createUrl($productPostId, $productSuppId, $productPost->productId);
        $sort = '';

        //$currency = ArrayHelper::map(Currency::find()->where("status=1 ")->orderBy('createDateTime')->all(), 'currencyId', 'title');
        $currency = new ArrayDataProvider(['allModels' => DisplayMyStory::CurrencyInfos()]);

        // $currency = \common\models\costfit\CurrencyInfo::find()->all();
        $country = ArrayHelper::map(Countries::find()->where("1")->all(), 'countryId', 'countryName');
        $model = new Currency();

        $comparePrice = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::comparePrice($productPostId, isset($_GET['currencyId']) ? $_GET['currencyId'] : NULL, $sort)]);
        $modelComparePrices = new \common\models\costfit\ProductPostComparePrice();
        $avatar = \common\models\costfit\User::getAvatar($productPost->userId);

        return $this->render('@app/themes/cozxy/layouts/story/_story', compact('imgShowStory', 'avatar', 'modelComparePrices', 'country', 'productSuppId', 'ViewsRecentStories', 'productPost', 'popularStories', 'urlSeeAll', 'popularStoriesNoneStar', 'currency', 'model', 'comparePrice')
        );
    }

    public function actionWriteYourStory($hash) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $productSuppId = isset($params['productSuppId']) ? $params['productSuppId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;
        // throw new \yii\base\Exception(print_r($params, true));

        $product = ProductSuppliers::find()->where("productId=" . $productId)->one();
        $productSuppImg = \common\models\costfit\ProductImage::find()->where("productId=" . $product->productId)->one();
        $model = new \common\models\costfit\ProductPost(['scenario' => 'write_your_story']);
        $modelComparePrice = new \common\models\costfit\ProductPostComparePrice(['scenario' => 'write_your_story']);
        $shelf = ArrayHelper::map(ProductShelf::find()->where("userId=" . Yii::$app->user->identity->userId . " and status=1")
                                ->orderBy('createDateTime')
                                ->all(), 'productShelfId', 'title');
        /* $currency = ArrayHelper::map(Currency::find()->where("status=1")
          ->orderBy('createDateTime')
          ->all(), 'currencyId', 'title');
         */
        $currency = new ArrayDataProvider(['allModels' => DisplayMyStory::CurrencyInfos()]);

        $country = ArrayHelper::map(Countries::find()->where("1")
                                ->all(), 'countryId', 'countryName');

        return $this->render('@app/themes/cozxy/layouts/story/_write_your_story', [
                    'product' => $product,
                    'image' => isset($productSuppImg) ? $productSuppImg->image : '',
                    'shelf' => $shelf,
                    'currency' => $currency,
                    'country' => $country,
                    'model' => $model, 'modelComparePrice' => $modelComparePrice
        ]);
    }

    public function actionWriteStory() {
        if (isset($_POST['ProductPost'])) {
            $comparePrice = new \common\models\costfit\ProductPostComparePrice();
            /* $comparePrice->attributes = $_POST["ProductPostComparePrice"];
              echo '<pre>';
              print_r($comparePrice);
              exit();
              //$model->addError("password", 'Confirm password not match');
              echo 'latitude :' . $_POST["ProductPostComparePrice"]["latitude"];
              echo 'longitude :' . $_POST["ProductPostComparePrice"]["longitude"];
              if ($_POST["ProductPostComparePrice"]["latitude"] != '' && $_POST["ProductPostComparePrice"]["longitude"] == '') {
              echo 'test';
              $comparePrice->addError("longitude", 'Please fill in your location longitude.');
              }
              var_dump($comparePrice->getErrors());
              exit(); */
            $productSuppId = $_POST["productSuppId"];
            $parentId = ProductSuppliers::productParentId($productSuppId)->productId;
            $checkRepeatedlyStory = \common\models\costfit\ProductPost::find()->where('userId=' . Yii::$app->user->identity->userId . ' and productId=' . $parentId . ' and product_post.status =1')->one(); // ตรวจสอบว่าเคยโพส Story เรื่องนี้ยัง
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
                $shelf->shortDescription = $_POST["ProductPost"]["shortDescription"];
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
                    if ($_POST["ProductPostComparePrice"]["shopName"] != '' && $_POST["ProductPostComparePrice"]["price"] != '' && $_POST["ProductPostComparePrice"]["currency"] != '') {
                        $comparePrice->productPostId = Yii::$app->db->lastInsertID;
                        $comparePrice->userId = Yii::$app->user->identity->userId;
                        $comparePrice->productId = $parentId;
                        $comparePrice->shopName = $_POST["ProductPostComparePrice"]["shopName"];
                        $comparePrice->price = $_POST["ProductPostComparePrice"]["price"];
                        //$comparePrice->country = $_POST["ProductPostComparePrice"]["country"]; //ProductPostComparePrice[currency]
                        $comparePrice->currency = $_POST["ProductPostComparePrice"]["currency"];
                        $comparePrice->latitude = $_POST["ProductPostComparePrice"]["latitude"];
                        $comparePrice->longitude = $_POST["ProductPostComparePrice"]["longitude"];
                        $comparePrice->status = 1;
                        $comparePrice->createDateTime = new \yii\db\Expression('NOW()');
                        $comparePrice->updateDateTime = new \yii\db\Expression('NOW()');
                        if ($comparePrice->save(false)) {

                        }
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

    public function actionGenerateTotalScore() {
        $productPost = ProductPost::find()->where("status!=3")->all();
        foreach ($productPost as $post):
            $totalView = 0;
            $totalStar = 0;
            $view = \common\models\costfit\ProductPostView::find()->where("productPostId=" . $post->productPostId)->all();
            if (isset($view)) {
                $totalView = count($view);
            }
            $stars = \common\models\costfit\ProductPostRating::find()->where("productPostId=" . $post->productPostId . " and status=1")->all();
            if (isset($stars) && count($stars) > 0) {
                foreach ($stars as $star):
                    $totalStar += ($star->score * ProductPost::STAR_SCORE);
                endforeach;
            }
            $post->totalScore = $totalView + $totalStar;
            $post->save(FALSE);
        endforeach;
    }

    public function actionRatingPost() {
        $rate = \common\models\costfit\ProductPostRating::find()->where("productPostId=" . $_POST['postId'] . " and userId=" . $_POST['userId'])
                ->orderBy("productPostRatingId DESC")
                ->one();
        if (isset($rate)) {
            if ($rate->status == 1) {
                $rate->status = 2;
                $score = $rate->score * ProductPost::STAR_SCORE;
                $rate->updateDateTime = new \yii\db\Expression('NOW()');
                $rate->save(false);
                $productPost = ProductPost::find()->where("productPostId=" . $rate->productPostId)->one();
                if (isset($productPost)) {
                    $productPost->totalScore = $productPost->totalScore - $score;
                    $productPost->save(false);
                }
            }
        }
        $rating = new \common\models\costfit\ProductPostRating();

        $res = [];
        $rating->productPostId = $_POST['postId'];
        $rating->userId = $_POST['userId'];
        $rating->score = $_POST['rate'];
        $score = $_POST['rate'] * ProductPost::STAR_SCORE;
        $rating->status = 1;
        $rating->createDateTime = new \yii\db\Expression('NOW()');
        $rating->updateDateTime = new \yii\db\Expression('NOW()');
        if ($rating->save(false)) {
            $productPost = ProductPost::find()->where("productPostId=" . $rate->productPostId)->one();
            if (isset($productPost)) {
                $productPost->totalScore = $productPost->totalScore + $score;
                $averageStar = DisplayMyStory::calculatePostRating($rate->productPostId);
                $avgStar = explode(',', $averageStar);
                $productPost->averageStar = $avgStar[0];
                $productPost->save(false);
            }
            $res['status'] = true;
        } else {
            $res['status'] = false;
        }
        return json_encode($res);
    }

    public function actionViewPost() {
        $res = [];
        $productPost = \common\models\costfit\ProductPost::find()->where("productPostId=" . $_POST["postId"] . ' and product_post.status =1')->one();
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
        $lastView = \common\models\costfit\ProductPost::find()->where("productPostId=" . $postId . " and userId=" . Yii::$app->user->identity->userId . ' and product_post.status =1')
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
        $productPost = \common\models\costfit\ProductPost::find()->where("productId=" . $productId . " and currency=" . $currencyId . ' and product_post.status =1');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $productPost
        ]);
        $res["dataProvider"] = $dataProvider;
        return json_encode($res);
    }

    public function actionSeeMore($hash = FALSE) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        //echo '<pre>';
        //print_r($params);
        $productSuppId = isset($params['productSupplierId']) ? $params['productSupplierId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;
        $seeMore = new \yii\data\ArrayDataProvider(['allModels' => \frontend\models\FakeFactory::productStoryAll($n = false, $productId, $productSuppId, $productPostId)]);
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
            $model = \common\models\costfit\ProductPost::find()->where('productPostId=' . $productPostId . ' and product_post.status =1')->one();
            $model->attributes = $_POST['ProductPost'];
            //$productSuppId = $_POST["productSuppId"];
            //$parentId = ProductSuppliers::productParentId($productSuppId)->productId;
            $model->productId = $productId;
            // $shelf->productSuppId = $_POST["ProductPost"]["productSuppId"];
            $model->productSelfId = 0;
            $model->userId = Yii::$app->user->identity->userId;
            $model->title = $_POST["ProductPost"]["title"];
            $model->description = $_POST["ProductPost"]["description"];
            $model->shortDescription = $_POST["ProductPost"]["shortDescription"];
            //$model->shopName = $_POST["ProductPost"]["shopName"];
            //$model->price = $_POST["ProductPost"]["price"];
            //$model->country = $_POST["ProductPost"]["country"];
            //$model->currency = $_POST["ProductPost"]["currency"];
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
                $productSuppId = $model->encodeParams(['productPostId' => $productPostId, 'productId' => $productId, 'productSupplierId' => $productSuppId]);
                // return $this->redirect([Yii::$app->homeUrl . 'product/' . $productSuppId]);
                return $this->redirect(Yii::$app->homeUrl . 'story/' . $productSuppId);
                //Yii::$app->homeUrl . 'story/' . $value->encodeParams(['productPostId' => $value->productPostId, 'productId' => $items->productId, 'productSupplierId' => $items['productSuppId']])
                // } else {
                // }
            }
        } else {
            $productSupplier = ProductSuppliers::find()->where("productSuppId=" . $productSuppId)->one();
            //$productSuppImg = ProductImageSuppliers::find()->where("productSuppId=" . $productSupplier->productSuppId)->one();
            //$productSuppImg = \common\helpers\DataImageSystems::DataImageMaster($productSupplier->productId, $productSupplier->productSuppId, 'Svg555x340');
            $product = Product::find()->where("productId=" . $productSupplier->productId)->one();
            if (isset($productId)) {
                $product_image = \common\models\costfit\ProductImage::find()->where('productId=' . $productPostId)
                                ->orderBy('ordering asc')->limit(1)->one();

                if (isset($product_image)) {
                    $imgShowStory = $product_image->image;
                } else {
                    $product_image = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $productSuppId)
                                    ->orderBy('ordering asc')->limit(1)->one();
                    if (isset($product_image)) {
                        $imgShowStory = $product_image->image;
                    }
                }
            }

            $model = \common\models\costfit\ProductPost::find()->where('productPostId=' . $productPostId . ' and product_post.status =1')->one();
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
                        'image' => $imgShowStory,
                        'shelf' => $shelf,
                        'currency' => $currency,
                        'country' => $country,
                        'model' => $model,
                        'product' => $product
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

        return $this->renderAjax('@app/themes/cozxy/layouts/story/compare_price', ['modelComparePrices' => $modelComparePrices,
                    'country' => $country, 'sort' => $sort,
                    'icon' => $icon, 'productPostId' => $postId,
                    'currency' => $currency, 'comparePrice' => $comparePrice,
                    'productPost' => $productPost, 'currencyId' => $currencyId]);
    }

    public function actionComparePriceStoryModified() {
        $postId = Yii::$app->request->post('postId');
        $comparePrice = \common\models\costfit\ProductPostComparePrice::find()->where('comparePriceId =' . $postId)->one();
        /* $comparePrice = \common\models\costfit\ProductPostComparePrice::find()
          ->select('`product_post_compare_price`.* ,`currency_info`.currency_code,`currency_info`.ccy_name')
          ->join("LEFT JOIN", "currency_info", "currency_info.currencyId = product_post_compare_price.currency")
          ->where('product_post_compare_price.comparePriceId =' . $postId . ' and currency_info.status=2')->asArray()->one();
          echo '<pre>';
          print_r($comparePrice); */
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
                            ['shopName' => $shopName, 'shopName' => $shopName, 'price' => $price,
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

        //$comparePrice = \common\models\costfit\ProductPostComparePrice::find()->where("comparePriceId=" . $comparePriceId)->one();
        $comparePrice = \common\models\costfit\ProductPostComparePrice::find()
                        ->select('`product_post_compare_price`.* ,`currency_info`.currency_code,`currency_info`.ccy_name')
                        ->join("LEFT JOIN", "currency_info", "currency_info.currencyId = product_post_compare_price.currency")
                        ->where('product_post_compare_price.comparePriceId =' . $comparePriceId . ' and currency_info.status=2')->asArray()->one();
        $products = [];

        $products['comparePriceChange'] = [
            'comparePriceId' => $comparePrice['comparePriceId'],
            'userId' => $comparePrice['userId'],
            'productPostId' => $comparePrice['productPostId'],
            'currency_code' => $comparePrice['currency_code'],
            'country' => $comparePrice['ccy_name'],
            'shopName' => $comparePrice['shopName'],
            'price' => $comparePrice['price'],
            'LocalPrice' => "THB " . number_format(\common\models\costfit\Currency::ToThb($comparePrice['currency'], $price), 2)
        ];

        return json_encode($products['comparePriceChange']);
    }

    public function actionViewsAll($hash = FALSE) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $categoryId = $params['categoryId'];

//$contentStory = new \yii\data\ArrayDataProvider(['allModels' => \frontend\models\FakeFactory::productStory(99)]);
//        $productStory = new ArrayDataProvider(['allModels' => \frontend\models\FakeFactory::productStoryViewsMore(99, $categoryId), 'pagination' => ['defaultPageSize' => 8]]);
        $productStory = ProductPost::productStory();
        return $this->render('contentstory', compact('productStory'));
    }

    public function actionAddToFavorite() {
        $res = [];
        $text = '';
        $productPostId = $_POST['productPostId'];
        $favorites = FavoriteStory::find()->where("productPostId=" . $productPostId . " and userId=" . Yii::$app->user->id . " and status=1")->all();
        if (isset($favorites) && count($favorites) > 0) {
            $res['status'] = false;
            $res['error'] = 'This story is already in you favorite stories.';
        } else {
            $post = \common\models\costfit\ProductPost::find()->where("productPostId=" . $productPostId)->one();
            $favorite = new FavoriteStory();
            $favorite->productPostId = $productPostId;
            $favorite->userId = Yii::$app->user->id;
            $favorite->status = 1;
            $favorite->productId = $post->productId;
            $favorite->createDateTime = new \yii\db\Expression('NOW()');
            $favorite->updateDateTime = new \yii\db\Expression('NOW()');
            $favorite->save(false);
            $res['status'] = true;
        }
        return json_encode($res);
    }

    public function actionUnFavorite() {
        $res = [];
        $text = '';
        $productPostId = $_POST['productPostId'];
        $favorite = FavoriteStory::find()->where("productPostId=" . $productPostId . " and userId=" . Yii::$app->user->id . " and status=1")->one();
        if (isset($favorite)) {
            $favorite->delete();
            $count = count(FavoriteStory::find()->where("productPostId=" . $productPostId . " and userId=" . Yii::$app->user->id . " and status=1")->all());
            if ($count == 0) {
                $res['total'] = TRUE;
                $res['text'] = "<h4>No story in fav item <span style='margin-left:20px;font-size:12pt;'><a href='' data-toggle='modal' data-target='#FavoriteModal'><u>What's this? </u></a></span></h4>";
            } else {
                $res['total'] = FALSE;
            }
            $res['status'] = true;
        } else {
            $res['status'] = false;
        }
        return json_encode($res);
    }

    public function actionStoriesRemove() {
        $id = Yii::$app->request->post('id');
        $RemoveHidden = \common\models\costfit\ProductPost::updateAll(['status' => 0], ['userId' => Yii::$app->user->id, 'productPostId' => $id]);
        //echo '<pre>';
        //print_r($RemoveHidden);
        echo $RemoveHidden;
        //echo 'complete';
    }

    public function actionComparePriceStoryCurrency() {

        $postId = $_GET['id'];

        $k = base64_decode(base64_decode($postId));
        $params = \common\models\ModelMaster::decodeParams($postId);
        $productSuppId = isset($params['productSuppId']) ? $params['productSuppId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;

        $comparePrice = \common\models\costfit\ProductPostComparePrice::find()
                        ->select('`product_post_compare_price`.* ,`currency_info`.currency_code ')
                        ->join("LEFT JOIN", "currency_info", "currency_info.currencyId = product_post_compare_price.currency")
                        ->where('product_post_compare_price.productPostId =' . $productPostId . ' and currency_info.status=2')->asArray()->all();
        //echo '<pre>';
        //print_r($comparePrice);
        if (isset($comparePrice)) {
            return \yii\helpers\Json::encode($comparePrice);
        } else {
            return FALSE;
        }
    }

    public function actionComparePriceStoryCurrencyExchangeRate() {

        $postId = $_GET['id'];
        if (isset($_GET['currencyId']) && !empty($_GET['currencyId'])) {
            $currencyId = $_GET['currencyId'];
            $dataCurrency = \common\models\costfit\CurrencyInfo::find()->where('currencyId=' . $currencyId)->one();
            if (isset($dataCurrency) && !empty($dataCurrency)) {
                //$currency_code = $dataCurrency['currency_code'];
                $rss['currencyCode'] = $dataCurrency['currency_code'];
                $rss['currencyName'] = $dataCurrency['currency_name'];
            } else {
                $rss['currencyCode'] = $dataCurrency['currency_code'];
                $rss['currencyName'] = $dataCurrency['currency_name'];
            }
        }

        $k = base64_decode(base64_decode($postId));
        $params = \common\models\ModelMaster::decodeParams($postId);
        $productSuppId = isset($params['productSuppId']) ? $params['productSuppId'] : NULL;
        $productId = isset($params['productId']) ? $params['productId'] : NULL;
        $productPostId = isset($params['productPostId']) ? $params['productPostId'] : NULL;

        $comparePrice = \common\models\costfit\ProductPostComparePrice::find()
                        ->select('`product_post_compare_price`.* ,`currency_info`.currency_code ')
                        ->join("LEFT JOIN", "currency_info", "currency_info.currencyId = product_post_compare_price.currency")
                        ->where('product_post_compare_price.productPostId =' . $productPostId . ' and currency_info.status=2')->asArray()->all();
        //echo '<pre>';
        //print_r($comparePrice);
        $rss['comparePrice'] = $comparePrice;
        if (isset($comparePrice)) {
            return \yii\helpers\Json::encode($rss);
        } else {
            return FALSE;
        }
    }

    public function countView($productPostId, $token) {
        if (Yii::$app->user->id) {
            $productPostView = \common\models\costfit\ProductPostView::find()->where("productPostId=" . $productPostId . " and userId=" . Yii::$app->user->id . " and token='" . $token . "'")
                    ->orderBy("productPostId DESC")
                    ->one(); // เอาอันล่าสุด
        } else {
            $productPostView = \common\models\costfit\ProductPostView::find()->where("productPostId=" . $productPostId . " and token='" . $token . "'")
                    ->orderBy("productPostId DESC")
                    ->one();
        }
        if (isset($productPostView)) {
            $time = $productPostView->createDateTime;
            $now = date('Y-m-d H:i:s');
            $time_diff = strtotime($now) - strtotime($time);
            $time_diff_hour = floor($time_diff % 3600);
            if ($time_diff_hour > 8) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 1; //save ได้
        }
    }

    public function actionUploadImages() {
        $uploadedFile = \yii\web\UploadedFile::getInstanceByName('upload');
        $mime = \yii\helpers\FileHelper::getMimeType($uploadedFile->tempName);
        $file = time() . "_" . $uploadedFile->name;

        $user_id = Yii::$app->user->id; //Yii::$app->user->getId();

        $url = Yii::$app->urlManager->createAbsoluteUrl('/images/story/' . $user_id . '/' . $file);
        $uploadPath = Yii::getAlias('@webroot') . '/images/story/' . $user_id . '/' . $file;

        if (!is_dir(Yii::getAlias('@webroot') . '/images/story/' . $user_id)) { //ถ้ายังไม่มี folder ให้สร้าง folder ตาม user id
            mkdir(Yii::getAlias('@webroot') . '/images/story/' . $user_id);
        }

        //ตรวจสอบ
        if ($uploadedFile == null) {
            $message = "ไม่มีไฟล์ที่ Upload";
        } else if ($uploadedFile->size == 0) {
            $message = "ไฟล์มีขนาด 0";
        } else if ($mime != "image/jpeg" && $mime != "image/png" && $mime != "image/gif") {
            $message = "รูปภาพควรเป็น JPG หรือ PNG";
        } else if ($uploadedFile->tempName == null) {
            $message = "มีข้อผิดพลาด";
        } else {
            $message = "";
            $move = $uploadedFile->saveAs($uploadPath);
            if (!$move) {
                $message = "ไม่สามารถนำไฟล์ไปไว้ใน Folder ได้กรุณาตรวจสอบ Permission Read/Write/Modify";
            }
        }
        $funcNum = $_GET['CKEditorFuncNum'];
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
    }

}
