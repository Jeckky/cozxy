<?php
/* @var $this yii\web\View */


\frontend\assets\NewCozxyAsset::register($this);

$this->title = 'cozxy.com - Buy what fuels your passion';
?>

<?php if (isset($slideGroup)): ?>
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

<div class="spacing-cozxy bg-white">&nbsp;</div>

<!--/ slide prodcut  /-->
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <h2>HOT DEALS 30% - 70%</h2>
            <div class="col-xs-12 col-md-12">

                <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="2000" id="fruitscarousel">
                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $sectionItem,
                            'summary' => "",
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) { //$widget,
                                //echo $model->productId, ',';
                                return $this->render('@app/themes/cozxy/layoutsV2/product/_new_prodcut_items_hot_deals', ['model' => $model, 'index' => $index]);
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
                    <a class="left carousel-control" href="#fruitscarousel" data-slide="prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                    </a>
                    <a class="right carousel-control" href="#fruitscarousel" data-slide="next">
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacing-cozxy bg-white">&nbsp;</div>

<!--/ category  /-->
<div class="bg-white">
    <div class="container-cozxy">
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

<!--/   prodcut  items /-->
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="head-all-new-v2">
                <h2>SUNGLASSES BEST SELLER</h2>
            </div>
            <div class="see-all-new-v2 hidden-sm hidden-xs">
                <a href="<?= Yii::$app->homeUrl ?>site/see-all-sale/">see all ></a>
            </div>
            <div class="col-xs-12 col-md-12">

                <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="2000" id="cozxycarousel1">
                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productCanSellBySunglasses,
                            'summary' => "",
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) { //$widget,
                                //echo $model->productId, ',';
                                return $this->render('@app/themes/cozxy/layoutsV2/product/_new_prodcut_items', ['model' => $model, 'index' => $index]);
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
                    <a class="left carousel-control" href="#cozxycarousel1" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#cozxycarousel1" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
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

<!--/   prodcut  items /-->
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="head-all-new-v2">
                <h2>COSMETICS BEST SELLER</h2>
            </div>
            <div class="see-all-new-v2 hidden-sm hidden-xs">
                <a href="<?= Yii::$app->homeUrl ?>site/see-all-sale/">see all ></a>
            </div>
            <div class="col-xs-12 col-md-12">

                <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="2000" id="cozxyCarousel2">
                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productCanSellByCosmetics,
                            'summary' => "",
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) { //$widget,
                                //echo $model->productId, ',';
                                return $this->render('@app/themes/cozxy/layoutsV2/product/_new_prodcut_items', ['model' => $model, 'index' => $index]);
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
                    <a class="left carousel-control" href="#cozxyCarousel2" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#cozxyCarousel2" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
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
                        <img src="<?= isset($BannerPromotes2['image']) ? $BannerPromotes1['image'] : 'https://scontent.fbkk1-4.fna.fbcdn.net/v/t31.0-8/27913153_165864184196694_233336126967648172_o.jpg?oh=a2902b97e0cb4068c0a8d28ccd01be5d&oe=5B0FEE1B' ?>" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%; height: 20%;">
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
            <div class="head-all-new-v2"><h2>RECOMMENDED</h2></div>
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
                    <a href="<?= Yii::$app->homeUrl ?>site/see-all-sale/">see more</a>
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
                        <img src="<?= isset($BannerPromotes3['image']) ? $BannerPromotes1['image'] : 'https://scontent.fbkk1-4.fna.fbcdn.net/v/t31.0-8/27797384_165864170863362_7213802211719036278_o.jpg?oh=e4427da2ba39572e4d8b1f0d92a2ee46&oe=5B100B35' ?>" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%; height: 20%;">
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
            <div class="head-all-new-v2">
                <h2>ALL THE BAGS</h2>
            </div>
            <div class="see-all-new-v2 text-right hidden-sm hidden-xs">
                <a href="<?= Yii::$app->homeUrl ?>site/see-all-sale/">see all ></a>
            </div>
            <div class="col-xs-12 col-md-12">

                <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="2000" id="cozxyCarousel4">

                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productCanSellByBags,
                            'summary' => "",
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) { //$widget,
                                //echo $model->productId, ',';
                                return $this->render('@app/themes/cozxy/layoutsV2/product/_product_item_not_sale_rev1', ['model' => $model, 'index' => $index]);
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
                    <a class="left carousel-control" href="#cozxyCarousel4" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#cozxyCarousel4" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
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
            <div class="head-all-new-v2">
                <h2>ITEMS YOU MAY LIKE</h2>
            </div>
            <div class="see-all-new-v2 text-right hidden-sm hidden-xs">
                <a href="<?= Yii::$app->homeUrl ?>site/see-all-section-item?sectionId=10">see all ></a>
            </div>
            <div class="col-xs-12 col-md-12">

                <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="2000" id="cozxyCarousel5">
                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productCanSellByYouMayLike,
                            'summary' => "",
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) { //$widget,
                                //echo $model->productId, ',';
                                return $this->render('@app/themes/cozxy/layoutsV2/product/_new_prodcut_items', ['model' => $model, 'index' => $index]);
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
                    <a class="left carousel-control" href="#cozxyCarousel5" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#cozxyCarousel5" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
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

<!--/   prodcut  items story/-->
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="head-all-new-v2">
                <h2>PRODUCT STORY</h2>
            </div>
            <div class="see-all-new-v2 text-right hidden-sm hidden-xs">
                <a href="<?= Yii::$app->homeUrl ?>/story/views-all/">see all ></a>
            </div>
            <div class="col-xs-12 col-md-12">

                <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="2000" id="cozxyCarousel6">
                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productStory,
                            'summary' => "",
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) { //$widget,
                                //echo $model->productId, ',';
                                return $this->render('@app/themes/cozxy/layoutsV2/product/_product_item_story', ['model' => $model, 'index' => $index]);
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
                    <a class="left carousel-control" href="#cozxyCarousel6" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#cozxyCarousel6" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="spacing-cozxy bg-white">&nbsp;</div>