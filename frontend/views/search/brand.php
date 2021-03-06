<?php
/* @var $this yii\web\View */
$this->registerCss('
/* style for waterfall grid */
.wf-container {
	margin: 0 auto;
}
.wf-container:before,.wf-container:after {
	content: \'\';
	display: table;
}
.wf-container:after {
	clear: both;
}
.wf-column {
	float: left;
}
.wf-box {
	margin: 10px;
}

/*@media screen and (min-width: 768px) {
	.wf-container { width: 750px; }
	.product-menu .dropdown-menu { min-width: 384px; }
}
@media screen and (min-width: 992px) {
	.wf-container { width: 970px; }
}
@media screen and (min-width: 1200px) {
	.wf-container { width: 1170px; }
}*/

.product-menu {
	background-color: #fff;
	border-bottom: 1px solid #666;
}
.product-menu .items {
	display: inline-block;
	cursor: pointer;
}
.product-menu .dropdown-toggle {
	padding: 16px 24px 16px 8px;
	font-weight: 700;
}
.product-menu .dropdown-menu {
	border-radius: 0;
	border-color: #fee60a;
	background-color: #fee60a;
	margin: 1px;
	padding: 8px;
}
/* jquery-ui */
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
    border: 1px solid #000;
    background: #000;
}
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-button {
    border: 1px solid #210;
    background: #210;
}
.ui-widget-header {
    background: #000;
}
.ui-widget.ui-widget-content {
    border: 0px solid transparent;
}
.ui-slider-horizontal {
	height: 3px;
}
.ui-slider-horizontal .ui-slider-handle {
	width: 18px;
	height: 18px;
	top: -8px;
	border-radius: 50%;
}
.pagination{
    width: 100%;

}
');

$this->registerJs('
$(function() {
	var waterfall = new Waterfall({
		containerSelector: \'.wf-container\',
		boxSelector: \'.wf-box\',
		minBoxWidth: 256
	});
	$( "#slider-range" ).slider({
		range: true,
		min: 100,
		max: 50000,
		values: [ 100, 6000 ],
		slide: function( event, ui ) {
			$( "#amount" ).val( "From " + ui.values[ 0 ] + " THB to " + ui.values[ 1 ] + " THB");
		}
	});
	$( "#amount" ).val( "From " + $( "#slider-range" ).slider( "values", 0 ) + " THB to " + $( "#slider-range" ).slider( "values", 1 ) + " THB" );
});
');
\frontend\assets\SearchAsset::register($this);

$this->title = 'Brand ' . $brandName;
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs('
$(function() {
	var waterfall = new Waterfall({
		containerSelector: \'.wf-container\',
		boxSelector: \'.wf-box\',
		minBoxWidth: 256
	});
	$( "#slider-range" ).slider({
		range: true,
		min: ' . $brandPrice['minPrice'] . ',
		max: ' . $brandPrice['maxPrice'] . ',
		values: [ ' . $brandPrice['minPrice'] . ', ' . $brandPrice['maxPrice'] . ' ],
		slide: function( event, ui ) {
			$( "#amount" ).val( "From " + ui.values[ 0 ] + " THB to " + ui.values[ 1 ] + " THB");
            $("input:hidden:eq(0)","#amount-min").val(ui.values[ 0 ]);
            $("input:hidden:eq(1)","#amount-min").val(ui.values[ 1 ]);

		},
        stop: function (event, ui) {
        }
	});
	$( "#amount" ).val( "From " + $( "#slider-range" ).slider( "values", 0 ) + " THB to " + $( "#slider-range" ).slider( "values", 1 ) + " THB" );
});
');
\frontend\assets\SearchAsset::register($this);
?>

<?=
$this->render('@app/themes/cozxy/layouts/search/_search_filter_price', [
    'brandId' => $brandId
]);
?>
<div class="product-list">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-12 brand-price-filter">
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
                        return $this->render('@app/themes/cozxy/layouts/product/_product_item_rev1', ['model' => $model, 'hotDeal' => 1]);
                    },
//                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                            //'layout'=>"{summary}{pager}{items}"
//                            'layout' => "{items}",
                            //'layout' => "{summary}\n{items}\n<div class=' text-center'>{pager}</div>\n",
                            'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
                            'layout' => "{summary}\n{items}\n<div class ='col-lg-offset-3'>{pager}</div>\n",
                            'itemOptions' => [
                                'tag' => false,
                                'pager' => [
                                    'firstPageLabel' => 'first',
                                    'lastPageLabel' => 'last',
                                    'prevPageLabel' => 'previous',
                                    'nextPageLabel' => 'next',
                                    'maxButtonCount' => 3,
                                ],
                            ],
                        ]);
