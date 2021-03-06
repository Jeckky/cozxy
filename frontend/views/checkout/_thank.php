<div class="wrapper-cozxy">
    <div class="container login-box">
        <div class="size32">&nbsp;</div>
        <div class="row">
            <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
                <?php if ($res['status'] == 1): ?>
                    <p class="size20 size18-xs">Cozxy.com - Payment is complete.</p>
                <?php elseif ($res['status'] == 2): ?>
                    <p class="size20 size18-xs">Cozxy.com - Payments are not complete, wait for a review and contact from Cozxy.com </p>
                <?php else: ?>
                    <<p class="size20 size18-xs">Cozxy.com - Payment failed.</p>
                <?php endif; ?>
            </div>
            <div class="col-xs-12 bg-white size18 b" style="padding: 20px;">
                <?php if ($res['status'] == 1): ?>

                    Your Cozxy.com OrderNo <a href="<?= Yii::$app->homeUrl . "my-account/detail-tracking/" . common\models\ModelMaster::encodeParams(['orderId' => $res['orderId']]) . '/' . $res['orderNo'] ?>"><?= isset($res['orderNo']) ? $res['orderNo'] : "-" ?></a>
                    and invoiceNo : <a href="<?= Yii::$app->homeUrl . "my-account/detail-tracking/" . common\models\ModelMaster::encodeParams(['orderId' => $res['orderId']]) . '/' . $res['orderNo'] ?>"><?= isset($res['invoiceNo']) ? $res['invoiceNo'] : "-" ?></a><br>
                    <?php
                    if (isset($trackingOrder) && !empty($trackingOrder)) {
                        ?>
                        <h4>
                            <strong><i class="fa fa-truck" aria-hidden="true"></i> TRACKING ORDER</strong>
                        </h4>
                        <div class="col-lg-12 col-md-12 cart-body">
                            <?= $this->render('@app/themes/cozxy/layouts/my-account/_tracking', ['trackingOrder' => $trackingOrder]) ?>
                            <hr>
                        </div>
                    <?php } ?>
                    <hr>
                    Thank you for shopping with us. Please check your order at View order list. We'll send a confirmation with your code to open your locker once your items are in! <br>
                    If there are any changes, we will notify you via email and SMS.
                <?php else: ?>

                    <?= $res["message"]; ?>

                <?php endif; ?>
                <div class="row" style="margin-top: 1cm;">
                    <div class="col-lg-6 col-md-6 col-sm-6 ">
                        <a href="<?= Yii::$app->homeUrl ?>" class="b btn-yellow" ">Go shopping</a>&nbsp;&nbsp;&nbsp;
                        <a href="<?= Yii::$app->homeUrl . "my-account?act=order-history" ?>" class="b btn-black" style="background-color: #000;color: #FFF;">View order list</a>&nbsp;&nbsp;&nbsp;
                        <a href="<?= Yii::$app->homeUrl . "my-account/detail-tracking/" . \common\models\ModelMaster::encodeParams(['orderId' => $res['orderId']]) . "/" . $res['orderNo'] ?>" class="b btn-black">Order tracking</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="size32">&nbsp;</div>
</div>
