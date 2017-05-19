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
');

$this->title = 'My Yii Application';
?>

<?= $this->render('@app/themes/cozxy/layouts/_slide') ?>

<!--Brands-->
<div class="bg-white" style="border-bottom:1px solid #eaeaea">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="rela" style="height:96px">
                    <!--<a class="align-middle fc-g999 size24 scrollingHotSpotLeft" href="#" style="padding-top:8px;left:0"><span class="glyphicon glyphicon-menu-left"></span></a>-->
                    <div id="logoParade">
                        <a href="#"><img src="imgs/banner01.png" alt=""></a>
                        <a href="#"><img src="imgs/banner02.png" alt=""></a>
                        <a href="#"><img src="imgs/banner03.png" alt=""></a>
                        <a href="#"><img src="imgs/banner04.png" alt=""></a>
                        <a href="#"><img src="imgs/banner05.png" alt=""></a>
                        <a href="#"><img src="imgs/banner06.png" alt=""></a>
                        <a href="#"><img src="imgs/banner07.png" alt=""></a>
                        <a href="#"><img src="imgs/banner08.png" alt=""></a>
                    </div>
                    <!--<a class="align-middle fc-g999 size24 scrollingHotSpotRight" href="#" style="padding-top:8px;right:0"><span class="glyphicon glyphicon-menu-right"></span></a>-->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="size6">&nbsp;</div>
<div class="new-product">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h3 class="b text-center-sm text-center-xs">RECOMMENDED</h3>
                <div class="row">
                    <!--RECOMMENDED-->
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $productCanSell,
                        'options' => [
                            'tag' => false,
                        ],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('@app/themes/cozxy/layouts/product/_product_item', ['model' => $model]);
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

                <hr style="border-color:rgb(254, 230, 10)">

                <h3 class="b text-center-sm text-center-xs">PRODUCTS</h3>
                <div class="row">
                    <!--PRODUCTS-->
                    <?php
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $productNotSell,
                        'options' => [
                            'tag' => false,
                        ],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('@app/themes/cozxy/layouts/product/_product_item_not_sale', ['model' => $model]);
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
            </div>


            <div class="col-md-3">
                <h3 class="b text-center-sm text-center-xs">OTHER PRODUCTS</h3>
                <div class="row">
                    <?php for ($i = 1; $i <= 6; $i++): ?>
                        <div class="col-xs-12">
                            <div class="product-other">
                                <a href="#"><img src="imgs/other0<?= $i ?>.jpg" alt="Other Product" class="fullwidth"></a>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</div>



