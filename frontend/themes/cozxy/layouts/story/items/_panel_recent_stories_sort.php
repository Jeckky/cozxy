<div class="sort-stories-cozxy">

    <div class="panel panel-defailt">
        <div class="size14" style="background-color:rgb(254, 230, 10);">&nbsp;</div>
        <h3 class="page-header" style="margin:10px 20px;">RECENT STORIES</h3>
        <div class="size14 text-center">
            <a href="javascript:sortStoriesRecent('','view','product')">
                Sort by view&nbsp;<?php if ($status == 'view') { ?>
                <i class="fa fa-angle-<?= $icon ?>" aria-hidden="true"></i><?php } else { ?>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
                <?php } ?>
            </a>
            <input type="hidden" name="sortStoriesView" id="sortStoriesView" value="<?= isset($sort) ? $sort : 'SORT_ASC' ?>">
            <span style="color: #fc0;">|</span><a href="javascript:sortStoriesRecent('','stars','product')">
                Sort by stars&nbsp;<?php if ($status == 'stars') { ?>
                    <i class="fa fa-angle-<?= $icon ?>" aria-hidden="true"></i><?php } else { ?>
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                <?php } ?>
            </a>
            <input type="hidden" name="sortStoriesStars" id="sortStoriesStars" value="<?= isset($sort) ? $sort : 'SORT_ASC' ?>">
            <input type="hidden" name="productId" id="productId" value="<?= isset($productId) ? $productId : '' ?>">
            <input type="hidden" name="productSupplierId" id="productSupplierId" value="<?= $productSupplierId ?>">

        </div>

        <div class="panel-body">

            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $StoryRecentStories,
                'options' => [
                    'tag' => false,
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('@app/themes/cozxy/layouts/story/_panel_recent_stories_items', ['model' => $model]);
                },
                //'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                //'layout'=>"{summary}{pager}{items}"
                'layout' => "{items}",
                'itemOptions' => [
                    'tag' => false,
                ],
            ]);
            ?>

            <div class="text-center">
                <a href="<?php echo Yii::$app->homeUrl; ?>story/see-more/<?= \common\models\ModelMaster::encodeParams(['productSupplierId' => $productSupplierId, 'productId' => $productId]); ?>>" class="b btn-g999" style="margin:24px auto 12px">See All</a>
            </div>
        </div>
    </div>

</div>