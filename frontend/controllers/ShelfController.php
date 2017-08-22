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
        $productId = $_POST['productId'];
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
            if ($productId != 'no') {
                $wishlist = new \common\models\costfit\Wishlist();
                $wishlist->productShelfId = Yii::$app->db->getLastInsertID();
                $wishlist->userId = Yii::$app->user->id;
                $wishlist->productId = $productId;
                $wishlist->createDateTime = new \yii\db\Expression('NOW()');
                $wishlist->updateDateTime = new \yii\db\Expression('NOW()');
                $wishlist->save(false);
            }
        }
        $res['status'] = true;
        $allShelf = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and status=1 and type in(1,2)")
                ->orderBy('type')
                ->addOrderBy('title')
                ->all();
        if ($productId != 'no') {

            if (isset($allShelf) && count($allShelf) > 0) {
                foreach ($allShelf as $shelf):
                    $isAdd = ProductShelf::isAddToWishList($productId, $shelf->productShelfId);
                    $text1 = "<hr><div class = 'row'>
<a href = 'javascript:addItemToWishlist($productId,$shelf->productShelfId,$isAdd);' id = 'addItemToWishlist-$productId' style = 'color: #000;'>
<div class = 'col-lg-8 col-md-8 col-sm-8 col-xs-8 pull-left text-left'>$shelf->title</div>";
                    if ($isAdd == 1) {

                        $text2 = "<div class = 'col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-$productId$shelf->productShelfId' style = 'font-size: 25pt;color: #ffcc00;' id = 'heartbeat$productId$shelf->productShelfId'>
<i class = 'fa fa-heart' aria-hidden = 'true'></i>
</div>
<div class = 'col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-$productId$shelf->productShelfId' style = 'font-size: 25pt;display: none;' id = 'heart-o$productId$shelf->productShelfId'>
<i class = 'fa fa-heart-o' aria-hidden = 'true'></i>
</div>";
                    } else {
                        $text2 = "<div class = 'col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-$productId$shelf->productShelfId' style = 'font-size: 25pt;' id = 'heart-o$productId$shelf->productShelfId'>
<i class = 'fa fa-heart-o' aria-hidden = 'true'></i>
</div>
<div class = 'col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-$productId$shelf->productShelfId' style = 'font-size: 25pt;display: none;color: #ffcc00;' id = 'heartbeat$productId$shelf->productShelfId'>
<i class = 'fa fa-heart' aria-hidden = 'true'></i>
</div>";
                    }
                    $text3 = "</a></div>";
                    $text .= $text1 . $text2 . $text3;
                endforeach;
            }
        } else {
            $allshelf = ProductShelf::wishListGroup();
            $fullCol = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
            $col10 = "col-lg-10 col-md-10 col-sm-9 col-xs-9";
            $col2 = "col-lg-2 col-md-2 col-sm-3 col-xs-3";
            if (isset($allshelf) && count($allshelf) > 0) {
                $i = 0;
                foreach ($allshelf as $shelf):

                    if ($shelf->type == 1) {
                        $a = "<i class='fa fa-heart' aria-hidden='true' style='color:#FFFF00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
                    }
                    if ($shelf->type == 2) {
                        $a = "<i class='fa fa-gratipay' aria-hidden='true' style='color:#FF6699;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
                    }
                    if ($shelf->type == 3) {
                        $a = "<i class='fa fa-star' aria-hidden='true' style='color:#FFCC00;font-size:20pt;'></i>&nbsp; &nbsp; &nbsp;";
                    }

                    $text .= '<div class="' . $col10 . ' bg-gray" style="cursor: pointer;padding:18px 18px 10px;margin-bottom: 10px;" onclick="javascript:showWishlistGroup(' . $shelf->productShelfId . ', 1);" id="showGroup-' . $shelf->productShelfId . '">
                ' . $a . ' ' . $shelf->title . '
            </div>
            <div class="' . $col10 . ' bg-gray" style="display: none;cursor: pointer;padding:18px 18px 10px;margin-bottom: 10px;" onclick="javascript:showWishlistGroup(' . $shelf->productShelfId . ', 0);" id="hideGroup-' . $shelf->productShelfId . '">
                ' . $a . ' ' . $shelf->title . '
            </div>
            <div class="' . $col2 . ' bg-gray text-right" style="padding:18px 18px 10px;margin-bottom: 10px; color:#FF6699;">
                <i class="fa fa-edit" aria-hidden="true" style="font-size:20pt;cursor:pointer;" onclick="javascript:editShelf(' . $shelf->productShelfId . ', 1)" id="showEditShelf' . $shelf->productShelfId . '"></i>
                <i class="fa fa-edit" aria-hidden="true" style="font-size:20pt;cursor:pointer;display: none;" onclick="javascript:editShelf(' . $shelf->productShelfId . ', 0)" id="hideEditShelf' . $shelf->productShelfId . '"></i>&nbsp;&nbsp;&nbsp;
                <i class="fa fa-trash" aria-hidden="true" style="font-size:20pt;cursor:pointer;" onclick="javascript:deleteShelf(' . $shelf->productShelfId . ')"></i>
            </div>
            <div id="editShelf' . $shelf->productShelfId . '" style="display: none;" class="col-md-12">

                <h4>Shelf Name</h4>
                <input type="text" name="shelfName" class="fullwidth input-lg" id="shelfName' . $shelf->productShelfId . '" style="margin-bottom: 10px;" value="' . $shelf->title . '">
                <div class="text-right" style="">
                    <input type="hidden" id="productSuppId" value="no">
                    <a href="javascript:cancelEditShelf(' . $shelf->productShelfId . ')"class="btn btn-black" id="cancelEditShelf' . $shelf->productShelfId . '">Cancel</a>&nbsp;&nbsp;&nbsp;
                    <a href="javascript:updateShelf(' . $shelf->productShelfId . ')"class="btn btn-yellow"id="updateShelf' . $shelf->productShelfId . '">Update</a>
                </div>
            </div>';
                    $text .= "<div id='wishListShelf-$shelf->productShelfId'></div>";
                    $i++;
                endforeach;
            }
        }
        $res['text'] = $text;

        return json_encode($res);
    }

}
