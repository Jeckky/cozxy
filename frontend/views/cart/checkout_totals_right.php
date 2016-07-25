<table style="font-size: 16px;">
    <tr>
        <th>Product</th>
    </tr>
    <?php foreach ($this->params['cart']['items'] as $item) {
        ?>
        <tr>
            <td class="name border"><?= $item['code'] ?><span>x<?= $item['qty'] ?></span></td>
            <td class="price border"><?= $item['total'] ?> ฿</td>
        </tr>
        <?php
    }
    ?>
    <tr>
        <td class="th">Cart subtotal</td>
        <td class="price"><?= number_format($this->params['cart']['total'], 2) ?> $</td>
    </tr>
    <?php if (isset($this->params['cart']['discount'])): ?>
        <tr>
            <td>Discount Code  <?= $this->params['cart']['couponCode'] ?></td>
            <td class="discount align-r"><?= number_format($this->params['cart']['discount'], 2) ?></td>
        </tr>
    <?php endif; ?>
    <tr>
        <td class="th border">Shipping</td>
        <td class="align-r border"><?= (isset($this->params['cart']['shippingRate']) && $this->params['cart']['shippingRate'] == 0) ? "Free Shipping" : number_format($this->params['cart']['shippingRate'], 2) ?></td>
    </tr>
    <tr>
        <td class="th">Order total</td>
        <td class="price"><?= number_format($this->params ['cart']['summary'], 2) ?> $</td>
    </tr>
</table>