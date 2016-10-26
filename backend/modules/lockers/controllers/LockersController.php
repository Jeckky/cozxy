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

class LockersController extends LockersMasterController {

    public function actionIndex() {

        $codes = Yii::$app->request->post('codes');
        if ($codes != '') {
            $query = \common\models\costfit\PickingPoint::find()->where("code = '" . $codes . "'")->one();

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
            $txt = 'ไม่พบข้อมูล กรุณา Scan Qr Code Picking Points อีกครั้ง...';
            $codes = 'no';
            $data = '';
        }
        // PickingPoint::openAllChannel($ip, $portIndexs, $macAddress) เรียกเปิดทุกช่อง
        return $this->render('index', ['txt' => $txt, 'codes' => $codes, 'data' => $data]);
    }

    public function actionLockers() {

        $pickingId = Yii::$app->request->get('boxcode');
        if ($pickingId != '') {
            $listPoint = \common\models\costfit\PickingPoint::find()->where("pickingId = '" . $pickingId . "'")->one();
            $localNamecitie = \common\models\dbworld\Cities::find()->where("cityId = '" . $listPoint->amphurId . "' ")->one();
            $localNamestate = \common\models\dbworld\States::find()->where("stateId = '" . $listPoint->provinceId . "' ")->one();
            $localNamecountrie = \common\models\dbworld\Countries::find()->where("countryId = '" . $listPoint->countryId . "' ")->one();

            /*
             * API OPEN CAHNNELS LOCKERS To Hardware
             */
            // Codeding..
            /*
             * END API OPEN CAHNNELS LOCKERS
             */

            $query = \common\models\costfit\PickingPointItems::find()
                    //->join('RIGHT JOIN', 'order_item_packing', 'order_item_packing.pickingItemsId =picking_point_items.pickingItemsId')
                    ->where("picking_point_items.pickingId = '" . $pickingId . "'");

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            $point = PickingPoint::find()->where("pickingId=" . $pickingId)->one();

            return $this->render('lockers', [
                        'dataProvider' => $dataProvider, 'listPoint' => $listPoint,
                        'citie' => $localNamecitie,
                        'countrie' => $localNamecountrie,
                        'state' => $localNamestate,
                        'point' => $point,
            ]);
        }

        //return $this->render('lockers', ['txt' => $txt, 'codes' => $codes, 'data' => $data]);
    }

    public function actionScanBag() {

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

        $listPoint = \common\models\costfit\PickingPoint::find()->where("pickingId = '" . $boxcode . "'")->one();
        $listPointItems = \common\models\costfit\PickingPointItems::find()->where("pickingId = '" . $boxcode . "' and  code = '" . $channel . "' ")->one();

        $localNamecitie = \common\models\dbworld\Cities::find()->where("cityId = '" . $listPoint->amphurId . "' ")->one();
        $localNamestate = \common\models\dbworld\States::find()->where("stateId = '" . $listPoint->provinceId . "' ")->one();
        $localNamecountrie = \common\models\dbworld\Countries::find()->where("countryId = '" . $listPoint->countryId . "' ")->one();
        $orderId = '';

        //Check ว่า BagNo. นี้ มีอยู่ใน Lockers และช่องนี้ยัง //
        //$BagDuplicate = \common\models\costfit\OrderItemPacking::find()->where("bagNo = '" . $bagNo . "' and status < 8 and pickingItemsId !='' ")->count();
        //End Check ว่า BagNo. นี้ มีอยู่ใน Lockers และช่องนี้ยัง //

        if ($bagNo != '') {
            $queryOrderItemPackingId = \common\models\costfit\OrderItemPacking::find()
                            ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, '
                                    . 'order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,'
                                    . 'count(order_item_packing.quantity) AS NumberOfQuantity , order.orderNo, order.orderId , order.pickingId')
                            ->joinWith(['orderItems'])
                            ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                            ->where("order_item_packing.status = 5 and order_item_packing.bagNo ='" . $bagNo . "' and order.pickingId = '" . $boxcode . "' "
                                    . "or order_item_packing.status = 7 and order_item_packing.bagNo ='" . $bagNo . "' and order.pickingId = '" . $boxcode . "'")
                            ->groupBy(['order_item_packing.bagNo'])->one();

            if (count($queryOrderItemPackingId) == 0) {
                return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?pickingItemsId=' . $pickingItemsId . '&boxcode=' . $boxcode . '&model=' . $model . '&code=' . $channel . '&orderId=' . $orderId . '&c=e');
            }
            $orderId = $queryOrderItemPackingId->orderId; // ได้ OrderId มาเพื่อหา ????
            $orderItemId = $queryOrderItemPackingId->orderItemId; // ได้ OrderId มาเพื่อหา ????
            $orderItemPackingId = $queryOrderItemPackingId->orderItemPackingId;


            $query = \common\models\costfit\OrderItemPacking::find()
                    ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, '
                            . 'order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,count(order_item_packing.quantity) AS NumberOfQuantity, '
                            . 'order.orderNo, '
                            . 'order.orderId,order_item_packing.quantity')
                    ->joinWith(['orderItems'])
                    ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                    ->where("order_item_packing.status = 5 and order_item_packing.bagNo ='" . $bagNo . "' ")
                    ->groupBy(['order_item_packing.bagNo']);

