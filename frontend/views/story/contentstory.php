<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'See more stories';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .ias-trigger{
        width: 100%;
    }
</style>
<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">See more stories</p>
        </div>
        <div class="col-xs-12 bg-white size18 b" style="padding: 20px;">

            <?php //yii\widgets\Pjax::begin(['id' => 'products-table']); ?>
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $productStory,
                // 'options' => [
                //'tag' => false,
                //],
                'itemView' => function ($model, $key, $index, $widget) {
//                    return $this->render('@app/views/story/_product_item_story_1', ['model' => $model]);
                    return $this->render('@app/themes/cozxy/layouts/story/_product_item_story_avatar', ['model' => $model]);
                }, 'emptyText' => ' &nbsp; &nbsp; No results found.'
//              'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right'],
                //'layout' => "{summary}\n{items}\n<center>{pager}</center>\n",
                //'layout' => "{items}",
                //'itemOptions' => [
                //'tag' => false,
                //],
                , 'itemOptions' => ['class' => 'item']
                , 'pager' => ['class' => \kop\y2sp\ScrollPager::className()] //\kop\y2sp\ScrollPager::className()
            ]);
            //yii\widgets\Pjax::end();
            ?>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>

