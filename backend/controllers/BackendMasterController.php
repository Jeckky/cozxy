<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\controllers\MasterController;
use common\models\areawow\master;
use common\models\areawow;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;
use common\helpers\Notifications;

/**
 * Site controller
 */
class BackendMasterController extends MasterController {

    public $breadcrumbs = [];
    public $layout = '/content';

    public function init() {
        parent::init(); // TODO: Change the autogenerated stub
        //$cookies = Yii::$app->request->cookies;
        // $token = $this->getToken();

        if (!Yii::$app->user->isGuest) {
            // Login in system //
            /* $dataProvider = new ActiveDataProvider([
              'query' => \common\models\costfit\Menu::find(),
              'pagination' => [
              'pageSize' => 550,
              ],
              ]); */
            $dataProvider = \common\models\costfit\Menu::find()->all();
            $firstname = Yii::$app->user->identity->firstname;
            $type = Yii::$app->user->identity->type;
            $user_group_Id = Yii::$app->user->identity->user_group_Id;
            $this->view->params['listDataProviderMenu']['menuBackend'] = $dataProvider;
            $this->view->params['listDataProviderNotifications']['menuNotifications'] = Notifications::NotificationsLogin();


            //echo 'test menu backend isGuest';
        } else {
            //echo 'test menu backend  Guest';
            //$this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/auth');
            //$this->redirect(Yii::$app->homeUrl . 'auth');
            //return $this->redirect(Yii::$app->homeUrl . 'auth');
            //return $this->render('@backend/modules/auth/views/auth/index');
        }

        //$this->view->params['cart'] = \common\models\costfit\Order::findCartArray();

        if ((!Yii::$app->user->isGuest) && $this->id == "profile") {
            $dataProvider_picking_point = '';
        }
    }

    public function writeToFile($fileName, $string, $mode = 'w+') {
        $handle = fopen($fileName, $mode);
        fwrite($handle, $string);
        fclose($handle);
    }

    public function saveModelLang($mainModel, $langModel) {
        $result = [];
        $langClassName = (new \ReflectionClass($langModel))->getShortName();
        $mainModelClassName = (new \ReflectionClass($mainModel))->getShortName();
        $oldModel = $langModel;
        $result["status"] = FALSE;
        $result["errorMessage"] = "Can't not find language model";
//        throw new \yii\base\Exception(print_r($_POST[$langClassName], true));
        if (isset($_POST[$langClassName])) {
            foreach ($_POST[$langClassName] as $index => $v) {
                $newModel = $langModel->find()->where("languageId =" . $_POST[$langClassName][$index]["languageId"] . " AND " . lcfirst($mainModelClassName) . "Id =" . $_POST[$langClassName][$index][lcfirst($mainModelClassName) . "Id"])->one();

                if (!isset($newModel)) {

                    $langModel = new $oldModel();
                    $langModel->createDateTime = new \yii\db\Expression('NOW()');
                } else {
//                    throw new \yii\base\Exception(222);
                    $langModel = $newModel;
                }

                $langModel->attributes = $_POST[$langClassName][$index];
//                throw new \yii\base\Exception(print_r($langModel->attributes, true));
//                $langModel->{lcfirst($mainModelClassName) . "Id"} = $_POST[$langClassName][$index][$mainModelClassName . "Id"];

                foreach ($langModel->getAttributes() as $k => $attri) {
//                $columns[$n]['name'] = $langModel->getTableSchema()->columns[$k]->name;
//                $columns[$n]['type'] = $langModel->getTableSchema()->columns[$k]->type;
//                $columns[$n]['size'] = $langModel->getTableSchema()->columns[$k]->size;
                    if ($langModel->getTableSchema()->columns[$k]->size == 255) {

                        $fileObj = \yii\web\UploadedFile::getInstanceByName($langClassName . "[" . $index . "][" . $langModel->getTableSchema()->columns[$k]->name . "]");
                        if (isset($fileObj) && !empty($fileObj)) {

                            $folderName = lcfirst($langClassName);
                            $file = $fileObj->name;
                            $filenameArray = explode('.', $file);
                            $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                            $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                            $urlFile = $urlFolder . $fileName;
                            $langModel->{$langModel->getTableSchema()->columns[$k]->name} = '/' . 'images/' . $folderName . "/" . $fileName;
                            if (!file_exists($urlFolder)) {
//                                throw new \yii\base\Exception($urlFolder);
                                mkdir($urlFolder, 0777);
                            }
                            //                            throw new \yii\base\Exception(print_r($langModel->attributes, true));
                        } else {
                            if (isset($_POST[$langClassName][$index][$langModel->getTableSchema()->columns[$k]->name . "Old"]) && !empty($_POST[$langClassName][$index][$langModel->getTableSchema()->columns[$k]->name . "Old"])) {
                                $langModel->{$langModel->getTableSchema()->columns[$k]->name} = $_POST[$langClassName][$index][$langModel->getTableSchema()->columns[$k]->name . "Old"];
                            } else {
                                $langModel->{$langModel->getTableSchema()->columns[$k]->name} = null;
                            }
                        }
                    }
                }
                if ($langModel->save()) {
                    if (isset($fileObj) && !$fileObj->saveAs($urlFile)) {
//                        throw new \yii\base\Exception(111);
                        $result["status"] = FALSE;
                        $result["errorMessage"] = "Can't Save Image";
                        return FALSE;
                    } else {
                        $result["status"] = TRUE;
                    }
                }
//            else {
//                    $result["status"] = FALSE;
//                    $result["errorMessage"] = "Can't Save Lang";
//                }
            }
        }
        return $result;
    }

