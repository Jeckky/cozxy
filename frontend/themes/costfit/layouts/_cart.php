<?php
$check_item = count($this->params['cart']['items']);
//throw new \yii\base\Exception($check_item);
?>
<style type="text/css">
    .body{
        min-height: 250px;
        max-height: 300px;
        overflow-y: auto;
    }
</style>
<div class="cart-btn">
    <a class="btn btn-outlined-invert">
        <i class="icon-shopping-cart-content"></i><span><?= $this->params['cart']['qty'] ?></span>
        <b id="cartTotal"><?= number_format($this->params['cart']['total'], 2) ?></b>
    </a>
    <!--Cart Dropdown-->
    <div class="cart-dropdown" style="margin-top: -15px; font-size: 14px;">
        <span></span><!--Small rectangle to overlap Cart button-->
        <div class="body">
            <table id="cartTable">
                <tr>
                    <th>Items</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                <?php foreach ($this->params['cart']['items'] as $item): ?>
                    <tr class="item" id="item<?= $item['orderItemId'] ?>">
                        <td >
                            <div class="delete"><?= yii\helpers\Html::hiddenInput("orderItemId", $item['orderItemId'], ['id' => 'orderItemId']); ?></div>
                            <a href="<?php echo Yii::$app->homeUrl; ?>products/<?php echo common\models\ModelMaster::encodeParams(['productId' => $item["productId"], 'productSupplierId' => $item['productSuppId']]); ?>"><?= $item['title'] ?></a></td>
                        <td class="qty"><input id="qty" type="text" value="<?= $item['qty'] ?>" readonly="true"></td>
                        <td class="price"><?= number_format($item['price'], 2) ?></td>
                    <input type="hidden" id="productSuppId" value="<?= $item['productSuppId'] ?>">
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="footer group">
            <div class="buttons">
                <?php
                if (\Yii::$app->user->isGuest == 1) {
                    ?>
                        <!--<a class="btn btn-outlined-invert" href="<?= Yii::$app->homeUrl ?>register/login"><i class="icon-download"></i>Checkout</a>-->
                    <?php
                } else {
                    ?>
                        <!--<a class = "btn btn-outlined-invert" onclick = "itemzero(<?php //echo $check_item;   ?>, 'checkout')"><i class = "icon-download"></i>Checkout</a>-->
                <?php }
                ?>
                <a class="btn btn-outlined-invert" onclick="itemzero(<?php echo $check_item; ?>, 'cart')">
                    <i class="icon-shopping-cart-content"></i>To cart
                </a>
            </div>
            <div class="total"><?= number_format($this->params['cart']['total'], 2) ?></div>
        </div>
    </div><!--Cart Dropdown Close-->
</div>