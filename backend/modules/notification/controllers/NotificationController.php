<?php

namespace backend\modules\notification\controllers;

class NotificationController extends NotificationMasterController {

    public function actionIndex() {

        return $this->render('index');
    }

}
