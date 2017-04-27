<?php

namespace backend\modules\topup\controllers;

use Yii;
use common\models\costfit\Topup;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TopupController implements the CRUD actions for Topup model.
 */
class TopupController extends TopupMasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Topup models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Topup::find()
                    ->where("status=" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT . " and paymentMethod=1")
                ,
        ]);
        if (isset($_POST["fileCsv"])) {
            $folderName = "file"; //  folderName
            $folderThumbnail = "billpayment"; //  folderName
            $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail; // Path
            $file = \yii\web\UploadedFile::getInstanceByName('fileCsv[csv]');
            $newFileName = \Yii::$app->security->generateRandomString(10) . '.' . $file->extension;
            $ext = explode('.', $file->name);
            if (end($ext) == 'csv') {
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777);
                }
                $upload = $file->saveAs($uploadPath . '/' . $newFileName);
                if ($upload) {

                    //define('CSV_PATH', $uploadPath);
                    //$csv_file = CSV_PATH . '/' . $newFileName;
                    $csv_file = $uploadPath . '/' . $newFileName;
                    // throw new \yii\base\Exception($csv_file);
                    $fcsv = fopen($csv_file, "r");
                    if ($fcsv) {
                        $r = 1;
                        $data = [];
                        while (!feof($fcsv)) {
                            throw new \yii\base\Exception(print_r($fcsv, true));
                        }
                    }
                }
                fclose($fcsv);
                return $this->render('index', [
                            'dataProvider' => $dataProvider,
                            'data' => $data
                ]);
            } else {
                return $this->render('index', [
                            'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            return $this->render('index', [
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Topup model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Topup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Topup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->topUpId]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Topup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->topUpId]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Topup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Topup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Topup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Topup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
