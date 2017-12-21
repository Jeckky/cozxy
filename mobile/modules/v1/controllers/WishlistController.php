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
    public $enableCsrfValidation = false;
    public $pageSize = 2;

    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionIndex()
    {
        $userId = !Yii::$app->user->id ? 43 : Yii::$app->user->id;
        $productShelfId = $_POST['productShelfId'];
        $res = [];

        $page = isset($_POST['page']) ? $_POST['page'] : 0;
        $offset = $page * $this->pageSize;

        $items = [];

        $wishlists = Wishlist::find()
            ->select('w.wishlistId, w.productId, p.title, p.price as marketPrice, pps.price as sellingPrice')
            ->from('wishlist w')
            ->leftJoin('product p', 'p.productId=w.productId')
            ->leftJoin('product_suppliers ps', 'p.productId=ps.productId')
            ->leftJoin('product_price_suppliers pps', 'ps.productSuppId=pps.productSuppId')
            ->where(['w.productShelfId' => $productShelfId, 'pps.status' => 1])
            ->limit($this->pageSize)
            ->offset($offset)
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

        $res['items'] = $items;
        $res['productShelfId'] = $productShelfId;
        $res['page'] = $page;

        echo Json::encode($res);
    }

    public function actionWishlistGroup()
    {
        $userId = !Yii::$app->user->id ? 43 : Yii::$app->user->id;
        $res = [];

        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        $offset = $page * $this->pageSize;

        $productShelfs = ProductShelf::find()
            ->where(['userId' => $userId, 'status' => 1])
            ->limit($this->pageSize)
            ->offset($offset)
            ->all();

        $items = [];
        $i = 0;
        foreach($productShelfs as $productShelf) {
            $items[$i] = $productShelf->attributes;
            $i++;
        }
        $res['items'] = $items;
        $res['page'] = $page;

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

    public function actionRenameShelf()
    {
        $res = ['success' => false, 'error' => NULL];
        $productShelfId = $_POST['productShelfId'];
        $newTitle = $_POST['newTitle'];

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
