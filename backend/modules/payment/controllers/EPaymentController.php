<?php

namespace backend\modules\payment\controllers;

use Yii;
use common\models\costfit\EPayment;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EPaymentController implements the CRUD actions for EPayment model.
 */
class EPaymentController extends PaymentMasterController {

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
     * Lists all EPayment models.
     * @return mixed
     */
    public function actionIndex() {
        if (isset($_GET["paymentMethodId"])) {
            $query = EPayment::find()->where('paymentMethodId=' . $_GET["paymentMethodId"]);
        } else {
            $query = EPayment::find();
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EPayment model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EPayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new EPayment();
        if (isset($_GET["paymentMethodId"])) {
            $model->paymentMethodId = $_GET["paymentMethodId"];
        }
        if (isset($_POST["EPayment"])) {
            $model->attributes = $_POST["EPayment"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $ePaymentProfileIdObj = \yii\web\UploadedFile::getInstanceByName("EPayment[ePaymentProfileId]");
            if (isset($ePaymentProfileIdObj) && !empty($ePaymentProfileIdObj)) {
                $folderName = "EPayment";
                $file = $ePaymentProfileIdObj->name;
                $filenameArray = explode('.', $file);
                $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile = $urlFolder . $fileName;
                $model->ePaymentProfileId = '/' . 'images/' . $folderName . "/" . $fileName;
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777);
                }
            }
            if ($model->save()) {
                if (isset($ePaymentProfileIdObj) && $ePaymentProfileIdObj->saveAs($urlFile)) {
                    //Do Some Thing
                }
                return $this->redirect(['index', 'paymentMethodId' => $model->paymentMethodId]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EPayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["EPayment"])) {
            $model->attributes = $_POST["EPayment"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');

            $ePaymentProfileIdObj = \yii\web\UploadedFile::getInstanceByName("EPayment[ePaymentProfileId]");
            if (isset($ePaymentProfileIdObj) && !empty($ePaymentProfileIdObj)) {
                $folderName = "EPayment";
                $file = $ePaymentProfileIdObj->name;
                $filenameArray = explode('.', $file);
                $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile = $urlFolder . $fileName;
                $model->ePaymentProfileId = '/' . 'images/' . $folderName . "/" . $fileName;
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777);
                }
            } else {
                if (isset($_POST["EPayment"]["ePaymentProfileIdOld"])) {
                    $model->ePaymentProfileId = $_POST["EPayment"]["ePaymentProfileIdOld"];
                }
            }


            if ($model->save()) {
                if (isset($ePaymentProfileIdObj) && $ePaymentProfileIdObj->saveAs($urlFile)) {
                    //Do Some Thing
                }
                return $this->redirect(['index', 'paymentMethodId' => $model->paymentMethodId]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EPayment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EPayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EPayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = EPayment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
