<div class="sort-stories-cozxy">
    <?php yii\widgets\Pjax::begin(['timeout' => 5000]); ?>
    <div class="row">
        <div class="col-md-12 text-right sort-stories-cozxy">
            <!--<a href="javascript:sortStoriesCozxy(<?//= Yii::$app->user->id ?>,'price','myAccount')" style="color: #a79d9d;">
                Sort by price&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>-->
            <input type="hidden" name="sortStoriesPrice" id="sortStoriesPrice" value="SORT_ASC">
            <span style="color: #fc0;">|</span><a href="javascript:sortStoriesCozxy(<?= Yii::$app->user->id ?>,'view','myAccount')" style="color: #a79d9d;">
                Sort by view&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <input type="hidden" name="sortStoriesView" id="sortStoriesView" value="SORT_ASC">
            <span style="color: #fc0;">|</span><a href="javascript:sortStoriesCozxy(<?= Yii::$app->user->id ?>,'stars','myAccount')" style="color: #a79d9d;">
                Sort by stories stars&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <input type="hidden" name="sortStoriesStars" id="sortStoriesStars" value="SORT_ASC">
            <span style="color: #fc0;">|</span><a href="javascript:sortStoriesCozxy(<?= Yii::$app->user->id ?>,'new','myAccount')" style="color: #a79d9d;">
                Sort by new stories&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <input type="hidden" name="sortStoriesNew" id="sortStoriesNew" value="SORT_ASC">
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
            'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
            'layout' => "{summary}\n{items}\n<center>{pager}</center>\n",
            //'layout' => "{items}",
            'itemOptions' => [
                'tag' => false,
            ], 'pager' => [
                'firstPageLabel' => 'first',
                'lastPageLabel' => 'last',
                'prevPageLabel' => 'previous',
                'nextPageLabel' => 'next',
            //'maxButtonCount  ' => 3,
            ],
        ]);
        ?>
    </div>
    <?php
    yii\widgets\Pjax::end();
    ?>
    <div class="col-xs-12 size48">&nbsp;</div>
</div>
