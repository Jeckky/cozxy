<?php
use yii\helpers\Html;
?>
<div class="table-responsive order-list">
    <table class="table table-bordered table-striped fc-g666">
        <thead class="size18 size16-xs">
        <tr>
            <th>Order No.</th>
            <th>Status</th>
            <th>Date</th>
            <th></th>
        </tr>
        </thead>
        <tbody class="size16 size14-xs">
        <?php for($i=1;$i<10;$i++):?>
        <tr>
            <td>Order #0000<?=$i?></td>
            <td>Shipping Complete</td>
            <td>06/04/2017</td>
            <td class="text-center"><?=Html::a('<i class="fa fa-search"></i>', ['/#'])?></td>
        </tr>
        <?php endfor;?>
        </tbody>
    </table>
</div>