<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\controllers\MasterController as MasterCommonController;

/**
 * Site controller
 */
class MasterController extends MasterCommonController
{

    public $layout = '/content';
    public $title = 'Title';
    public $subTitle = 'Sub Title';
    public $subSubTitle = 'Sub Sub Title';

    public function getTitle()
    {
        return $this->title;
    }

    public function getSubTitle()
    {
        return $this->subTitle;
    }

    public function getSubSubTitle()
    {
        return $this->subSubTitle;
    }

    public function init()
    {
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
    }

    public function getToken()
    {
        $cookies = Yii::$app->request->cookies;
        if (isset($cookies['orderToken'])) {
            return $cookies['orderToken']->value;
        } else {
            $this->generateNewToken();
            return $cookies['orderToken']->value;
        }
    }

    public function generateNewToken()
    {
//        $cookies = Yii::$app->request->cookies;
//        if (!isset($cookies['orderToken'])) {
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'orderToken',
            'value' => Yii::$app->security->generateRandomString(),
        ]));
//        }
    }

    public function actionDynamicState()
    {
        $dataArray = ArrayHelper::map(\common\models\dbWorld\States::find()->all(), 'stateId', 'stateName');
        echo $this->renderPartial('ddl', [
            'dataArray' => $dataArray,
            'prompt' => '-- Select State --',
            'name' => 'Search[stateId]',
            'onChange' => 'dynamicCity(this)'
        ]);
    }

    public function actionDynamicCity()
    {
        $dataArray = ArrayHelper::map(\common\models\dbWorld\Cities::find()->where("stateId=" . $_GET["stateId"])->all(), 'cityId', 'cityName');
        echo $this->renderPartial('ddl', [
            'dataArray' => $dataArray,
            'prompt' => '-- Select City --',
            'name' => 'Search[cityId]',
            'onChange' => 'dynamicDistrict(this)'
        ]);
    }

    public function actionDynamicDistrict()
    {
        $dataArray = ArrayHelper::map(\common\models\dbWorld\District::find()->where("cityId=" . $_GET["cityId"])->all(), 'districtId', 'localName');
        echo $this->renderPartial('ddl', [
            'dataArray' => $dataArray,
            'prompt' => '-- Select District --',
            'name' => 'Search[disctictId]'
        ]);
    }

}
