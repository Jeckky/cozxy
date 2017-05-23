<div class="panel panel-defailt">
    <div class="size14" style="background-color:rgb(254, 230, 10);">&nbsp;</div>
    <h3 class="page-header" style="margin:10px 20px;">Recent Stories</h3>
    <div class="panel-body">
        <?php
        echo \yii\widgets\ListView::widget([
            'dataProvider' => $recentStories,
            'options' => [
                'tag' => false,
            ],
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('@app/themes/cozxy/layouts/story/_panel_recent_stories_items', ['model' => $model]);
            },
//                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
            //'layout'=>"{summary}{pager}{items}"
            'layout' => "{items}",
            'itemOptions' => [
                'tag' => false,
            ],
        ]);
        ?>

        <div class="text-center"><a href="#" class="b btn-g999" style="margin:24px auto 12px">See
                All</a></div>
    </div>
</div>