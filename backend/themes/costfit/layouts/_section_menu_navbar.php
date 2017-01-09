<?php

use yii\web\View;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
if (!isset(Yii::$app->user->identity->type)) {
    header("location: /auth");
    exit(0);
}
?>
<!-- 2. $MAIN_NAVIGATION ======= Main navigation ========= -->
<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
    <!-- Main menu toggle -->
    <button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>

    <div class="navbar-inner">
        <!-- Main navbar header -->
        <div class="navbar-header">
            <!-- Logo -->
            <a href="<?php echo $baseUrl; ?>/dashboard" class="navbar-brand">
                <div><img alt="Pixel Admin" src="<?php echo $directoryAsset; ?>/images/pixel-admin/main-navbar-logo.png"></div>
                <?php
                if (Yii::$app->user->identity->type == 4) {
                    echo 'Suppliers Admin';
                } else {
                    echo 'Cozxy.com Admin';
                }
                ?>
            </a>

            <!-- Main navbar toggle -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>

        </div> <!-- / .navbar-header -->

        <div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
            <div>
                <div class="right clearfix">
                    <ul class="nav navbar-nav pull-right right-navbar-nav">
                        <li class="nav-icon-btn nav-icon-btn-danger dropdown">
                            <a href="#notifications" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="label">
                                    <?php
                                    if (isset($this->params['listDataProviderNotificationsSuppliersCount']['menuNotificationsSuppliersCount'])) {
                                        echo $this->params['listDataProviderNotificationsSuppliersCount']['menuNotificationsSuppliersCount'];
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </span>
                                <i class="nav-icon fa fa-bullhorn"></i>
                                <span class="small-screen-text">Notifications</span>
                            </a>

                            <!-- NOTIFICATIONS -->
                            <!-- Javascript -->
                            <script>
                                init.push(function () {
                                    $('#main-navbar-notifications').slimScroll({height: 250});
                                });
                            </script>
                            <!-- / Javascript -->

                            <div class="dropdown-menu widget-notifications no-padding" style="width: 300px">
                                <div class="notifications-list" id="main-navbar-notifications">

                                    <div class="notification">
                                        <div class="notification-title text-danger">SYSTEM COZXY</div>
                                        <?php
                                        if (isset($this->params['listDataProviderNotificationsSuppliers']['menuNotificationsSuppliers'])) {
                                            $menuNotificationsSuppliers = $this->params['listDataProviderNotificationsSuppliers']['menuNotificationsSuppliers'];
                                            foreach ($menuNotificationsSuppliers as $key => $value) {
                                                ?>
                                                <div class="notification-description"><strong>หัวข้ออนุมัติสินค้า</strong>: <?php echo $value->title; ?> (<strong class="notification-systme">ดู</strong>)</div>
                                                <div class="notification-ago"><?php echo common\helpers\CozxyUnity::TimeElapsedString($value->createDateTime); ?></div>
                                                <!--<div class="notification-icon fa fa-hdd-o bg-danger"></div>-->
                                                <?php
                                            }
                                        }
                                        ?>

                                    </div> <!-- / .notification -->

                                </div> <!-- / .notifications-list -->
                                <a href="<?php echo $baseUrl; ?>/notification" class="notifications-link">MORE NOTIFICATIONS</a>
                            </div> <!-- / .dropdown-menu -->
                        </li>
                        <li class="nav-icon-btn nav-icon-btn-success dropdown">
                            <a href="#messages" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="label">1</span>
                                <i class="nav-icon fa fa-envelope"></i>
                                <span class="small-screen-text">Income messages</span>
                            </a>

                            <!-- MESSAGES -->

                            <!-- Javascript -->
                            <script>
                                init.push(function () {
                                    $('#main-navbar-messages').slimScroll({height: 250});
                                });
                            </script>
                            <!-- / Javascript -->

                            <div class="dropdown-menu widget-messages-alt no-padding" style="width: 300px;">
                                <div class="messages-list" id="main-navbar-messages">

                                    <div class="message">
                                        <img src="<?= $directoryAsset; ?>/demo/avatars/2.jpg" alt="" class="message-avatar">
                                        <a href="#" class="message-subject">ยินดีต้อนรับสู่ Cozxy.com</a>
                                        <div class="message-description">
                                            from <a href="#">Cozxy dotcom</a>
                                            &nbsp;&nbsp;·&nbsp;&nbsp;
                                            2h ago
                                        </div>
                                    </div> <!-- / .message -->

                                </div> <!-- / .messages-list -->
                                <a href="<?php echo $baseUrl; ?>/notification/inbox" class="messages-link">MORE MESSAGES</a>
                            </div> <!-- / .dropdown-menu -->
                        </li>
                        <!-- /3. $END_NAVBAR_ICON_BUTTONS -->

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
                                <?php
                                if (isset(Yii::$app->user->identity->passportImage)) {
                                    echo '<img src="' . Yii::$app->user->identity->passportImage . '" alt="female">';
                                } else {
                                    if (Yii::$app->user->identity->gender == 0) {
                                        echo '<img src="' . $directoryAsset . '"/demo/avatars/female.jpg" alt="female">';
                                    } else if (Yii::$app->user->identity->gender == 1) {
                                        echo '<img src="' . $directoryAsset . '"/demo/avatars/silhouette.jpg" alt="man">';
                                    }
                                }
                                ?>
                                <span> <?= isset(Yii::$app->user->identity->email) ? Yii::$app->user->identity->firstname : 'Guest' ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $baseUrl ?>/profile"><span class="label label-warning pull-right">New</span>Profile</a></li>
                                <li><a href="<?php echo $baseUrl ?>/management/account"><span class="badge badge-primary pull-right">New</span>Account</a></li>
                                <?php if (Yii::$app->user->identity->type != 4) { ?>
                                    <li><a href="<?php echo $baseUrl ?>/management/settings"><i class="dropdown-icon fa fa-cog"></i>&nbsp;&nbsp;Settings</a></li>
                                <?php } ?>
                                <li class="divider"></li>
                                <?php if (isset(Yii::$app->user->identity->email)) { ?>
                                    <li><a href="<?php echo $baseUrl ?>/auth/auth/logout"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
                                <?php } else { ?>
                                    <li><a href="<?php echo $baseUrl ?>/auth"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;Log in</a></li>
                                    <?php }
                                    ?>
                            </ul>
                        </li>
                    </ul> <!-- / .navbar-nav -->
                </div> <!-- / .right -->
            </div>
        </div> <!-- / #main-navbar-collapse -->
    </div> <!-- / .navbar-inner -->
</div> <!-- / #main-navbar -->
<!-- /2. $END_MAIN_NAVIGATION -->