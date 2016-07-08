<?php

namespace backend\modules\notification\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

class InboxController extends NotificationMasterController {

    public function actionIndex() {
        return $this->render('inbox');
    }

}
