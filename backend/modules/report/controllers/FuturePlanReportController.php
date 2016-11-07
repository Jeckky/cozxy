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
        $model = \common\models\costfit\OrderItem::find()->select("order_item.*,sum(order_item.quantity) as sumQuantity  , DATEDIFF(order_item.sendDateTime,date(NOW())) as remainDay")
//        ->join("LEFT JOIN")
        ->where(" order_item.sendDateTime is not null AND DATEDIFF(order_item.sendDateTime,date(NOW())) <= " . \common\models\costfit\OrderItem::FUTURE_DAY_TO_SHOW)
        ->orderBy("productId ASC")
        ->groupBy("productId");
//        ->groupBy("order_item.orderItemId");
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

        $draft = \common\models\costfit\search\StoreProductGroup::find()->where("status =" . \common\models\costfit\search\StoreProductGroup::STATUS_DRAFT);
        $drafts = new ActiveDataProvider([
            'query' => $draft,
        ]);

        $purchasing = \common\models\costfit\search\StoreProductGroup::find()->where("status =" . \common\models\costfit\search\StoreProductGroup::STATUS_PURCHASING);
        $purchasings = new ActiveDataProvider([
            'query' => $purchasing,
        ]);

        //Create PO
        $flag = FALSE;
        $message = NULL;
        if (isset($_POST["supplier"])) {

            try {
                $transaction = \Yii::$app->db->beginTransaction();
                $supplierArray = [];
                foreach ($_POST["supplier"] as $orderItemId => $orderItem) {
                    foreach ($orderItem as $productId => $item) {
                        foreach ($item as $quantity => $supplierId) {
                            if (!empty($supplierId)) {
                                if (!isset($supplierArray[$supplierId][$orderItemId][$productId])) {
                                    $supplierArray[$supplierId][$orderItemId][$productId] = $quantity;
                                } else {
                                    $supplierArray[$supplierId][$orderItemId][$productId] += $quantity;
                                }
                            }
                        }
                    }
                }
                $spgId = 0;
                foreach ($supplierArray as $supplierId => $orderItem) {
                    if ($spgId == 0) {
                        $model = new \common\models\costfit\StoreProductGroup();
                        $model->poNo = \common\models\costfit\StoreProductGroup::genPoNo();
                        $model->createDateTime = new \yii\db\Expression('NOW()');
                        $model->supplierId = $supplierId;
                        $model->status = \common\models\costfit\StoreProductGroup::STATUS_DRAFT;
                        $model->save();
                        $spgId = \Yii::$app->db->lastInsertID;
                    } else {
                        if ($supplierId != $spgId) {
                            $model = new \common\models\costfit\StoreProductGroup();
                            $model->poNo = \common\models\costfit\StoreProductGroup::genPoNo();
                            $model->createDateTime = new \yii\db\Expression('NOW()');
                            $model->supplierId = $supplierId;
                            $model->status = \common\models\costfit\StoreProductGroup::STATUS_DRAFT;
                            $model->save();
                            $spgId = \Yii::$app->db->lastInsertID;
                        }
                    }
                    $summary = 0;
                    foreach ($orderItem as $orderItemId => $item) {

                        foreach ($item as $productId => $quantity) {
                            if (!empty($supplierId)) {
                                $sp = \common\models\costfit\search\StoreProduct::find()->where("orderItemId =$orderItemId AND productId = $productId")->one();
                                if (!isset($st)) {
                                    $sp = new \common\models\costfit\StoreProduct();
                                }
                                $sp->storeProductGroupId = $spgId;
                                $sp->productId = $productId;
                                $sp->shippingFromType = \common\models\costfit\StoreProduct::SHIPPING_FROM_TYPE_COSTFIT;
                                $sp->quantity = intval($quantity);
                                $spp = \common\models\costfit\SupplierProduct::find()->where("productId=$productId AND supplierId=$supplierId ")->one();
                                if (isset($spp)) {
                                    $sp->price = $spp->price;
                                } else {
                                    $sp->price = 0;
                                }
                                $sp->total = $sp->quantity * $sp->price;
                                $sp->orderItemId = $orderItemId;
                                $sp->createDateTime = new \yii\db\Expression('NOW()');
                                if (!$sp->save()) {
                                    throw new \yii\base\Exception(print_r($sp->errors, true));
                                } else {
                                    $summary+=$sp->total;
                                }
                            }
                        }
                    }
                    $model->summary = $summary;
                    $model->save();
                }
                $transaction->commit();
                return $this->redirect(["index"]);
            } catch (Exception $ex) {
                $transaction->rollback();
                throw new \yii\base\Exception($ex->getMessage());
            }
        }

        //Create PO


        return $this->render('index_from_order', [
            'model' => $models,
            'message' => $message,
            'drafts' => $drafts,
            'purchasings' => $purchasings
        ]);
    }

    public function actionIndexFromOrder()
    {
        $model = \common\models\costfit\OrderItem::find()->select("order_item.*,sum(order_item.quantity) as sumQuantity  , DATEDIFF(order_item.sendDateTime,date(NOW())) as remainDay , sp.storeProductId")
        ->join("LEFT OUTER JOIN", "store_product sp", "sp.orderItemId=order_item.orderItemId")
        ->where(" order_item.sendDateTime is not null AND DATEDIFF(order_item.sendDateTime,date(NOW())) <= " . \common\models\costfit\OrderItem::FUTURE_DAY_TO_SHOW)
        ->orderBy("order_item.productId ASC ,remainDay ASC")
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

        $draft = \common\models\costfit\search\StoreProductGroup::find()->where("status =" . \common\models\costfit\search\StoreProductGroup::STATUS_DRAFT);
        $drafts = new ActiveDataProvider([
            'query' => $draft,
        ]);

        $purchasing = \common\models\costfit\search\StoreProductGroup::find()->where("status =" . \common\models\costfit\search\StoreProductGroup::STATUS_PURCHASING);
        $purchasings = new ActiveDataProvider([
            'query' => $purchasing,
        ]);

        //Create PO
        $flag = FALSE;
        $message = NULL;
        if (isset($_POST["supplier"])) {

            try {
                $transaction = \Yii::$app->db->beginTransaction();
                $supplierArray = [];
                foreach ($_POST["supplier"] as $orderItemId => $orderItem) {
                    foreach ($orderItem as $productId => $item) {
                        foreach ($item as $quantity => $supplierId) {
                            if (!empty($supplierId)) {
                                if (!isset($supplierArray[$supplierId][$orderItemId][$productId])) {
                                    $supplierArray[$supplierId][$orderItemId][$productId] = $quantity;
                                } else {
                                    $supplierArray[$supplierId][$orderItemId][$productId] += $quantity;
                                }
                            }
                        }
                    }
                }
                $spgId = 0;
                foreach ($supplierArray as $supplierId => $orderItem) {
                    if ($spgId == 0) {
                        $model = new \common\models\costfit\StoreProductGroup();
                        $model->poNo = \common\models\costfit\StoreProductGroup::genPoNo();
                        $model->createDateTime = new \yii\db\Expression('NOW()');
                        $model->supplierId = $supplierId;
                        $model->status = \common\models\costfit\StoreProductGroup::STATUS_DRAFT;
                        $model->save();
                        $spgId = \Yii::$app->db->lastInsertID;
                    } else {
                        if ($supplierId != $spgId) {
                            $model = new \common\models\costfit\StoreProductGroup();
                            $model->poNo = \common\models\costfit\StoreProductGroup::genPoNo();
                            $model->createDateTime = new \yii\db\Expression('NOW()');
                            $model->supplierId = $supplierId;
                            $model->status = \common\models\costfit\StoreProductGroup::STATUS_DRAFT;
                            $model->save();
                            $spgId = \Yii::$app->db->lastInsertID;
                        }
                    }
                    $summary = 0;
                    foreach ($orderItem as $orderItemId => $item) {

                        foreach ($item as $productId => $quantity) {
                            if (!empty($supplierId)) {
                                $sp = \common\models\costfit\search\StoreProduct::find()->where("orderItemId =$orderItemId AND productId = $productId")->one();
                                if (!isset($st)) {
                                    $sp = new \common\models\costfit\StoreProduct();
                                }
                                $sp->storeProductGroupId = $spgId;
                                $sp->productId = $productId;
                                $sp->shippingFromType = \common\models\costfit\StoreProduct::SHIPPING_FROM_TYPE_COSTFIT;
                                $sp->quantity = intval($quantity);
                                $spp = \common\models\costfit\SupplierProduct::find()->where("productId=$productId AND supplierId=$supplierId ")->one();
                                if (isset($spp)) {
                                    $sp->price = $spp->price;
                                } else {
                                    $sp->price = 0;
                                }
                                $sp->total = $sp->quantity * $sp->price;
                                $sp->orderItemId = $orderItemId;
                                $sp->createDateTime = new \yii\db\Expression('NOW()');
                                if (!$sp->save()) {
                                    throw new \yii\base\Exception(print_r($sp->errors, true));
                                } else {
                                    $summary+=$sp->total;
                                }
                            }
                        }
                    }
                    $model->summary = $summary;
                    $model->save();
                }
                $transaction->commit();
                return $this->redirect(["index"]);
            } catch (Exception $ex) {
                $transaction->rollback();
                throw new \yii\base\Exception($ex->getMessage());
            }
        }

        //Create PO


        return $this->render('index', [
            'model' => $models,
            'message' => $message,
            'drafts' => $drafts,
            'purchasings' => $purchasings
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

    public function actionPurchasing($id)
    {
        $model = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId=" . $id)->one();
        $model->status = \common\models\costfit\StoreProductGroup::STATUS_PURCHASING;
        $model->save();
        return $this->redirect(['print-po', 'id' => $id]);
    }

    public function actionPrintPo($id)
    {
        $model = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId=" . $id)->one();
        return $this->render("po", compact('model'));
    }

    public function actionPrintPoToPdf($id)
    {
        $model = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId=" . $id)->one();
        $content = $this->renderPartial('po', compact('model'));
        $header = $this->renderPartial('@backend/modules/store/views/picking/header', ['title' => "ใบสั่งซื้อ / Purchase Order"]);
        $footer = $this->renderPartial('footer', []);
        $this->actionMpdfDocument($content, $header, $footer, 35);
    }

}
