<?php

namespace backend\modules\management\controllers;

use Yii;
use common\models\costfit\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends ManagementMasterController {

    public function behaviors() {
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {

        $modelUser = $this->findModel($id);
        //echo $modelUser->user_group_Id;
        $CheckuserGroup = str_replace('[', '', str_replace(']', '', $modelUser->user_group_Id));

        if ($CheckuserGroup != '') {
            $userGroupx = str_replace('[', '(', str_replace(']', ')', $modelUser->user_group_Id));
            // echo $userGroupx;
            /*
              $result = \common\models\costfit\UserGroups::find()
              ->select('group_concat(name) as name , group_concat(user_group_Id) as user_group_Id')
              ->where("user_group_Id in " . $userGroupx . "  ")
              ->one();
             * */
        } else {
            $result = NULL;
        }

        $query = '';
        $listViewLevels = new ActiveDataProvider([
            'query' => \common\models\costfit\UserGroups::find(),
        ]);

        $listMenu = new ActiveDataProvider([
            'query' => \common\models\costfit\Menu::find(),
        ]);

        //echo '<pre>';
        // print_r($listMenu);

        return $this->render('view', [
            'model' => $this->findModel($id), 'listViewLevels' => $listViewLevels, 'listMenu' => $listMenu
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();
        if (isset($_POST["User"])) {
            $model->attributes = $_POST["User"];
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
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["User"])) {
            $model->attributes = $_POST["User"];
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
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Access an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param
     * @return
     */
    public function actionGroup($id) {
        $model = $this->findModel($id);
        if (isset($_POST["ViewLevels"])) {
            $model->attributes = $_POST["ViewLevels"];
            if (isset($_POST["ViewLevels"]['user_group_Id'])) {
                $rules = '';
                foreach ($_POST["ViewLevels"]['user_group_Id'] as $value) {
                    $rules .= $value . ',';
                }
                $listRules = substr($rules, 0, -1);
                $getRules = '[' . $listRules . ']';
            } else {
                $getRules = '[]';
            }
            $model->user_group_Id = $getRules;
            $model->updateDateTime = new \yii\db\Expression('NOW()');

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Access an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param
     * @return
     */
    public function actionAccess($id) {
        $model = $this->findModel($id);
        if (isset($_POST["Access"])) {
            $model->attributes = $_POST["Access"];
            $model->type = $_POST["Access"]['jq-validation-radios'];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
