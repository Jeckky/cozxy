<div class="cart-btn">
    <a class="btn btn-outlined-invert" href="<?= Yii::$app->homeUrl ?>cart">
        <i class="icon-shopping-cart-content"></i><span><?= $this->params['cart']['qty'] ?></span><b id="cartTotal"><?= number_format($this->params['cart']['total'], 2) ?></b>
    </a>

    <!--Cart Dropdown-->
    <div class="cart-dropdown">
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
                        <td>
                            <div class="delete"><?= yii\helpers\Html::hiddenInput("orderItemId", $item['orderItemId'], ['id' => 'orderItemId']); ?></div>
                            <a href="#"><?= $item['title'] ?></a></td>
                        <td class="qty"><input id="qty" type="text" value="<?= $item['qty'] ?>"></td>
                        <td class="price"><?= number_format($item['price'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="footer group">
            <div class="buttons">
                <?php
                if (\Yii::$app->user->isGuest == 1) {
                    ?>
                    <a class="btn btn-outlined-invert" href="<?= Yii::$app->homeUrl ?>register/login"><i class="icon-download"></i>Checkout</a>
                    <?php
                } else {
                    ?>
                    <a class="btn btn-outlined-invert" href="<?= Yii::$app->homeUrl ?>checkout"><i class="icon-download"></i>Checkout</a>
                    <?php
                }
                ?>

                <a class="btn btn-outlined-invert" href="<?= Yii::$app->homeUrl ?>cart">
                    <i class="icon-shopping-cart-content"></i>To cart
                </a>
            </div>
            <div class="total"><?= number_format($this->params['cart']['total'], 2) ?></div>
        </div>
    </div><!--Cart Dropdown Close-->
</div>