            $queryCountBag = \common\models\costfit\OrderItemPacking::find()
                            ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, '
                                    . 'order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,count(order_item_packing.quantity) AS NumberOfQuantity, '
                                    . 'order.orderNo, '
                                    . 'order.orderId,order_item_packing.quantity')
                            ->joinWith(['orderItems'])
                            ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                            ->where("order_item_packing.status = 5 and order_item_packing.bagNo ='" . $bagNo . "' ")
                            ->groupBy(['order_item_packing.bagNo'])->one();

            if (count($queryCountBag) > 0) {
                //echo 'มี BagNo นี้';
                //echo 'xxx : ' . $orderId . 'xx : ' . $orderItemPackingId;
                $countBag = \common\models\costfit\OrderItemPacking::find()
                        ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, order_item_packing.status')
                        ->joinWith(['orderItems'])
                        ->where("order_item.orderId = '" . $orderId . "' and order_item_packing.status = 5")
                        ->groupBy(['order_item_packing.bagNo'])
                        ->count();
                //echo $countBag;
                $OrderItemPacking = \common\models\costfit\OrderItemPacking::find()->where(" orderItemPackingId = '" . $orderItemPackingId . "'")->one();
                if ($countBag > 1) {
                    if (count($listPointItems) > 0) {
                        \common\models\costfit\OrderItemPacking::updateAll(['status' => 7, 'pickingItemsId' => $listPointItems->pickingItemsId], ['bagNo' => $bagNo]);
                        \common\models\costfit\OrderItem::updateAll(['status' => 14], ['orderItemId' => $OrderItemPacking->orderItemId]);
                        //$Order = \common\models\costfit\OrderItem::find()->where("orderItemId = '" . $OrderItemPacking->orderItemId . "' ")->one();
                        \common\models\costfit\Order::updateAll(['status' => 14], ['orderId' => $orderId]);

                        return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?close=no&model=' . $model . '&code=' . $channel . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '&bagNo=' . $bagNo . '');


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
                    $listPointItems = \common\models\costfit\PickingPointItems::find()->where("pickingId = '" . $boxcode . "' and  code = '" . $channel . "' and pickingItemsId  = '" . $pickingItemsId . "' ")->one();

                    if (count($listPointItems) > 0) {
                        // if ($close == 'yes') {
                        \common\models\costfit\OrderItemPacking::updateAll(['status' => 7, 'pickingItemsId' => $listPointItems->pickingItemsId], ['bagNo' => $bagNo]);
                        \common\models\costfit\OrderItem::updateAll(['status' => 15], ['orderId' => $orderId]);
                        \common\models\costfit\Order::updateAll(['status' => 15], ['orderId' => $orderId]);

                        return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?close=no&model=' . $model . '&code=' . $channel . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '&bagNo=' . $bagNo . '');

                        // }
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

                }
            }

            //->where("order_item.orderId = '" . $orderId . "' and order_item_packing.status = 5 and order_item_packing.bagNo ='" . $bagNo . "' ");
            /*
              Query ส่วนของแสดง Order ของถุงนี้ที่ ใส่เข้าช่องของ Lockers นี้แล้ว
             */
            $query1 = \common\models\costfit\OrderItemPacking::find()
                    ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.pickingItemsId, '
                            . 'order_item_packing.bagNo, order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,'
                            . 'count(order_item_packing.quantity) AS NumberOfQuantity, order.orderNo, '
                            . 'order.orderId ,order_item_packing.quantity')
                    ->joinWith(['orderItems'])
                    ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                    //->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                    //->where("order_item_packing.status in (7,8) and  order.orderId ='" . $orderId . "' or order_item_packing.status in (7,8) and  order_item_packing.bagNo ='" . $bagNo . "' ")
                    ->where("order_item_packing.status in (7,8) and  order_item.orderItemId ='" . $orderItemId . "' or order_item_packing.status in (7,8) "
                            . "and  order_item_packing.bagNo ='" . $bagNo . "' ")
                    //->where("order_item_packing.status in (7,8) and  order_item_packing.bagNo ='" . $bagNo . "' ")
                    //->where("order_item_packing.status = 5 and order_item_packing.bagNo ='" . $bagNo . "' ")
                    ->groupBy(['order_item_packing.bagNo']);

            // แสดงจำนวนถุงของ Order นี้ทั้งหมด
            $queryAllOrder = \common\models\costfit\OrderItemPacking::find()
                    ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, '
                            . 'order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,count(order_item_packing.quantity) AS NumberOfQuantity, '
                            . 'order.orderNo, '
                            . 'order.orderId,order_item_packing.quantity')
                    ->joinWith(['orderItems'])
                    ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                    ->where("order_item_packing.status = 5 and order.orderId ='" . $orderId . "' ")
                    ->groupBy(['order_item_packing.bagNo']);
        } else {
            //echo 'xx'; แสดง BagNo ที่ Scan Qr code
            $query1 = \common\models\costfit\OrderItemPacking::find()
                    ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId,  order_item_packing.pickingItemsId,'
                            . 'order_item_packing.bagNo, order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,'
                            . 'count(order_item_packing.quantity) AS NumberOfQuantity, order.orderNo, '
                            . 'order.orderId ,order_item_packing.quantity')
                    ->joinWith(['orderItems'])
                    ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                    ->where("order_item_packing.status in (7,8) and  order_item_packing.orderItemId ='" . $orderItemId . "'")
                    //->where("order_item_packing.status = 5 and order_item_packing.bagNo ='" . $bagNo . "' ")
                    ->groupBy(['order_item_packing.bagNo']);

            $query = \common\models\costfit\OrderItemPacking::find()
                    ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, order_item_packing.status')
                    ->joinWith(['orderItems'])
                    ->where("order_item.orderId = '" . $orderId . "' and order_item_packing.status = 5");

            // แสดงจำนวนถุงของ Order นี้ทั้งหมด
            $queryAllOrder = \common\models\costfit\OrderItemPacking::find()
                    ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, '
                            . 'order_item_packing.status , count(order_item_packing.bagNo) AS NumberOfBagNo ,count(order_item_packing.quantity) AS NumberOfQuantity, '
                            . 'order.orderNo, '
                            . 'order.orderId,order_item_packing.quantity')
                    ->joinWith(['orderItems'])
                    ->join('LEFT JOIN', 'order', 'order_item.orderId = order.orderId')
                    ->where("order_item_packing.status = 5 and order.orderId ='" . $orderId . "' ")
                    ->groupBy(['order_item_packing.bagNo']);
        }

        // echo $queryCountBag->NumberOfBagNo;

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
                    'c' => $c,
                        //'VarBagDuplicate' => $BagDuplicate = 1,
        ]);
        //}
    }

    public function actionCloseChannel() {
        $request = Yii::$app->request;

        if ($request->isGet) { /* the request method is GET */
            $orderId = Yii::$app->request->get('

        orderId');
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
        $countBag = \common\models\costfit\OrderItemPacking::find()
                ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, order_item_packing.status')
                ->joinWith(['orderItems'])
                ->where("order_item.orderId = '" . $orderId . "' and order_item_packing.status = 5")
                ->groupBy(['order_item_packing.bagNo'])
                ->count();
        //echo $countBag;
        $OrderItemPacking = \common\models\costfit\OrderItemPacking::find()->where(" orderItemPackingId = '" . $orderItemPackingId . "'")->one();

        //echo '<pre>';
        //print_r($countBag);
        //exit();

        if ($countBag == 0) {
            $listPointItems = \common\models\costfit\PickingPointItems::find()->where("pickingId = '" . $boxcode . "' and  code = '" . $channel . "' and pickingItemsId  = '" . $pickingItemsId . "' ")->one();
            //echo '<pre>';
            //print_r($listPointItems);
            //echo count($listPointItems);
            // exit();
            if (count($listPointItems) > 0) {

                if ($status == 'now') {
                    \common\models\costfit\PickingPointItems::updateAll(['status' => 0], ['pickingItemsId' => $listPointItems->pickingItemsId]);
                    return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/lockers?boxcode=' . $boxcode);
                } elseif ($status == 'latter') {
                    \common\models\costfit\PickingPointItems::updateAll(['status' => 1], ['pickingItemsId' => $listPointItems->pickingItemsId]);
                    return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?close=no&model=' . $model . '&code=' . $channel . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '&bagNo=' . $bagNo . '');
                } else {
                    \common\models\costfit\PickingPointItems::updateAll(['status' => 1], ['pickingItemsId' => $listPointItems->pickingItemsId]);
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
            $listPointItems = \common\models\costfit\PickingPointItems::find()->where("pickingId = '" . $boxcode . "' and  code = '" . $channel . "' and pickingItemsId  = '" . $pickingItemsId . "' ")->one();

            if (count($listPointItems) > 0) {

                if ($status == 'now') {
                    \common\models\costfit\PickingPointItems::updateAll(['status' => 0], ['pickingItemsId' => $listPointItems->pickingItemsId]);
                    return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/lockers?boxcode=' . $boxcode);
                } elseif ($status == 'latter') {
                    \common\models\costfit\PickingPointItems::updateAll(['status' => 1], ['pickingItemsId' => $listPointItems->pickingItemsId]);
                    return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?close=no&model=' . $model . '&code=' . $channel . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '&bagNo=' . $bagNo . '');
                } else {
                    \common\models\costfit\PickingPointItems::updateAll(['status' => 1], ['pickingItemsId' => $listPointItems->pickingItemsId]);
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

    public function actionReturnBag() {
        //return
        $model = Yii::$app->request->get('model');
        $code = Yii::$app->request->get('code');
        $boxcode = Yii::$app->request->get('boxcode');
        $pickingItemsId = Yii::$app->request->get('pickingItemsId');
        $orderId = Yii::$app->request->get('orderId');
        $orderItemPackingId = Yii::$app->request->get('orderItemPackingId');
        $bagNo = Yii::$app->request->get('bagNo');

        //echo $orderItemPackingId;
        //exit();
        \common\models\costfit\OrderItemPacking::updateAll(['status' => 5, 'pickingItemsId' => 0], ['bagNo' => $bagNo]);
        return $this->redirect(Yii::$app->homeUrl . '/lockers/lockers/lockers?boxcode=' . $boxcode);
        //\common\models\costfit\PickingPointItems::updateAll(['status' => 1], ['pickingItemsId' => $pickingItemsId]);
        ///scan-bag?model=1&code=aa-009&boxcode=10&pickingItemsId=111&orderId=&orderItemPackingId=&bagNo=BG20161019-0000008
        //return $this->redirect(Yii::$app->homeUrl . '/lockers/lockers/scan-bag?model=' . $model . '&code=' . $code . '&boxcode=' . $boxcode . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId . '&bagNo=' . $bagNo . '');
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

    static public function sendEmail($orderId) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (isset($order) && !empty($order)) {
            $user = \common\models\costfit\User::find()->where("userId=" . $order->userId)->one();
            if (isset($user) && !empty($user)) {
                $email = new EmailSend();
                $toMail = $user->email;
                $userName = $user->firstname . " " . $user->lastname;
                $password = $order->password;
                $picking = PickingPoint::find()->where("pickingId=" . $order->pickingId)->one();
                $location = $picking->title;
                $email->mailSendPassword($toMail, $userName, $password, $location);
            }
        }
    }

    public function actionChannels() {
        $pickingId = Yii::$app->request->get('boxcode');
        if ($pickingId != '') {
            $listPoint = \common\models\costfit\PickingPoint::find()->where("pickingId = '" . $pickingId . "'")->one();
            $localNamecitie = \common\models\dbworld\Cities::find()->where("cityId = '" . $listPoint->amphurId . "' ")->one();
            $localNamestate = \common\models\dbworld\States::find()->where("stateId = '" . $listPoint->provinceId . "' ")->one();
            $localNamecountrie = \common\models\dbworld\Countries::find()->where("countryId = '" . $listPoint->countryId . "' ")->one();

            /*
             * API OPEN CAHNNELS LOCKERS To Hardware
             */
            // Codeding..
            /*
             * END API OPEN CAHNNELS LOCKERS
             */

            $query = \common\models\costfit\PickingPointItems::find()
                    //->join('RIGHT JOIN', 'order_item_packing', 'order_item_packing.pickingItemsId =picking_point_items.pickingItemsId')
                    ->where("picking_point_items.pickingId = '" . $pickingId . "'");

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            $point = PickingPoint::find()->where("pickingId=" . $pickingId)->one();

            return $this->render('channels', [
                        'dataProvider' => $dataProvider, 'listPoint' => $listPoint,
                        'citie' => $localNamecitie,
                        'countrie' => $localNamecountrie,
                        'state' => $localNamestate,
                        'point' => $point,
            ]);
        }
    }

}
