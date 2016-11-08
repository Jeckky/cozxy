<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\Product;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends ProductMasterController {

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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

    public function beforeAction($action) {
        if ($action->id == 'index') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex() {
        $model = new Product();
        $query = Product::find();
        if (isset($_POST['Product'])) {
            foreach ($_POST['Product'] as $k => $v) {
                if (isset($v) & !empty($v)) {
                    if ($k == 'title') {
                        $query->andWhere("lower($k) like '%" . strtolower($v) . "%'");
                    } else {
                        $query->andWhere("$k =" . $v);
                    }
                }
            }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Product();
        if (isset($_POST["Product"])) {
            $model->attributes = $_POST["Product"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                $lastId = Yii::$app->db->getLastInsertID();
                \common\models\costfit\CategoryToProduct::saveCategoryToProduct($model->categoryId, $model->productId);
                $productShipping = \common\models\costfit\ProductShippingPrice::find()->where("productId='" . $lastId . "'")->all();
                if (count($productShipping) <= 0) {
                    $model->addProductShipping($lastId);
                }
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["Product"])) {
            $model->attributes = $_POST["Product"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                \common\models\costfit\CategoryToProduct::saveCategoryToProduct($model->categoryId, $model->productId);
                $productShipping = \common\models\costfit\ProductShippingPrice::find()->where("productId='" . $id . "'")->all();
                if (count($productShipping) <= 0) {
                    $model->addProductShipping($id);
                }
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
