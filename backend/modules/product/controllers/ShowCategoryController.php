<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\ShowCategory;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShowCategoryController implements the CRUD actions for ShowCategory model.
 */
class ShowCategoryController extends BackendMasterController
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
     * Lists all ShowCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ShowCategory::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShowCategory model.
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
     * Creates a new ShowCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShowCategory();
        if (isset($_POST["ShowCategory"])) {
            $model->attributes = $_POST["ShowCategory"];
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
     * Updates an existing ShowCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (isset($_POST["ShowCategory"])) {
            $model->attributes = $_POST["ShowCategory"];
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
     * Deletes an existing ShowCategory model.
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
     * Finds the ShowCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ShowCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShowCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionShowCategory()
    {
        if (isset($_POST['searchText'])) {
            $categorys = \common\models\costfit\Category::find()
            ->where("status = 1 AND title like '%" . $_POST['searchText'] . "%'")
            ->all();
        } else {
            $categorys = \common\models\costfit\Category::find()->where("status = 1")->all();
        }

        if (isset($_POST["ShowCategory"])) {
            foreach ($_POST["ShowCategory"] as $k => $v) {
                $sc = ShowCategory::find()->where("categoryId = $k")->one();
                if (!isset($sc)) {
                    $sc = new ShowCategory();
                }
                $sc->type = $v;
                $sc->categoryId = $k;
                $sc->createDateTime = new \yii\db\Expression("NOW()");
                $sc->save();
            }
        }
        return $this->render('_show_cat', [
            'categorys' => $categorys,
            'searchText' => isset($_POST['searchText']) ? $_POST['searchText'] : NULL
        ]);
    }

    public function actionDeleteShowCategory($id)
    {
        ShowCategory::deleteAll("categoryId =" . $id);

        return $this->redirect(['/product/show-category/show-category']);
    }

}
