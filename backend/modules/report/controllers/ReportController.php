<?php

namespace backend\modules\report\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;
use kartik\mpdf\Pdf;
use yii\helpers\Html;
use yii\jui\DatePicker;

class ReportController extends ReportMasterController {

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
        ];
    }

    public function actionIndex() {
        if (isset($_GET['fromDate']) && !empty($_GET['fromDate'])) {
            if (isset($_GET['toDate']) && !empty($_GET['toDate'])) {
                // throw new \yii\base\Exception($_GET['toDate']);
                $model = Order::find()->where("date(paymentDateTime)>='" . $_GET['fromDate'] . "' and date(paymentDateTime)<='" . $_GET['toDate'] . "' and status>=5 order by paymentDateTime DESC")->all();
                $query = Order::find()->where("date(paymentDateTime)>='" . $_GET['fromDate'] . "' and date(paymentDateTime)<='" . $_GET['toDate'] . "' and status>=5")->orderBy("paymentDateTime DESC");
            } else {
                $model = Order::find()->where("date(paymentDateTime)>='" . $_GET['fromDate'] . "' and status>=5 order by paymentDateTime DESC")->all();
                $query = Order::find()->where("date(paymentDateTime)>='" . $_GET['fromDate'] . "' and status>=5")->orderBy("paymentDateTime DESC");
            }
        } else {
            if (isset($_GET['toDate']) && !empty($_GET['toDate'])) {
                $model = Order::find()->where("date(paymentDateTime)<='" . $_GET['toDate'] . "' and status>=5 order by paymentDateTime DESC")->all();
                $query = Order::find()->where("date(paymentDateTime)<='" . $_GET['toDate'] . "' and status>=5")->orderBy("paymentDateTime DESC");
            } else {
                $model = Order::find()->where("status>=5 order by paymentDateTime DESC")->all();
                $query = Order::find()->where("status>=5")->orderBy("paymentDateTime DESC");
            }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', [
                    'model' => $model,
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionExport() {
        $res = [];
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $userId = Yii::$app->user->identity->userId;
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $now = date('Y-m-d');
        //throw new \yii\base\Exception($now);
        if ($fromDate != '') {
            if ($toDate != '') {
                $model = Order::find()->where("date(paymentDateTime)>='" . $fromDate . "' and date(paymentDateTime)<='" . $toDate . "' and status>=" . Order::ORDER_STATUS_E_PAYMENT_SUCCESS . " order by paymentDateTime DESC")->all();
                $fileName = $userId . '_' . $fromDate . "to" . $toDate;
            } else {
                $model = Order::find()->where("date(paymentDateTime)>='" . $fromDate . "' and status>=" . Order::ORDER_STATUS_E_PAYMENT_SUCCESS . " order by paymentDateTime DESC")->all();
                $fileName = $userId . '_' . $fromDate . "to" . $now;
            }
        } else {
            if ($toDate != '') {
                $model = Order::find()->where("date(paymentDateTime)<='" . $toDate . "' and status>=" . Order::ORDER_STATUS_E_PAYMENT_SUCCESS . " order by paymentDateTime DESC")->all();

                $fileName = $userId . '_' . $now . "to" . $toDate;
            } else {
                $model = Order::find()->where("status>=" . Order::ORDER_STATUS_E_PAYMENT_SUCCESS . " order by paymentDateTime DESC")->all();
                $fileName = $userId . '_' . $now;
            }
        }

        if (isset($model) && !empty($model)) {
            $data = "";
            $file = fopen('192.168.100.20' . $baseUrl . "/textfile/" . $fileName . ".txt", "w+") or die("Unable to open file!");

            foreach ($model as $report):
                $orderItem = \common\models\costfit\OrderItem::find()->where("orderId=" . $report->orderId)->all();
                foreach ($orderItem as $item):
                    $supplier = \common\models\costfit\ProductSuppliers::supplier($item->productSuppId);
                    $company = \common\models\costfit\Address::CompanyName($supplier);
                    $product = \common\models\costfit\ProductSuppliers::productSupplierName($item->productSuppId)->title;
                    $price = \common\models\costfit\ProductSuppliers::productPriceSupplier($item->productSuppId);
                    $data .= $report->orderNo . "|" . $company . "|" . $product . "|" . $item->quantity . "|" . $price . "|" . number_format($item->quantity * $price, 2) . "|\r\n";
                endforeach;
            endforeach;
            fwrite($file, $data);
            fclose($file);
        }


        $files = '192.168.100.20' . $baseUrl . "/textfile/" . $fileName . ".txt";
        if (file_exists($files)) {
            $res["status"] = true;
            $res["filename"] = $fileName . ".txt";
            $res["file"] = $files;
        } else {
            $res["status"] = FALSE;
        }
        //Yii::$app->response->sendFile($files);
        /* if (file_exists($files)) {
          Yii::$app->response->sendFile($files);
          //$res["status"] = TRUE;
          $res["filename"] = $fileName . ".txt";
          } else {
          $res["status"] = FALSE;
          } */
        //unlink($files);
        return \yii\helpers\Json::encode($res);
    }

    public function actionDownload($files) {
        Yii::$app->response->sendFile($files);
        unlink($files);
    }

    public function actionCreate() {
        return $this->render('create');
    }

    public function actionDelete() {
        return $this->render('delete');
    }

}
