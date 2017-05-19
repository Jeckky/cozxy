<?php
use yii\helpers\Url;
use kartik\select2\Select2;

\frontend\assets\CheckoutAsset::register($this);
?>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <!-- Cart -->
        <div class="col-lg-9 col-md-8 cart-body">
            <div class="row">
                <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
                    <p class="size20 size18-xs">YOUR SHIPPING & BILLING ADDRESS</p>
                </div>
                <div class="col-xs-12 bg-white">

                    <!-- Shipping -->
                    <div class="cart-detail">
                        <div class="row">
                            <div class="col-lg-12">
                                Shipping Address
                                <!--                                <a href="chk-edit1.php" class="pull-right btn-g999 p-edit">Edit</a></div><div class="col-xs-12 size6">&nbsp;-->
                            </div>
                        </div>
                        <div class="size18">&nbsp;</div>

                        <div class="row fc-g999">
                            <div class="col-md-4 col-xs-12">
                                <?= Select2::widget([
                                    'name' => 'province',
                                    'value' => '',
                                    'data' => ['Bangkok', 'Bangkok2', 'Bangkok3'],
                                    'options' => ['placeholder' => 'Select Province']
                                ]) ?>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?= Select2::widget([
                                    'name' => 'city',
                                    'value' => '',
                                    'data' => ['Bang Khen', 'Bang Khen2', 'Bang Khen3'],
                                    'options' => ['placeholder' => 'Select City']
                                ]) ?>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?= Select2::widget([
                                    'name' => 'locker',
                                    'value' => '',
                                    'data' => ['Bangchak1', 'Bangchak2', 'Bangchak3'],
                                    'options' => ['placeholder' => 'Select Locker']
                                ]) ?>
                            </div>
                        </div>

                        <div class="size18">&nbsp;</div>

                        <div class="row fc-g999">
                            <div class="col-xs-12">
                                <h4>Map</h4>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d124008.92046473033!2d100.48062576799724!3d13.762055508253102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x30e29ebe74b07b57%3A0x1892d37c43ed15a7!2z4LiV4Lil4Liy4LiU4Lio4Lij4Li14LiU4Li04LiZ4LmB4LiU4LiH!3m2!1d13.7620654!2d100.55066629999999!5e0!3m2!1sth!2sth!4v1494639156559" frameborder="0" style="width:100%;height:20vh;border:0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Billing -->
                    <div class="cart-detail">
                        <div class="row">
                            <div class="col-lg-12">
                                Billing Address
                                <a href="#" class="pull-right btn-g999 p-edit" data-toggle="modal" data-target=".bs-example-modal-lg">+
                                    New Billing Address</a></div>
                            <div class="col-xs-12 size6">
                            </div>
                        </div>

                        <div class="size18">&nbsp;</div>

                        <div class="row fc-g999">
                            <div class="col-lg-1 col-md-2 col-sm-3">Billing:</div>
                            <div class="col-lg-11 col-md-10 col-sm-9">
                                <?= Select2::widget([
                                    'name' => 'billing',
                                    'value' => '',
                                    'data' => ['Billing Address', 'Billing Address2', 'Billing Address3'],
                                    'options' => ['placeholder' => 'Select Billing Address']
                                ]) ?>
                            </div>

                            <div class="size14">&nbsp;</div>

                            <div class="col-lg-1 col-md-2 col-sm-3">Name:</div>
                            <div class="col-lg-11 col-md-10 col-sm-9">Inthanon Panyasopa</div>
                            <div class="size6">&nbsp;</div>
                            <div class="col-lg-1 col-md-2 col-sm-3">Address:</div>
                            <div class="col-lg-11 col-md-10 col-sm-9">123 Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit, sed do eiusmod tempor 50000
                            </div>
                            <div class="size12">&nbsp;</div>
                        </div>
                    </div>


                    <!-- E -->
                    <div class="col-xs-12 text-right">
                        <a href="<?= Url::to(['/cart']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">BACK</a>
                        &nbsp;
                        <a href="<?= Url::to(['/checkout/summary']) ?>" class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">CONTINUE
                            TO PAYMENT METHOD</a>
                    </div>
                    <div class="size12 size10-xs">&nbsp;</div>
                </div>
            </div>
        </div>

        <!-- Total -->
        <div class="col-lg-3 col-md-4">
            <?= $this->render('_checkout_total') ?>
        </div>

    </div>
</div>

<div class="size32">&nbsp;</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="gridSystemModalLabel">+ Add New Billing Address</h4>
            </div>
            <!-- Cart -->
            <div class="row">
                <!-- Details -->
                <div class="col-md-10 col-md-offset-1">
                    <div class="size24">&nbsp;</div>
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
<!--                        <div class="row">-->
<!--                            <div class="col-xs-12">-->
<!--                                <input type="checkbox" name="billhere" value="1"> &nbsp; Billing address is same-->
<!--                                as shipping address-->
<!--                            </div>-->
<!--                        </div>-->
                    </form>
                    <div class="size24">&nbsp;</div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px" data-dismiss="modal" aria-label="Close">CANCEL</a>
                &nbsp;
                <a href="#" class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">SAVE</a>
            </div>
        </div>
    </div>
</div>
