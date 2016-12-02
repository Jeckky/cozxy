<?php

namespace backend\modules\management\controllers;

use Yii;
use common\models\costfit\ViewLevels;
use common\models\costfit\UserGroups;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//php composer.phar require --prefer-dist leandrogehlen/yii2-treegrid "*"
//use leandrogehlen\treegrid\TreeGrid;
//use leandrogehlen\leandrogehlen\treegrid;

/**
 * ViewLevelsController implements the CRUD actions for ViewLevels model.
 */
class ViewLevelsController extends ManagementMasterController {

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
     * Lists all ViewLevels models.
     * @return mixed
     */
    public function actionIndex() {
        //$listViewLevels = \common\models\costfit\ViewLevels::find()->one();
        $dataProvider = new ActiveDataProvider([
            'query' => ViewLevels::find(),
        ]);
        $listViewLevels = new ActiveDataProvider([
            'query' => \common\models\costfit\UserGroups::find(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider, 'listViewLevels' => $listViewLevels
        ]);
    }

    /**
     * Displays a single ViewLevels model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        //$listViewLevels = \common\models\costfit\ViewLevels::find()->one();
        $listViewLevels = new ActiveDataProvider([
            'query' => \common\models\costfit\UserGroups::find(),
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id), 'listViewLevels' => $listViewLevels
        ]);
    }

    /**
     * Creates a new ViewLevels model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        //$listViewLevels = \common\models\costfit\ViewLevels::find()->all();
        $model = new ViewLevels();
        $actions = 'create';
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
            $model->rules = $getRules;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save(FALSE)) {
                return $this->redirect(['index']);
            }
        }
        //$listViewLevels = \common\models\costfit\ViewLevels::find()->all();
        //$listViewLevels = \common\models\costfit\UserGroups::find()->all();
        //echo count($listViewLevels);
        $listViewLevels = new ActiveDataProvider([
            'query' => \common\models\costfit\UserGroups::find(),
        ]);
        // echo '<pre>';
        //print_r($listViewLevels);
        //exit();
        return $this->render('create', [
            'model' => $model, 'listViewLevels' => $listViewLevels, 'actions' => $actions
        ]);
    }

    /**
     * Updates an existing ViewLevels model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {

        $model = $this->findModel($id);
        $actions = 'update';

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
            $model->rules = $getRules;
            $model->updateDateTime = new \yii\db\Expression('NOW()');

            if ($model->save(FALSE)) {
                return $this->redirect(['index']);
            }
        }
        $listViewLevels = new ActiveDataProvider([
            'query' => \common\models\costfit\UserGroups::find(),
        ]);
        return $this->render('update', [
            'model' => $model, 'listViewLevels' => $listViewLevels, 'actions' => $actions
        ]);
    }

    /**
     * Deletes an existing ViewLevels model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ViewLevels model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ViewLevels the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ViewLevels::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
