<?php

use yii\helpers\Html;
?>
<div class="table-responsive order-list">


    <table class="table table-bordered table-striped fc-g666">
        <thead class="size18 size16-xs">
            <tr>
                <th>Order No.</th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="size16 size14-xs">
            <?php
            yii\widgets\Pjax::begin([
                'enablePushState' => false, // to disable push state
                'enableReplaceState' => false // to disable replace state
            ]);
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $orderHistory,
                'options' => [
                    'tag' => false,
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('@app/themes/cozxy/layouts/my-account/_order_history_item', ['model' => $model]);
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
                    'maxButtonCount' => 3,
                ],
            ]);
            yii\widgets\Pjax::end();
            ?>
        </tbody>
    </table>
</div>