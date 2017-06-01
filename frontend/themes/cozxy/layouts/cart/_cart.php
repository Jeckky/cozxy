<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

\frontend\assets\CartAsset::register($this);
$this->title = "Cart";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <!-- Cart -->
        <?php
        $form = ActiveForm::begin([
                    'id' => 'default-shipping-cart',
                    'action' => Yii::$app->homeUrl . 'checkout',
                    'options' => ['class' => 'space-bottom'],
        ]);
        ?>
        <div class="col-lg-9 col-md-8 cart-body">
            <div class="row">
                <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
                    <p class="size20 size18-xs">YOUR CART</p>
                </div>
                <input type="hidden" name="orderId" value="<?= $this->params['cart']['orderId'] ?>">
                <div class="col-xs-12 bg-white">
                    <!--Cart Items-->
                    <?php
                    //throw new \yii\base\Exception(print_r($this->params['cart']['orderId'], true));
                    foreach ($this->params['cart']['items'] as $item) {
                        // throw new \yii\base\Exception(print_r($item["image"], true));
                        ?>
                        <?= $this->render('_cart_item', compact('item')); ?>
                        <?php
                    }
                    ?>
                    <!-- E -->
                    <div class="col-xs-12 text-right">
                        <a href="<?= Url::to(['/search/cozxy-product']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">CONTINUE
                            SHOPPING</a> &nbsp;
                        <input type="submit" value="CHECK OUT" class="b btn-yellow">
                    </div>
                    <div class="size12 size10-xs">&nbsp;</div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <!-- Total -->
        <div class="col-lg-3 col-md-4">
            <?= $this->render('_cart_total') ?>
        </div>

    </div>
</div>

<div class="size32">&nbsp;</div>