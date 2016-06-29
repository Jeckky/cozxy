<?php
/* @var $this yii\web\View */

$this->title = 'My Cost Fit';
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
-->

<!--Hero Slider-->
<section class="hero-slider">
    <div class="master-slider" id="hero-slider">

        <!--Slide 1-->
        <div class="ms-slide" data-delay="7">
            <div class="overlay"></div>
            <img src="<?php echo $directoryAsset; ?>/masterslider/blank.gif" data-src="<?php echo $directoryAsset; ?>/img/hero/slideshow/slide_1.jpg" alt=""/>
            <h2 style="width: 456px; left: 110px; top: 110px;" class="dark-color ms-layer" data-effect="top(50,true)" data-duration="700" data-delay="250" data-ease="easeOutQuad">Look for all bags at our shop!</h2>
            <p style="width: 456px; left: 110px; top: 210px;" class="dark-color ms-layer" data-effect="back(500)" data-duration="700" data-delay="500" data-ease="easeOutQuad">In this slider (which works both on touch screen and desktop devices) you can change the title, the description and button texts. It's all that you need to demonstrate your top rated products. </p>
            <div style="left: 110px; top: 300px;" class="ms-layer button" data-effect="left(50,true)" data-duration="500" data-delay="750" data-ease="easeOutQuad"><a class="btn btn-black" href="#">Go to catalog</a></div>
            <div style="left: 350px; top: 300px;" class="ms-layer button" data-effect="bottom(50,true)" data-duration="700" data-delay="950" data-ease="easeOutQuad"><a class="btn btn-primary" href="#">Browse all</a></div>
        </div>

        <!--Slide 2-->
        <div class="ms-slide" data-delay="7">
            <span class="overlay"></span>
            <img src="<?php echo $directoryAsset; ?>/masterslider/blank.gif" data-src="<?php echo $directoryAsset; ?>/img/hero/slideshow/slide_2.jpg" alt="Necessaire"/>
            <h2 style="width: 456px; left: 110px; top: 110px;" class="dark-color ms-layer" data-effect="bottom(50,true)" data-duration="700" data-delay="250" data-ease="easeOutQuad">Necessaire</h2>
            <p style="width: 456px; left: 110px; top: 210px;" class="dark-color ms-layer" data-effect="bottom(50,true)" data-duration="700" data-delay="500" data-ease="easeOutQuad">In this slider (which works both on touch screen and desktop devices) you can change the title, the description and button texts. It's all that you need to demonstrate your top rated products. </p>
            <div style="left: 110px; top: 330px;" class="ms-layer button" data-effect="left(50,true)" data-duration="500" data-delay="750" data-ease="easeOutQuad"><a class="btn btn-black" href="#">Go to catalog</a></div>
            <div style="left: 350px; top: 330px;" class="ms-layer button" data-effect="bottom(50,true)" data-duration="700" data-delay="950" data-ease="easeOutQuad"><a class="btn btn-primary" href="#">Browse all</a></div>
        </div>

        <!--Slide 3-->
        <div class="ms-slide" data-delay="7">
            <div class="overlay"></div>
            <img src="<?php echo $directoryAsset; ?>/masterslider/blank.gif" data-src="<?php echo $directoryAsset; ?>/img/hero/slideshow/slide_2.jpg" alt="Crescent"/>
            <h2 style="width: 456px; left: 110px; top: 110px;" class="dark-color ms-layer" data-effect="left(50,true)" data-duration="700" data-delay="250" data-ease="easeOutQuad">Crescent</h2>
            <p style="width: 456px; left: 110px; top: 210px;" class="dark-color ms-layer" data-effect="left(50,true)" data-duration="700" data-delay="500" data-ease="easeOutQuad">In this slider (which works both on touch screen and desktop devices) you can change the title, the description and button texts. It's all that you need to demonstrate your top rated products. </p>
            <div style="left: 110px; top: 330px;" class="ms-layer button" data-effect="left(50,true)" data-duration="500" data-delay="750" data-ease="easeOutQuad"><a class="btn btn-black" href="#">Go to catalog</a></div>
            <div style="left: 350px; top: 330px;" class="ms-layer button" data-effect="bottom(50,true)" data-duration="700" data-delay="950" data-ease="easeOutQuad"><a class="btn btn-primary" href="#">Browse all</a></div>
        </div>

    </div>
</section><!--Hero Slider Close-->

