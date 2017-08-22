<?php

use frontend\assets\MyAccountAsset;

MyAccountAsset::register($this);
$this->title = 'My Top Up';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs" style="float: left;margin-right: 20px;">TOP UP</p>
            <p class="size14 size14-xs" style="margin-top: 8px;">
                <a href="" data-toggle="modal" data-target="#topupModal">  What's this? </a>
            </p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>
            <!--TABs-->
            <ul class="nav nav-pills size18 size14-xs b" role="tablist">
                <li role="presentation"><a href="<?= Yii::$app->homeUrl ?>my-account?act=account-detail" aria-controls="account-detail" role="tab">Account Detail</a></li>
                <li role="presentation" class="active"><a href="#account-detail" aria-controls="account-detail" role="tab" data-toggle="tab">Top Up Detail</a></li>
                <li role="presentation"><a href="<?= Yii::$app->homeUrl ?>top-up/history" aria-controls="order-history" role="tab" >Payment History</a></li>
            </ul>
            <div class="size18 size14-xs">&nbsp;</div>
        </div>
        <div class="col-xs-12 bg-white myData">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="account-detail">
                    <?= $this->render('_top_up_form', compact('data', 'paymentMethod', 'ms', 'needMore')) ?>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="order-history">

                </div>
                <div role="tabpanel" class="tab-pane fade in" id="wish-list">
                    <?php //= $this->render('_wish_list', compact('wishList')) ?>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="tracking">
                    <?php //= $this->render('_tracking') ?>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="size32">&nbsp;</div>
<div class="modal fade" id="topupModal" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeWishlistModal"><i class="fa fa-times"></i>
                </button>
                <h3>TOP UP</h3>
            </div>
            <div class="modal-body" style="padding: 40px;">
                <?= common\helpers\Faq::Faqs('Top Up') ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>