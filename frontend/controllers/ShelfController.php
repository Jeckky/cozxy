<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\costfit\ProductShelf;

class ShelfController extends MasterController {

    public function actionCreate() {
        $title = $_POST['title'];
        $productSuppId = $_POST['productSuppId'];
        $res = [];
        $text = '';
        $text1 = '';
        $text2 = '';
        $text3 = '';
// throw new \yii\base\Exception('1234');
        $shelf = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and title='" . $_POST['title'] . "' and status=1")->one();
        if (isset($shelf)) {
            $res['status'] = false;
            $res['error'] = 'This name already exists.';
        } else {
            $newShelf = new ProductShelf();
            $newShelf->userId = Yii::$app->user->id;
            $newShelf->title = $_POST['title'];
            $newShelf->status = 1;
            $newShelf->type = 2;
            $newShelf->createDateTime = new \yii\db\Expression('NOW()');
            $newShelf->updateDateTime = new \yii\db\Expression('NOW()');
            $newShelf->save(false);
            $wishlist = new \common\models\costfit\Wishlist();
            $wishlist->productShelfId = Yii::$app->db->getLastInsertID();
            $wishlist->userId = Yii::$app->user->id;
            $wishlist->productId = $productSuppId;
            $wishlist->createDateTime = new \yii\db\Expression('NOW()');
            $wishlist->updateDateTime = new \yii\db\Expression('NOW()');
            $wishlist->save(false);
            $res['status'] = true;
            $allShelf = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and status=1 and type in(1,2)")
                    ->orderBy('type')
                    ->addOrderBy('title')
                    ->all();
            if ($productSuppId != 'no') {

                if (isset($allShelf) && count($allShelf) > 0) {
                    foreach ($allShelf as $shelf):
                        $isAdd = ProductShelf::isAddToWishList($productSuppId, $shelf->productShelfId);
                        $text1 = "<hr><div class = 'row'>
<a href = 'javascript:addItemToWishlist($productSuppId,$shelf->productShelfId,$isAdd);' id = 'addItemToWishlist-$productSuppId' style = 'color: #000;'>
<div class = 'col-lg-8 col-md-8 col-sm-8 col-xs-8 pull-left text-left'>$shelf->title</div>";
                        if ($isAdd == 1) {

                            $text2 = "<div class = 'col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-$productSuppId$shelf->productShelfId' style = 'font-size: 25pt;color: #ffcc00;' id = 'heartbeat$productSuppId$shelf->productShelfId'>
<i class = 'fa fa-heartbeat' aria-hidden = 'true'></i>
</div>
<div class = 'col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-$productSuppId$shelf->productShelfId' style = 'font-size: 25pt;display: none;' id = 'heart-o$productSuppId$shelf->productShelfId'>
<i class = 'fa fa-heart-o' aria-hidden = 'true'></i>
</div>";
                        } else {
                            $text2 = "<div class = 'col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-$productSuppId$shelf->productShelfId' style = 'font-size: 25pt;' id = 'heart-o$productSuppId$shelf->productShelfId'>
<i class = 'fa fa-heart-o' aria-hidden = 'true'></i>
</div>
<div class = 'col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-$productSuppId$shelf->productShelfId' style = 'font-size: 25pt;display: none;color: #ffcc00;' id = 'heartbeat$productSuppId$shelf->productShelfId'>
<i class = 'fa fa-heartbeat' aria-hidden = 'true'></i>
</div>";
                        }
                        $text3 = "</a></div>";
                        $text .= $text1 . $text2 . $text3;
                    endforeach;
                }
            } else {
                $allshelf = ProductShelf::wishListGroup();
                $fullCol = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
                if (isset($allshelf) && count($allshelf) > 0) {
                    $i = 0;
                    foreach ($allshelf as $shelf):

                        if ($i == 0) {
                            $display = '';
                        } else {
                            $display = 'none';
                        }
                        if ($i == 0) {
                            $display2 = 'none';
                        } else {
                            $display2 = '';
                        }
                        if ($shelf->type == 1) {
                            $a = "<i class='fa fa-heart' aria-hidden='true' style='color:#FFFF00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
                        }
                        if ($shelf->type == 2) {
                            $a = "<i class='fa fa-gratipay' aria-hidden='true' style='color:#FF6699;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
                        }
                        if ($shelf->type == 3) {
                            $a = "<i class='fa fa-star' aria-hidden='true' style='color:#FFCC00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
                        }

                        $text .= "<a href='javascript:showWishlistGroup($shelf->productShelfId,0);' style='display:none;color:#000;' id='hideGroup-$shelf->productShelfId'>
                          <div class='$fullCol bg-gray' style='padding:18px 18px 10px;margin-bottom: 10px;'>$a $shelf->title<i class='fa fa-chevron-up pull-right' aria-hidden='true'></i>
                          </div>
                          </a>";
                        $text .= "<a href='javascript:showWishlistGroup($shelf->productShelfId,1);' style='color:#000;' id='showGroup-$shelf->productShelfId'>
            <div class='$fullCol bg-gray' style='padding:18px 18px 10px;margin-bottom: 10px;'>$a $shelf->title<i class='fa fa-chevron-down pull-right' aria-hidden='true'></i>
            </div>
        </a>";
                        $text .= "<div id='wishListShelf-$shelf->productShelfId'></div>";
                        $i++;
                    endforeach;
                }
            }
            $res['text'] = $text;
        }
        return json_encode($res);
    }

}
