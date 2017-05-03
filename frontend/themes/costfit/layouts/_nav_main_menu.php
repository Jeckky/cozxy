<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style type="text/css">
    .menu .main li a {
        color: rgba(255,212,36,.9) !important;
    }
    .menu .main li:hover > a {
        color: rgba(255,212,36,.9) !important;
    }


    .menu .catalog li .submenu {
        margin-top: 3px;
    }
    .menu .catalog li.has-submenu {
        padding: 5px;
    }
    .menu .catalog li a {
        padding: 5px 0px 9px 0px;
        color: rgba(255,212,36,.9);
        background: none;
        text-transform: none;
        font-size: 1.2em;
    }
    .menu .catalog li.has-submenu:hover .submenu {
        margin-left: -5px;
    }
    .menu .main .submenu li:hover a {
        color: rgba(255,212,36,.9) !important;
        background: #000000 ;
    }
    .menu .main .submenu li {
        border-top-color: #ffffff;
        background-color: #2b2727;
    }
    .menu .main .submenu {
        border-color: #2b2727;
        margin-top: 6px;
    }
    .menu .main, .menu .catalog {
        display: block;
        list-style: none;
        text-align: right;
        width: 100%;
        max-width: 848px;
        margin-bottom: 0;
    }
</style>

<ul class="main hidden-xs hidden-sm">
    <li class="has-submenu">
        <?php if (!Yii::$app->user->isGuest) { ?>
            <span class="sorting" id="sortingAccount">
                <a href="#" class="sorting" style="color: #000 !important;"><span>A</span>ccount<i class="fa fa-chevron-down"></i></a></span>
                <!--<a href="#"><span>A</span>count<i class="fa fa-chevron-down"></i></a>
                Class "has-submenu" for proper highlighting and dropdown-->
            <ul class="submenu" id="submenu-sorting-account">
                <li><a href="<?php echo Yii::$app->homeUrl; ?>profile">My Profile</a></li>
                <li><a href="<?php echo Yii::$app->homeUrl; ?>profile/order">Order History</a></li>
                <li><a href="<?php echo Yii::$app->homeUrl; ?>profile/returning"><?= Yii::t('app', 'Product Returns') ?></a></li>
                <li><a href="<?php echo Yii::$app->homeUrl; ?>reviews">My Stories</a></li>
                <li>
                    <?php
                    if (Yii::$app->user->isGuest) {
                        ?>
                        <a href="#" data-toggle="modal" data-target="#loginModal">Login</a>
                        <?php
                    } else {
                        ?>
                        <a href="<?= Yii::$app->homeUrl ?>site/logout">Logout</a>
                        <?php
                    }
                    ?>
                </li>
            </ul>
        <?php } else { ?>
            <a href="#">&nbsp;</a>
            <!--Class "has-submenu" for proper highlighting and dropdown-->
            <ul class="submenu">
                <li>&nbsp;</li>
            </ul>
        <?php } ?>
    </li>
</ul>
