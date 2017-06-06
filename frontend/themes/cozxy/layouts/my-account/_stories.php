<div class="track-list">

    <div class="row tk-head">
        <div class="col-lg-3 col-md-4 col-sm-6">My Stories</div>
        <div class="col-lg-9 col-md-8 col-sm-6">
            <div class="col-lg-4 col-md-6"> </div>
            <div class="col-lg-8 col-md-6"> </div>
        </div>
    </div>
    <div class="row tk-body">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
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

    </div>
    <div class="size12">&nbsp;</div>

</div>