<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\costfit\Product;
use common\models\costfit\ProductSuppliers;

//use kartik\rating\StarRating;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<link href="<?php echo $directoryAsset; ?>/masterslider/style/masterslider.css" rel="stylesheet">

<style>
    .popover-content {
        color: red;
        /*background-color: red;*/
        font-size: 10px;
        padding: 10px;
    }
    .popover .popover-content {
        border: none !important;
        text-align: left !important;
        padding: 5 !important;
        font-size: .875em !important;
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
    .checkbox label {
        min-height: 1em;
        padding-left: 10px;
        margin-bottom: 0;
        font-weight: normal;
        cursor: pointer;
    }

    /* Popover */
    .popover {
        /* border: 2px dotted red;*/
        padding: 15px;

    }

    /* Popover Header */
    .popover-title {
        background-color: #73AD21;
        color: #FFFFFF;
        font-size: 28px;
        text-align:center;
    }

    /* Popover Body */
    .popover-content {

        color: red;
        padding: 25px;
    }

    /* Popover Arrow */
    .arrow {
        /* border-right-color: red !important;*/

    }
</style>
<div class="col-lg-6 col-md-6 text-left">
    <h1><?= $model->title; ?>
        <div class="badges">
            <?php if (common\models\costfit\Product::isSmartItem($model->productId)): ?>
                <span class="sale" style="background-color: #d2d042 !important;color: white;font-size: 20px;padding: 5px 10px 5px 10px">SMART</span>
                <?php
            endif;
            //throw new \yii\base\Exception(print_r($model, true));
            ?>
        </div>
    </h1>
    <?= Html::hiddenInput("fastId", $fastId = Product::getShippingTypeId($model->productId), ['id' => 'fastId']); ?>
    <?= Html::hiddenInput("productId", $model->productId, ['id' => 'productId']); ?>
    <?//= Html::hiddenInput("supplierId", ProductSuppliers::supplier($productSupplierId), ['id' => 'supplierId']); ?>
    <?= Html::hiddenInput("supplierId", $getPrductsSupplirs->userId, ['id' => 'supplierId']); ?>
    <?= Html::hiddenInput("productSuppId", $productSupplierId, ['id' => 'productSuppId']); ?>
    <?= Html::hiddenInput("receiveType", $getPrductsSupplirs->receiveType, ['id' => 'receiveType']); ?>
    <?php // throw new \yii\base\Exception($fastId);  ?>
    <div class="form-group">
        <?php if (isset($model->productGroup)): ?>
            <div class="select-style">
                <?php if (count($model->productGroup->products) > 1): ?>
                    <select name="size" id="changeoption" onchange="changeoption(this.value);">
                        <?php foreach ($model->productGroup->products as $option): ?>
                            <option <?= (isset($productId) && ($productId == $option->productId)) ? " selected" : " " ?> value="<?= $option->productId ?>"><?= $option->optionName; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="buttons group products-buttons-group">
        <?php
        //$supplierPrice = ProductSuppliers::productPriceSupplier($productSupplierId);
        //$supplierPrice = $price->price;
        //$trueId = Suppliers::productSuppliersId($productSupplierId);
        $oldPrice = (isset($supplierPrice) && !empty($supplierPrice)) ? number_format($supplierPrice, 2) : "815.00";
        $newPrice = number_format($model->calProductPrice($productSupplierId, 1), 2);
        if ($oldPrice != $newPrice) {
            ?>
            <div class="old-price"><?= (isset($supplierPrice) && !empty($supplierPrice)) ? number_format($supplierPrice, 2) . " ฿" : "815.00 $" ?></div>
        <?php } ?>
        <div class="price"><?= number_format($model->calProductPrice($productSupplierId, 1), 2) . " ฿" ?></div>
    </div>
    <!--    <div class="buttons group products-buttons-group" style="margin-top: -18px;">
            <div class="form-group" style="word-wrap: break-word;">
                <label for="shopping-dollar" class="col-sm-1 " style="float: left; padding-right: 0px; padding-left: 0px; margin-bottom: 0px;">
                    <img  src="<?php // echo Yii::$app->homeUrl;                                                    ?>images/icon/Untitled-2-50-48.png" alt="thumb" class="img-responsive img-circle-thumbnail" width="38" height="38" style="background-color: #eee;"/>
                </label>
                <div class="col-sm-11 text-left discountPrice " style="float: left; padding: 0px; margin-left: 0px; margin-top: 15px;">
                    &nbsp;Add more than 1 item to your order
                </div>
            </div>
        </div>-->
    <!--    <div class="buttons group products-buttons-group">
            <div class="form-group">
                <label for="shopping-cart" class="col-sm-1" style="float: left; padding-right: 0px;  padding-left: 0px;  margin-bottom: 0px;">
                    <img  src="<?php echo Yii::$app->homeUrl; ?>images/icon/1.png" alt="thumb" class="img-responsive" width="38" height="38"/>
                </label>
                <div id="choose" class="col-sm-11 text-left " style="float: left; padding: 0px; margin-left: 0px; margin-top: 15px;">
                    &nbsp;ส่งสินค้าภายใน <?php echo Product::getShippingDate($model->productId, 1); ?> วัน
                </div>
                <div id="unchoose" class="col-sm-11 text-left " style="padding: 0px; margin-left: 0px; margin-top: 18px;text-decoration: line-through;color:#bbb;display: none;">
                    &nbsp;ส่งสินค้าภายใน <?php echo Product::getShippingDate($model->productId, 1); ?> วัน
                </div>
    <?php
//            $default = Product::getShippingDate($model->productId, 1);
//            $fast = Product::getShippingDate($model->productId, 2);
//            if ($fast != $default) {
    ?>
                    <div class="form-group  col-lg-12" style="margin-bottom: 5px;">
                        <div class="checkbox">
                            <label style="color: red;">
                                <input type="checkbox" id="lateShippingCheck" name="lateShippingCheck">  ต้องการส่งสินค้าราคาประหยัดอีก
    <?php
//                            $productPrice = $model->calProductPrice($productSupplierId, 1, 1, 2);
//                            echo $productPrice["shippingDiscountValue"];
    ?>  บาท (ส่งภายใน <?php // echo Product::getShippingDate($model->productId, 2); ?> วัน)
                            </label>
                        </div>
                    </div>
    <?php // } ?>
            </div>
        </div>-->
    <!--    <div class="buttons group">
    <?php
    // $i = 0;
    // foreach ($model->productPrices as $pp) {
    ?>
                <div class="col-lg-2 col-md-3" style="float: left; padding-right: 0px; padding-left: 0px;">
                    <table id="pp<?//= number_format($pp->quantity, 0) ?>" class="col-lg-12 col-md-12 text-center <?//= ($i == 0) ? " priceActive" : " " ?>" style="font-size: 14px; border: 1px #f5f5f5 solid;">

                        <thead style="border-bottom: 1px #f5f5f5 solid;">
                            <tr>
                                <th class="text-center">Buy <?//= number_format($pp->quantity, 0) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="item first">
                                <td class="thumb"><?//= number_format($pp->getSavePrice(), 2) . " ฿"; ?></td>
                            </tr>
                            <tr class="item first">
                                <td class="name">
                                    <small>off your order</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    <?php
    //$i++;
    //}
    ?>
        </div>-->

    <div class="buttons group">
        <input type="hidden" id="maxQnty" value="<?= $model->findMaxQuantitySupplier($model->productSuppId) ?>">
        <?php
        if ($getPrductsSupplirs->result != 0) {
            ?>
            <div class="qnt-count">
                <a class="incr-btn" href="#">-</a>
                <input id="quantity" class="form-control" type="text" value="<?= ($model->findMaxQuantity($model->productSuppId) == 0) ? 0 : 1 ?>">
                <a class="incr-btn" href="#" data-toggle="popover" data-content="Max Quantity For this Item" data-placement="bottom">+</a>
            </div>
            <?php
        }
        ?>
        <?php
        if ($getPrductsSupplirs->result != 0) {
            ?>
            <a class="btn btn-primary btn-sm" id="addItemToCartUnity" href="#" <?= ($model->findMaxQuantity($model->productSuppId) <= 0) ? " disabled" : " " ?>><i class="icon-shopping-cart"></i>Add to cart</a>
        <?php } ?>
        <a class="btn btn-black btn-sm" <?php if (\Yii::$app->user->isGuest == 1) { ?> id="GuestaddItemToWishlist" <?php } else { ?> id="addItemToWishlist" <?php } ?> href="#" <?= (\common\models\costfit\Wishlist::isExistingList($model->productSuppId)) ? " disabled" : " " ?>><i class="icon-heart"></i>Add to wishlist</a>
    </div>
    <?php
    if (Yii::$app->controller->action->id != 'see-review') {
        ?>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-7">
                <h3 style="text-decoration: underline">Description</h3>
                <?php //$description = ProductSuppliers::productSupplierName($productSupplierId);  ?>
                <?= isset($getPrductsSupplirs) && !empty($getPrductsSupplirs) ? $getPrductsSupplirs->description : '' ?>
                <h3 style="text-decoration: underline">Specification</h3>
                <?= isset($getPrductsSupplirs) && !empty($getPrductsSupplirs) ? $getPrductsSupplirs->specification : '' ?>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <!--
        <div class="col-lg-8 col-md-8 col-sm-7">
            <h3>Tags</h3>
            <div class="tags">&nbsp;

            </div>
        </div>
        -->
    </div>
</div>

<!--Product Gallery-->
<div class="col-lg-6 col-md-6" id="productImage">
    <?php echo $this->render('_product_image', ['model' => $model, 'productSupplierId' => $productSupplierId]); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Tags</h3>
            <div class="tags">&nbsp;
                <?php
                $tags = explode(',', $model->tags);
                if (count($model->tags) > 0) {
                    foreach (explode(',', $model->tags) as $key => $value) {
                        echo '<a href="' . Yii::$app->homeUrl . 'search-cost-fit?search_hd=' . trim($value) . '">' . $value . '</a> &nbsp ,';
                    }
                }
                ?>
                <a href="<?php echo Yii::$app->homeUrl; ?>search-cost-fit?search_hd=Cozxy.com">cozxy</a>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJsFile($directoryAsset . "/js/plugins/icheck.min.js", ['depends' => [frontend\assets\AppAsset::className()]]);
?>
<script>
    $('input').iCheck();
    $('#lateShippingCheck').on('ifChecked', function (event) {
        var productId = $('input[id=productId]').val();
        var fastId = $('input[id=fastId]').val();
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= Yii::$app->homeUrl ?>products/get-product-shipping-price/',
            data: {'productId': productId, 'fastId': fastId},
            success: function (data)
            {
                $('#fastId').val(data);
                $('#choose').hide();
                $('#unchoose').show();
            }

        });
    });
    $('#lateShippingCheck').on('ifUnchecked', function (event) {
        var productId = $('input[id=productId]').val();
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= Yii::$app->homeUrl ?>products/get-defult-product-shipping-price/',
            data: {'productId': productId},
            success: function (data)
            {
                $('#fastId').val(data);
                $('#choose').show();
                $('#unchoose').hide();
            }
        });
    });
    $('.incr-btn').on('click', function (e) {
        event.preventDefault();
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        var newVal = 1
        if ($button.text() == '+') {
            newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below 1
            if (oldValue > 1) {
                newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
            $('.incr-btn').popover('hide');
        }
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= Yii::$app->homeUrl ?>cart/change-quantity-item',
            data: {productId: $('#productId').val(), quantity: newVal},
            success: function (data)
            {
                if (data.status)
                {

                    if (data.discountValue != 'null')
                    {
                        $('.discountPrice').html(data.discountValue + ' ฿ extra offyour order');
                    } else
                    {
                        $('.discountPrice').html('&nbsp;Add more than 1 item to your order');
                    }
                    $('#pp' + oldValue).removeClass('priceActive');
                    $('#pp' + newVal).addClass('priceActive');
                    $button.parent().find('input').val(newVal);
                } else
                {
                    if (data.errorCode === 1)
                    {
                        newVal = newVal - 1;
                        $('.incr-btn').popover('show');
                    }
                    $button.parent().find('input').val(newVal);
                }
            }
        });
    });
