<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Shopping Cart-->
<section class="shopping-cart">
    <div class="container">
        <div class="row">

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
                        <tr class="item first">
                            <td class="thumb"><a href="<?php echo Yii::$app->homeUrl; ?>products?productId=<?php echo $item["productId"]; ?>"><img src="<?php echo $item["image"]; ?>" alt="Lorem ipsum"/></a></td>
                            <td class="name" style="font-size:16px"><a href="<?php echo Yii::$app->homeUrl; ?>products?productId=<?php echo $item["productId"]; ?>"><?= $item["title"] ?></a></td>
                            <td class="price"><?= $item["price"] . " ฿" ?></td>
                            <td class="qnt-count">
                                <a class="incr-btn" href="#">-</a>
                                <input class="quantity form-control" style="font-size: 14px" type="text" value="<?= $item["qty"] ?>">
                                <a class="incr-btn" href="#">+</a>
                            </td>
                            <td class="total"><?= $item["qty"] * $item["price"] . " ฿" ?></td>
                            <td class="delete"><i class="icon-delete"></i></td>
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
                        <table>
                            <tr>
                                <td>Cart subtotal</td>
                                <td class="total align-r"><?= number_format($this->params['cart']['total'], 2) ?></td>
                            </tr>
                            <tr class="devider">
                                <td>Shipping</td>
                                <td class="align-r"><?= (isset($this->params['cart']['shipping']) && $this->params['cart']['shipping'] == 0) ? "Free Shipping" : number_format($this->params['cart']['shipping'], 2) ?></td>
                            </tr>
                            <tr>
                                <td>Order total</td>
                                <td class="total align-r"><?= number_format($this->params ['cart']['summary'], 2) ?></td>
                            </tr>
                        </table>

                        <h3>Have a coupon?</h3>
                        <div class="coupon">
                            <div class="form-group">
                                <label class="sr-only" for="coupon-code">Enter coupon code</label>
                                <input type="text" class="form-control" id="coupon-code" name="coupon-code" placeholder="Enter coupon code">
                            </div>
                            <input type="button" class="btn btn-primary btn-sm btn-block" name="apply-coupon" value="Apply coupon" onclick="proceed('apply_coupon')">
                        </div>

                        <input type="button" class="btn btn-primary btn-sm btn-block" name="update-cart" value="Update shopping cart" onclick="proceed('update_cart')">
                        <input type="button" class="btn btn-black btn-block" name="to-checkout" value="Proceed to checkout" onclick="proceed('to_checkout')">
                    </div>

                    <a class="panel-toggle" href="#calc-shipping"><h3>Calculate shipping</h3></a>
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
        <h2>You may also like</h2>
        <div class = "row">
            <?php for ($index = 0; $index <= 3; $index++) {
                ?>
                <!--Tile-->
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
                $index = $index++;
            }
            ?>

        </div>
    </div>
</section><!--Catalog Grid Close-->


<script type="text/javascript">
    //apply-coupon
    //update-cart
    //to-checkout
    function proceed(data) {
        var shop_data = data;
        if (shop_data == 'apply_coupon') {
            window.location = '<?php echo $baseUrl; ?>';
        } else if (shop_data == 'update_cart') {
            window.location = '<?php echo $baseUrl; ?>' + '/history';
        } else if (shop_data == 'to_checkout') {
            window.location = '<?php echo $baseUrl; ?>' + '/checkout';
        } else if (shop_data == '') {
            //window.location = '<?php echo $baseUrl; ?>' ;
        } else {
            window.location = '<?php echo $baseUrl; ?>';
        }
    }

</script>
