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
use kartik\mpdf\Pdf;

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
        $needMore = 0;
        //$paymentMethod = PaymentMethod::find()->where("status=1")->all();
        $paymentMethod = PaymentMethod::find()->where("status=1")->all();
        if (isset($_GET['ms'])) {
            $msg = $_GET['ms'];
        }
        if (isset($_GET['needMore'])) {
            $needMore = $_GET['needMore'];
        }
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Top up';
        $data = [];
        $user = User::find()->where("userId='" . Yii::$app->user->id . "'")->one();
        $data["email"] = $user->email;
        $data["name"] = $user->firstname . ' ' . $user->lastname;
        $data["number"] = rand('000000', '999999');
        if (isset($_POST["inputPass"]) && !empty($_POST["inputPass"])) {
            $fromCheckout = 'no';
            $needMore = 0;
            if ($_POST["paymentType"] == 'credit') {
                $paymentMethods = 2; //
            } else if ($_POST["paymentType"] == 'bill') {
                $paymentMethods = 1;
            }
            $isOld = TopUp::find()->where("userId='" . Yii::$app->user->id . "' and status=" . TopUp::TOPUP_STATUS_E_PAYMENT_DRAFT . " or status=" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT . " and paymentMethod=" . $paymentMethods)->one();
            if (isset($isOld)) {
                $ms = 'ไม่สามารถทำรายการได้เนื่องจากคุณมีรายการที่รอชำระเงินค้างอยู่ กรุณาชำระเงิน หรือ ยกเลิกรายการที่ค้างอยู่';
                return $this->render('index', [
                            'data' => $data,
                            'paymentMethod' => $paymentMethod,
                            'ms' => $ms,
                            'needMore' => $needMore
                ]);
                //$topUpDraf = $isOld;
            } else {
                $topUpDraf = new TopUp();
                $topUpDraf->userId = Yii::$app->user->id;
            }

            if ($_POST["paymentType"] == 'credit') {
                $topUpDraf->paymentMethod = 2; //
                $data["paymentType"] = "ชำระผ่านบัตรเครดิต";
            } else if ($_POST["paymentType"] == 'bill') {
                $topUpDraf->paymentMethod = 1;
                $data["paymentType"] = "โอนเงินผ่านธนาคาร";
            }
            if (isset($_POST["checkout"]) && $_POST["checkout"] != '') {
                $fromCheckout = 'yes';
            }
            if (isset($_POST["needMore"]) && $_POST["needMore"] != 0) {
                $needMore = $_POST["needMore"];
            }

            $topUpDraf->status = TopUp::TOPUP_STATUS_E_PAYMENT_DRAFT;
            $topUpDraf->createDateTime = new \yii\db\Expression('NOW()');
            $topUpDraf->updateDateTime = new \yii\db\Expression('NOW()');
            $topUpDraf->save(false);

            return $this->render('amount', [
                        'data' => $data,
                        'fromCheckout' => $fromCheckout,
                        'needMore' => $needMore
            ]);
        }
        if (isset($_POST["amount"]) && !empty($_POST["amount"])) {
            $topUp = TopUp::find()->where("userId=" . Yii::$app->user->id . " and status=" . TopUp::TOPUP_STATUS_E_PAYMENT_DRAFT)->one();
            $amount = $_POST["amount"];
            if (isset($topUp) && count($topUp) > 0) {
                $fromCheckout = 'no';
                if (isset($_POST["fromCheckout"]) && $_POST["fromCheckout"] != 'no') {
                    $fromCheckout = 'yes';
                }
                $topUp->money = $amount;
                $topUp->point = $amount; //รอ คิด
                $topUp->status = TopUp::TOPUP_STATUS_COMFIRM_PAYMENT;
                $topUp->updateDateTime = new \yii\db\Expression('NOW()');
                $topUp->save(false);
                if ($topUp->paymentMethod == 2) {//Payment Method เป็น การชำระด้วยบัตรเครดิต
                    return $this->redirect(['test-result',
                                'userId' => $user->userId,
                                'amount' => $_POST["amount"],
                                'fromCheckout' => $fromCheckout
                    ]);
                } else if ($topUp->paymentMethod = 1) {//Payment Method เป็นการชำระด้วย Bill payment
                    return $this->redirect(['print-payment-form',
                                'userId' => $user->userId,
                                'amount' => $_POST["amount"],
                                'fromCheckout' => $fromCheckout
                    ]);
                }
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
                        'ms' => $msg,
                        'needMore' => $needMore
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

    public function actionTestResult($userId, $amount, $fromCheckout) {
        $flag = true; //test
        $response = [];
        if ($flag == true) {//เติมเงินสำเร็จ
            $response["decision"] = "ACCEPT";
        } else {//เติมเงินไม่สำเร็จ
            $response["decision"] = "DISCLAIM";
        }
        return $this->redirect(['result',
                    'res' => $response["decision"],
                    'fromCheckout' => $fromCheckout
        ]);
    }

    public function actionPrintPaymentForm($userId, $amount, $fromCheckout) {
        $customerName = User::userName($userId);
        $customerTel = User::userTel($userId);
        $taxId = '0105553036789';
        $topUp = TopUp::find()->where("userId=" . Yii::$app->user->id . " and status=" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT)->one();
        if (($topUp->topUpNo == NULL) && ($topUp->topUpNo == '')) {
            $topUp->topUpNo = $this->topUpNo();
        }
        $topUp->save(false);
        $tel = str_replace("-", "", $customerTel);
        $topUpCut = str_replace("/", "", $topUp->topUpNo);

        $amount1 = str_replace(",", "", number_format($amount, 2));
        $amount2 = str_replace(".", "", $amount1);
        $barCode = $taxId . $topUpCut . $tel . $amount2;
        $data = "| " . $taxId . " " . $topUpCut . " " . $tel . " " . $amount2;
        //throw new \yii\base\Exception($amount);
        return $this->render('billpayment', [
                    'amount' => $amount,
                    'customerName' => $customerName,
                    'customerTel' => $customerTel,
                    'topUpNo' => $topUp->topUpNo,
                    'taxId' => $taxId,
                    'barCode' => $barCode,
                    'data' => $data
        ]);
    }

    public function actionPrintPaymentFormTopdf() {
        $header = FALSE;
        //$header = $this->renderPartial('header');
        $content = $this->renderPartial('bill_form', [
            'amount' => $_GET["amount"],
            'customerName' => $_GET["customerName"],
            'customerTel' => $_GET["customerTel"],
            'topUpNo' => $_GET["topUpNo"],
            'taxId' => $_GET["taxId"],
            'barCode' => $_GET["barCode"],
            'data' => $_GET["data"]
        ]);
        $title = FALSE;
        $this->actionMpdfDocument($content, $header, $title);
    }

    public function actionResult($res, $fromCheckout) {
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
                if ($fromCheckout == 'yes') {// มาจากหน้า check out หรือไม่
                    $order = \common\models\costfit\Order::find()->where("userId='" . Yii::$app->user->id . "' and status='" . \common\models\costfit\Order::ORDER_STATUS_DRAFT . "'")->one();
                } else {
                    $order = '';
                }
                return $this->render('thank', [
                            'topUpId' => $topUp->topUpId,
                            'currentPoint' => $currentPoint,
                            'type' => $type,
                            'fromCheckout' => $fromCheckout,
                            'order' => $order
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
                            'type' => $type,
                            'fromCheckout' => 'no'
                ]);
            }
        }
    }

    public function topUpNo() {
        $y = date('Y');
        $m = date('m');
        $y = substr($y, 2, 2);
        $ym = $y . $m;
        // throw new \yii\base\Exception($ym);
        $lastNo = TopUp::find()->where("topUpNo like '$ym%'")->orderBy('topUpNo DESC')->one();
        if (isset($lastNo)) {
            $topUpNo = $lastNo->topUpNo;
            $topUpNo++;
        } else {
            $topUpNo = $ym . '00001';
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

    public function actionHistory() {
        $model = TopUp::find()->where("status >1 and userId=" . Yii::$app->user->id)->orderBy('updateDateTime DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
        ]);
        return $this->render('history', [
                    'model' => $model,
                    'dataProvider' => $dataProvider
        ]);
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

    public static function GetMpdfDocument($content, $setHeader = FALSE, $setFooter = FALSE, $marginTop = FALSE) {
        //$orderId = Yii::$app->request->get('OrderNo');
        // $orderId = $params['orderId'];
        // get your HTML raw content without any layouts or scripts
        // $content = $this->renderPartial('purchase_order');
        // $model = YourModel::findOne($id);
        // $content = $this->renderPartial('print', [ 'model' => $model]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@frontend/web/css/pdf.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            //'cssInline' => 'body{font-size:9px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Cozxy.com Print Purchase Order',],
            // call mPDF methods on the fly
            //'marginTop' => isset($marginTop) ? $marginTop : 35,
            'methods' => [
                //'SetHeader' => ['Cozxy.com Print Purchase Order'], //Krajee Report Header
                //'SetFooter' => ['{PAGENO}'],
                'SetHeader' => $setHeader, //Krajee Report Header
                'SetFooter' => $setFooter,
            ]
        ]);


        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    // Privacy statement output demo
    /*
     * ส่วนของ Frontend 10/1/2017
     * url ที่เรียกใช้ : payment/print-receipt/..........
     * By Taninut.Bm
     * email : taninut.bm@cozxy.com , sodapew17@gmail.com
     */
    public static function actionMpdfDocument($content, $header, $title) {

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@frontend/web/css/pdf.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            //'cssInline' => 'body{font-size:9px}',
            // set mPDF properties on the fly
            // 'defaultFontSize' => 3,
            // 'marginLeft' => 10,
            // 'marginRight' => 10,
            'marginTop' => 20,
            // 'marginBottom' => 11,
            //'marginHeader' => 6,
            //'marginFooter' => 6,
            // 'options' => ['title' => 'Cozxy.com Print ' . $title],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => [$header], //Krajee Report Header
            // 'SetFooter' => ['{PAGENO}'],
            // 'SetHeader' => FALSE, //Krajee Report Header
            /* 'SetFooter' => ['{PAGENO} / {nbpg}'
              ], */
            ]
        ]);


        // return the pdf output as per the destination setting
        return $pdf->render();
    }

}
