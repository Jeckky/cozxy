<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Wishlist-->
<section class="wishlist">
    <div class="container">
        <div class="row">

            <!--Items List-->
            <div class="col-lg-9 col-md-9">
                <h2 class="title">Wishlist</h2>
                <section class="cart-message">
                    <i class="fa fa-check-square"></i>
                    <p class="p-style3">"Nikon" was successfully added to your cart.</p>
                    <a class="btn-outlined-invert btn-black btn-sm" href="<?php echo Yii::$app->homeUrl; ?>cart">View cart</a>
                </section><!--Shopping Cart Message Close-->
                <table class="items-list">
                    <tr>
                        <th>&nbsp;</th>
                        <th>Product name</th>
                        <th>Product price</th>
                    </tr>
                    <!--Item-->
                    <?php foreach ($wishlists as $wishlist): ?>
                        <tr class="item first">
                            <?= Html::hiddenInput("productId", $wishlist->productId, ['id' => 'productId']); ?>
                            <td class="title hide" ><?= $wishlist->product->title; ?></td>
                            <td class="thumb"><a href="<?php echo Yii::$app->homeUrl ?>products/<?= $wishlist->encodeParams(['productId' => $wishlist->productId]) ?>"><img src="<?php echo Yii::$app->homeUrl . $wishlist->product->productImages[0]->image; ?>" alt="Lorem ipsum" class="img-responsive"/></a></td>
                            <td class="name" style="font-size: 14px;"><a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $wishlist->encodeParams(['productId' => $wishlist->productId]) ?>"><?= $wishlist->product->title; ?></a></td>
                            <td class="price"><?= $wishlist->product->calProductPrice($wishlist->productId, 1); ?></td>
                            <td class="button">
                                <?= Html::hiddenInput("quantity", 1, ['id' => 'quantity']); ?>
                                <a class="btn btn-primary btn-sm addWishlistItemToCart" href="#" <?= ($wishlist->product->findMaxQuantity($wishlist->productId) <= 0) ? " disabled" : " " ?>><i class="icon-shopping-cart"></i>Add to cart</a>
                            </td>
                            <td class="delete" id='deleteWishlist'><i class="icon-delete"></i></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <!--Sidebar-->
            <div class="col-lg-3 col-md-3">
                <?php echo $this->render('@app/views/coupon/coupon'); ?>
                <!--Top items
                <h3 class="space-top">Top items</h3>
                <div class="top-item">
                    <div class="price-label">715,00 $</div>
                    <a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888"><img src="<?php echo $directoryAsset; ?>/img/offers/special-offer.png" alt="Special Offer"/></a>
                    <div class="footer"><a href="#">The Buccaneer</a></div>
                </div>
                <div class="top-item">
                    <div class="price-label">715,00 $</div>
                    <a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888"><img src="<?php echo $directoryAsset; ?>/img/offers/special-offer.png" alt="Special Offer"/></a>
                    <div class="footer"><a href="#">The Buccaneer</a></div>
                </div>-->
            </div>
        </div>
    </div>
</section><!--Wishlist Close-->

<!--Catalog Grid-->
<section class="catalog-grid">
    <div class="container">
        <h2>You may also like</h2>
        <div class="row">
            <?php if (count($product) > 0) { ?>
                <!--Tile-->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile">
                        <div class="badges">
                            <span class="sale">Sale</span>
                        </div>
                        <div class="price-label"><?php echo $product[0]->price; ?></div>
                        <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product[0]->encodeParams(['productId' => $product[0]->productId]) ?>">
                            <?php
                            if (isset($product[0]->productImages[0]->imageThumbnail1)) {
                                ?>
                                <img src="<?php echo Yii::$app->homeUrl . $product[0]->productImages[0]->imageThumbnail1; ?>" alt="1"/>
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
                            <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product[0]->encodeParams(['productId' => $product[0]->productId]) ?>"><?= $product[0]->title ?></a>
                            <span></span>
                            <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product[0]->encodeParams(['productId' => $product[0]->productId]) ?>"><button class="btn btn-primary">View</button></a>
                        </div>
                    </div>
                </div>
                <!--Tile-->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile">
                        <div class="badges">
                            <span class="out">Out</span>
                        </div>
                        <div class="price-label"><?php echo $product[1]->price; ?></div>
                        <div class="price-label old-price"><?php echo $product[1]->price; ?></div>
                        <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product[1]->encodeParams(['productId' => $product[1]->productId]) ?>">
                            <?php
                            if (isset($product[1]->productImages[0]->imageThumbnail1)) {
                                ?>
                                <img src="<?php echo Yii::$app->homeUrl . $product[1]->productImages[0]->imageThumbnail1; ?>" alt="1"/>
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
                            <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product[1]->encodeParams(['productId' => $product[1]->productId]) ?>"><?= $product[1]->title ?></a>
                            <span></span>
                            <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product[1]->encodeParams(['productId' => $product[1]->productId]) ?>"><button class="btn btn-primary">View</button></a>
                        </div>
                    </div>
                </div>
                <!--Tile-->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile">
                        <div class="badges">
                            <span class="best-seller">Best Saller</span>
                        </div>
                        <div class="price-label"><?php echo $product[2]->price; ?></div>
                        <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product[2]->encodeParams(['productId' => $product[2]->productId]) ?>">
                            <?php
                            if (isset($product[2]->productImages[0]->imageThumbnail1)) {
                                ?>
                                <img src="<?php echo Yii::$app->homeUrl . $product[2]->productImages[0]->imageThumbnail1; ?>" alt="1"/>
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
                            <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product[2]->encodeParams(['productId' => $product[2]->productId]) ?>"><?= $product[2]->title ?></a>
                            <span></span>
                            <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product[2]->encodeParams(['productId' => $product[2]->productId]) ?>"><button class="btn btn-primary">View</button></a>
                        </div>
                    </div>
                </div>
                <!--Tile-->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile">

                        <div class="price-label"><?php echo $product[3]->price; ?></div>
                        <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product[3]->encodeParams(['productId' => $product[3]->productId]) ?>">
                            <?php
                            if (isset($product[3]->productImages[0]->imageThumbnail1)) {
                                ?>
                                <img src="<?php echo Yii::$app->homeUrl . $product[3]->productImages[0]->imageThumbnail1; ?>" alt="1"/>
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
                            <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product[3]->encodeParams(['productId' => $product[3]->productId]) ?>"><?= $product[3]->title ?></a>
                            <span></span>
                            <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $product[3]->encodeParams(['productId' => $product[3]->productId]) ?>"><button class="btn btn-primary">View</button></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section><!--Catalog Grid Close-->

