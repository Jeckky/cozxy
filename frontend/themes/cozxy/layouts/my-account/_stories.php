<div class="row">
    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $productPost,
        'options' => [
            'tag' => false,
        ],
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('@app/themes/cozxy/layouts/my-account/_stories_items', ['model' => $model, 'index' => $index]);
        },
        //'summaryOptions' => ['class' => 'sort-by-section clearfix'],
        //'layout'=>"{summary}{pager}{items}"
        'layout' => "{items}",
        'itemOptions' => [
            'tag' => false,
        ],
    ]);
    ?>
</div>

<div class="col-xs-12 size48">&nbsp;</div>