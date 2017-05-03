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
                    <p class="p-style3"><!--"Nikon" was--> successfully added to your cart.</p>
                    <a class="btn-outlined-invert btn-black btn-sm" href="<?php echo Yii::$app->homeUrl; ?>cart">View cart</a>
                </section><!--Shopping Cart Message Close-->
                <table class="items-list">
                    <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    <!--Item-->
                    <?php
                    foreach ($wishlists as $wishlist):
                        if (isset($wishlist->productSuppliers)) {
                            ?>
                            <tr class="item first">
                                <?= Html::hiddenInput("fastId", $fastId = common\models\costfit\Product::getShippingTypeId($wishlist->productSuppliers->productId), ['id' => 'fastId']); ?>
                                <?= Html::hiddenInput("productId", $wishlist->productSuppliers->productId, ['id' => 'productId']); ?>
                                <?= Html::hiddenInput("supplierId", common\models\costfit\ProductSuppliers::supplier($wishlist->productId), ['id' => 'supplierId']); ?>
                                <?= Html::hiddenInput("productSuppId", $wishlist->productId, ['id' => 'productSuppId']); ?>
                            <input type="hidden" id="maxQnty<?= $wishlist->productId ?>" value="<?= $products->findMaxQuantitySupplier($wishlist->productId) ?>">
                            <td class="title hide" style="height: 60px;">
                                <?= substr($wishlist->productSuppliers->title, 0, 35); ?>
                            </td>
                            <td class="thumb" style="padding:5px">
                                <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $wishlist->encodeParams(['productId' => $wishlist->productSuppliers->productId, 'productSupplierId' => $wishlist->productId]) ?>"><img src="<?php echo Yii::$app->homeUrl . $wishlist->productSuppliers->images->image; ?>" alt="Lorem ipsum" class="img-responsive"/></a></td>
                            <td class="name" style="font-size: 14px;padding:5px; width: 60%;">
                                <a href="<?php echo Yii::$app->homeUrl; ?>products/<?= $wishlist->encodeParams(['productId' => $wishlist->productSuppliers->productId, 'productSupplierId' => $wishlist->productId]) ?>">
                                    <?= substr($wishlist->productSuppliers->title, 0, 35); ?></a></td>
                            <td class="price">
                                <?php
                                if (number_format($products->calProductPrice($wishlist->productId, 1), 2) == '0.00') {
                                    echo '';
                                } else {
                                    echo number_format($products->calProductPrice($wishlist->productId, 1), 2);
                                }
                                ?>
                                <?//= number_format($products->calProductPrice($wishlist->productId, 1), 2); ?>
                            </td><!--
                            <td class="button">
                            <?= Html::hiddenInput("quantity", 1, ['id' => 'quantity']); ?>
                                <a class="btn btn-primary btn-sm addWishlistItemToCart" id="addWishlistItemToCart<?//= $wishlist->productId ?>"href="#" <?//= ($products->findMaxQuantitySupplier($wishlist->productId) <= 0) ? " disabled" : " " ?>><i class="icon-shopping-cart"></i>Add to cart</a>
                            </td>-->
                            <td class="delete" id='deleteWishlist'><i class="icon-delete"></i></td>
                            </tr>
                            <?php
                        }
                    endforeach;
                    ?>
                </table>
            </div>

            <!--Sidebar-->
            <div class="col-lg-3 col-md-3">
                <?php //echo $this->render('@app/views/coupon/coupon'); ?>
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
            <?php
            if (count($notInWislist) > 0) {
                foreach ($notInWislist as $productSupp):
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="tile">
                            <!--<div class="badges">
                                <span class="sale">Sale</span>
                            </div>-->
                            <?//= number_format(common\models\costfit\ProductSuppliers::productPriceSupplier($productSupp->productSuppId), 2) ?>
                            <?php
                            if (number_format(common\models\costfit\ProductSuppliers::productPriceSupplier($productSupp->productSuppId), 2) == '0.00') {
                                echo '';
                            } else {
                                echo '<div class="price-label">' . number_format(common\models\costfit\ProductSuppliers::productPriceSupplier($productSupp->productSuppId), 2) . ' </div>';
                            }
                            ?>

                            <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $productSupp->encodeParams(['productId' => $productSupp->productId, 'productSupplierId' => $productSupp->productSuppId]) ?>">
                                <?php
                                if (isset($productSupp->images->imageThumbnail1)) {
                                    ?>
                                    <img src="<?php echo Yii::$app->homeUrl . $productSupp->images->imageThumbnail1; ?>" alt="1"/>
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
                                <div style="height: 60px">
                                    <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $productSupp->encodeParams(['productId' => $productSupp->productId, 'productSupplierId' => $productSupp->productSuppId]) ?>">
                                        <?= substr($productSupp->title, 0, 35); ?>
                                    </a>
                                </div>

                                <span></span>
                                <a href="<?php echo Yii::$app->homeUrl ?>products/<?= $productSupp->encodeParams(['productId' => $productSupp->productId, 'productSupplierId' => $productSupp->productSuppId]) ?>"><button class="btn btn-primary">View</button></a>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
            }
            ?>
        </div>
    </div>
</section><!--Catalog Grid Close-->
<!-- <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile">
                        <div class="badges">
                            <span class="out">Out</span>
                        </div>
                        <div class="price-label"><?php //echo $product[1]->price;                                                       ?></div>
                        <div class="price-label old-price"><?php // echo $product[1]->price;                                                      ?></div>
                        <a href="<?php // echo Yii::$app->homeUrl                                                      ?>products/<?//= $product[1]->encodeParams(['productId' => $product[1]->productId]) ?>">
<?php
// if (isset($product[1]->productImages[0]->imageThumbnail1)) {
?>
                                <img src="<?php // echo Yii::$app->homeUrl . $product[1]->productImages[0]->imageThumbnail1;                                                      ?>" alt="1"/>
<?php
// } else {
?>
                                <img src="<?php // echo $baseUrl;                                                      ?>/images/ContentGroup/DUHWYsdXVc.png" alt="1"/>
<?php
//  }
?>
                            <span class="tile-overlay"></span>
                        </a>
                        <div class="footer">
                            <a href="<?php // echo Yii::$app->homeUrl                                                       ?>products/<?//= $product[1]->encodeParams(['productId' => $product[1]->productId]) ?>"><?//= $product[1]->title ?></a>
                            <span></span>
                            <a href="<?php // echo Yii::$app->homeUrl                                                       ?>products/<?//= $product[1]->encodeParams(['productId' => $product[1]->productId]) ?>"><button class="btn btn-primary">View</button></a>
                        </div>
                    </div>
                </div>
                Tile
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile">
                        <div class="badges">
                            <span class="best-seller">Best Saller</span>
                        </div>
                        <div class="price-label"><?php // echo $product[2]->price;                                                      ?></div>
                        <a href="<?php //echo Yii::$app->homeUrl                                                      ?>products/<?//= $product[2]->encodeParams(['productId' => $product[2]->productId]) ?>">
<?php
//  if (isset($product[2]->productImages[0]->imageThumbnail1)) {
//
?>
                                <img src="<?php //echo Yii::$app->homeUrl . $product[2]->productImages[0]->imageThumbnail1;                                                     ?>" alt="1"/>
<?php
//   } else {
?>
                                <img src="<?php // echo $baseUrl;                                                     ?>/images/ContentGroup/DUHWYsdXVc.png" alt="1"/>
<?php
// }
?>
                            <span class="tile-overlay"></span>
                        </a>
                        <div class="footer">
                            <a href="<?php // echo Yii::$app->homeUrl                                                       ?>products/<?//= $product[2]->encodeParams(['productId' => $product[2]->productId]) ?>"><?//= $product[2]->title ?></a>
                            <span></span>
                            <a href="<?php //echo Yii::$app->homeUrl                                                       ?>products/<?//= $product[2]->encodeParams(['productId' => $product[2]->productId]) ?>"><button class="btn btn-primary">View</button></a>
                        </div>
                    </div>
                </div>
                Tile
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="tile">

                        <div class="price-label"><?php //echo $product[3]->price;                                                      ?></div>
                        <a href="<?php //echo Yii::$app->homeUrl                                                     ?>products/<?//= $product[3]->encodeParams(['productId' => $product[3]->productId]) ?>">
<?php
/// if (isset($product[3]->productImages[0]->imageThumbnail1)) {
?>
                                <img src="<?php //echo Yii::$app->homeUrl . $product[3]->productImages[0]->imageThumbnail1;                                                     ?>" alt="1"/>
<?php
// } else {
?>
                                <img src="<?php //echo $baseUrl;                                                     ?>/images/ContentGroup/DUHWYsdXVc.png" alt="1"/>
<?php
//  }
?>

                            <span class="tile-overlay"></span>
                        </a>
                        <div class="footer">
                            <a href="<?php // echo Yii::$app->homeUrl                                                       ?>products/<?//= $product[3]->encodeParams(['productId' => $product[3]->productId]) ?>"><?//= $product[3]->title ?></a>
                            <span></span>
                            <a href="<?php // echo Yii::$app->homeUrl                                                       ?>products/<?//= $product[3]->encodeParams(['productId' => $product[3]->productId]) ?>"><button class="btn btn-primary">View</button></a>
                        </div>
                    </div>
                </div>-->
