<?php

namespace backend\modules\supplier\controllers;

use Yii;
use common\models\costfit\Supplier;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Address;

/**
 * SupplierController implements the CRUD actions for Supplier model.
 */
class SupplierController extends SupplierMasterController {

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
     * Lists all Supplier models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Supplier::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Supplier model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Supplier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Supplier();
        if (isset($_POST["Supplier"])) {
            $model->attributes = $_POST["Supplier"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionSupplierAddress() {
        $model = Address::find()->where("userId=" . \Yii::$app->user->id . " and type=4")->one();
        return $this->render('supplier_address', [
                    'model' => $model
        ]);
    }

    public function actionCreateSupplierAddress() {
        $model = Address::find()->where("userId=" . \Yii::$app->user->id . " and type=4")->one();
        $hash = 'edit';
        if (!isset($model)) {
            $model = new Address();
            $hash = 'add';
        }

        if (isset($_POST["Address"])) {
            $model->attributes = $_POST["Address"];
            $model->status = 1;
            $model->userId = \Yii::$app->user->id;
            $model->type = 0x4;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['supplier-address']);
            }
        }
        return $this->render('address_form', [
                    'model' => $model,
                    'hash' => $hash
        ]);
    }

    /**
     * Updates an existing Supplier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["Supplier"])) {
            $model->attributes = $_POST["Supplier"];
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
     * Deletes an existing Supplier model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Supplier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Supplier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Supplier::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
