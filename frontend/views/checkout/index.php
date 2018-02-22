<?php
/* @var $this yii\web\View */
?>
<div class="wrapper-cozxy">
    <?= $this->render('@app/themes/cozxy/layouts/checkout/_checkout', compact('shipTo', 'myAddress', 'shipTostart', 'activeMap', 'shipToCozxyBoxNew', 'getUserInfo', 'model', 'pickingPointLockersCool', 'order', 'hash', 'NewBilling', 'pickingPoint', 'defaultAddress')) ?>

</div>
