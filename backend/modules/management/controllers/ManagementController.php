<?php

namespace backend\modules\management\controllers;

class ManagementController extends ManagementMasterController {

    public function actionIndex() {
        return $this->render('index');
    }

}
