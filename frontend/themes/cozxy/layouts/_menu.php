<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<style type="text/css">
    #notify-cart-top-menu{
        display: block;  margin: 0; font-size: 12px;  padding:4px;
        line-height: 1; font-weight: 400; position: absolute; top: -1px;
        right:5px;color: #000 !important;  background-color: #fee60a; border: 1px #000 solid;
    }
</style>
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
            <div class="col-md-3 col-sm-6 col-xs-12 pull-right text-right">
                <div class="row user-menu">
                    <?php
                    if (isset(Yii::$app->user->identity->userId)) {
                        echo '<div class="col-xs-3">' . Html::a('&nbsp;', [Yii::$app->homeUrl . 'my-account'], ['class' => 'u-menu-1']) . '</div>';
                    } else {
                        echo '';
                    }
                    ?>
                    <div class="col-xs-3"><a href="<?php echo Yii::$app->homeUrl; ?>my-account?act=2" class="u-menu-2">&nbsp;</a></div>
                    <div class="col-xs-3"><?= Html::a('&nbsp;', Yii::$app->homeUrl . 'cart', ['class' => 'u-menu-3']) ?>
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
                        <?php } else { ?>
                            <span id="<?php if (isset($order->attributes['orderId'])) { ?>notify-cart-top-menu<?php } else { ?>notify-cart-top-menu<?php } ?>"><?php echo $quantity; ?></span>
                        <?php } ?>
                    </div>
                    <div class="col-xs-3">
                        <?php
                        if (isset(Yii::$app->user->identity->userId)) {
                            echo Html::a('&nbsp;', [Yii::$app->homeUrl . 'site/logout'], ['class' => 'u-menu-4']);
                        } else {
                            echo Html::a('&nbsp;', [Yii::$app->homeUrl . 'site/login'], ['class' => 'u-menu-4']);
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="rela" style="height: 64px;">
                    <?php $form = ActiveForm::begin(['id' => 'register-form', 'action' => Yii::$app->homeUrl . 'search/cozxy-product/', 'options' => ['class' => 'registr-form']]); ?>
                    <div class="align-center align-middle fullwidth"><input type="text" name="search" id="search" class="search-input" placeholder="SEARCH PRODUCT" value="<?= isset($_POST["search"]) ? $_POST["search"] : NULL ?>"></div>
                    <div class="align-middle text-right" style="width:120px; right:0;"><input type="submit" value="SEARCH" class="search-btn bg-yellow3"></div>
                    <div class="align-middle text-right size24" style="width:32px; padding-top: 8px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-black menubar hidden-md hidden-sm hidden-xs">
    <div class="container">
        <div class="row">
            <?php
            $category = \common\models\costfit\ProductSuppliers::find()
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
            }
            ?>
        </div>
    </div>
</div>