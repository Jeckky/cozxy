<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\productShippingPrice;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ProductShippingPriceController implements the CRUD actions for productShippingPrice model.
 */
class ProductShippingPriceController extends ProductMasterController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all productShippingPrice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => productShippingPrice::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single productShippingPrice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new productShippingPrice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductShippingPrice();
        $shippingType = ArrayHelper::map(\common\models\costfit\ShippingType::find()->all(), 'shippingTypeId', 'title');
        $discountType = ["1" => "cash", "2" => "percent"];
        $productName = '';
        if (isset($_GET['id'])) {
            $productName = \common\models\costfit\Product::find()->where("productId='" . $_GET['id'] . "'")->one();
            $model->productId = $_GET['id'];
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['product-price/index', 'productId' => $productName->productId]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'shippingType' => $shippingType,
                'discountType' => $discountType,
                'productName' => $productName->title
            ]);
        }
    }

    /**
     * Updates an existing productShippingPrice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $shippingType = ArrayHelper::map(\common\models\costfit\ShippingType::find()->all(), 'shippingTypeId', 'title');
        $discountType = ["1" => "cash", "2" => "percent"];
        $productName = \common\models\costfit\Product::find()->where("productId='" . $model->productId . "'")->one();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['product-price/index', 'productId' => $model->productId]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'shippingType' => $shippingType,
                'discountType' => $discountType,
                'productName' => $productName->title
            ]);
        }
    }

    /**
     * Deletes an existing productShippingPrice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $model = ProductShippingPrice::find()->where("productShippingPriceId='" . $id . "'")->one();
        $model->delete();
        return $this->redirect(['product-price/index', 'productId' => $model->productId]);
    }

    /**
     * Finds the productShippingPrice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return productShippingPrice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = productShippingPrice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
