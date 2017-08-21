<div class="col-xs-12 bg-black" style="padding:18px;">
    <div class="rela" style="color: #FFF;">
        COZXYCOIN
    </div>
</div>
<div class="col-xs-12 total-price bg-white">
    <div class="row">
        <div class="price-detail">Current point:
            <div class="pull-right"><?= $userPoint != '0' ? number_format($userPoint->currentPoint, 2) : '0.00' ?></div>
        </div>
        <div class="price-detail">Order subtotal:
            <div class="pull-right"><?= number_format($order->summary, 2) ?> </div>
        </div>
        <?php if (isset($systemCoin) && $systemCoin > 0) { ?>
            <div class="price-detail">Use your coin:
                <?php
                if ($order->summary >= $systemCoin) {
                    ?>
                    <div class="pull-right"><?= number_format($order->summary - $systemCoin, 2) ?></div>
                <?php } else { ?>
                    <div class="pull-right"><?= number_format($order->summary, 2) ?></div>
                <?php } ?>
            </div>
            <div class="price-detail">Use system coin:
                <div class="pull-right"><?= number_format($systemCoin, 2) ?></div>
            </div>

            <div class="price-detail">Your coin balance:
                <?php
                $balance = ($userPoint->currentPoint - $order->summary) + $systemCoin;
                ?>
                <div class="pull-right" style="color: <?= $balance >= 0 ? '#00cc33' : '#ff0000' ?>"><?= number_format($balance, 2) ?></div>
                <?php
                if ($balance < 0) {
                    ?>
                    <a href="/top-up?needMore=<?= ($order->summary - $userPoint->currentPoint) + $systemCoin ?>" class="b btn-success btn-block fullwidth text-center" style="padding:12px 32px; margin:10px auto 12px">TOP UP COZXYCOIN</a>
                <?php } ?>
            </div>
            <div class="price-detail">Your system coin balance:
                <?php
                $systemBalance = $userPoint->currentCozxySystemPoint - $systemCoin;
                ?>
                <div class="pull-right" style="color: <?= $balance >= 0 ? '#00cc33' : '#ff0000' ?>"><?= number_format($systemBalance, 2) ?></div>
            </div>
        <?php } else {//ไม่ใช้ system coin
            ?>
            <div class="price-detail">Balance:
                <?php
                $balance = $userPoint->currentPoint - $order->summary;
                ?>
                <div class="pull-right" style="color: <?= $balance >= 0 ? '#00cc33' : '#ff0000' ?>"><?= number_format($balance, 2) ?></div>
                <?php
                if ($balance < 0) {
                    ?>
                    <a href="/top-up?needMore=<?= $order->summary - $userPoint->currentPoint ?>" class="b btn-success btn-block fullwidth text-center" style="padding:12px 32px; margin:10px auto 12px">TOP UP COZXYCOIN</a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>