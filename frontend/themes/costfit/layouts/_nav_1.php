<style>
    ul#display-inline-block-example,
    ul#display-inline-block-example li {
        /* Setting a common base */
        margin: 0;
        padding: 0;
    }

    ul#display-inline-block-example {
        width: 300px;
        border: 1px solid #000;
    }

    ul#display-inline-block-example li {
        display: inline-block;
        width: 100px;
        min-height: 100px;
        background: #ccc;
        vertical-align: top;

        /* For IE 7 */
        zoom: 1;
        *display: inline;
    }
</style>
<nav class="menu">
    <div class="container">
        <?= $this->render('_nav_main_menu') ?>
    </div>

    <div class="catalog-block ">
        <div class="container">
            <?php //echo $this->render('_nav_sub_menu') ?>
            <ul class="catalog ">
                <li class="has-submenu"><a href="#">Categories<i class="fa fa-chevron-down"></i></a>
                    <ul class="submenu">
                        <span class="offer">
                            &nbsp;
                        </span>
                        <li class="has-submenu"><a href="#">Grocery</a>
                            <ul class="sub-submenu" >
                                <ul style="float: left; width: 40%;">
                                    <a href="#" class="menu-catalog-title-color"  style="color: #000;">Snack Foods</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul style="float: left; width: 40%;">
                                    <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a>
                                        <ul>
                                            <li><a href="#">Bread & Crackers 2.1</a></li>
                                            <li><a href="#">Bread & Crackers 2.2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul style="float: left; width: 40%;">
                                    <a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul style="float: left; width: 40%;">
                                    <a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>

                                <ul style="float: left; width: 40%;">
                                    <a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul style="float: left; width: 40%;">
                                    <a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul style="float: left; width: 40%;">
                                    <a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul style="float: left; width: 40%;">
                                    <a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>

                                <ul style="float: left; width: 40%;">
                                    <a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul style="float: left; width: 40%;">
                                    <a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul style="float: left; width: 40%;">
                                    <a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>

                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Household & Products</a>
                            <ul class="sub-submenu">
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color"  style="color: #000;">Snack Foods</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Houslth & Beauty</a>
                            <ul class="sub-submenu">
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color"  style="color: #000;">Snack Foods</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a>

                                    </li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                                <ul><a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                    <li><a href="#">Bread & Crackers 1</a></li>
                                    <li><a href="#">Bread & Crackers 2</a></li>
                                </ul>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Baby</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Pet Supplies</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Home & Furniture</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Patio & Garden</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Electronics</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Appliances</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Clothing, Shoes & Accessories</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Jewelry & Watches</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Sports & Fitness</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Toys & Video Games</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Book, Music & Movies</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Office Products</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu"><a href="#">Automotive</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <div class="col-md-12">
                                <h1>Earn JetCash</h1>
                            </div>
                            <div class="col-md-12">
                                <h3>Shop 600+ brands across the web and earn savings at Cost.Fit</h3>
                                <a class="btn btn-black" href="#"><span>Shop</span>now</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="has-submenu"><a href="#">Categories 2<i class="fa fa-chevron-down"></i></a>
                    <ul class="submenu">
                        <li class="has-submenu"><a href="#">Electronics</a>
                            <ul class="sub-submenu">
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Beverages</a>
                                <li><a href="#">coffee</a></li>
                                <li><a href="#">Tea</a></li>
                                <a href="#" class="menu-catalog-title-color"  style="color: #000;">Snack Foods</a>
                                <li><a href="#">Chips & Pretzels</a></li>
                                <li><a href="#">Cookies</a></li>
                                <li><a href="#">Bread & Crackers</a>
                                    <ul>
                                        <li><a href="#">Bread & Crackers 1</a></li>
                                        <li><a href="#">Bread & Crackers 2</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Protein & Granola Bars</a></li>
                                <a href="#" class="menu-catalog-title-color" style="color: #000;">Sportd Nutrition & Diet</a>
                                <li><a href="#">Protein & Granola Bars</a></li>
                                <li><a href="#">Protein & Granola Bars</a></li>
                                <li><a href="#">Protein & Granola Bars</a></li>
                                <li><a href="#">Protein & Granola Bars</a></li>
                                <li><a href="#">Protein & Granola Bars</a></li>
                                <li><a href="#">Protein & Granola Bars</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>