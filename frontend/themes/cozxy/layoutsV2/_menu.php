<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerCss("
    #notify-cart-top-menu{
        display: block;  margin: 0; font-size: 12px;  padding:4px;
        line-height: 1; font-weight: 400; position: absolute; top: -1px;
        right:5px;color: #000 !important;  background-color: #fee60a; border: 1px #000 solid;
    }
    #rcorners1 {
        /*border-radius: 10px;
        padding: 20px;
        width: 150px;
        height: 43px;
        margin-top: 10px;*/
        border-radius: 10px;
        /* padding: 20px; */
        width: 150px;
        height: 43px;
        margin-top: 11px;
        line-height: 43px;
        word-break: break-all;
        text-align: center;
        font-weight: 700;
        font-style: normal;
    }

    .w3-theme {
        color: #000 !important;
        background-color: #fee60a !important;
        background-color: #fee60a !important;
    }

    .menu {
        border-top: 1px solid #f5f3ef;
        font-family: 'PT Sans Narrow', sans-serif;
    }
    .dropdown:hover > .dropdown-menu {
        display: block;
        margin-top: 10px;
    }


    .menuWrapper {
        list-style-type: none;
        padding-left: 0;
        margin: 0 auto;
        font-size: 0;
        box-sizing: padding-box;
    }

    .dropdown {
        /* width: 130.9px; */
        display: inline-block;
         padding: 0px 15px 0px;
        /* padding: 40px 10px 35px; */
        /* border: 1px solid #f5f3ef; */
        font-size: 11px;
        text-align: center;
    }

    .dropdown-menu {
        padding: 0;
        margin-top: 10px;
    }
    .dropdown-menu > li > a {
        padding: 20px 20px;
    }
    .dropdown-submenu {
        position: relative;
    }
    .dropdown-submenu > .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: 8px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }
    .dropdown-menu li {
        border-bottom: 1px solid #f5f3ef;
    }
    .dropdown-menu li:last-child {
        border-bottom: none;
    }
    .dropdown-submenu > .dropdown-menu:before {
        content: '';
        position: absolute;
        bottom: 80%;
        left: -6px;
        border-bottom: 5px solid transparent;
        border-right: 5px solid rgba(255, 255, 255, 0.9);
        border-top: 5px solid transparent;
        border-right-color: #ffffff;
    }
    .dropdown-submenu > .dropdown-menu:after {
        content: '';
        position: absolute;
        bottom: 62%;
        left: -11px;
        width: 7%;
        height: 70px;
        background: transparent;
    }
    .dropdown-menu-title:after {
        content: '';
        position: absolute;
        bottom: -13%;
        left: -11px;
        width: 117%;
        height: 20px;
        background: transparent;
    }
    .dropdown-submenu:hover > .dropdown-menu {
        display: block;
    }
    .dropdown-submenu > a:after {
        display: block;
        content: '';
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }
    .dropdown-submenu:hover > a:after {
        border-left-color: #fff;
    }
    .dropdown-submenu.pull-left {
        float: none;
    }
    .dropdown-submenu.pull-left > .dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }
    .dropdown-menu > li > a:hover,
    .dropdown-menu > li > a:focus {
        color: inherit;
        text-decoration: none;
        background: transparent;
        padding-bottom: 15px;
        border-bottom: 5px solid #fee60a;
    }
    .dropdown-menu.multi-level:before {
        position: absolute;
        top: -7px;
        left: 9px;
        display: inline-block;
        border-right: 7px solid transparent;
        border-bottom: 7px solid #ccc;
        border-left: 7px solid transparent;
        border-bottom-color: rgba(0, 0, 0, 0.2);
        content: '';
    }
    .dropdown-menu.multi-level:after {
        position: absolute;
        top: -6px;
        left: 10px;
        display: inline-block;
        border-right: 6px solid transparent;
        border-bottom: 6px solid #ffffff;
        border-left: 6px solid transparent;
        content: '';
    }


    .dropdown-menu {
        padding: 0;
        margin-top: 10px;
    }


    .dropdown-menu>li>a {
        padding: 20px 20px;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 105%;
        margin-top: -6px;
        margin-left: 0px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }
    .dropdown-menu li {
        border-bottom: 1px solid #f5f3ef;
    }
    .dropdown-menu li:last-child {
        border-bottom: none;
    }


    .dropdown-submenu>.dropdown-menu:before {
        content: '';
        position: absolute;
        bottom: 80%;
        left: -6px;
        border-bottom: 5px solid transparent;
        border-right: 5px solid rgba(255,255,255,0.9);
        border-top: 5px solid transparent;
        border-right-color: rgba(255,255,255,1);
    }


    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .dropdown-submenu>a:after {
        display: block;
        content: '';
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }

    .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
    }

    .dropdown-submenu.pull-left {
        float: none;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }

    .dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
        color: inherit;
        text-decoration: none;
        padding-bottom: 0;
        background: transparent;
        padding-bottom: 15px;
        border-bottom: 5px solid #fee60a;
    }

    .dropdown-menu.multi-level:before {
        position: absolute;
        top: -7px;
        left: 9px;
        display: inline-block;
        border-right: 7px solid transparent;
        border-bottom: 7px solid #ccc;
        border-left: 7px solid transparent;
        border-bottom-color: rgba(0, 0, 0, 0.2);
        content: '';
    }

    .dropdown-menu.multi-level:after {
        position: absolute;
        top: -6px;
        left: 10px;
        display: inline-block;
        border-right: 6px solid transparent;
        border-bottom: 6px solid #ffffff;
        border-left: 6px solid transparent;
        content: '';
    }
