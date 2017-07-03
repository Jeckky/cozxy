<?php

use yii\helpers\Html;
?>
<div class="table-responsive order-list">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="inputOrderHistory" class="col-sm-2 control-label" style="margin-top: 14px;">Show Order History :</label>
            <div class="col-sm-5">
                <input type="text" name="searchOrderNo" id="searchOrderNo" class="form-control size14" style="padding:3px;" placeholder="SEARCH ORDER NO" value="" autocomplete="on">
                <select name="OrderHistory" id="OrderHistory" class="form-control size14" style="padding:3px;"  >
                    <option value="">Select show order history</option>
                    <option value="show1">Last 10 orders</option>
                    <option value="show2">Last 15 days</option>
                    <option value="show3">Last 30 days</option>
                    <option value="show4">Last 6 months</option>
                    <option value="show5">Orders placed in 2017</option>
                    <option value="show6">Orders placed in 2016</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="inputOrderHistory" class="col-sm-2 control-label">&nbsp;</label>
            </div>
            <div class="col-sm-5" style="padding-left: 0px;">
                &nbsp;&nbsp;<input type="submit" value="SUBMIT" class="subs-btn size14-xs" onclick="SortOrder()">
            </div>
        </div>

    </div>

    <br><br><br>
    <div style="border-bottom: 1px #000000 solid;" class="col-sm-12">
        <h4><?= isset($statusText) ? 'แสดงข้อมูล : ' . '<code>' . $statusText . '</code>' : '' ?></h4>
    </div>

    <?php
    yii\widgets\Pjax::begin([
        'id' => 'order-history',
        'enablePushState' => false, // to disable push state
        'enableReplaceState' => false // to disable replace state
    ]);
    ?>
    <div class="order-history-sort">
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
                    //'maxButtonCount  ' => 3,
                    ],
                ]);
                ?>
            </tbody>
        </table>

    </div>
    <?php
    yii\widgets\Pjax::end();
    ?>

</div>
