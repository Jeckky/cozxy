<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\costfit\Product;

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
<div class="col-lg-6 col-md-6">
    <h1><?= $model->title; ?></h1>
    <?= Html::hiddenInput("productId", $model->productId, ['id' => 'productId']); ?>
    <?= Html::hiddenInput("fastId", $fastId = Product::getShippingTypeId($model->productId), ['id' => 'fastId']); ?>
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
        <div class="old-price"><?= (isset($model->price) && !empty($model->price)) ? number_format($model->price, 2) . " ฿" : "815,00 $" ?></div>
        <div class="price"><?= number_format($model->calProductPrice($model->productId, 1), 2) . " ฿" ?></div>
    </div>
    <div class="buttons group products-buttons-group" style="margin-top: -18px;">
        <div class="form-group">
            <label for="shopping-dollar" class="col-sm-1 " style="padding-right: 0px; padding-left: 0px; margin-bottom: 0px;">
                <img  src="<?php echo Yii::$app->homeUrl; ?>images/icon/Bitcoin-48.png" alt="thumb" class="img-responsive" width="42" height="42"/>
            </label>
            <div class="col-sm-11 text-left discountPrice" style="padding: 0px; margin-left: 0px; margin-top: 15px;">
                &nbsp;Add more than 1 item to your order
            </div>
        </div>
    </div>
    <div class="buttons group products-buttons-group" style="margin-top: -18px;">
        <div class="form-group">
            <label for="shopping-cart" class="col-sm-1" style="padding-right: 0px;  padding-left: 0px;  margin-bottom: 0px;">
                <img  src="<?php echo Yii::$app->homeUrl; ?>images/icon/1.png" alt="thumb" class="img-responsive"/>
            </label>
            <div id="choose" class="col-sm-11 text-left " style="padding: 0px; margin-left: 0px; margin-top: 15px;">
                &nbsp;ส่งสินค้าภายใน <?php echo Product::getShippingDate($model->productId, 1); ?> วัน
            </div>
            <div id="unchoose" class="col-sm-11 text-left " style="padding: 0px; margin-left: 0px; margin-top: 15px;text-decoration: line-through;color:#bbb;display: none;">
                &nbsp;ส่งสินค้าภายใน <?php echo Product::getShippingDate($model->productId, 1); ?> วัน
            </div>
            <div class="form-group  col-lg-12" style="margin-bottom: 5px;">
                <div class="checkbox">
                    <label style="color: red;">
                        <input type="checkbox" id="lateShippingCheck" name="lateShippingCheck">  ต้องการส่งสินค้าราคาประหยัดอีก
                        <?php echo $model->calProductPrice($model->productId, 1, 0, 1) - $model->calProductPrice($model->productId, 1, 0, 2) ?>  บาท (ส่งภายใน <?php echo Product::getShippingDate($model->productId, 2); ?> วัน)
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="buttons group">
        <?php
        $i = 0;
        foreach ($model->productPrices as $pp) {
            ?>
            <div  class="col-lg-2 col-md-2 col-sm-12 " style="float: left; padding-right: 0px; padding-left: 0px;">
                <table id="pp<?= number_format($pp->quantity, 0) ?>" class="col-lg-12 col-md-12 text-center <?= ($i == 0) ? " priceActive" : " " ?>" style="font-size: 14px; border: 1px #f5f5f5 solid;">

                    <thead style="border-bottom: 1px #f5f5f5 solid;">
                        <tr>
                            <th class="text-center">Buy <?= number_format($pp->quantity, 0) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="item first">
                            <td class="thumb"><?= number_format($pp->getSavePrice(), 2) . " ฿"; ?></td>
                        </tr>
                        <!--<tr class="item first">
                            <td class="name">
                                <small>off your order</small>
                            </td>
                        </tr>-->
                    </tbody>
                </table>
            </div>
            <?php
            $i++;
        }
        ?>
    </div>

    <div class="buttons group">
        <div class="qnt-count">
            <a class="incr-btn" href="#">-</a>
            <input id="quantity" class="form-control" type="text" value="<?= ($model->findMaxQuantity($model->productId) == 0) ? 0 : 1 ?>">
            <a class="incr-btn" href="#" data-toggle="popover" data-content="Max Quantity For this Item" data-placement="bottom">+</a>
        </div>
        <a class="btn btn-primary btn-sm" id="addItemToCartUnity" href="#" <?= ($model->findMaxQuantity($model->productId) <= 0) ? " disabled" : " " ?>><i class="icon-shopping-cart"></i>Add to cart</a>
        <a class="btn btn-black btn-sm" <?php if (\Yii::$app->user->isGuest == 1) { ?> id="GuestaddItemToWishlist" <?php } else { ?> id="addItemToWishlist" <?php } ?> href="#" <?= (\common\models\costfit\Wishlist::isExistingList($model->productId)) ? " disabled" : " " ?>><i class="icon-heart"></i>Add to wishlist</a>
    </div>
   <!-- <p class="p-style2"><?//= strip_tags($model->shortDescription); ?></p>-->
    <!--<div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title">ส่งสินค้า</h3>
        </div>
        <div class="panel-body">
            <div class="form-group col-lg-12" style="margin-bottom:5px;">
                <label for="shopping-cart" class="col-sm-1" style="padding-right: 0px;  padding-left: 0px;  margin-bottom: 0px;">
                    <img  src="<?//php echo Yii::$app->homeUrl; ?>images/icon/1.png" alt="thumb" class="img-responsive"/>
                </label>
                <div class="col-sm-11 text-left" style="padding: 0px; margin-left: 0px; margin-top: 15px;">
                    &nbsp;ส่งสินค้าภายใน 7 วัน
                </div>
            </div>
            <div class="form-group  col-lg-12">
                <div class="checkbox">
                    <label><input type="checkbox" id="lateShippingCheck" name="lateShippingCheck">  ต้องการส่งสินค้าราคาประหยัดอีก 1,xxx  บาท (ส่งภายใน 15 วัน)</label>
                </div>
            </div>
        </div>
    </div>-->
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7">
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
                <a href="<?php echo Yii::$app->homeUrl; ?>search-cost-fit?search_hd=cost.fit">cost.fit</a>
            </div>
        </div>
    </div>
