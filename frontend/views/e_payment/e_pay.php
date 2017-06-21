<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Kasikorn Bank PaymentGateway System';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">Kasikorn Bank PaymentGateway System</p>
        </div>
        <div class="col-xs-12 bg-white size18 b" style="padding: 20px;">

            <?=
            $this->render('@app/views/e_payment/_k_payment', [
                'sendUrl' => $sendUrl, 'merchantId' => $merchantId, 'terminalId' => $terminalId, 'checksum' => $checksum, 'amount' => $amount, 'invoiceNo' => $invoiceNo, 'description' => $description, 'url' => $url, 'resUrl' => $resUrl, 'cusIp' => $cusIp, 'fillSpace' => $fillSpace
            ]
            )
            ?>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>
