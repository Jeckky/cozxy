<?php

namespace backend\modules\management\controllers;

use Yii;
use common\models\costfit\Menu;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends ManagementMasterController {

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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Menu::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Menu();
        if (isset($_POST["Menu"])) {
            $model->attributes = $_POST["Menu"];
            if (isset($_POST["Menu"]['user_group_Id'])) {
                $rules = '';
                foreach ($_POST["Menu"]['user_group_Id'] as $value) {
                    $rules .= $value . ',';
                }
                $listRules = substr($rules, 0, -1);
                $getRules = '[' . $listRules . ']';
            } else {
                $getRules = '[]';
            }
            if (isset($_POST["Menu"]['parent_id']) && empty($_POST["Menu"]['parent_id'])) {
                $model->parent_id = $_POST["Menu"]['parent_id'];
            } else {
                $model->parent_id = 0;
            }
            $model->user_group_Id = $getRules;

            $model->createDateTime = new \yii\db\Expression('NOW()');

            //echo '<pre>';
            //print_r($model->attributes );
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        $listViewLevels = new ActiveDataProvider([
            'query' => \common\models\costfit\UserGroups::find(),
        ]);
        return $this->render('create', [
            'model' => $model, 'listViewLevels' => $listViewLevels
        ]);
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $menuId = $_GET['id'];
        $getMenu = \common\models\costfit\Menu::find()->where('menuId =' . $menuId)->one();
        $getLevel = \common\models\costfit\Level::find()->select('levelId,name')->where('levelId in (' . $getMenu['levelId'] . ')')->all();
        $list = \yii\helpers\ArrayHelper::map($getLevel, 'levelId', 'name');
        //find($id)->select('id,name as full')->asArray()->all();
        //$data = ArrayHelper::toArray($getLevel);
        // $datav = '';
        $data = \yii\helpers\ArrayHelper::map(\common\models\costfit\Level::find()->where('levelId in (' . $getMenu['levelId'] . ')')->asArray()->all(), 'levelId', 'name');


        // echo '<pre>';
        // print_r($datav);
        // echo $datav;
        if (isset($_POST["Menu"])) {
            $model->attributes = $_POST["Menu"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index

      ' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Menu::findOne($id)) !== null) {
            //echo '<pre>';
            //print_r($model);
            return $model;
        } else {
            throw new NotFoundHttpException('

        The requested page does not exist.');
        }
    }

}
