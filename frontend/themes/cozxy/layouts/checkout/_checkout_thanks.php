<?php
use yii\helpers\Url;
use yii\helpers\Html;

\frontend\assets\CheckoutAsset::register($this);
?>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">ORDER COMPLETED</p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12">&nbsp;</div>
            <div class="size24 size16-xs b text-center">Thank you for order the product</div>
            <div class="size8">&nbsp;</div>
            <div class="size16 text-center">Order number: 23123456</div>
            <div class="size18">&nbsp;</div>
            <div class="size16 b">Order Summary</div>
            <div class="size12">&nbsp;</div>
            <div class="table-responsive order-list">
                <table class="table fc-g666">
                    <thead class="size18 size16-xs">
                    <tr>
                        <th class="col-sm-1 col-xs-1">Items</th>
                        <th></th>
                        <th class="text-center">Quantity</th>
                        <th class="text-right">Price</th>
                    </tr>
                    </thead>
                    <tbody class="size16 size14-xs">
                    <?php for($i=1;$i<=5;$i++):?>
                    <tr>
                        <td><?=Html::img(['/imgs/product0'.$i.'.jpg'], ['class'=>'img-responsive'])?></td>
                        <td>QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG</td>
                        <td class="text-center">1</td>
                        <td class="text-right">43,000 THB</td>
                    </tr>
                    <?php endfor;?>
                    </tbody>
                </table>
            </div>
            <div class="size12 hr-margin">&nbsp;</div>
            <div class="col-md-3 col-md-offset-6 col-sm-5 col-sm-offset-2 col-xs-6">Subtotal</div><div class="col-md-3 col-sm-5 col-xs-6 text-right">129,000 THB</div>
            <div class="col-md-3 col-md-offset-6 col-sm-5 col-sm-offset-2 col-xs-6">Promo code</div><div class="col-md-3 col-sm-5 col-xs-6 text-right">– 1,000 THB</div>
            <div class="size24">&nbsp;</div>
            <div class="col-md-3 col-md-offset-6 col-sm-5 col-sm-offset-2 col-xs-5 size20 size16-xs b">Total</div><div class="col-md-3 col-sm-5 col-xs-7 text-right size20 size16-xs b">128,000 THB</div>
            <div class="size32">&nbsp;</div>
            <div class="text-center"><a href="product.php" class="b btn-yellow">CONTINUE SHOPPING</a></div>
            <div class="size32">&nbsp;</div>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>
