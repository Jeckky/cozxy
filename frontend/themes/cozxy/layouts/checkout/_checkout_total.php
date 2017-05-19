<?php
use yii\helpers\Url;
?>
<div class="col-xs-12 bg-yellow1" style="padding:18px;">
    <div class="rela size20">
        Summary
    </div>
</div>

<div class="col-xs-12 total-price bg-white">
    <div class="row">
        <div class="price-detail">SUBTOTAL
            <div class="pull-right">129,000 THB</div>
        </div>
        <div class="price-detail">SHIPPING
            <div class="pull-right">FREE</div>
        </div>
        <div class="price-detail">PROMO CODE
            <div class="pull-right">– 1,000 THB</div>
        </div>
        <div class="price-detail b size20 size18-sm size18-xs">TOTAL
            <div class="pull-right">128,000 THB</div>
        </div>
    </div>

    <a href="<?= Url::to(['/checkout']) ?>" class="b btn-success btn-block text-center" style="padding:12px 32px; margin:12px auto 12px">TOP UP CozxyCoin</a>
    <a href="<?= Url::to(['/checkout']) ?>" class="b btn-yellow fullwidth text-center" style="padding:12px 32px; margin:2px auto 12px">PAY by CozxyCoin</a>
</div>