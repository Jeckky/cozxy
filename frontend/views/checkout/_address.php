<!--Checkout Form Select  Address-->
<?php echo $this->render('_select_address', ['type' => $type, 'address' => $address, 'user' => $user]); ?>

<!--Checkout Form New Address-->
<a class="panel-toggle <?= (Yii::$app->user->isGuest || count($user->addresses) == 0) ? " active action" : "" ?>" href="#New<?= ($type == 1) ? "Billing" : "Shipping" ?>"><i></i>New <?= ($type == 1) ? "Billing" : "Shipping" ?> Address</a>
<div class="row">
    <div class="col-lg-10">
        <div class="hidden-panel <?= (Yii::$app->user->isGuest || count($user->addresses) == 0) ? " expanded" : "" ?>" id="New<?= ($type == 1) ? "Billing" : "Shipping" ?>">
            <?php echo $this->render('form_billing', ['type' => $type, 'address' => $address]); ?>
        </div>
    </div>
</div>
