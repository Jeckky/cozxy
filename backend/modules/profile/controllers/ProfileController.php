<?php

namespace backend\modules\profile\controllers;

class ProfileController extends ProfileMasterController {

    public function actionIndex() {
        return $this->render('index');
    }

}
