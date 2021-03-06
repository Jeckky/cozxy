<?php
/* @var $this yii\web\View */


\frontend\assets\NewCozxyAsset::register($this);
$UserAgent = common\helpers\GetBrowser::UserAgent();
$this->title = 'cozxy.com - Buy what fuels your passion';
$UserAgent = common\helpers\GetBrowser::UserAgent();
?>
<style>
    .swiper-container {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
</style>
<?php if(isset($slideGroup)): ?>
    <div class="bg-white rela">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php
                echo \yii\widgets\ListView::widget([
                    'dataProvider' => $slideGroup,
                    'summary' => "",
                    'options' => [
                        'tag' => false,
                    ],
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('@app/themes/cozxy/layoutsV2/banners/_slide_rev1', ['model' => $model, 'index' => $index]);
                    },
                    //'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                    //'layout'=>"{summary}{pager}{items}"
                    //'layout' => "{items}",
                    'itemOptions' => [
                        'tag' => false,
                    ],
                ]);
                ?>
            </div>
            <!-- Left and right controls -->
            <a class="align-middle fc-black mca" href="#myCarousel" data-slide="prev" style="left:0">
                <span class="glyphicon glyphicon-menu-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="align-middle fc-black mca" href="#myCarousel" data-slide="next" style="right:0">
                <span class="glyphicon glyphicon-menu-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
<?php endif; ?>

