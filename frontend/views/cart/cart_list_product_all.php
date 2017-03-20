<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

use common\models\ModelMaster;
?>
<style>
    .order-message {
        width: 100%;
        max-width: 1140px;
        max-height: 0;
        overflow: hidden;
        margin: 12px auto 0 auto;
        padding: 0 25px;
        background: #c7b07b;
        color: #fff;
        border-radius: 0;
        opacity: 0;
        transition: all .3s;
    }

    .order-message.visible {
        max-height: 800px;
        padding: 12px 25px;
        opacity: 1
    }

    .order-message p,
    .order-message i {
        display: block;
        float: left;
        line-height: 1.3;
        margin-top: 9px;
        margin-bottom: 10px;
        color: #fff
    }

    .order-message i {
        margin-right: 20px
    }

    .order-message a {
        display: block;
        float: right
    }

    .order-message:after {
        visibility: hidden;
        display: block;
        content: "";
        clear: both;
        height: 0
    }
    .incr-btn-cart {
        display: inline-block;
        width: 20px;
        height: 40px;
        border-radius: 0;
        background: #ff9016;
        color: #fff;
        text-align: center;
        font-size: 1.375em;
        line-height: 34px;
        transition: background .3s
    }
    .incr-btn-cart {
        background: rgba(255,212,36,.9);
    }
    incr-btn-cart:hover {
        color: #fff;
        background: #0286c2;
    }
</style>

