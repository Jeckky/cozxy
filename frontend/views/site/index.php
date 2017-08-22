<?php
/* @var $this yii\web\View */

\frontend\assets\HomePageAsset::register($this);
$this->registerCss('
.mca {
	padding: 10px 10px 6px;
	font-size: 16px;
	background-color: #fff;
}
/* Banner Parade */
#logoParade {
	position: relative;
	width: 100%;
	height: 64px;
	margin: 24px 0;
	padding: 0 48px;
}
#logoParade div.scrollableArea a {
	display: block;
	float: left;
	margin: 0 8px;
	padding: 0 8px;
}
#logoParade .scrollingHotSpotLeft, #logoParade .scrollingHotSpotRight {
	display: block !important;
	opacity: 1 !important;
}
#logoParade .scrollingHotSpotLeft {
	background: #fff url(imgs/ban-arrow-left.png) center no-repeat;
}
#logoParade .scrollingHotSpotRight {
	background: #fff url(imgs/ban-arrow-right.png) center no-repeat;
}
');


$this->registerJs('
$(function() {
	$("#logoParade").smoothDivScroll({
		manualContinuousScrolling: true
	});
});
', yii\web\View::POS_END);
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
                    'options' => [
                        'tag' => false,
                    ],
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('@app/themes/cozxy/layouts/_slide', ['model' => $model, 'index' => $index]);
                    },
//                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                    //'layout'=>"{summary}{pager}{items}"
                    'layout' => "{items}",
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

<?php if (isset($productBrand)): ?>
    <!--Brands-->
    <div class="bg-white" style="border-bottom:1px solid #eaeaea">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="rela" style="height:96px">
                        <!--<a class="align-middle fc-g999 size24 scrollingHotSpotLeft" href="#" style="padding-top:8px;left:0"><span class="glyphicon glyphicon-menu-left"></span></a>-->
                        <div id="logoParade">
                            <?php
                            echo \yii\widgets\ListView::widget([
                                'dataProvider' => $productBrand,
                                'options' => [
                                    'tag' => false,
                                ],
                                'itemView' => function ($model, $key, $index, $widget) {
                                    return $this->render('@app/themes/cozxy/layouts/_brand', ['model' => $model, 'index' => $index]);
                                },
                                // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                                //'layout'=>"{summary}{pager}{items}"
                                'layout' => "{items}",
                                'itemOptions' => [
                                    'tag' => false,
                                ],
                            ]);
                            ?>
                        </div>
                        <!--<a class="align-middle fc-g999 size24 scrollingHotSpotRight" href="#" style="padding-top:8px;right:0"><span class="glyphicon glyphicon-menu-right"></span></a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="size6">&nbsp;</div>
<div class="new-product">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <?php if (isset($promotions) && $promotions->getCount() > 0): ?>
                    <h3 class="b text-center-sm text-center-xs">HOT DEALS</h3>
                    <div class="row">
                        <?php
//                        yii\widgets\Pjax::begin(['id' => 'promotions', 'timeout' => false, 'enablePushState' => false])
                        ?>
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $promotions,
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('@app/themes/cozxy/layouts/product/_product_item_rev1', ['model' => $model]);
                            },
//                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                            //'layout'=>"{summary}{pager}{items}"
//                            'layout' => "{items}",
                            'layout' => (Yii::$app->controller->action->id == "see-all-promotions") ? "{summary}\n{items}\n<center>{pager}</center>\n" : "{items}",
                            'itemOptions' => [
                                'tag' => false,
                                'pager' => (Yii::$app->controller->action->id == "see-all-promotions") ? [
                                    'firstPageLabel' => 'first',
                                    'lastPageLabel' => 'last',
                                    'prevPageLabel' => 'previous',
                                    'nextPageLabel' => 'next',
                                    'maxButtonCount' => 3,
                                ] : [],
                            ],
                        ]);
//                        yii\widgets\Pjax::end();
                        ?>
                    </div>
                    <?php if (Yii::$app->controller->action->id != "see-all-promotions"): ?>
                        <div class="col-sm-12 text-center" style="margin-top: 15px;">
                            <a href="<?= Yii::$app->homeUrl ?>site/see-all-promotions/" class="subs-btn size14-xs">See All</a>
                        </div>
                        <br><br>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($productCanSell)): ?>
                    <hr style="border-color:rgb(254, 230, 10)">
                    <h3 class="b text-center-sm text-center-xs">RECOMMENDED</h3>
                    <div class="row">
                        <!--RECOMMENDED-->
                        <?php
//                        yii\widgets\Pjax::begin(['id' => 'sale', 'timeout' => false, 'enablePushState' => false])
                        ?>
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productCanSell,
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('@app/themes/cozxy/layouts/product/_product_item_rev1', ['model' => $model]);
                            },
