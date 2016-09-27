<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\Store;
use common\models\costfit\Order;
use common\models\costfit\PickingPoint;
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

        /* $query = \common\models\costfit\Order::find()
          ->leftJoin('order_item', 'order_item.orderId = order.orderId')
          ->where(['order_item.status' => 6, 'orderNo' => Yii::$app->request->get('orderNo')]);
         */
        $query = \common\models\costfit\Order::find()
                ->select('*')
                ->joinWith(['orderItems'])
                ->where(['order_item.status' => 6, 'order.orderNo' => Yii::$app->request->get('orderNo')]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //print_r($query);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);

        //return $this->render('index');
    }

}
