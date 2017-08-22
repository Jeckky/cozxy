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
                <li role="presentation" <?php
                if ($_GET['act'] == 'account-detail') {
                    echo 'class="active" ';
                }
                ?>>
                    <a href="#account-detail" aria-controls="account-detail" role="tab" data-toggle="tab">ACCOUNT DETAIL</a>
                </li>
                <li role="presentation" <?php
                if ($_GET['act'] == 'order-history') {
                    echo 'class="active" ';
                }
                ?>>
                    <a href="#order-history" aria-controls="order-history" role="tab" data-toggle="tab">ORDER HISTORY</a>
                </li>
                <?php
                if (isset($returnList) && count($returnList) > 0) {
                    ?>
                    <li role="presentation">
                        <a href="#return-list" aria-controls="return-list" role="tab" data-toggle="tab">RETURN LIST</a>
                    </li>
                <?php } ?>
                <li role="presentation" <?php
                if ($_GET['act'] == 'my-shelves') {
                    echo 'class="active" ';
                }
                ?>>
                    <a href="#my-shelves" aria-controls="my-shelves" role="tab" data-toggle="tab">
                        My SHELVES <button id="myShelvesPopover" type="button" class="" data-toggle="popover" title="My Shelves" data-content="Organize all your favorite items, dream gifts, and stories in customizable shelves so you can always come back and see them later!">?</button>
                    </a>
                </li>
                <!--<li role="presentation"><a href="#tracking" aria-controls="tracking" role="tab" data-toggle="tab">Tracking</a></li>-->
                <li role="presentation" <?php
                if ($_GET['act'] == 'stories') {
                    echo 'class="active" ';
                }
                ?>>
                    <a href="#stories" aria-controls="stories" role="tab" data-toggle="tab">MY STORIES</a>
                </li>
            </ul>
            <div class="size18 size14-xs">&nbsp;</div>
        </div>
        <div class="col-xs-12 bg-white myData">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in <?php
                if ($_GET['act'] == 'account-detail') {
                    echo 'active';
                }
                ?>" id="account-detail">
                     <?= $this->render('_account_detail', compact('billingAddress', 'personalDetails', 'cozxyCoin', 'user')) ?>
                </div>
                <div role="tabpanel" class="tab-pane fade in <?php
                if ($_GET['act'] == 'order-history') {
                    echo 'active';
                }
                ?>" id="order-history">
                     <?= $this->render('_order_history', compact('orderHistory')) ?>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="return-list">
                    <?= $this->render('_return_list', compact('returnList')) ?>
                </div>
                <div role="tabpanel" class="tab-pane fade in <?php
                if ($_GET['act'] == 'my-shelves') {
                    echo 'active';
                }
                ?>" id="my-shelves">
                     <?= $this->render('_wish_list', compact('favoriteStory')) ?>
                </div>
                <!--<div role="tabpanel" class="tab-pane fade in" id="tracking">
                    <?//= $this->render('_tracking', compact('trackingOrder')) ?>
                </div>-->
                <div role="tabpanel" class="tab-pane fade in <?php
                if ($_GET['act'] == 'stories') {
                    echo 'active';
                }
                ?>" id="stories">
                     <?= $this->render('_stories', compact('productPost')) ?>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="size32">&nbsp;</div>
<?php
$this->registerJs("
$(function () {
  $('#myShelvesPopover').popover()
})
"
, \yii\web\View::POS_END);
?>

