<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
//use \yii\jui\DatePicker;
use kartik\date\DatePicker;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$orderIdParams = \common\models\ModelMaster::encodeParams(['orderId' => $order->orderId]);

//echo '<pre>';
//print_r($order->attributes);
?>


<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row" style="background-color: #fff;">

        <div class="col-lg-9 col-md-8 cart-body">
            <?= $this->render('@app/themes/cozxy/layouts/order/purchase_order', ['order' => $order]) ?>
            <hr>
            <?php
            if (isset($trackingOrder) && !empty($trackingOrder)) {
                ?>
                <h4>
                    <strong><i class="fa fa-truck" aria-hidden="true"></i> Tracking Order</strong>
                </h4>
                <div class="col-lg-12 col-md-12 cart-body">
                    <?= $this->render('@app/themes/cozxy/layouts/my-account/_tracking', ['trackingOrder' => $trackingOrder]) ?>
                    <br>
                    <div class="text-right">
                        <a href="<?= \Yii::$app->homeUrl ?>my-account?act=order-history" class="b btn-yellow size16" style="margin:24px auto 12px"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go to My Account</a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="col-lg-3 col-md-4">
            <?=
            $this->render('@app/themes/cozxy/layouts/order/_order_summary_cozxy_coin', [
                'order' => $order,
                'userPoint' => $userPoint
            ])
            ?>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>
