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

        return $this->render('index', ['txt' => $txt, 'codes' => $codes, 'data' => $data]);
    }

    public function actionLockers() {

        $pickingId = Yii::$app->request->get('boxcode');
        if ($pickingId != '') {

            $listPoint = \common\models\costfit\PickingPoint::find()->where("pickingId = '" . $pickingId . "'")->one();
            $localNamecitie = \common\models\dbworld\Cities::find()->where("cityId = '" . $listPoint->amphurId . "' ")->one();
            $localNamestate = \common\models\dbworld\States::find()->where("stateId = '" . $listPoint->provinceId . "' ")->one();
            $localNamecountrie = \common\models\dbworld\Countries::find()->where("countryId = '" . $listPoint->countryId . "' ")->one();

//$test = \common\models\costfit\OrderItemPacking::find()->where()->one();

            /*
              $orderNo = \common\models\costfit\Order::find()
              //->select("`order`.*,oi.*")
              //->join("RIGHT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
              //->where("oi.status = 6 OR oi.status = 14");
              ->select('*')
              ->joinWith(['orderItems'])
              ->where("order_item.status = 6 or order_item.status >= 14");
             */

            /*
             * API OPEN CAHNNELS LOCKERS To Hardware
             */
            // Codeding..
            /*
             * END API OPEN CAHNNELS LOCKERS
             */


            $query = \common\models\costfit\PickingPointItems::find()
                    //->join('RIGHT JOIN', 'order_item_packing', 'order_item_packing.pickingItemsId =picking_point_items.pickingItemsId')
                    ->where("picking_point_items.pickingId = '" . $pickingId . "'")
            ;

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('lockers', [
                        'dataProvider' => $dataProvider, 'listPoint' => $listPoint,
                        'citie' => $localNamecitie,
                        'countrie' => $localNamecountrie,
                        'state' => $localNamestate,
            ]);
        }

        //return $this->render('lockers', ['txt' => $txt, 'codes' => $codes, 'data' => $data]);
    }

    public function actionChannels() {

        $boxcode = Yii::$app->request->get('boxcode');
        $channel = Yii::$app->request->get('code');
        $orderId = Yii::$app->request->get('orderId');
        $model = Yii::$app->request->get('model');
        $orderNo = Yii::$app->request->get('orderNo');

        if ($boxcode != '') {
            $listPoint = \common\models\costfit\PickingPoint::find()->where("pickingId = '" . $boxcode . "'")->one();
            $listPointItems = \common\models\costfit\PickingPointItems::find()->where("pickingId = '" . $boxcode . "' and  code = '" . $channel . "' ")->one();
            if (count($listPointItems) > 0) {
                $localNamecitie = \common\models\dbworld\Cities::find()->where("cityId = '" . $listPoint->amphurId . "' ")->one();
                $localNamestate = \common\models\dbworld\States::find()->where("stateId = '" . $listPoint->provinceId . "' ")->one();
                $localNamecountrie = \common\models\dbworld\Countries::find()->where("countryId = '" . $listPoint->countryId . "' ")->one();
            } else {
                $localNamecitie = null;
                $localNamestate = null;
                $localNamecountrie = null;
            }
            // แสดงสถานที่ Locker นั่น

            $checkOrderId = \common\models\costfit\Order::find()->where("orderNo  = '" . $orderNo . "' and pickingId ='" . $boxcode . "'")->one();
            // echo count($checkOrderId);
            if (count($checkOrderId) > 0) {
                $orderId = $checkOrderId->orderId;
                $pickingId = $checkOrderId->pickingId;
                $query = \common\models\costfit\Order::find()
                        ->select('*')
                        ->joinWith(['orderItems'])
                        ->where("order_item.status >= 14 and order.pickingId = '" . $boxcode . "' and orderNo   ='" . $orderNo . "'");
                //$ordersending = \common\models\costfit\PickingPoint::ordersending($orderNo, $boxcode);
                $warning = 'yes';
            } else {
                $orderId = '';
                $query = \common\models\costfit\Order::find()
                        ->select('*')
                        ->joinWith(['orderItems'])
                        ->where("order_item.status >= 14 and order.pickingId = '" . $boxcode . "'  and orderNo   ='" . $orderNo . "'");
                //$this->redirect(Yii::$app->homeUrl . 'lockers/lockers/lockers?boxcode=' . $boxcode);
                $warning = 'no';
            }

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            return $this->render('channels', [
                        'dataProvider' => $dataProvider, 'listPoint' => $listPoint,
                        'citie' => $localNamecitie,
                        'countrie' => $localNamecountrie,
                        'state' => $localNamestate,
                        'listPointItems' => $listPointItems,
                        'model' => $model,
                        'boxcode' => $boxcode,
                        'channel' => $channel,
                        'warning' => $warning,
                        'orderId' => $orderId
            ]);
            //$query = \common\models\costfit\Order::find()->where("orderNo = '" . $orderNo . "'");
            // echo $this->orders($orderNo, $listPoint, $localNamecitie, $localNamecountrie, $localNamestate, $listPointItems, $model);
        } else {

        }
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

        if ($bagNo != '') {

            $queryOrderItemPackingId = \common\models\costfit\OrderItemPacking::find()
                            ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId,order_item_packing.bagNo,order_item_packing.status')
                            ->joinWith(['orderItems'])
                            ->where("order_item.orderId = '" . $orderId . "' and order_item_packing.status = 5 and order_item_packing.bagNo ='" . $bagNo . "' ")->one();
            //echo '<pre>';
            //print_r($queryOrderItemPackingId);
            // exit();
            $orderItemPackingId = $queryOrderItemPackingId->orderItemPackingId;
            $query = \common\models\costfit\OrderItemPacking::find()
                    ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId,order_item_packing.bagNo,order_item_packing.status')
                    ->joinWith(['orderItems'])
                    ->where("order_item.orderId = '" . $orderId . "' and order_item_packing.status = 5 and order_item_packing.bagNo ='" . $bagNo . "' ");
        } else if ($channels != '') {
            // OrderItemPacking  มากกว่า 1 รายการ

            $countBag = \common\models\costfit\OrderItemPacking::find()
                            ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId,order_item_packing.bagNo,order_item_packing.status')
                            ->joinWith(['orderItems'])
                            ->where("order_item.orderId = '" . $orderId . "' and order_item_packing.status = 5")->count();

            $OrderItemPacking = \common\models\costfit\OrderItemPacking::find()->where(" orderItemPackingId = '" . $orderItemPackingId . "'")->one();
            //echo $countBag . 'xx<br>';
            // echo $OrderItemPacking->orderItemId;
            // exit();
            if ($countBag > 1) {
                \common\models\costfit\OrderItemPacking::updateAll(['status' => 7, 'pickingItemsId' => $listPointItems->pickingItemsId], ['orderItemPackingId' => $orderItemPackingId]);
                \common\models\costfit\OrderItem::updateAll(['status' => 14], ['orderItemId' => $OrderItemPacking->orderItemId]);
                //$Order = \common\models\costfit\OrderItem::find()->where("orderItemId = '" . $OrderItemPacking->orderItemId . "' ")->one();
                \common\models\costfit\Order::updateAll(['status' => 14], ['orderId' => $orderId]);
                return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/scan-bag?pickingItemsId=' . $pickingItemsId . '&boxcode=' . $boxcode . '&model=' . $model . '&code=' . $channels . '&orderId=' . $orderId . '');
            } else if ($countBag == 1) {

                \common\models\costfit\OrderItemPacking::updateAll(['status' => 7, 'pickingItemsId' => $listPointItems->pickingItemsId], ['orderItemPackingId' => $orderItemPackingId]);
                \common\models\costfit\OrderItem::updateAll(['status' => 15], ['orderId' => $orderId]);
                //$Order = \common\models\costfit\OrderItem::find()->where("orderItemId = '" . $OrderItemPacking->orderItemId . "' ")->one();
                \common\models\costfit\Order::updateAll(['status' => 15], ['orderId' => $orderId]);

                //return $this->redirect(Yii::$app->homeUrl . 'lockers/lockers/lockers?boxcode=' . $boxcode);
                return $this->render('location', [
                            'warning' => 'roundone',
                            'boxcode' => $boxcode,
                ]);
            } else {

            }
            //exit();
        } else {
            //echo 'xx';
            $query = \common\models\costfit\OrderItemPacking::find()
                    ->select('order_item_packing.orderItemPackingId, order_item_packing.orderItemId, order_item_packing.bagNo, order_item_packing.status')
                    ->joinWith(['orderItems'])
                    ->where("order_item.orderId = '" . $orderId . "' and order_item_packing.status = 5");
        }



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('scanbag', [
                    'dataProvider' => $dataProvider, 'listPoint' => $listPoint,
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
                    'orderItemPackingId' => $orderItemPackingId
        ]);
        //}
    }

    public function actionScanOrder() {
        $pickingId = Yii::$app->request->get('boxcode');
        $orderNo = Yii::$app->request->get('orderNo');
        $channel = Yii::$app->request->get('code');
        $orderId = Yii::$app->request->get('orderId');
        $model = Yii::$app->request->get('model');
        if ($pickingId != '' and $orderNo != '') {
            $listPoint = \common\models\costfit\PickingPoint::find()->where("pickingId = '" . $pickingId . "'")->one();
            $listPointItems = \common\models\costfit\PickingPointItems::find()->where("pickingId = '" . $pickingId . "'  ")->one();
            $localNamecitie = \common\models\dbworld\Cities::find()->where("cityId = '" . $listPoint->amphurId . "' ")->one();
            $localNamestate = \common\models\dbworld\States::find()->where("stateId = '" . $listPoint->provinceId . "' ")->one();
            $localNamecountrie = \common\models\dbworld\Countries::find()->where("countryId = '" . $listPoint->countryId . "' ")->one();
            $query = \common\models\costfit\Order::find()->where("orderNo = '" . $orderNo . "'");
//echo $this->orders($orderNo, $listPoint, $localNamecitie, $localNamecountrie, $localNamestate, $listPointItems, $model);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('scanorder', [
                        'dataProvider' => $dataProvider, 'listPoint' => $listPoint,
                        'citie' => $localNamecitie,
                        'countrie' => $localNamecountrie,
                        'state' => $localNamestate,
                        'listPointItems' => $listPointItems,
                        'model' => $model,
            ]);
        }
//echo$this->order();
//return $this->render('index');
    }

}
