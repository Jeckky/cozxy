<?php

use frontend\assets\MyAccountAsset;

MyAccountAsset::register($this);
$this->title = 'My Top Up : History';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">My History</p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>
            <!--TABs-->
            <ul class="nav nav-pills size18 size14-xs b" role="tablist">
                <li role="presentation"><a href="<?= Yii::$app->homeUrl ?>my-account?act=account-detail" aria-controls="account-detail" role="tab">Account Detail</a></li>
                <li role="presentation"><a href="<?= Yii::$app->homeUrl ?>top-up" aria-controls="account-detail" role="tab" >Top Up Detail</a></li>
                <li role="presentation" class="active"><a href="#order-history" aria-controls="order-history" role="tab" data-toggle="tab">Payment History</a></li>
            </ul>
            <div class="size18 size14-xs">&nbsp;</div>
        </div>
        <div class="col-xs-12 bg-white myData">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in" id="account-detail">

                </div>
                <div role="tabpanel" class="tab-pane fade in active" id="order-history">
                    <?= $this->render('_history', compact('model', 'dataProvider', 'topUps', 'currentPoint')) ?>
                </div>

            </div>
        </div>

    </div>
</div>
<div class="size32">&nbsp;</div>
