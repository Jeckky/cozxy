<table class="cartTotalRight">
    <!--<tr>
        <td>Cart subtotal</td>
        <td class="total align-r// number_format($this->params['cart']['total'], 2) ?></td>
    </tr>-->
    <?php if (isset($this->params['cart']['discount'])): ?>
        <tr>
            <td>Discount Code  <?= $this->params['cart']['couponCode'] ?></td>
            <td class="discount align-r"><?= number_format($this->params['cart']['discount'], 2) ?></td>
        </tr>
    <?php endif; ?>
    <tr>
        <td>Price Subtotal</td>
        <td class="total align-r">xxx ฿</td>
    </tr>
    <tr style="color: red;">
        <td>Extra savings</td>
        <td class="total align-r">xxx ฿</td>
    </tr>
    <tr>
        <td>Shipping Free</td>
        <td class="total align-r">xxx ฿</td>
    </tr>
    <tr>
        <td>Estimated Tax</td>
        <td class="total align-r">xxx ฿</td>
    </tr>

    <tr class="devider">
        <td>Shipping</td>
        <td class="shipping align-r"><?= (isset($this->params['cart']['shippingRate']) && $this->params['cart']['shippingRate'] == 0) ? "Free Shipping" : number_format($this->params['cart']['shippingRate'], 2) ?></td>
    </tr>

</table>
<table>
    <tr>
        <td>Summary</td>
        <td class="summary align-r" style="font-weight: bold"><?= number_format($this->params ['cart']['summary'], 2) ?></td>
    </tr>
</table>