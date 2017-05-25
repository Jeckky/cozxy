<?php
use kartik\select2\Select2;
use yii\helpers\Url;
?>

<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">MY ACCOUNT :: New Billing Address</p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>

            <form method="post" action="" class="login-box">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" name="firstname" class="fullwidth" placeholder="FIRSTNAME" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" name="lastname" class="fullwidth" placeholder="LASTNAME" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Compnay (option)</label>
                    <input type="text" name="address" class="fullwidth" placeholder="COMPANY" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" name="address" class="fullwidth" placeholder="ADDRESS" required>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Province</label>
                            <?= Select2::widget([
                                'name' => 'province',
                                'value' => '',
                                'data' => ['Bangkok', 'Bangkok2', 'Bangkok3'],
                                'options' => ['placeholder' => 'Select Province']
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">City</label>
                            <?= Select2::widget([
                                'name' => 'city',
                                'value' => '',
                                'data' => ['Bang Khen', 'Bang Khen2', 'Bang Khen3'],
                                'options' => ['placeholder' => 'Select City']
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Zipcode</label>
                            <input type="text" name="zip" class="fullwidth" placeholder="ZIP CODE" required>
                        </div>
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
