<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use common\models\costfit\receive;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;
use common\models\costfit\User;
use common\models\costfit\Address;

/**
 * ReceiveController implements the CRUD actions for receive model.
 */
class ReceiveController extends MasterController {

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
     * Lists all receive models.
     * @return mixed
     */
    public function actionIndex() {
        $ms = '';
        $tel = '';
        $model = new \common\models\costfit\Receive();

        if (isset($_POST['Receive']['password']) && !empty($_POST['Receive']['password'])) {
            $order = Order::find()->where("password='" . $_POST['Receive']['password'] . "'")->one();
            if (isset($order) && !empty($order)) {
                $user = User::find()->where("userId='" . $order->userId . "'")->one();
                if (isset($user) && !empty($user)) {
                    $address = Address::find()->where("userId='" . $user->userId . "' and isDefault=1")->one();
                    if (isset($address) && !empty($address)) {
                        $tel = $address->tel;
                    }
                    return $this->render('detail', [
                                'user' => $user,
                                'tel' => $tel,
                                'orderId' => $order->orderId
                    ]);
                } else {
                    $ms = 'ไม่พบรายชื่อของท่าน';
                }
            } else {
                $ms = 'ไม่เจอรายการสินค้า';
            }
            if ($ms != '') {//ถ้าไม่เจอรายการ แสดงข้อความ แล้วกลับไปหน้าเดิม
                return $this->render('error', [
                            'ms' => $ms
                ]);
            }
        }
        return $this->render('index', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single receive model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new receive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new receive();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->receiveId]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing receive model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->receiveId]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing receive model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSendEmail() {
        throw new \yii\base\Exception('yes');
    }

    public function actionSendSms($orderId) {

    }

    /**
     * Finds the receive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return receive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = receive::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
