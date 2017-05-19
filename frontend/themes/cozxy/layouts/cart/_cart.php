<?php
use yii\helpers\Url;

\frontend\assets\CartAsset::register($this);
?>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <!-- Cart -->
        <div class="col-lg-9 col-md-8 cart-body">
            <div class="row">
                <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
                    <p class="size20 size18-xs">YOUR CART</p>
                </div>
                <div class="col-xs-12 bg-white">
                    <!--Cart Items-->
                    <?php for($i=0;$i<4;$i++):?>
                        <?=$this->render('_cart_item');?>
                    <?php endfor;?>

                    <!-- E -->
                    <div class="col-xs-12 text-right">
                        <a href="<?=Url::to(['/product'])?>" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px">CONTINUE
                            SHOPPING</a> &nbsp;
                        <a href="<?=Url::to(['/checkout'])?>" class="b btn-yellow" style="padding:12px 32px; margin:24px auto 12px">CHECK
                            OUT</a>
                    </div>
                    <div class="size12 size10-xs">&nbsp;</div>
                </div>
            </div>
        </div>

        <!-- Total -->
        <div class="col-lg-3 col-md-4">
            <?=$this->render('_cart_total')?>
        </div>

    </div>
</div>

<div class="size32">&nbsp;</div>