<?php

use yii\helpers\Html;
use common\models\costfit\ProductShelf;
use common\models\costfit\ProductSuppliers;

$this->title = $model['title'];
$this->params['breadcrumbs'][] = $this->title;
$id = uniqid();
$val = rand(1, 10);
?>

<!-- Product Detail Old -->
<div class="product-detail">
    <div class="row">
        <div class="col-md-8 product-gallery">
            <div class="row">
                <div class="col-xs-12">
                    <div class="zoom-box">
                        <a href="<?php echo $model['image'] ?>" target="_blank">
                            <img id="zoom-img" src="<?php echo $model['image'] ?>" class="fullwidth" alt="" data-zoom-image="<?php echo $model['image'] ?>">
                        </a>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="product-navi rela">
                        <div class="product-thumb nowrap">
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
                                    /* echo ''
                                      . '<a href="javascript:pic2Zoom("' . $value['imageThumbnail1'] . '", "' . $model['image'] . '");" class="item">
                                      <img  src="' . $value['imageThumbnail1'] . '">
                                      </a>'; */
                                    ?>
                                    <a href="javascript:pic2Zoom('<?= isset($value['imageBig']) ? $value['imageBig'] : '' ?>','<?= isset($value['imageBig']) ? $value['imageBig'] : '' ?>');" class="item">
                                        <img  src="<?= $value['imageThumbnail1'] ?>" width="116" height="116">
                                    </a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <a class="align-middle fc-white bg-yellow3 size16" href="javascript:scrolling2Left();" style="padding:8px 8px 4px;left:0"><span class="glyphicon glyphicon-menu-left"></span></a>
                        <a class="align-middle fc-white bg-yellow3 size16" href="javascript:scrolling2Right();" style="padding:8px 8px 4px;right:0"><span class="glyphicon glyphicon-menu-right"></span></a>
                    </div>
                </div>
            </div>
            <!--<div class="row">
                <div class="col-md-12 col-xs-12 images-big">
                    <img  src="<?//php echo $model['image'] ?>" class="fullwidth" alt=" ">
                </div>
            <?//php
            /* $productimageThumbnail1 = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTE2IiBoZWlnaHQ9IjExNiIgdmlld0JveD0iMCAwIDY0IDY0IiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJub25lIj48IS0tDQpTb3VyY2UgVVJMOiBob2xkZXIuanMvMTE2eDExNg0KQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4NCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQ0KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28NCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWMwYTg2ZjY1YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YzBhODZmNjVhIj48cmVjdCB3aWR0aD0iMTE2IiBoZWlnaHQ9IjExNiIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjYuMjI2NTYyNSIgeT0iMzYuNTMyODEyNSI+MTE2eDExNjwvdGV4dD48L2c+PC9nPjwvc3ZnPg==';
              if (count($model['images']) == 0) {
              /* for ($index = 0; $index <= 3; $index++) {
              echo ''
              . '<div class="col-md-3 col-xs-6">
              <img src="' . $productimageThumbnail1 . '" class="fullwidth" alt="" style="margin-top: 24px;">
              </div>';
              }
              } else {
              foreach ($model['images'] as $key => $value) {
              echo ''
              . '<div class="col-md-3 col-xs-6">
              <img  src="' . $value['imageThumbnail1'] . '" class="fullwidth" alt="" style="margin-top: 24px;" onClick="ShowImages(this,' . $value['productImageId'] . ')">
              </div>';
              }
              } */
            ?>
            </div>-->
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
                            if (Yii::$app->user->id) {
                                if ($model['wishList'] == 1) { // เคย wishList ไปแล้ว
                                    ?>
                                    <a href="" class="b btn-g999 size15" data-toggle="modal" data-target="#wishListGroup<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heartbeat' aria-hidden='true'></i></div>">
                                        <div class="heart-<?= $model['productSuppId'] ?>"><i class="fa fa-heartbeat" aria-hidden="true"></i></div>
                                    </a>
                                <?php } else { ?>
                                    <!-- <a href="javascript:addItemToWishlist(<?php // $model['productSuppId']                  ?>);" id="addItemToWishlist-<?php // $model['productSuppId']                   ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heartbeat' aria-hidden='true'></i></div>">
                                        <div class="col-xs-4 heart-<?php // $model['productSuppId']                  ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                                    </a>-->
                                    <a href="" class="b btn-g999 size15" data-toggle="modal" data-target="#wishListGroup<?= $model['productSuppId'] ?>" data-loading-text="<div class='col-xs-4'><i class='fa fa-heartbeat' aria-hidden='true'></i></div>" style="margin:14px auto 2px;padding: 6px 16px;">
                                        <div class="heart-<?= $model['productSuppId'] ?>">ADD TO SHELVER<!--+ <i class="fa fa-heart-o" aria-hidden="true"></i>--></div>
                                    </a>
                                    <?php
                                }
                            } else {
                                ?>
                                <a href="<?= Yii::$app->homeUrl . 'site/login' ?>"  style="margin:14px auto 2px">
                                    <div class="b btn-g999 size15" style="padding: 6px 16px;">ADD TO SHELVER<!--+ <i class="fa fa-heart-o" aria-hidden="true"></i>--></div>
                                </a>
                            <?php } ?>
                            <?php
                            if ($model['result'] > 0) {
                                echo '<a id="addItemToCartUnity" data-loading-text="<i id=\'cart-plus-' . $model['productSuppId'] . '\' class=\'fa fa-cart-plus fa-spin\'></i> Processing cart" class="b btn-yellow size16" style="margin:14px auto 2px;padding: 6px 16px;">ADD TO CART</a>';
                            } else {
                                echo ' ';
                            }
                            ?>
                            <!-- <a href = "/cart" class = "b btn-g999 btn-success size16" style = "margin:24px auto 12px;color:#fff;">+
                                 <i class = "fa fa-bookmark-o"></i></a>
                            -->
                            <div class="size12">&nbsp;</div>
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
$("#zoom-img").elevateZoom({
        zoomType: "inner",
        cursor: "zoom-in",
        zoomWindowFadeIn: 384,
        zoomWindowFadeOut: 728
    });

