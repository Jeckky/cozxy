<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\Store;
use common\models\costfit\LedItem;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class VirtualController extends StoreMasterController {

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

    public function beforeAction($action) {
        if ($action->id == 'ping-hardware' || $action->id == 'select-led' || $action->id == 'add-led-to-slot') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $storeSlots = \common\models\costfit\StoreSlot::find()->where("status=1 and level =1")->all();
        return $this->render('index', compact('storeSlots'));
    }

    public function actionLeditems() {

        $ledItems = new LedItem();
        // print_r($ledItems->leds);
        print_r(Json::encode($ledItems->getLeds()));
    }

    public function actionPingHardware() {
        $res = [];
        exec("ping -c 4 " . $_POST['ip'], $output, $result);
        if ($result == 0) {
            $res["status"] = true;
        } else {
            $res["status"] = FALSE;
        }

        echo \yii\helpers\Json::encode($res);
    }

    public function actionRemoveLedFromSlot($id) {
        $led = \common\models\costfit\Led::find()->where("ledId=$id")->one();
        $led->slot = NULL;
        $led->save();

        $this->redirect(['index']);
    }

    public function actionSelectLed() {
        $leds = \common\models\costfit\Led::find()->where("slot is null")->all();

        return $this->renderPartial('led_list', compact('leds'));
    }

    public function actionAddLedToSlot() {
        $led = \common\models\costfit\Led::find()->where("ledId=" . $_POST['id'])->one();
        $led->slot = $_POST['slotCode'];
        $led->save();

        echo \yii\helpers\Json::encode(['status' => true]);
    }

}
