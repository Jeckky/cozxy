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

        //'params : ' . \Yii::$app->params['shippingScanTrayOnly']; // มีค่าเท่ากับเริ่มต้น true
        $orderNo = Yii::$app->request->get('orderNo');

        $query = \common\models\costfit\Order::find()
                ->select('*')
                ->joinWith(['orderItems'])
                ->where(['order_item.status' => 6, 'order.orderNo' => $orderNo]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (\Yii::$app->params['shippingScanTrayOnly'] == true) {
            /* shippingScanTrayOnly = true เข้าเงื่อนไขที่ 1 ต้อง Scan ที่ละ OrderId */
        } else {
            /* shippingScanTrayOnly = false เข้าเงื่อนไขที่ 2 ต้อง Scan ที่ละถุง */
        }
        //print_r($query);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);

        //return $this->render('index');
    }

}
