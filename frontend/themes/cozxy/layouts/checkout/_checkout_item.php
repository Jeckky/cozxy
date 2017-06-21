<?php

use yii\helpers\Html;
use yii\helpers\Url;

$id = uniqid();
?>
<div class="cart-detail " id="item<?= $item['orderItemId'] ?>">
    <div class="row">
        <?= Html::hiddenInput("productId", $item["productId"], ['id' => 'productId']); ?>
        <?= Html::hiddenInput("productSuppId", $item["productSuppId"], ['id' => 'productSuppId']); ?>
        <?= Html::hiddenInput("sendDate", $item["sendDate"], ['id' => 'sendDate']); ?>
        <?= Html::hiddenInput("orderId", $this->params['cart']['orderId'], ['id' => 'orderId']); ?>
        <div class="col-sm-2"><?= Html::img($item['image'], ['class' => 'img-responsive']) ?></div>
        <div class="col-sm-6">
            <p class="size20"><?= $item['title'] ?></p>
            <p>
                <span class="size18"><span class="multi-<?= $id ?>"></span> <?= number_format($item["priceOnePiece"], 2) . " ฿" ?> THB</span> &nbsp;
            </p>
        </div>
        <div class="col-sm-4 fc-g666">
            <table style="width:100%">
                <tr>
                    <td>Quatity</td>
                    <td style="width:32px">:</td>
                    <td><?= $item["qty"] ?></td>
                </tr>
                <!--
                <tr>
                    <td>Color</td>
                    <td>:</td>
                    <td>None</td>
                </tr>
                <tr>
                    <td>Size</td>
                    <td>:</td>
                    <td>None</td>
                </tr>-->
                <?php
                $options = \common\models\costfit\ProductGroupOptionValue::find()->where("productSuppId = " . $item["productSuppId"])->all();
                foreach ($options as $option):
                    ?>
                    <tr>
                        <td><?= $option->productGroupTemplateOption->title; ?></td>
                        <td>:</td>
                        <td><?= $option->value ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
