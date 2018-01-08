<?php

namespace mobile\modules\v1\controllers;

use common\models\costfit\CurrencyInfo;
use common\models\costfit\FavoriteStory;
use common\models\costfit\ProductPostRating;
use common\models\costfit\ProductPostView;
use common\models\costfit\User;
use common\models\ModelMaster;
use mobile\modules\v1\models\ProductPost;
use common\helpers\Token;
use mobile\modules\v1\models\ProductPostComparePrice;
use Yii;
use yii\db\Expression;
use yii\db\Exception;
use yii\web\Controller;
use \yii\helpers\Json;

/**
 * Default controller for the `mobile` module
 */
class StoryController extends Controller
{
    public $enableCsrfValidation = false;
    public $pageSize = 12;

    public function actionIndex()
    {
        $res = [];
        $orderBy = ['totalScore' => SORT_DESC];

        if(isset($_GET['sort']) && !empty($_GET['sort'])) {
            $orderBy = self::prepareSort($_GET['sort']);
        }

        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        $offset = $page * $this->pageSize;

        if(!isset($_GET['productId'])) {
            $storyModels = ProductPost::find()
                ->leftJoin('product p', 'product_post.productId=p.productId')
                ->leftJoin('brand b', 'p.brandId=b.brandid')
                ->leftJoin('user u', 'product_post.userId=u.userId')
                ->where(['product_post.status' => 1, 'product_post.isPublic' => 1])
                ->andWhere('b.brandId is not null')
                ->andWhere('u.userId is not null')
                ->orderBy($orderBy)
                ->limit($this->pageSize)
                ->offset($offset)
                ->all();
        } else {
            $storyModels = ProductPost::find()
                ->leftJoin('product p', 'product_post.productId=p.productId')
                ->leftJoin('brand b', 'p.brandId=b.brandid')
                ->leftJoin('user u', 'product_post.userId=u.userId')
                ->where(['product_post.status' => 1, 'product_post.isPublic' => 1])
                ->andWhere('b.brandId is not null')
                ->andWhere('u.userId is not null')
                ->andWhere(['product_post.productId' => $_GET['productId']])
                ->orderBy($orderBy)
                ->limit($this->pageSize)
                ->offset($offset)
                ->all();
        }


        $items = [];
        $i = 0;
        foreach($storyModels as $storyModel) {
            $items[$i] = self::prepareStoryData($storyModel);
            $i++;
        }

        $res['items'] = $items;
        $res['page'] = $page;

        echo Json::encode($res);
    }

    public function actionMyStory()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

