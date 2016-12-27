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

        $userId = Yii::$app->request->post('userId');

        if (isset($userId)) {
            $productSys = new ActiveDataProvider([
                'query' => \common\models\costfit\Product:: find()
                ->where('approve = "new"')
                ->andWhere('userId =' . $userId)
            ]);

            $productSysApprove = new ActiveDataProvider([
                'query' => \common\models\costfit\Product:: find()
                ->where('approve = "approve"')
                ->andWhere('userId =' . $userId)
            ]);

            $productSupp = new ActiveDataProvider([
                'query' => \common\models\costfit\ProductSuppliers:: find()
                ->where('approve in ("new","old")')
                ->andWhere('userId =' . $userId)
            ]);

            // Approve แล้ว 27/12/2016
            $productSuppApprove = new ActiveDataProvider([
                'query' => \common\models\costfit\ProductSuppliers:: find()
                ->where('approve  in ("approve") ')
                ->andWhere('userId =' . $userId)
            ]);
        } else {
            $productSys = new ActiveDataProvider([
                'query' => \common\models\costfit\Product:: find()
                ->where('approve = "new"')
            ]);

            $productSysApprove = new ActiveDataProvider([
                'query' => \common\models\costfit\Product:: find()
                ->where('approve = "approve"'),
            ]);

            $productSupp = new ActiveDataProvider([
                'query' => \common\models\costfit\ProductSuppliers:: find()
                ->where('approve in ("new","old")'),
            ]);

            // Approve แล้ว 27/12/2016
            $productSuppApprove = new ActiveDataProvider([
                'query' => \common\models\costfit\ProductSuppliers:: find()
                ->where('approve in ("approve") '),
            ]);
        }

        return $this->render('index', [
            'productSys' => $productSys, 'productSupp' => $productSupp, 'productSysApprove' => $productSysApprove, 'productSuppApprove' => $productSuppApprove
        ]);
        //return $this->render('index');
    }

    public function actionApproveItems() {
        $productId = Yii::$app->request->post('productSuppId');
        $type = Yii::$app->request->post('type');
        if ($type == 1) { // Product Suppliers
            $ps = \common\models\costfit\ProductSuppliers::find()->where('productSuppId = ' . $productId . ' ')->one(); // and approve = "new"
            $ps->approve = 'approve';
            $ps->approveCreateBy = Yii::$app->user->identity->userId;
            $ps->approvecreateDateTime = new \yii\db\Expression('NOW()');
            if ($ps->save(FALSE)) {
                //return $this->redirect(['index']);
            }
        } elseif ($type == 2) {// Product Sys
            $pss = \common\models\costfit\Product::find()->where('productId = ' . $productId . ' and approve = "new"')->one();
            $pss->approve = 'approve';
            $pss->approveCreateBy = Yii::$app->user->identity->userId;
            $pss->approvecreateDateTime = new \yii\db\Expression('NOW()');
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

    public function actionInvestigateApproveItems() {
        $productId = Yii::$app->request->post('productId');
        $typeId = Yii::$app->request->post('type');

        if ($typeId == 1) { // Suppliers
            $suppliers = \common\models\costfit\ProductSuppliers::find()
            ->select('`product_suppliers`.*, user.firstname, user.lastname, brand.title as bTitle, category.title as cTitle '
            . ', u1.title as uTitle, u2.title as smuTitle'
            . ', GROUP_CONCAT(pis.image) as simage, GROUP_CONCAT(pis.imageThumbnail1) as simageThumbnail1, GROUP_CONCAT(pis.imageThumbnail2) as simageThumbnail2')
            ->join('LEFT JOIN', 'user', 'product_suppliers.userId = user.userId')
            ->join('LEFT JOIN', 'brand', 'product_suppliers.brandId = brand.brandId')
            ->join('LEFT JOIN', 'category', 'product_suppliers.categoryId = category.categoryId')
            ->join('LEFT JOIN', 'unit u1', 'product_suppliers.unit = u1.unitId')
            ->join('LEFT JOIN', 'unit u2', 'product_suppliers.smallUnit = u2.unitId')
            ->join('LEFT JOIN', 'product_image_suppliers pis', 'product_suppliers.productSuppId = pis.productSuppId')
            ->where('product_suppliers.productSuppId = ' . $productId)
            ->one();
        } else if ($typeId == 2) { // cozxy.coms
            //$suppliers = \common\models\costfit\Product::find()->where('productId = ' . $productId)->one();
            $suppliers = \common\models\costfit\Product::find()
            ->select('`product`.*, user.firstname, user.lastname, brand.title as bTitle, category.title as cTitle '
            . ', u1.title as uTitle, u2.title as smuTitle'
            . ', GROUP_CONCAT(pis.image) as simage, GROUP_CONCAT(pis.imageThumbnail1) as simageThumbnail1, GROUP_CONCAT(pis.imageThumbnail2) as simageThumbnail2')
            ->join('LEFT JOIN', 'user', 'product.userId = user.userId')
            ->join('LEFT JOIN', 'brand', 'product.brandId = brand.brandId')
            ->join('LEFT JOIN', 'category', 'product.categoryId = category.categoryId')
            ->join('LEFT JOIN', 'unit u1', 'product.unit = u1.unitId')
            ->join('LEFT JOIN', 'unit u2', 'product.smallUnit = u2.unitId')
            ->join('LEFT JOIN', 'product_image pis', 'product.productId = pis.productId')
            ->where('product.productId = ' . $productId)
            ->one();
        }
        //echo '<pre>';
        //print_r($suppliers->attributes);
        echo json_encode($suppliers->attributes);
    }

}