//                        yii\widgets\Pjax::end();
                        ?>
                    </div>

                <?php endif; ?>
                <?php if ($productCanSell->getTotalCount() > 0): ?>
                    <h3 class="b" style="word-wrap: break-word;white-space: normal;">RECOMMENDED <?= ':: ' . strtoupper($brandName) ?></h3>
                    <div class="row">
                        <div class="wf-container">
                            <?php
                            yii\widgets\Pjax::begin([
//                                'enablePushState' => false, // to disable push state
//                                'enableReplaceState' => false // to disable replace state
                            ]);
                            echo \yii\widgets\ListView::widget([
                                'dataProvider' => $productCanSell,
                                'options' => [
                                    'tag' => false,
                                ],
                                'itemView' => function ($model, $key, $widget, $brandName) {

                            return $this->render('@app/themes/cozxy/layouts/product/_product_item_rev1', ['model' => $model]);
                        },
                                'emptyText' => '<div class="col-xs-12"><div class="product-other fullwidth" style="height:260px; font-variant: small-caps; text-align: center;vertical-align: middle;
line-height:35px;"><br><br><br>No results found.</div></div>',
                                'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
                                'layout' => "{summary}\n{items}\n<div class =' col-lg-offset-3'>{pager}</div>\n",
                                //'layout' => "{items}",
                                'itemOptions' => [
                                    'tag' => false,
                                ], 'pager' => [
                                    'firstPageLabel' => 'first',
                                    'lastPageLabel' => 'last',
                                    'prevPageLabel' => 'previous',
                                    'nextPageLabel' => 'next',
                                    'maxButtonCount' => 3,
                                ],
                            ]);
                            yii\widgets\Pjax::end();
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($productNotSell->getTotalCount() > 0): ?>
                    <h3 class="b" style="word-wrap: break-word;white-space: normal;">PRODUCTS<?= ' :: ' . strtoupper($brandName) ?></h3>
                    <div class="row">
                        <div class="wf-container">
                            <div class="filter-product-cozxy-not-sale">
                                <?php
                                yii\widgets\Pjax::begin([
//                                    'enablePushState' => false, // to disable push state
//                                    'enableReplaceState' => false // to disable replace state
                                ]);
                                echo \yii\widgets\ListView::widget([
                                    'dataProvider' => $productNotSell,
                                    'options' => [
                                        'tag' => false,
                                    ],
                                    'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('@app/themes/cozxy/layouts/product/_product_item_not_sale_rev1', ['model' => $model]);
                            }, 'emptyText' => '<div class="col-xs-12"><div class="product-other fullwidth" style="height:260px; font-variant: small-caps; text-align: center;vertical-align: middle;
line-height:35px;"><br><br><br>No results found.</div></div>',
                                    'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
                                    'layout' => "{summary}\n{items}\n<div class ='  col-lg-offset-3'>{pager}</div>\n",
                                    //'layout' => "{items}",
                                    'itemOptions' => [
                                        'tag' => false,
                                    ], 'pager' => [
                                        'firstPageLabel' => 'first',
                                        'lastPageLabel' => 'last',
                                        'prevPageLabel' => 'previous',
                                        'nextPageLabel' => 'next',
                                        'maxButtonCount' => 3,
                                    ],
                                ]);
                                yii\widgets\Pjax::end();
                                ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="size18">&nbsp;</div>
                <?= $this->render('@app/themes/cozxy/layouts/story/_panel_recent_stories') ?>
            </div>
            <!--<div class="col-xs-12 text-center">
                <a href="#" class="b btn-black" style="margin:24px auto 32px">SHOW MORE
                    <span class="size16">&nbsp; ↓ </span></a>
            </div>-->
        </div>
    </div>
</div>
