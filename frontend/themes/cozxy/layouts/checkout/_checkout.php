<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

$this->title = 'New Billing Address';
$this->params['breadcrumbs'][] = $this->title;
\frontend\assets\CheckoutAsset::register($this);
$pickingId = rand(0, 9999);
?>

<style>
    /* Always set the map height explicitly to define the size of the div
   * element that contains the map. */

    #map {
        height: 50%;
    }
    /* Optional: Makes the sample page fill the window. */


</style>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <?php
        $form = ActiveForm::begin([
            'id' => 'default-shipping-address',
            'action' => Yii::$app->homeUrl . 'checkout/summary',
            'options' => ['class' => 'space-bottom'],
        ]);
        ?>
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
                                <!--   <a href="chk-edit1.php" class="pull-right btn-g999 p-edit">Edit</a></div><div class="col-xs-12 size6">&nbsp;-->
                            </div>
                        </div>
                        <div class="size18">&nbsp;</div>

                        <div class="row fc-g999">
                            <div class="col-md-4 col-xs-12">
                                <?php
                                echo $form->field($model, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                                    'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->asArray()->all(), 'stateId', 'localName'),
                                    'pluginOptions' => [
                                        'placeholder' => 'Select...',
                                        'loadingText' => 'Loading States ...',
                                    ],
                                    'options' => ['placeholder' => 'Select States ...', 'name' => 'provinceId'],
                                ])->label(FALSE);
                                ?>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?php
                                echo Html::hiddenInput('input-type-11', $model->amphurId, ['id' => 'input-type-11']);
                                echo Html::hiddenInput('input-type-22', $model->amphurId, ['id' => 'input-type-22']);
                                echo Html::hiddenInput('input-type-33', 'add', ['id' => 'input-type-33']);
                                echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
                                    //'data' => [9 => 'Savings'],
                                    'options' => ['placeholder' => 'Select ...', 'name' => 'amphurId'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        //initialize' => true,
                                        'depends' => ['address-provinceid'],
                                        'url' => Url::to(['child-amphur-address-picking-point']),
                                        'loadingText' => 'Loading amphur ...',
                                        'params' => ['input-type-11', 'input-type-22', 'input-type-33']
                                    ]
                                ])->label(FALSE);
                                ?>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?php
                                echo Html::hiddenInput('input-type-13', $pickingPointLockersCool->provinceId, ['id' => 'input-type-13']);
                                echo Html::hiddenInput('input-type-23', $pickingPointLockersCool->amphurId, ['id' => 'input-type-23']);
                                echo Html::hiddenInput('lockers-cool-input-type-33', '1', ['id' => 'lockers-cool-input-type-33']);
                                echo $form->field($pickingPointLockersCool, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                                    'model' => $pickingId,
                                    'attribute' => 'pickingId',
                                    'options' => ['placeholder' => 'Select ...', 'id' => 'LcpickingId', 'name' => 'LcpickingId'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        //initialize' => true,
                                        'depends' => ['address-amphurid'],
                                        'url' => Url::to(['child-picking-point']),
                                        'loadingText' => 'Loading picking point ...',
                                        'params' => ['input-type-13', 'input-type-23', 'lockers-cool-input-type-33']
                                    ]
                                ])->label(FALSE);
                                ?>
                            </div>
                        </div>

                        <div class="size18">&nbsp;</div>

                        <div class="row fc-g999">
                            <div class="col-xs-12">
                                <h4>Map</h4>
                                <div id="map"></div>

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

                        <div class="row fc-g999 address-checkouts">
                            <div class="col-lg-1 col-md-2 col-sm-3">Billing:</div>
                            <div class="col-lg-11 col-md-10 col-sm-9">
                                <?php
                                echo $form->field($model, 'addressId')->widget(kartik\select2\Select2::classname(), [
                                    'data' => yii\helpers\ArrayHelper::map(common\models\costfit\Address::find()
                                    ->asArray()->where('userId=' . Yii::$app->user->identity->userId)->all(), 'addressId', function($model, $defaultValue, $index = 0) {
                                        $index = $index++;
                                        return 'Billing Address :' . $model['firstname'] . ' ' . $model['lastname'];
                                    }),
                                    'pluginOptions' => [
                                        'placeholder' => 'Select...',
                                        'loadingText' => 'Loading Billing Address ...',
                                    ],
                                    'options' => ['placeholder' => 'Select Billing Address ...', 'id' => 'addressId', 'name' => 'addressId'],
                                ])->label(FALSE);
                                ?>
                            </div>

                            <div class="size14">&nbsp;</div>

                            <div class="col-lg-1 col-md-2 col-sm-3 ">Name:</div>
                            <div class="col-lg-11 col-md-10 col-sm-9 name-show">none</div>
                            <div class="size6">&nbsp;</div>
                            <div class="col-lg-1 col-md-2 col-sm-3">Address:</div>
                            <div class="col-lg-11 col-md-10 col-sm-9 address-show"> none </div>
                            <div class="size12">&nbsp;</div>
                        </div>
                    </div>

                    <!-- E -->
                    <div class="col-xs-12 text-right">
                        <a href="<?= Url::to(['/cart']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">BACK</a>
                        &nbsp;
                        <input type="submit" value="CONTINUE TO PAYMENT METHOD" class="b btn-yellow">
                    </div>
                    <div class="size12 size10-xs">&nbsp;</div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
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
                                    <?=
                                    Select2::widget([
                                        'name' => 'province',
                                        'value' => '',
                                        'data' => ['Bangkok', 'Bangkok2', 'Bangkok3'],
                                        'options' => ['placeholder' => 'Select Province']
                                    ])
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">City</label>
                                    <?=
                                    Select2::widget([
                                        'name' => 'city',
                                        'value' => '',
                                        'data' => ['Bang Khen', 'Bang Khen2', 'Bang Khen3'],
                                        'options' => ['placeholder' => 'Select City']
                                    ])
                                    ?>
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




