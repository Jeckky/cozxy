<?php
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/daiibuy/assets');
?>
<div id="main-menu" role="navigation">
    <div id="main-menu-inner">
        <div class="menu-content top" id="menu-content-demo">
            <div>
                <div class="text-bg"><span class="text-slim">Welcome,</span> <span class="text-semibold"><?php echo Yii::$app->session['firstname']; ?></span></div>
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

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">จัดการข้อมูลหลัก</span><span class="label label-warning">Updated</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/management/bank"><i class="fa fa-square"></i> <span class="mm-text">Bank</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/management/bank-name"><i class="fa fa-square"></i> <span class="mm-text">Bank Name</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/management/content"><i class="fa fa-square"></i> <span class="mm-text">Content</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/management/promotion"><i class="fa fa-square"></i> <span class="mm-text">Promotion</span></a>
                    </li>
                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">จัดการข้อมูล User</span><span class="label label-warning">Updated</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/people/user"><i class="fa fa-square"></i> <span class="mm-text">User</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/people/user-file"><i class="fa fa-square"></i> <span class="mm-text">User File</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/people/supplier"><i class="fa fa-square"></i> <span class="mm-text">Supplier</span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="<?php echo $baseUrl; ?>/order"><i class="menu-icon fa fa-tasks"></i><span class="mm-text">Order</span></a>
            </li>

            <li>
                <a href="<?php echo $baseUrl; ?>/myfile"><i class="menu-icon fa fa-th"></i><span class="mm-text">My File</span></a>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Spacial Project</span> <span class="label label-warning">Updated</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/project/user-spacial-project"><i class="fa fa-square"></i> <span class="mm-text">User Request</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/project/supplier-spacial-project"><i class="fa fa-square"></i> <span class="mm-text">Spacial Code</span></a>
                    </li>

                </ul>
            </li>


            <li>
                <a tabindex="-1" href="<?php echo $baseUrl; ?>/configuration"><i class="menu-icon fa fa-th"></i><span class="mm-text">Configuration</span></a>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Product Atech</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/brand?id=2"><i class="fa fa-square"></i> <span class="mm-text">Brand</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product?id=2" ><i class="fa fa-square"></i> <span>Product</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/pricegroup?id=2"><i class="fa fa-square"></i> <span class="mm-text">Price Group</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/category?id=2"><i class="fa fa-square"></i> <span class="mm-text">Category</span></a>
                    </li>

                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Product Fenzer</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/brand?id=1"><i class="fa fa-square"></i> <span class="mm-text">Brand</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product?id=1" ><i class="fa fa-square"></i> <span>Product</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/pricegroup?id=1"><i class="fa fa-square"></i> <span class="mm-text">Price Group</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/category?id=1"><i class="fa fa-square"></i> <span class="mm-text">Category</span></a>
                    </li>
                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Product Ginza Town</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/brand?id=5"><i class="fa fa-square"></i> <span class="mm-text">Brand</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product?id=5" ><i class="fa fa-square"></i> <span>Product</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/pricegroup?id=5"><i class="fa fa-square"></i> <span class="mm-text">Price Group</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/category?id=5"><i class="fa fa-square"></i> <span class="mm-text">Category</span></a>
                    </li>
                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Product Ginza Home</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/brand?id=4"><i class="fa fa-square"></i> <span class="mm-text">Brand</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/product?id=4"><i class="fa fa-square"></i> <span>Product</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/pricegroup?id=4"><i class="fa fa-square"></i> <span class="mm-text">Price Group</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/category?id=4"><i class="fa fa-square"></i> <span class="mm-text">Category</span></a>
                    </li>
                </ul>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">รายงาน</span><span class="label label-warning">Updated</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php echo $baseUrl; ?>/report/viewSummaryReport"><i class="fa fa-square"></i> <span class="mm-text">รายงานสรุปยอดขาย</span></a>
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