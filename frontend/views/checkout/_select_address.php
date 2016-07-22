<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php if (!Yii::$app->user->isGuest): ?>
    <?php
    if (count($user->addresses) > 0):
        ?>
        <a class="panel-toggle active action" href="#costfit-select-<?= ($type == 1) ? "Billing" : "Shipping" ?>-address"><i></i>Select <?= ($type == 1) ? "Billing" : "Shipping" ?> Address</a>
        <div class="row" style="background-color: rgba(249, 249, 249, 0.32);">
            <div class="col-lg-12">
                <div class="hidden-panel expanded" id="costfit-select-<?= ($type == 1) ? "Billing" : "Shipping" ?>-address" style="color: #292c2e;">
                    <?php
                    //echo '<pre>';
                    // print_r($address);
                    //echo count($address);
                    for ($index = 0; $index <= 2; $index++) {
                        //foreach ($address as $value) {
                        ?>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="tile text-center" style="padding: 5px; font-size: 12px; border: 1px #003147 solid; word-wrap: break-word;">
                                นายกมล พวงเกษม<br>
                                เลขที่ 1 ชั้น 7 ซอยลาดพร้าว 19<br>
                                จอมพล จตุจักร กรุงเทพ<br>
                                10900<br>
                                <div class="footer-cost-fit">
                                    <a class="panel-toggle" href="#address1">
                                        <div class="radio light">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-sm btn-info checkout_select_address<?= ($type == 1) ? "_billing" : "_shipping" ?>">
                                                    <input type="radio" name="checkout_select_address" id="checkout_select_address<?= ($type == 1) ? "_billing" : "_shipping" ?>" <?php
                                                    if ($index == 0) {
                                                        echo "checked";
                                                    }
                                                    ?> value="<?php echo $index; ?>"> เลือก
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
                        $index = $index++;
                    }
                    ?>
                    <div class="row hide" id="<?= ($type == 1) ? "billing" : "shipping" ?>Update">
                        <div class="col-lg-12">
                            <?php echo $this->render('form_billing', ['address' => $address, 'type' => $type, 'isUpdate' => true]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif;
?>