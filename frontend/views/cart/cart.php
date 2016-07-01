<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Breadcrumbs-->
<ol class="breadcrumb">
    <li><a href="<?php echo $baseUrl; ?>">Home</a></li>
    <li>Shopping cart</li>
</ol><!--Breadcrumbs Close-->

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
                    <tr class="item first">
                        <td class="thumb"><a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888"><img src="<?php echo $directoryAsset; ?>/img/catalog/shopping-cart-thumb.jpg" alt="Lorem ipsum"/></a></td>
                        <td class="name"><a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888">Wristlet</a></td>
                        <td class="price">715,00 $</td>
                        <td class="qnt-count">
                            <a class="incr-btn" href="#">-</a>
                            <input class="quantity form-control" type="text" value="2">
                            <a class="incr-btn" href="#">+</a>
                        </td>
                        <td class="total">2715,00 $</td>
                        <td class="delete"><i class="icon-delete"></i></td>
                    </tr>
                    <!--Item-->
                    <tr class="item">
                        <td class="thumb"><a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888"><img src="<?php echo $directoryAsset; ?>/img/catalog/shopping-cart-thumb.jpg" alt="Lorem ipsum"/></a></td>
                        <td class="name"><a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888">Wristlet</a></td>
                        <td class="price">715,00 $</td>
                        <td class="qnt-count">
                            <a class="incr-btn" href="#">-</a>
                            <input class="quantity form-control" type="text" value="2">
                            <a class="incr-btn" href="#">+</a>
                        </td>
                        <td class="total">2715,00 $</td>
                        <td class="delete"><i class="icon-delete"></i></td>
                    </tr>
                    <!--Item-->
                    <tr class="item">
                        <td class="thumb"><a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888"><img src="<?php echo $directoryAsset; ?>/img/catalog/shopping-cart-thumb.jpg" alt="Lorem ipsum"/></a></td>
                        <td class="name"><a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888">Wristlet</a></td>
                        <td class="price">715,00 $</td>
                        <td class="qnt-count">
                            <a class="incr-btn" href="#">-</a>
                            <input class="quantity form-control" type="text" value="2">
                            <a class="incr-btn" href="#">+</a>
                        </td>
                        <td class="total">2715,00 $</td>
                        <td class="delete"><i class="icon-delete"></i></td>
                    </tr>
                    <!--Item-->
                    <tr class="item">
                        <td class="thumb"><a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888"><img src="<?php echo $directoryAsset; ?>/img/catalog/shopping-cart-thumb.jpg" alt="Lorem ipsum"/></a></td>
                        <td class="name"><a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888">Wristlet</a></td>
                        <td class="price">715,00 $</td>
                        <td class="qnt-count">
                            <a class="incr-btn" href="#">-</a>
                            <input class="quantity form-control" type="text" value="2">
                            <a class="incr-btn" href="#">+</a>
                        </td>
                        <td class="total">2715,00 $</td>
                        <td class="delete"><i class="icon-delete"></i></td>
                    </tr>
                </table>
            </div>

            <!--Sidebar-->
            <div class="col-lg-3 col-md-3">
                <h3>Cart totals</h3>
                <form class="cart-sidebar" method="post">
                    <div class="cart-totals">
                        <table>
                            <tr>
                                <td>Cart subtotal</td>
                                <td class="total align-r">2715,00 $</td>
                            </tr>
                            <tr class="devider">
                                <td>Shipping</td>
                                <td class="align-r">Free shipping</td>
                            </tr>
                            <tr>
                                <td>Order total</td>
                                <td class="total align-r">2715,00 $</td>
                            </tr>
                        </table>

                        <h3>Have a coupon?</h3>
                        <div class="coupon">
                            <div class="form-group">
                                <label class="sr-only" for="coupon-code">Enter coupon code</label>
                                <input type="text" class="form-control" id="coupon-code" name="coupon-code" placeholder="Enter coupon code">
                            </div>
                            <input type="submit" class="btn btn-primary btn-sm btn-block" name="apply-coupon" value="Apply coupon">
                        </div>

                        <input type="submit" class="btn btn-primary btn-sm btn-block" name="update-cart" value="Update shopping cart">
                        <input type="submit" class="btn btn-black btn-block" name="to-checkout" value="Proceed to checkout">
                    </div>

                    <a class="panel-toggle" href="#calc-shipping"><h3>Calculate shipping</h3></a>
                    <div class="hidden-panel calc-shipping" id="calc-shipping">
                        <div class="form-group">
                            <div class="select-style">
                                <select name="country">
                                    <option>Australia</option>
                                    <option>Belgium</option>
                                    <option>Germany</option>
                                    <option>United Kingdom</option>
                                    <option>Switzerland</option>
                                    <option>USA</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="state">State/ province</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="State/ province">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="postcode">Postcode/ ZIP</label>
                            <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode/ ZIP">
                        </div>
                        <input type="submit" class="btn btn-primary btn-sm btn-block" name="update-totals" value="Update totals">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section><!--Shopping Cart Close-->

<!--Catalog Grid-->
<section class="catalog-grid">
    <div class="container">
        <h2>You may also like</h2>
        <div class="row">
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
                        <button class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div>
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
                        <button class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div>
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
                        <button class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div>
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
                        <button class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--Catalog Grid Close-->

<!--Brands Carousel Widget-->

<?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>
