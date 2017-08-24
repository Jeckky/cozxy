<?php

use yii\helpers\Html;
use yii\helpers\Url;

\frontend\assets\CartAsset::register($this);
?>
<h3 class="modal-title">ITEMS SOLD OUT</h3>
Sorry, this item is no longer available. Please remove it from your cart. Add them to your wishlist and we’ll let you know when it’s back in stock!
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
                <a href="<?= Yii::$app->homeUrl ?>cart" class="btn btn-yellow"><< BACK TO CART</a>
            </div>
        </div>
    </div>
</div>
<script>

</script>
<?php
$js = 'javascript:checkItemInOrder(' . $orderId . ')';
$this->registerJs($js)
?>