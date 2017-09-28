<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Sign Up at CozxyBooth - Buy what fuels your passion';
\frontend\assets\LoginRegisterAsset::register($this);

//$input = "0616539889";
//echo $output = '66' . substr($input, -9, -7) . substr($input, -7, -4) . substr($input, -4);
?>
<style type="text/css">
    .login-box .select-new {
        text-overflow: '';
        overflow: hidden;
        white-space: nowrap;
        border: 1px solid #999;
        /* padding: 11px 10px 12px; */
        /* margin-top: 8px; */
        margin-bottom: 8px;
        color: #666;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        /* -webkit-appearance: inherit; */
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
    }
</style>
<div class="container login-box">
    <div class="row">
        <div class="col-xs-6">
            <div class="size32">&nbsp;</div>
            <div class="row">
                <div class="col-lg-12 ">
                    <p class="size18">CREATE ACCOUNT BOOTH</p>
                    <div class="size14 hr-margin">&nbsp;</div>
                    <?php $form = ActiveForm::begin(['id' => 'register-form', 'options' => ['class' => 'registr-form']]); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?php // throw new \yii\base\Exception($model->scenario);   ?>
                            <?= $form->field($model, 'firstname')->textInput(['class' => 'fullwidth', 'placeholder' => 'FIRSTNAME'])->label(false); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'lastname')->textInput(['class' => 'fullwidth', 'placeholder' => 'LASTNAME'])->label(false); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php // throw new \yii\base\Exception($model->scenario);     ?>
                            <?= $form->field($model, 'tel')->textInput(['class' => 'fullwidth', 'placeholder' => 'MOBILE NUMBER'])->label(false); ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'EMAIL ADDRESS'])->label(false); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'password')->passwordInput(['class' => 'fullwidth', 'placeholder' => 'PASSWORD'])->label(false); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'confirmPassword')->passwordInput(['class' => 'fullwidth', 'placeholder' => 'CONFIRM PASSWORD'])->label(false); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!--<div>
                                <input type="checkbox" id="loginform-accept-term" name="User[acceptTerm]" value="1">
                                I have read and agreed with the <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg"> terms</a>
                            </div>-->
                            <input type="submit" id="create-account" class="btn-yellow fullwidth" value="CREATE ACCOUNT">
                        </div>
                    </div>

                </div>
                <?php ActiveForm::end(); ?>
            </div>

        </div>
        <div class="col-xs-6">
            <div class="size32">&nbsp;</div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <p class="size18"><?php echo strtoupper('Confirm Register(Booth)'); ?></p>
                    <div class="size14 hr-margin">&nbsp;</div>
                    <a href="<?= Url::to(['/booth/confirm']) ?>" class="btn-black-s text-center fullwidth"><span class="fc-yellow1">CONFIRM BOOTH</span></a>
                    <div class="size6">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="size64">&nbsp;</div>
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
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">I have read and agree with the terms</h4>
            </div>
            <div class="modal-body">
                <?= $content['description'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="acceptTerms">Accept</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
