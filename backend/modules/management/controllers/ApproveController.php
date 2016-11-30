<?php

namespace backend\modules\management\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\Product;

class ApproveController extends ManagementMasterController {

    public function actionIndex() {
        $productSys = new ActiveDataProvider([
            'query' => \common\models\costfit\Product:: find()
            ->where('approve = "new"'),
        ]);

        $productSupp = new ActiveDataProvider([
            'query' => \common\models\costfit\ProductSuppliers:: find()
            ->where('approve = "new"'),
        ]);

        return $this->render('index', [
            'productSys' => $productSys, 'productSupp' => $productSupp
        ]);
        //return $this->render('index');
    }

    public function actionApproveItems() {
        $productId = Yii::$app->request->post('productSuppId');
        $type = Yii::$app->request->post('type');
        if ($type == 1) { // Product Suppliers
            $ps = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $productId . ' and approve = "new"')->one();
            $ps->approve = 'approve';
            $ps->approveCreateBy = Yii::$app->user->identity->userId;
            if ($ps->save(FALSE)) {
                //return $this->redirect(['index']);
            }
        } elseif ($type == 2) {// Product Sys
            $pss = \common\models\costfit\Product::find()->where('productId =' . $productId . ' and approve = "new"')->one();
            $pss->approve = 'approve';
            $pss->approveCreateBy = Yii::$app->user->identity->userId;
            if ($pss->save(FALSE)) {
                //return $this->redirect(['index']);
            }
        } else {

        }
        echo $type;
    }

    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id) {
        if (($model = ProductSuppliers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
