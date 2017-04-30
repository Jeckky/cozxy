<?php

// echo Yii::$app->homeUrl . Yii::$app->controller->id;
//echo 'Test =' . Yii::$app->homeUrl;
//echo '<br>' . Yii::$app->controller->id;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\controllers\MasterController;
use common\models\ModelMaster;
?>
<style type="text/css">
    .menu {
        background: none;
    }
    .menu .catalog li a {
        color: #000;
    }
    .menu .catalog li:hover a {
        transition: none;
        color: rgba(255,212,36,.9);
    }
    .menu .catalog li a {
        padding: 5px 0px 9px 0px;
        color: #fff;
        background: none;
        text-transform: none;
        font-size: 1.2em;
    }
</style>
<div class="toolbar-container">
    <div class="container">
        <!--Toolbar-->
        <div class="toolbar group">
            <nav class="menu">
                <ul class="catalog hidden-xs hidden-sm " id="catalog_newxx">
                    <li class="has-submenu ">
                        <span class="sorting" id="sortingAccount">
                            <a href="#" class="sorting"><?= Yii::t('app', 'Account') ?></a></span>
                        <ul class="submenu" id="submenu-sorting-account" style="margin-top: -1px;">
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
                                    <a href="<?= Yii::$app->homeUrl ?>site/logout" data-toggle="modal" data-target="#loginModal">Logout</a>
                                    <?php
                                }
                                ?>
                            </li>
                           <!--<li class="pill-right"><a href="<?php // echo Yii::$app->homeUrl;                                    ?>profile/payment">Payment Methods</a></li>
                           <li class="pull-right"><a href="<?php // echo Yii::$app->homeUrl;                                      ?>history">Easy Re-Order</a></li>-->
                        </ul>
                    </li>

                    <?php
                    //throw new \yii\base\Exception(print_r(Yii::$app->user->identity, true));
                    if (Yii::$app->user->isGuest) {
                        ?>
                        <li>
                            <a class="login-btn btn-outlined-invert" href="#" data-toggle="modal" data-target="#loginModal"><i class="icon-profile"></i> <span><b>Login</span></a>
                        </li>
                    <?php } ?>
                    <li>
                        <a class="btn-outlined-invert" href="<?= Yii::$app->homeUrl ?>wishlist"><i class="icon-heart"></i> Wishlist</a>
                    </li>
                    <li> <?= $this->render('_cart') ?> </li>
                    <li>
                        <button class="search-btn btn-outlined-invert"><i class="icon-magnifier"></i></button>
                    </li>
                </ul>
            </nav>




        </div><!--Toolbar Close-->

    </div><!--
    <div class="language-bar">
    <?php
    //echo Html::a(Html::img(Yii::$app->homeUrl . '/images/flags/flag_th.jpg'), Url::current(['language' => 'th-TH']), ['class' => (Yii::$app->request->cookies['language'] == 'th-TH' ? 'active' : '')]);
    // echo Html::a(Html::img(Yii::$app->homeUrl . '/images/flags/flag_en.jpg'), Url::current(['language' => 'en-US']), ['class' => (Yii::$app->request->cookies['language'] == 'en-US' ? 'active' : '')]);
    ?>
    </div>-->
</div>