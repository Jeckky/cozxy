<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Product Description-->
<style>
    .popover-content {
        color: #000;
        /*background-color: red;*/
        font-size: 10px;
    }
    .priceActive  > thead > tr{
        border-top: 3px #3cc solid;
        background-color: rgba(51,204,204,.15);
        color: purple;
    }
    .priceActive > tbody > tr{
        background-color: rgba(51,204,204,.15);
        color: purple;
    }
</style>
<div class="col-lg-6 col-md-6">
    <h1 id='productName'><?= $model->title; ?></h1>
    <?= Html::hiddenInput("productId", $model->productId, ['id' => 'productId']); ?>
    <?php if (isset($model->productGroup)): ?>
        <div class="form-group">

            <div class="select-style">
                <?php if (count($model->productGroup->products) > 1): ?>
                    <select name="size" id="changeOption">
                        <?php foreach ($model->productGroup->products as $option): ?>
                            <option <?= (isset($productId) && ($productId == $option->productId)) ? " selected" : " " ?> value="<?= $option->productId ?>"><?= $option->optionName; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
    <!--            <select name="size" id="changeOption">
    <option>Size:28 Inches</option>
    <option>Size:32 Inches</option>
    <option>Size:40 Inches</option>
    <option>Size:48 Inches</option>
    <option>Size:50 Inches</option>
    </select>-->
            </div>
        </div>
    <?php endif; ?>
    <div class="buttons group products-buttons-group">
        <div class="form-group">
            <label for="shopping-cart" class="col-sm-1" style="padding-right: 0px;  padding-left: 0px;  margin-bottom: 0px;">
                <img  src="<?php echo Yii::$app->homeUrl; ?>images/icon/1.png" alt="thumb" class="img-responsive"/>
            </label>
            <div class="col-sm-11 text-left" style="padding: 0px; margin-left: 0px; margin-top: 15px;">
                &nbsp;FREE Shipping
            </div>
        </div>
    </div>
    <div class="buttons group products-buttons-group" id='productPrice'>
        <div class="old-price"><?= (isset($model->price) && !empty($model->price)) ? number_format($model->price, 2) . " ฿" : "815,00 $" ?></div>
        <div class="price"><?= number_format($model->calProductPrice($model->productId, 1), 2) . " ฿" ?></div>
    </div>
    <div class="buttons group products-buttons-group" style="margin-top: -18px;">
        <div class="form-group">
            <label for="shopping-dollar" class="col-sm-1 " style="padding-right: 0px; padding-left: 0px; margin-bottom: 0px;">
                <img  src="<?php echo Yii::$app->homeUrl; ?>images/icon/2.png" alt="thumb" class="img-responsive"/>
            </label>
            <div class="col-sm-11 text-left discountPrice" style="padding: 0px; margin-left: 0px; margin-top: 15px;">
                &nbsp;Add more than 1 item to your order
            </div>
        </div>
    </div>
    <div class="buttons group" id="productPriceTable">
        <?php echo $this->render('_product_price_table', ['model' => $model]); ?>
    </div>
    <div class="buttons group">
        <div class="qnt-count">
            <a class="incr-btn" href="#">-</a>
            <input id="quantity" class="form-control" type="text" value="<?= ($model->findMaxQuantity($model->productId) == 0) ? 0 : 1 ?>">
            <a class="incr-btn" href="#" data-toggle="popover" data-content="Max Quantity For this Item" data-placement="bottom">+</a>
        </div>
        <a class="btn btn-primary btn-sm" id="addItemToCart" href="#" <?= ($model->findMaxQuantity($model->productId) <= 0) ? " disabled" : " " ?>><i class="icon-shopping-cart"></i>Add to cart</a>
        <?php if (!Yii::$app->user->isGuest): ?>
            <a class="btn btn-black btn-sm" href="#" id='addWishlist' <?= (\common\models\costfit\User::getIsExistWishlist($model->productId)) ? " disabled" : " " ?>><i class="icon-heart"></i>Add to wishlist</a>
        <?php endif; ?>
    </div>
    <p class="p-style2"><?//= strip_tags($model->shortDescription); ?></p>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-5">
            <h3>Tell friends</h3>
            <div class="social-links">
                <a href="#"><i class="fa fa-tumblr-square"></i></a>
                <a href="#"><i class="fa fa-pinterest-square"></i></a>
                <a href="#"><i class="fa fa-facebook-square"></i></a>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-7">
            <h3>Tags</h3>
            <div class="tags">
                <a href="#">Backpack</a>,
                <a href="#">Chanel</a>,
                <a href="#">Wristlet</a>
            </div>
        </div>
    </div>
    <div class="promo-labels">
        <div data-content="This is a place for the unique commercial offer. Make it known."><i class="fa fa-truck"></i>Free delivery</div>
        <div data-content="This is a place for the unique commercial offer. Make it known."><img src="<?php echo Yii::$app->homeUrl; ?>images/icon/Fast-Deliver-1.png" alt="cost.fit" style="height: 44px;">Fast Deliver</div>
        <div data-content="This is a place for the unique commercial offer. Make it known."><i class="fa fa-shield"></i>Safe Buy</div>
    </div>
</div>

<!--Product Gallery-->
<div class="col-lg-6 col-md-6" id='productImage'>

    <?php echo $this->render('_product_image', ['model' => $model]); ?>

</div>

