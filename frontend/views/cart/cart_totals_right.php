<table>
    <tr>
        <td>Cart subtotal</td>
        <td class="total align-r"><?= number_format($this->params['cart']['total'], 2) ?></td>
    </tr>
    <tr class="devider">
        <td>Shipping</td>
        <td class="shipping align-r"><?= (isset($this->params['cart']['shipping']) && $this->params['cart']['shipping'] == 0) ? "Free Shipping" : number_format($this->params['cart']['shipping'], 2) ?></td>
    </tr>
    <tr>
        <td>Order total</td>
        <td class="summary align-r"><?= number_format($this->params ['cart']['summary'], 2) ?></td>
    </tr>
</table>