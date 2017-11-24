<?php

use common\models\costfit\Order;

if (count($trackingOrder->allModels) > 0) {
    foreach ($trackingOrder->allModels as $key => $value) {
        ?>
        <div class="track-list tracking-order-<?= $value['orderId'] ?>">
            <div class="row tk-head">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    Tracking status code: <?= $value['invoiceNo'] ?>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="col-lg-4 col-md-6"><?= $value['item'] ?> Item</div>
                    <div class="col-lg-8 col-md-6">Ship to Cozxy at <?= $value['pickingPointName'] ?></div>
                </div>
            </div>
            <div class="row tk-body">
                <br><br>
                <div class="col-lg-12 col-md-12">
                    <table style="width: 100%" class="text-center">
                        <tr>
                            <td style="width: 24%;">
                                <?php
                                if ($value['status'] >= Order::ORDER_STATUS_E_PAYMENT_SUCCESS) {
                                    ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/1-y.png" alt="" class="img-responsive img-circle">
                                <?php } else { ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/1-g-box.png" alt="" class="img-responsive img-circle">
                                <?php } ?>
                            </td>
                            <td><i class="fa fa-arrow-right size24" aria-hidden="true"></i></td>
                            <td style="width: 24%;">
                                <?php
                                if ($value['status'] >= Order::ORDER_STATUS_SENDING_SHIPPING) {
                                    ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/2-y.png" alt="" class="img-responsive img-circle">
                                <?php } else { ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/2-g.png" alt="" class="img-responsive img-circle">
                                <?php } ?>
                            </td>
                            <td><i class="fa fa-arrow-right size24" aria-hidden="true"></i></td>
                            <td style="width: 24%;">
                                <?php
                                if ($value['status'] >= Order::ORDER_STATUS_SEND) {
                                    ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/3-y.png" alt="" class="img-responsive img-circle">
                                <?php } else { ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/3-g.png" alt="" class="img-responsive img-circle">
                                <?php } ?>
                            </td>
                            <td><i class="fa fa-arrow-right size24" aria-hidden="true"></i></td>
                            <td style="width: 24%;">
                                <?php
                                if ($value['status'] >= Order::ORDER_STATUS_RECEIVED) {
                                    ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/4-y.png" alt="" class="img-responsive img-circle">
                                <?php } else { ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/4-g.png" alt="" class="img-responsive img-circle">
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
        <!--                            <td><div class="size10">&nbsp;</div><p>ON PROCESS</p></td>
                            <td>&nbsp;</td>
                            <td><div class="size10">&nbsp;</div><p class="fc-g999">SHIPPING</p></td>
                            <td>&nbsp;</td>
                            <td><div class="size10">&nbsp;</div><p class="fc-g999">COMPLETE</p></td>-->
                            <td><div class="size10">&nbsp;</div><p>PREPARING</p></td>
                            <td>&nbsp;</td>
                            <td><div class="size10">&nbsp;</div>
                                <p class="<?= $value['status'] >= Order::ORDER_STATUS_SENDING_SHIPPING ? '' : 'fc-g999' ?>">READY TO SHIP</p>
                            </td>
                            <td>&nbsp;</td>
                            <td><div class="size10">&nbsp;</div>
                                <p class="<?= $value['status'] >= Order::ORDER_STATUS_SEND ? '' : 'fc-g999' ?>">SHIPPED</p>
                            </td>
                            <td>&nbsp;</td>
                            <td><div class="size10">&nbsp;</div>
                                <p class="<?= $value['status'] >= Order::ORDER_STATUS_RECEIVED ? '' : 'fc-g999' ?>">RECEIVED</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-xs-12 size48">&nbsp;</div>
                <div class="tk-desc">
                    <div class="row hidden-xs b">
                        <div class="col-md-3 col-xs-4">Date</div>
                        <div class="col-md-9 col-xs-8">Detail</div>
                    </div>
                    <div class="row fc-g999">
                        <div class="col-md-3 col-xs-4"><?= $value['updateDateTime'] ?></div>
                        <div class="col-md-9 col-xs-8">
                            <?php
                            if ($value['status'] >= 5 && $value['status'] <= 13) {
                                echo 'on process at Cozxy company';
                            } elseif ($value['status'] >= 14 && $value['status'] < 15) {
                                echo 'shipping at Cozxy company';
                            } elseif ($value['status'] >= 15) {
                                echo 'complete at Cozxy company';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="size12">&nbsp;</div>
        </div>
        <?php
    }
} else {
    ?>
    <div class="track-list tracking-order text-center" style="color: #ccc;">
        No results found.
    </div>
    <?php
}
?>