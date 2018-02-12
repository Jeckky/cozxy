<?php
/* @var $this yii\web\View */


\frontend\assets\NewCozxyAsset::register($this);

$this->title = 'test new layout cozxy.com - Buy what fuels your passion';
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
                        return $this->render('@app/themes/cozxy/layouts/_slide_rev1', ['model' => $model, 'index' => $index]);
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
<div class="size6 bg-white">&nbsp;</div>


<!--/ slide prodcut  /-->
<div class="bg-white" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <h2>HOT DEALS 30% - 70%</h2>
                <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="2000" id="fruitscarousel">

                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productCanSell,
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

                    <a class="left carousel-control" href="#fruitscarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#fruitscarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="size6 bg-white">&nbsp;</div>


<!--/ category  /-->
<div class="bg-white" >
    <div class="container-cozxy">
        <div class="row">
            <div class="col-xs-12">
                <div class="media-carousel-x">
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
<div class="size6 bg-white">&nbsp;</div>

<!--/   prodcut  items /-->
<div class="bg-white" >
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-12">
                <div class="head-all-new-v2">
                    <h2>SUNGLASSES BEST SELLER</h2>
                </div>
                <div class="see-all-new-v2">
                    see all >
                </div>


                <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="2000" id="cozxycarousel1">

                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productCanSell,
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
<div class="size6 bg-white">&nbsp;</div>

<!--// Good Reads -->
<div class="bg-white" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" id="media1">
                    <div class="carousel-inner">
                        <img src="/cozxy/frontend/web/images/story/1-Home page copy 2.jpg" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%; height: 20%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="size6 bg-white">&nbsp;</div>

<!--/   prodcut  items /-->
<div class="bg-white" >
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-12">
                <div class="head-all-new-v2">
                    <h2>COSMETICS BEST SELLER</h2>
                </div>
                <div class="see-all-new-v2 hidden-sm hidden-xs">
                    see all >
                </div>
                <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="2000" id="cozxyCarousel2">

                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productCanSell,
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
<div class="size6 bg-white">&nbsp;</div>

<!--// Good Reads -->
<div class="bg-white" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide row" id="media1">
                    <div class="carousel-inner">
                        <img src="/cozxy/frontend/web/images/story/1-Home page copy 3.jpg" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%; height: 20%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="size6 bg-white">&nbsp;</div>

<!--/   prodcut  items /-->
<div class="bg-white" >
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-12">
                <div class="head-all-new-v2"><h2>RECOMMENDED</h2></div>
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
                <div class="see-all-new-v2">
                    see more
                </div>
            </div>
        </div>
    </div>
</div>
<div class="size6 bg-white">&nbsp;</div>

<div class="bg-white" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide row" id="media1">

                    <div class="carousel-inner">
                        <img src="/cozxy/frontend/web/images/story/1-Home page copy 4.jpg" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%; height: 20%;">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="size6 bg-white">&nbsp;</div>

<!--/   prodcut  items /-->
<div class="bg-white" >
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-12">
                <div class="head-all-new-v2">
                    <h2>ALL THE BAGS</h2>
                </div>
                <div class="see-all-new-v2">
                    see all >
                </div>
                <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="2000" id="cozxyCarousel4">

                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productCanSell,
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

                    <a class="left carousel-control" href="#cozxyCarousel4" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#cozxyCarousel4" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="size6 bg-white">&nbsp;</div>

<!--/   prodcut  items /-->
<div class="bg-white" >
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-12">
                <div class="head-all-new-v2">
                    <h2>ITEMS YOU MAY LIKE</h2>
                </div>
                <div class="see-all-new-v2">
                    see all >
                </div>
                <div class="carousel slide row" data-ride="carousel" data-type="multi" data-interval="2000" id="cozxyCarousel5">

                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productCanSell,
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

<div class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" >
                    <div style=" border:  1px solid #f5f5f5; height: 10px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--/ category  /-->
<div class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" id="media1">
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $category,
                        'summary' => "",
                        'options' => [
                            'tag' => false,
                        ],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('@app/themes/cozxy/layoutsV2/category/_items_category_v2_1', ['model' => $model, 'index' => $index]);
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

<div class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" >
                    <div style=" border:  1px solid #f5f5f5; height: 10px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--/   prodcut  items /-->
<div class="bg-white" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="head-all-new-v2">
                    <h2>PRODUCT STORY</h2>
                </div>
                <div class="see-all-new-v2">
                    see all >
                </div>
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
<div class="size6 bg-white">&nbsp;</div>