");
$UserAgent = common\helpers\GetBrowser::UserAgent();
if (Yii::$app->controller->action->id != 'elastic-search') {
    //$urlSearch = Yii::$app->homeUrl . 'search/cozxy-product/';
    $urlSearch = Yii::$app->homeUrl . 'search/elastic-search/';
} else {
    $urlSearch = Yii::$app->homeUrl . 'search/elastic-search/';
}
?>
<style type="text/css">
    /**
     * Tooltip Styles
     */

    /* Base styles for the element that has a tooltip */
    [data-tooltip],
    .tooltip {
        position: relative;
        cursor: pointer;
        text-align: center;
        color: #000;
    }

    /* Base styles for the entire tooltip */
    [data-tooltip]:before,
    [data-tooltip]:after,
    .tooltip:before,
    .tooltip:after {
        position: absolute;
        visibility: hidden;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
        opacity: 0;
        -webkit-transition:
            opacity 0.2s ease-in-out,
            visibility 0.2s ease-in-out,
            -webkit-transform 0.2s cubic-bezier(0.71, 1.7, 0.77, 1.24);
        -moz-transition:
            opacity 0.2s ease-in-out,
            visibility 0.2s ease-in-out,
            -moz-transform 0.2s cubic-bezier(0.71, 1.7, 0.77, 1.24);
        transition:
            opacity 0.2s ease-in-out,
            visibility 0.2s ease-in-out,
            transform 0.2s cubic-bezier(0.71, 1.7, 0.77, 1.24);
        -webkit-transform: translate3d(0, 0, 0);
        -moz-transform:    translate3d(0, 0, 0);
        transform:         translate3d(0, 0, 0);
        pointer-events: none;
    }

    /* Show the entire tooltip on hover and focus */
    [data-tooltip]:hover:before,
    [data-tooltip]:hover:after,
    [data-tooltip]:focus:before,
    [data-tooltip]:focus:after,
    .tooltip:hover:before,
    .tooltip:hover:after,
    .tooltip:focus:before,
    .tooltip:focus:after {
        visibility: visible;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
        opacity: 1;
    }

    /* Base styles for the tooltip's directional arrow */
    .tooltip:before,
    [data-tooltip]:before {
        z-index: 1001;
        border: 6px solid transparent;
        background: transparent;
        content: "";
    }

    /* Base styles for the tooltip's content area */
    .tooltip:after,
    [data-tooltip]:after {
        z-index: 1000;
        padding: 8px;
        width: 160px;
        /*background-color: #000;
        background-color: hsla(0, 0%, 20%, 0.9);*/
        background-color: #f5f5f5;
        background-color:hsla(0.1,0.1,0.1,0.1);
        color: #000;
        content: attr(data-tooltip);
        font-size: 14px;
        line-height: 1.2;
        -webkit-border-radius: 6px 6px 6px 6px;
        -moz-border-radius: 6px 6px 6px;
        border-radius: 6px 6px 6px 6px;
    }

    /* Directions */

    /* Top (default) */
    [data-tooltip]:before,
    [data-tooltip]:after,
    .tooltip:before,
    .tooltip:after,
    .tooltip-top:before,
    .tooltip-top:after {
        bottom: 100%;
        left: 50%;
    }

    [data-tooltip]:before,
    .tooltip:before,
    .tooltip-top:before {
        margin-left: -6px;
        margin-bottom: -12px;
        border-top-color: #f5f5f5;
        /*border-top-color: hsla(0.1,0.1,0.1,0.1)*//*hsla(0, 0%, 20%, 0.9)*/;
    }

    /* Horizontally align top/bottom tooltips */
    [data-tooltip]:after,
    .tooltip:after,
    .tooltip-top:after {
        margin-left: -80px;
    }

    [data-tooltip]:hover:before,
    [data-tooltip]:hover:after,
    [data-tooltip]:focus:before,
    [data-tooltip]:focus:after,
    .tooltip:hover:before,
    .tooltip:hover:after,
    .tooltip:focus:before,
    .tooltip:focus:after,
    .tooltip-top:hover:before,
    .tooltip-top:hover:after,
    .tooltip-top:focus:before,
    .tooltip-top:focus:after {
        -webkit-transform: translateY(-12px);
        -moz-transform:    translateY(-12px);
        transform:         translateY(-12px);
    }

    /* Left */
    .tooltip-left:before,
    .tooltip-left:after {
        right: 100%;
        bottom: 50%;
        left: auto;
    }

    .tooltip-left:before {
        margin-left: 0;
        margin-right: -12px;
        margin-bottom: 0;
        border-top-color: transparent;
        border-left-color: #f5f5f5;
        border-left-color: hsla(0, 0%, 20%, 0.9);
    }

    .tooltip-left:hover:before,
    .tooltip-left:hover:after,
    .tooltip-left:focus:before,
    .tooltip-left:focus:after {
        -webkit-transform: translateX(-12px);
        -moz-transform:    translateX(-12px);
        transform:         translateX(-12px);
    }

    /* Bottom */
    .tooltip-bottom:before,
    .tooltip-bottom:after {
        top: 100%;
        bottom: auto;
        left: 50%;
    }

    .tooltip-bottom:before {
        margin-top: -12px;
        margin-bottom: 0;
        border-top-color: transparent;
        border-bottom-color: #f5f5f5;
        /*border-bottom-color: hsla(0, 0%, 20%, 0.9);*/
    }

    .tooltip-bottom:hover:before,
    .tooltip-bottom:hover:after,
    .tooltip-bottom:focus:before,
    .tooltip-bottom:focus:after {
        -webkit-transform: translateY(12px);
        -moz-transform:    translateY(12px);
        transform:         translateY(12px);
    }

    /* Right */
    .tooltip-right:before,
    .tooltip-right:after {
        bottom: 50%;
        left: 100%;
    }

    .tooltip-right:before {
        margin-bottom: 0;
        margin-left: -12px;
        border-top-color: transparent;
        border-right-color: #000;
        border-right-color: hsla(0, 0%, 20%, 0.9);
    }

    .tooltip-right:hover:before,
    .tooltip-right:hover:after,
    .tooltip-right:focus:before,
    .tooltip-right:focus:after {
        -webkit-transform: translateX(12px);
        -moz-transform:    translateX(12px);
        transform:         translateX(12px);
    }

    /* Move directional arrows down a bit for left/right tooltips */
    .tooltip-left:before,
    .tooltip-right:before {
        top: 3px;
    }

    /* Vertically center tooltip content for left/right tooltips */
    .tooltip-left:after,
    .tooltip-right:after {
        margin-left: 0;
        margin-bottom: -16px;
    }