</div>

<!--Product Gallery-->
<div class="col-lg-6 col-md-6" id="productImage">
    <?php echo $this->render('_product_image', ['model' => $model]); ?>
</div>

<script src="<?php echo $directoryAsset; ?>/js/plugins/icheck.min.js"></script>
<?php
$this->registerJs("$('input').iCheck();
                        $('#lateShippingCheck').on('ifChecked', function (event) {

                            var productId = $('input[id=productId]').val();
                            var fastId = $('input[id=fastId]').val();

                            $.ajax({
                                type: 'POST',
                                dataType: 'JSON',
                                url: '../products/get-product-shipping-price/',
                                data: {'productId': productId, 'fastId': fastId},
                                success: function (data)
                                {
                                    // alert(productId);
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
                                url: '../products/get-defult-product-shipping-price/',
                                data: {'productId': productId},
                                success: function (data)
                                {
                                    //  alert(data);
                                    $('#fastId').val(data);
                                    $('#choose').show();
                                    $('#unchoose').hide();
                                }
                            });
                        });

                        $('.incr-btn').on('click', function (e) {
                            event.preventDefault();
                            var \$button = $(this);
                            var oldValue = \$button.parent().find('input').val();
                            var newVal = 1
                            if (\$button.text() == " + ") {
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
                                url: '../cart/change-quantity-item',
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
                                        \$button.parent().find('input').val(newVal);
                                    } else
                                    {
                                        if (data.errorCode === 1)
                                        {
                                            newVal = newVal - 1;
                                            $('.incr-btn').popover('show');
                                        }
                                        \$button.parent().find('input').val(newVal);
                                    }
                                }
                            });
                        });", \yii\web\View::POS_LOAD, 'my-options');
?>


