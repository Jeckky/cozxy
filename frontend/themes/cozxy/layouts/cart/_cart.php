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
            'id' => 'cart-item',
            'action' => Yii::$app->homeUrl . 'checkout',
            'options' => ['class' => 'space-bottom'],
        ]);
        ?>
        <div class="col-lg-9 col-md-8 cart-body">
            <div class="row">
                <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
                    <p class="size20 size18-xs">CART</p>
                </div>
                <input type="hidden" name="orderId" value="<?= isset($this->params['cart']['orderId']) ? $this->params['cart']['orderId'] : '' ?>">
                <div class="col-xs-12 col-sm-12 col-md-12 bg-white">
                    <!--Cart Items-->
                    <?php
                    //throw new \yii\base\Exception(print_r($this->params['cart']['orderId'], true));
                    foreach ($this->params['cart']['items'] as $item) {
                        //throw new \yii\base\Exception(print_r($this->params['cart']['items'], true));
                        ?>
                        <?= $this->render('_cart_item', compact('item')); ?>
                        <?php
                    }
                    ?>
                    <!-- E -->
                    <div class="col-xs-12 text-right">
                        <a href="<?= Url::to(['/']) ?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">CONTINUE
                            SHOPPING</a> &nbsp;
                        <?php
                        if (isset($this->params['cart']['orderId']) && count($this->params['cart']['items']) > 0) {
                            // throw new \yii\base\Exception(print_r($this->params['cart']['items'], true));
                            ?>
                            <input type="button" value="CHECK OUT" class="b btn-yellow" id="checkout-btn" onclick="javascript:checkItemInOrder(<?= $this->params['cart']['orderId'] ?>)">
                        <?php } ?>
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
<style>
    #notEnough .modal-dialog{
        width:70%;
    }
</style>
<div class="modal fade" id="notEnough">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow3">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
                <h3 class="modal-title">ITEMS SOLD OUT</h3>
            </div>
            <div style="padding: 15px;">Sorry, this item is no longer available. Please remove it from your cart. Add them to your wishlist and we’ll let you know when it’s back in stock!</div>

            <div class="modal-body" id="soldoutItem">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-yellow" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($fc)) {
    // throw new \yii\base\Exception($fc);
    if ($fc == 1) {
        $js = 'javascript:checkItemInOrder(' . $this->params['cart']['orderId'] . ')';
        $this->registerJs($js);
    }
}
?>