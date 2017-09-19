<?php

namespace backend\modules\content\controllers;

class LocalController extends ContentMasterController {

    public function actionIndex() {
        return $this->render('index');
    }

}
