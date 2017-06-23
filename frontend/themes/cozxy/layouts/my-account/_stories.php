<div class="row">
    <div class="col-md-12">
        <a href="javascript:sortStoriesCozxy(<?= Yii::$app->user->id ?>,'price')" style="color: #000;">Sort by price&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
        <span style="color: #fc0;">|</span><a href="javascript:sortStoriesCozxy(<?= Yii::$app->user->id ?>,'view')" style="color: #000;">Sort by max view&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
        <span style="color: #fc0;">|</span><a href="javascript:sortStoriesCozxy(<?= Yii::$app->user->id ?>,'stars')" style="color: #000;">Sort by stories stars&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
        <span style="color: #fc0;">|</span><a href="javascript:sortStoriesCozxy(<?= Yii::$app->user->id ?>,'new')" style="color: #000;">Sort by new stories&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
    </div>
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