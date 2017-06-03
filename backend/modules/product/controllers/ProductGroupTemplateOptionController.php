<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\ProductGroupTemplateOption;
use common\models\costfit\ProductGroupTemplateOptionSearch;
use backend\modules\product\controllers\ProductMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductGroupTemplateOptionController implements the CRUD actions for ProductGroupTemplateOption model.
 */
class ProductGroupTemplateOptionController extends ProductMasterController
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
     * Lists all ProductGroupTemplateOption models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductGroupTemplateOptionSearch();
        if (isset($_GET["productGroupTemplateId"])) {
            $searchModel->productGroupTemplateId = $_GET["productGroupTemplateId"];
        }
        if (isset($_GET["productGroupTemplateId"])) {
            $searchModel->productGroupTemplateId = $_GET["productGroupTemplateId"];
        }


        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductGroupTemplateOption model.
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
     * Creates a new ProductGroupTemplateOption model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductGroupTemplateOption();
        if (isset($_GET["productGroupTemplateId"])) {
            $model->productGroupTemplateId = $_GET["productGroupTemplateId"];
        }
        if (isset($_POST["ProductGroupTemplateOption"])) {
            $model->attributes = $_POST["ProductGroupTemplateOption"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index?productGroupTemplateId=' . $model->productGroupTemplateId]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductGroupTemplateOption model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (isset($_POST["ProductGroupTemplateOption"])) {
            $model->attributes = $_POST["ProductGroupTemplateOption"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');



            if ($model->save()) {
                return $this->redirect(['index?productGroupTemplateId=' . $model->productGroupTemplateId]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductGroupTemplateOption model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index?productGroupTemplateId=' . $model->productGroupTemplateId]);
    }

    /**
     * Finds the ProductGroupTemplateOption model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductGroupTemplateOption the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductGroupTemplateOption::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
