<?php

namespace mobile\modules\v1\controllers;

use common\models\costfit\ProductShelf;
use common\models\costfit\User;
use Yii;
use yii\db\Exception;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\Controller;
use \yii\helpers\Json;
use mobile\modules\v1\models\Wishlist;

/**
 * Default controller for the `mobile` module
 */
class WishlistController extends Controller
{
    public $enableCsrfValidation = false;
    public $pageSize = 10;

    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionIndex()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $userModel = User::find()->where(['auth_key' => $contents['token']])->one();
        if(isset($userModel)) {
            $productShelfId = $contents['productShelfId'];
            $res = [];

            $page = isset($contents['page']) ? $contents['page'] : 0;
            $offset = $page * $this->pageSize;
            $orderBy = [];

            if(isset($contents['sort']) && !empty($contents['sort'])){
                $orderBy = self::prepareSort($contents['sort']);
            }

            $items = [];

            $wishlists = Wishlist::find()
                ->select('w.wishlistId, w.productId, p.title, p.price as marketPrice, pps.price as sellingPrice')
                ->from('wishlist w')
                ->leftJoin('product p', 'p.productId=w.productId')
                ->leftJoin('product_suppliers ps', 'p.productId=ps.productId')
                ->leftJoin('product_price_suppliers pps', 'ps.productSuppId=pps.productSuppId')
                ->leftJoin('brand b', 'b.brandId=p.brandId')
                ->where(['w.productShelfId' => $productShelfId, 'pps.status' => 1])
                ->limit($this->pageSize)
                ->offset($offset)
                ->orderBy($orderBy)
                ->all();

//            $j = 0;
//            foreach($wishlists as $wishlist) {
//                $items[$j] = [
//                    'wishlistId' => $wishlist->wishlistId,
//                    'productId' => $wishlist->productId,
//                    'marketPrice' => $wishlist->marketPrice,
//                    'sellingPrice' => $wishlist->sellingPrice,
//                    'discountPercent' => self::discountPercent($wishlist),
//                    'title' => $wishlist->product->title,
//                    'image' => Url::home(true).$wishlist->product->images->imageThumbnail1,
//                    'brand' => $wishlist->product->brand->title
//                ];
//                $j++;
//            }

            $res['items'] = self::prepareWishlistData($wishlists);
            $res['productShelfId'] = $productShelfId;
            $res['page'] = $page;
        } else {
            $res['error'] = 'Error : User not found.';
        }

