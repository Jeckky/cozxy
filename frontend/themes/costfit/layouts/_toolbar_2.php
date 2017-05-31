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
<!--Main Menu-->
<nav class="menu">
    <div class="container">

        <ul class="main">
            <li class="has-submenu"><a href="index.html"><span>H</span>ome<i class="fa fa-chevron-down"></i></a><!--Class "has-submenu" for proper highlighting and dropdown-->
                <ul class="submenu">
                    <li><a href="index.html">Home - Slideshow</a></li>
                    <li><a href="home-fullscreen.html">Home - Fullscreen Slider</a></li>
                    <li><a href="home-showcase.html">Home - Product Showcase</a></li>
                    <li><a href="home-categories.html">Home - Categories Slider</a></li>
                    <li><a href="home-offers.html">Home - Special Offers</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="shop-filters-left-3cols.html"><span>S</span>hop<i class="fa fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="shop-filters-left-3cols.html">Shop - Filters Left 3 Cols</a></li>
                    <li><a href="shop-filters-left-2cols.html">Shop - Filters Left 2 Cols</a></li>
                    <li><a href="shop-filters-right-3cols.html">Shop - Filters Right 3 Cols</a></li>
                    <li><a href="shop-filters-right-2cols.html">Shop - Filters Right 2 Cols</a></li>
                    <li><a href="shop-no-filters-4cols.html">Shop - No Filters 4 Cols</a></li>
                    <li><a href="shop-no-filters-3cols.html">Shop - No Filters 3 Cols</a></li>
                    <li><a href="shop-single-item-v1.html">Shop - Single Item Vers 1</a></li>
                    <li><a href="shop-single-item-v2.html">Shop - Single Item Vers 2</a></li>
                    <li><a href="shopping-cart.html">Shopping Cart</a></li>
                    <li><a href="checkout.html">Checkout Page</a></li>
                    <li><a href="wishlist.html">Wishlist</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="blog-sidebar-right.html"><span>B</span>log<i class="fa fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="blog-sidebar-left.html">Blog - Sidebar Left</a></li>
                    <li><a href="blog-sidebar-right.html">Blog - Sidebar Right</a></li>
                    <li><a href="blog-single.html">Blog - Single Post</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="#"><span>P</span>ages<i class="fa fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="register.html">Login / Registration</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contacts.html">Contacts</a></li>
                    <li><a href="coming-soon.html">Coming Soon</a></li>
                    <li><a href="404.html">404 Page</a></li>
                    <li><a href="support.html">Support Page</a></li>
                    <li><a href="delivery.html">Delivery</a></li>
                    <li><a href="history.html">History Page</a></li>
                    <li><a href="tracking.html">Tracking Page</a></li>
                    <li><a href="cs-page.html">Components &amp; Styles</a></li>
                </ul>
            </li>
            <li class="hide-sm"><a href="support.html"><span>S</span>upport</a></li>
        </ul>

    </div>

    <div class="catalog-block">
        <div class="container">
            <ul class="catalog">
                <li class="has-submenu"><a href="shop-filters-left-3cols.html">Handbag<i class="fa fa-chevron-down"></i></a>
                    <ul class="submenu">
                        <li><a href="#">Wristlet</a></li>
                        <li class="has-submenu"><a href="#">Backpack</a><!--Class "has-submenu" for adding carret and dropdown-->
                            <ul class="sub-submenu">
                                <li><a href="#">KATA</a></li>
                                <li><a href="#">Think Tank</a></li>
                                <li><a href="#">Manfrotto</a></li>
                                <li><a href="#">Lowepro</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Hat box</a></li>
                        <li class="has-submenu"><a href="#">Clutch</a>
                            <ul class="sub-submenu">
                                <li><a href="#">Louis Vuitton</a></li>
                                <li><a href="#">Chanel</a></li>
                                <li><a href="#">Christian Dior</a></li>
                                <li><a href="#">Gucci</a></li>
                                <li><a href="#">Neri Karra</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Envelope</a></li>
                        <li class="offer">
                            <div class="col-1">
                                <p class="p-style2">Use product images on the menu. It's easier to percept a visual content than a textual one. </p>
                            </div>
                            <div class="col-2">
                                <img src="img/offers/menu-drodown-offer.jpg" alt="Special Offer"/>
                                <a class="btn btn-black" href="#"><span>584$</span>Special offer</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li><a href="shop-filters-left-3cols.html">Wallet</a></li>
                <li><a href="shop-filters-left-3cols.html">Satchel</a></li>
                <li><a href="shop-filters-left-3cols.html">Clutch</a></li>
                <li><a href="shop-filters-left-3cols.html">Hobo bags</a></li>
                <li><a href="shop-filters-left-3cols.html">Shoulder Bag</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="toolbar-container">
    <div class="container">
        <!--Toolbar-->
        <div class="toolbar group">
            <a class="login-btn btn-outlined-invert" href="#" data-toggle="modal" data-target="#loginModal"><i class="icon-profile"></i> <span><b>L</b>ogin</span></a>

            <a class="btn-outlined-invert" href="wishlist.html"><i class="icon-heart"></i> <span><b>W</b>ishlist</span></a>

            <div class="cart-btn">
                <a class="btn btn-outlined-invert" href="shopping-cart.html"><i class="icon-shopping-cart-content"></i><span>3</span><b>36 5654</b></a>

                <!--Cart Dropdown-->
                <div class="cart-dropdown">
                    <span></span><!--Small rectangle to overlap Cart button-->
                    <div class="body">
                        <table>
                            <tr>
                                <th>Items</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                            <tr class="item">
                                <td><div class="delete"></div><a href="#">Good Joo-Joo Surfb</a></td>
                                <td><input type="text" value="1"></td>
                                <td class="price">89 005 $</td>
                            </tr>
                            <tr class="item">
                                <td><div class="delete"></div><a href="#">Good Joo-Joo Item</a></td>
                                <td><input type="text" value="2"></td>
                                <td class="price">4 300 $</td>
                            </tr>
                            <tr class="item">
                                <td><div class="delete"></div><a href="#">Good Joo-Joo</a></td>
                                <td><input type="text" value="5"></td>
                                <td class="price">84 $</td>
                            </tr>
                        </table>
                    </div>
                    <div class="footer group">
                        <div class="buttons">
                            <a class="btn btn-outlined-invert" href="checkout.html"><i class="icon-download"></i>Checkout</a>
                            <a class="btn btn-outlined-invert" href="shopping-cart.html"><i class="icon-shopping-cart-content"></i>To cart</a>
                        </div>
                        <div class="total">93 389 $</div>
                    </div>
                </div><!--Cart Dropdown Close-->
            </div>

            <button class="search-btn btn-outlined-invert"><i class="icon-magnifier"></i></button>
        </div><!--Toolbar Close-->
    </div>
</div>
<style type="text/css">
    .menu {
        background: none;
    }
    .menu #catalog_newxx  .submenu li a {
        color: rgba(255,212,36,.9);


    }
    .menu .catalog li:hover a {
        transition: none;
        color: rgba(255,212,36,.9);
    }
    .menu #catalog_newxx li a {
        padding: 5px 5px 5px 5px;
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
                           <!--<li class="pill-right"><a href="<?php // echo Yii::$app->homeUrl;                                                                 ?>profile/payment">Payment Methods</a></li>
                           <li class="pull-right"><a href="<?php // echo Yii::$app->homeUrl;                                                                   ?>history">Easy Re-Order</a></li>-->
                        </ul>
                    </li>
                    <li>
                        <a class="btn-outlined-invert" href="<?= Yii::$app->homeUrl ?>wishlist"><i class="icon-heart"></i> Wishlist</a>
                    </li>
                    <li> <?= $this->render('_cart') ?> </li>
                    <li class="search-cozxy">
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