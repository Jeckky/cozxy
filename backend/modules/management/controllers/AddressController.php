<?php

namespace backend\modules\management\controllers;

use Yii;
use common\models\costfit\Address;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AddressController implements the CRUD actions for Address model.
 */
class AddressController extends ManagementMasterController {

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
     * Lists all Address models.
     * @return mixed
     */
    public function actionIndex() {
        $userId = Yii::$app->request->get('userId');
        $dataProvider = new ActiveDataProvider([
            'query' => Address::find()->where('userId=' . $userId),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Address model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Address model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $userId = Yii::$app->request->get('userId');
        $model = new Address();
        if (isset($_POST["Address"])) {
            $model->attributes = $_POST["Address"];
            $model->countryId = 'THA';
            $model->type = '1';
            $model->isDefault = '1';
            $model->userId = $userId;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                //return $this->redirect(['index']);.
                return $this->redirect('/management/user');
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Address model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["Address"])) {
            $model->attributes = $_POST["Address"];
            $model->districtId = isset($_POST["Address"]['districtId']) ? $_POST["Address"]['districtId'] : NULL;
            $model->provinceId = isset($_POST["Address"]['provinceId']) ? $_POST["Address"]['provinceId'] : NULL;
            $model->amphurId = isset($_POST["Address"]['amphurId']) ? $_POST["Address"]['amphurId'] : NULL;
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect('/management/user');
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Address model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect('/management/user');
    }

    /**
     * Finds the Address model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Address the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Address::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
