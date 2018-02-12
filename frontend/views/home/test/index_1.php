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

<!--/ slide prodcut  /-->
<div class="bg-white" >
    <div class="container-x">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" id="media1">
                    <h1>SUNGLASSES BEST SELLER</h1>
                    <div class="carousel-inner">
                        <div class="item  active">
                            <div class="row">
                                <?php
                                for ($index1 = 0; $index1 < 6; $index1++) {
                                    ?>
                                    <div class="col-md-2 col-sm-3 col-xs-3 box-product new-themes-product-items">
                                        <div class="product-box">
                                            <div class="product-sticker">
                                                <div class="rcorners4">
                                                    <p>
                                                        <span class="discount"> 25</span><span class="percen-discount">%</span></p><div class="off-style">OFF</div><p></p>
                                                    <p>  </p>
                                                </div>
                                                <div class="triangle"></div>
                                            </div>
                                            <div class="product-img text-center">
                                                <a  href="/cozxy/frontend/web/product/TjVS4zYHodLRoLFcnFkRy3ihL5RZOKxdphrRMIdp2KU%3D" class="fc-black  ">
                                                    <img class="media-object fullwidth img-responsive" src="/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/a61VDMzH4fZis0sVzAXATQzDyzJN14ZF.jpg">
                                                </a>
                                                <div class="v-hover">
                                                    <a href="/cozxy/frontend/web/product/LpCvpN88FKzYjWip4K85qioA54gcO6VP0UjYU0KzBug%3D">
                                                        <div class="col-xs-4"><i class="fa fa-eye" aria-hidden="true"></i></div>
                                                    </a>
                                                    <a href="javascript:addItemToDefaultWishlist(4997);" id="heartbeat-4997" data-loading-text="<div class='col-xs-4'><i class='fa fa-heart' aria-hidden='true'></i></div>" style="display: none;">
                                                        <div class="col-xs-4 heart-4997"><i class="fa fa-heart" aria-hidden="true"></i></div>
                                                    </a>
                                                    <a href="javascript:addItemToDefaultWishlist(4997);" id="heart-o-4997">
                                                        <div class="col-xs-4 heart-4997"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                                                    </a>
                                                    <a href="javascript:addItemToCartUnitys('1891',1,'1','FALSE','4997','33','1')" id="addItemsToCartMulti-1891" data-loading-text="<div class='col-xs-4 shopping-1891'><i class='fa fa-cart-plus fa-spin' aria-hidden='true'></i></div>">
                                                        <div class="col-xs-4 shopping-1891"><i id="cart-plus-1891" class="fa fa-cart-plus" aria-hidden="true"></i></div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-txt">
                                                <p class="brand">
                                                    <span class="size14">SK-II</span>
                                                </p>

                                                <p class="name">
                                                    <a href="/cozxy/frontend/web/product/LpCvpN88FKzYjWip4K85qioA54gcO6VP0UjYU0KzBug%3D" class="size18 b">
                                                        SK-II MEN FACIAL TREATMENT ESSENCE 160 ML.                </a>
                                                </p>
                                                <p class="price">
                                                    <span class="size18 fc-red">4,275 THB </span><br>
                                                    <span class="size14 onsale">5,700 THB </span>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="row">
                                    <?php
                                    for ($index1 = 0; $index1 < 6; $index1++) {
                                        ?>
                                        <div class="col-md-2 col-sm-3 col-xs-3 box-product new-themes-product-items">
                                            <div class="product-box">
                                                <div class="product-sticker">
                                                    <div class="rcorners4">
                                                        <p>
                                                            <span class="discount"> 25</span><span class="percen-discount">%</span></p><div class="off-style">OFF</div><p></p>
                                                        <p>  </p>
                                                    </div>
                                                    <div class="triangle"></div>
                                                </div>
                                                <div class="product-img text-center">
                                                    <a href="/cozxy/frontend/web/product/TjVS4zYHodLRoLFcnFkRy3ihL5RZOKxdphrRMIdp2KU%3D" class="fc-black  ">
                                                        <img class="media-object fullwidth img-responsive" src="/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/LTeYwcgNendMqPyfxjHQd8fZlnQD6kI-.jpg">
                                                    </a>
                                                    <div class="v-hover">
                                                        <a href="/cozxy/frontend/web/product/LpCvpN88FKzYjWip4K85qioA54gcO6VP0UjYU0KzBug%3D">
                                                            <div class="col-xs-4"><i class="fa fa-eye" aria-hidden="true"></i></div>
                                                        </a>
                                                        <a href="javascript:addItemToDefaultWishlist(4997);" id="heartbeat-4997" data-loading-text="<div class='col-xs-4'><i class='fa fa-heart' aria-hidden='true'></i></div>" style="display: none;">
                                                            <div class="col-xs-4 heart-4997"><i class="fa fa-heart" aria-hidden="true"></i></div>
                                                        </a>
                                                        <a href="javascript:addItemToDefaultWishlist(4997);" id="heart-o-4997">
                                                            <div class="col-xs-4 heart-4997"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                                                        </a>
                                                        <a href="javascript:addItemToCartUnitys('1891',1,'1','FALSE','4997','33','1')" id="addItemsToCartMulti-1891" data-loading-text="<div class='col-xs-4 shopping-1891'><i class='fa fa-cart-plus fa-spin' aria-hidden='true'></i></div>">
                                                            <div class="col-xs-4 shopping-1891"><i id="cart-plus-1891" class="fa fa-cart-plus" aria-hidden="true"></i></div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-txt">
                                                    <p class="brand">
                                                        <span class="size14">SK-II</span>
                                                    </p>

                                                    <p class="name">
                                                        <a href="/cozxy/frontend/web/product/LpCvpN88FKzYjWip4K85qioA54gcO6VP0UjYU0KzBug%3D" class="size18 b">
                                                            SK-II MEN FACIAL TREATMENT ESSENCE 160 ML.                </a>
                                                    </p>
                                                    <p class="price">
                                                        <span class="size18 fc-red">4,275 THB </span><br>
                                                        <span class="size14 onsale">5,700 THB </span>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <?php
                                for ($index1 = 0; $index1 < 6; $index1++) {
                                    ?>
                                    <div class="col-md-2 col-sm-3 col-xs-3 box-product new-themes-product-items">
                                        <div class="product-box">
                                            <div class="product-sticker">
                                                <div class="rcorners4">
                                                    <p>
                                                        <span class="discount"> 25</span><span class="percen-discount">%</span></p><div class="off-style">OFF</div><p></p>
                                                    <p>  </p>
                                                </div>
                                                <div class="triangle"></div>
                                            </div>
                                            <div class="product-img text-center">
                                                <a href="/cozxy/frontend/web/product/TjVS4zYHodLRoLFcnFkRy3ihL5RZOKxdphrRMIdp2KU%3D" class="fc-black">
                                                    <img class="media-object fullwidth img-responsive" src="/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/q19Ds2VLPQ0hDIN5j28IjfnfWzKVfuRu.jpg">
                                                </a>
                                                <div class="v-hover">
                                                    <a href="/cozxy/frontend/web/product/LpCvpN88FKzYjWip4K85qioA54gcO6VP0UjYU0KzBug%3D">
                                                        <div class="col-xs-4"><i class="fa fa-eye" aria-hidden="true"></i></div>
                                                    </a>
                                                    <a href="javascript:addItemToDefaultWishlist(4997);" id="heartbeat-4997" data-loading-text="<div class='col-xs-4'><i class='fa fa-heart' aria-hidden='true'></i></div>" style="display: none;">
                                                        <div class="col-xs-4 heart-4997"><i class="fa fa-heart" aria-hidden="true"></i></div>
                                                    </a>
                                                    <a href="javascript:addItemToDefaultWishlist(4997);" id="heart-o-4997">
                                                        <div class="col-xs-4 heart-4997"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                                                    </a>
                                                    <a href="javascript:addItemToCartUnitys('1891',1,'1','FALSE','4997','33','1')" id="addItemsToCartMulti-1891" data-loading-text="<div class='col-xs-4 shopping-1891'><i class='fa fa-cart-plus fa-spin' aria-hidden='true'></i></div>">
                                                        <div class="col-xs-4 shopping-1891"><i id="cart-plus-1891" class="fa fa-cart-plus" aria-hidden="true"></i></div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-txt">
                                                <p class="brand">
                                                    <span class="size14">SK-II</span>
                                                </p>

                                                <p class="name">
                                                    <a href="/cozxy/frontend/web/product/LpCvpN88FKzYjWip4K85qioA54gcO6VP0UjYU0KzBug%3D" class="size18 b">
                                                        SK-II MEN FACIAL TREATMENT ESSENCE 160 ML.  </a>
                                                </p>
                                                <p class="price">
                                                    <span class="size18 fc-red">4,275 THB </span><br>
                                                    <span class="size14 onsale">5,700 THB </span>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
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
                    <h1>SUNGLASSES BEST SELLER</h1>
                    <div class="carousel-inner">
                        <img src="/cozxy/frontend/web/images/story/1-Home page copy 2.jpg" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%; height: 20%;">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
