<?php

namespace backend\modules\mailstore\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class VerifyEmailController extends MailStoreMasterController {

    public function actionIndex() {
        return $this->render('index');
    }

}
