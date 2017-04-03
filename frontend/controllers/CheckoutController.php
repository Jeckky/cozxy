<?php

namespace frontend\controllers;

use common\models\ModelMaster;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use \common\models\costfit\Order;
use common\helpers\RewardPoints;
use common\helpers\PickingPoint;
use common\helpers\Email;
use common\helpers\Local;
use common\models\costfit\UserPoint;
use common\models\costfit\PointUsed;

/**
 * Checkout controller
 */
class CheckoutController extends MasterController {

    public $enableCsrfValidation = false;

    public function beforeAction($action) {
        if ($action->id == 'confirmation' || $action->id == 'confirm-checkout' || $action->id == 'edit-checkout') {
            $this->enableCsrfValidation = FALSE;
        }

        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     * default Address First
      - BILLING = 1; // ที่อยู่จัดส่งเอกสาร
      - SHIPPING = 2; // ที่อยู่จัดส่งสินค้า
     * @return mixed
     */
    public function actionIndex() {
        //echo 'params :' . $this->params['cart']['orderId'] . '::' . $this->params['cart']['items'];

        if (Yii::$app->user->isGuest == 1) {
            //return Yii::$app->response->redirect(Yii::$app->homeUrl . 'register/login');
        }
        $this->layout = "/content_right";
        $this->title = 'Cozxy.com | checkout';
        $this->subTitle = 'Checkout';
        $this->subSubTitle = "";
        $orderId = $this->view->params['cart']['orderId'];
        if (\Yii::$app->user->isGuest) {
            $user = new \common\models\costfit\User();
        } else {
            $user = \common\models\costfit\User::find()->where('userId=' . \Yii::$app->user->id)->one();
        }

        $addressId = Yii::$app->request->post('addressId');
        $addressEdit = Yii::$app->request->post('addressEdit');
        $address = new \common\models\costfit\Address();

        if (isset($addressId)) { // ตรวจสอบว่า มี hidden addressId ให้ update ในเทเบิล address
            if (isset($_POST['Address'])) {
                //print_r($_POST['Address']);
                $address = \common\models\costfit\Address::find()
                ->where('userId =' . \Yii::$app->user->id . ' and addressId=' . $addressId . ' and  type = 1')
                ->one();

                $address->attributes = $_POST['Address'];
                $address->countryId = (isset($_POST['Address']['countryId']) ? $_POST['Address']['countryId'] : '');
                $address->provinceId = (isset($_POST['Address']['provinceId']) ? $_POST['Address']['provinceId'] : '');
                $address->amphurId = (isset($_POST['Address']['amphurId']) ? $_POST['Address']['amphurId'] : '');
                $address->districtId = (isset($_POST['Address']['districtId']) ? $_POST['Address']['districtId'] : '');

                if ($address->save(FALSE)) {
                    $this->redirect(Yii::$app->homeUrl . 'checkout');
                }
            }
        } else {
            //echo 'no hidden ';
            if (\Yii::$app->user->isGuest) {
                $address_shipping = \common\models\costfit\Address::find()->where('userId=' . 0 . ' and type = 2  ')
                ->orderBy('isDefault desc ')
                ->all();

                $address_billing = \common\models\costfit\Address::find()->where('userId=' . 0 . ' and type = 1  ')
                ->orderBy('isDefault desc  ')
                ->all();
            } else {
                $address_shipping = \common\models\costfit\Address::find()->where('userId=' . \Yii::$app->user->id . ' and type = 2  ')
                ->orderBy('isDefault desc ')
                ->all();

                $address_billing = \common\models\costfit\Address::find()->where('userId=' . \Yii::$app->user->id . ' and type = 1  ')
                ->orderBy('isDefault desc  ')
                ->all();
                //$address_billing['scenario'] = 'shipping_address';
            }

            $paymentMethods = \common\models\costfit\PaymentMethod::find()->where("status = 1")->all();

            if (isset($_POST["Order"])) {
                $this->redirect(['order-thank']);
            }

            if (isset($_POST['Address'])) {

                if ($_POST['Address']['typeForm'] == 'formShipping') {
                    //$model_ = new \common\models\costfit\Address();
                    \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'type' => \common\models\costfit\Address::TYPE_SHIPPING]);
                    $address->type = \common\models\costfit\Address::TYPE_SHIPPING; //- SHIPPING = 2; // ที่อยู่จัดส่งสินค้า
                    $address->isDefault = 1; // default Address First
                    $address->createDateTime = new \yii\db\Expression("NOW()");
                    $address->attributes = $_POST['Address'];
                }

                if ($_POST['Address']['typeForm'] == 'formBilling') {
                    //$address->scenario = 'checkout-billing-address';
                    $address->scenarios('checkout-billing-address');
                    \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'type' => \common\models\costfit\Address::TYPE_BILLING]);
                    //$model = new \common\models\costfit\Address();

                    $address->type = \common\models\costfit\Address::TYPE_BILLING; //- BILLING = 1; // ที่อยู่จัดส่งเอกสาร
                    $address->isDefault = 1; // default Address First
                    $address->createDateTime = new \yii\db\Expression("NOW()");
                    $address->attributes = $_POST['Address'];
                }