</script>

<div class="col-lg-6 col-md-6" id="productImage">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script>
    <div class="row">
        <style type="text/css">
            /* #reviews-rate > img{
                width: 50px;
            }*/
            .reviews-rate > img {
                display: initial;
                max-width: 100%;
                height: auto;

            }
        </style>
        <?php
        if (Yii::$app->controller->action->id != 'see-review') {
            ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <!--<h3 style="text-decoration: underline">Customer Reviews</h3>-->
                <div><hr></div>
                <div class="Reviews" style="margin-left: 10px; margin-top: 10px;  ">
                    <!--<h5>Rate this item</h5>
                    <div class="col-md-6">
                    <?php
                    //2.Usage without a model
                    /* echo \yii2mod\rating\StarRating::widget([
                      'name' => "input_name",
                      'value' => 1,
                      'options' => [
                      // Your additional tag options
                      'id' => 'reviews-rate', 'class' => 'reviews-rate'
                      ],
                      'clientOptions' => [
                      // Your client options
                      ],
                      ]); */
                    ?>
                    </div>-->

                    <div class="col-md-12 text-right">
                        <?php
                        if (\Yii::$app->user->id != '') {
                            ?>
                            <a href="/reviews/create-post?productSupplierId=<?= $productSupplierId ?>&productId=<?= $model->productId ?>" class="btn btn-black btn-xs" role="button" id="write-reviews">Write a post</a>
                        <?php } ?>
                    </div>

                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?php
                if (\Yii::$app->user->id != '') {
                    ?>
                    <h3 style="text-decoration: underline">My Post :</h3>
                    <div class="Reviews" style="margin-left: 10px;">
                        <div class="post">

                            <?php
                            if (count($productPostViewMem) > 0) {
                                $nun = 1;
                                foreach ($productPostViewMem as $key => $value) {

                                    $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $value->productSuppId)->all();
                                    foreach ($productPostList as $valuex) {
                                        $member = \common\models\costfit\User::find()->where('userId=' . $value->userId)->one();
                                        ?>
                                        <p class="p-style3" style="border-bottom: 1px #e6e6e6 dotted;">
                                            <a href="/reviews/see-review?productPostId=<?php echo $value->productPostId; ?>&productSupplierId=<?= $value->productSuppId ?>&productId=<?= $valuex->productId ?>"  role="button"   style="font-size: 14px;">
                                                <?php echo 'Title : ' . strip_tags($value->title); ?></a>
                                            <br>
                                            <?php echo 'Short Desc : ' . strip_tags($value->shortDescription); ?>
                                        </p>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                        <a href="/reviews/see-review?productSupplierId=<?= $productSupplierId ?>&productId=<?= $model->productId ?>"  role="button" class="panel-toggle" id="see-reviews" style="font-size: 14px;">See all  reviews <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                <?php } ?>
            </div>


        <?php } ?>
    </div>

</div>

<?php
if (Yii::$app->controller->action->id != 'see-review') {
    ?>
    <style>
        .brand-carousel-reviews {
            padding: 24px 0 48px 0;
            border-top: 0px solid #e6e6e6;
            border-bottom: 0px solid #e6e6e6;
        }
    </style>
    <div class="col-sm-12">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Post <i class="fa fa-plus-circle" aria-hidden="true"></i></h3>
            <div class="Reviews" style="margin-left: 10px;">
                <div class="post">
                    <section class="brand-carousel-reviews">
                        <?php
                        if (count($productPost) > 0) {
                            foreach ($productPost as $key => $value) {
                                $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $value->productSuppId)->all();
                                foreach ($productPostList as $valuex) {
                                    $member = \common\models\costfit\User::find()->where('userId=' . $value->userId)->one();
                                    $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('productImageId desc')->limit(1)->one();
                                    ?>
                                    <div class="col-sm-3 text-center" style="border-bottom: 1px #e6e6e6 dotted; margin-bottom: 10px;">
                                        <?php
                                        if (isset($productImages->imageThumbnail2) && !empty($productImages->imageThumbnail2)) {
                                            if (file_exists(Yii::$app->basePath . "/web/" . $productImages->imageThumbnail2)) {
                                                echo "<img class=\"ms-thumb\" src=\"/" . $productImages->imageThumbnail2 . "\" alt=\"1\" class=\"img-responsive img-thumbnail\"/>";
                                            } else {
                                                echo "<img  class=\"ms-thumb\"  src=\"/" . "images/ContentGroup/DUHWYsdXVc.png\" alt=\"1\" width=\"137\" height=\"130\" class=\"img-responsive img-thumbnail\"/>";
                                            }
                                        } else {
                                            ?>
                                            <img class="ms-thumb" src="<?php echo "/images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1" width="137" height="130" class="img-responsive img-thumbnail"/>
                                        <?php } ?>
                                        <p class="text-left" style="margin-top: 5px;margin-bottom: 5px; font-size: 12px; color: rgb(144, 138, 138);">By <?php echo $member->firstname; ?></p>
                                        <p class="text-left" style="margin-bottom: 0px;">
                                            <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= common\models\ModelMaster::encodeParams(['productId' => $valuex->productId, 'productSupplierId' => $valuex->productSuppId]) ?>see-review?productPostId=29&productSupplierId=<?php echo $valuex->productSuppId; ?>&productId=<?php echo $valuex->productId; ?>"><?php echo substr($valuex->title, 0, 30); ?></a></p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                        }
                        ?>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <?php
}?>