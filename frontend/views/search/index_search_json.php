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


\frontend\assets\SearchAsset::register($this);
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

                        <h3 class="b" style="word-wrap: break-word;white-space: normal;">
                            <!--RECOMMENDED-->Search "<?= isset($_GET['search']) ? $_GET['search'] : '' ?>"&nbsp;
                            <span class="size16" style="margin:0px;color:#989898;"><?= $search['total'] ?> results (<?= $search['took'] ?>ms)</span>
                        </h3>

                        <div class="row">
                            <div class="wf-container">
                                <?php
                                echo \yii\widgets\ListView::widget([
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
                                //yii\widgets\Pjax::end();
                                ?>

                            </div>
                        </div>
                    </div>
                    <!--<div class="filter-product-cozxy-not-sale col-sm-12">
                        <h3 class="b" style="word-wrap: break-word;white-space: normal;">
                            PRODUCTS EXPLORE
                        </h3>

                        <div class="row">
                            <div class="wf-container">



                            </div>
                        </div>
                    </div>-->
                </div>

            </div>
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="size18">&nbsp;</div>
                <?= $this->render('@app/themes/cozxy/layouts/story/_panel_recent_stories', compact('productSupplierId', 'categoryId', 'productStory')) ?>
            </div>

            <div class="col-xs-9">

            </div>

            <div class="col-xs-9 text-center">
                <!--<a href="javascript:showMore('<?php //echo $categoryId;                                                                                                                                                                                                                                                                                                                                                                           ?>','<?php //echo $clickNum;                                                                                                                                                                                                                                                                                                                                                                          ?>','<?php //echo $countAllProduct;                                                                                                                                                                                                                                                                                                                                                                          ?>','<?php //echo $limit_start;                                                                                                                                                                                                                                                                                                                                                                         ?>','<?php //echo $limit_end;                                                                                                                                                                                                                                                                                                                                                                        ?>')" class="b btn-black showStepMore" style="margin:24px auto 32px">SHOW MORE
                    <span class="size16">&nbsp; ↓ </span></a>-->
            </div>
            <div class="col-xs-3 text-center">&nbsp;</div>
        </div>
    </div>
</div>
