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

    public function beforeAction($action) {
        if ($action->id == 'result') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
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
        $this->checkAddress();
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
            $isOld = TopUp::find()->where("userId='" . Yii::$app->user->id . "' and status=" . TopUp::TOPUP_STATUS_E_PAYMENT_DRAFT . " and paymentMethod=" . $paymentMethods)->one();
            if (isset($isOld)) {
                if ($isOld->status == TopUp::TOPUP_STATUS_E_PAYMENT_DRAFT) {
                    $topUpDraf = $isOld;
                }
                //$topUpDraf = $isOld;
            } else {
                $topUpDraf = new TopUp();
                $topUpDraf->userId = Yii::$app->user->id;
            }

            if ($_POST["paymentType"] == 'credit') {
                $topUpDraf->paymentMethod = 2; //
                $data["paymentType"] = "Credit card";
            } else if ($_POST["paymentType"] == 'bill') {
                $topUpDraf->paymentMethod = 1;
                $data["paymentType"] = "Bill payment";
            }
            //throw new \yii\base\Exception($_POST["checkout"]);
            if (isset($_POST["checkout"]) && $_POST["checkout"] != '') {
                $fromCheckout = 'yes';
                $topUpDraf->isFromCheckout = 1;
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
        $amount = '';
        if (isset($_POST["amount"]) && !empty($_POST["amount"])) {
            $amount = $_POST["amount"];
        }
        if (isset($_POST["currentAmount"]) && !empty($_POST["currentAmount"])) {
            $amount = $_POST["currentAmount"];
        }
        if (isset($_POST["otherAmount"]) && !empty($_POST["otherAmount"])) {
            $amount = $_POST["otherAmount"];
        }
        if ($amount != '') {
            $topUp = TopUp::find()->where("userId=" . Yii::$app->user->id . " and status=" . TopUp::TOPUP_STATUS_E_PAYMENT_DRAFT)->one();
            if (isset($topUp) && count($topUp) > 0) {
                $fromCheckout = 'no';
                if (isset($_POST["fromCheckout"]) && $_POST["fromCheckout"] != 'no') {
                    $fromCheckout = 'yes';
                }
                if (($topUp->topUpNo == NULL) && ($topUp->topUpNo == '')) {
                    $topUp->topUpNo = $this->topUpNo();
                }
                $topUp->money = $amount;
                $topUp->point = $amount; //รอ คิด
                $topUp->status = TopUp::TOPUP_STATUS_COMFIRM_PAYMENT;
                $topUp->updateDateTime = new \yii\db\Expression('NOW()');
                $topUp->save(false);
                if ($topUp->paymentMethod == 2) {//Payment Method เป็น การชำระด้วยบัตรเครดิต
                    return $this->redirect(['top-up/send-payment/' . $topUp->encodeParams(['userId' => $user->userId,
                                    'amount' => $amount,
                                    'fromCheckout' => $fromCheckout,
                                    'topUpNo' => $topUp->topUpNo,])
                    ]);
                } else if ($topUp->paymentMethod = 1) {//Payment Method เป็นการชำระด้วย Bill payment
                    return $this->redirect(['print-payment-form',
                                'userId' => $user->userId,
                                'amount' => $amount,
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

    public function checkAddress() {
        $address = \common\models\costfit\Address::find()->where("userId=" . Yii::$app->user->id . " and status=1 and isDefault=1")->one();
        if (!isset($address)) {
            return $this->redirect([Yii::$app->homeUrl . 'my-account/new-billing']);
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

    public function actionSendPayment($hash) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $userId = $params["userId"];
        $amount = $params["amount"];
        $fromCheckout = $params["fromCheckout"];
        $topUpNo = $params["topUpNo"];
        $isMcc = TRUE;
//        $model = \common\models\areawow\UserPayment::find()->where("userPaymentId=" . $_GET["id"])->one();
//        $package = \common\models\areawow\Package::find()->where("packageId = $model->packageId")->one();
        if (Yii::$app->params["ePaymentServerType"] == 1) {
            //URL Test
            $sendUrl = "https://uatkpgw.kasikornbank.com/pgpayment/payment.aspx";
            //URL Test
        } else {
            $devices = \common\helpers\GetBrowser::UserAgent();
            if ($devices != "mobile") {
                //Production URL
                $sendUrl = "https://rt05.kasikornbank.com/pgpayment/payment.aspx";
                ////Production URL
            } else {
                //Mobile URL
                $sendUrl = "https://rt05.kasikornbank.com/mobilepay/payment.aspx";
                ////Mobile URL
            }
        }


        // Standard Thai Bath
        if (!$isMcc):

        // For AreaWIW
//            $merchantId = "401001605782521";
//            $terminalId = "70352178";
        // For AreaWIW
        // Standard  Thai Bath
        else:
            //
            // MCC USD


            if (Yii::$app->params["ePaymentServerType"] == 1) {
                // For Test
                $merchantId = "402001605782521";
                $terminalId = "70352180";
                // For Test
                $md5Key = "SzabTAGU5fQYgHkVGU5f4re8pLw5423Q"; // Old Payment For AreaWOW
            } else {
                //For Cozxy
                $merchantId = "451005319527001";
                $terminalId = "74428381";
                //For Cozxy
                $md5Key = "QxMjcGFzc3MOIQ=vUT0TFN1UUrM0TlRl"; // For Cozxy
            }
        // MCC USD
        endif;
//        throw new \yii\base\Exception(str_replace(".", "", $package->price));
//        $amount = str_replace(".", "", $package->price);
//        $amount = str_replace(".", "", 1000);
        $amount = $amount * 100;
        if (Yii::$app->getRequest()->serverName == "localhost") {
            $url = "http://" . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . "top-up/result";
//        $url = "http://dev/areawow-frontend/user/payment-result";
            $resUrl = "http://" . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . "top-up/result";
        } else {
            $url = "http://" . Yii::$app->getRequest()->serverName . "/top-up/result";
//        $url = "http://dev/areawow-frontend/user/payment-result";
            $resUrl = "http://" . Yii::$app->getRequest()->serverName . "/top-up/result";
        }
        $cusIp = Yii::$app->getRequest()->getUserIP();
//        $description = "Buy Package " . $package->title;
        $description = "Buy TopUp " . $topUpNo;
//        $invoiceNo = $model->paymentNo;
        $invoiceNo = $topUpNo;
        $fillSpace = "Y";
        // throw new \yii\base\Exception(Yii::$app->params["ePaymentServerType"]);
        $checksum = md5($merchantId . $terminalId . $amount . $url . $resUrl . $cusIp . $description . $invoiceNo . $fillSpace . $md5Key);
        return $this->render("@app/views/e_payment/_k_payment", compact('sendUrl', 'merchantId', 'terminalId', 'checksum', 'amount', 'invoiceNo', 'description', 'url', 'resUrl', 'cusIp', 'fillSpace'));
    }

    public function actionPrintPaymentForm($userId, $amount, $fromCheckout) {
        $customerName = \common\models\costfit\Address::userName($userId);
        $customerTel = \common\models\costfit\Address::userTel($userId);
        $taxId = '0105553036789';
        $topUp = TopUp::find()->where("userId=" . Yii::$app->user->id . " and status=" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT)
                ->orderBy('updateDateTime DESC')
                ->one(); //status=2
        $allBank = \common\models\costfit\BankTransfer::find()->where("paymentMethodId=1")->all();
//        if (($topUp->topUpNo == NULL) && ($topUp->topUpNo == '')) {
//            $topUp->topUpNo = $this->topUpNo();
//        }
        $topUp->save(false);
        $tel = str_replace("-", "", $customerTel);
        $topUpCut = str_replace("/", "", $topUp->topUpNo);

        $amount1 = str_replace(",", "", number_format($amount, 2));
        $amount2 = str_replace(".", "", $amount1);
        $barCode = "|" . $taxId . "01%0D" . $topUpCut . "%0D" . $tel . "%0D" . $amount2;
        $data = "|" . $taxId . "01 " . $topUpCut . " " . $tel . " " . $amount2;
        //throw new \yii\base\Exception($amount);
        $customer = User::find()->where("userId=" . Yii::$app->user->id)->one();
        if (isset($customer)) {
            $Subject = "Confirm payment : #" . $topUp->topUpNo;
            $username = \common\models\costfit\Address::userName($customer->userId);
            $toMail = $customer->email;
            $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "top-up/history";
            $point = $topUp->point;
            $money = $topUp->money;
            $paymentMethod = $topUp->paymentMethod;
            $bank = \common\models\costfit\BankTransfer::find()->where("paymentMethodId=1")->all();
            $topUpEmail = \common\helpers\Email::topUpBillpayment($Subject, $username, $toMail, $url, $point, $money, $paymentMethod, $bank);
        }
        return $this->render('billpayment', [
                    'amount' => $amount,
                    'customerName' => $customerName,
                    'customerTel' => $customerTel,
                    'topUpNo' => $topUp->topUpNo,
                    'taxId' => $taxId,
                    'barCode' => $barCode,
                    'data' => $data,
                    'allBank' => $allBank
        ]);
    }

    public function actionPrintPaymentFormTopdf() {
        $header = FALSE;
        //$header = $this->renderPartial('header');
        $allBank = \common\models\costfit\BankTransfer::find()->where("paymentMethodId=1")->all();
        $content = $this->renderPartial('bill_form', [
            'amount' => $_GET["amount"],
            'customerName' => $_GET["customerName"],
            'customerTel' => $_GET["customerTel"],
            'topUpNo' => $_GET["topUpNo"],
            'taxId' => $_GET["taxId"],
            'barCode' => $_GET["barCode"],
            'data' => $_GET["data"],
            'allBank' => $allBank
        ]);
        $title = FALSE;
        $this->actionMpdfDocument($content, $header, $title);
    }

    public function actionResult() {
//        throw new \yii\base\Exception(print_r($_POST, true));
        $currentPoint = 0;
        if (isset($_POST["HOSTRESP"]) && $_POST["HOSTRESP"] == "00") {
//            throw new \yii\base\Exception(111);
            $topUpNo = substr($_POST["RETURNINV"], 3);
            $topUp = TopUp::find()->where("userId=" . Yii::$app->user->id . " AND topUpNo = '" . $topUpNo . "'" . " and status=" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT . " and paymentMethod=2")->one();
            if (isset($topUp) && count($topUp) > 0) {
                $topUp->status = TopUp::TOPUP_STATUS_E_PAYMENT_SUCCESS;
                $topUp->updateDateTime = new \yii\db\Expression('NOW()');
                $topUp->resultCode = $_POST["HOSTRESP"];
                $message = \common\helpers\KPayment::getResultMessage($_POST["HOSTRESP"]);
                $topUp->resultMessageEn = $message[0];
                $topUp->resultMessageTh = $message[1];
//                $topUp->topUpNo = $this->topUpNo();
                $topUp->save(false);
                $userPoint = UserPoint::find()->where("userId=" . Yii::$app->user->id)->one();
                if (isset($userPoint)) {
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
                if ($topUp->isFromCheckout) {// มาจากหน้า check out หรือไม่
                    $order = \common\models\costfit\Order::find()->where("userId='" . Yii::$app->user->id . "' and status='" . \common\models\costfit\Order::ORDER_STATUS_DRAFT . "'")->one();
                } else {
                    $order = '';
                }
                //sent Email
                $customer = User::find()->where("userId=" . Yii::$app->user->id)->one();
                if (isset($customer)) {
                    $Subject = "Top up successful : #" . $topUp->topUpNo;
                    $username = \common\models\costfit\Address::userName($customer->userId);
                    $toMail = $customer->email;
                    $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "top-up/history";
                    $point = $topUp->point;
                    $money = $topUp->money;
                    $paymentMethod = $topUp->paymentMethod;
                    $topUpEmail = \common\helpers\Email::topUpSuccess($Subject, $username, $toMail, $url, $point, $money, $paymentMethod);
                }

                //
                return $this->render('thank', [
                            'topUpId' => $topUp->topUpId,
                            'currentPoint' => $currentPoint,
                            'type' => $type,
                            'fromCheckout' => ($topUp->isFromCheckout == 1) ? "yes" : "no",
                            'order' => $order
                ]);
            } else {
                return $this->redirect(Yii::$app->homeUrl . 'top-up');
            }
        } else {
//            throw new \yii\base\Exception(222);
            $topUpNo = substr($_POST["RETURNINV"], 3);
//            $topUp = TopUp::find()->where("userId=" . Yii::$app->user->id . " and status=" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT)->one();
            $topUp = TopUp::find()->where("userId=" . Yii::$app->user->id . " AND topUpNo = '" . $topUpNo . "'" . " and status=" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT . " and paymentMethod=2")->one();
            if (isset($topUp) && !empty($topUp)) {
                $topUp->status = TopUp::TOPUP_STATUS_E_PAYMENT_DISCLAIM;
                $topUp->updateDateTime = new \yii\db\Expression('NOW()');
                $topUp->resultCode = $_POST["HOSTRESP"];
                $message = \common\helpers\KPayment::getResultMessage($_POST["HOSTRESP"]);
                $topUp->resultMessageEn = $message[0];
                $topUp->resultMessageTh = $message[1];
                $topUp->save(false);
                $type = 'fail';
                return $this->render('thank', [
                            'type' => $type,
                            'fromCheckout' => 'no'
                ]);
            }
        }
    }

    /* public function actionMail() {
      $topUp = TopUp::find()->where("userId=" . Yii::$app->user->id . " and status=" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT . " and paymentMethod=2")->one();
      $customer = User::find()->where("userId=" . Yii::$app->user->id)->one();
      if (isset($customer)) {
      $Subject = "Top up successful : #" . $topUp->topUpNo;
      $username = User::userName($customer->userId);
      $toMail = $customer->email;
      $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "top-up/history";
      $point = $topUp->point;
      $money = $topUp->money;
      $paymentMethod = $topUp->paymentMethod;
      // $topUpEmail = \common\helpers\Email::topUpSuccess($Subject, $username, $toMail, $url, $point, $money, $paymentMethod);
      }
      return $this->render('topupSuccess', [
      'Subject' => $Subject,
      'username' => $username,
      'toMail' => $toMail,
      'url' => $url,
      'point' => $point,
      'money' => $money,
      'paymentMethod' => $paymentMethod,
      ]);
      } */

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

    public function actionBillpay() {

        $k = base64_decode(base64_decode($_GET["epay"]));
        $topUpId = \common\models\ModelMaster::decodeParams($_GET["epay"]);
        $logo = \common\models\costfit\ContentGroup::find()->where("title='logoImageTop'")->one();
        $image = '';
        if (isset($logo)) {
            $image = $logo->image;
        }
        $header = $this->renderPartial('header', ['logo' => $image]);
        $title = FALSE;
        $topUp = TopUp::find()->where("topUpId=" . $topUpId)->one();

        if (isset($topUp)) {
            $customerName = \common\models\costfit\Address::userName($topUp->userId);
            if ($customerName != '') {
                $address = User::userAddressText(User::supplierDetail($topUp->userId)->addressId);
            } else {
                $address = '';
            }
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
        $topUps = TopUp::find()->where("status >1 and userId=" . Yii::$app->user->id)->orderBy('updateDateTime DESC')->all();
        $userPoint = UserPoint::find()->where("userId=" . Yii::$app->user->id)->one();
        $currentPoint = 0;
        if (isset($userPoint) && count($userPoint) > 0) {
            $currentPoint = $userPoint->currentPoint;
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
        ]);
        if (isset($_POST["topUpId"])) {

            $topUpId = $_POST["topUpId"];
            $uploadTo = TopUp::find()->where("topUpId=$topUpId")->one();
            $imageObj = \yii\web\UploadedFile::getInstanceByName("slipUpload[image]");
            if (isset($imageObj) && !empty($imageObj)) {
                $folderName = "slip";
                $file = $imageObj->name;
                $filenameArray = explode('.', $file);
                $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile = $urlFolder . $fileName;
                $uploadTo->image = 'images/' . $folderName . "/" . $fileName;
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777);
                }
                $imageObj->saveAs($urlFile);
                $uploadTo->save(false);
                //   }

                return $this->redirect(['history']);
            }
        } else {
            return $this->render('history', [
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'topUps' => $topUps,
                        'currentPoint' => $currentPoint
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
