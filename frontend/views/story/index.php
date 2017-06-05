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
                <h3 class="b"><?//= strtoupper($category) ?></h3>
                <!--<p class="size18 size16-sm size14-xs">SHOWING 1-16 OF 79 RESULTS</p>-->
                <div class="row">
                    <div class="wf-container">
                        <div class="filter-product-cozxy">

                            <?php
                            yii\widgets\Pjax::begin([
                                'enablePushState' => false, // to disable push state
                                'enableReplaceState' => false // to disable replace state
                            ]);
                            echo \yii\widgets\ListView::widget([
                                'dataProvider' => $seeMore,
                                'options' => [
                                    'tag' => false,
                                ],
                                'itemView' => function ($model, $key, $index, $widget) {
                                    return $this->render('@app/themes/cozxy/layouts/story/_panel_recent_stories_items_seemore', ['model' => $model]);
                                },
                                'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
                                'layout' => "{summary}\n{items}\n<center>{pager}</center>\n",
                                //'layout' => "{items}",
                                'itemOptions' => [
                                    'tag' => false,
                                ],
//                                'pager' => [
//                                    //            'firstPageLabel' => 'first',
//                                    //            'lastPageLabel' => 'last',
//                                    'prevPageLabel' => '<span class="icon-arrow-left"></span>',
//                                    'nextPageLabel' => '<span class="icon-arrow-right"></span>',
////            'maxButtonCount' => 3,
//                                    // Customzing options for pager container tag
////            'options' => [
////                'tag' => 'div',
////                'class' => 'pager-wrapper',
////                'id' => 'pager-container',
////            ],
//                                    // Customzing CSS class for pager link
////            'linkOptions' => ['class' => 'mylink'],
////            'activePageCssClass' => 'active',
////            'disabledPageCssClass' => 'mydisable',
//                                    // Customzing CSS class for navigating link
//                                    'prevPageCssClass' => 'prev-page',
//                                    'nextPageCssClass' => 'next-page',
////            'firstPageCssClass' => 'myfirst',
////            'lastPageCssClass' => 'mylast',
//                                ],
                            ]);
                            yii\widgets\Pjax::end();
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xs-3">
                <div class="size18">&nbsp;</div>
                <?//= $this->render('@app/themes/cozxy/layouts/story/_panel_recent_stories') ?>
            </div>
            <div class="col-xs-9 text-center">
                <!--<a href="javascript:showMore('<?php //echo $categoryId;               ?>','<?php //echo $clickNum;               ?>','<?php //echo $countAllProduct;              ?>','<?php //echo $limit_start;             ?>','<?php //echo $limit_end;             ?>')" class="b btn-black showStepMore" style="margin:24px auto 32px">SHOW MORE
                    <span class="size16">&nbsp; ↓ </span></a>-->
            </div>
            <div class="col-xs-3 text-center">&nbsp;</div>
        </div>
    </div>
</div>
