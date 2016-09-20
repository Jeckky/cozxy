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
 * Profile controller
 */
class ProfileController extends MasterController {

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

        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | My Profile';
        $this->subTitle = 'Home';
        $this->subSubTitle = "My Profile";

        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        $model->scenario = 'profile';
        if (isset($_POST["User"])) {
            $model->attributes = $_POST['User'];
            $model->password = $_POST["User"]['newPassword'];  // Normal Password
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password); // Convert Password
            if ($model->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'profile');
            }
        }
        return $this->render('profile', ['model' => $model]);
    }

    public function actionPayment() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        echo $this->iSLogin();
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | ช่องทางการชำระเงิน';
        $this->subTitle = 'Home';
        $this->subSubTitle = "ช่องทางการชำระเงิน";
        return $this->render('@app/views/payment/payment');
    }

    public function actionOrder() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Order History';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order History";

        $searchModel = new \common\models\costfit\Order();
        // $dataProvider = $searchModel->search(Yii::$app->request->get());
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        return $this->render('@app/views/profile/order_history', compact('dataProvider', 'searchModel'));
    }

    public function actionDataAddress() {
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Default Shipping Assdress';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Default Shipping Assdress";
        $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
        //$loginForm = new \common\models\LoginForm();
        $model->type = 1; // default Address First
        $status_address = Yii::$app->controller->action->id;
        if ($status_address == 'billings-address') {
            $label = 'Default billings address';
            $model->isDefault = 1;  // TYPE_BILLING = 1; // ที่อยู่จัดส่งเอกสาร
        } elseif ($status_address == 'shipping-address') {
            $label = 'Default shipping  address';
            $model->isDefault = 2; // TYPE_SHIPPING = 2; // ที่อยู่จัดส่งสินค้า
        } else {
            $label = "";
            $model->isDefault = "";
        }
    }

    public function actionShippingAddress($hash) {

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $addressId = $params['addressId'];

        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Default Shipping Assdress';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Default Shipping Assdress";

        if ($hash != 'add') {
            $model = \common\models\costfit\Address::find()->where("addressId ='" . $addressId . "'")->one();
            $model->scenario = 'shipping_address';
            $action = 'edit';
        } else {
            $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
            $action = 'add';
        }

        $model->type = \common\models\costfit\Address::TYPE_SHIPPING; // default Address First
        $status_address = Yii::$app->controller->action->id;

        $label = 'Save shipping  address';
        //$model->isDefault = 0;
        if (isset($_POST['Address'])) {

            $model->attributes = $_POST['Address'];
            //echo $_POST["Address"]['isDefault'];
            if ($_POST["Address"]['isDefault']) {
                \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'type' => \common\models\costfit\Address::TYPE_SHIPPING]);
                $model->isDefault = 1;
            }
            $model->userId = Yii::$app->user->id;
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'profile');
            }
        }
        return $this->render('@app/views/profile/add_address', ['model' => $model, 'label' => $label, 'action' => $action]);
    }

    public function actionBillingsAddress($hash) {

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $addressId = $params['addressId'];

        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Default Shipping Assdress';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Default Shipping Assdress";
        if ($hash != 'add') {
            $model = \common\models\costfit\Address::find()->where("addressId ='" . $addressId . "'")->one();
            $model->scenario = 'shipping_address';
        } else {
            $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
        }
        $model->type = \common\models\costfit\Address::TYPE_BILLING; // default Address First
        $status_address = Yii::$app->controller->action->id;

        $label = 'Save billings address';

        if (isset($_POST['Address'])) {

            $model->attributes = $_POST['Address'];
            if ($_POST["Address"]['isDefault']) {
                \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'type' => \common\models\costfit\Address::TYPE_BILLING]);
                $model->isDefault = 1;
            }
            $model->userId = Yii::$app->user->id;
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'profile');
            }
        }
        return $this->render('@app/views/profile/add_address', ['model' => $model, 'label' => $label]);
    }

    public function actionAddPaymentMethod() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Default Payment Method';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Default Payment Method";
        return $this->render('@app/views/profile/add_payment_method');
    }

    public function actionEditInfo() {

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Contact Information';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Contact Information";

        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        if (isset($_POST["User"])) {
            $model->attributes = $_POST['User'];

            if ($model->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'profile');
            }
        }
        return $this->render('@app/views/profile/edit_info', ['model' => $model]);
    }

    public function actionGetAddress() {

        $model = \common\models\costfit\Address::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        if (isset($_POST["User"])) {
            $model->attributes = $_POST['User'];
        }
        //echo '<pre>';
        //print_r($model);
        return $this->render('@app/views/profile/add_shipping-address', ['model' => $model]);
    }

    public function actionReset() {
        $request = Yii::$app->request;
        $token = $request->post('token');

        if (Yii::$app->security->validatePassword($token, \Yii::$app->user->identity->password_hash)) {
            // Password Match
            echo TRUE;
        } else {
            //No Match
            echo FALSE;
        }
    }

    public function actionPurchaseOrder($hash) {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $orderId = Yii::$app->request->get('OrderNo');
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Order Purchase ';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order Purchase";

        //echo htmlspecialchars($orderId);
        if (isset($params['orderId'])) {
            $order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id . ' and orderId = "' . $params['orderId'] . '" ')
                    ->one();
            //echo '<pre>';
            //print_r($order);
            return $this->render('@app/views/profile/purchase_order', compact('order'));
        } else {
            return $this->redirect(['profile/order']);
        }
    }

    public function actionTransferConfirm($hash) {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $orderId = $params['orderId'];

        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Order transfer confirm';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order transfer confirm";
        return $this->render('@app/views/profile/transfer_confirm');
    }

    public function actionShippingAddressDelete() {
        $address_id = Yii::$app->request->post('address_id');
        $model = \common\models\costfit\Address::find()->where("addressId ='" . $address_id . "'")->one();
        if ($model->delete()) {
            echo 'complete';
        } else {
            //$this->redirect(Yii::$app->homeUrl . 'profile');
            echo 'wrong';
        }
    }

    public function actionTracking() {
        $this->title = 'Cost.fit | tracking';
        $this->subTitle = 'tracking';
        $this->subSubTitle = 'Delivery';
        return $this->render('@app/views/tracking/tracking');
    }

    public function actionReOrder() {
        $this->title = 'Cost.fit | tracking';
        $this->subTitle = 'tracking';
        $this->subSubTitle = 'Delivery';
        return $this->render('@app/views/history/history');
    }

    public function actionPickingPoint($hash) {

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $addressId = $params['addressId'];

        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Default Shipping Assdress';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Default Shipping Assdress";

        if ($hash != 'add') {
            $model = \common\models\costfit\Address::find()->where("addressId ='" . $addressId . "'")->one();
            $model->scenario = 'shipping_address';
            $action = 'edit';
        } else {
            $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
            $action = 'add';
        }

        $model->type = \common\models\costfit\Address::TYPE_PICKINGPOINT; // default Address First
        $status_address = Yii::$app->controller->action->id;

        $label = 'Save picking point';
        //$model->isDefault = 0;
        if (isset($_POST['Address'])) {

            $model->attributes = $_POST['Address'];
            //echo $_POST["Address"]['isDefault'];
            if ($_POST["Address"]['isDefault']) {
                \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'type' => \common\models\costfit\Address::TYPE_PICKINGPOINT]);
                $model->isDefault = 1;
            }
            $model->userId = Yii::$app->user->id;
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'profile');
            }
        }
        return $this->render('@app/views/profile/picking_point', ['model' => $model, 'label' => $label, 'action' => $action]);
    }

}
