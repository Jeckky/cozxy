<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Breadcrumbs-->
<ol class="breadcrumb">
    <li><a href="index.html">Home</a></li>
    <li><a href="shop-filters-left-3cols.html">Shop - filters left 3 cols</a></li>
    <li>Shop - single item v2</li>
</ol><!--Breadcrumbs Close-->

<!--Shopping Cart Message-->
<section class="cart-message">
    <i class="fa fa-check-square"></i>
    <p class="p-style3">"Nikon" was successfully added to your cart.</p>
    <a class="btn-outlined-invert btn-black btn-sm" href="shop-single-item-v2.html">View cart</a>
</section><!--Shopping Cart Message Close-->

<!--Catalog Single Item-->
<section class="catalog-single">
    <div class="container">
        <div class="row">

            <!--Product Description-->
            <div class="col-lg-6 col-md-6">
                <h1>Minaudière</h1>
                <div class="old-price">815,00 $</div>
                <div class="price">715,00 $</div>
                <div class="buttons group">
                    <div class="qnt-count">
                        <a class="incr-btn" href="#">-</a>
                        <input id="quantity" class="form-control" type="text" value="2">
                        <a class="incr-btn" href="#">+</a>
                    </div>
                    <a class="btn btn-primary btn-sm" id="addItemToCart" href="#"><i class="icon-shopping-cart"></i>Add to cart</a>
                    <a class="btn btn-black btn-sm" href="#"><i class="icon-heart"></i>Add to wishlist</a>
                </div>
                <p class="p-style2">Product page was developed with the help of consultants with great and successful experience in e-commerce. It's all you need to effectively demonstrate your product. The opportunity to quickly buy a product or save it to a wishlist will definitely increase the conversion rate.</p>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-5">
                        <h3>Tell friends</h3>
                        <div class="social-links">
                            <a href="#"><i class="fa fa-tumblr-square"></i></a>
                            <a href="#"><i class="fa fa-pinterest-square"></i></a>
                            <a href="#"><i class="fa fa-facebook-square"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-7">
                        <h3>Tags</h3>
                        <div class="tags">
                            <a href="#">Backpack</a>,
                            <a href="#">Chanel</a>,
                            <a href="#">Wristlet</a>
                        </div>
                    </div>
                </div>
                <div class="promo-labels">
                    <div data-content="This is a place for the unique commercial offer. Make it known."><i class="fa fa-truck"></i>Free delivery</div>
                    <div data-content="This is a place for the unique commercial offer. Make it known."><i class="fa fa-space-shuttle"></i>Deliver even on Mars</div>
                    <div data-content="This is a place for the unique commercial offer. Make it known."><i class="fa fa-shield"></i>Safe Buy</div>
                </div>
            </div>

            <!--Product Gallery-->
            <div class="col-lg-6 col-md-6">
                <div class="prod-gal master-slider" id="prod-gal">
                    <!--Slide1-->
                    <div class="ms-slide">
                        <img src="<?php echo $directoryAsset; ?>/masterslider/blank.gif" data-src="<?php echo $baseUrl; ?>/images/ProductImage/15.jpg" alt="Lorem ipsum"/>
                        <img class="ms-thumb" src="<?php echo $baseUrl; ?>/images/ProductImage/15.jpg" alt="thumb" />
                    </div>
                    <!--Slide2-->
                    <div class="ms-slide">
                        <img src="<?php echo $directoryAsset; ?>/masterslider/blank.gif" data-src="<?php echo $baseUrl; ?>/images/ProductImage/7.jpg" alt="Lorem ipsum"/>
                        <img class="ms-thumb" src="<?php echo $baseUrl; ?>/images/ProductImage/15.jpg" alt="thumb" />
                    </div>
                    <!--Slide3-->
                    <div class="ms-slide">
                        <img src="<?php echo $directoryAsset; ?>/masterslider/blank.gif" data-src="<?php echo $baseUrl; ?>/images/ProductImage/8.jpg" alt="Lorem ipsum"/>
                        <img class="ms-thumb" src="<?php echo $directoryAsset; ?>/img/catalog/product-gallery/th_1.jpg" alt="thumb" />
                    </div>
                    <!--Slide4-->
                    <div class="ms-slide">
                        <img src="<?php echo $directoryAsset; ?>/masterslider/blank.gif" data-src="<?php echo $baseUrl; ?>/images/ProductImage/9.jpg" alt="Lorem ipsum"/>
                        <img class="ms-thumb" src="<?php echo $directoryAsset; ?>/img/catalog/product-gallery/th_1.jpg" alt="thumb" />
                    </div>
                    <!--Slide5-->
                    <div class="ms-slide">
                        <img src="<?php echo $directoryAsset; ?>/masterslider/blank.gif" data-src="<?php echo $baseUrl; ?>/images/ProductImage/13.jpg" alt="Lorem ipsum"/>
                        <img class="ms-thumb" src="<?php echo $directoryAsset; ?>/img/catalog/product-gallery/th_1.jpg" alt="thumb" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--Catalog Single Item Close-->

