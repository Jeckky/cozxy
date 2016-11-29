<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
//throw new \yii\base\Exception($baseUrl);
?>
<?php
//echo 'test !!';
//menu test nav widget
/* echo Nav::widget([
  'options' => ['class' => 'sidebar-menu treeview'],
  'items' => [

  ['label' => 'Menu 1', 'url' => ['/a/index']],
  ['label' => 'Menu 2', 'url' => ['/custom-perks/index']],
  ['label' => 'Submenu', 'items' => [
  ['label' => 'Action', 'url' => '#'],
  ['label' => 'Another action', 'url' => '#'],
  ['label' => 'Something else here', 'url' => '#'],
  ],
  ],
  ],
  ]); */
?>
<div id="main-menu" role="navigation">
    <div id="main-menu-inner">
        <div class="menu-content top" id="menu-content-demo">
            <div>
                <div class="text-bg"><span class="text-slim">Welcome,</span> <span class="text-semibold"><?= isset(Yii::$app->user->identity->email) ? Yii::$app->user->identity->firstname : 'Guest' ?></span></div>
                <img src="<?= $directoryAsset; ?>/demo/avatars/1.jpg" alt="" class="">
                <div class="btn-group">
                    <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-envelope"></i></a>
                    <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-user"></i></a>
                    <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a>
                    <a href="#" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
                </div>
                <a href="#" class="close">&times;</a>
            </div>
        </div>

        <ul class="navigation">
            <li>
                <a href="<?php echo $baseUrl; ?>/dashboard"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text">Dashboard</span></a>
            </li>
            <!-- <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">จัดการข้อมูลหลัก</span><span class="label label-warning">Updated</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="#"><i class="fa fa-square"></i> <span class="mm-text">ตั้งค่า</span></a>
                    </li>

                </ul>
            </li>-->
            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">จัดการข้อมูล User</span><span class="label label-warning">Updated</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/user/user"><i class="fa fa-square"></i> <span class="mm-text">สมาชิก</span></a>
                    </li>
                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">จัดการรายการสั่งซื้อสินค้า  </span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/order/order"><span class="mm-text">Order</span></a>
                    </li>
                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Store</span><span class="label label-warning">Store</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/store/store"><span class="mm-text">Store</span></a>

                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/store/virtual"><span class="mm-text">Virtual</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/store/store-product-group"><span class="mm-text">Import Product</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/store/store-product/choose-po"><span class="mm-text">จัดเรียง</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/store/picking"><span class="mm-text">Picking</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/store/packing"><span class="mm-text">Packing</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/store/shipping"><span class="mm-text">Shipping</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/lockers/lockers"><span class="mm-text">Lockers Demo</span></a>
                    </li>

                    <li class="mm-dropdown">
                        <a tabindex="-1" href="#"><span class="mm-text">Location</span><span class="label label-warning">1</span></a>
                        <ul>
                            <li>
                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/store/region"><span class="mm-text">Region</span></a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">LED Control</span><span class="label label-warning">Updated</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/led/led"><i class="fa fa-square"></i> <span class="mm-text">LED</span></a>
                    </li>
                </ul>
            </li>
            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Picking Points</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/picking/picking"><i class="fa fa-square"></i> <span class="mm-text">Picking</span></a>
                    </li>
                </ul>
            </li>
            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Supplier </span><span class="label label-danger">new</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/supplier/supplier"><span class="mm-text">Supplier</span></a>
                    </li>
                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Product  </span><span class="label label-danger">new</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product/brand"><span class="mm-text">Brand</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product/show-category/show-category"><span class="mm-text">Show Category</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product/category"><span class="mm-text">Category</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product/product-group"><span class="mm-text">Product Group</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product/product-price-match-group"><span class="mm-text">Product Price Match</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product/product"><span class="mm-text">Product</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product/coupon-owner"><span class="mm-text">Coupon</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product/unit"><span class="mm-text">Unit</span></a>
                    </li>
                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Hots Product  </span><span class="label label-danger">new</span><span class="badge badge-primary">1</span></a>
                <ul>

                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product/product-hot"><span class="mm-text">Hots Product</span></a>
                    </li>
                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Shipping </span><span class="label label-danger">new</span><span class="badge badge-primary">1</span></a>
                <ul>
                    <li class="mm-dropdown">
                        <a tabindex="-1" href="#"><span class="mm-text">Package</span><span class="label label-warning">2</span></a>
                        <ul>
                            <li>
                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/shipping/package"><span class="mm-text">Package</span></a>
                            </li>
                            <li>
                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/shipping/package-type"><span class="mm-text">Package Type</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Report </span><span class="label label-danger">new</span><span class="badge badge-primary">1</span></a>
                <ul>
                    <li class="mm-dropdown">
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/report/report"><span class="mm-text">รายงานยอดขาย</span><span class="label label-warning">2</span></a>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/report/popular-report"><span class="mm-text">รายงานสินค้ายอดนิยม</span><span class="label label-warning">2</span></a>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/report/birthday-report"><span class="mm-text">รายงานวันเกิด</span><span class="label label-warning">2</span></a>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/report/picking-point-report"><span class="mm-text">รายงานจุดส่งสินค้ายอดนิยม</span><span class="label label-warning">2</span></a>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/report/top-customer-report"><span class="mm-text">รายงานลูกค้าดีเด่น</span><span class="label label-warning">2</span></a>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/report/best-seller-report"><span class="mm-text">รายงานสินค้าขายดี</span><span class="label label-warning">2</span></a>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/report/future-plan-report"><span class="mm-text">รายงานสินค้าที่ต้องสั่งล่วงหน้า</span><span class="label label-warning">2</span></a>
                        <!--                        <ul>
                                                    <li>
                                                        <a tabindex="-1" href="<?php //echo $baseUrl;                                     ?>/report/report"><span class="mm-text">รายงานยอดขาย</span></a>
                                                    </li>
                                                </ul>-->
                    </li>
                </ul>
            </li>
            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">จัดการข้อมูลหลัก  </span><span class="label label-danger">new</span><span class="badge badge-primary">1</span></a>
                <ul>

                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/content/content-group"><span class="mm-text">Content</span></a>
                    </li>
                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Payment  </span><span class="label label-danger">new</span><span class="badge badge-primary">1</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/payment/payment-method"><span class="mm-text">Payment Method</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/payment/bank"><span class="mm-text">Bank</span></a>
                    </li>
                    <!--                    <li class="mm-dropdown">
                                            <a tabindex="-1" href="#"><span class="mm-text">Content</span><span class="label label-warning">2</span></a>
                                            <ul>
                                                <li>
                                                    <a tabindex="-1" href="<?php echo $baseUrl; ?>/content/content-group"><span class="mm-text">Package</span></a>
                                                </li>
                                                <li>
                                                    <a tabindex="-1" href="<?php echo $baseUrl; ?>/shipping/package-type"><span class="mm-text">Package Type</span></a>
                                                </li>
                                            </ul>
                                        </li>-->
                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Flow Chart  </span><span class="label label-danger">new</span><span class="badge badge-primary">1</span></a>
                <ul>
                    <li class="mm-dropdown">
                        <a tabindex="-1" href="#"><span class="mm-text">Frontend</span><span class="label label-warning">2</span></a>
                        <ul>
                            <li>
                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/dashboard/dashboard/flowchart?id=frontOrder"><span class="mm-text">Order</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="mm-dropdown">
                        <a tabindex="-1" href="#"><span class="mm-text">Backend</span><span class="label label-warning">2</span></a>
                        <ul>
                            <li>
                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/dashboard/dashboard/flowchart?id=order"><span class="mm-text">Order</span></a>
                            </li>
                            <li class="mm-dropdown">
                                <a tabindex="-1" href="#"><span class="mm-text">Store</span></a>
                                <ul>
                                    <li>
                                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/dashboard/dashboard/flowchart?id=importProduct"><span class="mm-text">Import Product</span></a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/dashboard/dashboard/flowchart?id=qc"><span class="mm-text">QC</span></a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/dashboard/dashboard/flowchart?id=sortProduct"><span class="mm-text">จัดเรียงสินค้า</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="mm-dropdown">
                                <a tabindex="-1" href="#"><span class="mm-text">Product</span></a>
                                <ul>
                                    <li>
                                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/dashboard/dashboard/flowchart?id=productPrice"><span class="mm-text">ตั้งราคาสินค้า</span></a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/dashboard/dashboard/flowchart?id=productPick"><span class="mm-text">หยิบสินค้า</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-sitemap"></i><span class="mm-text">Menu levels</span><span class="badge badge-primary">6</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 1.1</span><span class="badge badge-danger">12</span><span class="label label-info">21</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 1.2</span></a>
                    </li>
                    <li class="mm-dropdown">
                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 1.3</span><span class="label label-warning">5</span></a>
                        <ul>
                            <li>
                                <a tabindex="-1" href="#"><span class="mm-text">Menu level 2.1</span></a>
                            </li>
                            <li class="mm-dropdown">
                                <a tabindex="-1" href="#"><span class="mm-text">Menu level 2.2</span></a>
                                <ul>
                                    <li class="mm-dropdown">
                                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 3.1</span></a>
                                        <ul>
                                            <li>
                                                <a tabindex="-1" href="#"><span class="mm-text">Menu level 4.1</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 3.2</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a tabindex="-1" href="#"><span class="mm-text">Menu level 2.2</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul> <!-- / .navigation -->
    </div> <!-- / #main-menu-inner -->
</div> <!-- / #main-menu -->
<!-- /4. $MAIN_MENU -->