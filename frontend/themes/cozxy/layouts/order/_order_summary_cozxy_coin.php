<div class="col-xs-12 bg-black" style="padding:18px;">
    <div class="rela" style="color: #FFF;">
        CozxyCoin
    </div>
</div>
<div class="col-xs-12 total-price bg-white">
    <div class="row">
        <div class="price-detail">Current Point:
            <div class="pull-right"><?= $userPoint != '0' ? number_format($userPoint->currentPoint, 2) : '0.00' ?></div>
        </div>
        <div class="price-detail">Order subtotal:
            <div class="pull-right"><?= number_format($order->summary, 2) ?> </div>
        </div>

        <div class="price-detail">Balance:
            <?php
            $balance = $userPoint->currentPoint - $order->summary;
            ?>
            <div class="pull-right" style="color: <?= $balance >= 0 ? '#00cc33' : '#ff0000' ?>"><?= number_format($balance, 2) ?></div>
            <?php
            if ($balance < 0) {
                ?>
                <a href="/top-up?needMore=<?= $order->summary - $userPoint->currentPoint ?>" class="b btn-success btn-block fullwidth text-center" style="padding:12px 32px; margin:10px auto 12px">TOP UP CozxyCoin</a>
            <?php } ?>
        </div>

    </div>
</div>