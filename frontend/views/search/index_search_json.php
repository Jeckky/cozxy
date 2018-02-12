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
.summary{
text-align: right;
}
');
if (isset($catPrice['minPrice'])) {
    $minPrice = $catPrice['minPrice'];
} else {
    $minPrice = '""';
}
if (isset($catPrice['maxPrice'])) {
    $maxPrice = $catPrice['maxPrice'];
} else {
    $maxPrice = '""';
}
$this->registerJs('
$(function() {
	var waterfall = new Waterfall({
		containerSelector: \'.wf-container\',
		boxSelector: \'.wf-box\',
		minBoxWidth: 256
	});

	$( "#slider-range" ).slider({
            range: true,
            min: ' . $minPrice . ',
            max: ' . $maxPrice . ',
            values: ["' . $catPrice['minPrice'] . '", "' . $catPrice['maxPrice'] . '"],
            slide: function( event, ui ) {
            $( "#amount" ).val( "From " + ui.values[0] + " THB to " + ui.values[1] + " THB");
            $("input:hidden:eq(0)", "#amount-min").val(ui.values[0]);
            $("input:hidden:eq(1)", "#amount-min").val(ui.values[1]);

            },
            stop: function (event, ui) {
            //debugger;
            //var path = "' . Yii::$app->homeUrl . 'search/filter-price";
            /* $.ajax({
              url: path,
              type: "POST",
              dataType: "JSON",
              data: {mins:ui.values[ 0 ],maxs:ui.values[ 1 ],categoryId:' . $ConfigpParameter['categoryId'] . '},
              success: function (data){
              alert(data.status);
              if (data.status) {

              } else {
              alert(data.message);
              }
              }
              }); */
            }
            });

            $( "#amount" ).val( "From " + $( "#slider-range" ).slider( "values", 0 ) + " THB to " + $( "#slider-range" ).slider( "values", 1 ) + " THB" );
            });


            $("#results").on("click", ".pagination a", function (e) {

            e.preventDefault();
            $(".loading-div").show(); //show loading element
            var page = $(this).attr("data-page"); //get page number from link
            var search = $(this).attr("data-search");
            var brandName = $(this).attr("data-brandName");
            var mins = $(this).attr("data-mins");
            var maxs = $(this).attr("data-maxs");
            var category = $(this).attr("data-category");
            var Trecords = $(this).attr("data-records");
            var Tpages = $(this).attr("data-pages");
            // data-records ,data-pages
            $.ajax({
            url: "' . Yii::$app->homeUrl . 'search/e-paginate",
            type: "GET",
            //dataType: "JSON",
            data: {"page": page, "search": search, "brandName": brandName, "mins": mins, "maxs": maxs, "category": category, "Trecords": Trecords, "Tpages": Tpages},
            success: function (data, status) {
            //alert(status);
            if (status == "success") {
            $(".filter-e-search-cozxy").html("<div class=\"text-center\" style=\"zoom: 5; \"><br><i class=\"fa fa-spinner fa-spin\" aria-hidden=\"true\"></i></div>");
            $.ajax({
            url: "' . Yii::$app->homeUrl . 'search/elastic-search",
            type: "GET",
            //dataType: "JSON",
            data: {"page": page, "search": search, "brandName": brandName, "mins": mins, "maxs": maxs, "category": category, "Trecords": Trecords, "Tpages": Tpages},
            success: function (data, status) {
            //alert(status);
            if (status == "success") {
            $(".filter-e-search-cozxy").html(data);
            //alert(data);
            } else {
            //alert(status);
            }
            }
            });
            $("#results").html(data);
            //alert(data);
            } else {
            //alert(status);
            }
            }
            });

            });


    ');
if ($ConfigpParameter['site'] == 'category') {
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
} else {
    if (isset($title) && !empty($title)) {
        $this->title = 'Search Brand ' . isset($title) ? strtoupper($title) : '';
        $this->params['breadcrumbs'][] = $this->title;
    } else {
        $this->title = 'Search Brand ';
        $this->params['breadcrumbs'][] = $this->title;
        $title = '';
    }
    if (isset($_GET["search"]) && !empty($_GET['search'])) {
        $search = 'SEARCH : ' . $_GET["search"];
    }
}
\frontend\assets\SearchAsset::register($this);

//echo '<pre>';
//print_r($dataProvider->allModels);
//echo $brandId;
/**
 * Simple function to replicate PHP 5 behaviour
 */
?>
<div class="filter-e-search-test">
    <?=
    $this->render('@app/themes/cozxy/layouts/search/_search_filter_all_rev1', [
        'categoryId' => $ConfigpParameter['categoryId'],
        'productFilterBrand' => $productFilterBrand,
        'search' => $ConfigpParameter['search']
    ]);
    ?>
    <div class="product-list">
        <div class="container">

            <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="brand-price-filter col-sm-12" style="padding-right: 0px;padding-left: 0px;">

                        <!--<div class="filter-product-cozxy col-sm-12">
                            <h3 class="b text-center-sm text-center-xs">HOT DEALS</h3>
                            <div class="row">
                                HOT DEALS
                            </div>
                        </div>-->

                        <div class="filter-product-cozxy col-sm-12">
                            <div class="col-md-12" style="padding-right: 0px;padding-left: 0px;">
                                <h3 class="b" style="word-wrap: break-word;white-space: normal;">
                                    <!--RECOMMENDED-->Search "<?= isset($_GET['search']) ? $_GET['search'] : '' ?>"&nbsp;
                                    <span class="size16" style="margin:0px;color:#989898;"><?= $searchElastic['total'] ?> results (<?= $searchElastic['took'] ?>ms)</span>
                                </h3>
                            </div>
                            <div class="col-md-12" style="padding-right: 0px;padding-left: 0px;">
                                <a href="javascript:filterESortCozxy('<?php echo $ConfigpParameter['categoryId']; ?>','price')" style="color: #000;">Sort by price&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <input type="hidden" name="Sortprice" id="Sortprice" value="SORT_DESC">
                                <span style="color: #fc0;">|</span><a href="javascript:filterESortCozxy('<?php echo $ConfigpParameter['categoryId']; ?>','brand')" style="color: #000;">Sort by brand&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <input type="hidden" name="Sortbrand" id="Sortbrand" value="SORT_DESC">
                                <span style="color: #fc0;">|</span><a href="javascript:filterESortCozxy('<?php echo $ConfigpParameter['categoryId']; ?>','new')" style="color: #000;">Sort by new product&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <input type="hidden" name="Sortnew" id="Sortnew" value="SORT_DESC">
                            </div>

                            <div class="row">
                                <div class="wf-container filter-e-search-cozxy">
                                    <?php
                                    /* echo \yii\widgets\ListView::widget([
                                      'dataProvider' => $dataProvider,
                                      'options' => [
                                      'tag' => false,
                                      ],
                                      'itemView' => function ($model, $key, $index, $widget) {
                                      return $this->render('@app/themes/cozxy/layouts/product/_product_item_rev1_json', ['model' => $model, 'hotDeal' => 0]);
                                      },
                                      'layout' => "{summary}\n{items}\n<div class=' text-center'>{pager}</div>\n",
                                      'itemOptions' => [
                                      'tag' => false,
                                      ],
                                      ]);
                                      //yii\widgets\Pjax::end(); */
                                    //echo '<pre>';
                                    //print_r($dataProvider)
                                    ?>
                                    <?= $this->render('@app/themes/cozxy/layouts/product/_product_item_rev1_json_render', compact('dataProvider')) ?>
                                </div>
                                <div class="col-md-12">
                                    <div class="loading-div">&nbsp;</div>
                                    <div id="results" class="col-lg-offset-4"> <?= $paginate ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="wf-container filter-e-search-cozxy">
                                    <?php
                                    ////echo '<pre>';
                                    //print_r($dataProviderNotSalse)
                                    ?>
                                    <?= $this->render('@app/themes/cozxy/layouts/product/_product_item_rev1_json_render_notsale', compact('dataProviderNotSalse')) ?>
                                </div>
                                <div class="col-md-12">
                                    <div class="loading-div">&nbsp;</div>
                                    <div id="results" class="col-lg-offset-4"> <?//= $paginate ?></div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="size18">&nbsp;</div>
                    <?= $this->render('@app/themes/cozxy/layouts/story/_panel_recent_stories', compact('productSupplierId', 'categoryId', 'productStory')) ?>
                </div>

                <div class="col-xs-9">

                </div>

                <div class="col-xs-9 text-center">
                    <!--<a href="javascript:showMore('<?php //echo $categoryId;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ?>','<?php //echo $clickNum;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ?>','<?php //echo $countAllProduct;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ?>','<?php //echo $limit_start;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       ?>','<?php //echo $limit_end;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ?> ')" class="b btn-black showStepMore" style="margin:24px auto 32px">SHOW MORE
            <          span class="size16">&nbsp; ↓ </span></a>-->
                </div>
                <div class="col-xs-3 text-center">&nbsp;</div>
            </div>
        </div>
    </div>
</div>