<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\Store;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class VirtualController extends StoreMasterController {

    public function actionIndex() {

        $storeId = 1; // เลียบทางด่วน 
        return $this->render('index');
    }

}
