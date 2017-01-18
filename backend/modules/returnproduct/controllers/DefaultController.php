<?php

namespace backend\modules\returnproduct\controllers;

use yii\web\Controller;

/**
 * Default controller for the `returnProduct` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

}
