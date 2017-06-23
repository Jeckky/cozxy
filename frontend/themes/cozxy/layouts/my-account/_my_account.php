<?php

use frontend\assets\MyAccountAsset;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

MyAccountAsset::register($this);
$this->title = 'MY ACCOUNT';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">MY ACCOUNT</p>
        </div>

        <!-- detail-->
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>
            <!--TABs-->
            <ul class="nav nav-pills size18 size14-xs b" role="tablist">
                <li role="presentation" <?= isset($_GET['act']) ? '' : 'class="active"'; ?>><a href="#account-detail" aria-controls="account-detail" role="tab" data-toggle="tab">Account Detail</a></li>
                <li role="presentation"><a href="#order-history" aria-controls="order-history" role="tab" data-toggle="tab">Order History</a></li>
                <li role="presentation" <?= isset($_GET['act']) ? 'class="active"' : ''; ?>><a href="#wish-list" aria-controls="wish-list" role="tab" data-toggle="tab">Wish List</a></li>
                <li role="presentation"><a href="#tracking" aria-controls="tracking" role="tab" data-toggle="tab">Tracking</a></li>
                <li role="presentation"><a href="#stories" aria-controls="stories" role="tab" data-toggle="tab">My Stories</a></li>
            </ul>
            <div class="size18 size14-xs">&nbsp;</div>
        </div>
        <div class="col-xs-12 bg-white myData">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in <?= isset($_GET['act']) ? '' : 'active'; ?>" id="account-detail">
                    <?= $this->render('_account_detail', compact('billingAddress', 'personalDetails', 'cozxyCoin')) ?>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="order-history">
                    <?= $this->render('_order_history', compact('orderHistory')) ?>
                </div>
                <div role="tabpanel" class="tab-pane fade in <?= isset($_GET['act']) ? 'active' : ''; ?>" id="wish-list">
                    <?= $this->render('_wish_list', compact('wishList')) ?>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="tracking">
                    <?= $this->render('_tracking', compact('trackingOrder')) ?>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="stories">
                    <?= $this->render('_stories', compact('productPost')) ?>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="size32">&nbsp;</div>
<!--modal edit story-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="gridSystemModalLabel">+ Edit My Stories : test</h4>
            </div>
            <!-- Cart -->
            <div class="row">

                <?php
                $form = ActiveForm::begin([
                    'id' => 'default-add-new-billing-address',
                    'options' => ['class' => 'login-box'],
                ]);
                ?>
                <!-- Details -->
                <div class="col-md-10 col-md-offset-1">
                    <div class="size24">&nbsp;</div>


                    <div class="form-group">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputTitle">Title</label>
                                    <input type="text" id="productpost-title" class="fullwidth" name="ProductPost[title]" placeholder="Title">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputDescription">Description </label>
                                    <textarea id="productpost-description" class="form-control" name="ProductPost[description]" dir="ltr"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="size24">&nbsp;</div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px" data-dismiss="modal" aria-label="Close">CANCEL</a>
                &nbsp;
                <a href="javascript:EditMyStories()" class="b btn-yellow" id="acheckoutNewBillingz" data-loading-text="<i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i> Processing New Billing" style="padding:12px 32px; margin:24px auto 12px">SAVE</a>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>