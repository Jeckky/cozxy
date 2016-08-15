<?php
// echo Yii::$app->homeUrl . Yii::$app->controller->id;
//echo 'Test =' . Yii::$app->homeUrl;
//echo '<br>' . Yii::$app->controller->id;
?>
<ul class="catalog" id="catalog_new" style="width: 100%;">
    <li class="has-submenu pull-left"><a href="#">Categories<i class="fa fa-chevron-down open"></i></a>
        <ul class="submenu">
            <?php
            for ($i = 5; $i <= 10; $i++) {
                ?>
                <li class="has-submenu"><a href="#" style="font-size: 14px;">Electricals & Electronics <i class="fa fa-chevron-down"></i></a>
                    <ul class="sub-submenu">
                        <a href="<?php echo Yii::$app->homeUrl; ?>search?category=24" class="menu-catalog-title-color" style="color: #000;">เครื่องใช้ไฟฟ้าภายในบ้าน</a>
                        <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">coffee</a></li>
                        <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Tea</a></li>
                    </ul>
                </li>
                <?php
                $i = $i++;
            }
            ?>
        </ul>
    </li>
    <?php if (!Yii::$app->user->isGuest): ?>
        <li class="has-submenu pill-right"><a href="#"><?= (Yii::$app->user->identity->email); ?></a>
            <ul class="submenu">
                <li class="pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>profile">My Profile</a></li>
                <li class="pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>profile/order">Order History</a></li>
                <li class="pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>profile/payment">Payment Methods</a></li>
                <li class="pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>history">Easy Re-Order</a></li>
            </ul>
        </li>
    <?php endif; ?>
    <li class="has-submenu pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>coupon">Super special offers</a></li><!--ข้อเสนอพิเศษจากพาร์ทเนอร์-->
    <li class="has-submenu pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>how-cost-fit-works">How Works</a></li>
</ul>