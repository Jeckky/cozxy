<h1 class="page-header">Compare Price</h1>
<div class="row">
    <div class="col-md-6">
        <div class="col-md-12 text-left">
            <i class="fa fa-align-left" aria-hidden="true"></i> Price Filter
        </div><br>
        <div class="col-md-9 text-center sort-stories-currency">
            <select id="currencyid" class="fullwidth input-sm" name="currencyId" onchange="sortStoriesCompare(this, 'currency', '<?= $productPost->productPostId ?>', '<?= $productPost->productId ?>')">
                <option value="">select currency</option>
                <?php
                foreach ($currency as $key => $value) {
                    ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                <?php } ?>
            </select>
            <input type="hidden" name="hiddenCurrencyId" id="hiddenCurrencyId" value="<?= isset($currencyId) ? $currencyId : '' ?>">
        </div>
    </div>

    <div class="col-md-4 text-left sort-stories-compare">
        <div class="col-md-12 text-left"><i class="fa fa-align-left" aria-hidden="true"></i> Sort</div><br>
        <div class="col-md-12 text-left">
            <a href="javascript:sortStoriesCompare(this,'price', '<?= $productPost->productPostId ?>', '<?= $productPost->productId ?>')">
                Sort by price&nbsp;<i class="fa fa-angle-down<?= isset($icon) ? $icon : '' ?>" aria-hidden="true"></i></a>
        </div>
        <input type="hidden" name="sortStoriesPrice" id="sortStoriesPrice" value="<?= isset($sort) ? $sort : 'SORT_ASC' ?>">
    </div>
</div>
<div class="size20">&nbsp;</div>

<div class="row" id="compare">
    <div class="col-md-12  " id="showData">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Country</th>
                    <th>Place</th>
                    <th>Price</th>
                    <th>Local  Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo \yii\widgets\ListView::widget([
                    'dataProvider' => $comparePrice,
                    'options' => [
                        'tag' => false,
                    ],
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('@app/themes/cozxy/layouts/story/items/_compare_price_items', ['model' => $model, 'index' => $index]);
                    },
                    // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                    //'layout'=>"{summary}{pager}{items}"
                    'layout' => "{items}",
                    'itemOptions' => [
                        'tag' => false,
                    ],
                ]);
                ?>
            </tbody>
        </table>
    </div>
</div>