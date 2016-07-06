<?php
// echo Yii::$app->homeUrl . Yii::$app->controller->id;
//echo 'Test =' . Yii::$app->homeUrl;
//echo '<br>' . Yii::$app->controller->id;
?>
<ul class="catalog" id="catalog_new" style="width: 100%;">
    <li class="has-submenu pull-left"><a href="#">Categories<i class="fa fa-chevron-down open"></i></a>
        <ul class="submenu">
            <li class="has-submenu"><a href="#" style="font-size: 14px;">Electricals & Electronics <i class="fa fa-chevron-down"></i></a>
                <ul class="sub-submenu">

                    <a href="<?php echo Yii::$app->homeUrl; ?>search?category=24" class="menu-catalog-title-color" style="color: #000;">เครื่องใช้ไฟฟ้าภายในบ้าน</a>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">coffee</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Tea</a></li>

                    <a href="<?php echo Yii::$app->homeUrl; ?>search?category=24" class="menu-catalog-title-color" style="color: #000;">TV & Home Entertainment</a>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Television</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Home Theater</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Blu ray Player</a></li>
                    <li> <a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Accessories</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">MP 3</a></li>

                    <a href="<?php echo Yii::$app->homeUrl; ?>search?category=24" class="menu-catalog-title-color" style="color: #000;">เครื่องใช้ไฟฟ้าในครัว</a>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Chips & Pretzels</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Cookies</a></li>

                    <a href="<?php echo Yii::$app->homeUrl; ?>search?category=24" class="menu-catalog-title-color" style="color: #000;">Mobile & Tablet</a>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Chips & Pretzels</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Cookies</a></li>

                    <a href="<?php echo Yii::$app->homeUrl; ?>search?category=24" class="menu-catalog-title-color" style="color: #000;">Mobile & Tablet</a>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Chips & Pretzels</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Cookies</a></li>

                </ul>
            </li>
            <li class="has-submenu"><a href="#" style="font-size: 14px;">Hardware <i class="fa fa-chevron-down"></i></a>
                <!--Class "has-submenu" for adding carret and dropdown-->
                <ul class="sub-submenu">
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Television</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Home Theater</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Blu ray Player</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Accessories</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">MP 3</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="#" style="font-size: 14px;">Health and Beauty <i class="fa fa-chevron-down"></i></a>
                <ul class="sub-submenu">
                    <a href="<?php echo Yii::$app->homeUrl; ?>search?category=24" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">coffee</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Tea</a></li>
                    <a href="<?php echo Yii::$app->homeUrl; ?>search?category=24" class="menu-catalog-title-color" style="color: #000;">Snack Foods</a>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Chips & Pretzels</a></li>
                    <li><a href="<?php echo Yii::$app->homeUrl; ?>search?category=24">Cookies</a></li>
                </ul>
            </li>
            <!--<li class="offer">
                <div class="col-1">
                    <p class="p-style2">
                        &nbsp;  Select Categories
                    </p>
                </div>
            </li>-->
        </ul>
    </li>
    <li class="has-submenu pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>coupon">ข้อเสนอพิเศษจากพาร์ทเนอร์</a></li>
    <?php if (Yii::$app->controller->id == 'site' or Yii::$app->controller->id == 'register') { ?>
        <li class="has-submenu pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>how-cost-fit-works">How cost.fit Works</a></li>
    <?php } else if (Yii::$app->controller->id == 'history' or Yii::$app->controller->id == 'profile' or Yii::$app->controller->id == 'payment' or Yii::$app->controller->id == 'coupon') { ?>
        <li class="has-submenu pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>profile">My Profile</a></li>
        <li class="has-submenu pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>history">Order History</a></li>
        <li class="has-submenu pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>payment">Payment Methosds</a></li>
    <?php } else if (Yii::$app->controller->id != 'history') { ?>
        <li class="has-submenu pill-right"><a href="<?php echo Yii::$app->homeUrl; ?>history">Easy Re-Order</a></li>
        <?php } ?>
</ul>