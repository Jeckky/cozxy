<?php

use yii\helpers\Html;
?>

<table class="table">
    <?php
    if (isset($currency) && count($currency) > 0) {
        foreach ($currency as $c):
            ?>
            <tr><td><?= $c; ?></td></tr>
            <?php
        endforeach;
    }
    ?>
</table>