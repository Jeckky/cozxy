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
use common\models\costfit\Order;
use common\models\costfit\Ticket;
use common\models\costfit\ReturnProduct;
use common\helpers\PickingPoint;
use common\helpers\CozxyUnity;

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
        $this->title = 'Cozxy.com | My Profile';
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
        $this->title = 'Cozxy.com | ช่องทางการชำระเงิน';
        $this->subTitle = 'Home';
        $this->subSubTitle = "ช่องทางการชำระเงิน";
        return $this->render('@app/views/payment/payment');
    }

    public function actionOrder() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        $this->layout = "/content_profile";
        $this->title = 'Cozxy.com | Order History';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order History";

        $searchModel = new Order();
        // $dataProvider = $searchModel->search(Yii::$app->request->get());
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        return $this->render('@app/views/profile/order_history', compact('dataProvider', 'searchModel'));
    }

    public function actionDataAddress() {
        $this->layout = "/content_profile";
        $this->title = 'Cozxy.com | Default Shipping Assdress';
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
        $this->title = 'Cozxy.com | Default Shipping Assdress';
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
        $this->title = 'Cozxy.com | Default Shipping Assdress';
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
        if (!isset($model->isDefault)) {
            $model->isDefault = 0;
        }

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
        return $this->render('@app/views/profile/add_address', ['model' => $model, 'label' => $label, 'hash' => $hash]);
    }

    public function actionAddPaymentMethod() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        $this->layout = "/content_profile";
        $this->title = 'Cozxy.com | Default Payment Method';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Default Payment Method";
        return $this->render('@app/views/profile/add_payment_method');
    }

    public function actionEditInfo() {

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $this->layout = "/content_profile";
        $this->title = 'Cozxy.com | Contact Information';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Contact Information";
        $modelx = new \common\models\costfit\User(['scenario' => 'editinfo']);
        //$modelx->scenario = 'editinfo';
        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        //echo '<pre>';
        $birthDateFull = $model->attributes['birthDate'];
        $historyBirthDate = [];
        if (isset($birthDateFull)) {
            $birthDateFull = explode(' ', $model->attributes['birthDate']);
            $birthDateShort = explode('-', $birthDateFull[0]);
            $historyBirthDate['day'] = $birthDateShort[2];
            $historyBirthDate['month'] = $birthDateShort[1];
            $historyBirthDate['year'] = $birthDateShort[0];
        } else {
            $historyBirthDate['day'] = FALSE;
            $historyBirthDate['month'] = FALSE;
            $historyBirthDate['year'] = FALSE;
        }
        $birthdate = [];
        $birthdate['dates'] = CozxyUnity::getDates($historyBirthDate['day']);

        $birthdate['month'] = CozxyUnity::getMonth($historyBirthDate['month']);
        $birthdate['years'] = CozxyUnity::getYears($historyBirthDate['year']);
        if (isset($_POST["User"])) {
            $model->attributes = $_POST['User'];
            $model->firstname = $_POST["User"]['firstname'];
            $model->lastname = $_POST["User"]['lastname'];
            $model->gender = $_POST["User"]['gender'];
            /* birthDate */
            $day = $_POST['User']['day'];
            $month = $_POST['User']['month'];
            $year = $_POST['User']['years'];
            echo $day . '-' . $month . '-' . $year;

            $date = isset($year) ? $year : '0000' . '-' . isset($month) ? $month : '00' . '-' . isset($day) ? $day : '00' . ' 00:00:00';
            echo $date;
            exit();
            // format 2016-10-11 00:00:00
            $model->birthDate = $date;
            //$model->birthDate = $_POST["User"]['birthDate'];
            /* end birthDate */
            $model->tel = $_POST["User"]['tel'];

            if ($model->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'profile');
            }
        }
        return $this->render('@app/views/profile/edit_info', ['model' => $model, 'birthdate' => $birthdate, 'historyBirthDate' => $historyBirthDate]);
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
        //$this->layout = "/content_profile";
        $this->title = 'Cozxy.com | Order Purchase';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order Purchase";

        //echo htmlspecialchars($orderId);
        if (isset($params['orderId'])) {
            $order = Order::find()->where('userId=' . Yii::$app->user->id . ' and orderId = "' . $params['orderId'] . '" ')->one();
            //echo '<pre>';
            //print_r($order);
            //exit();
            //$orderItem = PickingPoint::GetOrderItemrGroupLockersMaster($orderId);
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
        $this->title = 'Cozxy.com | Order transfer confirm';
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
        $this->title = 'Cozxy.com | tracking';
        $this->subTitle = 'tracking';
        $this->subSubTitle = 'Delivery';
        return $this->render('@app/views/tracking/tracking');
    }

    public function actionReOrder() {
        $this->title = 'Cozxy.com | tracking';
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
        $this->title = 'Cozxy.com | Default Shipping Assdress';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Default Shipping Assdress";

        if ($hash != 'add') {
            $model = \common\models\costfit\PickingPoint::find()->where("pickingId ='" . $addressId . "'")->one();
            $model->scenario = 'picking_point';
            $action = 'edit';
        } else {
            $model = new \common\models\costfit\PickingPoint(['scenario' => 'picking_point']);
            $action = 'add';
        }

        $model->type = \common\models\costfit\PickingPoint::TYPE_PICKINGPOINT; // default Address First
        $status_address = Yii::$app->controller->action->id;

        $label = 'Save picking point';
        //$model->isDefault = 0;
        if (isset($_POST['Address'])) {

            $model->attributes = $_POST['Address'];
            //echo $_POST["Address"]['isDefault'];
            if ($_POST["Address"]['isDefault']) {
                \common\models\costfit\PickingPoint::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'type' => \common\models\costfit\PickingPoint::TYPE_PICKINGPOINT]);
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

    public function actionReturning() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        //$this->layout = "/content_profile";
        $this->title = 'Cozxy.com | ขอคืนสินค้า';
        $this->subTitle = 'Home';
        $this->subSubTitle = "คำขอคืนสินค้า";
        $ms = '';
        //$checkStatus = Ticket::TICKET_STATUS_CREATE . "," . Ticket::TICKET_STATUS_WAIT . "," . Ticket::TICKET_STATUS_APPROVED;
        $histories = Ticket::find()->where("userId=" . Yii::$app->user->identity->userId)
        ->orderBy("updateDateTime DESC")
        ->all();
        if (isset($_POST["invoiceNo"])) {
            $order = Order::find()->where("invoiceNo='" . $_POST["invoiceNo"] . "' and status=" . Order::ORDER_STATUS_RECEIVED)->one();
            if (isset($order) && !empty($order)) {
                $tickets = Ticket::find()->where("orderId=" . $order->orderId . " and status!=" . Ticket::TICKET_STATUS_SUCCESSFULL)->one();
                if (isset($tickets) && !empty($tickets)) {//ถ้ายังมี order  ที่อยู่ระหว่างการคืน ไม่ให้สร้างใหม่
                    $tickets = Ticket::find()->where("ticketId=" . $tickets->ticketId)->one();
                    $ms = 'ERROR :This invoice already in process returning, please wait cozxy reply.';
                    return $this->render('@app/views/profile/return_form', [
                        'tickets' => $tickets,
                        'histories' => $histories
                    ]);
                } else {
                    $ticket = new Ticket();
                    $ticket->orderId = $order->orderId;
                    $ticket->title = $_POST["tickeTitle"];
                    $ticket->description = $_POST["ticketDescription"];
                    $ticket->userId = Yii::$app->user->identity->userId;
                    $ticket->status = 1;
                    $ticket->ticketNo = $this->genNewTicket();
                    $ticket->createDateTime = new \yii\db\Expression('NOW()');
                    $ticket->updateDateTime = new \yii\db\Expression('NOW()');
                    $ticket->save(false);
                    $id = Yii::$app->db->getLastInsertID();
                    $tickets = Ticket::find()->where("ticketId=" . $id)->one();
                    return $this->render('@app/views/profile/return_form', [
                        'tickets' => $tickets,
                        'histories' => $histories
                    ]);
                }
            } else {
                $ms = 'ERROR : Invoice not found';
                return $this->render('@app/views/profile/return_form', [
                    'ms' => $ms,
                    'histories' => $histories
                ]);
            }
        } else {
            $ticket1 = Ticket::find()->where("userId=" . Yii::$app->user->identity->userId . " and status!=" . Ticket::TICKET_STATUS_SUCCESSFULL)->one();
            if (isset($ticket1) && !empty($ticket1)) {
                return $this->render('@app/views/profile/return_form', [
                    'tickets' => $ticket1,
                    'histories' => $histories
                ]);
            } else {
                return $this->render('@app/views/profile/return_form', [
                    'histories' => $histories
                ]);
            }
        }
        //$searchModel = new \common\models\costfit\Order();
        // $dataProvider = $searchModel->search(Yii::$app->request->get());
        //$dataProvider = $searchModel->search(Yii::$app->request->get());
    }

    public function actionSaveMessege() {
        $messege = new \common\models\costfit\Messege();
        $res = [];
        if ($_POST["messege"] != '') {
            $messege->orderId = $_POST["orderId"];
            $messege->userId = $_POST["userId"];
            $messege->ticketId = $_POST["ticketId"];
            $messege->messege = $_POST["messege"];
            $messege->messegeType = 1; //customer   2=> cozxy
            $messege->status = 1;
            $messege->createDateTime = new \yii\db\Expression('NOW()');
            $messege->updateDateTime = new \yii\db\Expression('NOW()');
            $messege->save(false);
            $res["status"] = True;
        } else {
            $res["status"] = FALSE;
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionShowMessege() {
        $messeges = \common\models\costfit\Messege::find()->where("ticketId=" . $_POST["ticketId"])
        ->orderBy("createDateTime ASC")
        ->all();
        $ms = '';
        $ScrollPosition = 300;
        $res = [];
        if (isset($messeges) && !empty($messeges)) {
            foreach ($messeges as $messege):
                $showTime = substr($messege->createDateTime, 11, 5);
                if ($messege->messegeType == 1) {//ข้อความทางฝั่ง customer ชิดขวา
                    $ms = $ms . '<div class="message-yellow-right">' . $messege->messege . '</div><div class="pull-right" style="color:#cccccc;font-size:9pt;margin-top:12px;margin-right:2px;">' . $showTime . '</div><div class="col-lg-12"></div>';
                } else {///ฝั่ง cozxy ชิดซ้าย
                    $ms = $ms . '<div class="message-black-left">' . $messege->messege . '</div><div class="pull-left" style="color:#cccccc;font-size:9pt;margin-top:12px;margin-left:2px;">' . $showTime . '</div><div class="col-lg-12"></div>';
                }
                $ms = $ms;
                $ScrollPosition += 50;
            endforeach;
            //echo $ms;
            $res["posi"] = $ScrollPosition;
            $res["ms"] = $ms;
        } else {
            $res["posi"] = $ScrollPosition;
            $res["ms"] = $ms;
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionTicketDetail($ticketId) {
        $ticket = Ticket::find()->where("ticketId=" . $ticketId)->one();
        $returnProducts = ReturnProduct::find()->where("ticketId=" . $ticketId)->all();
        $chats = \common\models\costfit\Messege::find()->where("ticketId=" . $ticketId)
        ->orderBy("createDateTime ASC")
        ->all();
        return $this->render('@app/views/profile/ticket_detail', [
            'ticket' => $ticket,
            'returnProducts' => $returnProducts,
            'chats' => $chats
        ]);
    }

    public function genNewTicket() {
        $ticket = Ticket::find()->max("ticketNo");
        if (isset($ticket) && !empty($ticket)) {
            $ticketNo = $ticket->ticketNo + 1;
        } else {
            $ticketNo = "00000001";
        }
        return $ticketNo;
    }

}
