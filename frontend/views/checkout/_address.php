<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?php
echo $this->render('_select_address', ['type' => $type, 'addresses' => $addresses, 'address' => $address, 'user' => $user]);
?>

<!--Checkout Form New Address-->
<a class="new-address-form panel-toggle <?= (Yii::$app->user->isGuest || count($user->addresses) == 0) ? " active action" : "" ?>" href="#New<?= ($type == 1) ? "Billing" : "Shipping" ?>">
    <i></i>New <?= ($type == 1) ? "Billing" : "Shipping" ?> Address</a>
<div class="row">
    <div class="col-lg-10 actionFormBillingNew">
        <div class="hidden-panel <?= (Yii::$app->user->isGuest || count($user->addresses) == 0) ? " expanded" : "" ?>" id="New<?= ($type == 1) ? "Billing" : "Shipping" ?>">
            <?php
//            throw new \yii\base\Exception(print_r($address->scenario, true));
            echo $this->render('form_billing', ['type' => $type, 'address' => $address]);
            ?>
        </div>
    </div>
</div>
