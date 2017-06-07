<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Forget Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">Forget Password</p>
        </div>
        <div class="col-xs-12 bg-white size18 b" style="padding: 20px;">
            <?php $form = ActiveForm::begin(['id' => 'forget-form', 'options' => ['class' => 'registr-form']]); ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Password</label>
                        <?=
                        $form->field($model, 'newPassword')->passwordInput()->textInput(['type' => 'password', 'class' => 'fullwidth pwd1', 'placeholder' => 'NEW PASSWORD'])->label(false);
                        ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Reenter New Password</label>
                        <?=
                        $form->field($model, 'rePassword')->passwordInput()->textInput(['type' => 'password', 'class' => 'fullwidth pwd1', 'placeholder' => 'CONFIRM PASSWORD'])->label(false);
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

        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>