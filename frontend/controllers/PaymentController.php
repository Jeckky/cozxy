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

/**
 * Payment Controller
 */
class PaymentController extends MasterController
{

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $this->layout_payment = "/content";
        $this->title = 'Cost.fit | My Profile';
        $this->subTitle = 'Home';
        $this->subSubTitle = "My Profile";

        return $this->render('payment');
    }

    public function actionPrintPurchaseOrder($hash, $title)
    {

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
            $order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id . ' and orderId = "' . $params['orderId'] . '" ')
            ->one();

            /* if (count($Order) == 1) {
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
              } */

            //return $this->render('@app/views/payment/purchase_order', compact('order', 'OrderItemList', 'product_itme', 'OrderId'));
        } else {
            //return $this->redirect(['profile/order']);
        }

        //$content = $this->renderPartial('purchase_order');
        $content = $this->renderPartial('@app/views/payment/purchase_order', compact('order'));
        $this->actionMpdfDocument($content);
    }

    public function actionPrintPayIn()
    {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $this->layout_payment = "/content";
        $this->title = 'Cost.fit | My Profile';
        $this->subTitle = 'Home';
        $this->subSubTitle = "My Profile";

        return $this->render('payment');
    }

}
