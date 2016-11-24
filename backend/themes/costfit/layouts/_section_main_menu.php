<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use leandrogehlen\treegrid\TreeGrid;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
//throw new \yii\base\Exception($baseUrl);
?>
<div id="main-menu" role="navigation">
    <div id="main-menu-inner">
        <div class="menu-content top" id="menu-content-demo">
            <div>
                <div class="text-bg"><span class="text-slim">Welcome,</span> <br><span class="text-semibold"><?= isset(Yii::$app->user->identity->email) ? Yii::$app->user->identity->firstname : 'Guest' ?></span></div>
                <?php
                //echo 'gender :: ' . Yii::$app->user->identity->gender;
                //echo 'type :: ' . Yii::$app->user->identity->type;
                if (Yii::$app->user->identity->gender == 0) {
                    ?>
                    <img src="<?php echo $directoryAsset ?>/demo/avatars/female.jpg" alt="">
                <?php } elseif (Yii::$app->user->identity->gender == 1) { ?>
                    <img src="<?php echo $directoryAsset ?>/demo/avatars/silhouette.jpg" alt="">
                <?php } ?>
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
            <?php
            //$this->view->params['listDataProviderMenu']['menuBackend']
            //$this->params['listDataProviderMenu']['menuBackend']
            if (isset($this->params['listDataProviderMenu']['menuBackend'])) {
                $menuBackend = $this->params['listDataProviderMenu']['menuBackend'];
                foreach ($menuBackend as $key => $value) {
                    //echo 'menu :: ' . $value->user_group_Id;
                    //echo '<===>';
                    //echo 'user ::' . Yii::$app->user->identity->user_group_Id;
                    //echo '<br>';
                    //echo $value->user_group_Id . '<br>';
                    $menuRe = str_replace('[', '', str_replace(']', '', $value->user_group_Id));
                    $memuEx = explode(',', $menuRe);
                    // :::::: //
                    $user_group_Id = Yii::$app->user->identity->user_group_Id;
                    $userRe = str_replace('[', '', str_replace(']', '', $user_group_Id));
                    $userEx = explode(',', $userRe);
                    // :: in_array :: //
                    if (array_intersect($userEx, $memuEx)) {
                        //echo '(checked)' . '::' . $value->user_group_Id;
                        $checked = 'checked';
                    } else {
                        //echo '(No)   ';
                        $checked = '';
                    }
                    if ($value->parent_id == 0) {
                        //echo $value->user_group_Id . '::' . Yii::$app->user->identity->user_group_Id . '<br>';

                        $subMenuCount = \common\models\costfit\Menu::find()->where('parent_id =' . $value->menuId)->count();
                        //echo 'subMenuCount :' . $subMenuCount . '<br>::' . $checked;
                        if ($subMenuCount == 0) {
                            if ($checked == 'checked') {
                                ?>
                                <li>
                                    <a href="<?php echo $baseUrl; ?>/<?php echo $value->link; ?>">
                                        <i class="menu-icon fa fa-dashboard"></i><span class="mm-text"><?php echo $value->name; ?> </span></a>
                                </li>
                                <?php
                            }
                        } else {
                            //echo $checked;
                            ?>
                            <li class="mm-dropdown">
                                <?php if ($checked == 'checked') { ?>
                                    <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text"><?php echo $value->name; ?></span></a>
                                <?php } ?>
                                <?php
                                $subMenu = \common\models\costfit\Menu::find()->where('parent_id =' . $value->menuId)->all();
                                foreach ($subMenu as $key => $value1) {
                                    ?>
                                    <ul>
                                        <?php
                                        $subSubMenuCount = \common\models\costfit\Menu::find()->where('parent_id =' . $value1['menuId'])->count();
                                        //echo 'menu :: ' . $value1->user_group_Id;
                                        //echo '<===>';
                                        //echo 'user ::' . Yii::$app->user->identity->user_group_Id;
                                        //echo '<br>';
                                        $menuRe = str_replace('[', '', str_replace(']', '', $value1->user_group_Id));
                                        $memuEx = explode(',', $menuRe);
                                        // :::::: //
                                        $user_group_Id = Yii::$app->user->identity->user_group_Id;
                                        $userRe = str_replace('[', '', str_replace(']', '', $user_group_Id));
                                        $userEx = explode(',', $userRe);
                                        // :: in_array :: //
                                        if (array_intersect($userEx, $memuEx)) {
                                            //echo '(checked)' . '::' . $value->user_group_Id;
                                            $checked = 'checked';
                                        } else {
                                            //echo '(No)   ';
                                            $checked = '';
                                        }
                                        if ($subSubMenuCount == 0) {
                                            ?>
                                            <?php if ($checked == 'checked') { ?>
                                                <li>
                                                    <a tabindex="-1" href="<?php echo $baseUrl; ?>/<?php echo $value1['link']; ?>">
                                                        <i class="fa fa-square"></i> <span class="mm-text"><?php echo $value1['name']; ?></span></a>
                                                </li>
                                            <?php } ?>
                                            <?php
                                        } else {
                                            ?>
                                            <li class="mm-dropdown">
                                                <a tabindex="-1" href="#"><i class="fa fa-square"></i> <span class="mm-text"><?php echo $value1['name']; ?></span></a>
                                                <?php
                                                $subSubSubMenu = \common\models\costfit\Menu::find()->where('parent_id =' . $value1['menuId'])->all();
                                                foreach ($subSubSubMenu as $key => $value2) {
                                                    if ($checked == 'checked') {
                                                        ?>
                                                        <ul>
                                                            <li>
                                                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/<?php echo $value2['link']; ?>"><span class="mm-text"><?php echo $value2['name']; ?></span></a>
                                                            </li>
                                                        </ul>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                }
                                //echo 'zzzz';
                                ?>
                            </li>
                            <?php
                        }
                    } else {
                        ?><?php
                        if ($checked == 'checked') {
                            ?><!--
                            <li>
                                <a href="<?php echo $baseUrl; ?>/<?php echo $value->link; ?>">
                                    <i class="menu-icon fa fa-dashboard"></i><span class="mm-text"><?php echo $value->name; ?> </span></a>
                            </li>-->
                        <?php }
                        ?>
                        <?php
                    }
                }
            }
            ?>
            <!--
            <li>
                <a href="<?php //echo $baseUrl;                                                                                                                                                                                       ?>/dashboard"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text">Dashboard</span></a>
            </li>

            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">จัดการข้อมูล User</span><span class="label label-warning">Updated</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="<?php //echo $baseUrl;                                                                                                                                                                                                                        ?>/user/user"><i class="fa fa-square"></i> <span class="mm-text">สมาชิก</span></a>
                    </li>
                </ul>
            </li>-->

            <?php if (Yii::$app->user->identity->type != 4) { ?>
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

            <?php } ?>
            <!--<li class="mm-dropdown">
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
            </li>-->

            <!--Suppliers-->
            <?php if (Yii::$app->user->identity->type == 4) { ?>
                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-gift"></i><span class="mm-text">Suppliers</span><span class="badge badge-primary">6</span></a>
                    <ul>
                        <li>
                            <a tabindex="-1" href="<?php echo $baseUrl; ?>/suppliers/product-suppliers"><span class="mm-text">Product supplier</span></a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?php echo $baseUrl; ?>/suppliers/brand"><span class="mm-text">Brand</span></a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
        </ul> <!-- / .navigation -->
    </div> <!-- / #main-menu-inner -->
</div> <!-- / #main-menu -->
<!-- /4. $MAIN_MENU -->