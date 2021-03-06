<?php

namespace frontend\controllers;

use common\models\dbworld\States;
use common\models\ModelMaster;
use Yii;
use yii\base\InvalidParamException;
use yii\db\Expression;
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
//use common\helpers\PickingPoint;
use common\helpers\Email;
use common\helpers\Local;
use common\models\costfit\UserPoint;
use common\models\costfit\PointUsed;
use frontend\models\DisplayMyAddress;
use yii\data\ArrayDataProvider;
use common\helpers\CozxyCalculatesCart;

class CheckoutController extends MasterController {

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login?cz=' . time());
        }
        $myAddress['districtId'] = '';
        $myAddress['amphurId'] = '';
        $myAddress['provinceId'] = '';
        $myAddress['countryId'] = '';
        $myAddress['zipcode'] = '';
        $shipTo = Yii::$app->request->post('shipping');
        $shipTostart = Yii::$app->request->post('start');
        $addressId = Yii::$app->request->post('addressId');
        $shipTo = Yii::$app->request->post('shipping');
        $provinceid = Yii::$app->request->post('provinceId');
        $amphurid = Yii::$app->request->post('amphurId');
        $LcpickingId = ($shipTo == 1) ? Yii::$app->request->post('LcpickingId') : 0;
        //echo 'xx :' . $LcpickingId;
        //echo $LcpickingId = ($shipTo == 1) ? $_POST['LcpickingId'] : 0;
        $checkTax = Yii::$app->request->post('checkTax');
        $tax = Yii::$app->request->post('billingTax');
        $addressId = Yii::$app->request->post('addressId'); //addressId
        //echo $addressId;
        //exit();
        $orderAddress = Yii::$app->request->post('Order');
        //echo '<pre>';
        //print_r($orderAddress);
        //exit();
        $orderId = Yii::$app->request->post('orderId');
        $tel = Yii::$app->request->post('tel');

        $hash = 'add';
        $orderId = (isset($_POST['orderId']) && !empty($_POST['orderId'])) ? $_POST['orderId'] : $this->view->params['cart']['orderId'];
        $order = Order::find()->where(['orderId' => $orderId])->one();
        //echo 'pickingId' . $_GET['LcpickingId'];
        $request = Yii::$app->request;
        //print_r($request->bodyParams['PickingPoint']['pickingId']);

        if ($shipTo == 1) {

            if (isset($_POST['pickingId-lats-longs'])) {
                $pickingIdLatsLongs = $_POST['pickingId-lats-longs'];
                if (isset($pickingIdLatsLongs)) {

                    $splitLocation = explode('-', $pickingIdLatsLongs);
                    $pickingId = $splitLocation[0];
                    $latsLongs = $splitLocation[1];
                    $splitlatsLongs = explode(',', $latsLongs);
                    $lats = $splitlatsLongs[0];
                    $longs = $splitlatsLongs[1];
                } else {
                    $pickingIdLatsLongs = $request->bodyParams['PickingPoint']['pickingId'];
                    $splitLocation = explode('-', $pickingIdLatsLongs);
                    $pickingId = $splitLocation[0];
                    $latsLongs = $splitLocation[1];
                    $splitlatsLongs = explode(',', $latsLongs);
                    $lats = $splitlatsLongs[0];
                    $longs = $splitlatsLongs[1];
                }

                $shipToCozxyBoxNew = \common\models\costfit\PickingPoint::find()->where('pickingId = ' . $pickingId)->one();
                $shipToCozxyBoxNew->scenario = 'picking_point_new';
                //echo '<pre>';
                //print_r($shipToCozxyBoxNew->scenario);
                //exit();
                $pickingPointActiveMap = \common\models\costfit\PickingPoint::find()->where('status =1 and `latitude` is not null and `longitude` is not null')->all();
                foreach ($pickingPointActiveMap as $key => $value) {
                    $activeMap[] = $value->attributes;
                }
            } else {
                //return $this->redirect(Yii::$app->homeUrl . 'ship-cozxy-box');
                //echo 'Picking Point Not Null 1';
                $shipToCozxyBoxNew = new \common\models\costfit\PickingPoint(['scenario' => 'picking_point_new']);
            }
        } else if ($shipTo == 2) {
            /* [shippingFirstname] => taninut
              [shippingLastname] => bangmuang
              [shippingAddress] => test
              [shippingProvinceId] => 1
              [shippingAmphurId] => 6
              [shippingDistrictId] => 43
              [shippingZipcode] => 33
              [shippingTel] => 0616539889
              [email] => sodapew17@gmail.com */
            $shippingAddress = Yii::$app->request->post('Order');
            $order->shippingFirstname = isset($orderAddress['shippingFirstname']) ? $orderAddress['shippingFirstname'] : '';
            $order->shippingLastname = isset($orderAddress['shippingLastname']) ? $orderAddress['shippingLastname'] : '';
            $order->shippingAddress = isset($orderAddress['shippingAddress']) ? $orderAddress['shippingAddress'] : '';
            $order->shippingProvinceId = isset($orderAddress['shippingProvinceId']) ? $orderAddress['shippingProvinceId'] : '';
            $order->shippingAmphurId = isset($orderAddress['shippingAmphurId']) ? $orderAddress['shippingAmphurId'] : '';
            $order->shippingDistrictId = isset($orderAddress['shippingDistrictId']) ? $orderAddress['shippingDistrictId'] : '';
            $order->shippingZipcode = isset($orderAddress['shippingZipcode']) ? $orderAddress['shippingZipcode'] : '';
            $order->shippingTel = isset($orderAddress['shippingTel']) ? $orderAddress['shippingTel'] : '';
            $order->email = isset($orderAddress['email']) ? $orderAddress['email'] : '';
            $order->pickingId = 0;
            $order->save(false);
            $pickingId = '0';
        } else {
            //echo 'Picking Point Not Null 2';
            //$shipToCozxyBoxNew = new \common\models\costfit\PickingPoint(['scenario' => 'picking_point']);
            //$shipToCozxyBoxNew->scenario = 'picking_point';
        }


        $model = new \common\models\costfit\Address(['scenario' => 'billing_address']);


        $userPoint = UserPoint::find()->where("userId=" . Yii::$app->user->id)->one();
        if (isset($userPoint)) {
            if ($userPoint->currentPoint < $order->summary) {
                $order->isPayNow = 1;
            }
        } else {
            $order->isPayNow = 1;
        }

        $order->save(false);
        //Default address
        //$defaultAddress = \common\models\costfit\Address::find()->where(['userId' => Yii::$app->user->identity->userId, 'isDefault' => 1])->one();
        $defaultAddress = \common\models\costfit\Address::find()->where(['userId' => Yii::$app->user->identity->userId])->orderBy('isDefault desc')->one();

        if (isset($defaultAddress)) {
            $order->addressId = $defaultAddress->addressId;
            $myAddress['districtId'] = $defaultAddress->district->districtName;
            $myAddress['amphurId'] = $defaultAddress->cities->cityName;
            $myAddress['provinceId'] = $defaultAddress->states->stateName;
            $myAddress['countryId'] = $defaultAddress->countries->countryName;
            $myAddress['zipcode'] = $defaultAddress->zipcodes->zipcode;
        }

        //echo '<pre>';
        //print_r($defaultAddress);
        /*
         * New Billing
         */
        $getUserInfos = \common\models\costfit\User::getUserInfo(Yii::$app->user->id);
        if (count($getUserInfos) > 0) {
            $getUserInfo['firstname'] = $getUserInfos->firstname;
            $getUserInfo['lastname'] = $getUserInfos->lastname;
            $getUserInfo['email'] = $getUserInfos->email;
            $getUserInfo['tel'] = $getUserInfos->tel;
        } else {
            $getUserInfo['firstname'] = '';
            $getUserInfo['lastname'] = '';
            $getUserInfo['email'] = '';
            $getUserInfo['tel'] = '';
        }

        $NewBilling = new \common\models\costfit\Address(['scenario' => 'new_checkouts_billing_address']);

        if (isset($_POST['Address'])) {
            $NewBilling->attributes = $_POST['Address'];
            if ($_POST["Address"]['isDefault']) {
                \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'type' => \common\models\costfit\Address::TYPE_BILLING]);
                $NewBilling->isDefault = 1;
            }
            $NewBilling->userId = Yii::$app->user->id;
            $NewBilling->type = \common\models\costfit\Address::TYPE_BILLING;
            $NewBilling->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save(FALSE)) {
                //return $this->redirect(['/my-account']);
            }
        }

        if (!isset($NewBilling->isDefault)) {
            $NewBilling->isDefault = 0;
        }

        //echo 'shipTo :' . $shipTo;
        //exit();
        //echo '<pre>';
        //print_r($shipToCozxyBoxNew);
        //exit();

        return $this->render('index', compact('shipTo', 'myAddress', 'activeMap', 'shipTostart', 'shipToCozxyBoxNew', 'getUserInfo', 'NewBilling', 'model', 'pickingPointLockers', 'pickingPointLockersCool', 'pickingPointBooth', 'order', 'hash', 'pickingPoint', 'defaultAddress'));
    }

    public function actionSummary() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }

        if (!isset($_REQUEST['orderId'])) {
            return $this->redirect(Yii::$app->homeUrl . 'ship-cozxy-box');
        }
        $shipTo = Yii::$app->request->post('shipping');
        $provinceid = Yii::$app->request->post('provinceId');
        $amphurid = Yii::$app->request->post('amphurId');
        $LcpickingId = ($shipTo == 1) ? Yii::$app->request->post('LcpickingId') : 0;
        $checkTax = Yii::$app->request->post('checkTax');
        $tax = Yii::$app->request->post('inputBillingTax');
        $addressId = Yii::$app->request->post('addressId');
        $orderAddress = Yii::$app->request->post('Order');
        $orderId = Yii::$app->request->post('orderId');
        $tel = Yii::$app->request->post('tel');
        if (isset($addressId)) {
            $addressId = Yii::$app->request->post('addressId');
        } else {
            $addressId = Yii::$app->request->post('addressIdsummary');
        }
        //echo '<pre>';
        //print_r($orderAddress);
        //exit();

        $this->resetDefault($orderId, $addressId, $LcpickingId, $shipTo, $orderAddress, $tax, $tel);
        if (isset($LcpickingId) && !empty($LcpickingId)) {
            //$model = new \common\models\costfit\Address(['scenario' => 'billing_address']);
            $pickingMap = \common\models\costfit\PickingPoint::find()->where('pickingId=' . $LcpickingId)->one();
            if (isset($pickingMap->attributes) && !empty($pickingMap->attributes)) {
                $pickingMap = $pickingMap->attributes;
            } else {
                $pickingMap = Null;
            }
        } else {
            $pickingMap = Null;
        }
        //echo $addressId;
        //$myAddressInSummary = DisplayMyAddress::myAddresssSummary($addressId, \common\models\costfit\Address::TYPE_BILLING);
        if (isset($addressId) && !empty($addressId)) {
            //echo '1';
            $myAddressInSummary = DisplayMyAddress::myAddresssSummary($addressId, \common\models\costfit\Address::TYPE_BILLING);
        } else {
            $myAddressInSummary = DisplayMyAddress::myAddresssSummaryUser(Yii::$app->user->id, \common\models\costfit\Address::TYPE_BILLING);
            $this->updateDefaultBillingToOrder($orderId);
            $addressId = $myAddressInSummary['myAddresss']['addressId'];
        }

        $userPoint = UserPoint::find()->where("userId=" . Yii::$app->user->id)->one();
        $order = Order::find()->where("orderId=" . $orderId)->one();

        return $this->render('summary', compact('myAddressInSummary', 'pickingMap', 'order', 'addressId', 'userPoint'));
    }

    public function actionSummaryK2() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }

        $shipTo = Yii::$app->request->post('shipping');
        $provinceid = Yii::$app->request->post('provinceId');
        $amphurid = Yii::$app->request->post('amphurId');
        $LcpickingId = ($shipTo == 1) ? Yii::$app->request->post('LcpickingId') : 0;
        $checkTax = Yii::$app->request->post('checkTax');
        $tax = Yii::$app->request->post('billingTax');
        $addressId = Yii::$app->request->post('addressId');
        $orderAddress = Yii::$app->request->post('Order');
        $orderId = Yii::$app->request->post('orderId');
        $tel = Yii::$app->request->post('tel');
        if (isset($addressId)) {
            $addressId = Yii::$app->request->post('addressId');
        } else {
            $addressId = Yii::$app->request->post('addressIdsummary');
        }
        //echo '<pre>';
        //print_r($orderAddress);
        //echo 'Summary';
        //exit();
        //$orderId = $_REQUEST['orderId'];
        //$addressId = isset($_REQUEST['addressId']) ? $_REQUEST['addressId'] : '';
        //$LcpickingId = isset($_REQUEST['LcpickingId']) ? $_REQUEST['LcpickingId'] : '';
        //echo 'shipTo :' . $shipTo;
        $this->resetDefault($orderId, $addressId, $LcpickingId, $shipTo, $orderAddress = NULL, $tax = NULL, $tel = NULL);
        //throw new Exception(print_r());
        if (isset($LcpickingId) && !empty($LcpickingId)) {
            //$model = new \common\models\costfit\Address(['scenario' => 'billing_address']);
            $pickingMap = \common\models\costfit\PickingPoint::find()->where('pickingId=' . $LcpickingId)->one();
            if (isset($pickingMap->attributes) && !empty($pickingMap->attributes)) {
                $pickingMap = $pickingMap->attributes;
            } else {
                $pickingMap = Null;
            }
        } else {
            $pickingMap = Null;
        }
        //echo 'x:' . $addressId;
        if (isset($addressId) && !empty($addressId)) {
            //echo '1';
            $myAddressInSummary = DisplayMyAddress::myAddresssSummary($addressId, \common\models\costfit\Address::TYPE_BILLING);
        } else {
            $myAddressInSummary = DisplayMyAddress::myAddresssSummaryUser(Yii::$app->user->id, \common\models\costfit\Address::TYPE_BILLING);
            $addressId = $myAddressInSummary['myAddresss']['addressId'];
        }
        //echo '<pre>';
        //print_r($myAddressInSummary);
        $userPoint = UserPoint::find()->where("userId=" . Yii::$app->user->id)->one();

        $order = Order::find()->where("orderId=" . $orderId)->one();
        //echo $order->pickingId;
        //echo '<pre>';
        //print_r($order);
        return $this->render('summary', compact('myAddressInSummary', 'pickingMap', 'order', 'addressId', 'userPoint'));
    }

    public function actionThanks() {
        return $this->render('thanks');
    }

    public function actionAddress() {
        $addressId = Yii::$app->request->post('addressId');
        $products = [];
        if (isset($addressId) && !empty($addressId)) {

            $products = [];
            $dataAddress = \common\models\costfit\Address::find()->where("addressId =" . $addressId)->orderBy('addressId DESC')->all();
            foreach ($dataAddress as $items) {
                $products['address'] = [
                    'addressId' => $items->addressId,
                    'userId' => $items->userId,
                    'firstname' => $items->firstname,
                    'lastname' => $items->lastname,
                    'company' => $items->company,
                    'tax' => $items->tax,
                    'address' => isset($items->address) ? $items->address : '' . ' , ',
                    'country' => isset($items->countries->countryName) ? $items->countries->countryName : '' . ' , ',
                    'province' => isset($items->states->localName) ? $items->states->localName : '' . ' , ',
                    'amphur' => isset($items->cities->localName) ? $items->cities->localName : '' . ' , ',
                    'district' => isset($items->district->localName) ? $items->district->localName : '' . ' , ',
                    'zipcode' => isset($items->zipcodes->zipcode) ? $items->zipcodes->zipcode : '' . ' , ',
                    'tel' => $items->tel,
                    'type' => $items->type,
                    'isDefault' => $items->isDefault,
                    'status' => $items->status,
                    'createDateTime' => $items->createDateTime,
                    'updateDateTime' => $items->updateDateTime,
                    'email' => $items->email,
                ];
            }

            return json_encode($products);
        }
    }

    public function actionSaveAddressId() {
        $addressId = Yii::$app->request->post('addressId');
        $orderId = Yii::$app->request->post('orderId');
        $cozxyCoin = Yii::$app->request->post('systemCoin');
        $res = [];
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $dataAddress = \common\models\costfit\Address::find()->where("addressId =" . $addressId)->orderBy('addressId DESC')->one();
        if (isset($dataAddress)) {
            $order->addressId = $addressId;
            $order->cozxyCoin = $cozxyCoin;
            $res["status"] = true;
        } else {
            $res["status"] = false;
        }
        $order->save(false);

        return json_encode($res);
    }

    public function actionIsPayNow() {
        $orderId = Yii::$app->request->post('orderId');
        $isPay = Yii::$app->request->post('isPay');
        $res = [];
        $products = [];
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if ($isPay == 1) {
            $order->isPayNow = 1;
        } else {
            $order->isPayNow = 0;
        }
        $order->save(false);
        $res["status"] = true;

        return json_encode($res);
    }

    function actionMapImages() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        //echo 'test map images';
        $pickingId = Yii::$app->request->post('pickingIds');
        //$pickingId = 1;
        if (isset($pickingId) && !empty($pickingId)) {
            $mapImages = \common\models\costfit\PickingPoint::find()->where('pickingId = ' . $pickingId)->one();
            //print_r($mapImages->attributes);
            if (isset($mapImages) && !empty($mapImages)) {
                return json_encode($mapImages->attributes);
            } else {
                return NULL;
            }
        }
    }

    function actionMapImagesGoogle() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        //echo 'test map images';
        $pickingId = Yii::$app->request->post('pickingIds');
        //$pickingId = 1;
        if (isset($pickingId) && !empty($pickingId)) {
            $mapImages = \common\models\costfit\PickingPoint::find()->where('pickingId = ' . $pickingId)->one();

            if (isset($mapImages) && !empty($mapImages)) {
                return json_encode($mapImages->attributes);
            } else {
                return NULL;
            }
        }
    }

    static function resetDefault($orderId, $addressId = null, $pickingId, $shipTo = 1, $orderAddress = null, $tax, $tel) {

        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (isset($order)) {
            $order->cozxyCoin = 0;
            //$order->isPayNow = 0;
            $order->addressId = $addressId;
            $order->pickingId = $pickingId;
//            if ($shipTo == 2) {
//                //echo 'x:2';
//                $order->shippingFirstname = isset($orderAddress['shippingFirstname']) ? $orderAddress['shippingFirstname'] : '';
//                $order->shippingLastname = isset($orderAddress['shippingLastname']) ? $orderAddress['shippingLastname'] : '';
//                $order->shippingAddress = isset($orderAddress['shippingAddress']) ? $orderAddress['shippingAddress'] : '';
//                $order->shippingProvinceId = isset($orderAddress['shippingProvinceId']) ? $orderAddress['shippingProvinceId'] : '';
//                $order->shippingAmphurId = isset($orderAddress['shippingAmphurId']) ? $orderAddress['shippingAmphurId'] : '';
//                $order->shippingDistrictId = isset($orderAddress['shippingDistrictId']) ? $orderAddress['shippingDistrictId'] : '';
//                $order->shippingZipcode = isset($orderAddress['shippingZipcode']) ? $orderAddress['shippingZipcode'] : '';
//                $order->shippingTel = isset($orderAddress['shippingTel']) ? $orderAddress['shippingTel'] : '';
//                $order->email = isset($orderAddress['email']) ? $orderAddress['email'] : '';
//                //$order->pickingId = new Expression('NULL');
//                $order->pickingId = 0;
//            }
            if ($tax != '') {
                $order->billingTax = $tax;
            }
            if ($tel != '') {
                $order->billingTel = $tel;
                $updateTel = \common\models\costfit\Address::find()->where("addressId=" . $addressId)->one();
                if (isset($updateTel)) {
                    if ($updateTel->tel == '' || $updateTel->tel == null) {
                        $updateTel->tel = $tel;
                        $updateTel->save(false);
                        $user = \common\models\costfit\User::find()->where("userId=" . $order->userId)->one();
                        if (isset($user)) {
                            if ($user->tel == '' || $user->tel == null) {
                                $user->tel = $tel;
                                $user->save(false);
                            }
                        }
                    }
                }
            }
            $order->save(false);
            // echo '<pre>';
            // print_r($order);
        }
    }

    function actionOrderSummary() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $orderId = Yii::$app->request->post('orderId');
        //throw new \yii\base\Exception($orderId);
        $order = Order::find()->where("orderId=" . $orderId)->one();
        //$addressIdsummary = Yii::$app->request->post('addressIdsummary');
        $addressIdsummary = isset($order->addressId) ? $order->addressId : $_REQUEST['addressIdsummary'];
        $systemCoin = Yii::$app->request->post('systemCoin');
        $cartCalculates = \common\helpers\CozxyCalculatesCart::ShowCalculatesCartCart($orderId);
        $issetPoint = UserPoint::find()->where("userId=" . $order->userId)->one();
        if (isset($issetPoint)) {
            $userPoint = $issetPoint;
        } else {
            $userPoint = $this->CreateUserPoint($order->userId);
        }
        return $this->render('/order/index', [
                    'order' => $order,
                    'userPoint' => $userPoint,
                    'addressIdsummary' => $addressIdsummary,
                    'systemCoin' => $systemCoin,
                    'cartCalculates' => $cartCalculates
        ]);
    }

    function actionOrderSummaryTopup($hash) {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $k = base64_decode(base64_decode($hash));
        $params = ModelMaster::decodeParams($hash);
        $orderId = $params['orderId'];
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $addressIdsummary = $order->addressId;
        //$systemCoin = Yii::$app->request->post('systemCoin');
        //$addressIdsummary = isset($order->addressId) ? $order->addressId : $_REQUEST['addressIdsummary']; // Fix Bug 19/12/2017 by Pew : hidden addressId not null
        //$systemCoin = isset($order->cozxyCoin) ? $order->cozxyCoin : Yii::$app->request->post('systemCoin');

        $issetPoint = UserPoint::find()->where("userId=" . $order->userId)->one();
        if (isset($issetPoint)) {
            $userPoint = $issetPoint;
        } else {
            $userPoint = $this->CreateUserPoint($order->userId);
        }
        $cartCalculates = \common\helpers\CozxyCalculatesCart::ShowCalculatesCartCart($orderId); // Fix Bug 19/12/2017 by Pew :   call funciton  return data to view

        return $this->render('/order/index', [
                    'order' => $order,
                    'userPoint' => $userPoint,
                    'addressIdsummary' => $addressIdsummary,
                    'systemCoin' => $order->cozxyCoin,
                    'cartCalculates' => $cartCalculates
        ]);
    }

    function actionConfirm() {
        $orderId = Yii::$app->request->post('orderId');
        $systemCoin = Yii::$app->request->post('systemCoin');
        $addressId = Yii::$app->request->post('addressId');
        $shipTo = '';
        if (isset($_GET['orderId']) && isset($_GET['systemCoin'])) {
            $orderId = $_GET['orderId'];
            $systemCoin = $_GET['systemCoin'];
            $addressId = isset($_GET['addressId']) ? $_GET['addressId'] : NULL;
        }
        $isHasNotEnough = $this->CheckEnoughItem($orderId);
        if ($isHasNotEnough == 1) {
            return $this->redirect([Yii::$app->homeUrl . 'cart?fc = 1']);
        }
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $res = [];
        if (isset($order)) {
            $userPoint = UserPoint::find()->where("userId=" . $order->userId . " and status=1")->one();
            if (isset($userPoint)) {
                $this->updateSupplierStock($order->orderId);
                $getRankMemberPoints = RewardPoints::getRankMemberPoints($order->userId, $order->orderId, $order->summary);
                $order->orderNo = \common\models\costfit\Order::genOrderNo();
                $order->invoiceNo = Order::genInvNo($order);
                $order->status = Order::ORDER_STATUS_E_PAYMENT_SUCCESS;
                $order->paymentDateTime = new \yii\db\Expression('NOW()');
                $this->updateUserPoint($order->userId, $order->summary, $order->orderId, $systemCoin == NULL ? 0 : $systemCoin);
                $this->updateBillingToOrder($addressId, $order->orderId, $systemCoin == NULL ? 0 : $systemCoin);
                if ($order->save()) {
                    $res["status"] = 1;
                    $res["orderId"] = $orderId;
                    $res["orderNo"] = $order->orderNo;
                    $res["invoiceNo"] = $order->invoiceNo;
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
                            //$date = \common\models\costfit\ShippingType::find()->where('shippingTypeId = ' . $item->sendDate)->one();
                            $item->sendDateTime = date('Y-m-d', strtotime("+1 day"));
                            $item->save();
                        endforeach;
                    }
                    $member = \common\models\costfit\User::find()->where('userId = ' . $order->userId)->one();
                    if (isset($member)) {
                        if (isset($member->email)) {
                            $toMails = $member->email;
                        } else {
                            $toMails = $member->username;
                        }
                        $toMail = $toMails;
                        $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "my-account";
                        $userName = $member->firstname . ' ' . $member->lastname;
                        $Subject = 'Your order has been received: ' . $order->invoiceNo;
                        //if ($addressId != NULL) {
                        //  $addressId = \common\models\costfit\Address::find()->where("addressId=" . $addressId . " and userId=" . $order->userId)->one();
                        //  } else {
                        $addressId = Order::find()->where("orderId=" . $order->orderId)->one();
                        // }
                        $adress = [];
                        $adress['billingCompany'] = $addressId->billingCompany;
                        $adress['billingTax'] = $addressId->billingTax;

                        $adress['billingFirstname'] = $addressId->billingFirstname;
                        $adress['billingLastname'] = $addressId->billingLastname;
                        $adress['billingAddress'] = $addressId->billingAddress;

                        $billingCountryId = $addressId->billingCountryId; //ประเทศ
                        $country = Local::Countries($billingCountryId);
                        $adress['billingCountryId'] = $country['localName'];

                        $billingProvinceId = $addressId->billingProvinceId; //จังหวัด
                        $States = Local::States($billingProvinceId);
                        $adress['billingProvinceId'] = $States['localName'];

                        $billingAmphurId = $addressId->billingAmphurId; //อำเภอ
                        $Cities = Local::Cities($billingAmphurId);
                        $adress['billingAmphurId'] = $Cities['localName'];

                        $billingDistrictId = $addressId->billingDistrictId; //ตำบล
                        $District = Local::District($billingDistrictId);
                        $adress['billingDistrictId'] = $District['localName'];

                        $billingZipcode = $addressId->billingZipcode;
                        $Zipcodes = Local::Zipcodes($billingZipcode);
                        $adress['billingZipcode'] = $Zipcodes['zipcode'];
                        $adress['billingTel'] = $addressId->billingTel;
                        $orderList = \common\models\costfit\Order::find()->where('orderId = ' . $orderId)->one();
                        $receiveType = [];
                        $cartCalculates = \common\helpers\CozxyCalculatesCart::ShowCalculatesCartCart($orderId);
                        $fulfillment = "fulfillment@cozxy.com";
                        $subjectFulFillment = "Order to cozxy :" . $order->invoiceNo;
                        $orderEmail = Email::mailOrderMember($toMail, $Subject, $url, $userName, $adress, $orderList, $receiveType, $cartCalculates);
                        $pickingId = $orderList->pickingId;
                        if ($pickingId == 0) {//ship to address
                            $shipTo = $this->shipToAddress($orderId);
                        } else {//ship to cozxy box
                            $ship = \common\models\costfit\PickingPoint::find()->where("pickingId=$orderList->pickingId")->one();
                            if (isset($ship)) {
                                $shipTo = $ship->title;
                            }
                        }
                        $urlFulfillment = "http://backend101.cozxy.com/order/order/purchase-order";
                        $fulfillmentMail = Email::mailOrderFullfillment($fulfillment, $subjectFulFillment, $urlFulfillment, $userName, $adress, $orderList, $receiveType, $cartCalculates, $shipTo);
                        $trackingOrder = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyTracking::productShowTracking($order->orderId)]);
                        return $this->render('_thank', compact('res', 'trackingOrder'));
                    }
                }
            } else {
                throw new \yii\base\Exception('Somethig wrong1');
                //go to checkout
            }
        } else {
            throw new \yii\base\Exception('Somethig wrong2');
            //go to checkout
        }
    }

    public function updateBillingToOrder($billingAddressId, $orderId, $systemCoin) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (isset($billingAddressId) && $billingAddressId != NULL) {
            $addressId = \common\models\costfit\Address::find()->where("addressId=" . $billingAddressId . " and userId=" . $order->userId)->one();
        } else {
            $addressId = \common\models\costfit\Address::find()->where("userId=" . $order->userId . " and isDefault=1")->one();
        }
        if (isset($addressId)) {
            $order->billingCompany = $addressId->company;
            $order->billingTax = $addressId->tax;

            $order->billingFirstname = $addressId->firstname;
            $order->billingLastname = $addressId->lastname;
            $order->billingAddress = $addressId->address;

            $billingCountryId = $addressId->countryId; //ประเทศ
            $country = Local::Countries($billingCountryId);
            $order->billingCountryId = $country['countryId'];

            $billingProvinceId = $addressId->provinceId; //จังหวัด
            $States = Local::States($billingProvinceId);
            $order->billingProvinceId = $States['stateId'];

            $billingAmphurId = $addressId->amphurId; //อำเภอ
            $Cities = Local::Cities($billingAmphurId);
            $order->billingAmphurId = $Cities['cityId'];

            $billingDistrictId = $addressId->districtId; //ตำบล
            $District = Local::District($billingDistrictId);
            $order->billingDistrictId = $District['districtId'];

            $billingZipcode = $addressId->zipcode;
            $Zipcodes = Local::Zipcodes($billingZipcode);
            $order->billingZipcode = $Zipcodes['zipcodeId'];
            $order->userCoin = $order->summary - $systemCoin;
            $order->cozxyCoin = $systemCoin;
            $order->billingTel = $addressId->tel;
            $order->save(false);
        }
    }

    public function updateDefaultBillingToOrder($orderId) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $addressId = \common\models\costfit\Address::find()->where("userId=" . $order->userId . " and isDefault=1")->one();
        if (isset($addressId)) {
            $order->billingCompany = $addressId->company;
            $order->billingTax = $addressId->tax;

            $order->billingFirstname = $addressId->firstname;
            $order->billingLastname = $addressId->lastname;
            $order->billingAddress = $addressId->address;

            $billingCountryId = $addressId->countryId; //ประเทศ
            $country = Local::Countries($billingCountryId);
            $order->billingCountryId = $country['countryId'];

            $billingProvinceId = $addressId->provinceId; //จังหวัด
            $States = Local::States($billingProvinceId);
            $order->billingProvinceId = $States['stateId'];

            $billingAmphurId = $addressId->amphurId; //อำเภอ
            $Cities = Local::Cities($billingAmphurId);
            $order->billingAmphurId = $Cities['cityId'];

            $billingDistrictId = $addressId->districtId; //ตำบล
            $District = Local::District($billingDistrictId);
            $order->billingDistrictId = $District['districtId'];

            $billingZipcode = $addressId->zipcode;
            $Zipcodes = Local::Zipcodes($billingZipcode);
            $order->billingZipcode = $Zipcodes['zipcodeId'];
            $order->billingTel = $addressId->tel;
            $order->save(false);
        }
    }

    function CreateUserPoint($userId) {
        $point = new UserPoint();
        $point->userId = Yii::$app->user->identity->userId;
        $point->status = 1;
        $point->currentPoint = 0;
        $point->createDateTime = new \yii\db\Expression('NOW()');
        $point->updateDateTime = new \yii\db\Expression('NOW()');
        $point->save(false);
        $userPoint = UserPoint::find()->where("userId=" . $userId . " and status=1")->one();

        return $userPoint;
    }

    public function updateSupplierStock($orderId) {
        $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId)->all();
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

    public function updateUserPoint($userId, $point, $orderId, $systemCoin) {
        // throw new \yii\base\Exception($systemCoin);
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (($order->invoiceNo == '') || ($order->invoiceNo == null)) {//ถ้ามีเลข invoince แล้ว ไม่ต้องตัด point, ไม่บันทึกรายการ
            $userPoint = UserPoint::find()->where("userId=" . $userId)->one();
            $userPoint->currentPoint = ($userPoint->currentPoint - $point) + $systemCoin;
            $userPoint->currentCozxySystemPoint = $userPoint->currentCozxySystemPoint - $systemCoin;
            $userPoint->updateDateTime = new \yii\db\Expression('NOW()');
            $userPoint->save(false);
            $used = new PointUsed();
            $used->userId = $userId;
            $used->orderId = $orderId;
            $used->point = $point;
            $used->userPoint = $point - $systemCoin;
            $used->cozxyPoint = $systemCoin;
            $used->status = 1;
            $used->createDateTime = new \yii\db\Expression('NOW()');
            $used->updateDateTime = new \yii\db\Expression('NOW()');
            $used->save(false);
        }
    }

    public function actionCheckoutNewBilling() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $co_country = Yii::$app->request->post('co_country');
        $firstname = Yii::$app->request->post('firstname');
        $lastname = Yii::$app->request->post('lastname');
        $address = Yii::$app->request->post('address');
        $email = Yii::$app->request->post('email');
        $tel = Yii::$app->request->post('tel');
        $company = Yii::$app->request->post('company');
        $tax = Yii::$app->request->post('tax');
        $countryid = Yii::$app->request->post('countryid');
        $provinceid = Yii::$app->request->post('provinceid');
        $amphurid = Yii::$app->request->post('amphurid');
        $districtid = Yii::$app->request->post('districtid');
        $zipcode = Yii::$app->request->post('zipcode');
        $isDefault = Yii::$app->request->post('isDefault');

        /* Insert New Billing Address */
        $model = new \common\models\costfit\Address();

        if ($isDefault == 1) {
            \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'type' => \common\models\costfit\Address::TYPE_BILLING]);
            $model->isDefault = 1;
        } else {
            $model->isDefault = $isDefault;
        }
        $model->userId = Yii::$app->user->id;
        $model->firstname = $firstname;
        $model->lastname = $lastname;
        $model->address = $address;
        $model->email = $email;
        $model->tel = $tel;
        if ($co_country == 'company') {
            $model->company = $company;
            $model->tax = $tax;
        } else {
            $model->company = NULL;
            $model->tax = NULL;
        }
        $model->countryId = $countryid;
        $model->provinceId = $provinceid;
        $model->amphurId = $amphurid;
        $model->districtId = $districtid;
        $model->zipcode = $zipcode;
        $model->type = \common\models\costfit\Address::TYPE_BILLING;
        $model->createDateTime = new \yii\db\Expression("NOW()");
        if ($model->save(FALSE)) {
            return '<option value = "' . Yii::$app->db->lastInsertID . '">Billing Address :' . $firstname . ' ' . $lastname . '</option>';
        } else {
            return '';
        }
    }

    function actionShipToCozxyBox() {
        return $this->render('ship_to_cozxy_box');
    }

    public function actionCheckEnoughItem() {
        $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $_POST["orderId"])->all();
        $res = [];
        $header = $this->header();
        $body = '';
        $text = '';
        $wishlist = [];
        $res["status"] = false;
        $productResult = [];
        if (isset($orderItems) && count($orderItems) > 0) {
            foreach ($orderItems as $item):
                $productSupp = \common\models\costfit\ProductSuppliers::find()->where("productSuppId=" . $item->productSuppId)->one();
                if (isset($productSupp)) {
                    if ($productSupp->result < $item->quantity) {
                        $productResult[$productSupp->productSuppId] = $item->quantity;
                        $isWishlist = \common\models\costfit\Wishlist::find()->where("userId=" . Yii::$app->user->id . " and productId=" . $productSupp->productId . " and status=1")->one();
                        if (isset($isWishlist)) {
                            $wishlist[$productSupp->productSuppId] = '<button type = "button" class = "btn btn-yellow size12" onclick = "javascript:addItemToDefaultWishlist(' . $productSupp->productId . ')"><i class = "fa fa-heart" aria-hidden = "true"></i> ADD TO WISHLIST</button>';
                        } else {
                            $wishlist[$productSupp->productSuppId] = '<button type = "button" class = "btn btn-yellow size12" id = "bAdd' . $productSupp->productId . '" onclick = "javascript:addItemToDefaultWishlist(' . $productSupp->productId . ')"><i class = "fa fa-heart-o" aria-hidden = "true"></i> ADD TO WISHLIST</button>';
                        }
                    }
                }
            endforeach;
        }
        if (count($productResult) > 0) {//ถ้ามีรายการที่ของไม่พอ
            $res["status"] = true;
            foreach ($productResult as $productSuppId => $quantity) :
                $productImage = \common\models\costfit\ProductImageSuppliers::find()->where("productSuppId = " . $productSuppId)->one();
                $productSupplier = \common\models\costfit\ProductSuppliers::find()->where("productSuppId = " . $productSuppId)->one();
                if (isset($productImage)) {
                    $image = "<img src = '" . Yii::$app->homeUrl . $productImage->imageThumbnail1 . "' class = 'img-responsive' style = 'width:150px;
        height:150px;
        '>";
                } else {
                    $image = '';
                }
                if ($productSupplier->result == 0) {
                    $body .= '<tr><td style = "text-align:center;">' . $image . '<br>' . $productSupplier->title . '</td><td>' . $quantity . '</td><td>' . $productSupplier->result . '</td><td style = "text-align:center;">' . $wishlist[$productSuppId] . '<br><br> Please delete this item from your cart</td></tr>';
                } else {
                    $body .= '<tr><td style = "text-align:center;">' . $image . '<br>' . $productSupplier->title . '</td><td>' . $quantity . '</td><td>' . $productSupplier->result . '</td><td style = "text-align:center;">' . $wishlist[$productSuppId] . '<br><br> Please decrease this item to ' . $productSupplier->result . '</td></tr>';
                }
            endforeach;
            $text = $header . $body . '</tbody></table>';
        }
        $res["text"] = $text;
        return json_encode($res);
    }

    public function CheckEnoughItem($orderId) {
        $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $orderId)->all();
        $productResult = [];
        if (isset($orderItems) && count($orderItems) > 0) {
            foreach ($orderItems as $item):
                $productSupp = \common\models\costfit\ProductSuppliers::find()->where("productSuppId=" . $item->productSuppId)->one();
                if (isset($productSupp)) {
                    if ($productSupp->result < $item->quantity) {
                        $productResult[$productSupp->productSuppId] = $item->quantity;
                    }
                }
            endforeach;
        }
        if (count($productResult) > 0) {
            return 1; //มีไอเทมที่มีจำนวนไม่พอ
        } else {
            return 0; //ไอเทมครบผ่านได้
        }
    }

    public function header() {
        return ' <table class = "table table-hover" style = "width:100%

                    ">
        <thead>
        <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th> Available</th>
        <th></th>
        </tr>
        </thead><tbody>
        ';
    }

    public function shipToAddress($orderId) {
        $order = Order::find()->where("orderId=$orderId")->one();
        $shippingAddress = '';
        $districtName = '';
        $amphurName = '';
        $provinceName = '';
        $zipcode = '';
        $tel = '';
        if (isset($order)) {
            $name = $order->shippingFirstname . " " . $order->shippingLastname;
            $address = $order->shippingAddress;
            $district = \common\models\dbworld\District::find()->where("districtId=$order->shippingDistrictId")->one();
            if (isset($district)) {
                $districtName = $district->districtName;
            }
            $amphur = \common\models\dbworld\Cities::find()->where("cityId=$order->shippingAmphurId")->one();
            if (isset($amphur)) {
                $amphurName = $amphur->cityName;
            }
            $province = States::find()->where("stateId=$order->shippingProvinceId")->one();
            if (isset($province)) {
                $provinceName = $province->stateName;
            }
            $zipcodeId = \common\models\costfit\Zipcodes::find()->where("zipcodeId=$order->shippingZipcode")->one();
            if (isset($zipcodeId)) {
                $zipcode = $zipcodeId->zipcode;
            }
            if ($order->shippingTel != '' && $order->shippingTel != null) {
                $tel = $order->shippingTel;
            }
            $shippingAddress = $name . '<br>' . $address . ' ' . $districtName . ' ' . $amphurName . ' ' . $provinceName . ' ' . $zipcode . '<br>' . $tel;
        }
        return $shippingAddress;
    }

    public function actionTestMap() {
        return $this->render('_test_map');
    }

    public function actionIndexBk() {



        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login?cz=' . time());
        }

        // throw new \yii\base\Exception('aaaaa');
