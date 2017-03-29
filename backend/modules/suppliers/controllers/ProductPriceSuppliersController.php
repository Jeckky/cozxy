<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductPriceSuppliers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\Suppliers;

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
        if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 3) {
            header("location: /auth");
            exit(0);
        }
        $rankOne = $this->SearchProductSuppliers($_GET['productSuppId']); //\common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $_GET['productSuppId'])->one();

        /*
         * แสดงข้อมูลที่อยู่ใน brand , category เดียวกัน
         * ทุก Suppliers
         */
        $rankingPrice = Suppliers::GetPriceSuppliersSame($rankOne->brandId, $rankOne->categoryId, $_GET['productSuppId']);

        $dataProvider = new ActiveDataProvider([
            'query' => ProductPriceSuppliers::find()->where('productSuppId=' . $_GET['productSuppId'])->orderBy('status desc'),
        ]);

        /*
          $dataProvider1 = new ActiveDataProvider([
          'query' => \common\models\costfit\ProductShippingPriceSuppliers::find()->where('productSuppId=' . $_GET['productSuppId']),
          ]);
         *
         */

        /*
         * แสดง Title Product
         */
        $productSupp = \common\models\costfit\ProductSuppliers::find()->where('productSuppId=' . $_GET['productSuppId'])->one();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'productSupp' => $productSupp, 'rankingPrice' => $rankingPrice
        ]);
    }

    /**
     * Displays a single ProductPriceSuppliers model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 3) {
            header("location: /auth");
            exit(0);
        }
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
        if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 3) {
            header("location: /auth");
            exit(0);
        }
        $model = new ProductPriceSuppliers();
        //$rankingPrice = \common\models\costfit\ProductPriceSuppliers::rankingPrice();
        $rankOne = $this->SearchProductSuppliers($_GET['productSuppId']); //\common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $_GET['productSuppId'])->one();
        /*
         * แสดงข้อมูลที่อยู่ใน brand , category เดียวกัน
         * ทุก Suppliers
         */

        $rankingPrice = Suppliers::GetPriceSuppliersSame($rankOne->brandId, $rankOne->categoryId, $_GET['productSuppId']);

        if (isset($_POST["ProductPriceSuppliers"])) {
            $model->attributes = $_POST["ProductPriceSuppliers"];
            \common\models\costfit\ProductPriceSuppliers::updateAll(['status' => 0], ['productSuppId' => $_GET['productSuppId']]);
            $model->status = 1;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                //return $this->redirect(['product-price-suppliers/index?productSuppId = ' . $_GET['productSuppId']]);
                return $this->redirect(Yii::$app->homeUrl . 'suppliers/product-suppliers/image-form?productSuppId=' . $model->productSuppId);
                //return $this->redirect('/suppliers/product-price-suppliers/create?productSuppId=' . $model->productSuppId);
            }
        }

        $productSupp = \common\models\costfit\ProductSuppliers::find()->where('productSuppId=' . $_GET['productSuppId'])->one();

        $productLastDay = Suppliers::LastDay($_GET['productSuppId']);
        $productLastWeek = Suppliers::LastWeek($_GET['productSuppId']);
        $product14LastWeek = Suppliers::LastWeek14($_GET['productSuppId']);
        $orderLastMONTH = Suppliers::LastMonth($_GET['productSuppId']);
        return $this->render('create', [
            'model' => $model, 'rankingPrice' => $rankingPrice, 'titleSuppliers' => $rankOne
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
        if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 3) {
            header("location: /auth");
            exit(0);
        }
        //$rankingPrice = \common\models\costfit\ProductPriceSuppliers::rankingPrice();
        $rankOne = $this->SearchProductSuppliers($_GET['productSuppId']); //\common\models\costfit\ProductSuppliers::find()->where('productSuppId = ' . $_GET['productSuppId'])->one();
        //echo $rankOne->brandId . '::' . $rankOne->categoryId;
        /*
         * แสดงข้อมูลที่อยู่ใน brand , category เดียวกัน
         * ทุก Suppliers
         */
        $rankingPrice = Suppliers::GetPriceSuppliersSame($rankOne->brandId, $rankOne->categoryId, $_GET['productSuppId']);
        $model = $this->findModel($id);
        if (isset($_POST["ProductPriceSuppliers"])) {
            $model->attributes = $_POST["ProductPriceSuppliers"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(Yii::$app->homeUrl . 'suppliers/product-price-suppliers/index?productSuppId=' . $model->productSuppId);
            }
        }
        $productLastDay = Suppliers::LastDay($_GET['productSuppId']);
        $productLastWeek = Suppliers::LastWeek($_GET['productSuppId']);
        $product14LastWeek = Suppliers::LastWeek14($_GET['productSuppId']);
        $orderLastMONTH = Suppliers::LastMonth($_GET['productSuppId']);
        return $this->render('update', [
            'model' => $model, 'rankingPrice' => $rankingPrice, 'titleSuppliers' => $rankOne
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
        if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 3) {
            header("location: /auth");
            exit(0);
        }
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->homeUrl . 'suppliers/product-price-suppliers/index?productSuppId=' . $_GET['productSuppId']);
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
        //$rankOne = $this->SearchProductSuppliers($productSuppliersId); //\common\models\costfit\ProductSuppliers::find()->where('productSuppId = ' . $productSuppliersId)->one();
        $rankTwo = Suppliers::SuppliersCreatePrice($price, $productSuppliersId);

        return $rankTwo + 1;
    }

    public function SearchProductSuppliers($productSuppliersId) {
        $rankOne = \common\models\costfit\ProductSuppliers::find()->where('productSuppId = ' . $productSuppliersId)->one();
        return $rankOne;
    }

}
