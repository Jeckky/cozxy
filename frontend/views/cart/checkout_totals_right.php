<table>
    <tr><th>Product</th></tr>
    <?php for ($index = 0; $index <= 3; $index++) {
        ?>
        <tr>
            <td class="name border">Bag<span>x1</span></td>
            <td class="price border">2715,00 $</td>
        </tr>
        <?php
        $index = $index++;
    }
    ?>
    <tr>
        <td class="th">Cart subtotal</td>
        <td class="price"><?= number_format($this->params['cart']['total'], 2) ?> $</td>
    </tr>
    <tr>
        <td class="th border">Shipping</td>
        <td class="align-r border"><?= (isset($this->params['cart']['shipping']) && $this->params['cart']['shipping'] == 0) ? "Free Shipping" : number_format($this->params['cart']['shipping'], 2) ?></td>
    </tr>
    <tr>
        <td class="th">Order total</td>
        <td class="price"><?= number_format($this->params ['cart']['summary'], 2) ?> $</td>
    </tr>
</table>