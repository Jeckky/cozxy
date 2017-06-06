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
            <?php
            if (count($orderHistory->allModels) > 0) {
                foreach ($orderHistory->allModels as $key => $value) {
                    ?>
                    <tr>
                        <td>Order #<?= isset($value['OrderNo']) ? $value['OrderNo'] : '-' ?></td>
                        <td><?= isset($value['status']) ? $value['status'] : '-' ?></td>
                        <td><?= isset($value['updateDateTime']) ? $value['updateDateTime'] : '-' ?></td>
                        <td class="text-center"><?= Html::a('<i class="fa fa-search"></i>', ['/#']) ?></td>
                    </tr>
                    <?php
                }
            } else {

            }
            ?>
        </tbody>
    </table>
</div>