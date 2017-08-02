<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Story See More';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">Story See More</p>
        </div>
        <div class="col-xs-12 bg-white size18 b" style="padding: 20px;">

            <?php yii\widgets\Pjax::begin(['id' => 'products-table']); ?>
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $productStory,
                'options' => [
                    'tag' => false,
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('@app/views/story/_product_item_story_1', ['model' => $model]);
                }, 'emptyText' => ' &nbsp; &nbsp; No results found.',
//              'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
                'layout' => "{summary}\n{items}\n<center>{pager}</center>\n",
                //'layout' => "{items}",
                'itemOptions' => [
                    'tag' => false,
                ], 'pager' => [
                    'firstPageLabel' => 'first',
                    'lastPageLabel' => 'last',
                    'prevPageLabel' => 'previous',
                    'nextPageLabel' => 'next',
                    'maxButtonCount' => 3,
                ],
            ]);
            yii\widgets\Pjax::end();
            ?>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>

