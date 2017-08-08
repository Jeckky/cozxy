<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerCss("
    #notify-cart-top-menu{
        display: block;  margin: 0; font-size: 12px;  padding:4px;
        line-height: 1; font-weight: 400; position: absolute; top: -1px;
        right:5px;color: #000 !important;  background-color: #fee60a; border: 1px #000 solid;
    }
    #rcorners1 {
        /*border-radius: 10px;
        padding: 20px;
        width: 150px;
        height: 43px;
        margin-top: 10px;*/
        border-radius: 10px;
        /* padding: 20px; */
        width: 150px;
        height: 43px;
        margin-top: 11px;
        line-height: 43px;
        word-break: break-all;
        text-align: center;
        font-weight: 700;
        font-style: normal;
    }

    .w3-theme {
        color: #000 !important;
        background-color: #fee60a !important;
        background-color: #fee60a !important;
    }

    .menu {
        border-top: 1px solid #f5f3ef;
        font-family: 'PT Sans Narrow', sans-serif;
    }
    .dropdown:hover > .dropdown-menu {
        display: block;
        margin-top: 10px;
    }


    .menuWrapper {
        list-style-type: none;
        padding-left: 0;
        margin: 0 auto;
        font-size: 0;
        box-sizing: padding-box;
    }

    .dropdown {
        /* width: 130.9px; */
        display: inline-block;
        /* padding: 40px 10px 35px; */
        /* border: 1px solid #f5f3ef; */
        font-size: 11px;
        text-align: center;
    }

    .dropdown-menu {
        padding: 0;
        margin-top: 10px;
    }
    .dropdown-menu > li > a {
        padding: 20px 20px;
    }
    .dropdown-submenu {
        position: relative;
    }
    .dropdown-submenu > .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: 8px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }
    .dropdown-menu li {
        border-bottom: 1px solid #f5f3ef;
    }
    .dropdown-menu li:last-child {
        border-bottom: none;
    }
    .dropdown-submenu > .dropdown-menu:before {
        content: '';
        position: absolute;
        bottom: 80%;
        left: -6px;
        border-bottom: 5px solid transparent;
        border-right: 5px solid rgba(255, 255, 255, 0.9);
        border-top: 5px solid transparent;
        border-right-color: #ffffff;
    }
    .dropdown-submenu > .dropdown-menu:after {
        content: '';
        position: absolute;
        bottom: 62%;
        left: -11px;
        width: 7%;
        height: 70px;
        background: transparent;
    }
    .dropdown-menu-title:after {
        content: '';
        position: absolute;
        bottom: -13%;
        left: -11px;
        width: 117%;
        height: 20px;
        background: transparent;
    }
    .dropdown-submenu:hover > .dropdown-menu {
        display: block;
    }
    .dropdown-submenu > a:after {
        display: block;
        content: '';
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }
    .dropdown-submenu:hover > a:after {
        border-left-color: #fff;
    }
    .dropdown-submenu.pull-left {
        float: none;
    }
    .dropdown-submenu.pull-left > .dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }
    .dropdown-menu > li > a:hover,
    .dropdown-menu > li > a:focus {
        color: inherit;
        text-decoration: none;
        background: transparent;
        padding-bottom: 15px;
        border-bottom: 5px solid #fee60a;
    }
    .dropdown-menu.multi-level:before {
        position: absolute;
        top: -7px;
        left: 9px;
        display: inline-block;
        border-right: 7px solid transparent;
        border-bottom: 7px solid #ccc;
        border-left: 7px solid transparent;
        border-bottom-color: rgba(0, 0, 0, 0.2);
        content: '';
    }
    .dropdown-menu.multi-level:after {
        position: absolute;
        top: -6px;
        left: 10px;
        display: inline-block;
        border-right: 6px solid transparent;
        border-bottom: 6px solid #ffffff;
        border-left: 6px solid transparent;
        content: '';
    }


    .dropdown-menu {
        padding: 0;
        margin-top: 10px;
    }


    .dropdown-menu>li>a {
        padding: 20px 20px;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 105%;
        margin-top: -6px;
        margin-left: 0px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }
    .dropdown-menu li {
        border-bottom: 1px solid #f5f3ef;
    }
    .dropdown-menu li:last-child {
        border-bottom: none;
    }


    .dropdown-submenu>.dropdown-menu:before {
        content: '';
        position: absolute;
        bottom: 80%;
        left: -6px;
        border-bottom: 5px solid transparent;
        border-right: 5px solid rgba(255,255,255,0.9);
        border-top: 5px solid transparent;
        border-right-color: rgba(255,255,255,1);
    }


    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .dropdown-submenu>a:after {
        display: block;
        content: '';
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }

    .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
    }

    .dropdown-submenu.pull-left {
        float: none;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }

    .dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
        color: inherit;
        text-decoration: none;
        padding-bottom: 0;
        background: transparent;
        padding-bottom: 15px;
        border-bottom: 5px solid #fee60a;
    }

    .dropdown-menu.multi-level:before {
        position: absolute;
        top: -7px;
        left: 9px;
        display: inline-block;
        border-right: 7px solid transparent;
        border-bottom: 7px solid #ccc;
        border-left: 7px solid transparent;
        border-bottom-color: rgba(0, 0, 0, 0.2);
        content: '';
    }

    .dropdown-menu.multi-level:after {
        position: absolute;
        top: -6px;
        left: 10px;
        display: inline-block;
        border-right: 6px solid transparent;
        border-bottom: 6px solid #ffffff;
        border-left: 6px solid transparent;
        content: '';
    }
