<?php

namespace backend\modules\management\controllers;

class AccountController extends ManagementMasterController {

    public function actionIndex() {
        return $this->render('index');
    }

}
