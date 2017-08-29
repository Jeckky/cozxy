<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'VERIFICATION REGISTER';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs"><?= $this->title ?></p>
        </div>
        <div class="col-xs-12 bg-white b" style="padding:18px 18px 10px;">

            <?php $form = ActiveForm::begin(['id' => 'forget-form', 'options' => ['class' => 'registr-form']]); ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mobile Number</label>
                        <?=
                        $form->field($model, 'tel')->textInput(['class' => 'fullwidth pwd1', 'placeholder' => 'MOBILE NUMBER'])->label(false);
                        ?>
                    </div>
                </div>
                <!--confirm?token=_gbrlYkzDb
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Reenter Mobile Number</label>
                <?//=
                $form->field($model, 'tel')->textInput(['type' => 'password', 'class' => 'fullwidth pwd1', 'placeholder' => 'CONFIRM PASSWORD'])->label(false);
                ?>
                    </div>
                </div>
                -->
                <input type="hidden" name="User[cz]" value="<?= isset($data['cz']) ? $data['cz'] : '' ?>">
                <input type="hidden" name="User[token]" value="<?= isset($data['token']) ? $data['token'] : '' ?>">
            </div>

            <div class="row">
                <div class="col-xs-12 text-left">
                    <a href="<?= Url::to(['/']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">CANCEL</a>
                    &nbsp;
                    <input type="submit" value="CONFIRM"  class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">
                    <!--<a href="<?//= Url::to(['/checkout/summary']) ?>" class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">CONFIRM</a>-->
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
<div class="size32">&nbsp;</div>