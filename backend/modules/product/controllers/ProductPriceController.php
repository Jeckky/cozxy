<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\ProductPrice;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\ProductShippingPrice;
use common\models\costfit\ProductPriceOtherWeb;

/**
 * ProductPriceController implements the CRUD actions for ProductPrice model.
 */
class ProductPriceController extends ProductMasterController {

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
     * Lists all ProductPrice models.
     * @return mixed
     */
    public function actionIndex() {
        $id = "";
        if (isset($_GET['productId'])) {
            $id = $_GET['productId'];
            $query = ProductPrice::find()->where("productId=" . $_GET["productId"]);
            $queryPrice = ProductShippingPrice::find()->where("productId=" . $_GET["productId"]);
            $queryWeb = ProductPriceOtherWeb::find()->where("productId=" . $_GET["productId"]);
        } else {
            $query = ProductPrice::find();
            $queryPrice = ProductShippingPrice::find();
            $queryWeb = ProductPriceOtherWeb::find();
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProviderPrice = new ActiveDataProvider([
            'query' => $queryPrice,
        ]);
        $dataProviderWeb = new ActiveDataProvider([
            'query' => $queryWeb,
        ]);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'dataProviderPrice' => $dataProviderPrice,
                    'dataProviderWeb' => $dataProviderWeb,
                    'id' => $id
        ]);
    }

    /**
     * Displays a single ProductPrice model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductPrice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ProductPrice();
        if (isset($_GET['productId'])) {
            $model->productId = $_GET['productId'];
        }
        if (isset($_POST["ProductPrice"])) {
            $model->attributes = $_POST["ProductPrice"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index', 'productId' => $_GET['productId']]);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductPrice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["ProductPrice"])) {
            $model->attributes = $_POST["ProductPrice"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index', 'productId' => $model->productId]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductPrice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $product = ProductPrice::find()->where("productPriceId='" . $id . "'")->one();
        $productId = $product->productId;
        $this->findModel($id)->delete();
        return $this->redirect(['index', 'productId' => $productId]);
    }

    /**
     * Finds the ProductPrice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductPrice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductPrice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
