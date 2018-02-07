<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$UserAgent = common\helpers\GetBrowser::UserAgent();
if (Yii::$app->controller->action->id != 'elastic-search') {
    $urlSearch = Yii::$app->homeUrl . 'search/cozxy-product/';
    //$urlSearch = Yii::$app->homeUrl . 'search/elastic-search/';
} else {
    $urlSearch = Yii::$app->homeUrl . 'search/elastic-search/';
}
?>

<div class="bg-yellow1 topbar">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-12 pull-right text-right"><a href="#" class="dismiss visible-md visible-lg hidden-xs hidden-sm"><i class="fa fa-close fc-black"></i></a></div>
            <div class="col-md-3 col-sm-4 col-xs-6 size12-xs"><!--<i class="fa fa-phone"></i>--><?= Html::img(Url::home() . 'imgs/i-phone.png') ?>&nbsp;&nbsp;Hotline: 064-184-7414 &nbsp; </div>
            <div class="col-md-7 col-sm-5 col-xs-6 size12-xs"><!--<i class="fa fa-truck"></i>--><?= Html::img(Url::home() . 'imgs/i-truck.png') ?>&nbsp;&nbsp;Free Shipping &nbsp; </div>
        </div>
    </div>
</div>
<div class="topOpener"></div>
<div class="bg-black headbar">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 <?= isset(Yii::$app->user->id) ? 'col-xs-4' : 'col-xs-12' ?>" style="<?= ($UserAgent == 'mobile') ? 'margin-top: 15px;' : ''; ?>"><a href="<?= Url::to(['/']) ?>"><?= Html::img(Url::home() . 'imgs/cozxy.png', ['class' => 'img-responsive']) ?></a></div>
            <div class="col-md-3 col-sm-6 <?= isset(Yii::$app->user->id) ? 'col-xs-8' : 'col-xs-12' ?> pull-right text-right " style="<?= ($UserAgent == 'mobile') ? 'padding-right: 0px; text-align: left;' : ''; ?>">
                <div class="row user-menu" style="margin-right: -1px;    margin-top: 0px;">
                    <?php
                    if (isset(Yii::$app->user->identity->userId)) {
                        //echo '<div class="col-xs-3">' . Html::a('&nbsp;', Yii::$app->homeUrl . 'my-account', ['class' => 'u-menu-1']) . '</div>';
                    } else {
                        echo '';
                    }
                    ?>
                    <div class="col-xs-3 <?= isset(Yii::$app->user->id) ? 'col-xs-offset-1' : '' ?>">
                        <a href="<?php echo Yii::$app->homeUrl; ?><?= isset(Yii::$app->user->id) ? 'my-account?act=my-shelves' : 'site/login' ?>" class="u-menu-2 tooltip-bottom" data-tooltip="MY SHELVES">&nbsp;</a>
                    </div>
                    <div class="col-xs-3 "><?= Html::a('&nbsp;', Yii::$app->homeUrl . 'cart', ['class' => 'u-menu-3 tooltip-bottom', 'data-tooltip' => 'CART']) ?>
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
                                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu" style="z-index: 99999; min-width: 153px;">
                                    <li><a href="<?= Yii::$app->homeUrl ?>my-account?act=account-detail">ACCOUNT DETAIL</a></li>
                                    <li><a href="<?= Yii::$app->homeUrl ?>my-account?act=order-history">ORDER HISTORY</a></li>
                                    <li><a href="<?= Yii::$app->homeUrl ?>my-account?act=my-shelves">MY SHELVES</a></li>
                                    <li><a href="<?= Yii::$app->homeUrl ?>my-account?act=stories">MY STORIES</a></li>
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
                    <?php $form = ActiveForm::begin(['id' => 'register-form', 'method' => "get", 'action' => $urlSearch, 'options' => ['class' => 'registr-form']]); ?>
                    <div class="align-center align-middle fullwidth">
                        <input type="text" name="search" id="search" class="search-input" placeholder="SEARCH PRODUCT" value="<?= isset($_GET["search"]) ? $_GET["search"] : NULL ?>">
                    </div>
                    <div class="align-middle text-right" style="width:120px; right:0;">
                        <input type="submit" value="SEARCH" class="search-btn bg-yellow3">
                    </div>
                    <div class="align-middle text-right size24" style="width:32px; padding-top: 8px;">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </div>
                    <?= $this->registerJS("
//                                $('#search').blur(function(event){
//                                    if(event.which == 13 || event.keyCode == 13)
//                                    {
//                                       $('#register-form').submit();
//                                    }
//                                });
                    ") ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Nav [PC] -->
<div class="bg-white menubar hidden-sm hidden-xs">
    <div class="container">
        <div class="row">
            <a href="#" class="menu-category" data-toggle="collapse" data-target="#categories" style="color: #000000;">CATEGORIES &nbsp;</a>
            <a href="#" class="menu-category" data-toggle="collapse" data-target="#categories" style="color: #000000;">CLEARANCE &nbsp;</a>
            <a href="#" class="menu-category" data-toggle="collapse" data-target="#categories" style="color: #000000;">POMOTION &nbsp;</a>
            <a href="#" class="menu-category" data-toggle="collapse" data-target="#categories" style="color: #000000;">BRANDS <span class="size12">(mouse over)</span>&nbsp;</a>
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
                        foreach ($this->params['cate'] as $key => $value) {
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
<div class="bg-white menubar hidden-lg hidden-md">
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

", \yii\web\View::POS_END);
?>
