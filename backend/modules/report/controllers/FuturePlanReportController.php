<?php

namespace backend\modules\report\controllers;

use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;

class FuturePlanReportController extends ReportMasterController
{

    public function actionIndex()
    {
        $model = \common\models\costfit\OrderItem::find()->select("order_item.*,sum(order_item.quantity) as sumQuantity  , DATEDIFF(order_item.sendDateTime,date(NOW())) as remainDay , sp.storeProductId")
        ->join("LEFT OUTER JOIN", "store_product sp", "sp.orderItemId=order_item.orderItemId")
        ->where(" order_item.sendDateTime is not null AND DATEDIFF(order_item.sendDateTime,date(NOW())) <= " . \common\models\costfit\OrderItem::FUTURE_DAY_TO_SHOW)
        ->orderBy("remainDay ASC,order_item.productId ASC")
//        ->groupBy("productId , sendDateTime");
        ->groupBy("order_item.orderItemId");
        $filterArray[] = 'and';
        if (isset($_GET['fromDate'])) {
            $filterArray[] = ['>=', 'date(orderItems.createDateTime)', $_GET['fromDate']];
        }
        if (isset($_GET['toDate'])) {
            $filterArray[] = ['<=', 'date(orderItems.createDateTime)', $_GET['toDate']];
        }
        $model->andFilterWhere($filterArray);

        $provider = new ActiveDataProvider([
            'query' => $model,
        ]);
        $models = $provider->getModels();

        //Create PO
        $flag = FALSE;
        $message = NULL;
        if (isset($_POST["supplier"])) {
            try {
                $transaction = \Yii::$app->db->beginTransaction();
                $spArray = [];
                $model = new \common\models\costfit\StoreProductGroup();
                $model->poNo = \common\models\costfit\StoreProductGroup::genPoNo();
                $model->createDateTime = new \yii\db\Expression('NOW()');
                $model->save();
                $spgId = \Yii::$app->db->lastInsertID;
                foreach ($_POST["supplier"] as $orderItemId => $orderItem) {
                    foreach ($orderItem as $productId => $item) {
                        foreach ($item as $quantity => $supplierId) {
                            if (!empty($supplierId)) {
//                        if (!isset($spArray[$supplierId][$productId])) {
//                            $spArray[$supplierId][$productId] = $quantity;
//                        } else {
//                            $spArray[$supplierId][$productId] += $quantity;
//                        }
                                $sp = \common\models\costfit\search\StoreProduct::find()->where("orderItemId =$orderItemId AND productId = $productId")->one();
                                if (!isset($st)) {
                                    $sp = new \common\models\costfit\StoreProduct();
                                }
                                $sp->storeProductGroupId = $spgId;
                                $sp->productId = $productId;
                                $sp->shippingFromType = \common\models\costfit\StoreProduct::SHIPPING_FROM_TYPE_COSTFIT;
                                $sp->quantity = intval($quantity);
                                $sp->orderItemId = $orderItemId;
                                $sp->createDateTime = new \yii\db\Expression('NOW()');
                                if (!$sp->save()) {
                                    throw new \yii\base\Exception(print_r($sp->errors, true));
                                }
                            }
                        }
                    }
                }
                $model->supplierId = $supplierId;
                $model->save();
            } catch (Exception $ex) {
                $transaction->rollback();
            }




//            throw new \yii\base\Exception(print_r($_POST["supplier"], true));
//            throw new \yii\base\Exception(print_r($spArray, true));
        }

        //Create PO


        return $this->render('index', [
            'model' => $models,
            'message' => $message
        ]);
    }

    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

}