');
?>
<div class="modal fade" id="wishListGroup<?= $model['productSuppId'] ?>" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeWishlistModal"><i class="fa fa-times"></i>
                </button>
                <h3>Save to Wish List</h3>
            </div>
            <div class="modal-body" style="padding: 40px;">
                <a style="cursor: pointer;" id="showCreateWishList">Create New Wish List Group</a>
                <a style="cursor: pointer;display: none;" id="hideCreateWishList" >Create New Wish List Group</a>
                <div id="newWishList" style="display: none;">

                    <h4>Name</h4>
                    <input type="text" name="wishListName" class="fullwidth input-lg" id="wishListName" style="margin-bottom: 10px;">
                    <div class="text-right" style="">
                        <a class="btn btn-black" id="cancel-newWishList">Cancle</a>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-yellow"id="create-newWishList" disabled>Create</a>
                        <input type="hidden" id="productSuppId" name="productSuppId" value="<?= $model['productSuppId'] ?>">
                    </div>
                </div>
                <div id="allGroup">
                    <?php
                    $whishListGroup = ProductShelf::wishListGroupModal();
                    if (isset($whishListGroup) && count($whishListGroup) > 0) {
                        foreach ($whishListGroup as $group):
                            $isAdd = ProductShelf::isAddToWishList($model['productSuppId'], $group->productShelfId);
                            ?> <hr>
                            <div class="row">
                                <a href="javascript:addItemToWishlist(<?= $model['productSuppId'] ?>,<?= $group->productShelfId ?>,<?= $isAdd ?>);" id="addItemToWishlist-<?= $model['productSuppId'] ?>" style="color: #000;">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pull-left text-left">
                                        <?= $group->title ?>
                                    </div>
                                    <?php
                                    //$isAdd = ProductShelf::isAddToWishList($model['productSuppId'], $group->productShelfId);
                                    if ($isAdd) {
                                        ?>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-<?= $model['productSuppId'] ?><?= $group->productShelfId ?>" style="font-size: 25pt;color: #ffcc00;" id="heartbeat<?= $model['productSuppId'] ?><?= $group->productShelfId ?>">
                                            <i class="fa fa-heartbeat" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-<?= $model['productSuppId'] ?><?= $group->productShelfId ?>" style="font-size: 25pt;display: none;" id="heart-o<?= $model['productSuppId'] ?><?= $group->productShelfId ?>">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-<?= $model['productSuppId'] ?><?= $group->productShelfId ?>" style="font-size: 25pt;" id="heart-o<?= $model['productSuppId'] ?><?= $group->productShelfId ?>">
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right text-right heart-<?= $model['productSuppId'] ?><?= $group->productShelfId ?>" style="font-size: 25pt;display: none;color: #ffcc00;" id="heartbeat<?= $model['productSuppId'] ?><?= $group->productShelfId ?>">
                                            <i class="fa fa-heartbeat" aria-hidden="true"></i>
                                        </div>
                                    <?php } ?>
                                </a>
                            </div>

                            <?php
                        endforeach;
                    }
                    ?>
                </div>
                <div col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left><hr style=""></div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><img src="<?= Yii::$app->homeUrl . ProductSuppliers::productImageSuppliersSmall($model['productSuppId']) ?>" style="border: #cccccc solid thin;"></div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-left pull-right">
                        <?= ProductSuppliers::productSupplierName($model['productSuppId'])->title ?><br>
                        <?= ProductSuppliers::productSupplierName($model['productSuppId'])->shortDescription ?>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