<!-- Swiper All the bags -->
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <h2>HOT DEALS<!--30% - 70%--></h2>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $sectionItem,
                        'summary' => "",
                        'options' => [
                            'tag' => false,
                        ],
                        'itemView' => function ($model, $key, $index, $widget) { //$widget,
                            //echo $model->productId, ',';
                            return $this->render('@app/themes/cozxy/layoutsV2/product/swiper/_swiper_prodcut_items_hot_deals', ['model' => $model, 'index' => $index]);
                        },
                        // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                        //'layout' => "{summary}{pager}{items}",
                        'layout' => "{items}",
                        'itemOptions' => [
                            'tag' => false,
                        ],
                        //'itemOptions' => ['class' => 'item'],
                    ]);
                    ?>
                </div>
                <!-- Add Pagination -->

                <?php if($UserAgent == 'mobile') { ?>
                    <div class="swiper-pagination"></div><?php } ?>
                <!-- Add Arrows -->
                <?php if($UserAgent != 'mobile') { ?>
                    <div class="swiper-button-next" style="background-image: none !important;">
                        <span class="glyphicon glyphicon-menu-right"></span></div>
                    <div class="swiper-button-prev" style="background-image: none !important;">
                        <span class="glyphicon glyphicon-menu-left"></span></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="spacing-cozxy bg-white">&nbsp;</div>
<!--/ category  /-->
<div class="bg-white">
    <div class="<?= ($UserAgent == 'mobile') ? 'container' : 'container-cozxy' ?> ">
        <div class="row">
            <div class="col-xs-12">
                <div class="media-carousel-x img-items-category">
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $category,
                        'summary' => "",
                        'options' => [
                            'tag' => false,
                        ],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('@app/themes/cozxy/layoutsV2/category/_items_category_v2', ['model' => $model, 'index' => $index]);
                        },
                        // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                        //'layout'=>"{summary}{pager}{items}"
                        //'layout' => "{items}",
                        'itemOptions' => [
                            'tag' => false,
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacing-cozxy bg-white">&nbsp;</div>

<!-- Swiper Sunglasses -->
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="head-all-new-v2 text-section-padding">
                <h2>SUNGLASSES BEST SELLER</h2>
            </div>
            <div class="see-all-new-v2 hidden-sm hidden-xs">
                <a href="<?= Yii::$app->homeUrl ?>site/see-all-sale/">SEE MORE ></a>
            </div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $productCanSellBySunglasses,
                        'summary' => "",
                        'options' => [
                            'tag' => false,
                        ],
                        'itemView' => function ($model, $key, $index, $widget) { //$widget,
                            //echo $model->productId, ',';
                            return $this->render('@app/themes/cozxy/layoutsV2/product/swiper/_swiper_product_items', ['model' => $model, 'index' => $index]);
                        },
                        // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                        //'layout' => "{summary}{pager}{items}",
                        'layout' => "{items}",
                        'itemOptions' => [
                            'tag' => false,
                        ],
                        //'itemOptions' => ['class' => 'item'],
                    ]);
                    ?>
                </div>
                <!-- Add Pagination -->
                <?php if($UserAgent == 'mobile') { ?>
                    <div class="swiper-pagination"></div><?php } ?>
                <!-- Add Arrows -->
                <?php if($UserAgent != 'mobile') { ?>
                    <div class="swiper-button-next" style="background-image: none !important;">
                        <span class="glyphicon glyphicon-menu-right"></span></div>
                    <div class="swiper-button-prev" style="background-image: none !important;">
                        <span class="glyphicon glyphicon-menu-left"></span></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="spacing-cozxy bg-white">&nbsp;</div>

<!--// Good Reads -->
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" id="media1">
                    <div class="carousel-inner">
                        <img src="<?= isset($BannerPromotes1['image']) ? $BannerPromotes1['image'] : 'https://scontent.fbkk1-4.fna.fbcdn.net/v/t31.0-8/27907867_165864180863361_560513674889134297_o.jpg?oh=fdac23c5e27713cb50e6e4a0e817d5d0&oe=5B0C5DAC' ?>" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%; height: 20%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacing-cozxy bg-white">&nbsp;</div>

<!-- Swiper Cosmetics -->
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="head-all-new-v2 text-section-padding">
                <h2>COSMETICS BEST SELLER</h2>
            </div>
            <div class="see-all-new-v2 hidden-sm hidden-xs">
                <a href="<?= Yii::$app->homeUrl ?>site/see-all-sale/">SEE MORE ></a>
            </div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $productCanSellByCosmetics,
                        'summary' => "",
                        'options' => [
                            'tag' => false,
                        ],
                        'itemView' => function ($model, $key, $index, $widget) { //$widget,
                            //echo $model->productId, ',';
                            return $this->render('@app/themes/cozxy/layoutsV2/product/swiper/_swiper_product_items', ['model' => $model, 'index' => $index]);
                        },
                        // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                        //'layout' => "{summary}{pager}{items}",
                        'layout' => "{items}",
                        'itemOptions' => [
                            'tag' => false,
                        ],
                        //'itemOptions' => ['class' => 'item'],
                    ]);
                    ?>
                </div>
                <!-- Add Pagination -->
                <?php if($UserAgent == 'mobile') { ?>
                    <div class="swiper-pagination"></div><?php } ?>
                <!-- Add Arrows -->
                <?php if($UserAgent != 'mobile') { ?>
                    <div class="swiper-button-next" style="background-image: none !important;">
                        <span class="glyphicon glyphicon-menu-right"></span></div>
                    <div class="swiper-button-prev" style="background-image: none !important;">
                        <span class="glyphicon glyphicon-menu-left"></span></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="spacing-cozxy bg-white">&nbsp;</div>

<!--// Good Reads -->
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide row" id="media1">
                    <div class="carousel-inner">
                        <a href="search/Fragrance/C6PMjTtOULptLuT9kk3xT-5ySf7dy3tp_GcsjXB9_Mk%3D">
                            <img src="<?= isset($BannerPromotes2['image']) ? $BannerPromotes2['image'] : 'https://scontent.fbkk1-4.fna.fbcdn.net/v/t31.0-8/27913153_165864184196694_233336126967648172_o.jpg?oh=a2902b97e0cb4068c0a8d28ccd01be5d&oe=5B0FEE1B' ?>" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%; height: 20%;"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacing-cozxy bg-white">&nbsp;</div>

<!--/   prodcut  items /-->
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="head-all-new-v2 text-section-padding"><h2>RECOMMENDED</h2></div>
            <div class="col-xs-12 col-md-12">

                <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="2000" id="cozxyCarousel3">
                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productNewCanSell,
                            'summary' => "",
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) { //$widget,
                                //echo $model->productId, ',';
                                return $this->render('@app/themes/cozxy/layoutsV2/product/_product_item_rev1', ['model' => $model, 'index' => $index]);
                            },
                            // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                            //'layout' => "{summary}{pager}{items}",
                            'layout' => "{items}",
                            'itemOptions' => [
                                'tag' => false,
                            ],
                            //'itemOptions' => ['class' => 'item'],
                        ]);
                        ?>
                    </div>
                </div>
                <div class="text-center col-xs-12 ">
                    <a href="<?= Yii::$app->homeUrl ?>site/see-all-sale/">SEE MORE</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacing-cozxy bg-white">&nbsp;</div>

<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide row" id="media1">
                    <div class="carousel-inner">
                        <img src="<?= isset($BannerPromotes3['image']) ? $BannerPromotes3['image'] : 'https://scontent.fbkk1-4.fna.fbcdn.net/v/t31.0-8/27797384_165864170863362_7213802211719036278_o.jpg?oh=e4427da2ba39572e4d8b1f0d92a2ee46&oe=5B100B35' ?>" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%; height: 20%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacing-cozxy bg-white">&nbsp;</div>