<!--Shopping Cart-->
<section class="shopping-cart">
    <!--Shopping Cart Message-->
    <div class="container">

        <div class="row">
            <!--Items List-->
            <div class="col-lg-9 col-md-9">
                <h2 class="title">รายการสินค้าทั้งหมด</h2>
                <table class="items-list">
                    <!--<tr>
                        <th>&nbsp;</th>
                        <th>name</th>
                        <th class="text-right">price&nbsp;</th>
                    </tr>
                    Item-->
                    <?php
                    foreach ($GetOrderMasters as $item) {
                        // throw new \yii\base\Exception(print_r($item["image"], true));
                        if ($item->receiveType == 1) {// lockers เย็น
                            ?>
                            <tr style=" font-size: 12px; ">
                                <td colspan="3" >
                                    <h4 class="title"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;สถานที่รับของ : ปลายทางที่ล็อคเกอร์เย็น </h4>
                                </td>
                            </tr>
                            <?php
                            foreach ($itemsLockersCool as $value1) {
                                $product = common\models\costfit\Product::find()->where('productId=' . $value1['productId'])->one();
                                ?>
                                <tr class="item first" id="item<?= $item['orderItemId'] ?>">
                                    <?= Html::hiddenInput("productId", $value1["productId"], ['id' => 'productId']); ?>
                                    <?= Html::hiddenInput("productSuppId", $value1["productSuppId"], ['id' => 'productSuppId']); ?>
                                    <?= Html::hiddenInput("sendDate", $value1["sendDate"], ['id' => 'sendDate']); ?>
                                    <td class="thumb"><a href="<?php echo Yii::$app->homeUrl; ?>products/<?php echo ModelMaster::encodeParams(['productId' => $value1["productId"], 'productSupplierId' => $value1['productSuppId']]); ?>"><img src="<?php echo Yii::$app->homeUrl . common\models\costfit\ProductSuppliers::productImageSuppliers($value1['productSuppId']); ?>" alt="Lorem ipsum" width="152" height="119"/></a></td>
                                    <td class="name" style="width:55%">
                                        <a href="<?php echo Yii::$app->homeUrl; ?>products/<?php echo ModelMaster::encodeParams(['productId' => $value1["productId"], 'productSupplierId' => $value1['productSuppId']]); ?>" style="font-size:14px;word-wrap: break-word; "><?= $product["title"] ?></a>&nbsp;&nbsp;<span style="color: #ff9016; font-size: 14px;">(จำนวน <?= $value1["quantity"] ?> ชิ้น)</span>
                                    </td>
                                    <td class="text-right">
                                        <span class="price" style="font-weight: bold; color: #000;"><?= number_format($value1["priceOnePiece"], 2) . " ฿" ?></span> <br>
                                        <?php if (isset($value1["sendDateNoDate"])): ?>
                                            <span style="font-size: 13px; color: #0286c2;">จัดส่งภายใน <?= $value1["sendDateNoDate"] ?>  วัน </span><br>
                                            <span class="shipSavings <?= ($value1["shippingDiscountValue"] == 0) ? " hide" : " " ?>" style="color: red;font-size: 13px;">Shipping Saved <?= number_format($value1["shippingDiscountValue"], 2) ?> ฿</span><br>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        if ($item->receiveType == 2) {// lockers ร้อน
                            ?>
                            <tr style=" font-size: 12px; ">
                                <td colspan="3" >
                                    <h4 class="title"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;สถานที่รับของ : ปลายทางที่ล็อคเกอร์ร้อน </h4>
                                </td>
                            </tr>
                            <?php
                            foreach ($itemsLockers as $value1) {
                                $product = common\models\costfit\Product::find()->where('productId=' . $value1['productId'])->one();
                                ?>
                                <tr class="item first" id="item<?= $item['orderItemId'] ?>">
                                    <?= Html::hiddenInput("productId", $value1["productId"], ['id' => 'productId']); ?>
                                    <?= Html::hiddenInput("productSuppId", $value1["productSuppId"], ['id' => 'productSuppId']); ?>
                                    <?= Html::hiddenInput("sendDate", $value1["sendDate"], ['id' => 'sendDate']); ?>
                                    <td class="thumb"><a href="<?php echo Yii::$app->homeUrl; ?>products/<?php echo ModelMaster::encodeParams(['productId' => $value1["productId"], 'productSupplierId' => $value1['productSuppId']]); ?>"><img src="<?php echo Yii::$app->homeUrl . common\models\costfit\ProductSuppliers::productImageSuppliers($value1['productSuppId']); ?>" alt="Lorem ipsum" width="152" height="119"/></a></td>
                                    <td class="name" style="width:55%">
                                        <a href="<?php echo Yii::$app->homeUrl; ?>products/<?php echo ModelMaster::encodeParams(['productId' => $value1["productId"], 'productSupplierId' => $value1['productSuppId']]); ?>" style="font-size:14px;word-wrap: break-word; "><?= $product["title"] ?></a>&nbsp;&nbsp;<span style="color: #ff9016; font-size: 14px;">(จำนวน <?= $value1["quantity"] ?> ชิ้น)</span>
                                    </td>
                                    <td class="text-right">
                                        <span class="price" style="font-weight: bold; color: #000;"><?= number_format($value1["priceOnePiece"], 2) . " ฿" ?></span> <br>
                                        <?php if (isset($value1["sendDateNoDate"])): ?>
                                            <span style="font-size: 13px; color: #0286c2;">จัดส่งภายใน <?= $value1["sendDateNoDate"] ?>  วัน </span><br>
                                            <span class="shipSavings <?= ($value1["shippingDiscountValue"] == 0) ? " hide" : " " ?>" style="color: red;font-size: 13px;">Shipping Saved <?= number_format($value1["shippingDiscountValue"], 2) ?> ฿</span><br>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        if ($item->receiveType == 3) {// Booths
                            ?>
                            <tr>
                                <td colspan="3" >
                                    &nbsp;
                                </td>
                            </tr>
                            <tr style="font-size: 12px;  ">
                                <td colspan="3" >
                                    <h4 class="title"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;สถานที่รับของ : ปลายทางที่บูธ </h4>
                                </td>
                            </tr>
                            <?php
                            foreach ($itemsBooth as $value1) {
                                $product = common\models\costfit\Product::find()->where('productId=' . $value1['productId'])->one();
                                ?>
                                <tr class="item first" id="item<?= $item['orderItemId'] ?>">
                                    <?= Html::hiddenInput("productId", $value1["productId"], ['id' => 'productId']); ?>
                                    <?= Html::hiddenInput("productSuppId", $value1["productSuppId"], ['id' => 'productSuppId']); ?>
                                    <?= Html::hiddenInput("sendDate", $value1["sendDate"], ['id' => 'sendDate']); ?>
                                    <td class="thumb"><a href="<?php echo Yii::$app->homeUrl; ?>products/<?php echo ModelMaster::encodeParams(['productId' => $value1["productId"], 'productSupplierId' => $value1['productSuppId']]); ?>"><img src="<?php echo Yii::$app->homeUrl . common\models\costfit\ProductSuppliers::productImageSuppliers($value1['productSuppId']); ?>" alt="Lorem ipsum" width="152" height="119"/></a></td>
                                    <td class="name" style="width:55%">
                                        <a href="<?php echo Yii::$app->homeUrl; ?>products/<?php echo ModelMaster::encodeParams(['productId' => $value1["productId"], 'productSupplierId' => $value1['productSuppId']]); ?>" style="font-size:14px;word-wrap: break-word; "><?= $product["title"] ?></a>&nbsp;&nbsp;<span style="color: #ff9016; font-size: 14px;">(จำนวน <?= $value1["quantity"] ?> ชิ้น)</span>
                                    </td>
                                    <td  class="text-right">
                                        <span class="price" style="font-weight: bold; color: #000;"><?= number_format($value1["priceOnePiece"], 2) . " ฿" ?></span> <br>
                                        <?php if (isset($value1["sendDateNoDate"])): ?>
                                            <span style="font-size: 13px; color: #0286c2;">จัดส่งภายใน <?= $value1["sendDateNoDate"] ?>  วัน </span><br>
                                            <span class="shipSavings <?= ($value1["shippingDiscountValue"] == 0) ? " hide" : " " ?>" style="color: red;font-size: 13px;">Shipping Saved <?= number_format($value1["shippingDiscountValue"], 2) ?> ฿</span><br>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        <?= Html::hiddenInput("orderId", $this->params['cart']['orderId'], ['id' => 'orderId']); ?>
                        <?php
                    }
                    ?>
                </table>
            </div>
            <!--Sidebar-->
            <div class="col-lg-3 col-md-3">
                <h3>Cart totals</h3>
                <form class="cart-sidebar">
                    <div class="cart-totals">
                        <?php echo $this->render('@app/views/cart/cart_totals_right'); ?>
                        <!-- coupon -->
                        <?php //echo $this->render('@app/views/coupon/coupon');            ?>
                        <!--<input type="button" class="btn btn-primary btn-sm btn-block" name="update-cart" value="Update shopping cart" onclick="proceed('update_cart')">-->
                        <?php if (!Yii::$app->user->isGuest) { ?>
                            <input type="button" class="btn btn-black btn-block" name="to-checkout" value="Proceed to checkout" onclick="proceed('to_checkout')">
                        <?php } else { ?>
                            <input type="button" class="btn btn-black btn-block" name="to-checkout" value="Proceed to checkout" onclick="proceed('to_guest')">
                        <?php } ?>
                    </div>

                    <a class="panel-toggle hide" href="#calc-shipping"><h3>Calculate shipping</h3></a>

                </form>
            </div>
        </div>
    </div>
</section><!--Shopping Cart Close-->

<!--Catalog Grid-->
<section class = "catalog-grid">
    <div class = "container">
        <?php
        if (count($products) > 0):
            ?>
            <h2>You may also like</h2>
        <?php endif; ?>
        <div class = "row">
            <?php
            if (count($products) > 0):
                foreach ($products as $product) {
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="tile">
                            <div class="price-label"><?php echo number_format($product->price, 2); ?></div>
                            <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product->encodeParams(['productId' => $product->productId, 'productSupplierId' => $product->productSuppId]) ?>">
                                <?php
                                if (isset($product->images->imageThumbnail1)) {
                                    ?>
                                    <img src="<?php echo Yii::$app->homeUrl . $product->images->imageThumbnail1; ?>" alt="1"/>
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo $baseUrl; ?>/images/ContentGroup/DUHWYsdXVc.png" alt="1"/>
                                    <?php
                                }
                                ?>
                                <span class="tile-overlay"></span>
                            </a>
                            <div class="footer">
                                <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product->encodeParams(['productId' => $product->productId, 'productSupplierId' => $product->productSuppId]) ?>"><?= $product->title ?></a>
                                <span>by Cozxy.com</span>
                                <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product->encodeParams(['productId' => $product->productId, 'productSupplierId' => $product->productSuppId]) ?>"><button class="btn btn-primary">View</button></a>
                            </div>
                        </div>
                    </div>
                    <?php
                    // $index = $index++;
                }
            endif;
            ?>
        </div>
    </div>
</section>
<!--Catalog Grid Close-->

