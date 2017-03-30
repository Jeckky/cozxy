<?php

namespace frontend\controllers;

use Yii;
use common\models\costfit\TopUp;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\User;
use yii\helpers\Json;
use common\models\costfit\UserPoint;

/**
 * TopUpController implements the CRUD actions for TopUp model.
 */
class TopUpController extends MasterController {

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
     * Lists all TopUp models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        $msg = '';
        if (isset($_GET['ms'])) {
            $msg = $_GET['ms'];
        }
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Top up';
        $data = [];
        $user = User::find()->where("userId='" . Yii::$app->user->id . "'")->one();
        $data["email"] = $user->email;
        $data["name"] = $user->firstname . ' ' . $user->lastname;
        $data["number"] = rand('000000', '999999');
        if (isset($_POST["inputPass"]) && !empty($_POST["inputPass"])) {
            $topUpDraf = new TopUp();
            $topUpDraf->userId = Yii::$app->user->id;
            $topUpDraf->status = TopUp::TOPUP_STATUS_E_PAYMENT_DRAFT;
            $topUpDraf->createDateTime = new \yii\db\Expression('NOW()');
            $topUpDraf->updateDateTime = new \yii\db\Expression('NOW()');
            $topUpDraf->save(false);
            return $this->render('amount', [
                        'data' => $data
            ]);
        }
        if (isset($_POST["amount"]) && !empty($_POST["amount"])) {
            $topUp = TopUp::find()->where("userId=" . Yii::$app->user->id . " and status=" . TopUp::TOPUP_STATUS_E_PAYMENT_DRAFT)->one();
            $amount = $_POST["amount"];
            if (isset($topUp) && !empty($topUp)) {
                $topUp->money = $amount;
                $topUp->point = $amount; //รอ คิด
                $topUp->status = TopUp::TOPUP_STATUS_COMFIRM_PAYMENT;
                $topUp->updateDateTime = new \yii\db\Expression('NOW()');
                $topUp->save(false);
                return $this->redirect(['test-result', 'userId' => $user->userId, 'amount' => $_POST["amount"]]);
            } else {
                return $this->render('index', [
                            'data' => $data
                ]);
            }
        } else {
            return $this->render('index', [
                        'data' => $data,
                        'ms' => $msg
            ]);
        }
    }

    public function actionGen() {
        $productSupp = \common\models\costfit\ProductSuppliers::find()->where(1)->all();
    }

    public function actionTestResult($userId, $amount) {
        $flag = true; //test
        $response = [];
        if ($flag == true) {//เติมเงินสำเร็จ
            $response["decision"] = "ACCEPT";
        } else {//เติมเงินไม่สำเร็จ
            $response["decision"] = "DISCLAIM";
        }
        return $this->redirect(['result', 'res' => $response["decision"]]);
    }

    public function actionResult($res) {
        $currentPoint = 0;
        if ($res == "ACCEPT") {
            $topUp = TopUp::find()->where("userId=" . Yii::$app->user->id . " and status=" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT)->one();
            if (isset($topUp) && !empty($topUp)) {
                $topUp->status = TopUp::TOPUP_STATUS_E_PAYMENT_SUCCESS;
                $topUp->updateDateTime = new \yii\db\Expression('NOW()');
                $topUp->save(false);
                $userPoint = UserPoint::find()->where("userId=" . Yii::$app->user->id)->one();
                if (isset($userPoint) && !empty($userPoint)) {
                    $userPoint->currentPoint += $topUp->point;
                    $userPoint->totalPoint += $topUp->point;
                    $userPoint->totalMoney += $topUp->money;
                    $userPoint->updateDateTime = new \yii\db\Expression('NOW()');
                    $currentPoint = $userPoint->currentPoint;
                    $userPoint->save(false);
                } else {
                    $userPoint = new UserPoint();
                    $userPoint->userId = Yii::$app->user->id;
                    $userPoint->currentPoint = $topUp->point;
                    $userPoint->totalPoint = $topUp->point;
                    $userPoint->totalMoney = $topUp->money;
                    $userPoint->status = 1;
                    $userPoint->createDateTime = new \yii\db\Expression('NOW()');
                    $userPoint->updateDateTime = new \yii\db\Expression('NOW()');
                    $userPoint->save(false);
                    $currentPoint = $userPoint->currentPoint;
                }
                $type = 'success';
                return $this->render('thank', [
                            'currentPoint' => $currentPoint,
                            'type' => $type,
                ]);
            } else {
                // go to error page
            }
        } else {
            $topUp = TopUp::find()->where("userId=" . Yii::$app->user->id . " and status=" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT)->one();
            if (isset($topUp) && !empty($topUp)) {
                $topUp->status = TopUp::TOPUP_STATUS_E_PAYMENT_DISCLAIM;
                $topUp->updateDateTime = new \yii\db\Expression('NOW()');
                $topUp->save(false);
                $type = 'fail';
                return $this->render('thank', [
                            'type' => $type]);
            }
        }
    }

    public function actionRandomPass() {
        $res = [];
        $res["pass"] = rand('000000', '999999');
        return json_encode($res);
    }

    /**
     * Displays a single TopUp model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TopUp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TopUp();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->topUpId]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TopUp model.
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
     * Deletes an existing TopUp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TopUp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TopUp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TopUp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
