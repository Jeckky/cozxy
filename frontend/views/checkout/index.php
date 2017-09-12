<?php

/* @var $this yii\web\View */
?>

<?= $this->render('@app/themes/cozxy/layouts/checkout/_checkout', compact('getUserInfo', 'model', 'pickingPointLockersCool', 'order', 'hash', 'NewBilling', 'pickingPoint', 'defaultAddress')) ?>
