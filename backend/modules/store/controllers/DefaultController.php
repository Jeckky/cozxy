<?php

namespace backend\modules\store\controllers;

use yii\web\Controller;

/**
 * Default controller for the `Store` module
 */
class DefaultController extends \backend\controllers\BackendMasterController
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}