        echo Json::encode($res);
    }

    private static function prepareWishlistData($wishlists)
    {
        $items = [];
        $j = 0;
        foreach($wishlists as $wishlist) {
            $items[$j] = [
                'wishlistId' => $wishlist->wishlistId,
                'productId' => $wishlist->productId,
                'marketPrice' => $wishlist->marketPrice,
                'sellingPrice' => $wishlist->sellingPrice,
                'discountPercent' => self::discountPercent($wishlist),
                'title' => $wishlist->product->title,
                'image' => Url::home(true).$wishlist->product->images->imageThumbnail1,
                'brand' => $wishlist->product->brand->title
            ];
            $j++;
        }

        return $items;
    }

    private static function discountPercent($wishlist)
    {
        $discountPercent = 0;

        if($wishlist->marketPrice > 0) {
            $discountPercent = (1- $wishlist->sellingPrice / $wishlist->marketPrice) * 100;
        }

        return round($discountPercent);
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
            case 'price':
                $sortField = 'pps.price';
                break;
            case 'popular':
                $sortField = 'p.productId';
                break;
            case 'brand':
                $sortField = 'b.brandId';
                break;
        }

        return $sortField;
    }

    public function actionWishlistGroup()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $userModel = User::find()->where(['auth_key'=>$contents['token']])->one();
        $res = [];
        if(isset($userModel)) {
            $userId = $userModel->userId;

//            $page = isset($_GET['page']) ? $_GET['page'] : 0;
//            $offset = $page * $this->pageSize;

            $productShelfs = ProductShelf::find()
                ->where(['userId' => $userId, 'status' => 1])
//                ->limit($this->pageSize)
//                ->offset($offset)
                ->all();

            $items = [];
            $i = 0;
            $j = 0;
            foreach($productShelfs as $productShelf) {
                $shelf = [
                    'productShelfId' => $productShelf->productShelfId,
                    'title' => $productShelf->title,
                    'badge' => Wishlist::find()->where(['productShelfId'=>$productShelf->productShelfId])->count()
                ];
                if($productShelf->type == 2) {
                    //Your shelves
                    $items['yourShelves'][$i] = $shelf;
                    $i++;
                } else {
                    //Cozxy shelve
                    $items['cozxyShelves'][$j] = $shelf;
                    $j++;
                }
            }
            $res = $items;
//            $res['page'] = $page;
        } else {
            $res['error'] = 'Error : User not found';
        }

        echo Json::encode($res);
    }

    public function actionAddWishlist()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => NULL];
        $userModel = User::find()->where(['auth_key'=>$contents['token']])->one();

        if(isset($userModel)) {
            $userId = !Yii::$app->user->id ? 43 : Yii::$app->user->id;
            $productId = $contents['productId'];
            $productShelfId = $contents['productShelfId'];
            $ws = Wishlist::find()->where(['productId' => $productId, 'userId' => $userId])->one();
            if(!isset($ws)) {
                $ws = new Wishlist();
                $ws->productShelfId = $productShelfId;
                $ws->productId = $productId;
                $ws->userId = $userId;
                $ws->createDateTime = new Expression("NOW()");
                if($ws->save()) {
                    $res["success"] = true;
                } else {
                    $res["error"] = $ws->errors;
                }
            } else {
                $res["error"] = "Exits product in Wishlist";
            }
        } else {
            $res['error'] = 'Error : User not found.';
        }
        echo Json::encode($res);
    }

    public function actionDeleteWishlist()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        //Receive Get Parameter
        //$_POST[productId] = productId
        //Return Array of error
        $userModel = User::find()->where(['auth_key' => $contents['token']])->one();

        if(isset($userModel)) {
            $res = ['success' => false, 'error' => NULL];
            $userId = $userModel->userId;
            $wishlistId = $contents['wishlistId'];

            $ws = Wishlist::find()->where(['wishlistId' => $wishlistId, 'userId' => $userId])->one();
            if(isset($ws)) {
                $isDeleteWishlist = Wishlist::deleteAll(['wishlistId' => $wishlistId, 'userId' => $userId]);
                if($isDeleteWishlist) {
                    $res['success'] = true;
                } else {
                    $res['error'] = 'Error :: Please try again';
                }
            } else {
                $res["error"] = "Error :: Item not found.";
            }
        } else {
            $res['error'] = 'User not found.';
        }
        print_r(Json::encode($res));
    }

    public function actionAddShelf()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $userModel = User::find()->where(['auth_key' => $contents['token']])->one();
        $res = ['success' => false, 'error' => NULL];

        if(isset($userModel)) {
            $title = $contents['title'];
            $userId = $userModel->userId;

            $productShelf = new ProductShelf();
            $productShelf->title = $title;
            $productShelf->type = 2;
            $productShelf->userId = $userId;
            $productShelf->status = 1;
            $productShelf->createDateTime = new Expression('NOW()');
            $productShelf->updateDateTime = new Expression('NOW()');

            if($productShelf->save()) {
                $res['success'] = true;
            } else {
                $res['error'] = 'Error : can not create new shelf';
            }
        } else {
            $res['error'] = 'Error : User not found.';
        }

        echo Json::encode($res);
    }

    public function actionDeleteShelf()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $productShelfId = $contents['productShelfId'];

        $transaction = Yii::$app->db->beginTransaction();
        $flag = false;
        $res = ['success' => false, 'error' => NULL];

        try {
            //move to shelf
            $numWishlist = Wishlist::find()->where(['productShelfId' => $productShelfId])->count();
            $numDelete = Wishlist::deleteAll(['productShelfId' => $productShelfId]);
            $isDeleteProductShelf = ProductShelf::deleteAll(['productShelfId' => $productShelfId]);

            if($numWishlist > 0) {
                if($numWishlist == $numDelete && $isDeleteProductShelf) {
                    $flag = true;
                } else {
                    $res['error'] = 'Error :: error 1';
                }
            } else {
                if($isDeleteProductShelf) {
                    $flag = true;
                } else {
                    $res['error'] = 'Error :: error 2';
                }
            }

            if($flag) {
                $transaction->commit();
                $res['success'] = true;
            } else {
                $transaction->rollBack();
                $res['error'] = 'Error :: error 3 Please try again';
            }
        }
        catch(Exception $e) {
            $transaction->rollBack();
            $res['error'] = 'Error :: Please try again';
        }

        echo Json::encode($res);
    }

    public function actionRenameShelf()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $res = ['success' => false, 'error' => NULL];
        $productShelfId = $contents['productShelfId'];
        $newTitle = $contents['newTitle'];

        $productShelfModel = ProductShelf::findOne($productShelfId);
        $productShelfModel->title = $newTitle;

        if($productShelfModel->save()) {
            $res['success'] = true;
        } else {
            $res['error'] = 'Can not save new title, please try again';
        }

        echo Json::encode($res);
    }
}
