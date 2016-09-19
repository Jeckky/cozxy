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

    public function actionIndex() {
        return $this->render('index', compact('GetLed'));
    }

    public function actionLeditems() {

        $ledItems = new LedItem();
        // print_r($ledItems->leds);
        print_r(Json::encode($ledItems->getLeds()));
    }

}
