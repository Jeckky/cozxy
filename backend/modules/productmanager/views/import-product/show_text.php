<?php

use yii\helpers\Html;
?>

<table class="table">
    <?php
    if (isset($data) && count($data) > 0) {
        foreach ($data as $title):
            ?>
            <tr><td><?= $title; ?></td></tr>
            <?php
        endforeach;
    }
    ?>
</table>