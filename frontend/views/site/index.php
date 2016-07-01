<?php
/* @var $this yii\web\View */
//$this->title = 'My Cost Fit';
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Hero Slider-->
<!--Hero Slider-->
<section class="hero-slider">
    <div class="master-slider" id="hero-slider">
        <?php for ($index2 = 0; $index2 <= 5; $index2++) {
            ?>
            <!--Slide 1-->
            <div class="ms-slide" data-delay="7">
                <div class="overlay"></div>
                <div class="ms-anim-layers" >
                    <div class="ms-layer text-block" style="margin: 50px; padding: 108px 0px 0px 25px; font-size: 16px; line-height: 22px;">
                        <h2 class="dark-color">
                            <span style="color: #03a9f4;">COST.FIT</span><br>Swirl Cool
                        </h2>
                        <p class="dark-color col-md-7">It is of high importance to redirect a customer to the product
                            page. Provide a detailed description with a callout action. </p>
                        <p class="dark-color col-md-7">
                            <a class="btn btn-primary" href="<?php echo $baseUrl; ?>/wishlist?productId=88888">1845$ Buy it new</a>
                        </p>
                        <!--<a class="btn btn-black" href="#">Browse all</a>-->
                    </div>
                    <img style="right: 50px; margin: 0px; padding: 60px 0px 0px; font-size: 16px; line-height: 22px;" class="ms-layer img-block" src="<?php echo $directoryAsset; ?>/img/categories/slides/slide_1.png" alt="1">
                </div>
            </div>
            <?php
            $index2 = $index2++;
        }
        ?>
    </div>
</section><!--Hero Slider Close-->
<!--Hero Slider Close-->
<section class="cat-tiles">
    <div class="container">
        <h2>SAVE ON EVERYDAY ESSENTIALS</h2>
        <div class="row">
            <!--Category-->
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $saveCat,
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_save_cat', ['model' => $model]);
                },
                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
//            'layout'=>"{summary}{pager}{items}"
                        'layout' => "{items}"
                    ])
                    ?>
                </div>
            </div>
        </section><!--Categories Close-->
        <!--Saved Category-->
        <!--Popular Category-->
        <section class="catalog-grid">
            <div class="container">
                <h2 class="dark-color">SHOP POPULAR CATEGORIES</h2>
                <div class="row">
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $popularCat,
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('_popular_cat', ['model' => $model]);
                        },
                                'summaryOptions' => ['class' => 'sort-by-section clearfix'],
