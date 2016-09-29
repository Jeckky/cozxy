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

// อยู่ที่ไหน ช่องไหน : หยิบโปรดักจากสโตร์ไป Picking ponit
class ShippingController extends StoreMasterController {
    /*
      return Foo::find()->joinWith('bars')
      ->leftJoin('tbl_bar_subscription', 'tbl_bar_subscription.bar_id = bar.id')
      ->where(['tbl_bar_subscription.client_id' => $this->id])
      ->distinct();
     */

    public function actionIndex() {

        //'params : ' . \Yii::$app->params['shippingScanTrayOnly']; // มีค่าเท่ากับเริ่มต้น true
        $orderNo = Yii::$app->request->get('orderNo');
        if ($orderNo != '') {
            $query = \common\models\costfit\Order::find()
                    ->select('*')
                    ->joinWith(['orderItems'])
                    ->where(['order_item.status' => 6, 'order.orderNo' => $orderNo]);
        } else {
            $query = \common\models\costfit\Order::find()
                    ->select('*')
                    ->joinWith(['orderItems'])
                    ->where(['order_item.status' => \common\models\costfit\Order::ORDER_STATUS_SENDING_SHIPPING]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($orderNo != '') {
            if (\Yii::$app->params['shippingScanTrayOnly'] == true) {
                /* shippingScanTrayOnly = true เข้าเงื่อนไขที่ 1 ต้อง Scan ทีละ OrderId */
                //$query = \common\models\costfit\OrderItemPacking::find()->where('status =4')->all();

                $queryList = \common\models\costfit\Order::find()->where("orderNo = '" . $orderNo . "' ")->one();
                $queryItem = \common\models\costfit\OrderItem::find()->where("orderId=" . $queryList->orderId . ' and status =' . \common\models\costfit\OrderItem::ORDERITEM_PICKED_BAGNO)->all(); // status : 6 pack ใส่ลงถุง
                //$queryItem->status = 14;
                //$queryItem->save();
                foreach ($queryItem as $items) {
                    $orderItemPackings = OrderItemPacking::find()->where("orderItemId =" . $items->orderItemId . ' and status = ' . OrderItemPacking::ORDER_STATUS_CLOSE_BAG)->all(); // status 4 : ปิดถุงแล้ว
                    // echo '<pre>';
                    //print_r($orderItemPackings);
                    // exit();
                    if (isset($orderItemPackings)) {
                        foreach ($orderItemPackings as $packing) {
                            $packing->status = OrderItemPacking::ORDER_STATUS_SENDING_PACKING_SHIPPING;
                            $packing->save(FALSE);
                            $queryItemStatus = \common\models\costfit\OrderItem::find()->where("orderItemId=" . $packing->orderItemId . ' and status = ' . \common\models\costfit\OrderItem::ORDERITEM_PICKED_BAGNO)->all();
                            foreach ($queryItemStatus as $shipStatus) {
                                $shipStatus->status = \common\models\costfit\OrderItem::ORDER_STATUS_SENDING_SHIPPING; // orderItemId : status = 14
                                $shipStatus->save();
                                $queryList->status = \common\models\costfit\Order::ORDER_STATUS_SENDING_SHIPPING; // orderItemId : status = 14
                                $queryList->save();
                            }
                            //\common\models\costfit\OrderItem::updateAll(['status' => \common\models\costfit\OrderItem::ORDER_STATUS_SENDING_SHIPPING], ['orderItemId' => $packing->orderItemId, 'status' => 6]);
                            //echo '<pre>';
                            //print_r($packing);
                        }
                    }
                }
                //$this->redirect(Yii::$app->homeUrl . 'store/shipping/index?orderNo=OD201608-0000066');
                // $queryItem->status = 14;
                // $queryItem->save();
            } else {
                /* shippingScanTrayOnly = false เข้าเงื่อนไขที่ 2 ต้อง Scan ทีละถุง */
            }
        }



        //print_r($query);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);

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

}
