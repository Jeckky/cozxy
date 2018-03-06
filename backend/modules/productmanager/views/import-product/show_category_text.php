<?php

use yii\helpers\Html;
?>

<table class="table">
    <?php
    if (isset($cateText) && count($cateText) > 0) {
        foreach ($cateText as $title):
            ?>
            <tr><td><?= $title; ?><td></tr>
            <?php
        endforeach;
    }
    ?>
</table>