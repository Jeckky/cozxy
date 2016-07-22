<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
?>
<style type="text/css">
    .address{
        padding: 5px; font-size: 12px; border: 1px #003147 solid; word-wrap: break-word; margin-bottom: 2px;
    }
    .main-title{
        height: 120px;
        overflow-y: auto;
    }
    .main-shipping-address{
        height: 203px;
        overflow-y: auto;
    }
</style>

<?php if (!Yii::$app->user->isGuest): ?>
    <?php
    if (count($user->addresses) > 0):
        ?>
        <a class="panel-toggle active action" href="#costfit-select-<?= ($type == 1) ? "Billing" : "Shipping" ?>-address"><i></i>Select <?= ($type == 1) ? "Billing" : "Shipping" ?> Address</a>
        <div class="row" style="background-color: rgba(249, 249, 249, 0.32);">
            <div class="col-lg-12">
                <div class="hidden-panel expanded main-shipping-address" id="costfit-select-<?= ($type == 1) ? "Billing" : "Shipping" ?>-address" style="color: #292c2e;">
                    <?php
                    foreach ($addresses as $value) {
                        ?>
                        <div class="col-lg-4 col-md-4 col-sm-4" >
                            <div class="tile address text-center" style=" <?= ($value->isDefault == 1) ? "background-color: rgba(31, 30, 30, 0.03)" : '' ?>">
                                <div class="main-title">
                                    <?php echo ($user->firstname) ? $user->firstname : $user->firstname . ' ,'; ?>&nbsp;<?php echo ($user->lastname) ? $user->lastname : $user->lastname . ' ,'; ?><br>
                                    <?php echo ($value->company) ? $value->company : $model->company . ' ,'; ?><br>
                                    <?php echo ($value->address) ? $value->address : '' . ' ,'; ?><br>
                                    <?php echo ($value->district['localName']) ? $value->district['localName'] : '' . ' ,'; ?>
                                    <?php echo ($value->cities['cityName']) ? $value->cities['cityName'] : '' . ' ,'; ?>
                                    <?php echo ($value->states['stateName']) ? $value->states['stateName'] : '' . ' ,'; ?>
                                    <?php echo '<br>' . ($value->countries['localName']) ? $value->countries['localName'] : '' . ' ,'; ?>
                                    <?php echo '<br>Zipcode ' . $value->zipcode; ?>
                                </div>
                                <div class="footer-cost-fit">
                                    <a class="panel-toggle" href="#address1">
                                        <div class="radio light">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-sm btn-info checkout_select_address<?= ($type == 1) ? "_billing" : "_shipping" ?>">
                                                    <input type="radio" name="checkout_select_address<?= ($type == 1) ? "_billing" : "_shipping" ?>" id="checkout_select_address<?= ($type == 1) ? "_billing" : "_shipping" ?>"
                                                    <?php
                                                    if ($type == 2) {
                                                        echo ($value->isDefault == 1) ? 'checked' : '';
                                                    }
                                                    ?> value="<?php echo $value->addressId; ?>"> เลือก
                                                </label>
                                                <label class="btn btn-sm btn-warning edit_select checkout_update_address<?= ($type == 1) ? "_billing" : "_shipping" ?>">
                                                    แก้ไข <span class="pp-label"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
                <div class="row hide" id="<?= ($type == 1) ? "billing" : "shipping" ?>Update">

                    <div class="col-lg-12"> 
                        <?php echo $this->render('form_billing', ['address' => $address, 'type' => $type, 'isUpdate' => true]); ?>
                    </div>

                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif;
?>
<br><br>