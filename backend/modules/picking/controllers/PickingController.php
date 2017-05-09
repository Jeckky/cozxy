<?php

namespace backend\modules\picking\controllers;

use Yii;
use common\models\costfit\PickingPoint;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/* เพิ่มคำสั่ง 3 บรรทัดต่อจากนี้ลงไป */
use yii\filters\AccessControl;        // เรียกใช้ คลาส AccessControl
use common\models\User;             // เรียกใช้ Model คลาส User ที่ปรับปรังปรุงไว้
use common\components\AccessRule;   // เรียกใช้ คลาส Component AccessRule ที่เราสร้างใหม่
use common\helpers\Upload;

/**
 * PickingController implements the CRUD actions for PickingPoint model.
 */
class PickingController extends PickingMasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            /* 'access' => [
              'class' => AccessControl::className(),
              'only' => ['index', 'create', 'update', 'view', 'virtual'], // กำหนด action ทั้งหมดภายใน Controller นี้
              'ruleConfig' => [
              'class' => AccessRule::className() // เรียกใช้งาน accessRule (component) ที่เราสร้างขึ้นใหม่
              ],
              'rules' => [
              [
              'actions' => ['index'], // กำหนด rules ให้ actionIndex()
              'allow' => true,
              'roles' => ['@'
              // User::ROLE_Administrator, // อนุญาตให้ "ผู้ใช้งาน / สมาชิก" ใช้งานได้
              //User::ROLE_SuperAdministrator, // อนุญาตให้ "พนักงาน" ใช้งานได้
              ]
              ],
              [
              'actions' => ['create'], // กำหนด rules ให้ actionCreate()
              'allow' => true,
              'roles' => ['@'
              //User::ROLE_Administrator, // อนุญาตให้ "ผู้ใช้งาน / สมาชิก" ใช้งานได้
              ]
              ],
              [
              'actions' => ['view'], // กำหนด rules ให้ actionView()
              'allow' => true,
              'roles' => ['@'
              // User::ROLE_Administrator, // อนุญาตให้ "ผู้ใช้งาน / สมาชิก" ใช้งานได้
              ]
              ]
              ],
              ], */
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PickingPoint models.
     * @return mixed
     */
    public function actionIndex() {

        $receive = Yii::$app->request->get('receive');

        $dataProvider = new ActiveDataProvider([
            'query' => PickingPoint::find()->where('type =' . $receive),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider, 'receiveType' => $receive
        ]);
    }

    /**
     * Displays a single PickingPoint model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        $receive = Yii::$app->request->get('receive');
        return $this->render('view', [
            'model' => $this->findModel($id), 'receiveType' => $receive
        ]);
    }

    /**
     * Creates a new PickingPoint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $receive = Yii::$app->request->get('receive');
        $folderName = "map"; //  Size 553 x 484
        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . 'picking-point/' . $folderName;
        $model = new PickingPoint();

        if (isset($_POST["PickingPoint"])) {

            $model->status = $_POST["PickingPoint"]['status'];
            $model->type = $receive;
            $model->createDateTime = new \yii\db\Expression('NOW()');

            $imageObj = \yii\web\UploadedFile::getInstanceByName("PickingPoint[mapImages]");
            if (isset($imageObj) && !empty($imageObj)) {
                $newFileName = Upload::UploadBasic('PickingPoint[mapImages]', $folderName, $uploadPath, '500', '500');
                $model->mapImages = '/' . 'images/' . 'picking-point/' . $folderName . "/" . $newFileName;
            } else {
                echo 'No';
            }
            if ($receive != 3) {
                $PickingPointFormat = \common\models\costfit\PickingPointFormatLockers::find()->all();
            } else {
                $PickingPointFormat = \common\models\costfit\PickingPointFormatBooth::find()->all();
            }
            //echo Yii::$app->db->lastInsertID;
            //exit();

            if ($model->save(FALSE)) {
                $pickingId = Yii::$app->db->getLastInsertID();
                foreach ($PickingPointFormat as $value) {

                    //$ppi = \common\models\costfit\PickingPointItems::find()->one();
                    $ppItems = new \common\models\costfit\PickingPointItems();
                    $ppItems->pickingId = $pickingId;
                    $ppItems->code = $value->code;
                    $ppItems->name = $value->name;
                    $ppItems->portIndex = $value->portIndex;
                    $ppItems->height = $value->height;
                    $ppItems->status = $value->status;
                    $ppItems->createDateTime = new \yii\db\Expression("NOW()");
                    $ppItems->save();
                }
                //return $this->redirect(['index']);
                return $this->redirect(['view', 'id' => $model->pickingId, 'receive' => $receive]);
            }
        }
        return $this->render('create', [
            'model' => $model, 'receive' => $receive
        ]);
    }

    /**
     * Updates an existing PickingPoint model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $receive = Yii::$app->request->get('receive');
        //echo $receive;
        $model = $this->findModel($id);
        $modelImage = $this->findModel($id);
        $folderName = "map"; //  Size 553 x 484
        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . 'picking-point/' . $folderName;

        if (isset($_POST["PickingPoint"])) {
            /*
             * Upload ครั้งละรูป
             * helpers Upload
             * path : common/helpers/Upload.php
             * use : Upload::uploadBasic($fileName, $folderName, $uploadPath, $width, $height)
             */
            $model->attributes = $_POST["PickingPoint"];
            $imageObj = \yii\web\UploadedFile::getInstanceByName("PickingPoint[mapImages]");

            //echo '<pre>';
            //var_dump($imageObj);
            //exit();
            //print_r($imageObj);
            // exit();
            // if (var_dump($imageObj) == NULL) {
            //echo '1';
            //$model->mapImages = $model->mapImages;
            //} else {
            if (isset($imageObj) && !empty($imageObj)) {
                //if ($imageObj->name != '') {
                $newFileName = Upload::UploadBasic('PickingPoint[mapImages]', $folderName, $uploadPath, '500', '500');
                $model->mapImages = '/' . 'images/' . 'picking-point/' . $folderName . "/" . $newFileName;
                //}
            } else {
                //echo 'No';
                $model->mapImages = $modelImage->mapImages;
            }
            //echo '2';
            //}

            $model->updateDateTime = new \yii\db\Expression('NOW()');
            //exit();
            //if ($model->load(Yii::$app->request->post()) && $model->save(FALSE)) {
            if ($model->save(FALSE)) {
                return $this->redirect(['view', 'id' => $model->pickingId, 'receive' => $receive]);
            } else {
                return $this->render('update', [
                    'model' => $model, 'receive' => $receive
                ]);
            }
        }
        return $this->render('update', [
            'model' => $model, 'receive' => $receive
        ]);
    }

    /**
     * Deletes an existing PickingPoint model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        $receive = Yii::$app->request->get('receive');
        return $this->redirect(['index', 'receive' => $receive]);
    }

    /**
     * Finds the PickingPoint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PickingPoint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PickingPoint::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionVirtual() {
        $model = new PickingPoint();
        $pickingPoint = PickingPoint::find()->all();
        if (isset($_GET['PickingPoint']['pickingId']) && !empty($_GET['PickingPoint']['pickingId'])) {
            $pickingPoints = PickingPoint::find()->where("pickingId=" . $_GET['PickingPoint']['pickingId'])->all();
        } else {
            $pickingPoints = PickingPoint::find()->all();
        }
        return $this->render('virtual', [
            'model' => $model,
            'pickingPoints' => $pickingPoints,
            'pickingPoint' => $pickingPoint,
        ]);
    }

}
