<?php

namespace mobile\modules\v1\controllers;

use common\models\costfit\ProductShelf;
use Yii;
use yii\db\Exception;
use yii\db\Expression;
use yii\web\Controller;
use \yii\helpers\Json;
use mobile\modules\v1\models\Wishlist;

/**
 * Default controller for the `mobile` module
 */
class WishlistController extends Controller
{
    public function beforeAction($action)
    {
//        if ($action->id == 'for-sale' || $action->id=='not-sale' || $action->id=='view') {
        if(in_array($action->id, ['index', 'add-wishlist', 'delete-wishlist', 'add-shelf', 'delete-shelf'])) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionIndex()
    {
        $userId = !Yii::$app->user->id ? 43 : Yii::$app->user->id;
        $res = [];

        $productShelfs = ProductShelf::find()->where(['userId' => $userId, 'status' => 1])->all();

        $i = 0;
        foreach($productShelfs as $productShelf) {
            $res[$i] = $productShelf->attributes;

            $items = [];

            $wishlists = Wishlist::find()
                ->select('w.wishlistId, w.productId, p.title, p.price as marketPrice, pps.price as sellingPrice')
                ->from('wishlist w')
                ->leftJoin('product p', 'p.productId=w.productId')
                ->leftJoin('product_suppliers ps', 'p.productId=ps.productId')
                ->leftJoin('product_price_suppliers pps', 'ps.productSuppId=pps.productSuppId')
                ->where(['w.productShelfId' => $productShelf->productShelfId, 'pps.status' => 1])
                ->all();

            $j = 0;
            foreach($wishlists as $wishlist) {
                $items[$j] = [
                    'wishlistId' => $wishlist->wishlistId,
                    'productId' => $wishlist->productId,
                    'marketPrice' => $wishlist->marketPrice,
                    'sellingPrice' => $wishlist->sellingPrice,
                    'title' => $wishlist->product->title,
                    'image' => $wishlist->product->images->imageThumbnail1,
                    'brand' => $wishlist->product->brand->title
                ];
                $j++;
            }

            $res[$i]['items'] = $items;

            $i++;
        }

        echo Json::encode($res);
    }

    public function actionAddWishlist()
    {
        //Receive Get Parameter
        //$_POST[productId] = productId
        //Return Array of error
        $res = ['success' => false, 'error' => NULL];
        $userId = !Yii::$app->user->id ? 43 : Yii::$app->user->id;
        $productId = $_POST['productId'];
        $productShelfId = $_POST['productShelfId'];
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
        print_r(\yii\helpers\Json::encode($res));
    }

    public function actionDeleteWishlist()
    {
        //Receive Get Parameter
        //$_POST[productId] = productId
        //Return Array of error
        $res = ['success' => false, 'error' => NULL];
        $userId = !Yii::$app->user->id ? 43 : Yii::$app->user->id;
        $wishlistId = $_POST['wishlistId'];

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
        print_r(Json::encode($res));
    }

    public function actionAddShelf()
    {
        $title = $_POST['title'];
        $userId = !Yii::$app->user->id ? 43 : Yii::$app->user->id;
        $res = ['success' => false, 'error' => NULL];

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

        echo Json::encode($res);
    }

    public function actionDeleteShelf()
    {
        $productShelfId = $_POST['productShelfId'];

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

}
