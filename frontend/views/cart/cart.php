<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
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
                        ?>
                        <tr class="item first" id="item<?= $item['orderItemId'] ?>">
                            <?= Html::hiddenInput("productId", $item["productId"], ['id' => 'productId']); ?>
                            <td class="thumb"><a href="<?php echo Yii::$app->homeUrl; ?>products?productId=<?php echo $item["productId"]; ?>"><img src="<?php echo $item["image"]; ?>" alt="Lorem ipsum" width="152" height="119"/></a></td>
                            <td class="name">
                                <a href="<?php echo Yii::$app->homeUrl; ?>products?productId=<?php echo $item["productId"]; ?>" style="font-size:14px;word-wrap: break-word; "><?= $item["title"] ?></a>
                            </td>
                            <td class="price"><?= $item["price"] . " ฿" ?></td>
                            <td class="qnt-count">
                                <a class="incr-btn-cart incr-btn" href="#">-</a>
                                <input class="quantity form-control" style="font-size: 14px" type="text" value="<?= $item["qty"] ?>">
                                <a class="incr-btn-cart incr-btn" href="#">+</a>
                            </td>
                            <td class="total"><?= $item["qty"] * $item["price"] . " ฿" ?></td>
                            <td class="delete"><i class="icon-delete"></i><?= yii\helpers\Html::hiddenInput("orderItemId", $item['orderItemId'], ['id' => 'orderItemId']); ?></td>
                        </tr>
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

<!--Catalog Grid
<section class = "catalog-grid">
    <div class = "container">
        <h2>You may also like</h2>
        <div class = "row">
<?php //for ($index = 0; $index <= 3; $index++) {
?>

        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="tile">
                <div class="price-label">715,00 $</div>
                <a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888">
                    <img src="<?php echo $directoryAsset; ?>/img/catalog/1.png" alt="1"/>
                    <span class="tile-overlay"></span>
                </a>
                <div class="footer">
                    <a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888">The Buccaneer</a>
                    <span>by Pirate3d</span>
                    <a href="<?php echo Yii::$app->homeUrl; ?>cart"><button class="btn btn-primary">Add to Cart</button></a>
                </div>
            </div>
        </div>
<?php
//$index = $index++;
//}
?>

</div>
</div>
</section> Catalog Grid Close-->

