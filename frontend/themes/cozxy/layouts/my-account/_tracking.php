<?php
if (count($trackingOrder->allModels) > 0) {
    foreach ($trackingOrder->allModels as $key => $value) {
        ?>
        <div class="track-list tracking-order-<?= $value['orderId'] ?>">
            <div class="row tk-head">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    Status tracking code: <?= $value['invoiceNo'] ?>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="col-lg-4 col-md-6"><?= $value['item'] ?> Item</div>
                    <div class="col-lg-8 col-md-6">Shipping to <?php echo $value['firstname'] . '&nbsp;' . $value['lastname']; ?></div>
                </div>
            </div>
            <div class="row tk-body">
                <br><br>
                <div class="col-lg-12 col-md-12">
                    <table style="width: 100%" class="text-center">
                        <tr>
                            <td>
                                <?php
                                if ($value['status'] >= 5) {
                                    ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/i-y-box.png" alt="" class="img-responsive img-circle">
                                <?php } else { ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/i-g-box.png" alt="" class="img-responsive img-circle">
                                <?php } ?>
                            </td>
                            <td><i class="fa fa-arrow-right size24" aria-hidden="true"></i></td>
                            <td>
                                <?php
                                if ($value['status'] >= 14) {
                                    ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/i-y-truck.png" alt="" class="img-responsive img-circle">
                                <?php } else { ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/i-g-truck.png" alt="" class="img-responsive img-circle">
                                <?php } ?>
                            </td>
                            <td><i class="fa fa-arrow-right size24" aria-hidden="true"></i></td>
                            <td>
                                <?php
                                if ($value['status'] >= 15) {
                                    ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/i-y-check.png" alt="" class="img-responsive img-circle">
                                <?php } else { ?>
                                    <img src="<?= \Yii::$app->homeUrl ?>imgs/i-g-check.png" alt="" class="img-responsive img-circle">
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td><div class="size10">&nbsp;</div><p>ON PROCESS</p></td>
                            <td>&nbsp;</td>
                            <td><div class="size10">&nbsp;</div><p class="fc-g999">SHIPPING</p></td>
                            <td>&nbsp;</td>
                            <td><div class="size10">&nbsp;</div><p class="fc-g999">COMPLETE</p></td>
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