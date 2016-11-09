<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\ProductPriceOtherWeb;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\costfit\Web;
use common\models\costfit\Product;

/**
 * ProductPriceOtherWebController implements the CRUD actions for ProductPriceOtherWeb model.
 */
class ProductPriceOtherWebController extends ProductMasterController {

    /**
     * @inheritdoc
     */
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
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductPriceOtherWeb models.
     * @return mixed
     */
    public function actionIndex() {

        $dataProvider = new ActiveDataProvider([
            'query' => ProductPriceOtherWeb::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductPriceOtherWeb model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductPriceOtherWeb model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ProductPriceOtherWeb();
        $id = "";
        $productName = '';
        $website = ArrayHelper::map(Web::find()->all(), 'webId', 'title');
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $model->productId = $id;
            $productName = Product::find()->where("productId='" . $id . "'")->one();
        }
        if (isset($_POST["ProductPriceOtherWeb"])) {
            $model->attributes = $_POST["ProductPriceOtherWeb"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                $productPriceOtherWebId = Yii::$app->db->getLastInsertID();
                $updatePrice = new \common\models\costfit\UpdatePrice();
                $updatePrice->productPriceOtherWebId = $productPriceOtherWebId;
                $updatePrice->price = $_POST["ProductPriceOtherWeb"]["price"];
                $updatePrice->createDateTime = new \yii\db\Expression('NOW()');
                $updatePrice->save();
                return $this->redirect(['product-price/index', 'productId' => $id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'productName' => $productName->title,
                    'website' => $website
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'productName' => $productName->title,
                'website' => $website
            ]);
        }
    }

    /**
     * Updates an existing ProductPriceOtherWeb model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $product = Product::find()->where("productId='" . $model->productId . "'")->one();
        $website = ArrayHelper::map(Web::find()->all(), 'webId', 'title');

        if (isset($_POST["ProductPriceOtherWeb"])) {
            $model->attributes = $_POST["ProductPriceOtherWeb"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                $updatePrice = new \common\models\costfit\UpdatePrice();
                $updatePrice->productPriceOtherWebId = $id;
                $updatePrice->price = $_POST["ProductPriceOtherWeb"]["price"];
                $updatePrice->createDateTime = new \yii\db\Expression('NOW()');
                $updatePrice->save();
                return $this->redirect(['product-price/index', 'productId' => $model->productId]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'productName' => $product->title,
                    'website' => $website
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'productName' => $product->title,
                'website' => $website
            ]);
        }
    }

    /**
     * Deletes an existing ProductPriceOtherWeb model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = ProductPriceOtherWeb::find()->where("productPriceOtherWebId='" . $id . "'")->one();
        $productId = $model->productId;
        $model->delete();
        return $this->redirect(['product-price/index', 'productId' => $productId]);
    }

    /**
     * Finds the ProductPriceOtherWeb model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductPriceOtherWeb the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductPriceOtherWeb::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
