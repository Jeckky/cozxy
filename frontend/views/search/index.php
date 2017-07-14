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
            $("input:hidden:eq(0)","#amount-min").val(ui.values[ 0 ]);
            $("input:hidden:eq(1)","#amount-min").val(ui.values[ 1 ]);
            $("input:hidden:eq(2)","#amount-min").val(' . $categoryId . ');

		},
        stop: function (event, ui) {
            //debugger;
            //var path = "' . Yii::$app->homeUrl . 'search/filter-price";
           /* $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {mins:ui.values[ 0 ],maxs:ui.values[ 1 ],categoryId:' . $categoryId . '},
                success: function (data){
                    alert(data.status);
                    if (data.status) {

                    } else {
                        alert(data.message);
                    }
                }
            });*/
        }
	});
	$( "#amount" ).val( "From " + $( "#slider-range" ).slider( "values", 0 ) + " THB to " + $( "#slider-range" ).slider( "values", 1 ) + " THB" );
});
');
\frontend\assets\SearchAsset::register($this);

if (isset($title) && !empty($title)) {
    $this->title = 'Search Categories ' . isset($title) ? strtoupper($title) : '';
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Search Categories ';
    $this->params['breadcrumbs'][] = $this->title;
    $title = '';
}
if (isset($_GET["search"]) && !empty($_GET['search'])) {
    $search = 'SEARCH : ' . $_GET["search"];
}
?>

<?=
$this->render('@app/themes/cozxy/layouts/search/_search_filter', [
    'categoryId' => $categoryId, 'productFilterBrand' => $productFilterBrand
]);
?>
<div class="product-list">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <div class="brand-price-filter  col-sm-12">
                    <div class="filter-product-cozxy col-sm-12">

                        <?php if ($productCanSell->getTotalCount() > 0): ?>
                            <h3 class="b">
                                <?php
                                if (isset($search)) {
                                    echo $search . '(RECOMMENDED)';
                                } else {
                                    echo strtoupper('category') . '::' . strtoupper($title) . '(RECOMMENDED)';
                                }
                                ?>
                                <?//= strtoupper('category') ?><!-- :: --><?//= strtoupper($title) ?> <!--(RECOMMENDED)-->
                                <small>
                                    <a href="javascript:sortCozxy(<?php echo $categoryId; ?>,'price')" style="color: #000;">Sort by price&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <input type="hidden" name="Sortprice" id="Sortprice" value="SORT_DESC">
                                    <span style="color: #fc0;">|</span><a href="javascript:sortCozxy(<?php echo $categoryId; ?>,'brand')" style="color: #000;">Sort by brand&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <input type="hidden" name="Sortbrand" id="Sortbrand" value="SORT_DESC">
                                    <span style="color: #fc0;">|</span><a href="javascript:sortCozxy(<?php echo $categoryId; ?>,'new')" style="color: #000;">Sort by new product&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <input type="hidden" name="Sortnew" id="Sortnew" value="SORT_DESC">
                                </small>
                            </h3>

                            <div class="row">
                                <div class="wf-container">

                                    <?php
                                    yii\widgets\Pjax::begin([
                                        'id' => 'cansale',
                                        'enablePushState' => false, // to disable push state
                                        'enableReplaceState' => false, // to disable replace state
                                        'timeout' => 5000,
                                        'clientOptions' => [
                                            'registerClientScript' => "$.pjax.reload({container:'#cansale'});",
                                            'linkSelector' => '#cansale'
                                        ]
                                    ]);
                                    echo \yii\widgets\ListView::widget([
                                        'dataProvider' => $productCanSell,
                                        'options' => [
                                            'tag' => false,
                                        ],
                                        'itemView' => function ($model, $key, $index, $widget) {
                                            return $this->render('@app/themes/cozxy/layouts/product/_product_item', ['model' => $model]);
                                        },
                                        'emptyText' => ' ',
                                        'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
                                        'layout' => "{summary}\n{items}\n<center>{pager}</center>\n",
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
                    </div>
                    <div class="filter-product-cozxy-not-sale col-sm-12">
                        <?php if ($productNotSell->getTotalCount() > 0): ?>
                            <h3 class="b">
                                <?php
                                if (isset($search)) {
                                    echo $search . '(PRODUCTS)';
                                } else {
                                    echo strtoupper('category') . '::' . strtoupper($title) . '(PRODUCTS)';
                                }
                                ?>
                                <?//= strtoupper('category') ?><!-- ::--> <?//= strtoupper($title) ?> <!--(PRODUCTS)-->
                            </h3>
                        <!--<p class="size18 size16-sm size14-xs">SHOWING 1-16 OF 79 RESULTS</p>-->
                            <div class="row">
                                <div class="wf-container">

                                    <?php
                                    yii\widgets\Pjax::begin([
                                        'id' => 'notsale',
                                        'enablePushState' => false, // to disable push state
                                        'enableReplaceState' => false, // to disable replace state
                                        'timeout' => 5000,
                                        'clientOptions' => [
                                            'registerClientScript' => "$.pjax.reload({container:'#notsale'});",
                                            'linkSelector' => '#notsale'
                                        ]
                                    ]);
                                    echo \yii\widgets\ListView::widget([
                                        'dataProvider' => $productNotSell,
                                        'options' => [
                                            'tag' => false,
                                        ],
                                        'itemView' => function ($model, $key, $index, $widget) {
                                            return $this->render('@app/themes/cozxy/layouts/product/_product_item_not_sale', ['model' => $model]);
                                        },
                                        'emptyText' => ' ',
                                        'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
                                        'layout' => "{summary}\n{items}\n<center>{pager}</center>\n",
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
                    </div>
                </div>

            </div>
            <div class="col-xs-3">
                <div class="size18">&nbsp;</div>
                <?= $this->render('@app/themes/cozxy/layouts/story/_panel_recent_stories', compact('productSupplierId')) ?>
            </div>

            <div class="col-xs-9">

            </div>


            <div class="col-xs-9 text-center">
                <!--<a href="javascript:showMore('<?php //echo $categoryId;                                                                                                                                                                  ?>','<?php //echo $clickNum;                                                                                                                                                                 ?>','<?php //echo $countAllProduct;                                                                                                                                                                 ?>','<?php //echo $limit_start;                                                                                                                                                                ?>','<?php //echo $limit_end;                                                                                                                                                               ?>')" class="b btn-black showStepMore" style="margin:24px auto 32px">SHOW MORE
                    <span class="size16">&nbsp; ↓ </span></a>-->
            </div>
            <div class="col-xs-3 text-center">&nbsp;</div>
        </div>
    </div>
</div>