");
?>

<div class="bg-yellow1 topbar">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-12 pull-right text-right"><a href="#" class="dismiss"><i class="fa fa-close fc-black"></i></a></div>
            <div class="col-md-3 col-sm-4 col-xs-6 size12-xs"><!--<i class="fa fa-phone"></i>--><?= Html::img(Url::home() . 'imgs/i-phone.png') ?>&nbsp;&nbsp;Hotline: 098-394-859 &nbsp; </div>
            <div class="col-md-7 col-sm-5 col-xs-6 size12-xs"><!--<i class="fa fa-truck"></i>--><?= Html::img(Url::home() . 'imgs/i-truck.png') ?>&nbsp;&nbsp;Free Shipping &nbsp; </div>
        </div>
    </div>
</div>

<div class="bg-black headbar">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12"><a href="<?= Url::to(['/']) ?>"><?= Html::img(Url::home() . 'imgs/cozxy.png') ?></a></div>
            <div class="col-md-3 col-sm-6 col-xs-12 pull-right text-right ">
                <div class="row user-menu">
                    <?php
                    if (isset(Yii::$app->user->identity->userId)) {
                        //echo '<div class="col-xs-3">' . Html::a('&nbsp;', Yii::$app->homeUrl . 'my-account', ['class' => 'u-menu-1']) . '</div>';
                    } else {
                        echo '';
                    }
                    ?>
                    <div class="col-xs-3 <?= isset(Yii::$app->user->id) ? 'col-xs-offset-2' : '' ?>">
                        <a href="<?php echo Yii::$app->homeUrl; ?><?= isset(Yii::$app->user->id) ? 'my-account?act=2' : 'site/login' ?>" class="u-menu-2 ">&nbsp;</a>
                    </div>
                    <div class="col-xs-3 "><?= Html::a('&nbsp;', Yii::$app->homeUrl . 'cart', ['class' => 'u-menu-3']) ?>
                        <?php
                        if (Yii::$app->user->id != '') {
                            $Product = \common\models\costfit\Order::find()->where('userId =' . \Yii::$app->user->id . ' and status=0')->one();
                            if (count($Product) > 0) {
                                $orderItem = \common\models\costfit\OrderItem::find()->where('orderId=' . $Product['orderId'])->sum('quantity');
                                if (isset($orderItem)) {
                                    $quantity = (int) $orderItem;
                                } else {
                                    $quantity = '';
                                }
                            } else {
                                $quantity = '';
                            }
                        } else {
                            $order = \common\models\costfit\Order::getOrder();
                            if (isset($order->attributes['orderId'])) {

                                $orderId = $order->attributes['orderId'];
                                $Product = \common\models\costfit\Order::find()->where('orderId =' . $orderId . ' and status=0')->one();
                                if (count($Product) > 0) {
                                    $orderItem = \common\models\costfit\OrderItem::find()->where('orderId=' . $Product['orderId'])->sum('quantity');
                                    if (isset($orderItem)) {
                                        $quantity = (int) $orderItem;
                                    } else {
                                        $quantity = '';
                                    }
                                } else {
                                    $quantity = '';
                                }
                            } else {
                                $quantity = '';
                            }
                        }
                        if (Yii::$app->user->id != '') {
                            ?>
                            <span id="notify-cart-top-menu"><?php echo $quantity; ?></span>
                            <?php
                        } else {
                            ?>
                            <span id="<?php if (isset($order->attributes['orderId'])) { ?>notify-cart-top-menu<?php } else { ?>notify-cart-top-menu<?php } ?>"><?php echo $quantity; ?></span>
                        <?php } ?>
                    </div>
                    <?php
                    if (isset(Yii::$app->user->identity->userId)) {
                        ?>
                        <div class="col-xs-3 menuWrapper">
                            <div class="dropdown">
                                <a href="#" class="dropdown-menu-title u-menu-1"  id="dLabel" data-toggle="dropdown" data-target="#"></a>
                                <?php
                                //echo Html::a('&nbsp;', Yii::$app->homeUrl . 'site/logout', ['class' => 'u-menu-4']);
                                //echo Html::a('&nbsp;', Yii::$app->homeUrl . 'my-account', ['class' => 'u-menu-1 ']);
                                ?>
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu" style="z-index: 99999;">
                                    <li><a href="<?= Yii::$app->homeUrl ?>my-account#account">ACCOUNT DETAIL</a></li>
                                    <li><a href="<?= Yii::$app->homeUrl ?>my-account#order-history">ORDER HISTORY</a></li>
                                    <li><a href="<?= Yii::$app->homeUrl ?>my-account#my-shelves">MY SHELVES</a></li>
                                    <li><a href="<?= Yii::$app->homeUrl ?>my-account#my-stories">MY STORIES</a></li>
                                    <li><a href="<?= Yii::$app->homeUrl ?>site/logout">LOGOUT</a></li>
                                    <li class="dropdown-submenu">
                                        <!-- <a data-toggle="dropdown" tabindex="-1" href="#">Hover me for more options</a>
                                         <ul class="dropdown-menu">
                                             <li><a tabindex="-1" href="<?= Yii::$app->homeUrl ?>my-account">ACCOUNT DETAIL</a></li>
                                             <li><a href="#">ORDER HISTORY</a></li>
                                             <li><a href="#">MY SHELVES</a></li>
                                             <li><a href="#">MY STORIES</a></li>
                                             <li><a href="<?= Yii::$app->homeUrl ?>site/logout">LOGOUT</a></li>
                                         </ul>-->
                                    </li>
                                </ul>
                            </div>

                        </div>
                    <?php } else { ?>
                        <div class="col-xs-6">
                            <a href = "<?= Yii::$app->homeUrl ?>site/login">
                                <p id = "rcorners1" class = "w3-theme">LOGIN / REGISTER</p>
                            </a>
                        </div>
                        <?php
                    }
                    if (isset($_GET["search"]) && !empty($_GET['search'])) {
                        $search = $_GET["search"];
                    } else {
                        $search = '';
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="rela" style="height: 64px;">
                    <?php $form = ActiveForm::begin(['id' => 'register-form', 'method' => "get", 'action' => Yii::$app->homeUrl . 'search/cozxy-product/', 'options' => ['class' => 'registr-form']]); ?>
                    <div class="align-center align-middle fullwidth">
                        <input type="text" name="search" id="search" class="search-input" placeholder="SEARCH PRODUCT" value="<?= isset($_GET["search"]) ? $_GET["search"] : NULL ?>">
                    </div>
                    <div class="align-middle text-right" style="width:120px; right:0;">
                        <input type="submit" value="SEARCH" class="search-btn bg-yellow3">
                    </div>
                    <div class="align-middle text-right size24" style="width:32px; padding-top: 8px;">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="bg-black menubar hidden-md hidden-sm hidden-xs">
    <div class="container">
        <div class="row">
<?php
/* $category = \common\models\costfit\ProductSuppliers::find()
  ->select('`product_suppliers`.categoryId , `category`.title , count(`product_suppliers`.`categoryId`)')
  ->join("LEFT JOIN", "category", "category.categoryId=product_suppliers.categoryId")
  ->where("approve = 'approve'")
  ->groupBy('`product_suppliers`.categoryId')
  ->orderBy('count(`product_suppliers`.`categoryId`) ASC')
  ->limit(11)
  ->all();
  foreach ($category as $value) {
  $params = \common\models\ModelMaster::encodeParams(['categoryId' => $value->categoryId]);
  $strtoupper = strtoupper($value->title);
  $strtolower = strtolower($value->title);
  echo \yii\helpers\Html::a("$strtoupper", ['/search/' . $value->createTitle() . '/' . $params . '?c=' . $strtolower], ['class' => 'menu-item']) . '<span style="color: #fc0;">|</span>';
  } */
?>
        </div>
    </div>
</div>-->
<!-- Categories Nav [PC] -->
<div class="bg-black menubar hidden-sm hidden-xs">
    <div class="container">
        <div class="row">
            <a href="#" class="menu-category" data-toggle="collapse" data-target="#categories">CATEGORIES &nbsp; <i class="fa fa-angle-down size18"></i></a>
        </div>
    </div>
</div>

<div class="categories-submenu hidden-sm hidden-xs">
    <div class="collapse" id="categories">
        <div class="container">
            <div class="row">
                <!-- Main Category -->
                <div class="col-lg-2 col-md-4">
                    <div class="row main-category">
                        <?php
                        //$cate = common\models\costfit\Category::find()->where('parentId IS NULL')->all();
                        $cate = \common\models\costfit\CategoryToProduct::find()
                        ->select('`category`.categoryId , `category`.title , `category`.parentId ')
                        ->join("LEFT JOIN", "category", "category.categoryId = category_to_product.categoryId")
                        ->where("parentId IS NULL")
                        ->groupBy('category_to_product.categoryId')
                        //->orderBy('count(`product_suppliers`.`categoryId`) ASC')
                        ->all();
                        foreach ($cate as $key => $value) {
                            ?>
                            <div class="menu-item sub-<?= $value['categoryId'] ?>"><a href="<?= Yii::$app->homeUrl . 'search/' . common\models\ModelMaster::createTitleArray($value['title']) . '/' . common\models\ModelMaster::encodeParams(['categoryId' => $value['categoryId']]) ?>" onmouseover="categoryLoad(<?= $value['categoryId'] ?>);"><?= $value['title'] ?></a><a class="mob-only" href="javascript:categoryMob(<?= $value['categoryId'] ?>);"><i class="fa fa-angle-right size18"></i></a></div>
                        <?php } ?>
                    </div>
                </div>
                <!-- Sub Category -->
                <div class="sr-only">
                    <!-- Item 1 -->
                    <?php
                    foreach ($this->params['actionTreeSub'] as $key => $value) {
                        //echo common\models\ModelMaster::createTitleArray($value['title']);
                        ?>
                        <div class="sub-item-<?= $value['categoryId'] ?>">
                            <?php
                            if (isset($value['Children'])) {
                                //echo 'count :' . count($value['Children']);
                                foreach ($value['Children'] as $key => $items) {
                                    ?>
                                    <div class="sub-cate"><a href="<?= Yii::$app->homeUrl . 'search/' . common\models\ModelMaster::createTitleArray($items['title']) . '/' . common\models\ModelMaster::encodeParams(['categoryId' => $items['categoryId']]) ?>"><?= $items['title'] ?></a></div>
                                    <?php
                                    if (isset($items['Children'])) {
                                        ?>
                                        <div class="row sub-items">
                                            <?php
                                            foreach ($items['Children'] as $key => $sub) {
                                                ?>
                                                <div class="col-md-4"><a href="<?= Yii::$app->homeUrl . 'search/' . common\models\ModelMaster::createTitleArray($sub['title']) . '/' . common\models\ModelMaster::encodeParams(['categoryId' => $sub['categoryId']]) ?>" class="fc-yellow2">– <?= $sub['title'] ?></a></div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <!-- Item End -->
                </div>
                <!-- End Category -->
                <div class="col-lg-6 col-md-8 sub2menu" style="display:none;">
                    <div class="row loadCategory"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Categories Nav [SmartPhone] -->
<div class="bg-black menubar hidden-lg hidden-md">
    <div class="container">
        <div class="row">
            <a href="#" class="menu-category mobcategories">&nbsp; CATEGORIES &nbsp;</a><a href="#" class="menu-category mobcategories pull-right">&nbsp; <i class="fa fa-navicon size20"></i> &nbsp;</a>
        </div>
    </div>
</div>
<div class="xs-category" style="display:none;">
    <div class="mob-box">
        <div class="mob-category">
            <div class="bg-black"><a href="javascript:xscategoryOff();"><span class="fc-white size20">&nbsp; <i class="fa fa-close"></i> &nbsp; CLOSE</span></a></div>
            <div class="mob-maincate"></div>
        </div>
        <div class="mob-s-category">
            <div class="bg-black"><a href="javascript:xscategoryBack();"><span class="fc-white size20">&nbsp; <i class="fa fa-angle-left"></i> &nbsp; BACK</span></a></div>
            <div class="mob-subcate"></div>
        </div>
    </div>
</div>
<?php
$this->registerJs("
         $(function() {
            $('.dropdown-submenu').on('hover',function() {
                $(this).find('.dropdown-menu').css('display', 'block');

            })
            $('.menuWrapper').on('hover', '.dropdown', function() {
                $(this).find('.dropdown-menu.multi-level').css('display', 'block');
        })
", \yii\web\View::POS_HEAD);
?>