        if(isset($userModel)) {
            $res = [];
            $orderBy = ['totalScore' => SORT_DESC];

            if(isset($contents['sort']) && !empty($contents['sort'])) {
                $orderBy = self::prepareSort($contents['sort']);
            }

//            if(isset($contents['sort'])) {
//                /**
//                 * sort by
//                 * view, -view
//                 * rate, -rate
//                 * recent, -recent
//                 */
//
//
//                $sort = $contents['sort'];
//                if(substr($sort, 0, 1) == '-') {
//                    //sort desc
//                    $sort = substr($sort, 1);
//                    $orderBy = [$sort => SORT_DESC];
//                } else {
//                    //sort asc
//                    $orderBy = [$sort => SORT_ASC];
//                }
//            }

            $page = isset($contents['page']) ? $contents['page'] : 0;
            $offset = $page * $this->pageSize;

            $storyModels = ProductPost::find()
                ->leftJoin('product p', 'product_post.productId=p.productId')
                ->leftJoin('brand b', 'p.brandId=b.brandid')
                ->leftJoin('user u', 'product_post.userId=u.userId')
                ->where(['product_post.status' => 1, 'product_post.isPublic' => 1])
                ->andWhere('b.brandId is not null')
                ->andWhere('u.userId is not null')
                ->andWhere(['product_post.userId' => $userModel->userId])
                ->orderBy($orderBy)
                ->limit($this->pageSize)
                ->offset($offset)
                ->all();


            $items = [];
            $i = 0;
            foreach($storyModels as $storyModel) {
                $items[$i] = self::prepareStoryData($storyModel);
                $i++;
            }

            $res['items'] = $items;
            $res['page'] = $page;

            echo Json::encode($res);
        }
    }

    private static function prepareSort($sort)
    {
        $sortType = SORT_ASC;
        if(substr($sort, 0, 1) == '-') {
            //sort desc
            $sort = substr($sort, 1);
            $sortType = SORT_DESC;
        }

        return [self::sortField($sort) => $sortType];
    }

    private static function sortField($sort)
    {
        $sortField = '';
        switch($sort) {
            case 'recent':
                $sortField = 'createDateTime';
                break;
            case 'rating':
                $sortField = 'averageStar';
                break;
            case 'view':
                $sortField = 'totalView';
                break;
        }

        return $sortField;
    }

    private static function prepareStoryData($storyModel)
    {
        $data = [
            'title' => $storyModel->title,
            'id' => $storyModel->productPostId,
            'shortDescription' => $storyModel->shortDescription,
            'description' => $storyModel->description,
            'image' => Yii::$app->homeUrl . $storyModel->product->images->imageThumbnail1,
            'views' => $storyModel->countView(),
            'stars' => $storyModel->averageStar(),
            'lastUpdate' => $storyModel->updateDateTime,
            'shareUrl' => 'https://www.cozxy.com/story/' . ModelMaster::encodeParams(['productPostId' => $storyModel->productPostId])
        ];

        $data['product'] = [
            'id' => $storyModel->productId,
            'title' => $storyModel->product->title,
        ];

        $data['brand'] = [
            'brandId' => isset($storyModel->product->brand->brandId) ? $storyModel->product->brand->brandId : '',
            'brandTitle' => isset($storyModel->product->brand->title) ? $storyModel->product->brand->title : '',
        ];

        $data['author'] = [
            'name' => $storyModel->user->firstname . ' ' . $storyModel->user->lastname,
            'avatar' => Yii::$app->homeUrl . 'images/user/avatar/' . $storyModel->user->avatar
        ];

        $data['comparePrice'] = self::prepareComparePrice($storyModel->productPostId);

        return $data;
    }

    private static function prepareComparePrice($storyId)
    {
        $data = [];

        $productComparePriceModels = ProductPostComparePrice::find()->where(['productPostId' => $storyId, 'status' => 1])->all();
        $i = 0;

        foreach($productComparePriceModels as $productComparePriceModel) {
            $data[$i] = [
                'currency' => $productComparePriceModel->currencyInfo->ccy,
                'price' => number_format($productComparePriceModel->price, 2),
                'shopName' => $productComparePriceModel->shopName,
                'latitude' => $productComparePriceModel->latitude,
                'longitude' => $productComparePriceModel->longitude,
            ];
            $i++;
        }

        return $data;
    }

    public function actionStoryDetail()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        echo Json::encode(self::prepareStoryData(ProductPost::findOne($contents['id'])));
    }

    private static function findStory($storyId)
    {
        return ProductPost::findOne($storyId);
    }

    public function actionAddFavoriteStory()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => NULL];
        $storyId = $contents['storyId'];
        $userId = isset(Yii::$app->user->id) ? Yii::$app->user->id : 43;
        $storyModel = self::findStory($storyId);

        $favoriteStoryModel = new FavoriteStory();
        $favoriteStoryModel->productPostId = $storyId;
        $favoriteStoryModel->productId = $storyModel->productId;
        $favoriteStoryModel->userId = $userId;
        $favoriteStoryModel->createDateTime = $favoriteStoryModel->updateDateTime = new Expression('NOW()');

        if($favoriteStoryModel->save()) {
            $res['success'] = true;
        } else {
            $res['error'] = 'Error :: Please try again';
        }

        echo Json::encode($res);
    }

    public function actionRemoveFavouriteStory()
    {
        $res = ['success' => false, 'error' => NULL];
        $storyId = $_POST['storyId'];

        $numRows = FavoriteStory::deleteAll(['productPostId' => $storyId]);

        if($numRows) {
            $res['success'] = true;
        } else {
            $res['error'] = 'Error :: Please try again';
        }

        echo Json::encode($res);
    }

    public function actionVote()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => NULL];
        $storyId = $contents['storyId'];
        $star = $contents['star'];
        $userId = isset(Yii::$app->user->id) ? Yii::$app->user->id : 43;

        $transaction = Yii::$app->db->beginTransaction();
        $flag = false;

        try {
            $productPostRatingModel = new ProductPostRating();
            $productPostRatingModel->productPostId = $storyId;
            $productPostRatingModel->score = $star;
            $productPostRatingModel->userId = $userId;
            $productPostRatingModel->createDateTime = $productPostRatingModel->updateDateTime = new Expression('NOW()');

            $productPostModel = ProductPost::findOne($storyId);
            $productPostModel->totalScore += ($star * 5);

            if($productPostModel->save() && $productPostRatingModel->save()) {
                $flag = true;
            }

            if($flag) {
                $transaction->commit();
                $res['success'] = true;
                $res['star'] = ProductPostRating::averageStar($storyId);
            } else {
                $transaction->rollBack();
                $res['error'] = 'Error :: Please try again';
            }
        }
        catch(Exception $e) {
            $transaction->rollBack();
            $res['error'] = 'Error :: Please try again';
        }

        echo Json::encode($res);
    }

    public function actionCountView()
    {
        $storyId = $_POST['storyId'];
        $userId = isset(Yii::$app->user->id) ? Yii::$app->user->id : 43;

        $transaction = Yii::$app->db->beginTransaction();
        $flag = false;

        try {
            $productPostViewModel = new ProductPostView();
            $productPostViewModel->productPostId = $storyId;
            $productPostViewModel->userId = $userId;
            $productPostViewModel->createDateTime = $productPostViewModel->updateDateTime = new Expression('NOW()');
            $productPostViewModel->token = Token::getViewToken();

            $productPostModel = ProductPost::findOne($storyId);
            $productPostModel->totalScore += 3;

            if($productPostModel->save() && $productPostViewModel->save()) {
                $flag = true;
            }

            if($flag) {
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
        }
        catch(Exception $e) {
            $transaction->rollBack();
        }
    }

    public function actionSave()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => NULL];
        $productId = $contents['productId'];
        $title = $contents['title'];
        $shortDescription = $contents['shortDescription'];
        $description = $contents['description'];
        $isPublic = $contents['isPublic'];

        $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

        if(isset($userModel)) {
            $userId = $userModel->userId;

            $transaction = Yii::$app->db->beginTransaction();
            $flag = false;

            try {
                $storyModel = new ProductPost();
                $storyModel->productId = $productId;
                $storyModel->title = $title;
                $storyModel->shortDescription = $shortDescription;
                $storyModel->description = $description;
                $storyModel->isPublic = $isPublic;
                $storyModel->userId = $userId;
                $storyModel->totalScore = 0;
                $storyModel->productSelfId = 0;
                $storyModel->createDateTime = $storyModel->updateDateTime = new Expression('NOW()');

                if($storyModel->save()) {
                    $res['storyId'] = Yii::$app->db->lastInsertID;
                    $comparePrice = $contents['comparePrice'];
                    $currencyInfoModel = CurrencyInfo::find()->where(['currencyId' => $comparePrice['currencyId']])->one();

                    $productComparePriceModel = new ProductPostComparePrice();
                    $productComparePriceModel->productId = $productId;
                    $productComparePriceModel->shopName = $comparePrice['shopName'];
                    $productComparePriceModel->placeName = $comparePrice['placeName'];
                    $productComparePriceModel->moreDetail = $comparePrice['moreDetail'];
                    $productComparePriceModel->price = $comparePrice['price'];
                    $productComparePriceModel->currency = $currencyInfoModel->ccy;
                    $productComparePriceModel->country = $currencyInfoModel->ctry_name;
                    $productComparePriceModel->latitude = $comparePrice['latitude'];
                    $productComparePriceModel->longitude = $comparePrice['longitude'];
                    $productComparePriceModel->productPostId = $res['storyId'];
                    $productComparePriceModel->userId = $userId;
                    $productComparePriceModel->createDateTime = $productComparePriceModel->updateDateTime = new Expression('NOW()');

                    if($productComparePriceModel->save()) {
                        $flag = true;
                    } else {
                        $res['error'] = $productComparePriceModel->errors;
                    }
                } else {
                    $res['error'] = $storyModel->errors;
                }

                if($flag) {
                    $transaction->commit();
                    $res['success'] = true;
                } else {
                    $transaction->rollBack();
                }
            }
            catch(Exception $e) {
                $transaction->rollBack();
            }
        } else {
            $res['error'] = 'Error : User not found.';
        }

        echo Json::encode($res);
    }

    public function actionSaveComparePrice()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => NULL];
        $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

        if(isset($userModel)) {
            $userId = $userModel->userId;

            $transaction = Yii::$app->db->beginTransaction();
            $flag = false;

            try {
                $storyModel = ProductPost::findOne($contents['storyId']);
                $comparePrice = $contents['comparePrice'];
                $currencyInfoModel = CurrencyInfo::find()->where(['currencyId' => $comparePrice['currencyId']])->one();

                $productComparePriceModel = new ProductPostComparePrice();
                $productComparePriceModel->productId = $storyModel->productId;
                $productComparePriceModel->shopName = $comparePrice['shopName'];
                $productComparePriceModel->placeName = $comparePrice['placeName'];
                $productComparePriceModel->moreDetail = $comparePrice['moreDetail'];
                $productComparePriceModel->price = $comparePrice['price'];
                $productComparePriceModel->currency = $currencyInfoModel->ccy;
                $productComparePriceModel->country = $currencyInfoModel->ctry_name;
                $productComparePriceModel->latitude = $comparePrice['latitude'];
                $productComparePriceModel->longitude = $comparePrice['longitude'];
                $productComparePriceModel->productPostId = $contents['storyId'];
                $productComparePriceModel->userId = $userId;
                $productComparePriceModel->createDateTime = $productComparePriceModel->updateDateTime = new Expression('NOW()');

                if($productComparePriceModel->save()) {
                    $flag = true;
                } else {
                    $res['error'] = $productComparePriceModel->errors;
                }

                if($flag) {
                    $transaction->commit();
                    $res['success'] = true;
                } else {
                    $transaction->rollBack();
                }
            }
            catch(Exception $e) {
                $transaction->rollBack();
            }
        } else {
            $res['error'] = 'Error : User not found.';
        }

        echo Json::encode($res);
    }

    public function actionUpdate()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => NULL];
        $title = $contents['title'];
        $shortDescription = $contents['shortDescription'];
        $description = $contents['description'];
        $isPublic = $contents['isPublic'];
        $storyId = $contents['storyId'];

        $storyModel = self::findStory($storyId);
        $storyModel->title = $title;
        $storyModel->shortDescription = $shortDescription;
        $storyModel->description = $description;
        $storyModel->isPublic = $isPublic;
        $storyModel->updateDateTime = new Expression('NOW()');

        if($storyModel->save()) {
            $res['success'] = true;
        } else {
            $res['error'] = 'Error : Please try again';
        }

        echo Json::encode($res);
    }

    public function actionDelete()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => NULL];
        $storyId = $contents['storyId'];

        $numRow = ProductPost::deleteAll(['productPostId' => $storyId]);

        if($numRow) {
            $res['success'] = true;
        } else {
            $res['error'] = 'Error : Please try again';
        }

        echo Json::encode($res);
    }
}
