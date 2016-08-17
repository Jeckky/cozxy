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

</style>
<ul class="catalog" id="catalog_new" style="width: 100%;">
    <li class="has-submenu pull-left"><a href="#">Categories<i class="fa fa-chevron-down open"></i></a>
        <ul class="submenu" >
            <?php
            // $list_menu_category = $this->Me
            foreach ($MenuCategory as $items) {

                $params = \common\models\ModelMaster::encodeParams(['categoryId' => $items->categoryId]);
                ?>
                <li class="has-submenu"><a href="<?php echo Yii::$app->homeUrl; ?>search/<?= $items->createTitle() ?>/<?= $params ?>" style="font-size: 14px;"><?php echo $items->title; ?> <i class="fa fa-chevron-down"></i></a>
                    <ul class="sub-submenu" id="test-menu" style="width: 100%;">
                        <?php
                        $MenuCategoryParentId = $this->context->actionMenuCategoryParentId($items->categoryId);
                        foreach ($MenuCategoryParentId as $items_sub) {
                            $params = \common\models\ModelMaster::encodeParams(['categoryId' => $items_sub->categoryId]);
                            ?>
                            <a href="<?php echo Yii::$app->homeUrl; ?>search/<?= $items_sub->createTitle() ?>/<?= $params ?>" class="menu-catalog-title-color" style="color: #000;"><?php echo $items_sub->title; ?></a>
                            <?php
                            $MenuCategorySubParentId = $this->context->actionMenuCategorySubParentId($items_sub->categoryId);
                            foreach ($MenuCategorySubParentId as $items_sub_parent) {
                                $params = \common\models\ModelMaster::encodeParams(['categoryId' => $items_sub_parent->categoryId]);
                                ?>
                                <li><a href="<?php echo Yii::$app->homeUrl; ?>search/<?= $items_sub_parent->createTitle() ?>/<?= $params ?>"><?php echo $items_sub_parent->title; ?></a></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </li>
                <?php
            }
            ?>
        </ul>
    </li>
    <?php if (!Yii::$app->user->isGuest): ?>
        <li class="has-submenu pill-right"><a href="#"><?= (Yii::$app->user->identity->email); ?></a>
            <ul class="submenu">
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

