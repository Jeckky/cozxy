<?php
/* @var $this yii\web\View */
$this->registerCss('
.color-sel a, quantity-sel a {
	margin: auto 6px;
}
input.quantity {
	width: 32px; text-align: center;
	padding: 4px 2px;
	border: 0px solid #fff;
	font-size: 18px;
	color: #000;
}
.color-s:active i,.color-s:focus i {
	font-size: 18px;
}
');

$this->registerJs('
$(function() {
	function qSet(x){
		var temp = parseInt($(\'.quantity\').val());
		if (isNaN(temp)) {temp = 1;} temp+=x;
		if (temp<1) {temp = 1;}
		$(\'.quantity\').val(temp);
	}
	$(\'.q-plus\').click(function() {qSet(1);} );
	$(\'.q-minus\').click(function() {qSet(-1);} );
	$(\'.color-s\').click(function() {return false;} );
	var ww = $(window).width();
	if (ww>992) {
		descSet();
	}
});
function descSet() {
	var ww = $(window).width();
	if (ww>992) {
		var pg = $(\'.product-gallery\').height();
		$(\'.product-select\').css(\'min-height\', pg+\'px\');
	}
}
$(window).resize(function() { descSet(); });
');
\frontend\assets\CartAsset::register($this);
?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="size48">&nbsp;</div>
            <?php
            /*
              echo \yii\widgets\ListView::widget([
              'dataProvider' => $productViews,
              'options' => [
              'tag' => false,
              ],
              'itemView' => function ($model, $key, $index, $widget) {
              $p = $productGroupOptionValues;
              return $this->render('@app/themes/cozxy/layouts/product/_product_detail', ['model'=>$model, 'productGroupOptionValues'=>$productGroupOptionValues]);
              },
              //                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
              //'layout'=>"{summary}{pager}{items}"
              'layout' => "{items}",
              'itemOptions' => [
              'tag' => false,
              ],
              ]);
             */
            echo $this->render('@app/themes/cozxy/layouts/product/_product_detail', ['model' => $productViews, 'productGroupOptionValues' => $productGroupOptionValues, 'selectedOptions' => $selectedOptions]);
            ?>
            <div class="size24">&nbsp;</div>
            <?php
            /*
              echo \yii\widgets\ListView::widget([
              'dataProvider' => $productViews,
              'options' => [
              'tag' => false,
              ],
              'itemView' => function ($model, $key, $index, $widget) {
              return $this->render('@app/themes/cozxy/layouts/product/_product_detail_tab', ['model' => $model]);
              },
              //                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
              //'layout'=>"{summary}{pager}{items}"
              'layout' => "{items}",
              'itemOptions' => [
              'tag' => false,
              ],
              ]);
             */
            echo $this->render('@app/themes/cozxy/layouts/product/_product_detail_tab', ['model' => $productViews, 'productGroupOptionValues' => $productGroupOptionValues]);
            ?>
            <div class="size24">&nbsp;</div>
            <div class="row">
                <?php
                if (isset($productHotNewProduct->allModels[0]['productSuppId'])) {
                    echo '';
                } else {
                    ?>
                    <h3 class="b text-center-sm text-center-xs">HOT & NEW PRODUCT</h3>
                    <div class="row">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $productHotNewProduct,
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('@app/themes/cozxy/layouts/product/_product_item', ['model' => $model, 'colSize' => '3']);
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
                    <?php
                }
                ?>
            </div>
            <div class="size32">&nbsp;</div>
        </div>
        <div class="col-md-3">
            <div class="size48">&nbsp;</div>
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $StoryProductPost,
                'options' => [
                    'tag' => false,
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('@app/themes/cozxy/layouts/story/_panel_your_story', ['model' => $model, 'colSize' => '3']);
                },
//                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                //'layout'=>"{summary}{pager}{items}"
                'layout' => "{items}",
                'itemOptions' => [
                    'tag' => false,
                ],
            ]);
            ?>
            <?php //= $this->render('@app/themes/cozxy/layouts/story/_panel_your_story', compact('StoryProductPost')) ?>
            <?php
            //echo Yii::$app->controller->id;
            if (Yii::$app->controller->id == 'product') {
                echo $this->render('@app/themes/cozxy/layouts/story/_panel_recent_stories', compact('StoryRecentStories', 'productSupplierId', 'productId'));
            } else {
                echo $this->render('@app/themes/cozxy/layouts/story/_panel_recent_stories', compact('productSupplierId'))
                ?>
            <?php } ?>
        </div>
    </div>
</div>
