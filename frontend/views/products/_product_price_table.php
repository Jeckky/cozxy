<?php
$i = 0;
foreach ($model->productPrices as $pp) {
    ?>
    <div  class="col-lg-2 col-md-2 col-sm-12 " style="float: left; padding-right: 0px; padding-left: 0px;">
        <table id="pp<?= number_format($pp->quantity, 0) ?>" class="col-lg-12 col-md-12 text-center <?= ($i == 0) ? " priceActive" : " " ?>" style="font-size: 14px; border: 1px #f5f5f5 solid;">

            <thead style="border-bottom: 1px #f5f5f5 solid;">
                <tr>
                    <th class="text-center">Buy <?= number_format($pp->quantity, 0) ?></th>
                </tr>
            </thead>
            <tbody>
                <tr class="item first">
                    <td class="thumb"><?= number_format($pp->getSavePrice(), 2) . " ฿"; ?></td>
                </tr>
                <tr class="item first">
                    <td class="name">
                        <small>off your order</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
    $i++;
}
?>