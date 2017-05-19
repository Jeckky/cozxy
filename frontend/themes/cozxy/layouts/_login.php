<?php
use yii\helpers\Html;
use yii\helpers\Url;

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
                    <form method="post" action="">
                        <input type="text" name="username" class="fullwidth" placeholder="EMAIL ADDRESS">
                        <input type="password" name="password" class="fullwidth" placeholder="PASSWORD">
                        <input type="submit" class="btn-yellow fullwidth" value="LOGIN">
                        <div class="row">
                            <div class="col-sm-6 f-margin"><a href="#"><u class="fc-black">Forget password?</u></a></div>
                            <div class="col-sm-6 f-margin text-right"><label><input type="checkbox" name="remember"> &nbsp; Remeber me</label></div>
                        </div>
                        <a href="#" class="btn-facebook text-center fullwidth"><i class="fa fa-facebook" aria-hidden="true"></i> &nbsp; LOGIN</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="size32">&nbsp;</div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <p class="size18">CREATE ACCOUNT</p>
                    <div class="size14 hr-margin">&nbsp;</div>
                    <a href="<?=Url::to(['/site/signup'])?>" class="btn-black-s text-center fullwidth"><span class="fc-yellow1">REGISTER</span></a>
                    <div class="size6">&nbsp;</div>
                    <div class="text-center"><a href="#"><u class="fc-black">Why register?</u></a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="background:#ccc url(<?=Url::home()?>imgs/c-diamond.png) center no-repeat; background-size: cover; padding: 64px 0 96px; margin-top: 48px;" class="text-center size48 size32-sm size24-xs b">HOW IT WORK</div>
<div class="container" style="margin-top: -32px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table style="width: 100%" class="text-center">
                <tr>
                    <td><?=Html::img(Url::home().'imgs/i-y-cart.png', ['class'=>'img-responsive img-circle'])?></td>
                    <td><i class="fa fa-arrow-right size24" aria-hidden="true"></i></td>
                    <td><?=Html::img(Url::home().'imgs/i-y-pin.png', ['class'=>'img-responsive img-circle'])?></td>
                    <td><i class="fa fa-arrow-right size24" aria-hidden="true"></i></td>
                    <td><?=Html::img(Url::home().'imgs/i-y-truck.png', ['class'=>'img-responsive img-circle'])?></td>
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