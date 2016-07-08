<?php

namespace backend\modules\dashboard\controllers;

class DashboardController extends DashboardMasterController {

    public function actionIndex() {

        return $this->render('index');
    }

}
