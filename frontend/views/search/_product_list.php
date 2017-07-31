<?php
//$sortBrand = isset($sortBrand) ? $sortBrand : 'SORT_ASC';
//$sortPrice = isset($sortPrice) ? $sortPrice : 'SORT_ASC';
//$sortNew = isset($sortNew) ? $sortNew : 'SORT_ASC';
//echo $sortstatus . ':>' . $sort;
if (isset($sortstatus)) {
    if ($sortstatus == 'price') {
        $sortPriceIcon = ($sort == 'SORT_DESC') ? 'Sort by price&nbsp;<i class="fa fa-angle-up" aria-hidden="true"></i>' : 'Sort by price&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>';
        $sortPrice = ($sort == 'SORT_DESC') ? 'SORT_ASC' : 'SORT_DESC';
    } else {
        $sortPriceIcon = 'Sort by price&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>';
        $sortPrice = ($sort == 'SORT_DESC') ? 'SORT_ASC' : 'SORT_DESC';
    }
} else {
    $sortPriceIcon = 'Sort by price&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>';
    $sortPrice = 'SORT_ASC';
}

if (isset($sortstatus)) {
    if ($sortstatus == 'brand') {
        $sortBrandIcon = ($sort == 'SORT_DESC') ? 'Sort by brand&nbsp;<i class="fa fa-angle-up" aria-hidden="true"></i>' : 'Sort by brand&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>';
        $sortBrand = ($sort == 'SORT_DESC') ? 'SORT_ASC' : 'SORT_DESC';
    } else {
        $sortBrandIcon = 'Sort by brand&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>';
        $sortBrand = ($sort == 'SORT_DESC') ? 'SORT_ASC' : 'SORT_DESC';
    }
} else {
    $sortBrandIcon = 'Sort by brand&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>';
    $sortBrand = 'SORT_ASC';
}

if (isset($sortstatus)) {
    if ($sortstatus == 'new') {
        $sortNewIcon = ($sort == 'SORT_DESC') ? 'Sort by new product&nbsp;<i class="fa fa-angle-up" aria-hidden="true"></i>' : 'Sort by new product&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>';
        $sortNew = ($sort == 'SORT_DESC') ? 'SORT_ASC' : 'SORT_DESC';
    } else {
        $sortNewIcon = 'Sort by new product&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>';
        $sortNew = ($sort == 'SORT_DESC') ? 'SORT_ASC' : 'SORT_DESC';
    }
} else {
    $sortNewIcon = 'Sort by new product&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>';
    $sortNew = 'SORT_ASC';
}
?>
<h3 class="b"><?= strtoupper('category') ?> RECOMMENDED:: <?= strtoupper($category) ?>
    <small>
        <a href="javascript:sortCozxy(<?php echo $categoryId; ?>,'price')" style="color: #000;"><?= $sortPriceIcon ?></a>
        <span style="color: #fc0;">|</span><a href="javascript:sortCozxy(<?php echo $categoryId; ?>,'brand')" style="color: #000;"><?= $sortBrandIcon ?></a>
        <span style="color: #fc0;">|</span><a href="javascript:sortCozxy(<?php echo $categoryId; ?>,'new')" style="color: #000;"><?= $sortNewIcon ?></a>

        <input type="hidden" name="Sortprice" id="Sortprice" value="<?= $sortPrice ?>">
        <input type="hidden" name="Sortbrand" id="Sortbrand" value="<?= $sortBrand ?>">
        <input type="hidden" name="Sortnew" id="Sortnew" value="<?= $sortNew ?>">

    </small>
</h3>

<div class="row">
    <div class="wf-container">
        <?= yii\helpers\Html::hiddenInput("categoryId", $categoryId); ?>
        <?php
        yii\widgets\Pjax::begin(['id' => 'models', 'timeout' => false, 'enablePushState' => false])
        ?>
        <?php
        echo \yii\widgets\ListView::widget([
            'dataProvider' => $productFilterPriceCansale,
            'options' => [
                'tag' => false,
            ],
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('@app/themes/cozxy/layouts/product/_product_item', ['model' => $model]);
            },
            'emptyText' => ' ',
            'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
            'layout' => "{summary}\n{items}\n<div class ='col-sm-12 col-lg-offset-3'>{pager}</div>\n",
            //'layout' => "{items}",
            'itemOptions' => [
                'tag' => false,
            ]
            , 'emptyText' => '<div class="col-xs-12"><div class="product-other fullwidth" style="height:260px; font-variant: small-caps; text-align: center;vertical-align: middle;
line-height:35px;"><br><br><br>No results found.</div></div>',
            'pager' => [
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


<h3 class="b"><?= strtoupper('category') ?> PRODUCT :: <?= strtoupper($category) ?> </h3>
<div class="row">
    <div class="wf-container">
        <?= yii\helpers\Html::hiddenInput("categoryId", $categoryId); ?>
        <?php
        yii\widgets\Pjax::begin(['id' => 'models', 'timeout' => false, 'enablePushState' => false])
        ?>
        <?php
        echo \yii\widgets\ListView::widget([
            'dataProvider' => $productFilterPriceNotsale,
            'options' => [
                'tag' => false,
            ],
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('@app/themes/cozxy/layouts/product/_product_item', ['model' => $model]);
            }
            , 'emptyText' => '<div class="col-xs-12"><div class="product-other fullwidth" style="height:260px; font-variant: small-caps; text-align: center;vertical-align: middle;
line-height:35px;"><br><br><br>No results found.</div></div>',
            'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
            'layout' => "{summary}\n{items}\n<div class ='col-sm-12 col-lg-offset-3'>{pager}</div>\n",
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