<!-- Swiper All the bags -->
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="head-all-new-v2 text-section-padding">
                <h2>ALL THE BAGS</h2>
            </div>
            <div class="see-all-new-v2 hidden-sm hidden-xs">
                <a href="<?= Yii::$app->homeUrl ?>site/see-all-sale/">SEE MORE ></a>
            </div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $productCanSellByBags,
                        'summary' => "",
                        'options' => [
                            'tag' => false,
                        ],
                        'itemView' => function ($model, $key, $index, $widget) { //$widget,
                            //echo $model->productId, ',';
                            return $this->render('@app/themes/cozxy/layoutsV2/product/swiper/_swiper_product_items_not_sale', ['model' => $model, 'index' => $index]);
                        },
                        // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                        //'layout' => "{summary}{pager}{items}",
                        'layout' => "{items}",
                        'itemOptions' => [
                            'tag' => false,
                        ],
                        //'itemOptions' => ['class' => 'item'],
                    ]);
                    ?>
                </div>
                <!-- Add Pagination -->
                <?php if($UserAgent == 'mobile') { ?>
                    <div class="swiper-pagination"></div><?php } ?>
                <!-- Add Arrows -->
                <?php if($UserAgent != 'mobile') { ?>
                    <div class="swiper-button-next" style="background-image: none !important;">
                        <span class="glyphicon glyphicon-menu-right"></span></div>
                    <div class="swiper-button-prev" style="background-image: none !important;">
                        <span class="glyphicon glyphicon-menu-left"></span></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="spacing-cozxy bg-white">&nbsp;</div>

<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="head-all-new-v2 text-section-padding">
                <h2>ITEMS YOU MAY LIKE</h2>
            </div>
            <div class="see-all-new-v2 hidden-sm hidden-xs">
                <a href="<?= Yii::$app->homeUrl ?>site/see-all-section-item?sectionId=10">SEE MORE ></a>
            </div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $productCanSellByYouMayLike,
                        'summary' => "",
                        'options' => [
                            'tag' => false,
                        ],
                        'itemView' => function ($model, $key, $index, $widget) { //$widget,
                            //echo $model->productId, ',';
                            return $this->render('@app/themes/cozxy/layoutsV2/product/swiper/_swiper_product_items', ['model' => $model, 'index' => $index]);
                        },
                        // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                        //'layout' => "{summary}{pager}{items}",
                        'layout' => "{items}",
                        'itemOptions' => [
                            'tag' => false,
                        ],
                        //'itemOptions' => ['class' => 'item'],
                    ]);
                    ?>
                </div>
                <!-- Add Pagination -->
                <?php if($UserAgent == 'mobile') { ?>
                    <div class="swiper-pagination"></div><?php } ?>
                <!-- Add Arrows -->
                <?php if($UserAgent != 'mobile') { ?>
                    <div class="swiper-button-next" style="background-image: none !important;">
                        <span class="glyphicon glyphicon-menu-right"></span></div>
                    <div class="swiper-button-prev" style="background-image: none !important;">
                        <span class="glyphicon glyphicon-menu-left"></span></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="spacing-cozxy bg-white">&nbsp;</div>

<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12" style="padding-right: 0px; padding-left: 0px;">
                <div class="line-spacing"></div>
            </div>
        </div>
    </div>
</div>

<!--/ category  /-->
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12" style="padding-right: 0px; padding-left: 0px;">
                <div class="carousel slide media-carousel img-good-reads" id="media1">
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $otherProducts,
                        'summary' => "",
                        'options' => [
                            'tag' => false,
                        ],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('@app/themes/cozxy/layoutsV2/content/_items_good_reads_list', ['model' => $model, 'index' => $index]);
                        },
                        // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                        //'layout'=>"{summary}{pager}{items}"
                        //'layout' => "{items}",
                        'itemOptions' => [
                            'tag' => false,
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12" style="padding-right: 0px; padding-left: 0px;">
                <div class="line-spacing"></div>
            </div>
        </div>
    </div>
</div>

<div class="spacing-cozxy bg-white">&nbsp;</div>

<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="head-all-new-v2 text-section-padding">
                <h2>PRODUCT STORY</h2>
            </div>
            <div class="see-all-new-v2 hidden-sm hidden-xs">
                <a href="<?= Yii::$app->homeUrl ?>story/views-all/">SEE MORE ></a>
            </div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $productStory,
                        'summary' => "",
                        'options' => [
                            'tag' => false,
                        ],
                        'itemView' => function ($model, $key, $index, $widget) { //$widget,
                            //echo $model->productId, ',';
                            return $this->render('@app/themes/cozxy/layoutsV2/product/swiper/_swiper_product_item_story', ['model' => $model, 'index' => $index]);
                        },
                        // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                        //'layout' => "{summary}{pager}{items}",
                        'layout' => "{items}",
                        'itemOptions' => [
                            'tag' => false,
                        ],
                        //'itemOptions' => ['class' => 'item'],
                    ]);
                    ?>
                </div>
                <!-- Add Pagination -->

                <?php if($UserAgent == 'mobile') { ?>
                    <div class="swiper-pagination"></div><?php } ?>
                <!-- Add Arrows -->
                <?php if($UserAgent != 'mobile') { ?>
                    <div class="swiper-button-next" style="background-image: none !important;">
                        <span class="glyphicon glyphicon-menu-right"></span></div>
                    <div class="swiper-button-prev" style="background-image: none !important;">
                        <span class="glyphicon glyphicon-menu-left"></span></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="spacing-cozxy bg-white">&nbsp;</div>