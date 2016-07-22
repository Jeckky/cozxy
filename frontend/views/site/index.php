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
        <?php foreach ($bannerGroup->contents as $banner) {
            ?>
            <!--Slide 1-->
            <div class="ms-slide" data-delay="7">
                <div class="overlay"></div>
                <div class="ms-anim-layers">
                    <div class="ms-layer text-block" style="margin: 50px; padding: 108px 0px 0px 25px; font-size: 16px; line-height: 22px;">
                        <h2 class="dark-color">
                            <span style="color: #03a9f4;"><?= $banner->headTitle ?></span><br><?= $banner->title ?>
                        </h2>
                        <p class="dark-color col-md-7"><?= strip_tags($banner->description); ?></p>
                        <p class="dark-color col-md-7">
                            <a class="btn btn-primary" href="<?php echo $banner->link; ?>"><?= $banner->linkTitle ?></a>
                        </p>
                        <!--<a class="btn btn-black" href="#">Browse all</a>-->
                    </div>
                    <img style="right: 50px; margin: 0px; padding: 60px 0px 0px; font-size: 16px; line-height: 22px;" class="ms-layer img-block img-responsive" src="<?= Yii::$app->homeUrl . $banner->image ?>" alt="1">
                </div>
            </div>
            <?php
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
                        <div class="row" style="background-image: url('<?php echo $baseUrl . $topOneContent->image; ?>');background-size: 100% 100%;">
                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                                <h2 style="color: #fff;"><?php echo $topOneContent->title; ?></h2>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="color: #fff;">
                                        <p class="p-style3" style="color: #fff;">
                                            <?php echo $topOneContent->description; ?>
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

                <!--Tabs Widget-->
                <section class="tabs-widget">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#bestsel" data-toggle="tab">Bestseller items</a></li>
                        <li><a href="#onsale" data-toggle="tab">Items on sale</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="bestsel">
                            <div class="container" >
                                <div class="row">
                                    <div  id="photos-bestseller-items">
                                        <?php
                                        $i = 1;
                                        foreach ($product as $products) {
                                            $image = \common\models\costfit\ProductImage::find()->where("productId='" . $products->productId . "'")->all();
                                            foreach ($image as $images) {
                                                ?>
                                                <div id="photos-bestseller-items-padding">
                                                    <a class="media-link" href="#" id="media-link-bestseller" >
                                                        <div class="overlay" >
                                                            <div class="descrx desc-bestseller">
                                                                <div class="product-name"><?php echo $products->title; ?>
                                                                    <div class="bestseller-name-price"><?php echo $products->price; ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="<?php echo $baseUrl . $images->image; ?>"/>
                                                    </a>
                                                </div>

                                                <?php
                                                $i++;
                                                if ($i > 9) {
                                                    break;
                                                }
                                            }
                                            if ($i > 9) {
                                                break;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div><!-- row zone 1 -->
                            </div>
                        </div>

                        <div class="tab-pane fade" id="onsale">
                            <div class="container">
                                <div class="row">
                                    <?php for ($index1 = 0; $index1 <= 3; $index1++) {
                                        ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <a class="media-link" href="#">
                                                <div class="overlay">
                                                    <div class="descr"><div>Product Name<span>$14.95</span></div></div>
                                                </div>
                                                <img src="<?php echo $baseUrl; ?>/images/bestseller-items/teniqa30_49a2502a5e21c.jpg" alt="1" title="ขนาด 555 x 245"/>
                                            </a>
                                        </div>

                                        <?php
                                        $index1 = $index1++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!--Tabs Widget Close-->

                <!--Features Tabs-->
                <section class="feature-tabs">
                    <div class="container">
                        <div class="row">
                            <div class="tabs-content col-lg-6 col-md-6">
                                <?php
                                $i = 1;
                                foreach ($bottomContent as $content) {
                                    if ($i > 3) {
                                        break;
                                    }
                                    ?>
                                    <div class="tabs-pane <?= ($i == 1) ? 'current' : '' ?>" id="tab<?= $i ?>">
                                        <!--<div class="tabs-pane current" id="tab-1">-->
                                        <h2 class="<?= ($i == 1) ? 'title-head' : '' ?>">
                                            <?php echo $content->title; ?>
                                        </h2>
                                        <p class="p-style3"><?php echo $content->description; ?></p>
                                    </div>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </div>
                            <div class="tabs col-lg-6 col-md-6 group">
                                <span class="tab active" data-tab="#tab1"><i class="fa fa-archive"></i></span>
                                <span class="tab" data-tab="#tab2"><i class="fa fa-recycle"></i></span>
                                <span class="tab" data-tab="#tab3"><i class="fa fa-gift"></i></span>
                            </div>
                        </div>
                    </div>
                </section>
                <!--Subscription Widget-->
                <?php echo $this->render('@app/themes/costfit/layouts/_subscription', compact('lastIndexContent')); ?>
                <!--Brands Carousel Widget-->
                <?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>


