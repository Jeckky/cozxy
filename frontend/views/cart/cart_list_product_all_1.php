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
        <?php
        if (isset($this->params['cart']['orderMessage'])):
            $this->registerJs("$('.order-message').addClass('visible');", yii\web\View::POS_READY);
            ?>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <section class="order-message">
                        <i class="fa fa-check-square"></i>
                        <p class="p-style3"><?= $this->params['cart']['orderMessage'] ?></p>
                        <!--<a class="btn-outlined-invert btn-black btn-sm" href="<?php echo Yii::$app->homeUrl; ?>cart">View cart</a>-->
                    </section><!--Shopping Cart Message Close-->
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php
            //echo '<pre>';
            //print_r($this->params['cart']['items']);
            ?>
            <!--Items List-->
            <div class="col-lg-9 col-md-9">
                <h2 class="title">Shopping cart</h2>
                <table class="items-list">
                    <tr>
                        <th>&nbsp;</th>
                        <th>Product name</th>
                        <th>Product price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    <!--Item-->
                    <?php
                    foreach ($this->params['cart']['items'] as $item) {
                        // throw new \yii\base\Exception(print_r($item["image"], true));
                        ?>
                        <tr class="item first" id="item<?= $item['orderItemId'] ?>">
                            <?= Html::hiddenInput("productId", $item["productId"], ['id' => 'productId']); ?>
                            <?= Html::hiddenInput("productSuppId", $item["productSuppId"], ['id' => 'productSuppId']); ?>
                            <?= Html::hiddenInput("sendDate", $item["sendDate"], ['id' => 'sendDate']); ?>
                            <td class="thumb"><a href="<?php echo Yii::$app->homeUrl; ?>products/<?php echo ModelMaster::encodeParams(['productId' => $item["productId"], 'productSupplierId' => $item['productSuppId']]); ?>"><img src="<?php echo Yii::$app->homeUrl . common\models\costfit\ProductSuppliers::productImageSuppliers($item['productSuppId']); ?>" alt="Lorem ipsum" width="152" height="119"/></a></td>
                            <td class="name" style="width:30%">
                                <a href="<?php echo Yii::$app->homeUrl; ?>products/<?php echo ModelMaster::encodeParams(['productId' => $item["productId"], 'productSupplierId' => $item['productSuppId']]); ?>" style="font-size:14px;word-wrap: break-word; "><?= $item["title"] ?></a>
                            </td>
                            <td>
                                <span style="text-decoration: line-through; color:#ccc; font-weight: bold;"> <?= number_format($item["priceMarket"], 2) ?> ฿</span> <br>
                                <span class="price" style="font-weight: bold;"><?= number_format($item["priceOnePiece"], 2) . " ฿" ?></span> <br>
                                <span class="savings <?= ($item["discountValue"] == 0) ? " hide" : " " ?>" style="color: red;font-size: 13px;">You Saved <?= number_format($item["discountValue"], 2) ?> ฿</span><br>
                                <?php if (isset($item["sendDateNoDate"])): ?>
                                    <span style="font-size: 13px;">จัดส่งภายใน <?= $item["sendDateNoDate"] ?>  วัน </span><br>
                                    <span class="shipSavings <?= ($item["shippingDiscountValue"] == 0) ? " hide" : " " ?>" style="color: red;font-size: 13px;">Shipping Saved <?= number_format($item["shippingDiscountValue"], 2) ?> ฿</span><br>
                                <?php endif; ?>
                            </td>
                            <td class="qnt-count">
                                <a class="incr-btn-cart " href="#">-</a>
                                <input class="quantity form-control" style="font-size: 14px" type="text" value="<?= $item["qty"] ?>" readonly="true">
                                <a class="incr-btn-cart" href="#">+</a>
                            </td>
                            <td class="total"><?= number_format($item["subTotal"], 2) . " ฿" ?></td>
                            <td class="delete"><i class="icon-delete"></i><?= yii\helpers\Html::hiddenInput("orderItemId", $item['orderItemId'], ['id' => 'orderItemId']); ?></td>
                        </tr>
                        <?= Html::hiddenInput("orderId", $this->params['cart']['orderId'], ['id' => 'orderId']); ?>
                        <?php
                    }
                    ?>
                </table>
                <?php if (isset($this->params['cart']['items']) && !empty($this->params['cart']['items'])) { ?>
                    <div class="checkbox " id="showSlow">
                        <label style="color:rgba(255,212,36,.9">
                            <input type="checkbox" id="slowest" name="slowest" <?= (isset($this->params['cart']) && $this->params['cart']['isSlowest']) ? " checked" : "" ?>>  ต้องการส่งสินค้าช้าที่สุดเพื่อประหยัดค่าใช้จ่าย
                        </label>
                    </div>
                <?php } ?>
            </div>

            <!--Sidebar-->
            <div class="col-lg-3 col-md-3">
                <h3>Cart totals</h3>
                <form class="cart-sidebar">
                    <div class="cart-totals">
                        <?php echo $this->render('@app/views/cart/cart_totals_right'); ?>
                        <!-- coupon -->
                        <?php echo $this->render('@app/views/coupon/coupon'); ?>
                        <!--<input type="button" class="btn btn-primary btn-sm btn-block" name="update-cart" value="Update shopping cart" onclick="proceed('update_cart')">-->
                        <?php if (!Yii::$app->user->isGuest) { ?>
                            <input type="button" class="btn btn-black btn-block" name="to-checkout" value="Proceed to checkout" onclick="proceed('to_checkout')">
                        <?php } else { ?>
                            <input type="button" class="btn btn-black btn-block" name="to-checkout" value="Proceed to checkout" onclick="proceed('to_guest')">
                        <?php } ?>
                    </div>

                    <a class="panel-toggle hide" href="#calc-shipping"><h3>Calculate shipping</h3></a>
                    <div class = "hidden-panel calc-shipping" id = "calc-shipping">
                        <div class = "form-group">
                            <div class = "select-style">
                                <select name = "country">
                                    <option>Australia</option>
                                    <option>Belgium</option>
                                    <option>Germany</option>
                                    <option>United Kingdom</option>
                                    <option>Switzerland</option>
                                    <option>USA</option>
                                </select>
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "sr-only" for = "state">State/ province</label>
                            <input type = "text" class = "form-control" id = "state" name = "state" placeholder = "State/ province">
                        </div>
                        <div class = "form-group">
                            <label class = "sr-only" for = "postcode">Postcode/ ZIP</label>
                            <input type = "text" class = "form-control" id = "postcode" name = "postcode" placeholder = "Postcode/ ZIP">
                        </div>
                        <input type = "button" class = "btn btn-primary btn-sm btn-block" name = "update-totals" value = "Update totals" onclick = "proceed('calculate_shipping')">
                    </div>
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

