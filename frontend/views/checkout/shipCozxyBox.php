<?php
/* @var $this yii\web\View */
?>
<div class="wrapper-cozxy">
    <?= $this->render('@app/themes/cozxy/layouts/checkout/_checkout_shipCozxyBox', compact('shippingChooseActive', 'activeMap', 'pickingPointActiveShow', 'getUserInfo', 'model', 'pickingPointLockersCool', 'order', 'hash', 'NewBilling', 'pickingPoint', 'defaultAddress', 'name')) ?>
</div>