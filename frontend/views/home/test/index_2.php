<?php
/* @var $this yii\web\View */


\frontend\assets\NewCozxyAsset::register($this);

$this->title = 'test new themes cozxy.com - Buy what fuels your passion';
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

<!--/ slide prodcut  /-->
<div class="bg-white" >
    <div class="container-x">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" id="media">
                    <h1>HOT DEALS 30% - 70%</h1>
                    <div class="carousel-inner">
                        <div class="item  active">
                            <div class="row">
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a data-slide="prev" href="#media" class="left carousel-control fc-black mca"><span class="glyphicon glyphicon-menu-left"></span>
                        <span class="sr-only">Previous</span></a>
                    <a data-slide="next" href="#media" class="right carousel-control fc-black mca"><span class="glyphicon glyphicon-menu-right"></span>
                        <span class="sr-only">Next</span></a>
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
                    <!--<div class="col-md-4">
                        <img src="<?= Yii::$app->homeUrl ?>images/Category/1-Home page copy.jpg">
                        <h3>xxx</h3>
                    </div>
                    <div class="col-md-4">
                        <img src="<?= Yii::$app->homeUrl ?>images/Category/1-Home page copy.jpg">
                        <h3>xxx</h3>
                    </div>
                    <div class="col-md-4">
                        <img src="<?= Yii::$app->homeUrl ?>images/Category/1-Home page copy.jpg">
                        <h3>xxx</h3>
                    </div>-->

                </div>
            </div>
        </div>
    </div>
</div>

<!--/   prodcut  items /-->
<div class="bg-white" >
    <div class="container-x">
        <div class="row">
            <div class="col-xs-12 col-md-12">

                <div class="carousel slide media-carousel" id="media1">
                    <h1>SUNGLASSES BEST SELLER</h1>
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
                                return $this->render('@app/themes/cozxy/layoutsV2/product/_new_prodcut_items_1_1', ['model' => $model, 'index' => $index]);
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
                    <a data-slide="prev" href="#media1" class="left carousel-control fc-black mca prev-product-items"><span class="glyphicon glyphicon-menu-left"></span>
                        <span class="sr-only">Previous</span></a>
                    <a data-slide="next" href="#media1" class="right carousel-control fc-black mca next-product-items"><span class="glyphicon glyphicon-menu-right"></span>
                        <span class="sr-only">Next</span></a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="size6 bg-white">&nbsp;</div>

<!--// Good Reads -->

<div class="bg-white" >
    <div class="container-x">
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

<!--/   prodcut  items /-->
<div class="bg-white" >
    <div class="container-x">
        <div class="row">
            <div class="col-xs-12 col-md-12">

                <div class="carousel slide media-carousel" id="media2">
                    <h1>COSMETICS BEST SELLER</h1>
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
                                return $this->render('@app/themes/cozxy/layoutsV2/product/_new_prodcut_items_1_1', ['model' => $model, 'index' => $index]);
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
                    <a data-slide="prev" href="#media2" class="left carousel-control fc-black mca prev-product-items"><span class="glyphicon glyphicon-menu-left"></span>
                        <span class="sr-only">Previous</span></a>
                    <a data-slide="next" href="#media2" class="right carousel-control fc-black mca next-product-items"><span class="glyphicon glyphicon-menu-right"></span>
                        <span class="sr-only">Next</span></a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="size6 bg-white">&nbsp;</div>

<!--// Good Reads -->

<div class="bg-white" >
    <div class="container-x">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" id="media1">

                    <div class="carousel-inner">
                        <img src="/cozxy/frontend/web/images/story/1-Home page copy 3.jpg" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%; height: 20%;">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!--/   prodcut  items /-->
<div class="bg-white" >
    <div class="container-x">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" id="media1">
                    <h1>RECOMMENDED</h1>
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

            </div>
        </div>
    </div>
</div>
<div class="size6 bg-white">&nbsp;</div>

<div class="bg-white" >
    <div class="container-x">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" id="media1">

                    <div class="carousel-inner">
                        <img src="/cozxy/frontend/web/images/story/1-Home page copy 4.jpg" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%; height: 20%;">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!--/   prodcut  items /-->
<div class="bg-white" >
    <div class="container-x">
        <div class="row">
            <div class="col-xs-12 col-md-12">

                <div class="carousel slide media-carousel" id="media3">
                    <h1>ALL THE BAGS</h1>
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
                                return $this->render('@app/themes/cozxy/layoutsV2/product/_new_prodcut_items_1_1', ['model' => $model, 'index' => $index]);
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
                    <a data-slide="prev" href="#media3" class="left carousel-control fc-black mca prev-product-items"><span class="glyphicon glyphicon-menu-left"></span>
                        <span class="sr-only">Previous</span></a>
                    <a data-slide="next" href="#media3" class="right carousel-control fc-black mca next-product-items"><span class="glyphicon glyphicon-menu-right"></span>
                        <span class="sr-only">Next</span></a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="size6 bg-white">&nbsp;</div>


<!--/   prodcut  items /-->
<div class="bg-white" >
    <div class="container-x">
        <div class="row">
            <div class="col-xs-12 col-md-12">

                <div class="carousel slide media-carousel" id="media4">
                    <h1>ITEMS YOU MAY LIKE</h1>
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
                                return $this->render('@app/themes/cozxy/layoutsV2/product/_new_prodcut_items_1_1', ['model' => $model, 'index' => $index]);
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
                    <a data-slide="prev" href="#media4" class="left carousel-control fc-black mca prev-product-items"><span class="glyphicon glyphicon-menu-left"></span>
                        <span class="sr-only">Previous</span></a>
                    <a data-slide="next" href="#media4" class="right carousel-control fc-black mca next-product-items"><span class="glyphicon glyphicon-menu-right"></span>
                        <span class="sr-only">Next</span></a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="size6 bg-white">&nbsp;</div>

<!--/ category  /-->
<div class="bg-white">
    <div class="container-x">
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
<div class="size6 bg-white">&nbsp;</div>

<!--/   prodcut  items /-->
<div class="bg-white" >
    <div class="container-x">
        <div class="row">
            <div class="col-xs-12 col-md-12">

                <div class="carousel slide media-carousel" id="media5">
                    <h1>PRODUCT STORY</h1>
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
                    <a data-slide="prev" href="#media5" class="left carousel-control fc-black mca prev-product-items"><span class="glyphicon glyphicon-menu-left"></span>
                        <span class="sr-only">Previous</span></a>
                    <a data-slide="next" href="#media5" class="right carousel-control fc-black mca next-product-items"><span class="glyphicon glyphicon-menu-right"></span>
                        <span class="sr-only">Next</span></a>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="size6 bg-white">&nbsp;</div>