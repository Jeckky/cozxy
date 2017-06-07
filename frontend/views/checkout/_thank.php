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

                Your Cozxy.com Order  <a href="<?= Yii::$app->homeUrl . "profile/order" ?>"><?= isset($res['invoiceNo']) ? $res['invoiceNo'] : "-" ?></a><br>
                Thank you for shopping with us. Please check your order at View order list. We'll send a confirmation with your code to open your locker once your items are in! <br>
                If there are any changes, will will notify you via email and SMS.
            <?php else: ?>

                <?= $res["message"]; ?>

            <?php endif; ?>
            <div class="row" style="margin-top: 1cm;">
                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <a href="<?= Yii::$app->homeUrl ?>" class="b btn-yellow">Go shopping</a>&nbsp;&nbsp;&nbsp;
                    <a href="<?= Yii::$app->homeUrl . "my-account" ?>" class="b btn-black">View order list</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>