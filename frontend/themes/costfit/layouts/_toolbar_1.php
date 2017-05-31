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
<div class="toolbar-container">
    <div class="container">
        <!--Toolbar-->
        <div class="toolbar group">
            <nav class="menu">
                <ul class="catalog hidden-xs hidden-sm " id="catalog_new" style="width: 100%;">
                    <li class="has-submenu  ">
                        <span class="sorting" id="sortingAccount" style="padding: 1px 1px 1px 1px;">
                            <a href="#" class="sorting" style="padding: 1px 1px 1px 5px;"><?= Yii::t('app', 'Account') ?></a></span>
                        <ul class="submenu" id="submenu-sorting-account" style="margin-top: -1px;">
                            <li><a href="<?php echo Yii::$app->homeUrl; ?>profile">My Profile</a></li>
                            <li><a href="<?php echo Yii::$app->homeUrl; ?>profile/order">Order History</a></li>
                            <li><a href="<?php echo Yii::$app->homeUrl; ?>profile/returning"><?= Yii::t('app', 'Product Returns') ?></a></li>
                            <li><a href="<?php echo Yii::$app->homeUrl; ?>reviews">My Stories</a></li>
                           <!--<li class="pill-right"><a href="<?php // echo Yii::$app->homeUrl;                                       ?>profile/payment">Payment Methods</a></li>
                           <li class="pull-right"><a href="<?php // echo Yii::$app->homeUrl;                                       ?>history">Easy Re-Order</a></li>-->
                        </ul>
                    </li>

                    <?php
                    //throw new \yii\base\Exception(print_r(Yii::$app->user->identity, true));
                    if (Yii::$app->user->isGuest):
                        ?>  <li>
                            <a class="login-btn btn-outlined-invert" href="#" data-toggle="modal" data-target="#loginModal"><i
                                    class="icon-profile"></i> <span><b>L</b>ogin</span></a>
                        </li>

                    <?php else: ?> <li>
                            <?= yii\helpers\Html::a("<i class='icon-lock-closed'></i> <span><b>L</b>ogout</span>", ["site/logout"], ['class' => 'login-btn btn-outlined-invert']) ?>
                            <a class="btn-outlined-invert" href="<?= Yii::$app->homeUrl ?>wishlist"><i class="icon-heart"></i>
                                <span><b>W</b>ishlist</span></a>
                        </li>

                    <?php endif; ?>
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