<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use common\helpers\CozxyUnity;
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
        $token = \common\helpers\Token::getToken();

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
            $dataProvider_shipping_bk = new \yii\data\ActiveDataProvider([
                'query' => \common\models\costfit\Address::find()->where("userId ='" . Yii::$app->user->id . "' and type = 3 ")->orderBy('addressId DESC'),
                'pagination' => false,
            ]);
            $dataProvider_picking_point = new \yii\data\ActiveDataProvider([
                'query' => \common\models\costfit\PickingPoint::find()->where("userId ='" . Yii::$app->user->id . "' and type = 1 ")->orderBy('pickingId DESC'),
                'pagination' => false,
            ]);
            // $this->view->params['cart']
            // - BILLING = 1; // ที่อยู่จัดส่งเอกสาร
            //echo Yii::$app->user->id;
            $dataProvider_billing = new \yii\data\ActiveDataProvider([
                'query' => \common\models\costfit\Address::find()->where("userId ='" . Yii::$app->user->id . "' and type = 1 ")->orderBy('addressId DESC'),
                'pagination' => false,
            ]);
            $user_point = \common\models\costfit\UserPoint::find()->where("userId='" . Yii::$app->user->id . "'")->one();
            if (isset($user_point) && !empty($user_point)) {
                $this->view->params['currentPoint'] = $user_point->currentPoint;
            } else {
                $this->view->params['currentPoint'] = 0;
            }
            $device = \common\models\costfit\UserVisit::find()->where('userId=' . Yii::$app->user->id)->orderBy('visitId desc')->limit(1)->one();
            if (count($device) > 0) {
                $this->view->params['listDevice']['device'] = $device;
            } else {
                $this->view->params['listDevice']['device'] = NULL;
            }
            $this->view->params['listDataProvider']['shipping'] = $dataProvider_picking_point;
            $this->view->params['listDataProvider']['billing'] = $dataProvider_billing;
        }
        if ((!Yii::$app->user->isGuest) && $this->id == "reviews") {
            $dataProvider_shipping_bk = new \yii\data\ActiveDataProvider([
                'query' => \common\models\costfit\Address::find()->where("userId ='" . Yii::$app->user->id . "' and type = 3 ")->orderBy('addressId DESC'),
                'pagination' => false,
            ]);
            $dataProvider_picking_point = new \yii\data\ActiveDataProvider([
                'query' => \common\models\costfit\PickingPoint::find()->where("userId ='" . Yii::$app->user->id . "' and type = 1 ")->orderBy('pickingId DESC'),
                'pagination' => false,
            ]);
            // $this->view->params['cart']
            // - BILLING = 1; // ที่อยู่จัดส่งเอกสาร
            //echo Yii::$app->user->id;
            $dataProvider_billing = new \yii\data\ActiveDataProvider([
                'query' => \common\models\costfit\Address::find()->where("userId ='" . Yii::$app->user->id . "' and type = 1 ")->orderBy('addressId DESC'),
                'pagination' => false,
            ]);
            $user_point = \common\models\costfit\UserPoint::find()->where("userId='" . Yii::$app->user->id . "'")->one();
            if (isset($user_point) && !empty($user_point)) {
                $this->view->params['currentPoint'] = $user_point->currentPoint;
            } else {
                $this->view->params['currentPoint'] = 0;
            }
            $device = \common\models\costfit\UserVisit::find()->where('userId=' . Yii::$app->user->id)->orderBy('visitId desc')->limit(1)->one();
            if (count($device) > 0) {
                $this->view->params['listDevice']['device'] = $device;
            } else {
                $this->view->params['listDevice']['device'] = NULL;
            }
            $this->view->params['listDataProvider']['shipping'] = $dataProvider_picking_point;
            $this->view->params['listDataProvider']['billing'] = $dataProvider_billing;
        }
        if ($this->id == 'products') {
            $uri = explode('/', $_SERVER["REQUEST_URI"]);
            //echo 'REQUEST_URI = ' . $uri[2];
            //echo $_SERVER['SERVER_ADDR'];
            if ($_SERVER['SERVER_ADDR'] == '192.168.100.20') {
                $this->view->params['listDataProvider']['tagMeta'] = CozxyUnity::curPageURL($uri[5]);
            } elseif ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
                $this->view->params['listDataProvider']['tagMeta'] = CozxyUnity::curPageURL($uri[2]);
            }
            //http://192.168.100.20/cost.fit/frontend/web/products/V52KtMKZH6TM5OIjK4zdfQNvRT3EiR9mCcNVFO_afKddRLAHkAyJApKgm80ScAW1
            //$this->view->params['listDataProvider']['tagMeta'] = CozxyUnity::curPageURL($uri[2]);
        }
    }

    public function actionDynamicState() {
        $dataArray = ArrayHelper::map(\common\models\dbworld\States::find()->all(), 'stateId', 'stateName');
        echo $this->renderPartial('ddl', [
            'dataArray' => $dataArray,
            'prompt' => '-- Select State --',
            'name' => 'Search[stateId]',
            'onChange' => 'dynamicCity(this)'
        ]);
    }

    public function actionDynamicCity() {
        $dataArray = ArrayHelper::map(\common\models\dbworld\Cities::find()->where("stateId = " . $_GET["stateId"])->all(), 'cityId', 'cityName');
        echo $this->renderPartial('ddl', [
            'dataArray' => $dataArray,
            'prompt' => '-- Select City --',
            'name' => 'Search[cityId]',
            'onChange' => 'dynamicDistrict(this)'
        ]);
    }

    public function actionDynamicDistrict() {
        $dataArray = ArrayHelper::map(\common\models\dbworld\District::find()->where("cityId = " . $_GET["cityId"])->all(), 'districtId', 'localName');
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
            //echo '<pre>';
            //print_r($id);
            //exit();
            $list = \common\models\dbworld\States::find()->andWhere(['countryId' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['stateId'], 'name' => $account['localName']];
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
                    $out[] = ['id' => $account['cityId'], 'name' => $account['localName']];
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
            $strReturn = $d[2] . '/' . $monthFormat . '/' . ($d[0]);
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

    public function actionMenuCategory() {
        $list = \common\models\costfit\Category::find()
        ->andWhere('parentId  is null ')
        ->andWhere('status  =1')
        ->all();

        return $list;
    }

    public function actionMenuCategoryParentId($id) {
        $list = \common\models\costfit\Category::find()
        ->andWhere('parentId  =' . $id)
        ->andWhere('status  =1')
        ->all();
        return $list;
    }

    public function actionMenuCategorySubParentId($id) {
        $list = \common\models\costfit\Category::find()
        ->andWhere('parentId  =' . $id)
        ->andWhere('status  =1')
        ->all();
        return $list;
    }

    public function actionChildStatesAddress() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = ($_POST['depdrop_parents']);
            if ($parents != null) {
                $cat_id = $parents[0];
                $param1 = null;
                $param2 = null;
                $param3 = null;
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    $param1 = $params[0]; // get the value of input-type-1
                    $param2 = $params[1]; // get the value of input-type-2
                    $param3 = $params[2]; // get the value of input-type-3
                }
                //echo $param3;
                $list = \common\models\dbworld\States::find()->andWhere(['countryId' => $cat_id])->asArray()->all();
                $selected = null;
                if ($cat_id != null && count($list) > 0) {
                    $selected = '';
                    foreach ($list as $i => $account) {
                        $out[] = ['id' => $account['stateId'], 'name' => $account['localName']];
                        $param1 = ($param1 != '') ? $param1 : $account['stateId'];
                        if ($i == 0) {
                            if ($param3 != 'add') {

                                $selected = $param1; //$account['stateId'];
                            } else {
                                $selected = 'Select ...';
                                $selected .= $param1; //$account['stateId'];
                            }
                        } else {
                            if ($param3 != 'add') {

                                $selected = $param1; //$account['stateId'];
                            } else {
                                $selected = 'Select ...';
                                $selected .= $param1; //$account['stateId'];
                            }
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
            if ($parents != null) {
                $cat_id = $parents[0];
                $param1 = null;
                $param2 = null;
                $param3 = null;
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    $param1 = $params[0]; // get the value of input-type-1
                    $param2 = $params[1]; // get the value of input-type-2
                    $param3 = $params[2]; // get the value of input-type-3
                }

                $list = \common\models\dbworld\Cities::find()->andWhere(['stateId' => $cat_id])->asArray()->all();
                $selected = null;
                if ($cat_id != null && count($list) > 0) {
                    $selected = '';
                    foreach ($list as $i => $account) {
                        $out[] = ['id' => $account['cityId'], 'name' => $account['localName']];
                        $param1 = ($param1 != '') ? $param1 : $account['cityId'];
                        if ($i == 0) {
                            if ($param3 != 'add') {

                                $selected = $param1; //$account['stateId'];
                            } else {
                                $selected = 'Select ...';
                                $selected .= $param1; //$account['stateId'];
                            }
                        } else {
                            if ($param3 != 'add') {

                                $selected = $param1;
                            } else {
                                $selected = 'Select ...';
                                $selected .= $param1;
                            }
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
                $param3 = null;
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    $param1 = $params[0]; // get the value of input-type-1
                    $param2 = $params[1]; // get the value of input-type-2
                    $param3 = $params[2]; // get the value of input-type-3
                }

                $list = \common\models\dbworld\District::find()->andWhere(['cityId' => $cat_id])->asArray()->all();
                $selected = null;
                if ($cat_id != null && count($list) > 0) {
                    $selected = '';
                    foreach ($list as $i => $account) {
                        $out[] = ['id' => $account['districtId'], 'name' => $account['localName']];
                        $param1 = ($param1 != '') ? $param1 : $account['districtId'];
                        if ($i == 0) {
                            if ($param3 != 'add') {

                                $selected = $param1; //$account['stateId'];
                            } else {
                                $selected = 'Select ...';
                                $selected .= $param1; //$account['stateId'];
                            }
                        } else {
                            if ($param3 != 'add') {

                                $selected = $param1;
                            } else {
                                $selected = 'Select ...';
                                $selected .= $param1;
                            }
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

    public function actionChildZipcodeAddress() {
        $out = [];

        if (isset($_POST['depdrop_parents'])) {
            $parents = ($_POST['depdrop_parents']);
//            throw new \yii\base\Exception(print_r($parents, true));
            if ($parents != null) {
                $districtId = $parents[0];
                $param1 = null;
                $param2 = null;
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    $param1 = $params[0]; // get the value of input-type-1
//                    $param2 = $params[1]; // get the value of input-type-2
                }

                $district = \common\models\dbworld\District::find()->where("districtId = $districtId")->one();
//                throw new Exception($district->code);
                $list = \common\models\dbworld\Zipcodes::find()->andWhere(['districtCode' => $district->code])->asArray()->all();
                $selected = null;
                if ($districtId != null && count($list) > 0) {
                    $selected = '';
                    foreach ($list as $i => $account) {
                        $out[] = ['id' => $account['zipcode'], 'name' => $account['zipcode']];
                        $param1 = ($param1 != '') ? $param1 : $account['zipcode'];
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

    public function main_category($categoryId) {

        if ($this->id == "search") {
            return \common\models\costfit\Category::find()->where("categoryId ='" . $categoryId . "'")->all();
//            return \common\models\costfit\Category::find()->all();
        }
    }

    public function sub_category($categoryId) {

        if ($this->id == "search") {
            return \common\models\costfit\Category::find()->where("parentId ='" . $categoryId . "'")->all();
        }
    }

    public function getTitleProduct() {
        $Params = CozxyUnity::GetParams(Yii::$app->request->get('productId'), '');
        $getTitleProduct = \common\models\costfit\Product::find()->where("productId ='" . $Params['productId'] . "'")->one();

        return $getTitleProduct;
    }

    public function findPriceRange($categoryId) {
        $res = [];
        $product = \common\models\costfit\CategoryToProduct::find()->select("min(product_price.price) as  minPrice ,max(product_price.price) as maxPrice")
        ->join("LEFT JOIN", "product_price", "product_price.productId = category_to_product.productId")
        ->where("product_price.quantity = 1 AND category_to_product.categoryId=" . $categoryId)->one();

        if (isset($product)) {
            $res["min"] = $product['minPrice'];
            $res["max"] = $product['maxPrice'];
//            $res["min"] = 1000;
//            $res["max"] = 1000000;
        } else {
            $res = NULL;
        }

        return $res;
    }

    public function actionChildAmphurAddressPickingPoint() {
        $out = [];
        preg_match("/dbname=([^;]*)/", Yii::$app->get("db")->dsn, $dbName);
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

                $list = \common\models\dbworld\Cities::find()
                ->join("RIGHT JOIN", "$dbName[1].picking_point", "picking_point.amphurId = cities.cityId ")
                ->andWhere(['cities.stateId' => $cat_id, 'status' => '1'])->asArray()->all();

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

    public function actionChildPickingPoint() {
        $out = [];
        preg_match("/dbname=([^;]*)/", Yii::$app->get("db")->dsn, $dbName);
        if (isset($_POST['depdrop_parents'])) {
            $parents = ($_POST['depdrop_parents']);
            $depdrop_params = $_POST['depdrop_params'];
            //$depdrop_all_params = $_POST['depdrop_params'];
            //echo $depdrop_all_params['']
            //echo $depdrop_params[2];
            //echo $parents[0] . '<br>';
            //echo $parents[1] . '<br>';
            //echo $parents[2] . '<br>';
            /*
              depdrop_params[0]:2523
              depdrop_params[1]:79680
              depdrop_params[2]:2
              depdrop_all_params[BamphurId]:79675
              depdrop_all_params[booth-input-type-13]:2523
              depdrop_all_params[booth-input-type-23]:79680
              depdrop_all_params[booth-input-type-33]:2
             */
            if ($parents != null) {
                $cat_id = $parents[0];
                //throw new \yii\base\Exception(print_r($depdrop_params, true));
                $type = $depdrop_params[2];
                $param1 = null;
                $param2 = null;
                $param3 = null;
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    // echo '<pre>';
                    //print_r($cat_id);
                    //print_r($params);
                    $param1 = $params[0]; // get the value of input-type-1
                    $param2 = $params[1]; // get the value of input-type-2
                    $param3 = $params[2]; // get the value of input-type-3
                    $type = $depdrop_params[2];
                    //echo $cat_id;
                    // echo $type;
                }

                $list = \common\models\costfit\PickingPoint::find()
                ->andWhere(['amphurId' => $cat_id, 'type' => $type, 'status' => '1'])->asArray()->all();

                $selected = null;
                if ($cat_id != null && count($list) > 0) {
                    $selected = '';
                    foreach ($list as $i => $account) {
                        $out[] = ['id' => $account['pickingId'], 'name' => $account['title']];
                        $param1 = ($param1 != '') ? $param1 : $account['pickingId'];
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