//        $model = new \common\models\costfit\Address(['sdscenario' => 'billing_address']);
        $model = new \common\models\costfit\Address(['scenario' => 'billing_address']);

        $pickingPoint_list_lockers_cool = new \common\models\costfit\PickingPoint(['scenario' => 'checkout_summary']);
        $pickingPoint_list_lockers = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_HOT)->one(); // Lockers ร้อน

        $pickingPoint_list_lockers_cool = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_COOL)->one(); // Lockers เย็น
        $pickingPoint_list_lockers_cool->scenario = 'checkout_summary';

        $pickingPoint_list_booth = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_BOOTH)->one(); // Booth

        $pickingPointLockers = isset($pickingPoint_list_lockers) ? $pickingPoint_list_lockers : NULL;
        $pickingPointLockersCool = isset($pickingPoint_list_lockers_cool) ? $pickingPoint_list_lockers_cool : NULL;
        $pickingPointBooth = isset($pickingPoint_list_booth) ? $pickingPoint_list_booth : NULL;

        $hash = 'add';
        $orderId = (isset($_POST['orderId']) && !empty($_POST['orderId'])) ? $_POST['orderId'] : $this->view->params['cart']['orderId'];
        $order = Order::find()->where(['orderId' => $orderId])->one();

        $userPoint = UserPoint::find()->where("userId=" . Yii::$app->user->id)->one();
        if (isset($userPoint)) {
            if ($userPoint->currentPoint < $order->summary) {
                $order->isPayNow = 1;
            }
        } else {
            $order->isPayNow = 1;
        }

        $order->save(false);
        //Default address
        //$defaultAddress = \common\models\costfit\Address::find()->where(['userId' => Yii::$app->user->identity->userId, 'isDefault' => 1])->one();
        $defaultAddress = \common\models\costfit\Address::find()->where(['userId' => Yii::$app->user->identity->userId])->orderBy('isDefault desc')->one();

        if (isset($defaultAddress)) {
            $order->addressId = $defaultAddress->addressId;
        }

        if (isset($order->pickingId) && !empty($order->pickingId)) {
            $pickingPoint = \common\models\costfit\PickingPoint::find()->where(['pickingId' => $order->pickingId, 'status' => 1])->one();
            if (count($pickingPoint) <= 0) {
                $pickingPoint = new \common\models\costfit\PickingPoint();
            }
        } else {
            $pickingPoint = new \common\models\costfit\PickingPoint();
        }

        //echo '<pre>';
        //print_r($defaultAddress);
        /*
         * New Billing
         */
        $getUserInfos = \common\models\costfit\User::getUserInfo(Yii::$app->user->id);
        if (count($getUserInfos) > 0) {
            $getUserInfo['firstname'] = $getUserInfos->firstname;
            $getUserInfo['lastname'] = $getUserInfos->lastname;
            $getUserInfo['email'] = $getUserInfos->email;
            $getUserInfo['tel'] = $getUserInfos->tel;
        } else {
            $getUserInfo['firstname'] = '';
            $getUserInfo['lastname'] = '';
            $getUserInfo['email'] = '';
            $getUserInfo['tel'] = '';
        }
        $NewBilling = new \common\models\costfit\Address(['scenario' => 'new_checkouts_billing_address']);
        if (isset($_POST['Address'])) {
            $NewBilling->attributes = $_POST['Address'];
            if ($_POST["Address"]['isDefault']) {
                \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'type' => \common\models\costfit\Address::TYPE_BILLING]);
                $NewBilling->isDefault = 1;
            }
            $NewBilling->userId = Yii::$app->user->id;
            $NewBilling->type = \common\models\costfit\Address::TYPE_BILLING;
            $NewBilling->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save(FALSE)) {
                //return $this->redirect(['/my-account']);
            }
        }
        if (!isset($NewBilling->isDefault)) {
            $NewBilling->isDefault = 0;
        }
        return $this->render('index', compact('getUserInfo', 'NewBilling', 'model', 'pickingPointLockers', 'pickingPointLockersCool', 'pickingPointBooth', 'order', 'hash', 'pickingPoint', 'defaultAddress'));
    }

}
