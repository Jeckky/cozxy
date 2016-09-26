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
<a class="new-address-form panel-toggle <?= (Yii::$app->user->isGuest || count($user->addresses) == 0) ? " active action" : "" ?>" href="#New<?= ($type == 1) ? "Billing" : "Shipping" ?>" style="margin-left: 5px;">
    <?= ($type == 1) ? " <i></i> New Billing Address" : "" ?> </a>
<div class="row">
    <?php
    if ($type == 1) {
        if (!Yii::$app->user->isGuest) {
            $user = new \common\models\costfit\User();
            ?>
            <div class="col-lg-10 actionFormBillingNew">
                <div class="hidden-panel <?//= (Yii::$app->user->isGuest || count($user->addresses) == 0) ? " expanded" : "" ?>" id="New<?= ($type == 1) ? "Billing" : "Shipping" ?>">
                     <?php echo $this->render('form_billing', ['type' => $type, 'address' => $address]); ?>
            </div>
        </div>
        <?php
    }
}
?>
</div>
