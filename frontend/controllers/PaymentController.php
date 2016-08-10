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
use kartik\mpdf\Pdf;

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
        $this->title = 'Cost.fit | My Profile';
        $this->subTitle = 'Home';
        $this->subSubTitle = "My Profile";

        return $this->render('payment');
    }

    public function actionPrintPurchaseOrder($hash) {

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $orderId = Yii::$app->request->get('OrderNo');
        $this->layout = "payment/content";
        $this->title = 'Cost.fit | Order Purchase ';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order Purchase";
        $orderId = $params['orderId'];

        //echo htmlspecialchars($orderId);
        //echo $orderId;
        if (isset($params['orderId'])) {
            $Order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id . ' and orderId = "' . $params['orderId'] . '" ')
                    ->all();
            if (count($Order) == 1) {
                $Order = $Order[0]->attributes;
                $OrderItem = \common\models\costfit\OrderItem::find()->where('orderId = ' . $params['orderId'])
                        ->all();
                foreach ($OrderItem as $key => $value) {
                    $OrderItemList[$key]['quantity'] = $value['quantity'];
                    $OrderItemList[$key]['price'] = $value['price'];
                    $OrderItemList[$key]['total'] = $value['total'];

                    $product = \common\models\costfit\product::find()->where('productId = ' . $value['productId'])
                            ->all();
                    foreach ($product as $key => $item1) {
                        $product_itme[] = $product;
                    }
                }
            } else {
                $Order = NULL;
                $OrderItemList = NUll;
                $product_itme = NUll;
            }

            //return $this->render('@app/views/payment/purchase_order', compact('Order', 'OrderItemList', 'product_itme', 'OrderId'));
        } else {
            //return $this->redirect(['profile/order']);
        }

        //$content = $this->renderPartial('purchase_order');
        $content = $this->renderPartial('@app/views/payment/purchase_order', compact('Order', 'OrderItemList', 'product_itme', 'OrderId'));
        // $model = YourModel::findOne($id);
        // $content = $this->renderPartial('print', [ 'model' => $model]);
        // setup kartik\mpdf\Pdf component


        $this->actionMpdfDocument($content);
    }

    public function actionPrintPayIn() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $this->layout_payment = "/content";
        $this->title = 'Cost.fit | My Profile';
        $this->subTitle = 'Home';
        $this->subSubTitle = "My Profile";

        return $this->render('payment');
    }

    // Privacy statement output demo
    public function actionMpdfDocument($content) {
        //$orderId = Yii::$app->request->get('OrderNo');
        // $orderId = $params['orderId'];
        // get your HTML raw content without any layouts or scripts
        // $content = $this->renderPartial('purchase_order');
        // $model = YourModel::findOne($id);
        // $content = $this->renderPartial('print', [ 'model' => $model]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@frontend/web/css/pdf.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            //'cssInline' => 'body{font-size:9px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Cost.fit Print Purchase Order'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => ['Cost.fit Print Purchase Order'], //Krajee Report Header
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);


        // return the pdf output as per the destination setting
        return $pdf->render();
    }

}