//            'layout'=>"{summary}{pager}{items}"
                                'layout' => "{items}"
                            ])
                            ?>
                        </div>
                    </div>
                </section><!--Catalog Grid Close-->
                <!--Popular Category Close-->

                <section style="background-position: 50% 145.5px; background-color: #f5f5f5; " data-stellar-background-ratio="0.5">
                    <div class="container">
                        <div class="row" style="background-image: url('<?php echo $directoryAsset; ?>/img/6461f19706a949f3_5095-w787-h376-b0-p0--home-design.jpg');">
                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                                <h2 style="color: #fff;">Eco-friendly materials in our shop</h2>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="color: #fff;">
                                        <p class="p-style3" style="color: #fff;">Let the customer know if there's anything you can be proud of.
                                            If you have a clear business concept provide a description for it.
                                            Do you have a flexible return policy or discounts for loyal customers? It's great!
                                            Tell them about it in this module. For instance,
                                            put some notes from what fabric clothing is made of in case you run an apparel store.
                                        </p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 10px;">
                                        <button class="btn btn-black btn-sm" value="100$-300$">READ MORE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!--Tabs Widget-->
                <section class="tabs-widget">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#bestsel" data-toggle="tab">Bestseller items</a></li>
                        <li><a href="#onsale" data-toggle="tab">Items on sale</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="bestsel">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-7">
                                        <a class="media-link" href="#">
                                            <div class="overlay">
                                                <div class="descr"><div>Product Name<span>$14.95</span></div></div>
                                            </div>
                                            <img src="<?php echo $baseUrl; ?>/images/bestseller-items/1.jpg" alt="1" title="ขนาด 654 x 240"/>
                                        </a>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                        <a class="media-link" href="#">
                                            <div class="overlay">
                                                <div class="descr"><div>Product Name<span>$19.40</span></div></div>
                                            </div>
                                            <img src="<?php echo $baseUrl; ?>/images/bestseller-items/2.jpg" alt="1" class="img-responsive" title="ขนาด 457 x 240"/>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <a class="media-link" href="#">
                                            <div class="overlay">
                                                <div class="descr"><div>Product Name<span>$24.15</span></div></div>
                                            </div>
                                            <img src="<?php echo $baseUrl; ?>/images/bestseller-items/3.jpg" alt="1" class="img-responsive" title="ขนาด 359 x 245"/>
                                        </a>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                        <a class="media-link" href="#">
                                            <div class="overlay">
                                                <div class="descr"><div>Product Name<span>$24.15</span></div></div>
                                            </div>
                                            <img src="<?php echo $baseUrl; ?>/images/bestseller-items/4.jpg" alt="1" class="img-responsive" title="ขนาด 457 x 245"/>
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <a class="media-link" href="#">
                                            <div class="overlay">
                                                <div class="descr"><div>Product Name<span>$24.15</span></div></div>
                                            </div>
                                            <img src="<?php echo $baseUrl; ?>/images/bestseller-items/5.jpg" alt="1" class="img-responsive" title="ขนาด 265 x 245"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="onsale">
                            <div class="container">
                                <?php for ($index1 = 0; $index1 <= 1; $index1++) {
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <a class="media-link" href="#">
                                                <div class="overlay">
                                                    <div class="descr"><div>Product Name<span>$14.95</span></div></div>
                                                </div>
                                                <img src="<?php echo $baseUrl; ?>/images/bestseller-items/teniqa30_49a2502a5e21c.jpg" alt="1" title="ขนาด 555 x 245"/>
                                            </a>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <a class="media-link" href="#">
                                                <div class="overlay">
                                                    <div class="descr"><div>Product Name<span>$19.40</span></div></div>
                                                </div>
                                                <img src="<?php echo $baseUrl; ?>/images/bestseller-items/teniqa30_49a2502a5e21c.jpg" alt="1" title="ขนาด 555 x 245"/>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    $index1 = $index1++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section><!--Tabs Widget Close-->

                <!--Features Tabs-->
                <section class="feature-tabs">
                    <div class="container">
                        <div class="row">
                            <div class="tabs-content col-lg-6 col-md-6">
                                <div class="tabs-pane current" id="tab-1">
                                    <h2 class="title-head">
                                        How Cost.Fit Works
                                    </h2>
                                    <p class="p-style3">Outline the main advantages a one can get by purchasing a product from your store. Have you got expensive items and at the same time a flexible return policy? Make a customer aware of that! </p>
                                </div>
                                <div class="tabs-pane" id="tab-2">
                                    <h2>High quality leather</h2>
                                    <p class="p-style3">Outline the main advantages a one can get by purchasing a product from your store. Have you got expensive items and at the same time a flexible return policy? Make a customer aware of that! </p>
                                </div>
                                <div class="tabs-pane" id="tab-3">
                                    <h2>Smart delivery transfer</h2>
                                    <p class="p-style3">Outline the main advantages a one can get by purchasing a product from your store. Have you got expensive items and at the same time a flexible return policy? Make a customer aware of that! </p>
                                </div>
                            </div>
                            <div class="tabs col-lg-6 col-md-6 group">
                                <span class="tab active" data-tab="#tab-1"><i class="fa fa-archive"></i></span>
                                <span class="tab" data-tab="#tab-2"><i class="fa fa-recycle"></i></span>
                                <span class="tab" data-tab="#tab-3"><i class="fa fa-gift"></i></span>
                            </div>
                        </div>
                    </div>
                </section>
                <!--Brands Carousel Widget-->
                <?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>

