<?php

// echo Yii::$app->homeUrl . Yii::$app->controller->id;
//echo 'Test =' . Yii::$app->homeUrl;
//echo '<br>' . Yii::$app->controller->id;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\controllers\MasterController;
use common\models\ModelMaster;

$MenuCategory = $this->context->actionMenuCategory();
?>
<style>
    /*#test-menu{
        min-heigh: 480px;
        min-height: 500px;
        overflow-y: scroll;
    }*/
    .sorting {
        display: inline-block;
        vertical-align: middle;
        margin: 0px 0 0px 0px;
    }

    .menu .catalog li .submenu li {
        width: 230px;
        border-top: 1px solid #fff;
    }
</style>
<!-- Show For Mobile -->
<ul class="catalog hidden-sm hidden-md  hidden-lg" style="max-width: 100%;" >
    <?php
    // $list_menu_category = $this->Me
    foreach ($MenuCategory as $items) {
        $params = \common\models\ModelMaster::encodeParams(['categoryId' => $items->categoryId]);
        ?>
        <li class="has-submenu"><a href="#"><?php echo $items->title; ?><i class="fa fa-chevron-down"></i></a>
            <?php
            $MenuCategoryParentId = $this->context->actionMenuCategoryParentId($items->categoryId);
            foreach ($MenuCategoryParentId as $items_sub) {
                $params = \common\models\ModelMaster::encodeParams(['categoryId' => $items_sub->categoryId]);
                ?>
                <ul class="submenu">
                    <li class="has-submenu"><a href="#" style="font-size: 12px; font-weight: bold;"><?php echo $items_sub->title; ?></a></li>
                    <ul class="has-submenu">
                        <?php
                        $MenuCategorySubParentId = $this->context->actionMenuCategorySubParentId($items_sub->categoryId);
                        foreach ($MenuCategorySubParentId as $items_sub_parent) {
                            $params = \common\models\ModelMaster::encodeParams(['categoryId' => $items_sub_parent->categoryId]);
                            ?>
                            <li><a href="<?php echo Yii::$app->homeUrl; ?>search/<?= $items_sub_parent->createTitle() ?>/<?= $params ?>" style="font-size: 12px;"><?php echo '&nbsp;-&nbsp;' . $items_sub_parent->title; ?></a></li>
                        <?php } ?>
                    </ul>
                </ul>
                <?php
            }
            ?>
        </li>
        <?php
    }
    ?>
    <?php if (!Yii::$app->user->isGuest): ?>
        <li class="has-submenu pill-right"><a href="#">Account<i class="fa fa-chevron-down"></i></a>
            <ul class="submenu">
                <li class="pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>profile" style="font-size: 12px;">My Profile</a></li>
                <li class="pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>profile/order" style="font-size: 12px;">Order History</a></li>
                <!--<li class="pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>profile/payment">Payment Methods</a></li>
                <li class="pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>history">Easy Re-Order</a></li>-->
            </ul>
        </li>
    <?php endif; ?>
    <li class="has-submenu pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>coupon">Super special offers</a></li><!--ข้อเสนอพิเศษจากพาร์ทเนอร์-->
    <li class="has-submenu pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>how-cost-fit-works">How Works</a></li>
</ul>

<!-- Show For Desktop -->
<ul class="catalog hidden-xs" id="catalog_new" style="width: 100%;">
    <li class="has-submenu pull-left"><a href="#">Categories<i class="fa fa-chevron-down open"></i></a>
        <ul class="submenu">
            <?php
            // $list_menu_category = $this->Me
            foreach ($MenuCategory as $items) {
                $params = \common\models\ModelMaster::encodeParams(['categoryId' => $items->categoryId]);
                ?>
                <li class="has-submenu">
                    <a href="#" style="font-size: 14px;">
                        <?php echo $items->title; ?> <i class="fa fa-chevron-down"></i>
                    </a>
                    <ul class="sub-submenu" id="test-menu" style="width: 900px; float: left; ">
                        <?php
                        $MenuCategoryParentId = $this->context->actionMenuCategoryParentId($items->categoryId);
                        $num = 0;
                        foreach ($MenuCategoryParentId as $items_sub) {
                            $params = \common\models\ModelMaster::encodeParams(['categoryId' => $items_sub->categoryId]);
                            $MenuCategorySubParentId = $this->context->actionMenuCategorySubParentId($items_sub->categoryId);
                            ?>
                            <a href="<?php echo Yii::$app->homeUrl; ?>search/<?= $items_sub->createTitle() ?>/<?= $params ?>" style="color: #000; font-weight: 900 ; width:50%; border-bottom :1px #dfdfdf solid;">
                                <?php echo $items_sub->title; ?> <span style="color:#6c6c6c; font-size: 10px;">(<?php echo count($MenuCategorySubParentId); ?>)</span></a>
                                <?php
                                foreach ($MenuCategorySubParentId as $items_sub_parent) {
                                    $params = \common\models\ModelMaster::encodeParams(['categoryId' => $items_sub_parent->categoryId]);
                                    ?>
                                <li class="col-md-12" style="float: left; width: 100%; width: 50%; "><a href="<?php echo Yii::$app->homeUrl; ?>search/<?= $items_sub_parent->createTitle() ?>/<?= $params ?>"><?php echo '&nbsp;-&nbsp;' . $items_sub_parent->title; ?></a></li>
                            <?php } ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </li>
        <?php
    }
    ?>
</ul>
</li>
<?php if (!Yii::$app->user->isGuest): ?>
    <li class="has-submenu pill-right">
        <span class="sorting" id="sortingAccount" style="padding: 1px 1px 1px 1px;">
            <a href="#" class="sorting" style="padding: 1px 1px 1px 1px;">Account</a></span>
        <ul class="submenu" id="submenu-sorting-account" style="margin-top: -1px;">
            <li class="pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>profile">My Profile</a></li>
            <li class="pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>profile/order">Order History</a></li>
            <!--<li class="pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>profile/payment">Payment Methods</a></li>
            <li class="pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>history">Easy Re-Order</a></li>-->
        </ul>
    </li>
<?php endif; ?>
<li class="has-submenu pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>coupon">Super special offers</a></li><!--ข้อเสนอพิเศษจากพาร์ทเนอร์-->
<li class="has-submenu pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>how-cost-fit-works">How Works</a></li>
</ul>

