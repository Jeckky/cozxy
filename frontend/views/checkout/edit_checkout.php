<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\Unit;
use common\models\costfit\OrderItem;
use common\models\costfit\Product;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$form = ActiveForm::begin();
?>
<style type="text/css">
    .hidden-panel.expanded {
        max-height: 1200px;
    }
    .checkbox .iradio, .radio .iradio {
        background: url(../img/forms/radio.png) no-repeat 0 0;
        border: 10px;
    }
    .edit_select checkout_update_address_shipping > .checkout_update_address_shipping{
        border: 10px #000 solid;
    }
    #costfit-select-Billing-address{
        height: 162px;
        overflow-y: auto;
    }
</style>
<section class="checkout">
    <h3 style="text-align: center;">มีรายการสินค้าไม่พอจำหน่าย !</h3>
    <hr>
    <table class="table table-responsive">
        <thead>
            <tr style="text-align: center;">
                <td>No.</td>
                <td>สินค้า</td>
                <td>สั่งซื้อ</td>
                <td>ซื้อได้</td>
                <td>สั่ง</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $items = OrderItem::itemNotEnought($orderId, $id);
            $i = 1;
            foreach ($items as $item):
                ?>
                <tr style="text-align: center;color: #000000;">
                    <td><?= $i ?></td>
                    <td style="text-align: left;"><?= ProductSuppliers::productSupplierName($item->productSuppId)->title ?></td>
                    <td><?= $item->quantity . ' ' . Unit::unitName($item->productSuppId) ?></td>
                    <?php
                    $result = ProductSuppliers::productSupplierName($item->productSuppId)->result;
                    if ($result == 0) {
                        ?>
                        <td>ขออภัยสินค้าหมด</td>
                        <td>ขออภัยสินค้าหมด<input type="hidden" name="quantity[<?= $item->productSuppId ?>]" value="0"></td>
                    <?php } else {
                        ?>
                        <td><?= number_format($result, 2) . ' ' . Unit::unitName($item->productSuppId) ?></td>
                        <td><input type="button" value="+" class="btn-primary plus-btn<?= $item->productSuppId ?>" style="border: 0px;width: 35px;display: none;">
                            <input type="button" value="+" class="btn-primary plus-btn2<?= $item->productSuppId ?>" style="border: 0px;width: 35px;background-color: #cdc9c9;" disabled="true">
                            <input type="text"  class="oldPrice<?= $item->productSuppId ?>" style="width: 35px;text-align: center;" name="quantity[<?= $item->productSuppId ?>]" value="<?= $result ?>">
                            <input type="button" value="-" class="btn-primary minut-btn<?= $item->productSuppId ?>" style="border: 0px;width: 35px;">
                            <input type="button" value="-" class="btn-primary minut-btn2<?= $item->productSuppId ?>" style="border: 0px;width: 35px;background-color: #cdc9c9;display: none;" disabled="true">
                            <input type="hidden" class="maxVal<?= $item->productSuppId ?>" value="<?= $result ?>">
                            <input type="hidden" class="productId<?= $item->productSuppId ?>" value="<?= $item->productSuppId ?>">
                            <input type="hidden" class="supplierId<?= $item->productSuppId ?>" value="<?= $item->supplierId ?>">
                            <?= Html::hiddenInput("fastId", $fastId = Product::getShippingTypeId($item->productId), ['id' => 'fastId' . $item->productSuppId]); ?>
                        </td>

                    <?php } ?>
                </tr>
                <?php
                //throw new \yii\base\Exception($baseUrl);
                $script = "$(document).on('click', '.minut-btn$item->productSuppId', function (e) {
        var oldValue = $(this).parent().find('.oldPrice$item->productSuppId').val();
        var productId = $(this).parent().find('.productId$item->productSuppId').val();
        var supplierId=$(this).parent().find('.supplierId$item->productSuppId').val();
        var fastId = $(this).parent().find('#fastId$item->productSuppId').val();
        var newVal = 1;
        newVal = parseFloat(oldValue) - 1;
        url='/checkout/edit-cart?id='+productId;
        $('.oldPrice$item->productSuppId').val(newVal);
             $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url:url,
            data: {quantity: newVal, fastId: fastId, supplierId: supplierId},
success: function (data)
            {

}
        });
        if (newVal == 0) {
            $('.minut-btn$item->productSuppId').hide();
            $('.minut-btn2$item->productSuppId').show();
            $('.plus-btn2$item->productSuppId').hide();
            $('.plus-btn$item->productSuppId').show();

        }});
        $(document).on('click', '.plus-btn$item->productSuppId', function (e) {
        var oldValue = $(this).parent().find('.oldPrice$item->productSuppId').val();
        var maxValue = $(this).parent().find('.maxVal$item->productSuppId').val();
var productId = $(this).parent().find('.productId$item->productSuppId').val();
        var supplierId=$(this).parent().find('.supplierId$item->productSuppId').val();
        var fastId = $(this).parent().find('#fastId$item->productSuppId').val();
        var newVal = 1;
        newVal = parseFloat(oldValue) + 1;
        url='/checkout/edit-cart?id='+productId;
        $('.oldPrice$item->productSuppId').val(newVal);
            $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url:url,
            data: {quantity: newVal, fastId: fastId, supplierId: supplierId},
success: function (data)
            {

}
});
        if (newVal==maxValue) {
            $('.minut-btn$item->productSuppId').show();
            $('.minut-btn2$item->productSuppId').hide();
            $('.plus-btn2$item->productSuppId').show();
            $('.plus-btn$item->productSuppId').hide();
        }
    });
    $(document).on('keydown', '.oldPrice$item->productSuppId', function (e) {
      return false;
                        })";
                $this->registerJs($script);
                $i++;
            endforeach;
            ?>
        </tbody>
    </table>
    <hr>
    <div class="row">
        <div class="col-lg-12 text-right">
            <?php echo Html::submitButton("ยืนยัน", ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</section>
<?php ActiveForm::end(); ?>



