<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\data\ActiveDataProvider;
use common\helpers\CozxyUnity;
use common\helpers\PaymentPrint;

/**
 * Payment Controller
 */
class PaymentController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $this->layout_payment = "/content";
        $this->title = 'Cozxy.com | My Profile';
        $this->subTitle = 'Home';
        $this->subSubTitle = "My Profile";

        return $this->render('payment');
    }

    public function actionPrintPurchaseOrder($hash, $title) {

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $orderId = Yii::$app->request->get('OrderNo');
        $this->layout = "payment/content";
        $this->title = 'Cozxy.com | Order Purchase ';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order Purchase";
        $orderId = $params['orderId'];

        if (isset($params['orderId'])) {
            $order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id . ' and orderId = "' . $params['orderId'] . '" ')
            ->one();
        } else {
            return $this->redirect(['profile/order']);
        }

        //return $this->render('@app/views/payment/purchase_order', compact('order'));
        //$content = $this->renderPartial('purchase_order');
        $title = 'ใบสั่งซื้อ​สิน​ค้า​/ใบ​แจ้ง​หนี้';
        $heading = $this->renderPartial('@app/views/payment/heading_order', ['title' => 'ใบสั่งซื้อ​สิน​ค้า​/ใบ​แจ้ง​หนี้']);
        $content = $this->renderPartial('@app/views/payment/purchase_order', compact('order'));
        //$this->actionMpdfDocument($content, $heading, $title);
        CozxyUnity::actionMpdfDocument($content, $heading, $title);
    }

    public function actionPrintPayIn($hash, $title) {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $orderId = Yii::$app->request->get('OrderNo');
        $this->layout = "payment/content";
        $this->title = 'Cozxy.com | Order Purchase ';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order Purchase";
        $orderId = $params['orderId'];

        if (isset($params['orderId'])) {
            $order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id . ' and orderId = "' . $params['orderId'] . '" ')
            ->one();
        } else {
            return $this->redirect(['profile/order']);
        }
        //return $this->render('@app/views/payment/pay_in', compact('order'));
        //$content = $this->renderPartial('purchase_order');
        //exit();
        $title = 'PayIn';
        $heading = $this->renderPartial('@app/views/payment/heading_order', ['title' => 'Pay In']);
        $content = $this->renderPartial('@app/views/payment/pay_in', compact('order'));
        //$this->actionMpdfDocument($content, $heading, $title);
        CozxyUnity::actionMpdfDocument($content, $heading, $title);
    }

    /*
     * Backend Print Receipt v1
     * 10/1/2017
     * By Taninut.Bm
     */

    public function actionPrintReceipt_V1($hash, $title) {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $orderId = Yii::$app->request->get('OrderNo');
        $this->layout = "payment/content";
        $this->title = 'Cozxy.com | Order Purchase ';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order Purchase";
        $orderId = $params['orderId'];

        if (isset($params['orderId'])) {
            $order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id . ' and orderId = "' . $params['orderId'] . '" ')
            ->one();
        } else {
            return $this->redirect(['profile/order']);
        }

        //$content = $this->renderPartial('purchase_order');
        $title = 'Receipt';
        $heading = $this->renderPartial('@app/views/payment/heading_order', ['title' => 'ใบเสร็จ/ใบกำกับภาษี']);
        $content = $this->renderPartial('@app/views/payment/receipt', compact('order'));
        //$this->actionMpdfDocument($content, $heading, $title);
        CozxyUnity::actionMpdfDocument($content, $heading, $title);
    }

    public function actionPrintReceipt($hash, $title) {
        /*
         * "payment/print-receipt/" . $model->encodeParams(['orderId' => $model->orderId]) . '/' . $model->orderNo)
         */
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        /*
         * use common\helpers\CozxyUnity
         * function GetParams($hash, $title)
         * 10/1/2017
         */
        //$params = CozxyUnity::GetParams($hash, $title);
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $orderId = Yii::$app->request->get('OrderNo');
        $this->layout = "payment/content";
        $this->title = 'ใบ​เสร็จ​/ใบ​กํากับ​ภา​ษี บริษัท​ คอ​ซซี่​ ดอทคอม​ จํากัด';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order Purchase";
        $orderId = $params['orderId'];

        if (isset($params['orderId'])) {
            $order = PaymentPrint::GetPrintReceipt(Yii::$app->user->id, $params['orderId']);
        } else {
            return $this->redirect(['profile/order']);
        }

        //$content = $this->renderPartial('purchase_order');
        $title = 'ใบเสร็จ/ใบกำกับภาษี';
        $heading = $this->renderPartial('@app/views/payment/heading_order', ['title' => $title]);
        $content = $this->renderPartial('@app/views/payment/receipt', compact('order'));
        //$this->actionMpdfDocument($content, $heading, $title);
        CozxyUnity::actionMpdfDocument($content, $heading, $title);
    }

}
