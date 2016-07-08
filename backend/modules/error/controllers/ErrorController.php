<?php

namespace backend\modules\error\controllers;

class ErrorController extends ErrorMasterController {

    public function actionIndex() {
        return $this->render('index');
    }

}