<!--Saved Category-->
<section class="cat-tiles">
    <div class="container">
        <h2 class="dark-color">SAVE ON EVERYDAY ESSENTIALS</h2>
        <div class="row">
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
</section>
<!--Saved Category Close-->

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
                            <img src="<?php echo $directoryAsset; ?>/img/media/1.jpg" alt="1"/>
                        </a>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                        <a class="media-link" href="#">
                            <div class="overlay">
                                <div class="descr"><div>Product Name<span>$19.40</span></div></div>
                            </div>
                            <img src="<?php echo $directoryAsset; ?>/img/media/2.jpg" alt="2"/>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <a class="media-link" href="#">
                            <div class="overlay">
                                <div class="descr"><div>Product Name<span>$24.15</span></div></div>
                            </div>
                            <img src="<?php echo $directoryAsset; ?>/img/media/3.jpg" alt="3"/>
                        </a>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                        <a class="media-link" href="#">
                            <div class="overlay">
                                <div class="descr"><div>Product Name<span>$24.15</span></div></div>
                            </div>
                            <img src="<?php echo $directoryAsset; ?>/img/media/4.jpg" alt="4"/>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <a class="media-link" href="#">
                            <div class="overlay">
                                <div class="descr"><div>Product Name<span>$24.15</span></div></div>
                            </div>
                            <img src="<?php echo $directoryAsset; ?>/img/media/5.jpg" alt="5"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="onsale">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <a class="media-link" href="#">
                            <div class="overlay">
                                <div class="descr"><div>Product Name<span>$14.95</span></div></div>
                            </div>
                            <img src="<?php echo $directoryAsset; ?>/img/media/6.jpg" alt="1"/>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <a class="media-link" href="#">
                            <div class="overlay">
                                <div class="descr"><div>Product Name<span>$19.40</span></div></div>
                            </div>
                            <img src="<?php echo $directoryAsset; ?>/img/media/6.jpg" alt="2"/>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <a class="media-link" href="#">
                            <div class="overlay">
                                <div class="descr"><div>Product Name<span>$24.15</span></div></div>
                            </div>
                            <img src="<?php echo $directoryAsset; ?>/img/media/6.jpg" alt="3"/>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <a class="media-link" href="#">
                            <div class="overlay">
                                <div class="descr"><div>Product Name<span>$24.15</span></div></div>
                            </div>
                            <img src="<?php echo $directoryAsset; ?>/img/media/6.jpg" alt="4"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--Tabs Widget Close-->

<!--Posts/Twitter Widget-->
<section class="posts-widget">
    <div class="tw-bg"></div>
    <div class="container">
        <div class="row">
            <div class="latest-posts col-lg-8 col-md-8">
                <div class="row">
                    <div class="col-lg-3">
                        <h2 class="extra-bold">Latests posts</h2>
                        <a class="btn btn-black btn-block" href="#">To blog</a>
                    </div>
                    <div class="col-lg-9">
                        <!--Post-->
                        <div class="post row">
                            <div class="col-lg-6 col-sm-6">
                                <a href="#"><img src="<?php echo $directoryAsset; ?>/img/posts-widget/1.jpg" alt="1"/></a>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <h3><a href="#">An interesting post</a></h3>
                                <p>Write a blog to share with customers interesting facts about your products. Make them curious and you'll get co-operation. Just try it!</p>
                                <div class="author"><i class="fa fa-user"></i><a href="#">By Resoursa</a></div>
                                <div class="comments"><i class="fa fa-comment"></i><a href="#">Comments (34)</a></div>
                            </div>
                        </div><!--Post End-->
                        <!--Post-->
                        <div class="post row">
                            <div class="col-lg-6 col-sm-6">
                                <a href="#"><img src="<?php echo $directoryAsset; ?>/img/posts-widget/1.jpg" alt="2"/></a>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <h3><a href="#">Review post</a></h3>
                                <p>You probably know that giving more details is the best way to provide info about a product. Write reviews, take high-quality pictures, and that will definitely boost the sales.</p>
                                <div class="author"><i class="fa fa-user"></i><a href="#">By Jeddah</a></div>
                                <div class="comments"><i class="fa fa-comment"></i><a href="#">Comments (101)</a></div>
                            </div>
                        </div><!--Post End-->
                    </div>
                </div>
            </div>
            <div class="twitter-feed col-lg-4 col-md-4">
                <a class="tw-follow" href="https://twitter.com/8Guild" target="_blank">
                    <div class="button">Follow us<i class="fa fa-twitter"></i></div>
                    <h2 class="extra-bold">On Twitter <i class="fa fa-twitter"></i></h2>
                </a>
                <!--Tweet-->
                <div class="tweet">
                    <a href="#">@Resoursa</a>
                    <p class="p-style3">Uberly impressed with the AMAZING support I constantly get from awesome!!!</p>
                    <div class="group">
                        <div class="actions">
                            <a href="#">Reply</a>
                            <a href="#">Retweet</a>
                            <a href="#">Favorite</a>
                        </div>
                        <span class="date">5 Mar 2014</span>
                    </div>
                </div><!--Tweet Close-->
                <!--Tweet-->
                <div class="tweet">
                    <a href="#">@Resoursa</a>
                    <p class="p-style3">Uberly impressed with the AMAZING support I constantly get from awesome!!!</p>
                    <div class="group">
                        <div class="actions">
                            <a href="#">Reply</a>
                            <a href="#">Retweet</a>
                            <a href="#">Favorite</a>
                        </div>
                        <span class="date">5 Mar 2014</span>
                    </div>
                </div><!--Tweet Close-->
            </div>
        </div>
    </div>
