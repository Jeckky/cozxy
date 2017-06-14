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
                <span class="size18"><span class="multi-<?= $id ?>"></span> <?= number_format($item["priceOnePiece"], 2) ?> THB</span> &nbsp;
                <span class="size14 onsale"><?= number_format($item["priceMarket"], 2) ?> THB</span>
            </p>
            <div class="col-xs-12 size18 quantity-sel">
                <a href="javascript:qSet('<?= $id ?>',-1,'<?= $item["productSuppId"] ?>','<?= $this->params['cart']['orderId'] ?>','<?= $item["sendDate"] ?>');"><i class="fa fa-minus-circle" aria-hidden="true" style="color: #000"></i></a>
                <input type="text" name="quantity" id="quantity" class="quantity quantity-<?= $id ?>" value="<?= $item["qty"] ?>">
                <a href="javascript:qSet('<?= $id ?>',1,'<?= $item["productSuppId"] ?>','<?= $this->params['cart']['orderId'] ?>','<?= $item["sendDate"] ?>');"><i class="fa fa-plus-circle" aria-hidden="true" style="color: #000"></i></a>
            </div>
        </div>
        <div class="col-sm-3 fc-g666">
            <table style="width:100%" class="qty-cart">
                <tr >
                    <td>Quatity</td>
                    <td style="width:32px">:</td>
                    <td><div id="qty-cart-show"><?= $item["qty"] ?></div></td>
                </tr>
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
<!--                <tr>
        <td>Size</td>
        <td>:</td>
        <td>None</td>
    </tr>-->

            </table>
        </div>
        <div class="col-sm-1 fc-g666">
            <table style="width:100%; text-align: center;">
                <tr>
                    <td>Delete</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr class="delete-items-cart">
                    <td>
                        <a href="javascript:deleteItemCart('<?= $item['orderItemId'] ?>');" id="deleteItemCart-<?= $item['orderItemId'] ?>" class=" text-danger">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    </td>
                    <td>&nbsp;</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</div>
