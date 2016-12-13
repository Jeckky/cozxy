<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductPriceSuppliers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\AverageSuppliers;

/**
 * ProductPriceSuppliersController implements the CRUD actions for ProductPriceSuppliers model.
 */
class ProductPriceSuppliersController extends SuppliersMasterController {

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductPriceSuppliers models.
     * @return mixed
     */
    public function actionIndex() {

        $rankOne = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $_GET['productSuppId'])->one();

        $rankingPrice = AverageSuppliers::GetPriceSuppliersSame($rankOne->brandId, $rankOne->categoryId);

        $dataProvider = new ActiveDataProvider([
            'query' => ProductPriceSuppliers::find()->where('productSuppId=' . $_GET['productSuppId'])->orderBy('status desc'),
        ]);

        $dataProvider1 = new ActiveDataProvider([
            'query' => \common\models\costfit\ProductShippingPriceSuppliers::find()->where('productSuppId=' . $_GET['productSuppId']),
        ]);

        $productSupp = \common\models\costfit\ProductSuppliers::find()->where('productSuppId=' . $_GET['productSuppId'])->limit(10)->one();
        return $this->render('index', [

            'dataProvider' => $dataProvider, 'dataProvider1' => $dataProvider1,
            'productSupp' => $productSupp, 'rankingPrice' => $rankingPrice
        ]);
    }

    /**
     * Displays a single ProductPriceSuppliers model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductPriceSuppliers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ProductPriceSuppliers();
        //$rankingPrice = \common\models\costfit\ProductPriceSuppliers::rankingPrice();
        $rankOne = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $_GET['productSuppId'])->one();
        //echo $rankOne->brandId . '::' . $rankOne->categoryId;
        $rankingPrice = AverageSuppliers::GetPriceSuppliersSame($rankOne->brandId, $rankOne->categoryId);
        if (isset($_POST["ProductPriceSuppliers"])) {
            $model->attributes = $_POST["ProductPriceSuppliers"];
            \common\models\costfit\ProductPriceSuppliers::updateAll(['status' => 0], ['productSuppId' => $_GET['productSuppId']]);
            $model->status = 1;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                //return $this->redirect(['product-price-suppliers/index?productSuppId = ' . $_GET['productSuppId']]);
                return $this->redirect('/suppliers/product-suppliers/image-form?productSuppId=' . $model->productSuppId);
                //return $this->redirect('/suppliers/product-price-suppliers/create?productSuppId=' . $model->productSuppId);
            }
        }

        $productSupp = \common\models\costfit\ProductSuppliers::find()->where('productSuppId=' . $_GET['productSuppId'])->limit(10)->one();

        $productLastDay = AverageSuppliers::LastDay();
        $productLastWeek = AverageSuppliers::LastWeek();
        $product14LastWeek = AverageSuppliers::LastWeek14();
        $orderLastMONTH = AverageSuppliers::LastMonth();
        return $this->render('create', [
            'model' => $model, 'rankingPrice' => $rankingPrice
            , 'productLastDay' => $productLastDay
            , 'productLastWeek' => $productLastWeek
            , 'orderLastMONTH' => $orderLastMONTH
            , 'product14LastWeek' => $product14LastWeek
        ]);
    }

    /**
     * Updates an existing ProductPriceSuppliers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        //$rankingPrice = \common\models\costfit\ProductPriceSuppliers::rankingPrice();
        $rankOne = \common\models\costfit\ProductSuppliers::find()->where('productSuppId = ' . $_GET['productSuppId'])->one();
        //echo $rankOne->brandId . '::' . $rankOne->categoryId;
        $rankingPrice = AverageSuppliers::GetPriceSuppliersSame($rankOne->brandId, $rankOne->categoryId);
        $model = $this->findModel($id);
        if (isset($_POST["ProductPriceSuppliers"])) {
            $model->attributes = $_POST["ProductPriceSuppliers"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['product-price-suppliers/index?productSuppId = ' . $model->productSuppId]);
            }
        }
        $productLastDay = AverageSuppliers::LastDay();
        $productLastWeek = AverageSuppliers::LastWeek();
        $product14LastWeek = AverageSuppliers::LastWeek14();
        $orderLastMONTH = AverageSuppliers::LastMonth();
        return $this->render('update', [
            'model' => $model, 'rankingPrice' => $rankingPrice
            , 'productLastDay' => $productLastDay
            , 'productLastWeek' => $productLastWeek
            , 'orderLastMONTH' => $orderLastMONTH
            , 'product14LastWeek' => $product14LastWeek
        ]);
    }

    /**
     * Deletes an existing ProductPriceSuppliers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['product-price-suppliers/index?productSuppId = ' . $_GET['productSuppId']]);
    }

    /**
     * Finds the ProductPriceSuppliers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductPriceSuppliers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductPriceSuppliers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist. ');
        }
    }

    public function actionSuppliersCreatePrice() {
        $price = Yii::$app->request->post('price');
        $productSuppliersId = Yii::$app->request->post('productSuppId');
        $rankOne = \common\models\costfit\ProductSuppliers::find()->where('productSuppId = ' . $productSuppliersId)->one();
        $rankTwo = \common\models\costfit\ProductSuppliers::find()
        ->select('`product_suppliers`.*, product_suppliers.title as pTitle, product_price_suppliers.price as priceSuppliers, '
        . 'brand.title as bTitle, category.title as cTitle, user.username as sUser')
        ->join('LEFT JOIN', 'product_price_suppliers', 'product_price_suppliers.productSuppId = product_suppliers.productSuppId')
        ->join('LEFT JOIN', 'brand', 'brand.brandId = product_suppliers.brandId')
        ->join('LEFT JOIN', 'category', 'category.categoryId = product_suppliers.categoryId')
        ->join('LEFT JOIN', 'user', 'user.userId = product_suppliers.userId')
        ->where(' product_price_suppliers.status = 1 and product_suppliers.brandId = ' . $rankOne->brandId . ' and product_suppliers.categoryId = '
        . '' . $rankOne->categoryId . ' and product_price_suppliers.price != "" and product_price_suppliers.price <= ' . $price)
        ->count();

        return $rankTwo + 1;
    }

}