    public static function dateThai($date, $format, $showTime = false) {
        // Full month array
        $monthFormat1 = array(
            "01" => "มกราคม",
            "02" => "กุมภาพันธ์",
            "03" => "มีนาคม",
            "04" => "เมษายน",
            "05" => "พฤษภาคม",
            "06" => "มิถุนายน",
            "07" => "กรกฎาคม",
            "08" => "สิงหาคม",
            "09" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม");

        // Quick month array
        $monthFormat2 = array(
            "01" => "ม.ค.",
            "02" => "ก.พ.",
            "03" => "มี.ค.",
            "04" => "เม.ย.",
            "05" => "พ.ค.",
            "06" => "มิ.ย.",
            "07" => "ก.ค.",
            "08" => "ส.ค.",
            "09" => "ก.ย.",
            "10" => "ต.ค.",
            "11" => "พ.ย.",
            "12" => "ธ.ค.");

        $monthFormat3 = array(
            "01" => "01",
            "02" => "02",
            "03" => "03",
            "04" => "04",
            "05" => "05",
            "06" => "06",
            "07" => "07",
            "08" => "08",
            "09" => "09",
            "10" => "10",
            "11" => "11",
            "12" => "12");

        $monthFormat4 = array(
            "01" => "JAN",
            "02" => "FEB",
            "03" => "MAR",
            "04" => "APR",
            "05" => "MAY",
            "06" => "JUN",
            "07" => "JUL",
            "08" => "AUG",
            "09" => "SEP",
            "10" => "OCT",
            "11" => "NOV",
            "12" => "DEC");

        if ($date == '0000-00-00' || $date == '0000-00-00 00:00:00') {
            return "-";
        }
        $isDateTime = explode(' ', $date);
        if (count($isDateTime) == 2) {
            $timeStr = $isDateTime[1];
            $d = explode('-', $isDateTime[0]);
        } else {
            $d = explode('-', $date);
        }

        $monthFormat = null;
        if ($format == 1) {
            $monthFormat = $monthFormat1[$d[1]];
            $strReturn = $d[2] . ' ' . $monthFormat . ' ' . ($d[0] + 543);
        } else if ($format == 2) {
            $monthFormat = $monthFormat2[$d[1]];
            $strReturn = $d[2] . ' ' . $monthFormat . ' ' . ($d[0] + 543);
        } else if ($format == 3) {
            $monthFormat = $monthFormat3[$d[1]];
            $strReturn = $d[2] . '/' . $monthFormat . '/' . ($d[0] + 543);
        } else if ($format == 4) {
            $monthFormat = $monthFormat4[$d[1]];
            $strReturn = $monthFormat . '/' . ($d[0] + 543);
            return $strReturn;
        }

        //return $d[2].' '.(($format=1) ? $monthFormat1[$d[1]] : $monthFormat2[$d[1]]).' '.($d[0]+543);
        if (isset($timeStr) && $showTime) {
            $strReturn = $strReturn . " " . $timeStr;
        }

        return $strReturn;
    }

    // Privacy statement output demo
    public function actionMpdfDocument($content, $setHeader = FALSE, $setFooter = FALSE, $marginTop = FALSE) {
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
            'marginTop' => isset($marginTop) ? $marginTop : 35,
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

    public function actionChildStatesAddress() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = ($_POST['depdrop_parents']);
            if ($parents != null) {
                $cat_id = $parents[0];
                $param1 = null;
                $param2 = null;
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    $param1 = $params[0]; // get the value of input-type-1
                    $param2 = $params[1]; // get the value of input-type-2
                }
                $list = \common\models\dbworld\States::find()->andWhere(['countryId' => $cat_id])->asArray()->all();
                $selected = null;
                if ($cat_id != null && count($list) > 0) {
                    $selected = '';
                    foreach ($list as $i => $account) {
                        $out[] = ['id' => $account['stateId'], 'name' => $account['localName']];
                        $param1 = ($param1 != '') ? $param1 : $account['stateId'];
                        if ($i == 0) {
                            $selected = $param1; //$account['stateId'];
                        } else {
                            $selected = $param1;
                        }
                    }

                    // Shows how you can preselect a value
                    echo \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected]);
                    return;
                }
            }

            //echo 'no';
        }
        echo \yii\helpers\Json::encode(['output' => '', 'selected..' => '']);
    }

    public function actionChildAmphurAddress() {
        $out = [];

        if (isset($_POST['depdrop_parents'])) {
            $parents = ($_POST['depdrop_parents']);
            //print_r($parents);
            if ($parents != null) {
                $cat_id = $parents[0];
                $param1 = null;
                $param2 = null;
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    $param1 = $params[0]; // get the value of input-type-1
                    $param2 = $params[1]; // get the value of input-type-2
                }

                $list = \common\models\dbworld\Cities::find()->andWhere(['stateId' => $cat_id])->asArray()->all();
                $selected = null;
                if ($cat_id != null && count($list) > 0) {
                    $selected = '';
                    foreach ($list as $i => $account) {
                        $out[] = ['id' => $account['cityId'], 'name' => $account['localName']];
                        $param1 = ($param1 != '') ? $param1 : $account['cityId'];
                        if ($i == 0) {
                            $selected = $param1; //$account['stateId'];
                        } else {
                            $selected = $param1;
                        }
                    }

                    // Shows how you can preselect a value
                    echo \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected]);
                    return;
                }
            }

            //echo 'no';
        }

        echo \yii\helpers\Json::encode(['output' => '', 'selected..' => '']);
    }

    public function actionChildDistrictAddress() {
        $out = [];

        if (isset($_POST['depdrop_parents'])) {
            $parents = ($_POST['depdrop_parents']);
            if ($parents != null) {
                $cat_id = $parents[0];
                $param1 = null;
                $param2 = null;
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    $param1 = $params[0]; // get the value of input-type-1
                    $param2 = $params[1]; // get the value of input-type-2
                }

                $list = \common\models\dbworld\District::find()->andWhere(['cityId' => $cat_id])->asArray()->all();
                $selected = null;
                if ($cat_id != null && count($list) > 0) {
                    $selected = '';
                    foreach ($list as $i => $account) {
                        $out[] = ['id' => $account['districtId'], 'name' => $account['localName']];
                        $param1 = ($param1 != '') ? $param1 : $account['districtId'];
                        if ($i == 0) {
                            $selected = $param1; //$account['stateId'];
                        } else {
                            $selected = $param1;
                        }
                    }

                    // Shows how you can preselect a value
                    echo \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected]);
                    return;
                }
            }

            //echo 'no';
        }

        echo \yii\helpers\Json::encode(['output' => '', 'selected..' => '']);
    }

}