</style>

<div class="bg-black headbar">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 <?= isset(Yii::$app->user->id) ? 'col-xs-4' : 'col-xs-12' ?>" style="<?= ($UserAgent == 'mobile') ? 'margin-top: 15px;' : 'text-align: -webkit-right;'; ?>"><a href="<?= Url::to(['/']) ?>"><?= Html::img(Url::home() . 'imgs/cozxy.png', ['class' => 'img-responsive']) ?></a></div>
            <div class="col-md-4 col-sm-6 <?= isset(Yii::$app->user->id) ? 'col-xs-8' : 'col-xs-12' ?> pull-right text-right " style="<?= ($UserAgent == 'mobile') ? 'padding-right: 0px; text-align: left;' : ''; ?>">
                <div class="row user-menu" style="margin-right: -1px;    margin-top: 0px;">
                    <?php
                    if (isset(Yii::$app->user->identity->userId)) {
                        //echo '<div class="col-xs-3">' . Html::a('&nbsp;', Yii::$app->homeUrl . 'my-account', ['class' => 'u-menu-1']) . '</div>';
                    } else {
                        echo '';
                    }
                    ?>
                    <div class="col-xs-3 col-md-1<?= isset(Yii::$app->user->id) ? 'col-xs-offset-1' : '' ?>" style="<?= ($UserAgent == 'mobile') ? '' : 'text-align: -webkit-right;'; ?>">
                        <a href="<?php echo Yii::$app->homeUrl; ?><?= isset(Yii::$app->user->id) ? 'my-account?act=my-shelves' : 'site/login' ?>" class="u-menu-2 tooltip-bottom" data-tooltip="MY SHELVES">&nbsp;</a>
                    </div>
                    <div class="col-xs-3 col-md-2" style="<?= ($UserAgent == 'mobile') ? '' : 'text-align: -webkit-right;right:-10px;'; ?>"><?= Html::a('&nbsp;', Yii::$app->homeUrl . 'cart', ['class' => 'u-menu-3 tooltip-bottom', 'data-tooltip' => 'CART']) ?>
                        <?php
                        if (Yii::$app->user->id != '') {
                            $Product = \common\models\costfit\Order::find()->where('userId =' . \Yii::$app->user->id . ' and status=0')->one();
                            if (count($Product) > 0) {
                                $orderItem = \common\models\costfit\OrderItem::find()->where('orderId=' . $Product['orderId'])->sum('quantity');
                                if (isset($orderItem)) {
                                    $quantity = (int) $orderItem;
                                } else {
                                    $quantity = '';
                                }
                            } else {
                                $quantity = '';
                            }
                        } else {
                            $order = \common\models\costfit\Order::getOrder();
                            if (isset($order->attributes['orderId'])) {

                                $orderId = $order->attributes['orderId'];
                                $Product = \common\models\costfit\Order::find()->where('orderId =' . $orderId . ' and status=0')->one();
                                if (count($Product) > 0) {
                                    $orderItem = \common\models\costfit\OrderItem::find()->where('orderId=' . $Product['orderId'])->sum('quantity');
                                    if (isset($orderItem)) {
                                        $quantity = (int) $orderItem;
                                    } else {
                                        $quantity = '';
                                    }
                                } else {
                                    $quantity = '';
                                }
                            } else {
                                $quantity = '';
                            }
                        }
                        if (Yii::$app->user->id != '') {
                            ?>
                            <span id="notify-cart-top-menu"><?php echo $quantity; ?></span>
                            <?php
                        } else {
                            ?>
                            <span id="<?php if (isset($order->attributes['orderId'])) { ?>notify-cart-top-menu<?php } else { ?>notify-cart-top-menu<?php } ?>"><?php echo $quantity; ?></span>
                        <?php } ?>
                    </div>
                    <?php
                    if (isset(Yii::$app->user->identity->userId)) {
                        ?>
                        <div class="col-xs-3 menuWrapper">
                            <div class="dropdown">
                                <a href="#" class="dropdown-menu-title u-menu-1"  id="dLabel" data-toggle="dropdown" data-target="#"></a>
                                <?php
                                //echo Html::a('&nbsp;', Yii::$app->homeUrl . 'site/logout', ['class' => 'u-menu-4']);
                                //echo Html::a('&nbsp;', Yii::$app->homeUrl . 'my-account', ['class' => 'u-menu-1 ']);
                                ?>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu" style="z-index: 99999; min-width: 153px;">
                                    <li><a href="<?= Yii::$app->homeUrl ?>my-account?act=account-detail">ACCOUNT DETAIL</a></li>
                                    <li><a href="<?= Yii::$app->homeUrl ?>my-account?act=order-history">ORDER HISTORY</a></li>
                                    <li><a href="<?= Yii::$app->homeUrl ?>my-account?act=my-shelves">MY SHELVES</a></li>
                                    <li><a href="<?= Yii::$app->homeUrl ?>my-account?act=stories">MY STORIES</a></li>
                                    <li><a href="<?= Yii::$app->homeUrl ?>site/logout">LOGOUT</a></li>
                                    <li class="dropdown-submenu">
                                        <!-- <a data-toggle="dropdown" tabindex="-1" href="#">Hover me for more options</a>
                                         <ul class="dropdown-menu">
                                             <li><a tabindex="-1" href="<?= Yii::$app->homeUrl ?>my-account">ACCOUNT DETAIL</a></li>
                                             <li><a href="#">ORDER HISTORY</a></li>
                                             <li><a href="#">MY SHELVES</a></li>
                                             <li><a href="#">MY STORIES</a></li>
                                             <li><a href="<?= Yii::$app->homeUrl ?>site/logout">LOGOUT</a></li>
                                         </ul>-->
                                    </li>
                                </ul>
                            </div>

                        </div>
                    <?php } else { ?>
                        <div class="col-xs-6">
                            <a href = "<?= Yii::$app->homeUrl ?>site/login">
                                <p id = "rcorners1" class = "w3-theme">LOGIN / REGISTER</p>
                            </a>
                        </div>
                        <?php
                    }
                    if (isset($_GET["search"]) && !empty($_GET['search'])) {
                        $search = $_GET["search"];
                    } else {
                        $search = '';
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="rela" style="height: 64px;">
                    <?php $form = ActiveForm::begin(['id' => 'register-form', 'method' => "get", 'action' => $urlSearch, 'options' => ['class' => 'registr-form']]); ?>
                    <div class="align-center align-middle fullwidth">
                        <input type="text" name="search" id="search" class="search-input" placeholder="SEARCH PRODUCT" value="<?= isset($_GET["search"]) ? $_GET["search"] : NULL ?>">
                    </div>
                    <div class="align-middle text-right" style="width:120px; right:0;">
                        <input type="submit" value="SEARCH" class="search-btn bg-yellow3">
                    </div>
                    <div class="align-middle text-right size24" style="width:32px; padding-top: 8px;">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </div>
                    <?= $this->registerJS("
//                                $('#search').blur(function(event){
//                                    if(event.which == 13 || event.keyCode == 13)
//                                    {
//                                       $('#register-form').submit();
//                                    }
//                                });
                    ") ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (Yii::$app->controller->id != 'brands') {
    ?>
    <?= $this->render('_categories') ?>
<?php } ?>
<?php
$this->registerJs("

", \yii\web\View::POS_END);
?>