//                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                            //'layout'=>"{summary}{pager}{items}"
//                            'layout' => "{items}",
                            'layout' => (Yii::$app->controller->action->id == "see-all-sale") ? "{summary}\n{items}\n<center>{pager}</center>\n" : "{items}",
                            'itemOptions' => [
                                'tag' => false,
                                'pager' => (Yii::$app->controller->action->id == "see-all-sale") ? [
                                    'firstPageLabel' => 'first',
                                    'lastPageLabel' => 'last',
                                    'prevPageLabel' => 'previous',
                                    'nextPageLabel' => 'next',
                                    'maxButtonCount' => 3,
                                ] : [],
                            ],
                        ]);
//                        yii\widgets\Pjax::end();
                        ?>
                    </div>
                    <?php if (Yii::$app->controller->action->id != "see-all-sale"): ?>
                        <div class="col-sm-12 text-center" style="margin-top: 15px;">
                            <a href="<?= Yii::$app->homeUrl ?>site/see-all-sale/" class="subs-btn size14-xs">See All</a>
                        </div>
                        <br><br>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($productNotSell)): ?>
                    <hr style="border-color:rgb(254, 230, 10)">

                    <h3 class="b text-center-sm text-center-xs">EXPLORE</h3>

                    <blockquote style="font-size: 14px;">
                        <p>Find details, prices, and stories on other products coming to our website soon.</p>
                        <!--<footer>Someone famous in <cite title="Source Title">Source</cite></footer>-->
                    </blockquote>

                    <div class="row">
                        <!--PRODUCTS-->
                        <?php
//                        yii\widgets\Pjax::begin(['id' => 'notsale', 'timeout' => false, 'enablePushState' => false])
                        ?>
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productNotSell,
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('@app/themes/cozxy/layouts/product/_product_item_not_sale_rev1', ['model' => $model]);
                            },
//                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                            //'layout'=>"{summary}p{pager}{items}"
                            'layout' => (Yii::$app->controller->action->id == "see-all-not-sale") ? "{summary}\n{items}\n<center>{pager}</center>\n" : "{items}",
//                            'layout' => "{items}",
                            'itemOptions' => [
                                'tag' => false,
                                'pager' => (Yii::$app->controller->action->id == "see-all-not-sale") ? [
                                    'firstPageLabel' => 'first',
                                    'lastPageLabel' => 'last',
                                    'prevPageLabel' => 'previous',
                                    'nextPageLabel' => 'next',
                                    'maxButtonCount' => 3,
                                ] : [],
                            ],
                        ]);
//                        yii\widgets\Pjax::end();
                        ?>
                    </div>
                    <?php if (Yii::$app->controller->action->id != "see-all-not-sale"): ?>
                        <div class="col-sm-12 text-center" style="margin-top: 15px;">
                            <a href="<?= Yii::$app->homeUrl ?>site/see-all-not-sale/" class="subs-btn size14-xs">See All</a>
                        </div>
                        <br><br>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($productStory)): ?>
                    <hr style="border-color:rgb(254, 230, 10)">

                    <h3 class="b text-center-sm text-center-xs">PRODUCTS'STORIES</h3>
                    <div class="row">
                        <!--Products' Stories-->
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productStory,
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('@app/themes/cozxy/layouts/product/_product_item_story', ['model' => $model]);
                            }, 'emptyText' => ' &nbsp; &nbsp; No results found.',
//                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                            //'layout'=>"{summary}{pager}{items}"
                            'layout' => "{items}",
                            'itemOptions' => [
                                'tag' => false,
                            ],
                        ]);
                        ?>
                    </div>

                    <div class="col-sm-12 text-center" style="margin-top: 15px;margin-bottom: 20px;">
                        <a href="<?= Yii::$app->homeUrl ?>story/views-all/" class="subs-btn size14-xs">See All</a>
                    </div>
                    <br><br>

                <?php endif; ?>
            </div>


            <div class="col-md-3">
                <?php if (isset($otherProducts)): ?>
                    <h3 class="b text-center-sm text-center-xs">GOOD READS</h3>
                    <div class="row">

                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $otherProducts,
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('@app/themes/cozxy/layouts/content/_content_items', ['model' => $model]);
                            }, 'emptyText' => '<div class="col-xs-12"><div class="product-other fullwidth" style="height:260px; font-variant: small-caps; text-align: center;vertical-align: middle;
line-height:35px;"><br><br><br>No results found.</div></div>',
                            //'layout'=>"{summary}{pager}{items}"
                            'layout' => "{items}",
                            'itemOptions' => [
                                'tag' => false,
                            ],
                        ]);
                        ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
