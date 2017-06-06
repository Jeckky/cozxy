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
use frontend\models\DisplayMyAddress;
use yii\data\ArrayDataProvider;

class CheckoutController extends MasterController {

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }

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
        if (isset($_POST['orderId']) && !empty($_POST['orderId'])) {
            $order = \common\models\costfit\Order::find()->where("orderId=" . $_POST['orderId'])->one();
        } else {
            $order = NULL;
        }
        /*
         * New Billing
         */
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

        return $this->render('index', compact('NewBilling', 'model', 'pickingPointLockers', 'pickingPointLockersCool', 'pickingPointBooth', 'order', 'hash'));
    }

    public function actionSummary() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $provinceid = Yii::$app->request->post('provinceId');
        $amphurid = Yii::$app->request->post('amphurId');
        $LcpickingId = Yii::$app->request->post('LcpickingId');
        $addressId = Yii::$app->request->post('addressId');
        $orderId = Yii::$app->request->post('orderId');
        $order = Order::find()->where("orderId=" . $orderId)->one();
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
        $myAddressInSummary = DisplayMyAddress::myAddresssSummary($addressId, \common\models\costfit\Address::TYPE_BILLING);

        return $this->render('summary', compact('myAddressInSummary', 'pickingMap', 'order'));
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

    function actionOrderSummary($hash) {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $k = base64_decode(base64_decode($hash));
        $params = ModelMaster::decodeParams($hash);
        $orderId = $params['orderId'];
        //throw new \yii\base\Exception($orderId);
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $issetPoint = UserPoint::find()->where("userId=" . $order->userId)->one();
        if (isset($issetPoint)) {
            $userPoint = $issetPoint;
        } else {
            $userPoint = $this->CreateUserPoint($order->userId);
        }
        return $this->render('/order/index', [
            'order' => $order,
            'userPoint' => $userPoint
        ]);
    }

    function actionConfirm() {
        $orderId = Yii::$app->request->post('orderId');
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $res = [];
        if (isset($order)) {
            $userPoint = UserPoint::find()->where("userId=" . $order->userId . " and status=1")->one();
            if (isset($userPoint)) {
                $this->updateSupplierStock($order->orderId);
                $getRankMemberPoints = RewardPoints::getRankMemberPoints($order->userId, $order->orderId, $order->summary);
                $order->invoiceNo = Order::genInvNo($order);
                $order->status = Order::ORDER_STATUS_E_PAYMENT_SUCCESS;
                $order->paymentDateTime = new \yii\db\Expression('NOW()');
                $this->updateUserPoint($order->userId, $order->summary, $order->orderId);
                if ($order->save()) {
                    $res["status"] = 1;
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
                            //$date = \common\models\costfit\ShippingType::find()->where('shippingTypeId=' . $item->sendDate)->one();
                            $item->sendDateTime = date('Y-m-d', strtotime("+1 day"));
                            $item->save();
                        endforeach;
                    }
                    $member = \common\models\costfit\User::find()->where('userId=' . $order->userId)->one();
                    if (isset($member)) {
                        if (isset($member->email)) {
                            $toMails = $member->email;
                        } else {
                            $toMails = $member->username;
                        }
                        $toMail = $toMails;
                        $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "profile/order";
                        $type = $member->firstname . ' ' . $member->lastname;
                        $Subject = 'Your Cozxy.com Order ' . $order->invoiceNo;
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

                        $orderList = \common\models\costfit\Order::find()->where('orderId=' . $orderId)->one();
                        $receiveType = [];
                        $orderEmail = Email::mailOrderMember($toMail, $Subject, $url, $type, $adress, $orderList, $receiveType);
                        return $this->render('_thank', compact('res'));
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

    public function updateUserPoint($userId, $point, $orderId) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (($order->invoiceNo == '') || ($order->invoiceNo == null)) {//ถ้ามีเลข invoince แล้ว ไม่ต้องตัด point, ไม่บันทึกรายการ
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
            return '<option value="' . Yii::$app->db->lastInsertID . '">Billing Address :' . $firstname . ' ' . $lastname . '</option>';
        } else {
            return '';
        }
    }

    public function actionResult() {
        throw new \yii\base\Exception(print_r($_REQUEST, true));
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
                        $Subject = 'Topic: Your Cozxy.com Order  ' . $order->invoiceNo;
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
                        $email = new Email();
                        $email->mailOrderMember($toMail, $Subject, $url, $type, $adress, $orderList, '');
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

    public function actionSendPayment() {
        $isMcc = TRUE;
//        $model = \common\models\areawow\UserPayment::find()->where("userPaymentId=" . $_GET["id"])->one();
//        $package = \common\models\areawow\Package::find()->where("packageId = $model->packageId")->one();
        //URL Test
        $sendUrl = "https://uatkpgw.kasikornbank.com/pgpayment/payment.aspx";
        //URL Test
        //
        //Production URL
//        $sendUrl = "https://rt05.kasikornbank.com/pgpayment/payment.aspx";
        ////Production URL
        //
        //
        //Mobile URL
//        $sendUrl = "https://rt05.kasikornbank.com/mobilepay/payment.aspx";
        ////Mobile URL
        //

        // Standard Thai Bath
        if (!$isMcc):

        // For AreaWIW
//            $merchantId = "401001605782521";
//            $terminalId = "70352178";
        // For AreaWIW
        // Standard  Thai Bath
        else:
            //
            // MCC USD
            //For Cozxy
//            $merchantId = "451005319527001";
//            $terminalId = "74428381";
            //For Cozxy
            // For AreaWIW
            $merchantId = "402001605782521";
            $terminalId = "70352180";
        // For AreaWIW
        // MCC USD
        endif;
//        throw new \yii\base\Exception(str_replace(".", "", $package->price));
//        $amount = str_replace(".", "", $package->price);
        $amount = str_replace(".", "", 1000);
        if (Yii::$app->getRequest()->serverName == "localhost") {
            $url = "http://" . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . "checkout/result";
//        $url = "http://dev/areawow-frontend/user/payment-result";
            $resUrl = "http://" . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . "checkout/result";
        } else {
            $url = "http://" . Yii::$app->getRequest()->serverName . "/checkout/result";
//        $url = "http://dev/areawow-frontend/user/payment-result";
            $resUrl = "http://" . Yii::$app->getRequest()->serverName . "/checkout/result";
        }
        $cusIp = Yii::$app->getRequest()->getUserIP();
//        $description = "Buy Package " . $package->title;
        $description = "Buy Package 1";
//        $invoiceNo = $model->paymentNo;
        $invoiceNo = 1;
        $fillSpace = "Y";
        $md5Key = "SzabTAGU5fQYgHkVGU5f4re8pLw5423Q"; // Old Payment For AreaWOW
//        $md5Key = "QxMjcGFzc3MOIQ=vUT0TFN1UUrM0TlRl"; // For Cozxy
        $checksum = md5($merchantId . $terminalId . $amount . $url . $resUrl . $cusIp . $description . $invoiceNo . $fillSpace . $md5Key);
        return $this->render("@app/views/e_payment/_k_payment", compact('sendUrl', 'merchantId', 'terminalId', 'checksum', 'amount', 'invoiceNo', 'description', 'url', 'resUrl', 'cusIp', 'fillSpace'));
    }

}
