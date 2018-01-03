<?php

namespace backend\modules\topup\controllers;

use Yii;
use common\models\costfit\TopUp;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\UserPoint;
use common\models\costfit\User;
use common\helpers\IntToBath;
use common\helpers\CozxyUnity;

/**
 * TopupController implements the CRUD actions for Topup model.
 */
class TopupController extends TopupMasterController {

    /**
     * Lists all Topup models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => TopUp::find()
                    ->where("status=" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT . " and paymentMethod=1")
        ]);
        $readyData = TopUp::find()->where("status=" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT . " and paymentMethod=1 and image!=''")->all();
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

                    define('CSV_PATH', $uploadPath);
                    $csv_file = CSV_PATH . '/' . $newFileName;
                    $fcsv = fopen($csv_file, "r");
                    if ($fcsv) {
                        $r = 0;
                        $data = [];
                        while (($objArr = fgetcsv($fcsv, 1000, ",")) !== FALSE) {
                            //$data[$r] = $objArr[0];
                            if ($r != 0) {//first record is title//////////////////////////wait forbank
                                $data[$r][1] = $objArr[0];
                                $data[$r][1] = $objArr[1];
                                $data[$r][2] = $objArr[2];
                                $data[$r][3] = $objArr[3];
                                $data[$r][4] = $objArr[4];
                                $data[$r][5] = $objArr[5];
                            }
                            $r++;
                        }
                        fclose($fcsv);
                        if (count($data) > 0) {
                            $dataChange = $this->updateBillpayment($data);
                            if ($dataChange != '') {
                                $dataProviderChange = new ActiveDataProvider([
                                    'query' => TopUp::find()->where("topUpId in($dataChange)")
                                ]);
                                $topUps = 'yes';
                            } else {
                                $topUps = '';
                            }
                            return $this->render('index', [
                                        'dataProviderChange' => $dataProviderChange,
                                        'dataProvider' => $dataProvider,
                                        'dataChange' => $topUps,
                                        'readyData' => $readyData
                            ]);
                        }
                    }
                }

                return $this->render('index', [
                            'dataProvider' => $dataProvider,
                            'data' => $data,
                            'readyData' => $readyData
                ]);
            } else {
                return $this->render('index', [
                            'dataProvider' => $dataProvider,
                            'readyData' => $readyData
                ]);
            }
        } else {
            return $this->render('index', [
                        'dataProvider' => $dataProvider,
                        'readyData' => $readyData
            ]);
        }
    }

    public function actionAcceptBillpayment($id) {
        $topUp = TopUp::find()->where("topUpId=" . $id)->one();
        if (isset($topUp)) {
            $topUp->status = TopUp::TOPUP_STATUS_E_PAYMENT_SUCCESS;
            $topUp->updateDateTime = new \yii\db\Expression('NOW()');
            $topUp->save(false);
            $topUp = TopUp::find()->where("topUpId=" . $id)->one();
            $userPoint = UserPoint::find()->where("userId=" . $topUp->userId)->one();
            if (isset($userPoint)) {
                $userPoint->currentPoint += $topUp->point;
                $userPoint->totalPoint += $topUp->point;
                $userPoint->totalMoney += $topUp->money;
                $userPoint->updateDateTime = new \yii\db\Expression('NOW()');
                $userPoint->save(false);
            } else {
                $userPoint = new UserPoint();
                $userPoint->userId = $topUp->userId;
                $userPoint->currentPoint = $topUp->point;
                $userPoint->totalPoint += $topUp->point;
                $userPoint->totalMoney = $topUp->money;
                $userPoint->status = 1;
                $userPoint->createDateTime = new \yii\db\Expression('NOW()');
                $userPoint->updateDateTime = new \yii\db\Expression('NOW()');
                $userPoint->save(false);
            }
            $customer = User::find()->where("userId=" . $topUp->userId)->one();
            if (isset($customer)) {
                $Subject = "Top up successful : #" . $topUp->topUpNo;
                $username = User::userName($customer->userId);
                $toMail = $customer->email;
                $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "top-up/history";
                $point = $topUp->point;
                $money = $topUp->money;
                $paymentMethod = $topUp->paymentMethod;
                $topUpEmail = \common\helpers\Email::topUpSuccess($Subject, $username, $toMail, $url, $point, $money, $paymentMethod);
            }
        }
        return $this->redirect(['index']);
    }

    public function actionNotAcceptBillpayment($id) {
        $topUp = TopUp::find()->where("topUpId=" . $id)->one();
        if (isset($topUp)) {
            $topUp->status = TopUp::TOPUP_STATUS_E_PAYMENT_DISCLAIM;
            $topUp->updateDateTime = new \yii\db\Expression('NOW()');
            $topUp->save(false);
        }
        return $this->redirect(['index']);
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

    public function updateBillpayment($data) {
        /* foreach ($data as $record)://รอไฟล์ จากธนาคาร
          foreach ($record as $info):

          endforeach;
          endforeach; */
        $changeId = '';
        $topUp = TopUp::find()
                ->where("status=" . \common\models\costfit\TopUp::TOPUP_STATUS_COMFIRM_PAYMENT . " and paymentMethod=1")//
                ->all();
        if (isset($topUp) && count($topUp) > 0) {
            foreach ($topUp as $topup):
                $topup->status = TopUp::TOPUP_STATUS_E_PAYMENT_SUCCESS;
                $topup->save(false);
                $userPoint = UserPoint::find()->where("userId=" . $topup->userId)->one();
                if (isset($userPoint)) {
                    $userPoint->currentPoint += $topup->point;
                    $userPoint->totalPoint += $topup->point;
                    $userPoint->totalMoney += $topup->money;
                    $userPoint->updateDateTime = new \yii\db\Expression('NOW()');
                    $userPoint->save(false);
                } else {
                    $userPoint = new UserPoint();
                    $userPoint->userId = $topup->userId;
                    $userPoint->currentPoint = $topup->point;
                    $userPoint->totalPoint += $topup->point;
                    $userPoint->totalMoney = $topup->money;
                    $userPoint->status = 1;
                    $userPoint->createDateTime = new \yii\db\Expression('NOW()');
                    $userPoint->updateDateTime = new \yii\db\Expression('NOW()');
                    $userPoint->save(false);
                }
                $customer = User::find()->where("userId=" . $topup->userId)->one();
                if (isset($customer)) {
                    $Subject = "Top up successful : #" . $topup->topUpNo;
                    $username = User::userName($customer->userId);
                    $toMail = $customer->email;
                    $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "top-up/history";
                    $point = $topup->point;
                    $money = $topup->money;
                    $paymentMethod = $topup->paymentMethod;
                    $topUpEmail = \common\helpers\Email::topUpSuccess($Subject, $username, $toMail, $url, $point, $money, $paymentMethod);
                }
                $changeId = $changeId . $topup->topUpId . ',';
            endforeach;
        }
        if ($changeId != '') {
            $changeId = substr($changeId, 0, -1);
        }
        return $changeId;
    }

    public function actionAllBillPayment() {
        $dataProvider = new ActiveDataProvider([
            'query' => TopUp::find()
                    ->where("status>" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT)->orderBy('updateDateTime DESC')
        ]);
        $readyData = TopUp::find()->where("status>" . TopUp::TOPUP_STATUS_COMFIRM_PAYMENT)->all();
        return $this->render('alltopup', [
                    'dataProvider' => $dataProvider,
                    'readyData' => $readyData
        ]);
    }

    public function actionBillPay() {
        $topUpId = $_GET["epay"];
        $logo = \common\models\costfit\ContentGroup::find()->where("title='logoImageTop'")->one();
        $image = '';
        if (isset($logo)) {
            $image = $logo->image;
        }
        $header = $this->renderPartial('header', ['logo' => $image]);
        $title = FALSE;
        $topUp = TopUp::find()->where("topUpId=" . $topUpId)->one();

        if (isset($topUp)) {
            $customerName = User::userName($topUp->userId);
            //throw new \yii\base\Exception($topUp->userId);
            $address = User::userAddressText(User::userDetail($topUp->userId)->addressId, false);
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
        //$header = '';
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
