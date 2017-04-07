<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductPost;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductPostController implements the CRUD actions for ProductPost model.
 */
class ProductPostController extends SuppliersMasterController
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductPost models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $dataProvider = new ActiveDataProvider([
//            'query' => ProductPost::find(),
//        ]);
        if (isset($_GET["productSuppId"])) {
            $model = ProductPost::find()->where("userId =" . Yii::$app->user->id . " AND productSuppId = " . $_GET["productSuppId"])->one();
        } elseif (isset($_GET["brandId"])) {
            $model = ProductPost::find()->where("userId =" . Yii::$app->user->id . " AND brandId = " . $_GET["brandId"])->one();
        }
        if (!isset($model)) {
            $model = new ProductPost();
        }

        if (isset($_POST["ProductPost"])) {
            $model->attributes = $_POST["ProductPost"];
            if (isset($_GET["productSuppId"])) {
                $model->productSuppId = $_GET["productSuppId"];
            } elseif (isset($_GET["brandId"])) {
                $model->brandId = $_GET["brandId"];
            }
            $model->userId = Yii::$app->user->id;
            $model->createDateTime = new \yii\db\Expression("NOW()");
            $model->save();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single ProductPost model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductPost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductPost();
        if (isset($_POST["ProductPost"])) {
            $model->attributes = $_POST["ProductPost"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductPost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (isset($_POST["ProductPost"])) {
            $model->attributes = $_POST["ProductPost"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');



            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductPost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductPost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
