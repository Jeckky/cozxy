<?php
use kartik\select2\Select2;
use yii\helpers\Url;

?>

<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">MY ACCOUNT :: Edit Personal Detail</p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>

            <form method="post" action="" class="login-box">
                <div class="row">
                    <div class="col-md-6">
                        <p>First Name</p>
                        <input type="text" name="firstname" class="fullwidth" placeholder="FIRSTNAME" required></div>
                    <div class="col-md-6">
                        <p>Last Name</p>
                        <input type="text" name="lastname" class="fullwidth" placeholder="LASTNAME" required></div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p>Email</p>
                        <input type="text" name="username" class="fullwidth" placeholder="EMAIL ADDRESS" required>
                    </div>
                    <div class="col-md-4">
                        <p>Birthday</p>
                        <input type="number" name="dd" min="1" max="31" placeholder="31" style="width: 26%">
                        <input type="number" name="mm" min="1" max="12" placeholder="12" style="width: 26%">
                        <input type="number" name="yyyy" min="1800" max="2020" placeholder="1999" style="width: 40%">
                    </div>
                    <div class="col-md-4">
                        <p>Gender</p>
                        <input type="radio" name="gender" value="M"> &nbsp; Male &nbsp;
                        <input type="radio" name="gender" value="F"> &nbsp; Female &nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <a href="<?= Url::to(['/my-account']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">BACK</a>
                        &nbsp;
                        <a href="<?= Url::to(['/checkout/summary']) ?>" class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">SAVE</a>
                    </div>
                </div>
            </form>

            <div class="size18 size14-xs">&nbsp;</div>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>
