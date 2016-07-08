<?php

namespace backend\modules\management\controllers;

class SettingsController extends ManagementMasterController {

    public function actionIndex() {
        return $this->render('index');
    }

}