</section>

<!--Gallery Widget-->
<section class="white-bg gallery-widget">
    <div class="container">
        <h2>Product gallery</h2>
        <div class="filters">
            <a class="active" href="#" data-group="all">All</a>
            <a href="#" data-group="City bags">City bags</a>
            <a href="#" data-group="Gloves">Gloves</a>
            <a href="#" data-group="Belts">Belts</a>
            <a href="#" data-group="video">Clutch</a>
        </div>
        <div class="gallery-grid">
            <!--Item-->
            <div class="gallery-item" data-groups='["City bags"]' data-src="<?php echo $directoryAsset; ?>/img/gallery-widget/1.jpg">
                <a href="<?php echo $directoryAsset; ?>/img/gallery-widget/1.jpg">
                    <div class="overlay"><span><i class="icon-expand"></i></span></div>
                    <img src="<?php echo $directoryAsset; ?>/img/gallery-widget/1.jpg" alt="1"/>
                </a>
            </div>
            <!--Item-->
            <div class="gallery-item" data-groups='["City bags"]' data-src="<?php echo $directoryAsset; ?>/img/gallery-widget/2.jpg">
                <a href="<?php echo $directoryAsset; ?>/img/gallery-widget/2.jpg">
                    <div class="overlay"><span><i class="icon-expand"></i></span></div>
                    <img src="<?php echo $directoryAsset; ?>/img/gallery-widget/2.jpg" alt="2"/>
                </a>
            </div>
            <!--Item-->
            <div class="gallery-item" data-groups='["video"]' data-src="https://www.youtube.com/watch?v=AZ3AVR7VnqA">
                <a href="https://www.youtube.com/watch?v=hdEAWW7tZSA">
                    <div class="overlay"><span><i class="icon-music-play"></i></span></div>
                    <img src="<?php echo $directoryAsset; ?>/img/gallery-widget/5.jpg" alt="3"/>
                </a>
            </div>
            <!--Item-->
            <div class="gallery-item" data-groups='["Belts"]' data-src="<?php echo $directoryAsset; ?>/img/gallery-widget/4.jpg">
                <a href="<?php echo $directoryAsset; ?>/img/gallery-widget/4.jpg">
                    <div class="overlay"><span><i class="icon-expand"></i></span></div>
                    <img src="<?php echo $directoryAsset; ?>/img/gallery-widget/4.jpg" alt="4"/>
                </a>
            </div>
            <!--Item-->
            <div class="gallery-item" data-groups='["Gloves"]' data-src="<?php echo $directoryAsset; ?>/img/gallery-widget/5.jpg">
                <a href="<?php echo $directoryAsset; ?>/img/gallery-widget/5.jpg">
                    <div class="overlay"><span><i class="icon-expand"></i></span></div>
                    <img src="<?php echo $directoryAsset; ?>/img/gallery-widget/5.jpg" alt="5"/>
                </a>
            </div>
            <!--Item-->
            <div class="gallery-item" data-groups='["Gloves"]' data-src="<?php echo $directoryAsset; ?>/img/gallery-widget/5.jpg">
                <a href="<?php echo $directoryAsset; ?>/img/gallery-widget/5.jpg">
                    <div class="overlay"><span><i class="icon-expand"></i></span></div>
                    <img src="<?php echo $directoryAsset; ?>/img/gallery-widget/5.jpg" alt="6"/>
                </a>
            </div>
        </div>
    </div>
</section><!--Gallery Widget Close-->

<!--Brands Carousel Widget-->
<section class="brand-carousel">
    <div class="container">
        <h2>Brands in our shop</h2>
        <div class="inner">
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
            <a class="item" href="#"><img src="<?php echo $directoryAsset; ?>/img/brands/1.png" alt="1"/></a>
        </div>
    </div>
</section><!--Brands Carousel Close-->
