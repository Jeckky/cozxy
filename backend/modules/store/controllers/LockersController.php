<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\Store;
use common\models\costfit\Order;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use common\models\costfit\PickingPointItems;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class LockersController extends StoreMasterController {

    public function actionIndex() {

        $orderItemId = Yii::$app->request->get('orderItemId');
        $bagNo = Yii::$app->request->get('bagNo');
        if ($orderItemId != '') {
            $query = \common\models\costfit\OrderItemPacking::find()
                    ->select('*')
//->joinWith(['orderItems'])
                    ->where(['orderItemId' => $orderItemId])
                    ->andWhere(['>', 'status', 4]);
        } else if ($bagNo != '') {
            $query = \common\models\costfit\OrderItemPacking::find()
                    ->select('*')
//->joinWith(['orderItems'])
                    ->where(['status' => 5, 'bagNo' => $bagNo]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('index', [
                    'dataProvider' => $dataProvider, 'bagNo' => $bagNo
        ]);
    }

    public function actionBagnoLockers() {

        $bagNo = Yii::$app->request->get('bagNo');
        $lockersNo = Yii::$app->request->get('lockers');

        if ($lockersNo != '') {
            $query = \common\models\costfit\PickingPointItems::find()
//->joinWith(['orderItems'])
                            ->where(['code' => $lockersNo])->one();
//echo '<pre>';
//print_r($query);
            if (count($query) > 0) {
//echo 'มีรหัส lockers No นี้';
                $lockersCode = TRUE;
//echo $query->pickingItemsId;
                $useSlot = \common\models\costfit\OrderItemPacking::find()->where(" pickingItemsId = " . $query->pickingItemsId . " and status = 7")->one(); //มีใช้แล้วหรือเปล่า
                if (!isset($useSlot)) {
                    $OrderItemPacking = \common\models\costfit\OrderItemPacking::find()->where(" bagNo = '" . $bagNo . "'")->one();

                    \common\models\costfit\OrderItemPacking::updateAll(['status' => 7, 'pickingItemsId' => $query->pickingItemsId], ['bagNo' => $bagNo]);
                    //echo '<pre>';
                    //print_r($OrderItemPacking);
                    \common\models\costfit\OrderItem::updateAll(['status' => 15], ['orderItemId' => $OrderItemPacking->orderItemId]);
                    $Order = \common\models\costfit\OrderItem::find()->where("orderItemId = '" . $OrderItemPacking->orderItemId . "' ")->one();
                    \common\models\costfit\Order::updateAll(['status' => 15], ['orderId' => $Order->orderId]);
                } else {

                }

                $query = \common\models\costfit\OrderItemPacking::find()
                        ->select('*')
                        //->joinWith(['orderItems'])
                        ->where(['bagNo' => $bagNo]);
            } else {
                //echo 'ไม่พบ lockers No นี';
                $lockersCode = FALSE;
                $query = \common\models\costfit\OrderItemPacking::find()
                        ->select('*')
                        //->joinWith(['orderItems'])
                        ->where(['bagNo' => $bagNo]);
            }
        } else {
            $query = \common\models\costfit\OrderItemPacking::find()
                    ->select('*')
                    //->joinWith(['orderItems'])
                    ->where(['bagNo' => $bagNo]);
        }
        // echo '<pre>';
        //print_r($query);
        //exit();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('lockers', [ 'dataProvider' => $dataProvider, 'bagNo' => $bagNo]);
    }

}
