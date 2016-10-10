<?php

namespace backend\modules\store\controllers;

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

class ShippingsController extends StoreMasterController {

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

            $query = \common\models\costfit\PickingPointItems::find()
                    //->join('inner JOIN', 'order', 'order.pickingId =picking_point_items.pickingId')
                    ->where("picking_point_items.pickingId = '" . $pickingId . "'")
            //->andWhere('order.status=16')
            //->distinct('picking_point_items.pickingId', TRUE)
            ;

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('lockers', [
                        'dataProvider' => $dataProvider, 'listPoint' => $listPoint,
                        'citie' => $localNamecitie,
                        'countrie' => $localNamecountrie,
                        'state' => $localNamestate
            ]);
        }

        //return $this->render('lockers', ['txt' => $txt, 'codes' => $codes, 'data' => $data]);
    }

    public function actionChannels() {
        $pickingId = Yii::$app->request->get('boxcode');
        $channel = Yii::$app->request->get('code');
        $orderId = Yii::$app->request->get('orderId');
        $model = Yii::$app->request->get('model');
        $orderNo = Yii::$app->request->get('orderNo');

        if ($pickingId != '') {
            $listPoint = \common\models\costfit\PickingPoint::find()->where("pickingId = '" . $pickingId . "'")->one();
            $listPointItems = \common\models\costfit\PickingPointItems::find()->where("pickingId = '" . $pickingId . "' and  code = '" . $channel . "' ")->one();
            $localNamecitie = \common\models\dbworld\Cities::find()->where("cityId = '" . $listPoint->amphurId . "' ")->one();
            $localNamestate = \common\models\dbworld\States::find()->where("stateId = '" . $listPoint->provinceId . "' ")->one();
            $localNamecountrie = \common\models\dbworld\Countries::find()->where("countryId = '" . $listPoint->countryId . "' ")->one();
            $query = \common\models\costfit\Order::find()->where("orderId = '" . $orderId . "'");
            // echo $this->orders($orderNo, $listPoint, $localNamecitie, $localNamecountrie, $localNamestate, $listPointItems, $model);

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
            ]);
        }
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
            //$query = \common\models\costfit\Order::find()->where("orderId = '" . $orderId . "'");
            //echo $this->orders($orderNo, $listPoint, $localNamecitie, $localNamecountrie, $localNamestate, $listPointItems, $model);
            /*
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
             * */
        }
        //echo$this->order();
        //return $this->render('index');
    }

    public function actionScanbag() {
        //'params : ' . \Yii::$app->params['shippingScanTrayOnly']; // มีค่าเท่ากับเริ่มต้น false
        $bagNo = Yii::$app->request->get('bagNo');
        $orderNo = Yii::$app->request->get('orderNo');

        if ($orderNo != '') {
            $query = \common\models\costfit\OrderItemPacking::find()
                    ->select('*')
                    //->joinWith(['orderItems'])
                    ->where(['status' => 5]); //5 : กำลังจัดส่ง
        } else {
            $query = \common\models\costfit\OrderItemPacking::find()
                    ->select('*')
                    //->joinWith(['orderItems'])
                    ->where(['status' => 4]); // 4: ปิดถุงแล้ว
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($bagNo != '') {
            $queryList = \common\models\costfit\Order::find()->where("orderNo = '" . $orderNo . "' ")->one();
            $query = \common\models\costfit\OrderItem::find()->where("orderId=" . $queryList->orderId . ' and status = 6')->one();
            \common\models\costfit\OrderItemPacking::updateAll(['status' => 5], ['bagNo' => $bagNo, 'orderItemId' => $query->orderItemId]);
            \common\models\costfit\Order::updateAll(['status' => 14], [ 'orderId' => $queryList->orderId]);
            \common\models\costfit\OrderItem::updateAll(['status' => 14], [ 'orderItemId' => $query->orderItemId]);
        }

        //print_r($query);
        return $this->render('scanbag', [
                    'dataProvider' => $dataProvider, 'orderNo' => $orderNo
        ]);
    }

    public function orders($orderNo, $listPoint, $localNamecitie, $localNamecountrie, $localNamestate, $listPointItems, $model) {
        //'params : ' . \Yii::$app->params['shippingScanTrayOnly']; // มีค่าเท่ากับเริ่มต้น true
        if ($orderNo != '') {
            $query = \common\models\costfit\Order::find()
                    ->select('*')
                    ->joinWith(['orderItems'])
                    //->where("(order_item.status = 6 or order_item.status = 14) and order.orderNo = '" . $orderNo . "'"); //['order_item.status' => 6, 'order.orderNo' => $orderNo]
                    ->where("(order_item.status = 6 or order_item.status >= 14) "); //['order_item.status' => 6, 'order.orderNo' => $orderNo]
        } else {

            $query = \common\models\costfit\Order::find()
                    //->select("`order`.*,oi.*")
                    //->join("RIGHT JOIN", 'order_item oi', 'oi.orderId = `order`.orderId')
                    //->where("oi.status = 6 OR oi.status = 14");
                    ->select('*')
                    ->joinWith(['orderItems'])
                    ->where("order_item.status = 6 or order_item.status >= 14");
        }

        if ($orderNo != '') {
            if (\Yii::$app->params['shippingScanTrayOnly'] == true) {
                /* shippingScanTrayOnly = true เข้าเงื่อนไขที่ 1 ต้อง Scan ทีละ OrderId */
                //$query = \common\models\costfit\OrderItemPacking::find()->where('status =4')->all();

                $queryList = \common\models\costfit\Order::find()->where("orderNo = '" . $orderNo . "' ")->one();
                //throw new \yii\base\Exception(print_r($queryList, TRUE));
                $queryItem = \common\models\costfit\OrderItem::find()->where("orderId=" . $queryList->orderId . ' and status =13')->all(); // status : 6 pack ใส่ลงถุง

                foreach ($queryItem as $items) {
                    $orderItemPackings = OrderItemPacking::find()->where("orderItemId =" . $items->orderItemId . ' and status = ' . OrderItemPacking::ORDER_STATUS_CLOSE_BAG)->all(); // status 4 : ปิดถุงแล้ว
                    // echo '<pre>';
                    //throw new \yii\base\Exception(print_r($orderItemPackings, TRUE));
                    // exit();
                    if (isset($orderItemPackings)) {
                        foreach ($orderItemPackings as $packing) {
                            $packing->status = OrderItemPacking::ORDER_STATUS_SENDING_PACKING_SHIPPING;
                            $packing->save(FALSE);
                            $queryItemStatus = \common\models\costfit\OrderItem::find()->where("orderItemId=" . $packing->orderItemId . ' and status = 13')->all();
                            foreach ($queryItemStatus as $shipStatus) {
                                $shipStatus->status = \common\models\costfit\OrderItem::ORDER_STATUS_SENDING_SHIPPING; // orderItemId : status = 14
                                $shipStatus->save();
                                $queryList->status = \common\models\costfit\Order::ORDER_STATUS_SENDING_SHIPPING; // orderItemId : status = 14
                                $queryList->save();
                            }
                        }
                    }
                }
            } else {
                /* shippingScanTrayOnly = false เข้าเงื่อนไขที่ 2 ต้อง Scan ทีละถุง */
            }
            //$this->redirect(Yii::$app->homeUrl . 'store/shipping/');
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if ($model == 1) {
            $file = 'channels';
        } else if ($model == 2) {
            $file = 'scanorder';
        }
        return $this->render($file, [
                    'dataProvider' => $dataProvider, 'listPoint' => $listPoint,
                    'citie' => $localNamecitie,
                    'countrie' => $localNamecountrie,
                    'state' => $localNamestate,
                    'listPointItems' => $listPointItems,
                    'model' => $model,
        ]);
    }

}
