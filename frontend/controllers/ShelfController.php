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
$res = [];
$text = '';
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
$newShelf->createDateTime = new \yii\db\Expression('NOW()');
$newShelf->updateDateTime = new \yii\db\Expression('NOW()');
$newShelf->save(false);
$res['status'] = true;
$allShelf = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and status=1")
->orderBy('createDateTime DESC')
->all();

if (isset($allShelf) && count($allShelf) > 0) {
foreach ($allShelf as $shelf):
$text .= '<hr><div class="row" style="cursor: pointer;">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pull-left text-left">' .
$shelf->title . '</div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right" style="font-size: 20pt;">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                </div>
                            </div>';
endforeach;
}
$res['text'] = $text;
}
return json_encode($res);
}

}

$text = <div class = "row">
<a href = "javascript:addItemToWishlist($productSuppId,$group->productShelfId,$isAdd);" id = "addItemToWishlist-$productSuppId"style = "color: #000;">
<div class = "col-lg-8 col-md-8 col-sm-8 col-xs-8 pull-left text-left">
$group->title
</div>
if ($isAdd) {
<div class = "col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-$model['productSuppId']$group->productShelfId" style = "font-size: 25pt;color: #ffcc00;" id = "heartbeat$model['productSuppId']$group->productShelfId">
<i class = "fa fa-heartbeat" aria-hidden = "true"></i>
</div>
<div class = "col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-$model['productSuppId']$group->productShelfId" style = "font-size: 25pt;display: none;" id = "heart-o$model['productSuppId']$group->productShelfId">
<i class = "fa fa-heart-o" aria-hidden = "true"></i>
</div>} else {
<div class = "col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-$model['productSuppId']$group->productShelfId" style = "font-size: 25pt;" id = "heart-o$model['productSuppId']$group->productShelfId">
<i class = "fa fa-heart-o" aria-hidden = "true"></i>
</div>
<div class = "col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-$model['productSuppId']$group->productShelfId" style = "font-size: 25pt;display: none;color: #ffcc00;" id = "heartbeat$model['productSuppId']$group->productShelfId ?>">
<i class = "fa fa-heartbeat" aria-hidden = "true"></i>
</div>

}
</a>
</div>;
