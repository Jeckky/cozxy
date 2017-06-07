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
    <div class="row">

        <div class="col-lg-9 col-md-8 cart-body">
            <?= $this->render('@app/themes/cozxy/layouts/order/purchase_order', ['order' => $order]) ?>
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