<!--Tabs Widget-->
<section class="tabs-widget">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#specs" data-toggle="tab">Specs</a></li>
        <li><a href="#descr" data-toggle="tab">Description</a></li>
        <li><a href="#review" data-toggle="tab">Reviews</a></li>
    </ul>
    <div class="tab-content">
        <!--Tab1 (Specs)-->
        <div class="tab-pane fade in active" id="specs">
            <div class="container">
                <div class="row">
                    <section class="tech-specs">
                        <div class="container">
                            <div class="row">
                                <!--Column 1-->
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <!--Item-->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-dollar"></i><span>Best Price</span></div>
                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Affordable prices</p></div>
                                        </div>
                                    </div>
                                    <!--Item-->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-umbrella"></i><span>Materials</span></div>
                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Waterproof materials</p></div>
                                        </div>
                                    </div>
                                    <!--Item-->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-sort-numeric-asc"></i><span>City bags</span></div>
                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Any size</p></div>
                                        </div>
                                    </div>
                                    <!--Item-->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-smile-o"></i><span>Mentions</span></div>
                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Give a smile</p></div>
                                        </div>
                                    </div>
                                    <!--Item-->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-recycle"></i><span>Eco activity</span></div>
                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Eco-friendly materials</div>
                                        </div>
                                    </div>
                                    <!--Item-->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4"><i class="fa fa-archive"></i><span>Package</span></div>
                                            <div class="col-lg-8 col-md-8 col-sm-8"><p class="p-style2">Individual packing</p></div>
                                        </div>
                                    </div>
                                </div>
                                <!--Column 2-->
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <!--Item-->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-umbrella"></i><span>Materials</span></div>
                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Waterproof materials</p></div>
                                        </div>
                                    </div>
                                    <!--Item-->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4"><i class="fa fa-archive"></i><span>Package</span></div>
                                            <div class="col-lg-8 col-md-8 col-sm-8"><p class="p-style2">Individual packing</p></div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-smile-o"></i><span>Mentions</span></div>
                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Give a smile</p></div>
                                        </div>
                                    </div>
                                    <!--Item-->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-dollar"></i><span>Best Price</span></div>
                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Affordable prices</p></div>
                                        </div>
                                    </div>
                                    <!--Item-->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-recycle"></i><span>Eco activity</span></div>
                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Eco-friendly materials</div>
                                        </div>
                                    </div>
                                    <!--Item-->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-sort-numeric-asc"></i><span>City bags</span></div>
                                            <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Any size</p></div>
                                        </div>
                                    </div>
                                    <!--Item-->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <!--Tab2 (Description)-->
        <div class="tab-pane fade" id="descr">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-5">
                        <img class="center-block" src="<?php echo $directoryAsset; ?>/img/posts-widget/1.jpg" alt="Description"/>
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-7">
                        <p class="p-style2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.</p>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6">
                                <h4>Unordered list</h4>
                                <ul>
                                    <li>List item</li>
                                    <li><a href="#">List item link</a></li>
                                    <li>List item</li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6">
                                <h4>Ordered list</h4>
                                <ol>
                                    <li>List item</li>
                                    <li><a href="#">List item link</a></li>
                                    <li>List item</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Tab3 (Reviews)-->
        <div class="tab-pane fade" id="review">
            <div class="container">
                <div class="row">
                    <!--Disqus Comments Plugin-->
                    <div class="col-lg-10 col-lg-offset-1">
                        <div id="disqus_thread"></div>
                        <script type="text/javascript">
                            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                            var disqus_shortname = '8guild'; // required: replace example with your forum shortname

                            /* * * DON'T EDIT BELOW THIS LINE * * */
                            (function () {
                                var dsq = document.createElement('script');
                                dsq.type = 'text/javascript';
                                dsq.async = true;
                                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--Tabs Widget Close-->

<!--Special Offer-->
<section class="special-offer">
    <div class="container">
        <h2>Special offer</h2>
        <div class="row">
            <!--Tile-->
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="tile">
                    <div class="price-label">715,00 $</div>
                    <a href="#"><img src="<?php echo $directoryAsset; ?>/img/offers/special-offer.png" alt="Special Offer"/></a>
                    <div class="footer"><a href="#">The Buccaneer</a></div>
                </div>
            </div>
            <!--Plus-->
            <div class="col-lg-1 col-md-1 col-sm-1">
                <div class="sign">+</div>
            </div>
            <!--Tile-->
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="tile">
                    <div class="price-label">715,00 $</div>
                    <a href="#"><img src="<?php echo $directoryAsset; ?>/img/offers/special-offer.png" alt="Special Offer"/></a>
                    <div class="footer"><a href="#">The Buccaneer</a></div>
                </div>
            </div>
            <!--Equal-->
            <div class="col-lg-1 col-md-1 col-sm-1">
                <div class="sign">=</div>
            </div>
            <!--Offer-->
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="offer">
                    <h3 class="light-color">save</h3>
                    <h4 class="text-primary">100,00 $</h4>
                    <a class="btn btn-primary" href="#">Buy for 1200$</a>
                </div>
            </div>
        </div>
    </div>
</section><!--Special Offer Close-->

<!--Brands Carousel Widget-->

<?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>
