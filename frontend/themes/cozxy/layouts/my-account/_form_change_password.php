<?php

use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>

<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">MY ACCOUNT :: Change Password</p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>
            <?php $form = ActiveForm::begin(['id' => 'register-form', 'action' => Yii::$app->homeUrl . 'my-account/change-password', 'options' => ['class' => 'registr-form']]); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Current Password</label>

                <?=
                $form->field($model, 'currentPassword')->passwordInput()->textInput(['type' => 'password', 'class' => 'fullwidth pwd1', 'placeholder' => 'CURRENT PASSWORD', 'onchange' => '
                            $.post( "' . Yii::$app->homeUrl . 'my-account/reset", {token: $(this).val()}, function( data ) {
                              //$( "#suborders-product_price" ).val( data );
                                if(data == 1){
                                    $("#user-newpassword").prop("disabled", false);
                                    $("#user-newpassword").focus();
                                    $("#user-repassword").prop("disabled", false);
                                    $("#suborders-product_price").html("").css("color", "#a94442");
                                }else{
                                    $("#user-newpassword").prop("disabled", true);
                                    $("#user-repassword").prop("disabled", true);
                                    $("#suborders-product_price").html("Please try again in a few minutes.").css("color", "#a94442");
                                }
                            });
                        '])->label(false);
                ?>
                <p id="suborders-product_price"></p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Password</label>
                        <?=
                        $form->field($model, 'newPassword')->passwordInput()->textInput(['type' => 'password', 'class' => 'fullwidth pwd1', 'placeholder' => 'NEW PASSWORD', 'disabled' => true])->label(false);
                        ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Reenter New Password</label>
                        <?=
                        $form->field($model, 'rePassword')->passwordInput()->textInput(['type' => 'password', 'class' => 'fullwidth pwd1', 'placeholder' => 'CONFIRM PASSWORD', 'disabled' => true])->label(false);
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 text-right">
                    <a href="<?= Url::to(['/my-account']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">BACK</a>
                    &nbsp;
                    <input type="submit" value="SAVE"  class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">
                    <!--<a href="<?//= Url::to(['/checkout/summary']) ?>" class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">SAVE</a>-->
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <div class="size18 size14-xs">&nbsp;</div>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>
