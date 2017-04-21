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
use common\models\costfit\PaymentMethod;
use common\helpers\CozxyUnity;
use common\helpers\IntToBath;

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
        //$paymentMethod = PaymentMethod::find()->where("status=1")->all();
        $paymentMethod = PaymentMethod::find()->where("status=1")->all();
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
            if ($_POST["paymentType"] == 'credit') {
                $topUpDraf->paymentMethod = 2; //
                $data["paymentType"] = "ชำระผ่านบัตรเครดิต";
            } else if ($_POST["paymentType"] == 'bill') {
                $topUpDraf->paymentMethod = 1;
                $data["paymentType"] = "โอนเงินผ่านธนาคาร";
            }
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
                            'data' => $data,
                            'paymentMethod' => $paymentMethod
                ]);
            }
        } else {
            return $this->render('index', [
                        'data' => $data,
                        'paymentMethod' => $paymentMethod,
                        'ms' => $msg
            ]);
        }
    }

    public function actionGen() {
        /* $productSupp = \common\models\costfit\ProductSuppliers::find()->where("1")->one();
          $code = \common\helpers\Product::generateProductCode();
          for ($i = 0; $i < 10000000; $i++):
          $code++;
          endfor;
          throw new \yii\base\Exception($code); */
        /* foreach ($productSupp as $supp) {
          $supp->code = \common\helpers\Product::generateProductCode($supp->productSuppId);
          //$supp->code = null;
          $supp->save(false);
          } */
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
            if (isset($topUp) && count($topUp) > 0) {
                $topUp->status = TopUp::TOPUP_STATUS_E_PAYMENT_SUCCESS;
                $topUp->updateDateTime = new \yii\db\Expression('NOW()');
                $topUp->topUpNo = $this->topUpNo();
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
                            'topUpId' => $topUp->topUpId,
                            'currentPoint' => $currentPoint,
                            'type' => $type,
                ]);
            } else {
                return $this->redirect(Yii::$app->homeUrl . 'top-up');
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

    public function topUpNo() {
        $y = date('Y');
        $m = date('m');
        $ym = $y . '/' . $m;
        $lastNo = TopUp::find()->where("topUpNo like '$ym%'")->orderBy('topUpNo DESC')->one();
        if (isset($lastNo)) {
            $topUpNo = $lastNo->topUpNo;
            $topUpNo++;
        } else {
            $topUpNo = $ym . '/' . '00001';
        }
        return $topUpNo;
    }

    public function actionRandomPass() {
        $res = [];
        $res["pass"] = rand('000000', '999999');
        return json_encode($res);
    }

    public function actionBillpay($epay) {
        $k = base64_decode(base64_decode($epay));
        $topUpId = \common\models\ModelMaster::decodeParams($epay);
        $header = $this->renderPartial('header');
        $title = FALSE;
        $topUp = TopUp::find()->where("topUpId=" . $topUpId)->one();
        if (isset($topUp)) {
            $customerName = User::userName($topUp->userId);
            $address = User::userAddressText(User::supplierDetail($topUp->userId)->addressId, false);
            $topUpNo = $topUp->topUpNo;
            $subDate = substr($topUp->updateDateTime, 0, -9);
            $date = $this->changDateFormat($subDate);
            $amount = $topUp->money;
            $point = $topUp->point;
            $method = $topUp->paymentMethod;
            $textBath = IntToBath::changeToBath(number_format($topUp->money, 2));
        }
        $content = $this->renderPartial('content', [
            'customerName' => $customerName,
            'address' => $address,
            'topUpNo' => $topUpNo,
            'date' => $date,
            'point' => $point,
            'amount' => $amount,
            'method' => $method,
            'textBath' => $textBath
        ]);
        //$content = '';
        CozxyUnity::actionMpdfDocument($content, $header, $title);
    }

    public function changDateFormat($subDate) {
        $d = substr($subDate, 8, 2);
        $m = substr($subDate, 5, 2);
        $y = substr($subDate, 0, 4);
        $date = $d . '/' . $m . '/' . $y;
        return $date;
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
