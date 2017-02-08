<?php

namespace backend\modules\lockers\controllers;

class ReportController extends LockersMasterController {

    public function actionIndex() {
        return $this->render('index');
    }

}
