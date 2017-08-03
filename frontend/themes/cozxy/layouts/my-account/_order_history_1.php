<?php

use yii\helpers\Html;
use common\models\costfit\Order;
?>
<style type="text/css">
    .ias-trigger{
        width: 100%;
    }
</style>
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
    //yii\widgets\Pjax::begin(['timeout' => 5000]);
    echo \yii\grid\GridView::widget([
        'dataProvider' => $orderHistory,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'orderNo',
            'status',
            [
                'attribute' => 'updateDateTime',
                'value' => function($model) {
                    return frontend\controllers\MasterController::dateThai($model['updateDateTime'], 4);
                }
            ],
            [
                'attribute' => 'Action',
                'format' => 'raw',
                'value' => function($model) {
                    if ($model['statusNum'] < Order::ORDER_STATUS_E_PAYMENT_SUCCESS || $model['status'] == Order::ORDER_STATUS_E_PAYMENT_PENDING) { // ชำระเงินแล้ว
                        $txt = yii\helpers\Html::a('<i class="fa fa-search"></i>', Yii::$app->homeUrl . "my-account/purchase-order/" . \common\models\ModelMaster::encodeParams(['orderId' => $model['orderId']]), ['class' => 'btn btn-primary btn-xs', 'style' => 'padding: 3px 6px;'], [
                            'title' => Yii::t('app', ' '),]);
                    } else {
                        $txt = yii\helpers\Html::a('<i class="fa fa-print" aria-hidden="true"></i> Print', Yii::$app->homeUrl . "payment/print-receipt/" . \common\models\ModelMaster::encodeParams(['orderId' => $model['orderId']]) . '/' . $model['orderNo'], ['class' => 'btn btn-black btn-xs', 'target' => '_blank', 'style' => 'padding: 3px 6px;'
                            , 'title' => Yii::t('app', ' ')]);
                        $txt.= '&nbsp;' . yii\helpers\Html::a('<i class="fa fa-truck" aria-hidden="true"></i> รายละเอียด Tracking', Yii::$app->homeUrl . "my-account/detail-tracking/" . \common\models\ModelMaster::encodeParams(['orderId' => $model['orderId']]) . '/' . $model['orderNo'], ['class' => 'btn btn-black btn-xs', 'target' => '_blank', 'style' => 'padding: 3px 6px;'
                            , 'title' => Yii::t('app', ' ')]);
                    }
                    if ($model['statusNum'] == Order::ORDER_STATUS_RECEIVED) {//รับของแล้ว
                        $flag = false;
                        $flag = common\helpers\ReturnProduct::returnDate($model['updateDateTime']);
                        $isMoreItem = common\helpers\ReturnProduct::isMoreItem($model['orderNo']);
                        if ($flag == true) {
                            if ($isMoreItem == true) {
                                $txt = " " . yii\helpers\Html::a('<i class="fa fa-repeat" aria-hidden="true"></i> Return', Yii::$app->homeUrl . "return/returning?orderNo=" . $model['orderNo'], ['class' => 'btn btn-warning  btn-xs', 'style' => 'padding: 3px 6px;'
                                    , 'title' => Yii::t('app', 'return')]);
                            }
                        }
                    }
                    return $txt;
                }
            ],
        ],
        'pager' => [
            'class' => \kop\y2sp\ScrollPager::className(),
            'container' => '.grid-view tbody',
            'item' => 'tr',
            'paginationSelector' => '.grid-view .pagination',
        //'triggerTemplate' => '<tr class="ias-trigger"><td colspan="100%" style="text-align: center"><a style="cursor: pointer">{text}</a></td></tr>',
        ],
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
            <tbody class="size16 size14-xs" id="order-history">

                <?php
                echo \yii\widgets\ListView::widget([
                    'itemOptions' => ['class' => 'item'],
                    'pager' => [
                        'class' => \kop\y2sp\ScrollPager::className(),
                    ]
                    , 'dataProvider' => $orderHistory,
                    /* 'options' => [
                      'tag' => false,
                      ], */
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('@app/themes/cozxy/layouts/my-account/_order_history_item', ['model' => $model]);
                    }
                    , 'summaryOptions' => ['class' => 'size18 size16-sm size14-xs text-right']
// 'layout' => "{summary}\n{items}\n<center>{pager}</center>\n",
//'layout' => "{items}",
                /* 'itemOptions' => [
                  'tag' => false,
                  ], 'pager' => [
                  'firstPageLabel' => 'first',
                  'lastPageLabel' => 'last',
                  'prevPageLabel' => 'previous',
                  'nextPageLabel' => 'next',
                  //'maxButtonCount  ' => 3,
                  ], */
                ]);
                ?>

            </tbody>
        </table>

    </div>
    <?php
//yii\widgets\Pjax::end();
    ?>

</div>
