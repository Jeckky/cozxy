<div class="cart-btn">
    <a class="btn btn-outlined-invert" href="<?=Yii::$app->homeUrl?>cart">
        <i class="icon-shopping-cart-content"></i><span><?=$this->params['cart']['qty']?></span><b><?=number_format($this->params['cart']['total'], 2)?></b>
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
                <?php foreach ($this->params['cart']['items'] as $item):?>
                <tr class="item">
                    <td>
                        <div class="delete"></div>
                        <a href="#"><?=$item['title']?></a></td>
                    <td><input type="text" value="<?=$item['qty']?>"></td>
                    <td class="price"><?=number_format($item['price'], 2)?></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
        <div class="footer group">
            <div class="buttons">
                <a class="btn btn-outlined-invert" href="<?=Yii::$app->homeUrl?>checkout"><i class="icon-download"></i>Checkout</a>
                <a class="btn btn-outlined-invert" href="<?=Yii::$app->homeUrl?>cart">
                    <i class="icon-shopping-cart-content"></i>To cart
                </a>
            </div>
            <div class="total"><?=number_format($this->params['cart']['total'], 2)?></div>
        </div>
    </div><!--Cart Dropdown Close-->
</div>