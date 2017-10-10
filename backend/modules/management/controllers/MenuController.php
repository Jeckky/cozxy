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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Menu::find(),
            'pagination' => [
                'pageSize' => 550,
            ],
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
        $actions = 'create';
        if (isset($_POST["Menu"])) {
            $model->attributes = $_POST["Menu"];
            if (isset($_POST["Menu"]['user_group_Id'])) {
                $rules = '';
                foreach ($_POST["Menu"]['user_group_Id'] as $value) {
                    $rules .= $value . ',';
                }
                $listRules = substr($rules, 0, -1);
                //$getRules = '[' . $listRules . ']';
                $getRules = $listRules;
            } else {
                //$getRules = '[]';
                $getRules = '';
            }

            if (isset($_POST["Menu"]['parent_id']) || empty($_POST["Menu"]['parent_id'])) {
                $model->parent_id = ($_POST["Menu"]['parent_id'] != '') ? $_POST["Menu"]['parent_id'] : 0;
            } else {
                $model->parent_id = $_POST["Menu"]['parent_id'];
            }

            $model->user_group_Id = 0;
            $model->assignment = $getRules;
            $model->createDateTime = new \yii\db\Expression('NOW()');

            //echo '<pre>';
            //print_r($model->attributes );
            if ($model->save(FALSE)) {
                return $this->redirect(['index']);
            }
        }
        /* $listViewLevels = new ActiveDataProvider([
          //'query' => \common\models\costfit\UserGroups::find(),
          'query' => \common\models\costfit\AuthAssignment::find(),
          ]); */
        $listViewLevels = \common\models\costfit\AuthItem::find()->where('type=1')->all();


        return $this->render('create', [
            'model' => $model, 'listViewLevels' => $listViewLevels, 'actions' => $actions
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
        $actions = 'update';
        //$getMenu = \common\models\costfit\Menu::find()->where('menuId =' . $menuId)->one();
        //echo $getMenu->user_group_Id;
        //$test = \common\models\costfit\UserGroups::checkUserGroupTest($getMenu->user_group_Id, $id);
        //echo '<pre>';
        //print_r($test);
        //exit();
        //$CheckuserGroup = str_replace('[', '', str_replace(']', '', $getMenu->user_group_Id));
        //echo $CheckuserGroup;
        if (isset($_POST["Menu"])) {
            $model->attributes = $_POST["Menu"];
            if (isset($_POST["Menu"]['user_group_Id'])) {
                $rules = '';
                foreach ($_POST["Menu"]['user_group_Id'] as $value) {
                    $rules .= $value . ',';
                }
                $listRules = substr($rules, 0, -1);
                //$getRules = '[' . $listRules . ']';
                $getRules = $listRules;
            } else {
                //$getRules = '[]';
                $getRules = '';
            }
            $model->user_group_Id = 0;
            $model->assignment = $getRules;
            if (isset($_POST["Menu"]['parent_id'])) {
                //echo 'isset';
                $model->parent_id = ($_POST["Menu"]['parent_id'] == '') ? 0 : $_POST["Menu"]['parent_id'];
            } else {
                $model->parent_id = 0;
                //echo 'not isset';
            }
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save(FALSE)) {
                return $this->redirect(['index']);
            }
        }
        /*
          $listViewLevels = new ActiveDataProvider([
          'query' => \common\models\costfit\UserGroups::find()
          //->select('(select menu.user_group_Id from costfit_dev.menu where menuId = ' . $id . '  limit 1) as MenuGroup'),
          //\common\models\costfit\UserGroups::find(),
          ]); */

        $listViewLevels = \common\models\costfit\AuthItem::find()->where('type=1')->all();
        return $this->render('update', [
            'model' => $model, 'listViewLevels' => $listViewLevels, 'actions' => $actions
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
