<?php

namespace backend\modules\management\controllers;

use Yii;
use common\models\costfit\UserGroups;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserGroupsController implements the CRUD actions for UserGroups model.
 */
class UserGroupsController extends ManagementMasterController {

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
     * Lists all UserGroups models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => UserGroups::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserGroups model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserGroups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new UserGroups();

        if (isset($_POST["UserGroups"])) {
            $model->attributes = $_POST["UserGroups"];
            if (isset($_POST["UserGroups"]['parent_id'])) {
                $model->parent_id = ($_POST["UserGroups"]['parent_id'] == '') ? 0 : $_POST["UserGroups"]['parent_id'];
            } else {
                $model->parent_id = 0;
            }

            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save(FALSE)) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserGroups model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["UserGroups"])) {
            //echo '<pre>';
            //print_r($_POST["UserGroups"]);
            $model->attributes = $_POST["UserGroups"];
            if (isset($_POST["UserGroups"]['parent_id'])) {
                //echo 'isset';
                $model->parent_id = ($_POST["UserGroups"]['parent_id'] == '') ? 0 : $_POST["UserGroups"]['parent_id'];
            } else {
                $model->parent_id = 0;
                //echo 'not isset';
            }
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            //echo $model->parent_id;
            //exit();
            if ($model->save(FALSE)) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserGroups model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserGroups model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UserGroups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = UserGroups::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
