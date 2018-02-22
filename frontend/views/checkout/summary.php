<?php
/* @var $this yii\web\View */
//echo 'addressId : ' . $addressId;
?>
<div class="wrapper-cozxy">
    <?= $this->render('@app/themes/cozxy/layouts/checkout/_checkout_summary', compact('myAddressInSummary', 'pickingMap', 'order', 'addressId', 'userPoint')) ?>
</div>