<?php

namespace backend\modules\productmanager\controllers;

use yii\web\Controller;

/**
 * Default controller for the `productmanager` module
 */
class DefaultController extends ProductManagerMasterController
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
