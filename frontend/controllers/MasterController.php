<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use common\controllers\MasterController as MasterCommonController;

/**
 * Site controller
 */
class MasterController extends MasterCommonController {

    public $layout = '/content';
    public $title = 'Title';
    public $subTitle = 'Sub Title';
    public $subSubTitle = 'Sub Sub Title';

    public function getTitle() {
        return $this->title;
    }

    public function getSubTitle() {
        return $this->subTitle;
    }

    public function getSubSubTitle() {
        return $this->subSubTitle;
    }

    public function init() {
        parent::init(); // TODO: Change the autogenerated stub
        $cookies = Yii::$app->request->cookies;
        $token = $this->getToken();
        if (!Yii::$app->user->isGuest) {

            if (isset($cookies['orderToken'])) {
                $order = \common\models\costfit\Order::find()->where("token ='" . $token . "' AND userId is null AND status=" . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
                if (isset($order)) {
                    \common\models\costfit\search\Order::mergeDraftOrder();
                }
            }
        } else {
            if (isset($cookies['orderToken'])) {
                $order = \common\models\costfit\Order::find()->where("token ='" . $token . "' AND status=" . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
                if (isset($order) && isset($order->userId)) {
                    $this->getView()->registerJs("$('#confirmCartModal').modal('show');", \yii\web\View::POS_READY);
                }
            }
        }

        $this->view->params['cart'] = \common\models\costfit\Order::findCartArray();

        // - SHIPPING = 2; // ที่อยู่จัดส่งสินค้า
        if ((!Yii::$app->user->isGuest) && $this->id == "profile") {
            $dataProvider_shipping = new \yii\data\ActiveDataProvider([
                'query' => \common\models\costfit\Address::find()->where("userId ='" . Yii::$app->user->id . "' and type = 2 ")->orderBy('addressId DESC'),
                'pagination' => false,
            ]);
            // $this->view->params['cart']
            // - BILLING = 1; // ที่อยู่จัดส่งเอกสาร
            $dataProvider_billing = new \yii\data\ActiveDataProvider([
                'query' => \common\models\costfit\Address::find()->where("userId ='" . Yii::$app->user->id . "' and type = 1 ")->orderBy('addressId DESC'),
                'pagination' => false,
            ]);
            $this->view->params['listDataProvider']['shipping'] = $dataProvider_shipping;
            $this->view->params['listDataProvider']['billing'] = $dataProvider_billing;
        }
    }

    public function getToken() {
        $cookies = Yii::$app->request->cookies;
        if (isset($cookies['orderToken'])) {
            return $cookies['orderToken']->value;
        } else {
            $this->generateNewToken();
            return $cookies['orderToken']->value;
        }
    }

    public function generateNewToken() {
//        $cookies = Yii::$app->request->cookies;
//        if (!isset($cookies['orderToken'])) {
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'orderToken',
            'value' => Yii::$app->security->generateRandomString(),
        ]));
//        }
    }

    public function actionDynamicState() {
        $dataArray = ArrayHelper::map(\common\models\dbWorld\States::find()->all(), 'stateId', 'stateName');
        echo $this->renderPartial('ddl', [
            'dataArray' => $dataArray,
            'prompt' => '-- Select State --',
            'name' => 'Search[stateId]',
            'onChange' => 'dynamicCity(this)'
        ]);
    }

    public function actionDynamicCity() {
        $dataArray = ArrayHelper::map(\common\models\dbWorld\Cities::find()->where("stateId = " . $_GET["stateId"])->all(), 'cityId', 'cityName');
        echo $this->renderPartial('ddl', [
            'dataArray' => $dataArray,
            'prompt' => '-- Select City --',
            'name' => 'Search[cityId]',
            'onChange' => 'dynamicDistrict(this)'
        ]);
    }

    public function actionDynamicDistrict() {
        $dataArray = ArrayHelper::map(\common\models\dbWorld\District::find()->where("cityId = " . $_GET["cityId"])->all(), 'districtId', 'localName');
        echo $this->renderPartial('ddl', [
            'dataArray' => $dataArray,
            'prompt' => '-- Select District --',
            'name' => 'Search[disctictId]'
        ]);
    }

    // CONTROLLER 15/07/2016 Create By Taninut
    public function actionChildStates() {
        $out = [];
        //echo $_POST['depdrop_parents'];
        //exit();
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = \common\models\dbworld\States::find()->andWhere(['countryId' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['stateId'], 'name' => $account['stateName']];
                    if ($i == 0) {
                        $selected = $account['stateId'];
                    }
                }
                // Shows how you can preselect a value
                echo \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output' => '', 'selected..' => '']);
    }

    // CONTROLLER 15/07/2016 Create By Taninut
    public function actionChildAmphur() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = \common\models\dbworld\Cities::find()->andWhere(['stateId' => $id])->asArray()->all();

            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['cityId'], 'name' => $account['cityName']];
                    if ($i == 0) {
                        $selected = $account['cityId'];
                    }
                }
                // Shows how you can preselect a value
                echo \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output' => '', 'selected..' => '']);
    }

    // CONTROLLER 15/07/2016 Create By Taninut
    public function actionChildDistrict() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = \common\models\dbworld\District::find()->andWhere(['cityId' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['districtId'], 'name' => $account['localName']];
                    if ($i == 0) {
                        $selected = $account['districtId'];
                    }
                }

                // Shows how you can preselect a value
                echo \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
            //echo 'no';
        }
        echo \yii\helpers\Json::encode(['output' => '', 'selected..' => '']);
    }

    public function iSLogin() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
    }

    public function dateThai($date, $format, $showTime = false) {
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
        } else {
            $monthFormat = $monthFormat4[$d[1]];
            $strReturn = $monthFormat . ' ' . $d[2] . ' ' . ($d[0]);
            return $strReturn;
        }

        //return $d[2].' '.(($format=1) ? $monthFormat1[$d[1]] : $monthFormat2[$d[1]]).' '.($d[0]+543);
        if (isset($timeStr) && $showTime) {
            $strReturn = $strReturn . " " . $timeStr;
        }

        return $strReturn;
    }

}
