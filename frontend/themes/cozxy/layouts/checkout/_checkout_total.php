<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div class="col-xs-12 bg-yellow1" style="padding:18px;">
    <div class="rela size20">
        Summary
    </div>
</div>

<div class="col-xs-12 total-price bg-white checkout-total">
    <div class="row">
        <div class="price-detail">SUBTOTAL
            <div class="pull-right"><?= number_format($this->params['cart']['total'], 2) ?> THB</div>
        </div>
        <div class="price-detail">SHIPPING
            <div class="pull-right"><?= (isset($this->params['cart']['shippingRate']) && $this->params['cart']['shippingRate'] == 0) ? "FREE" : number_format($this->params['cart']['shippingRate'], 2) ?></div>
        </div>
        <div class="price-detail">PROMO CODE
            <div class="pull-right">– THB</div>
        </div>
        <div class="price-detail b size20 size18-sm size18-xs">TOTAL
            <div class="pull-right"><?= number_format($this->params ['cart']['summary'], 2) ?> THB </div>
        </div>
    </div>
    <?php
    $orderId = $this->params['cart']['orderId'];
    // throw new \yii\base\Exception(print_r($order, true));
    ?>
    <a href="<?= Url::to(['/top-up']) ?>" class="b btn-success btn-block text-center" style="padding:12px 32px; margin:12px auto 12px">TOP UP CozxyCoin</a>
    <?php
    if(isset($userPoint) && $userPoint->currentCozxySystemPoint>0){
    ?>
    <a href="" class="b btn-info btn-block text-center" style="padding:12px 32px; margin:12px auto 12px" data-toggle="modal" data-target="#inputSystemCoinModal" id="default-coin">PAY by Cozxy systemCoin<br><span id="text-pay"></span></a>
    <?php
    }
    if (Yii::$app->controller->action->id == 'summary') {
    if (Yii::$app->user->id != '') {
    $currentPoint = common\models\costfit\UserPoint::find()->where('userId=' . Yii::$app->user->id)->one();
    if (isset($currentPoint) > 0) {
    if ($this->params ['cart']['summary'] <= $currentPoint['currentPoint']) {
    if (isset($addressId)) {
    $addressIdx = $addressId;
    } else {
    $addressIdx = '';
    }

    // $k = base64_decode(base64_decode(common\models\ModelMaster::encodeParams(['orderId' => $orderId])));
    // $params = common\models\ModelMaster::decodeParams(common\models\ModelMaster::encodeParams(['orderId' => $orderId]));
    // $orderId = $params['orderId'];
    ?>
    <?php
    $form = ActiveForm::begin([
    'id' => 'default-shipping-address',
    'action' => Yii::$app->homeUrl . 'checkout/order-summary',
    'options' => ['class' => 'space-bottom'],
    ]);
    ?>

    <input type="hidden" id="addressIdsummary" name="addressIdsummary" value="<?= $addressIdx; ?>">
    <input type="hidden" id="orderId" name="orderId" value="<?= $orderId; ?>">
    <!--<a href="<?//= Url::to(['/checkout/order-summary/' . $order->encodeParams(['orderId' => $orderId])]) ?>" class="b btn-yellow fullwidth text-center" style="padding:12px 32px; margin:2px auto 12px">PAY by CozxyCoin</a>-->
    <input type="hidden" id="systemCoin" value="0" name="systemCoin">
    <input type="submit" value="PAY by CozxyCoin" class="b btn-yellow fullwidth">
    <input type="hidden" id="firstCoin" value="<?= isset($userPoint) ? $userPoint->currentCozxySystemPoint : 0 ?>">
    <?php ActiveForm::end(); ?>
    <br>
    <?php
    }
    }
    }
    }
    ?>
</div>
<div class="modal fade" id="inputSystemCoinModal" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i>
                </button>
                <h2>Pay by cozxy systemCoin</h2>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td style="width: 40%;">
                            Your cozxy system coin balacne :
                        </td>
                        <td style="text-align: right;">
                            <b><?= isset($userPoint) ? number_format($userPoint->currentCozxySystemPoint, 2) : '0' ?></b>
                        </td>
                        <td>Cozxy coints</td>
                    </tr>
                    <tr>
                        <td>
                            Order sub Subtotal :
                        </td>
                        <td style="text-align: right;">
                            <b><?= number_format($this->params ['cart']['summary'], 2) ?></b>
                        </td>
                        <td>Cozxy coints</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;" colspan="3">
                            <input type="radio" name="choosePay"  id="allCoin" checked="checked"> Pay all <b><?= isset($userPoint) ? number_format($userPoint->currentCozxySystemPoint, 2) : '0' ?></b> Cozxy coints
                            <input type="hidden" id="allCoinHidden" value="<?= isset($userPoint) ? $userPoint->currentCozxySystemPoint : 0 ?>">

                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;" colspan="3">
                            <input type="radio" name="choosePay" id="chooseCoin"> Some <input type="text" id="inputSystemCoin" placeholder="Input Cozxy system coin" disabled="true">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;" colspan="3">
                            <button id="confirm-payCoin" class="btn btn-success btn-lg" data-dismiss="modal"> Confirm </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button id="cancel-payCoin" class="btn btn-yellow btn-lg" data-dismiss="modal"> Cancel </button>
                        </td>
                    </tr>
                </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>