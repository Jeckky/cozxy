<?php

use yii\helpers\Html;
use yii\helpers\Url;

$id = uniqid();
$val = rand(1, 10);
//echo '<pre>';
//print_r($item);
?>
<div class="cart-detail" id="item<?= $item['orderItemId'] ?>">
    <div class="row">
        <?= Html::hiddenInput("productId", $item["productId"], ['id' => 'productId']); ?>
        <?= Html::hiddenInput("productSuppId", $item["productSuppId"], ['id' => 'productSuppId']); ?>
        <?= Html::hiddenInput("sendDate", $item["sendDate"], ['id' => 'sendDate']); ?>
        <?= Html::hiddenInput("orderId", $this->params['cart']['orderId'], ['id' => 'orderId']); ?>
        <div class="col-sm-3">
            <?= Html::img($item['image'], ['class' => 'img-responsive']) ?></div>
        <div class="col-sm-5">
            <p class="size20"><?= $item['title'] ?></p>
            <p>
                <span class="size18"><span class="multi-<?= $id ?>"></span> <?= number_format($item["priceOnePiece"], 2) . " ฿" ?> THB</span> &nbsp;
                <span class="size14 onsale"><?= number_format($item["priceMarket"], 2) ?> THB</span>
            </p>
            <div class="col-xs-12 size18">
                <a href="javascript:qSet('<?= $id ?>',-1);"><i class="fa fa-minus-circle" aria-hidden="true" style="color: #000"></i></a>
                <input type="text" name="quantity" class="quantity quantity-<?= $id ?>" value="<?= $item["qty"] ?>">
                <a href="javascript:qSet('<?= $id ?>',1);"><i class="fa fa-plus-circle" aria-hidden="true" style="color: #000"></i></a>
            </div>
        </div>
        <div class="col-sm-4 fc-g666">
            <table style="width:100%">
                <tr>
                    <td>Quatity</td>
                    <td style="width:32px">:</td>
                    <td><?= $item["qty"] ?></td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Size</td>
                    <td>:</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    </div>
</div>
