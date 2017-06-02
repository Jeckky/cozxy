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
        $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
        $pickingPoint_list_lockers = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_HOT)->one(); // Lockers ร้อน
        $pickingPoint_list_lockers_cool = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_COOL)->one(); // Lockers เย็น
        $pickingPoint_list_booth = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_BOOTH)->one(); // Booth
        $pickingPointLockers = isset($pickingPoint_list_lockers) ? $pickingPoint_list_lockers : NULL;
        $pickingPointLockersCool = isset($pickingPoint_list_lockers_cool) ? $pickingPoint_list_lockers_cool : NULL;
        $pickingPointBooth = isset($pickingPoint_list_booth) ? $pickingPoint_list_booth : NULL;
        $hash = 'add';
        $order = \common\models\costfit\Order::find()->where("orderId=" . $_POST['orderId'])->one();
        return $this->render('index', compact('model', 'pickingPointLockers', 'pickingPointLockersCool', 'pickingPointBooth', 'order', 'hash'));
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

}