                if ($address->save(FALSE)) {
                    $this->redirect(Yii::$app->homeUrl . 'checkout');
                    //print_r($_POST['Address']);
                    //exit();
                }
            }
            //$pickingPoint = \common\models\costfit\PickingPoint::find()->one();
            /*
             * Get Value : orderId , receiveType
             * Create date : 16/02/2017
             * Create By : Taninut.Bm
             */
            $GetOrderMasters = PickingPoint::GetOrderItemrMaster($orderId);
            $receiveOrderId = $GetOrderMasters->attributes['orderId'];
            $receiveType = $GetOrderMasters->attributes['receiveType'];
            /* End Get Value */

            /*
             * Group By Receive Type
             * Create date : 16/02/2017
             * Create By : Taninut.Bm
             */
            $GetOrderMastersGroup = PickingPoint::GetOrderItemrGroupMaster($orderId);
            /* End Group By Receive Type */

            /*
             * แจ้งเตือนสถานที่ ที่ Customer เคยสั่งซื้อมา ให้แสดงให้เป็นค่า defaut เป็นตัวเลือกในการตัดใจเลือกว่าจะใช้ location เดิมหรือจะเปลียนใหม่
             * create date : 17/02/2017
             * create by : taninut.bm
             */
            //echo 'user id :' . Yii::$app->user->id;
            $HistoryOrder = PickingPoint::HistoryOrderMaster(Yii::$app->user->id);
            $HistoryOrderId = $HistoryOrder['orderId'];
            //echo $HistoryOrderId;
            //echo '<pre>';
            //print_r($HistoryOrder);
            //exit();
            $LocationHistory = [];
            //`order_item`.orderItemId   ,  `order`.userId   , `order_item`.orderId , `order_item`.productId , `order_item`.receiveType , `order_item`.pickingId
            $LocationHistory['HistoryLockers'] = PickingPoint:: LocationHistoryReceiveTypeLockersInCustomer($HistoryOrderId, \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_HOT); // Locker ร้อน
            $LocationHistory['HistoryLockersCool'] = PickingPoint:: LocationHistoryReceiveTypeLockersInCustomer($HistoryOrderId, \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_COOL); // Locker เย็น
            $LocationHistory['HistoryBooth'] = PickingPoint:: LocationHistoryReceiveTypeBoothInCustomer($HistoryOrderId);
            $LocationHistoryLockers = $LocationHistory['HistoryLockers'];
            $LocationHistoryBooth = $LocationHistory['HistoryBooth'];
            $LocationHistoryLockersCool = $LocationHistory['HistoryLockersCool'];
            //echo '<pre>xxxx';
            //print_r($LocationHistoryLockers);
            //exit();
            /*
             *  Location History Lockers
             */
            $LockerHistory = [];
            if (isset($LocationHistoryLockers)) {
                $LockerHistory['LockersOrderItemId'] = $LocationHistoryLockers['orderItemId'];
                $LockerHistory['LockersOrderId'] = $LocationHistoryLockers['orderId'];
                $LockerHistory['LockersProductId'] = $LocationHistoryLockers['productId'];
                $LockerHistory['LockersReceiveType'] = $LocationHistoryLockers['receiveType'];
                $LockerHistory['LockersPickingId'] = $LocationHistoryLockers['pickingId'];
                $LockerHistory['LockersHistoryLockersNoti'] = 'isTrue';
                if (isset($LockerHistory['LockersPickingId'])) {
                    $pickpointLockersValueInLocation = \common\models\costfit\PickingPoint::find()->where('pickingId = ' . $LockerHistory['LockersPickingId'])->one();
                    $LockerHistory['ListpickpointLockersValueInLocation'] = $pickpointLockersValueInLocation->attributes;
                } else {
                    $LockerHistory['ListpickpointLockersValueInLocation'] = FALSE;
                    $LockerHistory['LockersHistoryLockersNoti'] = 'isFalse';
                }
                //exit();
            } else {
                $LockerHistory['LockersOrderItemId'] = FALSE;
                $LockerHistory['LockersOrderId'] = FALSE;
                $LockerHistory['LockersProductId'] = FALSE;
                $LockerHistory['LockersReceiveType'] = FALSE;
                $LockerHistory['LockersPickingId'] = FALSE;
                $LockerHistory['LockersHistoryLockersNoti'] = 'isFalse';
                $LockerHistory['ListpickpointLockersValueInLocation'] = FALSE;
            }
            /*
             * Location History Lockers Cool
             * Create Date : 16/03/2017
             */
            if (isset($LocationHistoryLockersCool)) {
                $LockerHistory['LockersCoolOrderItemId'] = $LocationHistoryLockersCool['orderItemId'];
                $LockerHistory['LockersCoolOrderId'] = $LocationHistoryLockersCool['orderId'];
                $LockerHistory['LockersCoolProductId'] = $LocationHistoryLockersCool['productId'];
                $LockerHistory['LockersCoolReceiveType'] = $LocationHistoryLockersCool['receiveType'];
                $LockerHistory['LockersCoolPickingId'] = $LocationHistoryLockersCool['pickingId'];
                $LockerHistory['LockersCoolHistoryLockersNoti'] = 'isTrue';
                if (isset($LockerHistory['LockersCoolPickingId'])) {
                    $pickpointLockersCoolValueInLocation = \common\models\costfit\PickingPoint::find()->where('pickingId = ' . $LockerHistory['LockersCoolPickingId'])->one();
                    $LockerHistory['ListpickpointLockersCoolValueInLocation'] = $pickpointLockersCoolValueInLocation->attributes;
                } else {
                    $LockerHistory['ListpickpointLockersCoolValueInLocation'] = FALSE;
                    $LockerHistory['LockersHistoryLockerCoolsNoti'] = 'isFalse';
                }
                //exit();
            } else {
                $LockerHistory['LockersCoolOrderItemId'] = FALSE;
                $LockerHistory['LockersCoolOrderId'] = FALSE;
                $LockerHistory['LockersCoolProductId'] = FALSE;
                $LockerHistory['LockersCoolReceiveType'] = FALSE;
                $LockerHistory['LockersCoolPickingId'] = FALSE;
                $LockerHistory['LockersCoolHistoryLockersNoti'] = 'isFalse';
                $LockerHistory['ListpickpointLockersCoolValueInLocation'] = FALSE;
            }

            /*
             *  Location History Booth
             */
            $BoothHistory = [];
            if (isset($LocationHistoryBooth)) {
                $BoothHistory['BoothOrderItemId'] = $LocationHistoryBooth['orderItemId'];
                $BoothHistory['BoothOrderId'] = $LocationHistoryBooth['orderId'];
                $BoothHistory['BoothProductId'] = $LocationHistoryBooth['productId'];
                $BoothHistory['BoothReceiveType'] = $LocationHistoryBooth['receiveType'];
                $BoothHistory['BoothPickingId'] = $LocationHistoryBooth['pickingId'];
                $BoothHistory['BoothHistoryBoothNoti'] = 'isTrue';
                if (isset($LockerHistory['LockersPickingId'])) {
                    $pickpointBoothValueInLocation = \common\models\costfit\PickingPoint::find()->where('pickingId = ' . $BoothHistory['BoothPickingId'])->one();
                    $BoothHistory['ListpickpointBoothValueInLocation'] = $pickpointBoothValueInLocation->attributes;
                } else {
                    $BoothHistory['ListpickpointBoothValueInLocation'] = FALSE;
                    $BoothHistory['BoothHistoryBoothNoti'] = 'isFalse';
                }
            } else {
                $BoothHistory['BoothOrderItemId'] = FALSE;
                $BoothHistory['BoothOrderId'] = FALSE;
                $BoothHistory['BoothProductId'] = FALSE;
                $BoothHistory['BoothReceiveType'] = FALSE;
                $BoothHistory['BoothPickingId'] = FALSE;
                $BoothHistory['BoothHistoryBoothNoti'] = 'isFalse';
                $BoothHistory['ListpickpointBoothValueInLocation'] = FALSE;
            }
            /*
             * Get Value in Picking Point
             * Create date : 16/02/2017
             * Create By : Taninut.Bm
             */
            $GetOrderItemrGroupLockersMaster = PickingPoint::GetOrderItemrGroupLockersMaster($orderId, \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_HOT);
            // echo '<pre>';
            // print_r($GetOrderItemrGroupLockersMaster->attributes);

            $CheckValuePickPoint = [];
            if (isset($GetOrderItemrGroupLockersMaster[0]->attributes['pickingId'])) {
                //echo '1';
                $CheckValuePickPoint['ListOrderItemGroupLockersValue'] = $GetOrderItemrGroupLockersMaster[0]->attributes['pickingId'];
                $pickpointLockersValueInLocation = \common\models\costfit\PickingPoint::find()->where('pickingId = ' . $CheckValuePickPoint['ListOrderItemGroupLockersValue'])->one();
                $CheckValuePickPoint['ListpickpointLockersValueInLocation'] = $pickpointLockersValueInLocation->attributes;
                $CheckValuePickPoint['ListOrderItemGroupLockersAction'] = 'isTrue';
            } else {
                //echo '2';
                //$CheckValuePickPoint['ListOrderItemGroupLockersValue'] = NULL;
                //$CheckValuePickPoint['ListpickpointLockersValueInLocation'] = NULL;
                //$CheckValuePickPoint['ListOrderItemGroupLockersAction'] = 'isFalse';
                $CheckValuePickPoint['ListOrderItemGroupLockersValue'] = NULL;
                $CheckValuePickPoint['ListpickpointLockersValueInLocation'] = NULL;
                $CheckValuePickPoint['ListOrderItemGroupLockersAction'] = 'isFalse';
                //echo '<pre>';
                //print_r($CheckValuePickPoint);
            }
            //print_r($CheckValuePickPoint);
            // exit();
            /*
             * Lockers เย็น
             * Create Date : 16/03/2017
             */

            $GetOrderItemrGroupLockersCoolMaster = PickingPoint::GetOrderItemrGroupLockersMaster($orderId, \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_COOL);
            //$CheckValuePickPoint = [];
            if (isset($GetOrderItemrGroupLockersCoolMaster[0]->attributes['pickingId'])) {
                $CheckValuePickPoint['ListOrderItemGroupLockersCoolValue'] = $GetOrderItemrGroupLockersCoolMaster[0]->attributes['pickingId'];
                $pickpointLockersCoolValueInLocation = \common\models\costfit\PickingPoint::find()->where('pickingId = ' . $CheckValuePickPoint['ListOrderItemGroupLockersCoolValue'])->one();
                $CheckValuePickPoint['ListpickpointLockersCoolValueInLocation'] = $pickpointLockersCoolValueInLocation->attributes;
                $CheckValuePickPoint['ListOrderItemGroupLockersCoolAction'] = 'isTrue';
            } else {
                $CheckValuePickPoint['ListOrderItemGroupLockersCoolValue'] = NULL;
                $CheckValuePickPoint['ListpickpointLockersCoolValueInLocation'] = NULL;
                $CheckValuePickPoint['ListOrderItemGroupLockersCoolAction'] = 'isFalse';
            }
            /*
             * Booth
             */
            $GetOrderItemrGroupBoothMaster = PickingPoint::GetOrderItemrGroupBoothMaster($orderId);
            if (isset($GetOrderItemrGroupBoothMaster[0]->attributes['pickingId'])) {
                $CheckValuePickPoint['ListOrderItemGroupBoothValue'] = $GetOrderItemrGroupBoothMaster[0]->attributes['pickingId'];
                $pickpointBoothValueInLocation = \common\models\costfit\PickingPoint::find()->where('pickingId = ' . $CheckValuePickPoint['ListOrderItemGroupBoothValue'])->one();
                //ListpickpointBoothValueInLocation
                $CheckValuePickPoint['ListpickpointBoothValueInLocation'] = $pickpointBoothValueInLocation->attributes;
                $CheckValuePickPoint['ListOrderItemGroupBoothAction'] = 'isTrue';
            } else {
                $CheckValuePickPoint['ListOrderItemGroupBoothValue'] = NULL;
                $CheckValuePickPoint['ListpickpointBoothValueInLocation'] = NULL;
                $CheckValuePickPoint['ListOrderItemGroupBoothAction'] = 'isFalse';
            }
            /* End Get Value in Picking Point */

            /*
             * Get Value PickingPoint Lockers and PickingPoint Booth
             * Create date : 16/02/2017
             * Create By : Taninut.Bm
             */
            $pickingPoint_list_lockers = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_HOT)->one(); // Lockers ร้อน
            $pickingPoint_list_lockers_cool = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_COOL)->one(); // Lockers เย็น
            $pickingPoint_list_booth = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_BOOTH)->one(); // Booth
            $pickingPointLockers = isset($pickingPoint_list_lockers) ? $pickingPoint_list_lockers : NULL;
            $pickingPointLockersCool = isset($pickingPoint_list_lockers_cool) ? $pickingPoint_list_lockers_cool : NULL;
            $pickingPointBooth = isset($pickingPoint_list_booth) ? $pickingPoint_list_booth : NULL;

            //echo '<pre>';
            //print_r($LockerHistory);
            //exit();

            /* End Get Value PickingPoint */

            //echo '<pre>';
            //print_r($CheckValuePickPoint);
            return $this->render('checkout', compact('BoothHistory', 'LockerHistory', 'CheckValuePickPoint', 'GetOrderItemrGroupLockersMaster', 'GetOrderItemrGroupBoothMaster', 'address', 'user', 'paymentMethods', 'address_shipping', 'address_billing', 'model', 'pickingPointBooth', 'pickingPointLockers', 'GetOrderMastersGroup', 'pickingPointLockersCool'));
        }
    }

    public function actionOrderThank() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl . 'register/login');
        }
        $this->title = 'Cozxy.com | Order Thank';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Order Thank';
        return $this->render('order_thank');
    }

    public function actionBurnCheckouts() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl . 'register/login');
        }
        /*
          Order
          - paymentType
          - status  = 2
         */
        $request = Yii::$app->request;
        echo '<pre>';
        print_r($request);

        if (isset($request)) {
            //$model->attributes = $_POST['Address'];
            $shipping = Yii::$app->request->post('shipping');
            $billing = Yii::$app->request->post('billing');
            $payment01 = Yii::$app->request->post('payment01');
            $pickingId = Yii::$app->request->post('pickingId');
            $b_pickingid = Yii::$app->request->post('b_pickingid');
            $Lcpickingid = Yii::$app->request->post('Lcpickingid');
            $receiveTypeLockers = Yii::$app->request->post('receiveTypeLockers');
            $receiveTypeLockersCool = Yii::$app->request->post('receiveTypeLockersCool');
            $receiveTypeBooth = Yii::$app->request->post('receiveTypeBooth');
            /*
              receiveTypeLockers: receiveTypeLockers,
              receiveTypeBooth: receiveTypeBooth
             */
            $placeUserId = (Yii::$app->request->post('placeUserId') != '') ? Yii::$app->request->post('placeUserId') : \Yii::$app->user->id;
            $notes = Yii::$app->request->post('notes');
            $placeOrderId = Yii::$app->request->post('placeOrderId');
            //echo 'billing : ' . $billing;

            if (isset($billing)) {
                $address_billing = \common\models\costfit\Address::find()->where('userId = ' . $placeUserId . ' and addressId = ' . $billing)
                ->orderBy('addressId desc')
                ->one();
                //$address_shipping = \common\models\costfit\Address::find()->where('userId = ' . $placeUserId . ' and addressId = ' . $shipping)
                // ->orderBy('addressId desc')
                // ->one();
            } else {
                //$address_shipping = \common\models\costfit\Address::find()->where('userId = ' . $placeUserId . ' and addressId = ' . $shipping)
                //->orderBy('addressId desc')
                //->one();
                $address_billing = \common\models\costfit\Address::find()->where('userId = ' . $placeUserId . ' and addressId = ' . $shipping)
                ->orderBy('addressId desc')
                ->one();
            }
            $order = \common\models\costfit\Order::find()->where('userId = ' . $placeUserId . ' and orderId = ' . $placeOrderId)->one();
            //check ก่อนว่า มี ITEMS ครบตามจำนวนที่ต้องการหรือไม่ ถ้า ไม่ครบให้บอกจำนวนที่เหลือ พร้อมถามว่าต้องการหรือป่าว ถ้าต้องการเปลี่ยนในตารางorderItemแล้วคำนวณราคาใหม่
            //ถ้าไม่ต้องการลบออกจากตาราง orderItem แล้วคำนวณราคาใหม่
            $order->orderNo = \common\models\costfit\Order::genOrderNo();
            $order->paymentType = $payment01;
            $order->pickingId = $pickingId;
            //$order->status = Order::ORDER_STATUS_CHECKOUTS;
            $order->userId = $placeUserId;
            $order->updateDateTime = new \yii\db\Expression("NOW()");
            // Billing //
            $order->billingCompany = ($address_billing['company'] != '') ? $address_billing['company'] : '';
            $order->billingTax = ($address_billing['tax'] != '') ? $address_billing['tax'] : '';
            $order->billingAddress = ($address_billing['address'] != '') ? $address_billing['address'] : '';
            $order->billingCountryId = ($address_billing['countryId'] != '') ? $address_billing['countryId'] : '';
            $order->billingProvinceId = ($address_billing['provinceId'] != '') ? $address_billing['provinceId'] : '';
            $order->billingDistrictId = ($address_billing['districtId'] != '') ? $address_billing['districtId'] : '';
            $order->billingAmphurId = ($address_billing['amphurId'] != '') ? $address_billing['amphurId'] : '';
            $order->billingZipcode = ($address_billing['zipcode'] != '') ? $address_billing['zipcode'] : '';
            $order->billingTel = ($address_billing['tel'] != '') ? $address_billing['tel'] : '';
            // Shipping //
            //$order->shippingCompany = ($address_shipping['company'] != '') ? $address_shipping['company'] : '';
            //$order->shippingTax = ($address_shipping['tax'] != '') ? $address_shipping['tax'] : '';
            //$order->shippingAddress = ($address_shipping['address'] != '') ? $address_shipping['address'] : '';
            //$order->shippingCountryId = ($address_shipping['countryId'] != '') ? $address_shipping['countryId'] : '';
            //$order->shippingProvinceId = ($address_shipping['provinceId'] != '') ? $address_shipping['provinceId'] : '';
            //$order->shippingDistrictId = ($address_shipping['districtId'] != '') ? $address_shipping['districtId'] : '';
            //$order->shippingAmphurId = ($address_shipping['amphurId'] != '') ? $address_shipping['amphurId'] : '';
            //$order->shippingZipcode = ($address_shipping['zipcode'] != '') ? $address_shipping['zipcode'] : '';
            //$order->shippingTel = ($address_shipping['tel'] != '') ? $address_shipping['tel'] : '';
            /* if ($order->paymentType == 2) {
              $order->status = \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_DRAFT;
              } */
            if ($order->save(FALSE)) {

                if ($receiveTypeLockersCool == 2) {
                    \common\models\costfit\OrderItem::updateAll(['pickingId' => $Lcpickingid], ['orderId' => $placeOrderId, 'receiveType' => $receiveTypeLockersCool]);
                }
                if ($receiveTypeBooth == 3) {
                    \common\models\costfit\OrderItem::updateAll(['pickingId' => $b_pickingid], ['orderId' => $placeOrderId, 'receiveType' => $receiveTypeBooth]);
                }
                if ($receiveTypeLockers == 1) {
                    \common\models\costfit\OrderItem::updateAll(['pickingId' => $pickingId], ['orderId' => $placeOrderId, 'receiveType' => $receiveTypeLockers]);
                }
                if ($order->paymentType == 1) {
                    $this->redirect(Yii::$app->homeUrl . 'checkout/order-thank');
                } else {
                    //throw new \yii\base\Exception(print_r($order, true));
                    // $order->encodeParams(['orderId'=>$orderId->orderId])
                    //$this->redirect(Yii::$app->homeUrl . 'checkout/confirm-checkout?orderId = ' . $order->orderId);
                    //echo $order->orderId;
                    //echo $order->encodeParams(['orderId' => $order->orderId]);
                    //exit();
                    $enough = \common\models\costfit\OrderItem::enoughtProductSupp($order);
                    // throw new \yii\base\Exception($enough);
                    if ($enough != '') {//ถ้าไม่พอ
                        //$this->updateSupplierStock($order);
                        ///throw new \yii\base\Exception('aaaaaa');
                        $this->redirect(Yii::$app->homeUrl . 'checkout/edit-checkout/' . $order->encodeParams(['orderId' => $order->orderId, 'id' => $enough]));
                    } else {
                        //$this->updateSupplierStock($order);
                        //$order->status = Order::ORDER_STATUS_CHECKOUTS;
                        $order->save(false);
                        //throw new \yii\base\Exception($order->orderId);
                        $this->redirect(Yii::$app->homeUrl . 'checkout/confirm-checkout/' . $order->encodeParams(['orderId' => $order->orderId]));
                    }
                }
            }
        } else {
            $this->redirect(Yii::$app->homeUrl . 'cart');
        }
    }

    public function actionGetAddress() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl . 'register/login');
        }
        $addressId = Yii::$app->request->post('address');
        $address = \common\models\costfit\Address::find()->where('addressId = ' . $addressId)
        ->orderBy('isDefault desc, updateDateTime desc')
        ->one();
        //echo '<pre>';
        //print_r($address->attributes);
        echo json_encode($address->attributes);
    }

    public function actionConfirmCheckout($hash) {
        $k = base64_decode(base64_decode($hash));
        $params = ModelMaster::decodeParams($hash);
        $orderId = $params['orderId'];
        $model = \common\models\costfit\Order::find()->where("orderId=" . $orderId)->one();
        //$model = \common\models\costfit\Order::find()->where("orderId=" . $_GET["orderId"])->one();
        $ePayment = \common\models\costfit\EPayment::find()->where("PaymentMethodId = 2 AND type =" . \Yii::$app->params['ePaymentServerType'])->one();
        return $this->render('_confirm_checkout', compact('model', 'ePayment'));
    }

    public function actionEditCheckout($hash) {
        $k = base64_decode(base64_decode($hash));
        $params = ModelMaster::decodeParams($hash);
        $orderId = $params['orderId'];
        $id = $params['id'];
        if (isset($_POST['quantity'])) {
            foreach ($_POST['quantity'] as $productSuppId => $quantity):
                $orderItem = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId . " and productSuppId=" . $productSuppId)->one();
                if ($quantity == 0) {//ถ้า quantity=0 ลบออกจาก orderItem
                    $orderItem->delete();
                } else {
                    //$productPrice = $product->calProductPrice($id, $_POST["quantity"], 1, $_POST['fastId'], NULL);
                    $orderItem->quantity = $quantity;
                    $product = new \common\models\costfit\Product();
                    $productPrice = $product->calProductPrice($productSuppId, $quantity, 1, NULL, NULL);
                    $orderItem->price = $productPrice["price"];
                    $orderItem->subTotal = $quantity * $orderItem->price;
                    $orderItem->discountValue = isset($productPrice["discountValue"]) ? $productPrice["discountValue"] : 0;
                    if (isset($productPrice["shippingDiscountValue"])) {
                        $orderItem->shippingDiscountValue = $productPrice["shippingDiscountValue"];
                        $orderItem->total = ($quantity * $orderItem->price) - $orderItem->discountValue - $productPrice["shippingDiscountValue"];
                    } else {
                        $orderItem->total = ($quantity * $orderItem->price) - $orderItem->discountValue;
                    }
                    $orderItem->createDateTime = new \yii\db\Expression("NOW()");
                    $orderItem->save(false);
                }
            endforeach;
            $order = Order::find()->where("orderId=" . $orderId)->one();
            //$order->status = Order::ORDER_STATUS_CHECKOUTS;
            $order->save(false);
            $items = count(\common\models\costfit\OrderItem::find()->where("orderId=" . $orderId)->all());
            if ($items < 0) {
                //$this->updateSupplierStock($order);
                $this->redirect(Yii::$app->homeUrl . 'checkout/confirm-checkout/' . $order->encodeParams(['orderId' => $order->orderId]));
            } else {
                $order = Order::find()->where("orderId=" . $orderId)->one();
                $order->delete();
                $this->redirect(Yii::$app->homeUrl);
            }
        } else {
            return $this->render('edit_checkout', ['orderId' => $orderId, 'id' => $id]);
        }
    }

    public function actionEditCart($id) {
        // throw new \yii\base\Exception($id);
        $res = [];
        $order = \common\models\costfit\Order::getOrder();
        if (!isset($order)) {
            $order = new \common\models\costfit\Order();
            $order->token = $this->getToken();
            $order->status = \common\models\costfit\Order::ORDER_STATUS_DRAFT;
            $order->createDateTime = new \yii\db\Expression("NOW()");
            if (!$order->save(FALSE)) {
                throw new \yii\base\Exception("Can't Save Order");
            }
        }
        //throw new \yii\base\Exception('fastId=' . $id);
        $orderItem = \common\models\costfit\OrderItem::find()->where("orderId = " . $order->orderId . " AND productSuppId = " . $id . " and sendDate = " . $_POST['fastId'])->one();
        if (!isset($orderItem)) {
            $orderItem = new \common\models\costfit\OrderItem();
        }
        $orderItem->quantity = $_POST["quantity"];
        $product = new \common\models\costfit\Product();
        $orderItem->sendDate = $_POST["fastId"];
        $orderItem->firstTimeSendDate = $_POST["fastId"];
        $orderItem->supplierId = $_POST['supplierId'];
        $orderItem->orderId = $order->orderId;
        //$orderItem->productId = $id;
        //$orderItem->productSuppId = \common\models\costfit\Product::productSuppId($id, $_POST['supplierId']);
        $productPrice = $product->calProductPrice($id, $_POST["quantity"], 1, $_POST['fastId'], NULL);
        //$orderItem->priceOnePiece = $orderItem->product->calProductPrice($id, 1, 0, NULL, NULL);
        //$orderItem->priceOnePiece = $orderItem->product->calProductPrice($id, 1, 0, NULL, 'add');
        //$orderItem->priceOnePiece = $orderItem->product->calProductPrice($id, 1);
        $orderItem->price = $productPrice["price"];
        //throw new \yii\base\Exception($orderItem->priceOnePiece);
        $orderItem->subTotal = $orderItem->quantity * $orderItem->price;
        $orderItem->discountValue = isset($productPrice["discountValue"]) ? $productPrice["discountValue"] : 0;
        if (isset($productPrice["shippingDiscountValue"])) {
            $orderItem->shippingDiscountValue = $productPrice["shippingDiscountValue"];
            $orderItem->total = ($orderItem->quantity * $orderItem->price) - $orderItem->discountValue - $productPrice["shippingDiscountValue"];
        } else {
            $orderItem->total = ($orderItem->quantity * $orderItem->price) - $orderItem->discountValue;
        }

        $orderItem->createDateTime = new \yii\db\Expression("NOW()");
        if ($orderItem->save(false)) {
            if (Yii::$app->db->lastInsertID > 0) {
                $orderItemId = Yii::$app->db->lastInsertID;
            } else {
                $orderItemId = $orderItem->orderItemId;
            }
            $order->save();
            $res["status"] = TRUE;
            $res["orderItemId"] = $orderItemId;
            $cartArray = \common\models\costfit\Order::findCartArray();
            $res["cart"] = $cartArray;
            $pQuan = 0;
            foreach ($cartArray["items"] as $item) {
                if ($item["productId"] == $id) {
                    $pQuan += $item["qty"];
                }
            }
            $product = new \common\models\costfit\Product();
            $maxQuantity = $product->findMaxQuantity($id);
            if ($pQuan >= $maxQuantity) {
                $res["isMaxQuantity"] = TRUE;
            } else {
                $res["isMaxQuantity"] = FALSE;
            }
        } else {
//            throw new \yii\base\Exception(print_r($orderItem->errors, true));
            $res["status"] = FALSE;
        }

        return \yii\helpers\Json::encode($res);
    }

    public function actionConfirmation($hash) {

        $k = base64_decode(base64_decode($hash));
        $params = ModelMaster::decodeParams($hash);
        //echo '<pre>';
        //print_r($params);
        //exit();
        $res = [];
        $orderId = $params['orderId'];
        $model = \common\models\costfit\Order::find()->where("orderId = " . $orderId)->one();
        $enoughtPoint = false;
        $enoughtPoint = $this->checkEnoughtPoint($model->userId, $model->summary);
        if ($enoughtPoint == true) {
            $this->updateSupplierStock($model);
            //$model->status = Order::ORDER_STATUS_CHECKOUTS;
            // $model->status = Order::ORDER_STATUS_E_PAYMENT_SUCCESS;
            // $model->updateDateTime = new \yii\db\Expression('NOW()');
            // $model->save(FALSE);
//            $ePayment = \common\models\costfit\EPayment::find()->where("PaymentMethodId = 2 AND type = " . \Yii::$app->params['ePaymentServerType'])->one();
//            return $this->render("//e_payment/payment_confirmation", [
//                        'model' => $model,
//                        'ePayment' => $ePayment]);
            //sak  to  end sak
            $order = Order::find()->where("orderId = " . $orderId)->one();
            // if ($_REQUEST["decision"] == "ACCEPT") {
            /*
             * Reward Points
             * 9/1/2017 By Taninut.Bm
             */
            $orderSummary = $order->summary;
            $orderOrderId = $order->orderId;
            $orderUserId = $order->userId;
            $getRankMemberPoints = RewardPoints::getRankMemberPoints($orderUserId, $orderOrderId, $orderSummary);
            /*
             * Insert Order
             */

            $order->invoiceNo = Order::genInvNo($order);
            $order->status = Order::ORDER_STATUS_E_PAYMENT_SUCCESS;
            $order->paymentDateTime = new \yii\db\Expression('NOW()');
            $this->updateUserPoint($order->userId, $order->summary, $order->orderId);
            //$this->updateSupplierStock($order); //ถ้าจ่ายบัติผ่าน ตัด stock ของ supplier
            //ตัดstock ในPRODUCT SUPPLIER
            if ($order->save()) {
                $res["status"] = 1;
                $res["invoiceNo"] = $order->invoiceNo;
                // $res["message"] = \common\models\costfit\EPayment::getReasonCodeText($_POST["reason_code"]);
                $res["message"] = "Successful transaction";
                // Update Send Date field
                // ****รอ Confirm เรื่อง สั่งหลังกี่โมง เลื่อนไปอีก 1 วัน****
                if ($order->isSlowest) {
                    $maxDate = \common\models\costfit\OrderItem::findSlowestDate($order->orderId);
                    foreach ($order->orderItems as $item):
                        $item->sendDateTime = date('Y-m-d', strtotime("+$maxDate day"));
                        $item->save();
                    endforeach;
                } else {
                    foreach ($order->orderItems as $item):
                        $date = \common\models\costfit\ShippingType::find()->where('shippingTypeId=' . $item->sendDate)->one();
                        $item->sendDateTime = date('Y-m-d', strtotime("+$date->date day"));
                        $item->save();
                    endforeach;
                }
                // Update Send Date field
                /*
                 * Send For Email
                 * Create Date : 24/2/2017
                 * Create By : Taninut.Bm
                 */
                $member = \common\models\costfit\User::find()->where('userId=' . $orderUserId)->one();
                if (isset($member)) {
                    if (isset($member->email)) {
                        $toMails = $member->email;
                    } else {
                        $toMails = $member->username;
                    }
                    $toMail = $toMails;
                    $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "profile/order";
                    $type = $member->firstname . ' ' . $member->lastname;
                    $Subject = 'ยืนยันคำสั่งซื้อหมายเลข ' . $order->invoiceNo;
                    /*
                     * `billingFirstname`, `billingLastname`, `billingCompany`, `billingTax`,
                     * `billingAddress`, `billingCountryId`, `billingProvinceId`, `billingAmphurId`,
                     * `billingDistrictId`, `billingZipcode`, `billingTel`
                     */
                    $adress = [];
                    $adress['billingCompany'] = $order->billingCompany;
                    $adress['billingTax'] = $order->billingTax;

                    $adress['billingFirstname'] = $order->billingFirstname;
                    $adress['billingLastname'] = $order->billingLastname;
                    $adress['billingAddress'] = $order->billingAddress;

                    $billingCountryId = $order->billingCountryId; //ประเทศ
                    $country = Local::Countries($billingCountryId);
                    $adress['billingCountryId'] = $country->localName;

                    $billingProvinceId = $order->billingProvinceId; //จังหวัด
                    $States = Local::States($billingProvinceId);
                    $adress['billingProvinceId'] = $States->localName;

                    $billingAmphurId = $order->billingAmphurId; //อำเภอ
                    $Cities = Local::Cities($billingAmphurId);
                    $adress['billingAmphurId'] = $Cities->localName;

                    $billingDistrictId = $order->billingDistrictId; //ตำบล
                    $District = Local::District($billingDistrictId);
                    $adress['billingDistrictId'] = $District->localName;

                    $adress['billingZipcode'] = $order->billingZipcode;
                    $adress['billingTel'] = $order->billingTel;

                    $orderList = \common\models\costfit\Order::find()->where('orderId=' . $orderOrderId)->one();
                    //$orderItems = \common\models\costfit\OrderItem::find()->where('orderId=' . $orderOrderId)->all();
                    $receiveType = [];
                    /* $GetOrderItemrGroupLockersMaster = PickingPoint::GetOrderItemrGroupLockersMaster($orderId);
                      if (isset($GetOrderItemrGroupLockersMaster)) {
                      $receiveType['GetLockers'] = $GetOrderItemrGroupLockersMaster->pickingId;
                      } else {
                      $receiveType['GetLockers'] = FALSE;
                      }
                      $GetOrderItemrGroupBoothMaster = PickingPoint::GetOrderItemrGroupBoothMaster($orderId);
                      if (isset($GetOrderItemrGroupBoothMaster)) {
                      $GetBooth = $GetOrderItemrGroupBoothMaster->pickingId;
                      } else {
                      $GetBooth = FALSE;
                      } */
                    //$orderEmail = Email::mailOrderMember($toMail, $Subject, $url, $type, $adress, $orderList, $receiveType);
                    return $this->render('payment_result', compact('res'));
                }

                /*
                 * End Send Email
                 */
            }
            /* } else if ($_REQUEST["decision"] == "REVIEW") {
              $order->status = Order::ORDER_STATUS_E_PAYMENT_PENDING;
              $order->save();
              $res["status"] = 2;
              $res["message"] = \common\models\costfit\EPayment::getReasonCodeText($_POST["reason_code"]);
              } else {
              $order->status = Order::ORDER_STATUS_E_PAYMENT_DRAFT;
              $order->save();
              $res["status"] = 3;
              $res["message"] = \common\models\costfit\EPayment::getReasonCodeText($_POST["reason_code"]);

              $this->returnSupplierStock($order); //คืนstock
              } */
            //Order::saveOrderPaymentHistory($order, $_REQUEST["decision"], $_POST["reason_code"], $_POST['score_device_fingerprint_true_ipaddress']);
            //Order::saveOrderPaymentHistory($order, $_REQUEST["decision"], $_POST["reason_code"], 1);
            //end sak pay with points
        } else {//ถ้ามี point ไม่พอให้กลับไปเติม//
            $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
            $ms = 'จำนวน Point ของคุณไม่พอ กรุณาเติม Point';
            return $this->redirect([$baseUrl . '/top-up',
                'ms' => $ms
            ]);
        }
    }

    public function actionResult() {
        $this->title = 'Cozxy.com | Order Thank';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Order Thank';
        $res = [];
        //throw new \yii\base\Exception(print_r($_REQUEST, TRUE));
        if (isset($_REQUEST) && $_REQUEST != array()) {
            $order = Order::find()->where("orderNo='" . $_REQUEST["req_reference_number"] . "'")->one();
            if ($_REQUEST["decision"] == "ACCEPT") {
                /*
                 * Reward Points
                 * 9/1/2017 By Taninut.Bm
                 */
                $orderSummary = $order->summary;
                $orderOrderId = $order->orderId;
                $orderUserId = $order->userId;
                $getRankMemberPoints = RewardPoints::getRankMemberPoints($orderUserId, $orderOrderId, $orderSummary);
                /*
                 * Insert Order
                 */

                $order->invoiceNo = Order::genInvNo($order);
                $order->status = Order::ORDER_STATUS_E_PAYMENT_SUCCESS;
                $order->paymentDateTime = new \yii\db\Expression('NOW()');
                //$this->updateSupplierStock($order); //ถ้าจ่ายบัติผ่าน ตัด stock ของ supplier
                //ตัดstock ในPRODUCT SUPPLIER
                if ($order->save()) {
                    $res["status"] = 1;
                    $res["invoiceNo"] = $order->invoiceNo;
                    $res["message"] = \common\models\costfit\EPayment::getReasonCodeText($_POST["reason_code"]);

                    // Update Send Date field
                    // ****รอ Confirm เรื่อง สั่งหลังกี่โมง เลื่อนไปอีก 1 วัน****
                    if ($order->isSlowest) {
                        $maxDate = \common\models\costfit\OrderItem::findSlowestDate($order->orderId);
                        foreach ($order->orderItems as $item):
                            $item->sendDateTime = date('Y-m-d', strtotime("+$maxDate day"));
                            $item->save();
                        endforeach;
                    } else {
                        foreach ($order->orderItems as $item):
                            $date = \common\models\costfit\ShippingType::find()->where('shippingTypeId=' . $item->sendDate)->one();
                            $item->sendDateTime = date('Y-m-d', strtotime("+$date->date day"));
                            $item->save();
                        endforeach;
                    }
                    // Update Send Date field
                    /*
                     * Send For Email
                     * Create Date : 24/2/2017
                     * Create By : Taninut.Bm
                     */
                    $member = \common\models\costfit\User::find()->where('userId=' . $orderUserId)->one();
                    if (isset($member)) {
                        if (isset($member->email)) {
                            $toMails = $member->email;
                        } else {
                            $toMails = $member->username;
                        }
                        $toMail = $toMails;
                        $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "profile/order";
                        $type = $member->firstname . ' ' . $member->lastname;
                        $Subject = 'ยืนยันคำสั่งซื้อหมายเลข ' . $order->invoiceNo;
                        /*
                         * `billingFirstname`, `billingLastname`, `billingCompany`, `billingTax`,
                         * `billingAddress`, `billingCountryId`, `billingProvinceId`, `billingAmphurId`,
                         * `billingDistrictId`, `billingZipcode`, `billingTel`
                         */
                        $adress = [];
                        $adress['billingCompany'] = $order->billingCompany;
                        $adress['billingTax'] = $order->billingTax;

                        $adress['billingFirstname'] = $order->billingFirstname;
                        $adress['billingLastname'] = $order->billingLastname;
                        $adress['billingAddress'] = $order->billingAddress;

                        $billingCountryId = $order->billingCountryId; //ประเทศ
                        $country = Local::Countries($billingCountryId);
                        $adress['billingCountryId'] = $country->localName;

                        $billingProvinceId = $order->billingProvinceId; //จังหวัด
                        $States = Local::States($billingProvinceId);
                        $adress['billingProvinceId'] = $States->localName;

                        $billingAmphurId = $order->billingAmphurId; //อำเภอ
                        $Cities = Local::Cities($billingAmphurId);
                        $adress['billingAmphurId'] = $Cities->localName;

                        $billingDistrictId = $order->billingDistrictId; //ตำบล
                        $District = Local::District($billingDistrictId);
                        $adress['billingDistrictId'] = $District->localName;

                        $adress['billingZipcode'] = $order->billingZipcode;
                        $adress['billingTel'] = $order->billingTel;
                        /*
                         * Comment
                         * Create Date : 30/03/2017
                         */

                        $orderList = \common\models\costfit\Order::find()->where('orderId=' . $orderOrderId)->one();
                        /*
                          //$orderItems = \common\models\costfit\OrderItem::find()->where('orderId=' . $orderOrderId)->all();
                          $receiveType = [];
                          $GetOrderItemrGroupLockersMaster = PickingPoint::GetOrderItemrGroupLockersMaster($orderId);
                          if (isset($GetOrderItemrGroupLockersMaster)) {
                          $receiveType['GetLockers'] = $GetOrderItemrGroupLockersMaster->pickingId;
                          } else {
                          $receiveType['GetLockers'] = FALSE;
                          }
                          $GetOrderItemrGroupBoothMaster = PickingPoint::GetOrderItemrGroupBoothMaster($orderId);
                          if (isset($GetOrderItemrGroupBoothMaster)) {
                          $GetBooth = $GetOrderItemrGroupBoothMaster->pickingId;
                          } else {
                          $GetBooth = FALSE;
                          }
                         */
                        $receiveType = [];
                        $orderEmail = Email::mailOrderMember($toMail, $Subject, $url, $type, $adress, $orderList, $receiveType);
                    }

                    /*
                     * End Send Email
                     */
                }
            } else if ($_REQUEST["decision"] == "REVIEW") {
                $order->status = Order::ORDER_STATUS_E_PAYMENT_PENDING;
                $order->save();
                $res["status"] = 2;
                $res["message"] = \common\models\costfit\EPayment::getReasonCodeText($_POST["reason_code"]);
            } else {
                $order->status = Order::ORDER_STATUS_E_PAYMENT_DRAFT;
                $order->save();
                $res["status"] = 3;
                $res["message"] = \common\models\costfit\EPayment::getReasonCodeText($_POST["reason_code"]);

                $this->returnSupplierStock($order); //คืนstock
            }
            //Order::saveOrderPaymentHistory($order, $_REQUEST["decision"], $_POST["reason_code"], $_POST['score_device_fingerprint_true_ipaddress']);
            Order::saveOrderPaymentHistory($order, $_REQUEST["decision"], $_POST["reason_code"], 1);
        }

        return $this->render('payment_result', compact('res'));
    }

    public function actionChangeQuantityItem() {
        $res = [];
        $product = new \common\models\costfit\Product();
        $price = $product->calProductPrice($_POST["productId"], $_POST["quantity"], 1, NULL, NULL);
        $maxQuantity = $product->findMaxQuantity($_POST["productId"]);
        if ($_POST["quantity"] <= $maxQuantity) {
            if (isset($price)) {
                $res["status"] = TRUE;
                $res["price"] = $price["price"];
                $res["priceText"] = $price["priceText"];
                $res["discountType"] = $price["discountType"];
                $res["discountValue"] = $price["discountValue"];
            } else {
                $res["status"] = FALSE;
                $res['errorCode'] = 2;
            }
        } else {
            $res["status"] = FALSE;
            $res['errorCode'] = 1;
        }

        return \yii\helpers\Json::encode($res);
    }

    public function actionReverseOrderToCart($hash) {
        $params = \common\models\ModelMaster::decodeParams($hash);
        $orderId = $params['orderId'];
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $order->status = Order::ORDER_STATUS_DRAFT;
        $order->save();
//        $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId)->all();
//        if (isset($orderItems) && !empty($orderItems)) {
//            foreach ($orderItems as $item):
//                $history = \common\models\costfit\StockHistory::find()->where("orderItemId=" . $item->orderItemId)->one();
//                if (isset($history) && !empty($history)) {
//                    $history->delete();
//                }
//                $productSupplier = \common\models\costfit\ProductSuppliers::find()->where("productSuppId=" . $item->productSuppId)->one();
//                if (isset($productSupplier) && !empty($productSupplier)) {
//                    $productSupplier->result += $item->quantity;
//                    $productSupplier->save(FALSE);
//                }
//            endforeach;
//        }


        return $this->redirect(['/cart']);
    }

    public function updateSupplierStock($order) {
        //foreach ($order as $orderId):
        // throw new \yii\base\Exception($orderId->orderId);
        $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $order->orderId)->all();
        foreach ($orderItems as $orderItem):
            $productSupp = \common\models\costfit\ProductSuppliers::find()->where("productSuppId=" . $orderItem->productSuppId)->one();
            if (isset($productSupp) && !empty($productSupp)) {
                $History = new \common\models\costfit\StockHistory();
                $History->orderItemId = $orderItem->orderItemId;
                $History->productSuppId = $productSupp->productSuppId;
                $History->quantity = $orderItem->quantity;
                $History->status = 1;
                $History->createDateTime = new \yii\db\Expression('NOW()');
                $History->updateDateTime = new \yii\db\Expression('NOW()');
                $History->save(false);
            }
            $productSupp->result = $productSupp->result - $orderItem->quantity;
            $productSupp->updateDateTime = new \yii\db\Expression('NOW()');
            $productSupp->save(false);
        endforeach;
        //endforeach;
    }

    public function returnSupplierStock($order) {
        foreach ($order as $orderId):
            $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId->orderId)->all();
            foreach ($orderItems as $orderItem):
                $productSupp = \common\models\costfit\ProductSuppliers::find()->where("productSuppId=" . $orderItem->productSuppId)->one();
                $productSupp->result = $productSupp->result + $orderItem->quantity;
                $productSupp->updateDateTime = new \yii\db\Expression('NOW()');
                $productSupp->save(false);
            endforeach;
        endforeach;
    }

    function actionMapImages() {
        //echo 'test map images';
        $pickingId = Yii::$app->request->post('pickingIds');
        //$pickingId = 1;
        if (isset($pickingId) && !empty($pickingId)) {
            $mapImages = \common\models\costfit\PickingPoint::find()->where('pickingId=' . $pickingId)->one();
            //print_r($mapImages->attributes);
            if (isset($mapImages) && !empty($mapImages)) {
                return json_encode($mapImages->attributes);
            } else {
                return NULL;
            }
        }
    }

    public function checkEnoughtPoint($userId, $summary) {
        $currentPoint = UserPoint::find()->where("userId=" . $userId)->one();
        if (isset($currentPoint) && !empty($currentPoint)) {
            if ($currentPoint->currentPoint >= $summary) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateUserPoint($userId, $point, $orderId) {
        $userPoint = UserPoint::find()->where("userId=" . $userId)->one();
        $userPoint->currentPoint = $userPoint->currentPoint - $point;
        $userPoint->updateDateTime = new \yii\db\Expression('NOW()');
        $userPoint->save(false);
        $used = new PointUsed();
        $used->userId = $userId;
        $used->orderId = $orderId;
        $used->point = $point;
        $used->status = 1;
        $used->createDateTime = new \yii\db\Expression('NOW()');
        $used->updateDateTime = new \yii\db\Expression('NOW()');
        $used->save(false);
    }

}
