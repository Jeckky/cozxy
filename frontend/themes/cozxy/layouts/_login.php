<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

\frontend\assets\LoginRegisterAsset::register($this);
?>
<div class="container login-box">
    <div class="row">
        <div class="col-md-6">
            <div class="size32">&nbsp;</div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <p class="size18">LOGIN</p>
                    <div class="size14 hr-margin">&nbsp;</div>
                    <?php $form = ActiveForm::begin(['id' => 'register-form', 'action' => Yii::$app->homeUrl . 'site/login', 'options' => ['class' => 'registr-form']]); ?>
                    <?= $form->field($model, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'EMAIL ADDRESS'])->label(false); ?>
                    <?= $form->field($model, 'password')->passwordInput(['class' => 'fullwidth', 'placeholder' => 'PASSWORD'])->label(false); ?>

                    <input type="submit" class="btn-yellow fullwidth" value="LOGIN">
                    <div class="row">
                        <div class="col-sm-6 f-margin">
                            <a href="#" data-toggle="modal" data-target=".bs-forget-modal-lg"><u class="fc-black">Forget password?</u></a>
                        </div>
                        <div class="col-sm-6 f-margin text-right">
                            <label>
                                <?= $form->field($model, 'rememberMe')->checkbox(['template' => "<div class=\"\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>"])->label(' &nbsp; Remember me') ?>
                                <!--<input type="checkbox" name="LoginForm[remember]"> &nbsp; Remember me-->
                            </label>
                        </div>
                    </div>
                    <!--<a href="#" class="btn-facebook text-center fullwidth"><i class="fa fa-facebook" aria-hidden="true"></i> &nbsp; LOGIN</a>-->

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="size32">&nbsp;</div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <p class="size18">CREATE ACCOUNT</p>
                    <div class="size14 hr-margin">&nbsp;</div>
                    <a href="<?= Url::to(['/site/signup']) ?>" class="btn-black-s text-center fullwidth"><span class="fc-yellow1">REGISTER</span></a>
                    <div class="size6">&nbsp;</div>
                    <div class="text-center"><a href="<?= Url::to(['/site/why-register']) ?>"><u class="fc-black">Why register?</u></a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="background:#ccc url(<?= Url::home() ?>imgs/c-diamond.png) center no-repeat; background-size: cover; padding: 64px 0 96px; margin-top: 48px;" class="text-center size48 size32-sm size24-xs b">HOW IT WORK</div>
<div class="container" style="margin-top: -32px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table style="width: 100%" class="text-center">
                <tr>
                    <td><?= Html::img(Url::home() . 'imgs/i-y-cart.png', ['class' => 'img-responsive img-circle']) ?></td>
                    <td><i class="fa fa-arrow-right size24" aria-hidden="true"></i></td>
                    <td><?= Html::img(Url::home() . 'imgs/i-y-pin.png', ['class' => 'img-responsive img-circle']) ?></td>
                    <td><i class="fa fa-arrow-right size24" aria-hidden="true"></i></td>
                    <td><?= Html::img(Url::home() . 'imgs/i-y-truck.png', ['class' => 'img-responsive img-circle']) ?></td>
                </tr>
                <tr>
                    <td><div class="size10">&nbsp;</div><p>SHOPPING</p></td>
                    <td>&nbsp;</td>
                    <td><div class="size10">&nbsp;</div><p>SELECT LOCATION</p></td>
                    <td>&nbsp;</td>
                    <td><div class="size10">&nbsp;</div><p>SHIPPING</p></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="size48">&nbsp;</div>


<div class="modal fade bs-forget-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="gridSystemModalLabel">+ Forget password?</h4>
            </div>

            <div class="row">

                <form id="default-add-new-billing-address" class="login-box" action="#" method="post">
                    <div class="col-md-12 col-md-offset-1">
                        <div class="size24">&nbsp;</div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <div class="form-group field-address-email required">
                                            <input type="text" id="address-email" class="fullwidth" name="forget-email" placeholder="Email" aria-required="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="size24">&nbsp;</div>
                    </div>
                </form>

            </div>

            <div class="modal-footer">
                <a href="#" class="b btn-black" style="padding:6px 11px; margin:24px auto 12px;" data-dismiss="modal" aria-label="Close">CANCEL</a>
                &nbsp;
                <a href="javascript:ForgetCozxy()" class="b btn-yellow" id="Forget" data-loading-text="<i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i> Processing..." style="padding:6px 11px; margin:24px auto 12px;">SUBMIT</a>
            </div>

        </div>
    </div>
</div>

