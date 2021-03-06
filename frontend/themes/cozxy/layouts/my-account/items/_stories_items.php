<div class="sort-stories-cozxy">
    <div class="row sort-stories-cozxy-me">
        <div class="col-md-12 text-right sort-stories-cozxy">
            <!--<a href="javascript:sortStoriesCozxy(<?//= Yii::$app->user->id ?>,'price','myAccount')" style="color: #a79d9d;">
                Sort by price&nbsp//php if ($isStatus == 'price') { ?>
                <i class="fa fa-angle-<?//= $icon ?>" aria-hidden="true"></i><?//php } else { ?>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
                <?//php } ?>
            </a>-->
            <input type="hidden" name="sortStoriesPrice" id="sortStoriesPrice" value="<?= isset($sort) ? $sort : 'SORT_ASC' ?>">
            <span style="color: #fc0;">|</span><a href="javascript:sortStoriesCozxy(<?= Yii::$app->user->id ?>,'view','myAccount')" style="color: #a79d9d;">
                Sort by  view&nbsp;<?php if ($isStatus == 'view') { ?>
                <i class="fa fa-angle-<?= $icon ?>" aria-hidden="true"></i><?php } else { ?>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
                <?php } ?></a>
            <input type="hidden" name="sortStoriesView" id="sortStoriesView" value="<?= isset($sort) ? $sort : 'SORT_ASC' ?>">
            <span style="color: #fc0;">|</span><a href="javascript:sortStoriesCozxy(<?= Yii::$app->user->id ?>,'stars','myAccount')" style="color: #a79d9d;">
                Sort by stories stars&nbsp;<?php if ($isStatus == 'stars') { ?>
                    <i class="fa fa-angle-<?= $icon ?>" aria-hidden="true"></i><?php } else { ?>
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                <?php } ?></a>
            <input type="hidden" name="sortStoriesStars" id="sortStoriesStars" value="<?= isset($sort) ? $sort : 'SORT_ASC' ?>">
            <span style="color: #fc0;">|</span><a href="javascript:sortStoriesCozxy(<?= Yii::$app->user->id ?>,'new','myAccount')" style="color: #a79d9d;">
                Sort by new stories&nbsp;<?php if ($isStatus == 'new') { ?>
                    <i class="fa fa-angle-<?= $icon ?>" aria-hidden="true"></i><?php } else { ?>
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                <?php } ?></a>
            <input type="hidden" name="sortStoriesNew" id="sortStoriesNew" value="<?= isset($sort) ? $sort : 'SORT_ASC' ?>">
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
</div>