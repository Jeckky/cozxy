<?php

namespace backend\modules\picking\controllers;

use yii\web\Controller;

/**
 * Default controller for the `picking` module
 */
class DefaultController extends PickingMasterController {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

}
