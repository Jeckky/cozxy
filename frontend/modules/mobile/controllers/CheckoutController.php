<?php

namespace frontend\modules\mobile\controllers;

use Yii;
use yii\web\Controller;
use \yii\helpers\Json;

/**
 * Default controller for the `mobile` module
 */
class CheckoutController extends Controller
{

    public function actionSendPayment()
    {
        $isMcc = false;
//        $model = \common\models\areawow\UserPayment::find()->where("userPaymentId=" . $_GET["id"])->one();
//        $package = \common\models\areawow\Package::find()->where("packageId = $model->packageId")->one();
        //URL Test
        $sendUrl = "https://uatkpgw.kasikornbank.com/pgpayment/payment.aspx";
        //URL Test
        //
        //Production URL
        //$sendUrl = "https://rt05.kasikornbank.com/pgpayment/payment.aspx";
        ////Production URL
        //

        // Standard Thai Bath
        if (!$isMcc):
            $merchantId = "401001605782521";
            $terminalId = "70352178";
        // Standard  Thai Bath
        else:
            //
            // MCC USD
            $merchantId = "402001605782521";
            $terminalId = "70352180";
        // MCC USD
        endif;
//        throw new \yii\base\Exception(str_replace(".", "", $package->price));
//        $amount = str_replace(".", "", $package->price);
        $amount = str_replace(".", "", 100000);
        $url = "http://" . Yii::$app->getRequest()->serverName . "/user/payment-result";
//        $url = "http://dev/areawow-frontend/user/payment-result";
        $resUrl = "http://" . Yii::$app->getRequest()->serverName . "/user/payment-result";
        $cusIp = Yii::$app->getRequest()->getUserIP();
//        $description = "Buy Package " . $package->title;
        $description = "Buy Package 1";
//        $invoiceNo = $model->paymentNo;
        $invoiceNo = 1;
        $fillSpace = "Y";
        $md5Key = "SzabTAGU5fQYgHkVGU5f4re8pLw5423Q";
        $checksum = md5($merchantId . $terminalId . $amount . $url . $resUrl . $cusIp . $description . $invoiceNo . $fillSpace . $md5Key);
        return $this->render("@app/views/e_payment/_k_payment", compact('sendUrl', 'merchantId', 'terminalId', 'checksum', 'amount', 'invoiceNo', 'description', 'url', 'resUrl', 'cusIp', 'fillSpace'));
    }

}
