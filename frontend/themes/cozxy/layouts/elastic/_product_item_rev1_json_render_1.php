<div class="row">
    <h3 class="b text-center-sm text-center-xs">RECOMMENDED</h3>
    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => false,
        ],
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('@app/themes/cozxy/layouts/elastic/_product_item_rev1_json', ['model' => $model, 'hotDeal' => 0]);
        },
        'layout' => "{summary}\n{items}\n<div class=' text-center'>{pager}</div>\n",
        'itemOptions' => [
            'tag' => false,
        ],
    ]);
    ?>
    <div class="col-md-12">
        <div class="loading-div">&nbsp;</div>
        <div id="results" class="col-lg-offset-4"> <?= $paginate ?></div>
    </div>
</div>
<div class="row">
    <h3 class="b text-center-sm text-center-xs">EXPLORE PRODUCTS </h3>
    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProviderNotSalse,
        'options' => [
            'tag' => false,
        ],
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('@app/themes/cozxy/layouts/elastic/_product_item_rev1_json', ['model' => $model, 'hotDeal' => 0]);
        },
        'layout' => "{summary}\n{items}\n<div class=' text-center'>{pager}</div>\n",
        'itemOptions' => [
            'tag' => false,
        ],
    ]);
    ?>
    <div class="col-md-12">
        <div class="loading-div">&nbsp;</div>
        <div id="results" class="col-lg-offset-4"> <?//= $paginateNoStock ?></div>
    </div>
</div>
