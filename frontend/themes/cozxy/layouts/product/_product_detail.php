<?php

use yii\helpers\Html;

$this->title = $model['title'];
$this->params['breadcrumbs'][] = $this->title;
$id = uniqid();
$val = rand(1, 10);
?>

<div class="product-detail">
    <div class="row">
        <div class="col-md-8 product-gallery">
            <div class="row">
                <div class="col-md-12 col-xs-12 images-big">
                    <img  src="<?php echo $model['image'] ?>" class="fullwidth" alt=" ">
                </div>
                <?php
                $productimageThumbnail1 = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTE2IiBoZWlnaHQ9IjExNiIgdmlld0JveD0iMCAwIDY0IDY0IiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJub25lIj48IS0tDQpTb3VyY2UgVVJMOiBob2xkZXIuanMvMTE2eDExNg0KQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4NCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQ0KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28NCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWMwYTg2ZjY1YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YzBhODZmNjVhIj48cmVjdCB3aWR0aD0iMTE2IiBoZWlnaHQ9IjExNiIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjYuMjI2NTYyNSIgeT0iMzYuNTMyODEyNSI+MTE2eDExNjwvdGV4dD48L2c+PC9nPjwvc3ZnPg==';
                if (count($model['images']) == 0) {
                    /* for ($index = 0; $index <= 3; $index++) {
                      echo ''
                      . '<div class="col-md-3 col-xs-6">
                      <img src="' . $productimageThumbnail1 . '" class="fullwidth" alt="" style="margin-top: 24px;">
                      </div>';
                      } */
                } else {
                    foreach ($model['images'] as $key => $value) {
                        echo ''
                        . '<div class="col-md-3 col-xs-6">
                            <img  src="' . $value['imageThumbnail1'] . '" class="fullwidth" alt="" style="margin-top: 24px;" onClick="ShowImages(this,' . $value['productImageId'] . ')">
                        </div>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12 col-xs-12 product-select bg-white">
                    <div class="product-form">
                        <h3 class="size20 size16-xs"><?php echo $model['title'] ?></h3>
                        <?php
                        if ($model['price'] > 0) {
                            ?>
                            <p class="size24 size20-xs b"><?php echo $model['price']; ?> THB</p>
                        <?php } ?>
                        <p class="size12 fc-g666">Category: <?php echo isset($model['category']) ? $model['category'] : '-'; ?></p>
                        <?php
                        if (isset($model['shortDescription'])) {
                            echo '<hr><p>' . $model['shortDescription'] . '<p><hr>';
                        } else {
                            echo '';
                        }
                        ?>


                        <?php
//                        throw new \yii\base\Exception(print_r($selectedOptions, true));
                        if (isset($productGroupOptionValues) && count($productGroupOptionValues) > 0) {

                            foreach ($productGroupOptionValues as $productGroupTemplateOptionId => $productGroupOptionValue):
                                $selected = "";
                                if (isset($selectedOptions) && count($selectedOptions) > 0) {
                                    foreach ($selectedOptions as $selectedOption):
//                                    throw new \yii\base\Exception(print_r($selectedOption, true));
                                        if ($selectedOption["productGroupTemplateOptionId"] == $productGroupTemplateOptionId) {
                                            $selected = $selectedOption["id"];
                                            break;
                                        }
                                    endforeach;
                                }
                                ?>
                                <form id="optionForm">
                                    <div class="row login-box">
                                        <div class="col-sm-12 size18 b"><?= common\models\costfit\ProductGroupTemplateOption::getTitle($productGroupTemplateOptionId) ?></div>
                                        <div class="col-sm-12 text-right quantity-sel size18">
                                            <?php if (count($productGroupOptionValue) > 1): ?>
                                                <?= Html::dropDownList($productGroupTemplateOptionId, $selected, $productGroupOptionValue, ['class' => 'fullwidth productOption']) ?>
                                            <?php else: ?>
                                                <?= array_values($productGroupOptionValue)[0]; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <hr>
                                </form>
                                <?php
                            endforeach;
                        }
                        ?>
                        <?php
                        if ($model['price'] > 0 && $model['result'] > 0) {
                            ?>
                            <div class="row">
                                <div class="col-sm-6 size18 b">QUANTITY</div>
                                <div class="col-sm-6 text-right quantity-sel size18">
                                    <a href="javascript:qSets('<?= $id ?>',-1,'<?= $model["productSuppId"] ?>','<?= isset($this->params['cart']['orderId']) ? $this->params['cart']['orderId'] : '' ?>','<?= $model["sendDate"] ?>','<?= isset($this->params['cart']['orderItemId']) ? $this->params['cart']['orderItemId'] : '' ?>');" class="q-minus"><i class="fa fa-minus-circle" aria-hidden="true" style="color: #000"></i></a>
                                    <input type="text" id="quantity" name="quantity" class="quantity quantity-<?= $id ?>" value="1">
                                    <a href="javascript:qSets('<?= $id ?>',1,'<?= $model["productSuppId"] ?>','<?= isset($this->params['cart']['orderId']) ? $this->params['cart']['orderId'] : '' ?>','<?= $model["sendDate"] ?>','<?= isset($this->params['cart']['orderItemId']) ? $this->params['cart']['orderItemId'] : '' ?>');" class="q-plus"><i class="fa fa-plus-circle" aria-hidden="true" style="color: #000"></i></a>
                                </div>
                            </div>
                            <hr>
                        <?php } ?>
                        <div class="size36">&nbsp;</div>
                        <div class="text-center abs" style="bottom: 0; left: 0; right: 0;">
                            <input type="hidden" id="maxQnty" value="<?php echo $model['result']; ?>">
                            <input type="hidden" id="fastId" value="">
                            <input type="hidden" id="productId" value="<?php echo $model['productId']; ?>">
                            <input type="hidden" id="supplierId" value="<?php echo $model['supplierId']; ?>">
                            <input type="hidden" id="productSuppId" value="<?php echo $model['productSuppId']; ?>">
                            <input type="hidden" id="receiveType" value="<?php echo $model['receiveType']; ?>">

                            <?php
                            if ($model['wishList'] == 1) { // เคย wishList ไปแล้ว
                                ?>
                                <a class="b btn-g999 size16">
                                    <i class="fa fa-heartbeat" aria-hidden="true"></i>
                                </a>
                            <?php } else { ?>
                                <a href="javascript:addItemToWishlist(<?= $model['productSuppId'] ?>);" class="b btn-g999 size16" id="addItemToWishlist-<?= $model['productSuppId'] ?>" data-loading-text="<a><i class='fa fa-heartbeat' aria-hidden='true'></i></a>" style="margin:24px auto 12px">+
                                    <i class="fa fa-heart"></i></a>
                                <?php } ?>
                                <?php
                                if ($model['result'] > 0) {
                                    echo '<a id="addItemToCartUnity" data-loading-text="<i id=\'cart-plus-' . $model['productSuppId'] . '\' class=\'fa fa-cart-plus fa-spin\'></i> Processing cart" class="b btn-yellow size16" style="margin:24px auto 12px">+
                                <i class="fa fa-cart-plus"></i></a>';
                                } else {
                                    echo ' ';
                                }
                                ?>
                            <!-- <a href = "/cart" class = "b btn-g999 btn-success size16" style = "margin:24px auto 12px;color:#fff;">+
                                 <i class = "fa fa-bookmark-o"></i></a>
                            -->
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs('
$(".productOption").on("change", function(){
    $.ajax({
        method: "POST",
        url: "' . Yii::$app->homeUrl . 'product-group-options/product-by-options",
        data: $("form#optionForm").serialize(),
        dataType:"json"
    })
    .done(function( data ) {
        window.location = "' . Yii::$app->homeUrl . 'product/"+data.token;
    });
});


');
?>