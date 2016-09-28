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
                    ->where(['order_item.status' => 14]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($orderNo != '') {
            if (\Yii::$app->params['shippingScanTrayOnly'] == true) {
                /* shippingScanTrayOnly = true เข้าเงื่อนไขที่ 1 ต้อง Scan ที่ละ OrderId */
                //$query = \common\models\costfit\OrderItemPacking::find()->where('status =4')->all();

                $queryList = \common\models\costfit\Order::find()->where("orderNo = '" . $orderNo . "' ")->one();
                $queryItem = \common\models\costfit\OrderItem::find()->where("orderId=" . $queryList->orderId . ' and status = 6')->all();
                //$queryItem->status = 14;
                //$queryItem->save();
                foreach ($queryItem as $items) {
                    $orderItemPackings = OrderItemPacking::find()->where("orderItemId =" . $items->orderItemId . ' and status = 4')->all();
                    //echo '<pre>';
                    //print_r($orderItemPackings);
                    //exit();
                    if (isset($orderItemPackings)) {
                        foreach ($orderItemPackings as $packing) {
                            $packing->status = 5;
                            $packing->save();
                            $queryItemStatus = \common\models\costfit\OrderItem::find()->where("orderItemId=" . $packing->orderItemId . ' and status = 6')->all();
                            foreach ($queryItemStatus as $shipStatus) {
                                $shipStatus->status = 14;
                                $shipStatus->save();
                            }
                        }

                        //$model = \common\models\costfit\OrderItem::updateAll(['orderItemId' => $items->orderItemId]);
                        // $model->status = 14;
                    }
                }
                // $queryItem->status = 14;
                // $queryItem->save();
            } else {
                /* shippingScanTrayOnly = false เข้าเงื่อนไขที่ 2 ต้อง Scan ที่ละถุง */
            }
        }


        //print_r($query);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);

        //return $this->render('index');
    }

}
