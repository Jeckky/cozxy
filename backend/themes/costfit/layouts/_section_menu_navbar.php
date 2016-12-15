<?php
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
                    ?>
                    Suppliers Admin
                <?php } else { ?> Cozxy.com Admin
                <?php } ?>
            </a>

            <!-- Main navbar toggle -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>

        </div> <!-- / .navbar-header -->

        <div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
            <div>
                <!-- <ul class="nav navbar-nav">
                     <li>
                         <a href="#">Home</a>
                     </li>
                     <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                         <ul class="dropdown-menu">
                             <li><a href="#">First item</a></li>
                             <li><a href="#">Second item</a></li>
                             <li class="divider"></li>
                             <li><a href="#">Third item</a></li>
                         </ul>
                     </li>
                 </ul>--> <!-- / .navbar-nav -->

                <div class="right clearfix">
                    <ul class="nav navbar-nav pull-right right-navbar-nav">
                        <!-- 3. $NAVBAR_ICON_BUTTONS =======================================================================
                            Navbar Icon Buttons
                            NOTE: .nav-icon-btn triggers a dropdown menu on desktop screens only. On small screens .nav-icon-btn acts like a hyperlink.

                            Classes:
                            * 'nav-icon-btn-info'
                            * 'nav-icon-btn-success'
                            * 'nav-icon-btn-warning'
                            * 'nav-icon-btn-danger'
                        -->
                        <li class="nav-icon-btn nav-icon-btn-danger dropdown">
                            <a href="#notifications" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="label">5</span>
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
                                        <div class="notification-title text-danger">SYSTEM</div>
                                        <div class="notification-description"><strong>Error 500</strong>: Syntax error in index.php at line <strong>461</strong>.</div>
                                        <div class="notification-ago">12h ago</div>
                                        <div class="notification-icon fa fa-hdd-o bg-danger"></div>
                                    </div> <!-- / .notification -->

                                    <div class="notification">
                                        <div class="notification-title text-info">STORE</div>
                                        <div class="notification-description">You have <strong>9</strong> new orders.</div>
                                        <div class="notification-ago">12h ago</div>
                                        <div class="notification-icon fa fa-truck bg-info"></div>
                                    </div> <!-- / .notification -->

                                    <div class="notification">
                                        <div class="notification-title text-default">CRON DAEMON</div>
                                        <div class="notification-description">Job <strong>"Clean DB"</strong> has been completed.</div>
                                        <div class="notification-ago">12h ago</div>
                                        <div class="notification-icon fa fa-clock-o bg-default"></div>
                                    </div> <!-- / .notification -->

                                    <div class="notification">
                                        <div class="notification-title text-success">SYSTEM</div>
                                        <div class="notification-description">Server <strong>up</strong>.</div>
                                        <div class="notification-ago">12h ago</div>
                                        <div class="notification-icon fa fa-hdd-o bg-success"></div>
                                    </div> <!-- / .notification -->

                                    <div class="notification">
                                        <div class="notification-title text-warning">SYSTEM</div>
                                        <div class="notification-description"><strong>Warning</strong>: Processor load <strong>92%</strong>.</div>
                                        <div class="notification-ago">12h ago</div>
                                        <div class="notification-icon fa fa-hdd-o bg-warning"></div>
                                    </div> <!-- / .notification -->

                                </div> <!-- / .notifications-list -->
                                <a href="<?php echo $baseUrl; ?>/notification" class="notifications-link">MORE NOTIFICATIONS</a>
                            </div> <!-- / .dropdown-menu -->
                        </li>
                        <li class="nav-icon-btn nav-icon-btn-success dropdown">
                            <a href="#messages" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="label">10</span>
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
                                        <a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
                                        <div class="message-description">
                                            from <a href="#">Robert Jang</a>
                                            &nbsp;&nbsp;·&nbsp;&nbsp;
                                            2h ago
                                        </div>
                                    </div> <!-- / .message -->

                                    <div class="message">
                                        <img src="<?= $directoryAsset; ?>/demo/avatars/3.jpg" alt="" class="message-avatar">
                                        <a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                                        <div class="message-description">
                                            from <a href="#">Michelle Bortz</a>
                                            &nbsp;&nbsp;·&nbsp;&nbsp;
                                            2h ago
                                        </div>
                                    </div> <!-- / .message -->

                                    <div class="message">
                                        <img src="<?= $directoryAsset; ?>/demo/avatars/4.jpg" alt="" class="message-avatar">
                                        <a href="#" class="message-subject">Lorem ipsum dolor sit amet.</a>
                                        <div class="message-description">
                                            from <a href="#">Timothy Owens</a>
                                            &nbsp;&nbsp;·&nbsp;&nbsp;
                                            2h ago
                                        </div>
                                    </div> <!-- / .message -->

                                    <div class="message">
                                        <img src="<?= $directoryAsset; ?>/demo/avatars/5.jpg" alt="" class="message-avatar">
                                        <a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                                        <div class="message-description">
                                            from <a href="#">Denise Steiner</a>
                                            &nbsp;&nbsp;·&nbsp;&nbsp;
                                            2h ago
                                        </div>
                                    </div> <!-- / .message -->

                                    <div class="message">
                                        <img src="<?= $directoryAsset; ?>/demo/avatars/2.jpg" alt="" class="message-avatar">
                                        <a href="#" class="message-subject">Lorem ipsum dolor sit amet.</a>
                                        <div class="message-description">
                                            from <a href="#">Robert Jang</a>
                                            &nbsp;&nbsp;·&nbsp;&nbsp;
                                            2h ago
                                        </div>
                                    </div> <!-- / .message -->

                                    <div class="message">
                                        <img src="<?= $directoryAsset; ?>/demo/avatars/2.jpg" alt="" class="message-avatar">
                                        <a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
                                        <div class="message-description">
                                            from <a href="#">Robert Jang</a>
                                            &nbsp;&nbsp;·&nbsp;&nbsp;
                                            2h ago
                                        </div>
                                    </div> <!-- / .message -->

                                    <div class="message">
                                        <img src="<?= $directoryAsset; ?>/demo/avatars/3.jpg" alt="" class="message-avatar">
                                        <a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                                        <div class="message-description">
                                            from <a href="#">Michelle Bortz</a>
                                            &nbsp;&nbsp;·&nbsp;&nbsp;
                                            2h ago
                                        </div>
                                    </div> <!-- / .message -->

                                    <div class="message">
                                        <img src="<?= $directoryAsset; ?>/demo/avatars/4.jpg" alt="" class="message-avatar">
                                        <a href="#" class="message-subject">Lorem ipsum dolor sit amet.</a>
                                        <div class="message-description">
                                            from <a href="#">Timothy Owens</a>
                                            &nbsp;&nbsp;·&nbsp;&nbsp;
                                            2h ago
                                        </div>
                                    </div> <!-- / .message -->

                                    <div class="message">
                                        <img src="<?= $directoryAsset; ?>/demo/avatars/5.jpg" alt="" class="message-avatar">
                                        <a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                                        <div class="message-description">
                                            from <a href="#">Denise Steiner</a>
                                            &nbsp;&nbsp;·&nbsp;&nbsp;
                                            2h ago
                                        </div>
                                    </div> <!-- / .message -->

                                    <div class="message">
                                        <img src="<?= $directoryAsset; ?>/demo/avatars/2.jpg" alt="" class="message-avatar">
                                        <a href="#" class="message-subject">Lorem ipsum dolor sit amet.</a>
                                        <div class="message-description">
                                            from <a href="#">Robert Jang</a>
                                            &nbsp;&nbsp;·&nbsp;&nbsp;
                                            2h ago
                                        </div>
                                    </div> <!-- / .message -->

                                </div> <!-- / .messages-list -->
                                <a href="<?php echo $baseUrl; ?>/notification/inbox" class="messages-link">MORE MESSAGES</a>
                            </div> <!-- / .dropdown-menu -->
                        </li>
                        <!-- /3. $END_NAVBAR_ICON_BUTTONS -->

                        <!--<li>
                            <form class="navbar-form pull-left">
                                <input type="text" class="form-control" placeholder="Search">
                            </form>
                        </li>-->

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
                                <?php
                                //echo 'gender :: ' . Yii::$app->user->identity->gender;
                                if (Yii::$app->user->identity->gender == 0) {
                                    ?>
                                    <img src="<?php echo $directoryAsset ?>/demo/avatars/female.jpg" alt="">
                                <?php } elseif (Yii::$app->user->identity->gender == 1) { ?>
                                    <img src="<?php echo $directoryAsset ?>/demo/avatars/silhouette.jpg" alt="">
                                <?php } ?>
<!--<span> <?php //echo Yii::$app->session['firstname'];                                       ?></span>-->
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