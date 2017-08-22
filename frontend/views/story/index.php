<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Stories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-list">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <h3 class="b">Stories</h3>
                <!--<p class="size18 size16-sm size14-xs">SHOWING 1-16 OF 79 RESULTS</p>-->
                <div class="row">
                    <div class="wf-container">
                        <div class="filter-product-cozxy">

                            <?php
                            // yii\widgets\Pjax::begin([
                            //  'enablePushState' => false, // to disable push state
                            // 'enableReplaceState' => false // to disable replace state
                            // ]);
                            echo \yii\widgets\ListView::widget([
                                'dataProvider' => $seeMore,
                                'options' => [
                                    'tag' => false,
                                ],
                                'itemView' => function ($model, $key, $index, $widget) {
                                    return $this->render('@app/views/story/_product_item_story', ['model' => $model]);
                                },
                                'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
                                'layout' => "{summary}\n{items}\n<center>{pager}</center>\n",
                                //'layout' => "{items}",
                                'itemOptions' => [
                                    'tag' => false,
                                ],
                            ]);
                            // yii\widgets\Pjax::end();
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xs-3">
                <h3 class="b text-center-sm text-center-xs">GOOD READ</h3>
                <?php
                echo \yii\widgets\ListView::widget([
                    'dataProvider' => $otherProducts,
                    'options' => [
                        'tag' => false,
                    ],
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('@app/themes/cozxy/layouts/content/_content_items', ['model' => $model]);
                    }, 'emptyText' => '<div class="col-xs-12"><div class="product-other fullwidth" style="height:260px; font-variant: small-caps; text-align: center;vertical-align: middle;
line-height:35px;"><br><br><br>No results found.</div></div>',
//                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                    //'layout'=>"{summary}{pager}{items}"
                    'layout' => "{items}",
                    'itemOptions' => [
                        'tag' => false,
                    ],
                ]);
                ?>
            </div>
            <div class="col-xs-9 text-center">
                <!--<a href="javascript:showMore('<?php //echo $categoryId;        ?>','<?php //echo $clickNum;       ?>','<?php //echo $countAllProduct;                           ?>','<?php //echo $limit_start;                          ?>','<?php //echo $limit_end;                          ?>')" class="b btn-black showStepMore" style="margin:24px auto 32px">SHOW MORE
                    <span class="size16">&nbsp; ↓ </span></a>-->
            </div>
            <div class="col-xs-3 text-center">&nbsp;</div>
        </div>
    </div>
</div>
