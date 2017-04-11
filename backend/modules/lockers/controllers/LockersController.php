<?php

namespace backend\modules\lockers\controllers;

use Yii;
use common\models\costfit\Store;
use common\models\costfit\Order;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\controllers\EmailSend;
use common\components\AccessRule;
use common\models\User;
use common\helpers\Lockers;
use common\helpers\Local;

class LockersController extends LockersMasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view', 'open-locker'],
                'rules' => [
// allow authenticated users
                        [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
        ];
    }

    /*
     * หัวข้อ  : ฟอร์ม สแกน QR Code ของล็อกเกอร์ เพื่อตรวจความของสถานที่ของตู้.
     * Updatetime : 25/01/2017
     * By : Taninut.bm
     */

    public function actionIndex() {

        $codes = Yii::$app->request->post('codes');
        if ($codes != '') {
            $queryPickingPoint = \common\models\costfit\PickingPoint::find()->where("code = '" . $codes . "'")->one();
            if (count($queryPickingPoint) > 0) {
                $query = \common\models\costfit\PickingPoint::find()->where("code = '" . $codes . "' and type =" . $queryPickingPoint->type)->one();

                if (count($query) > 0) {
                    $txt = 'ข้อมูลถูกต้อง กรุณารอสักครู่...';
                    $codes = 'true';
                    $data = $query->pickingId;
                } else {
                    $txt = 'ข้อมูลไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง...';
                    $codes = 'false';
                    $data = '';
                }
            } else {
                $txt = 'ข้อมูลไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง...';
                $codes = 'false';
                $data = '';
            }
        } else {
            $txt = 'ไม่พบข้อมูล กรุณา Scan Qr Code Picking Points อีกครั้ง...';
            $codes = 'no';
            $data = '';
        }
        // PickingPoint::openAllChannel($ip, $portIndexs, $macAddress) เรียกเปิดทุกช่อง
        return $this->render('index', ['txt' => $txt, 'codes' => $codes, 'data' => $data]);
    }

    /*
     * หัวข้อ  : Lockers / แสดงช่องของ Lockers ทั้งหมด จากการสแกน Qr code ของ Lockers
     * Update time : 25/01/2017
     * By : Taninut.Bm
     */

    public function actionLockers() {

        $pickingId = Yii::$app->request->get('boxcode');
        if ($pickingId != '') {


            /* Customize Date 21/01/2017 , By Taninut.Bm */
            $listPoint = Lockers::GetPickingPoint($pickingId);
            $localNamecitie = Local::Cities($listPoint->amphurId);
            $localNamestate = Local::States($listPoint->provinceId);
            $localNamecountrie = Local::Countries($listPoint->countryId);

            /*
             * API OPEN CAHNNELS LOCKERS To Hardware
             */
            // Codeding..
            /*
             * END API OPEN CAHNNELS LOCKERS
             */
            /* OLD , By Taninut.Bm */
            /* $query = \common\models\costfit\PickingPointItems::find()
              ->where("picking_point_items.pickingId = '" . $pickingId . "'");
             */
            /* Customize Date 25/01/2017 , By Taninut.Bm */
            $query = Lockers::GetPickingPointItems($pickingId);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            //echo $listPoint->type;
            $PickingPoints = [];
            if ($listPoint->type == 1) {//ประเภทปลายทางแบบล็อคเกอร์เย็น
                $PickingPoints['color_lid'] = '#F9BA32'; //สีเหลือง
                $PickingPoints['frame'] = '#000000'; //โครงดำ
                $PickingPoints['front'] = '#000000'; //ฟอนต์
                $PickingPoints['type'] = 'lockers-hot'; //ประเภทปลายทงในการรับสินค้า
            } else if ($listPoint->type == 2) {//ประเภทปลายทางแบบล็อคเกอร์ร้อน
                $PickingPoints['color_lid'] = '#cccccc'; //สีเทา
                $PickingPoints['frame'] = '#217CA3'; //โครงน้ำเงิน
                $PickingPoints['front'] = '#000000'; //ฟอนต์
                $PickingPoints['type'] = 'lockers-cool'; //ประเภทปลายทงในการรับสินค้า
            } else if ($listPoint->type == 3) {//ประเภทปลายทางแบบBooth
                $PickingPoints['color_lid'] = '#F9BA32'; //สีสีเหลือง
                $PickingPoints['frame'] = '#000000'; //โครงดำ
                $PickingPoints['front'] = '#000000'; //ฟอนต์
                $PickingPoints['type'] = 'booth'; //ประเภทปลายทงในการรับสินค้า
            }

            // $point = PickingPoint::find()->where("pickingId=" . $pickingId)->one();
            $typePickingPoint = \common\models\costfit\PickingPointType::find()->where('pptId=' . $listPoint->type)->one();
            return $this->render('lockers', [
                        'dataProvider' => $dataProvider, 'listPoint' => $listPoint,
                        'citie' => $localNamecitie,
                        'countrie' => $localNamecountrie,
                        'state' => $localNamestate,
                        // 'point' => $point,
                        /* Customize Date 21/01/2017 , By Taninut.Bm */
                        'point' => $listPoint, 'typePickingPoint' => $typePickingPoint, 'PickingPoints' => $PickingPoints
            ]);
        }

        //return $this->render('lockers', ['txt' => $txt, 'codes' => $codes, 'data' => $data]);
    }

    /*
     * แสดงข้อมูลของถุง ที่ต้องการใส่ช่องในล็อคเกอร์
     */

    public function actionScanBag() {

        $request = Yii::$app->request;

        if ($request->isGet) { /* the request method is GET */
            $orderId = Yii::$app->request->get('orderId');
        } else if ($request->isPost) { /* the request method is POST */
            $orderId = Yii::$app->request->post('orderId');
        } else {
            $orderId = '';
        }
        $boxcode = Yii::$app->request->get('boxcode');
        $channel = Yii::$app->request->get('code');
        //$orderId = Yii::$app->request->get('orderId');
        $model = Yii::$app->request->get('model');
        $orderNo = Yii::$app->request->get('orderNo');
        $c = Yii::$app->request->get('c');
        $orderItemId = Yii::$app->request->get('orderItemId');
        $bagNo = Yii::$app->request->get('bagNo');
        $pickingItemsId = Yii::$app->request->get('pickingItemsId');
        $orderItemPackingId = Yii::$app->request->get('orderItemPackingId');
        $channels = Yii::$app->request->get('channels');

        /* Customize Date 25/01/2017 , By Taninut.Bm */
        $listPoint = Lockers::GetPickingPoint($boxcode);

        /* Customize Date 25/01/2017 , By Taninut.Bm */
        $listPointItems = Lockers::GetPickingPointItemsParameters($boxcode, $channel);


        /* Customize Date 25/01/2017 , By Taninut.Bm */
        $localNamecitie = Local::Cities($listPoint->amphurId);
        $localNamestate = Local::States($listPoint->provinceId);
        $localNamecountrie = Local::Countries($listPoint->countryId);
        //$orderId = '';

        /*
         * ตรวจสอบว่ามี bagNo ส่งค่ามาหรือป่าว
         * Customize Date 25/01/2017
         * By Taninut.Bm
         */

        if (isset($bagNo) && !empty($bagNo)) {

            /*
             * Check ว่า BagNo. นี้ มีอยู่ใน Lockers และช่องนี้ยัง
             * End Check ว่า BagNo. นี้ มีอยู่ใน Lockers และช่องนี้ยั
             */
            //throw new \yii\base\Exception($bagNo);
            /* Customize Date 25/01/2017 , By Taninut.Bm */
            //echo '<pre>';
            // print_r($queryOrderItemPackingId);
            // exit();

            /* if (count($queryOrderItemPackingId) == 0) {
              //throw new \yii\base\Exception("Step 1");

              return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?pickingItemsId=' . $pickingItemsId . '&boxcode=' . $boxcode . '&model=' . $model . '&code=' . $channel . '&orderId=' . $orderId . '&c=e&orderItemPackingId=' . $orderItemPackingId . '&orderItemId=' . $orderItemId);
              } by sak */
//            throw new \yii\base\Exception(222);
            $queryOrderItemPackingId = Lockers::GetOrderItemPackingCheckLockersBagNo($bagNo, $boxcode);
            // throw new \yii\base\Exception(print_r($queryOrderItemPackingId, true));
            $orderId = $queryOrderItemPackingId->orderId; // ได้ OrderId มาเพื่อหา ????
            $orderItemId = $queryOrderItemPackingId->orderItemId; // ได้ OrderId มาเพื่อหา ????
            $orderItemPackingId = $queryOrderItemPackingId->orderItemPackingId;

            /*
             * หัวข้อ Query หน้า View scanbag
             *  Customize Date 25/01/2017
             *  By Taninut.Bm
             */
            $query = Lockers::getQueryToViewScanBagNo($bagNo);

            /*   Customize Date 25/01/2017 */
            $queryCountBag = Lockers::getQueryCountBag($bagNo);
            if (count($queryCountBag) > 0) {

                //echo 'มี BagNo นี้';
                //echo 'xxx : ' . $orderId . 'xx : ' . $orderItemPackingId;
                $countBag = Lockers::GetCountBag($orderId);
                //echo $countBag;

                /*  Customize Date 25/01/2017 */
                $OrderItemPacking = Lockers::GetOrderItemPacking($orderItemPackingId);
                if ($countBag > 1) {
//                    throw new \yii\base\Exception("Count Bag > 1");
                    if (count($listPointItems) > 0) {
                        \common\models\costfit\OrderItemPacking::updateAll(['status' => 7, 'userId' => Yii::$app->user->identity->userId, 'pickingItemsId' => $listPointItems->pickingItemsId, 'shipDate' => new \yii\db\Expression("NOW()")], ['bagNo' => $bagNo]);
                        \common\models\costfit\OrderItem::updateAll(['status' => 14], ['orderItemId' => $OrderItemPacking->orderItemId]);
                        //$Order = \common\models\costfit\OrderItem::find()->where("orderItemId = '" . $OrderItemPacking->orderItemId . "' ")->one();
                        \common\models\costfit\Order::updateAll(['status' => 14], ['orderId' => $orderId]);
                        return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?close=no&model=' . $model . '&code=' . $channel . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '&bagNo=' . $bagNo . '');
                    } else {

                        return $this->render('location', [
                                    'warning' => 'bagerror',
                                    'model' => $model,
                                    'code' => $channel,
                                    'boxcode' => $boxcode,
                                    'pickingItemsId' => $pickingItemsId,
                                    'orderId' => $orderId,
                                    'orderItemPackingId' => $orderItemPackingId,
                                    'bagNo' => $OrderItemPacking->bagNo,
                        ]);
                    }
                } else if ($countBag == 1) {

                    /*  Customize Date 25/01/2017 */
                    $listPointItems = Lockers::GetPickingPointItemsPickingItems($boxcode, $channel, $pickingItemsId);

                    if (count($listPointItems) > 0) {
                        // if ($close == 'yes') {
//                        throw new \yii\base\Exception("Count Bag = 1");
                        \common\models\costfit\OrderItemPacking::updateAll(['status' => 7, 'userId' => Yii::$app->user->identity->userId, 'pickingItemsId' => $listPointItems->pickingItemsId, 'shipDate' => new \yii\db\Expression("NOW()")], ['bagNo' => $bagNo]);
                        \common\models\costfit\OrderItem::updateAll(['status' => 15], ['orderItemId' => $OrderItemPacking->orderItemId]);
                        \common\models\costfit\Order::updateAll(['status' => 15], ['orderId' => $orderId]);
                        $this->generatePassword($orderId);
                        $this->sendEmail($orderId, $OrderItemPacking->orderItemId);
                        return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?close=no&model=' . $model . '&code=' . $channel . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '&bagNo=' . $bagNo . '');
                        //return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/close-channel?status=now&model=' . $model . '&code=' . $channel . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '');
                        // }
                    } else {
                        throw new \yii\base\Exception("Else");
                        return $this->render('location', [
                                    'warning' => 'bagerror',
                                    'model' => $model,
                                    'code' => $channel,
                                    'boxcode' => $boxcode,
                                    'pickingItemsId' => $pickingItemsId,
                                    'orderId' => $orderId,
                                    'orderItemPackingId' => $orderItemPackingId,
                                    'bagNo' => $OrderItemPacking->bagNo,
                        ]);
                        // exit();
                    }
                } else {

                }
            }

            /*   Query ส่วนของแสดง Order ของถุงนี้ที่ ใส่เข้าช่องของ Lockers นี้แล้ว */
            /* Customize Date 25/01/2017 */
            //throw new \yii\base\Exception('orderItemId=> ' . $orderItemId . 'pickingItemId => ' . $pickingItemsId . 'bagNo =>' . $bagNo);
            $query1 = Lockers::GetOrderNoToBagNoOnChannelToLockers($orderItemId, $pickingItemsId, $bagNo);

            // OLD แสดงจำนวนถุงของ Order นี้ทั้งหมด
            /* Customize Date 25/01/2017  แสดงจำนวนถุงของ Order นี้ทั้งหมด */
            $queryAllOrder = Lockers::GetOrderNoToBagNoOnChannelToLockersAll($orderId);
        } else {
            //echo 'xx'; แสดง BagNo ที่ Scan Qr code
            /* Customize Date 25/01/2017  แสดง BagNo ที่ Scan Qr code */
            $query1 = Lockers::GetBagNo($orderItemId);

            /* Customize Date 25/01/2017   */
            $query = Lockers::GetOrderItemPackingGetOrderItem($orderId);
            // แสดงจำนวนถุงของ Order นี้ทั้งหมด
            /* Customize Date 25/01/2017   */
            $queryAllOrder = Lockers::GetOrderNoToBagNoOnChannelToLockersAllCheckParaBagNo($orderId);
            //
            //Open Locker Channel
            $channelArray = [];
            $channelArray[0] = $listPointItems->name;
            //throw new \yii\base\Exception(print_r($query1, true));
            \common\helpers\Locker::Open($listPoint, $channelArray);
            //Open Locker Channel
        //
        }

        // echo $queryCountBag->NumberOfBagNo;
        // throw new \yii\base\Exception(print_r($query1, true));
        $dataProviderAllOrder = new ActiveDataProvider([
            'query' => $queryAllOrder,
        ]);

        $dataProviderBag = new ActiveDataProvider([
            'query' => $query1,
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //echo 'check BagNo :' . $bagduplicate;
        // exit();
        $typePickingPoint = \common\models\costfit\PickingPointType::find()->where('pptId=' . $listPoint->type)->one();
        return $this->render('scanbag', [
                    'dataProviderAllOrder' => $dataProviderAllOrder,
                    'dataProviderBag' => $dataProviderBag,
                    'dataProvider' => $dataProvider,
                    'listPoint' => $listPoint,
                    'citie' => $localNamecitie,
                    'countrie' => $localNamecountrie,
                    'state' => $localNamestate,
                    'listPointItems' => $listPointItems,
                    'model' => $model,
                    'boxcode' => $boxcode,
                    'channel' => $channel,
                    'pickingItemsId' => $pickingItemsId,
                    'bagNo' => $bagNo,
                    'orderId' => $orderId,
                    'orderItemPackingId' => $orderItemPackingId,
                    'c' => $c, 'typePickingPoint' => $typePickingPoint,
                        //'VarBagDuplicate' => $BagDuplicate = 1,
        ]);
        //}
    }

    /*
     * หัวข้อ : ต้องการปิด "ช่อง" นี้ของ Lockers
     * Update Date Time : 25/01/2017
     * By : Taninut.Bm
     */

    public function actionCloseChannel() {
        $request = Yii::$app->request;

        if ($request->isGet) { /* the request method is GET */
            $orderId = Yii::$app->request->get('orderId');
        }
        if ($request->isPost) { /* the request method is POST */
            $orderId = Yii::$app->request->post('orderId');
        }
        $boxcode = Yii::$app->request->get('boxcode');
        $channel = Yii::$app->request->get('code');
        $orderId = Yii::$app->request->get('orderId');
        $model = Yii::$app->request->get('model');
        $orderNo = Yii::$app->request->get('orderNo');
        $c = Yii::$app->request->get('c');
        $orderItemId = Yii::$app->request->get('orderItemId');
        $bagNo = Yii::$app->request->get('bagNo');
        $pickingItemsId = Yii::$app->request->get('pickingItemsId');
        $orderItemPackingId = Yii::$app->request->get('orderItemPackingId');
        $channels = Yii::$app->request->get('channels');
        $status = Yii::$app->request->get('status');
        $close = Yii::$app->request->get('close');
        // echo 'ทดสอบ ปิดช่อง';
        // OrderItemPacking  มากกว่า 1 รายการ

        $countBag = Lockers::GetCountBag($orderId);
        //echo $countBag;

        /* Customize Date 25/01/2017   */
        $OrderItemPacking = Lockers::GetOrderItemPacking($orderItemPackingId);

        if ($countBag == 0) {

            /* Customize Date 25/01/2017   */
            $listPointItems = Lockers::GetPickingPointItemsPickingItems($boxcode, $channel, $pickingItemsId);
            if (count($listPointItems) > 0) {
                if ($status == 'now') {
                    \common\models\costfit\PickingPointItems::updateAll(['status' => 0], ['pickingItemsId' => $listPointItems->pickingItemsId]);
                    \common\models\costfit\OrderItem::updateAll(['status' => 15], ['orderItemId' => $OrderItemPacking->orderItemId]);
                    //$Order = \common\models\costfit\OrderItem::find()->where("orderItemId = '" . $OrderItemPacking->orderItemId . "' ")->one();
                    //\common\models\costfit\Order::updateAll(['status' => 14], ['orderId' => $orderId]);
                    //$this->generatePassword($orderId);
                    //$this->sendEmail($orderId);
                    //LockersChannel($pickingId);
                    return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/lockers?boxcode=' . $boxcode);
                } elseif ($status == 'latter') {
                    \common\models\costfit\PickingPointItems::updateAll(['status' => 1], ['pickingItemsId' => $listPointItems->pickingItemsId]);
                    \common\models\costfit\OrderItem::updateAll(['status' => 15], ['orderItemId' => $OrderItemPacking->orderItemId]);
                    return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?close=no&model=' . $model . '&code=' . $channel . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '&bagNo=' . $bagNo . '');
                } else {
                    \common\models\costfit\PickingPointItems::updateAll(['status' => 1], ['pickingItemsId' => $listPointItems->pickingItemsId]);
                    \common\models\costfit\OrderItem::updateAll(['status' => 15], ['orderItemId' => $OrderItemPacking->orderItemId]);
                    return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?close=no&model=' . $model . '&code=' . $channel . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '&bagNo=' . $bagNo . '');
                }
                ///lockers/lockers/scan-bag?model=1&code=aa-010&boxcode=10&pickingItemsId=112&orderId=&orderItemPackingId=&bagNo=BG20161019-0000008
            } else {
                return $this->render('location', [
                            'warning' => 'bagerror',
                            'model' => $model,
                            'code' => $channel,
                            'boxcode' => $boxcode,
                            'pickingItemsId' => $pickingItemsId,
                            'orderId' => $orderId,
                            'orderItemPackingId' => $orderItemPackingId,
                            'bagNo' => $OrderItemPacking->bagNo,
                ]);
            }
        } else if ($countBag == 1) {

            /* Customize Date 25/01/2017   */
            $listPointItems = Lockers::GetPickingPointItemsPickingItems($boxcode, $channel, $pickingItemsId);
            if (count($listPointItems) > 0) {

                if ($status == 'now') {
                    \common\models\costfit\PickingPointItems::updateAll(['status' => 0], ['pickingItemsId' => $listPointItems->pickingItemsId]);
                    \common\models\costfit\OrderItem::updateAll(['status' => 15], ['orderItemId' => $OrderItemPacking->orderItemId]);
                    //$this->generatePassword($orderId);
                    //$this->sendEmail($orderId);
                    return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/lockers?boxcode=' . $boxcode);
                } elseif ($status == 'latter') {
                    \common\models\costfit\PickingPointItems::updateAll(['status' => 1], ['pickingItemsId' => $listPointItems->pickingItemsId]);
                    \common\models\costfit\OrderItem::updateAll(['status' => 15], ['orderItemId' => $OrderItemPacking->orderItemId]);
                    return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?close=no&model=' . $model . '&code=' . $channel . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '&bagNo=' . $bagNo . '');
                } else {
                    \common\models\costfit\PickingPointItems::updateAll(['status' => 1], ['pickingItemsId' => $listPointItems->pickingItemsId]);
                    \common\models\costfit\OrderItem::updateAll(['status' => 15], ['orderItemId' => $OrderItemPacking->orderItemId]);
                    return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?close=no&model=' . $model . '&code=' . $channel . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '&bagNo=' . $bagNo . '');
                }
            } else {

                return $this->render('location', [
                            'warning' => 'bagerror',
                            'model' => $model,
                            'code' => $channel,
                            'boxcode' => $boxcode,
                            'pickingItemsId' => $pickingItemsId,
                            'orderId' => $orderId,
                            'orderItemPackingId' => $orderItemPackingId,
                            'bagNo' => $OrderItemPacking->bagNo,
                ]);
                // exit();
            }
        } else {
            return $this->redirect(Yii::$app->homeUrl . '/lockers/lockers/lockers?boxcode=' . $boxcode);
        }
    }

    /*
     * หัวข้อ : ต้องการหยิบออกจากช่องนี้
     * Update Date Time : 25/01/2017
     * By : Taninut.Bm
     */

    public function actionReturnBag() {
        //return
        $model = Yii::$app->request->get('model');
        $code = Yii::$app->request->get('code');
        $boxcode = Yii::$app->request->get('boxcode');
        $pickingItemsId = Yii::$app->request->get('pickingItemsId');
        $orderId = Yii::$app->request->get('orderId');
        $orderItemPackingId = Yii::$app->request->get('orderItemPackingId');
        $bagNo = Yii::$app->request->get('bagNo');
        $orderItemId = Yii::$app->request->get('orderItemId');
        //throw new \yii\base\Exception($orderId);
        /*
          $boxcode = Yii::$app->request->get('boxcode');
          $channel = Yii::$app->request->get('code');
          $orderId = Yii::$app->request->get('orderId');
          $model = Yii::$app->request->get('model');
          $orderNo = Yii::$app->request->get('orderNo');
          $c = Yii::$app->request->get('c');
          $orderItemId = Yii::$app->request->get('orderItemId');
          $bagNo = Yii::$app->request->get('bagNo');
          $pickingItemsId = Yii::$app->request->get('pickingItemsId');
          $orderItemPackingId = Yii::$app->request->get('orderItemPackingId');
          $channels = Yii::$app->request->get('channels');
          $status = Yii::$app->request->get('status');
          $close = Yii::$app->request->get('close');
         */

        //echo $orderItemPackingId;
        //exit();
        OrderItemPacking::updateAll(['status' => 5, 'userId' => Yii::$app->user->identity->userId, 'pickingItemsId' => 0], ['bagNo' => $bagNo]);
        /* Edit by Sak if remove bag from locker and then return to scan bag */
        // return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/lockers?boxcode=' . $boxcode);
        //\common\models\costfit\PickingPointItems::updateAll(['status' => 1], ['pickingItemsId' => $pickingItemsId]);
        ///scan-bag?model=1&code=aa-009&boxcode=10&pickingItemsId=111&orderId=&orderItemPackingId=&bagNo=BG20161019-0000008
        return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?model=' . $model . '&code=' . $code . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '&orderItemId=' . $orderItemId . '');
    }

    static public function generatePassword($orderId) {
        $flag = false;
        $password = rand('00000000', '99999999');
        while ($flag == false) {
            $order = Order::find()->where("password='" . $password . "' and status!=16")->one(); //Gen OTP จนกว่าจะได้เลขไม่ซ้ำ
            if (isset($order) && !empty($order)) {
                $password = rand('00000000', '99999999');
            } else {
                $flag = true;
                $orders = Order::find()->where("orderId=" . $orderId)->one();
                $orders->password = $password;
                $orders->updateDateTime = new \yii\db\Expression('NOW()  ');
                $orders->save(false);
            }
        }
    }

    static public function sendEmail($orderId, $orderItemId) {
        $order = \common\models\costfit\Order::find()->where("orderId=" . $orderId)->one();
        $orderItem = \common\models\costfit\OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
        if (isset($order) && !empty($order)) {
            $user = \common\models\costfit\User::find()->where("userId=" . $order->userId)->one();
            if (isset($user) && !empty($user)) {
                $email = new EmailSend();
                $toMail = $user->email;
                $userName = $user->firstname . " " . $user->lastname;
                $password = $order->password;
                $picking = PickingPoint::find()->where("pickingId=" . $orderItem->pickingId)->one();
                $location = $picking->title;
                $email->mailSendPassword($toMail, $userName, $password, $location);
            }
        }
    }

    public function actionChannels() {
        /**
         *  เจ้าหน้าต้องตรวจสอบ "ช่อง" ของ lockers ก่อนที่จะไปสแกนถุง
         */
        $pickingId = Yii::$app->request->get('boxcode');
        // ตรวจสอบว่า ถ้ามี ช่อง ไหนที่ลูกค้ามารับแล้วและตรวจสอบผ่าน เข้าเคสนี้เลย
        $CountChannelsInspector = \common\models\costfit\PickingPointItems::NotChannelsInspector($pickingId);
        // echo count($CountChannelsInspector);
        if (count($CountChannelsInspector) > 0) { // ยังมีข้อมูลที่ยังไม่ตรวสอบ คือ 8
            if ($pickingId != '') { //รอตรวจสอบจากเจ้าหน้าที่ : ตรวจสอบช่องที่ลูกค้ารับสินค้าแล้ว

                /* Customize Date 25/01/2017   */
                $listPoint = Lockers::GetPickingPoint($pickingId);
                $localNamecitie = Local::Cities($listPoint->amphurId);
                $localNamestate = Local::States($listPoint->provinceId);
                $localNamecountrie = Local::Countries($listPoint->countryId);

                /* Customize Date 25/01/2017   */
                $query = Lockers::GetPickingPointItems($pickingId);
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);

                /* old */
                //$point = PickingPoint::find()->where("pickingId=" . $pickingId)->one();
                $typePickingPoint = \common\models\costfit\PickingPointType::find()->where('pptId=' . $listPoint->type)->one();
                $PickingPoints = [];
                if ($listPoint->type == 1) {//ประเภทปลายทางแบบล็อคเกอร์เย็น
                    $PickingPoints['color_lid'] = '#cccccc'; //สีเทา
                    $PickingPoints['frame'] = '#217CA3'; //โครงน้ำเงิน
                    $PickingPoints['front'] = '#000000'; //ฟอนต์
                    $PickingPoints['type'] = 'lockers-cool'; //ประเภทปลายทงในการรับสินค้า
                } else if ($listPoint->type == 2) {//ประเภทปลายทางแบบล็อคเกอร์ร้อน
                    $PickingPoints['color_lid'] = '#F9BA32'; //สีเหลือง
                    $PickingPoints['frame'] = '#000000'; //โครงดำ
                    $PickingPoints['front'] = '#000000'; //ฟอนต์
                    $PickingPoints['type'] = 'lockers-hot'; //ประเภทปลายทงในการรับสินค้า
                } else if ($listPoint->type == 3) {//ประเภทปลายทางแบบBooth
                    $PickingPoints['color_lid'] = '#F9BA32'; //สีสีเหลือง
                    $PickingPoints['frame'] = '#000000'; //โครงดำ
                    $PickingPoints['front'] = '#000000'; //ฟอนต์
                    $PickingPoints['type'] = 'booth'; //ประเภทปลายทงในการรับสินค้า
                }
                return $this->render('channels', [
                            'dataProvider' => $dataProvider, 'listPoint' => $listPoint,
                            'citie' => $localNamecitie,
                            'countrie' => $localNamecountrie,
                            'state' => $localNamestate,
                            /* old */
                            //'point' => $point,
                            /* Customize Date 25/01/2017   */
                            'point' => $listPoint, 'typePickingPoint' => $typePickingPoint, 'PickingPoints' => $PickingPoints
                ]);
            }
        } else { // ถ้าช่องไหนครวจสอบผ่าน มีข้อมูล
            return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/lockers?boxcode=' . $pickingId);
        }
    }

    public function actionRemarkChannels() {
        //
        //pickingItemsId
        //remartDesc
        $pickingItemsId = Yii::$app->request->post('pickingItemsId');
        $pickingId = Yii::$app->request->post('pickingId');
        $orderItemPackingId = Yii::$app->request->post('orderItemPackingId');
        $remarkDesc = Yii::$app->request->post('remarkDesc');
        $status = Yii::$app->request->post('status');
        $type = Yii::$app->request->post('type');

        // ตรวจสอบว่า ถ้าช่องใน Lockker นี้ ตรวจสอบหมดแล้ว ให้ redirect ไปหน้าสแกนถุง
        $CountChannelsInspector = \common\models\costfit\PickingPointItems::ChannelsInspector($pickingId);
        //echo $CountChannelsInspector;
        //echo 'count :: ' . $CountChannelsInspector;

        if ($status == 'ok') { //ตรวจสอบ OK
            // echo 'ok';
            \common\models\costfit\OrderItemPacking::updateAll(['lastvisitDate' => new \yii\db\Expression("NOW()"), 'status' => 9, 'userId' => Yii::$app->user->identity->userId, 'remark' => NULL,], ['pickingItemsId' => $pickingItemsId, 'orderItemPackingId' => $orderItemPackingId]);
            $listOrderItemPacking = \common\models\costfit\OrderItemPacking::find()
                            ->where("pickingItemsId = '" . $pickingItemsId . "' ")
                            ->groupBy(['order_item_packing.bagNo'])->one();
            if (count($listOrderItemPacking) > 0) {
                //$e->name = "sachin";
                //$e->hobbies = "sports";
                //$listOrderItemPacking->pickingItemsId = $pickingItemsId;
                //$listOrderItemPacking->status = $CountChannelsInspector;
                //$xx = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
                //$arr = array('a' => $pickingItemsId, 'b' => $CountChannelsInspector);
                $arr = array('pickingItemsId' => $pickingItemsId, 'remark' => $remarkDesc, 'CountChannelsInspector' => $CountChannelsInspector, 'pickingId' => $pickingId);
                echo json_encode($arr);
            }
            /*
              if ($CountChannelsInspector == 1) {// ตรวจสอบว่า ถ้าช่องใน Lockker นี้ ตรวจสอบหมดแล้ว ให้ redirect ไปหน้าสแกนถุง
              return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/lockers?boxcode=' . $pickingId);
              } elseif ($CountChannelsInspector == 0) {
              return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/lockers?boxcode=' . $pickingId);
              } */
        }
        if ($status == 'no') { //ตรวจสอบ No
            //echo $remarkDesc;
            \common\models\costfit\OrderItemPacking::updateAll(['status' => 10, 'type' => $type, 'remark' => $remarkDesc, 'userId' => Yii::$app->user->identity->userId, 'lastvisitDate' => new \yii\db\Expression("NOW()")], ['pickingItemsId' => $pickingItemsId, 'orderItemPackingId' => $orderItemPackingId]);
            $listOrderItemPacking = \common\models\costfit\OrderItemPacking::find()
                            ->where("pickingItemsId = '" . $pickingItemsId . "' ")
                            ->groupBy(['order_item_packing.bagNo'])->one();

            // เก็บ Log แจ้งเตือนช่องของ Locker ต่างๆ //
            $remark = new \common\models\costfit\OrderItemPackingItems(); //Create an article and link it to the author
            $remark->orderItemPackingId = $orderItemPackingId;
            $remark->pickingItemsId = $pickingItemsId;
            $remark->desc = $remarkDesc;
            $remark->createDateTime = new \yii\db\Expression('NOW()');
            $remark->lastvisitDate = new \yii\db\Expression('NOW()');
            $remark->save(FALSE);
            $arr = array('pickingItemsId' => $pickingItemsId, 'remark' => $remarkDesc, 'CountChannelsInspector' => $CountChannelsInspector, 'pickingId' => $pickingId);
            if (count($listOrderItemPacking) > 0) {
                echo json_encode($arr);
            }
        }
        /*
          if ($CountChannelsInspector == 1) {// ตรวจสอบว่า ถ้าช่องใน Lockker นี้ ตรวจสอบหมดแล้ว ให้ redirect ไปหน้าสแกนถุง
          return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/lockers?boxcode=' . $pickingId);
          } elseif ($CountChannelsInspector == 0) {
          return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/lockers?boxcode=' . $pickingId);
          }
         */
        //echo 'ok ok ok Rememart Channels';
    }

    public function actionChannelsPackingItems() {
        $pickingItemsId = Yii::$app->request->post('pickingItemsId');
        $pickingId = Yii::$app->request->post('pickingId');
        $orderItemPackingId = Yii::$app->request->post('orderItemPackingId');
        $html = '';
        $Items = \common\models\costfit\OrderItemPackingItems::find()->where('pickingItemsId=' . $pickingItemsId . ' and orderItemPackingId=' . $orderItemPackingId)->all();
        $num = 0;
        foreach ($Items as $value) {
            $html .= ++$num . '). ' . $value->desc . ' (เมื่อ :' . $this->dateThai($value->lastvisitDate, 1, TRUE) . ')<br>';
        }

        return json_encode($html);
    }

    public function actionOpenLocker() {
//        throw new \yii\base\Exception;
//        $locker = \common\models\costfit\PickingPoint::find()->where("code = '" . $codes . "' and type =" . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS)->one();
        $locker = PickingPoint::find()->where("pickingId = 1")->one();

        $num = array(3, 1, 2, 4);

        $response = \common\helpers\Locker::Open($locker, $num);

        return $this->render('open_locker', [
                    'response' => $response,
                    'msg' => "",
        ]);
    }

//    private function callWebservice($method, $request)
//    {
//        $responses;
//        $auth = $this->customauth->auth_login();
//        if ($auth != null) {
//            $this->load->library('xmlrpc');
//            $this->xmlrpc->set_debug(TRUE);
//            $url = sprintf(APIPATH, $auth['username'], $auth['password']);
//            $this->xmlrpc->server($url, '80');
//            $this->xmlrpc->method($method);
//            $this->xmlrpc->request($request);
//            if (!$this->xmlrpc->send_request()) {
//                $responses = $this->xmlrpc->display_error();
//            } else {
//                $responses = $this->xmlrpc->display_response();
//            }
//        }
//        return $responses;
//    }

    public function actionSendSms() {
        $msg = 'ทดสอบการส่ง ข้อความของ www.cozxy.com';
        $url = "http://api.ants.co.th/sms/1/text/single";
        $method = "POST";
        $data = json_encode(array(
            "from" => "Test",
//            "to" => ["66937419977", "66616539889", "66836134241"],
            "to" => ["66937419977"],
            "text" => $msg)
        );

        $response = \common\helpers\Sms::Send($method, $url, $data);

        return $this->render('sms', [
                    'response' => $response,
                    'msg' => $msg,
        ]);
    }

}
