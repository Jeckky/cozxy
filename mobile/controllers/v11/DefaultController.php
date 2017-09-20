<?php

namespace mobile\controllers\v1;

use yii\web\Controller;

/**
 * Default controller for the `mobile` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        echo 'mobile';
//        return $this->render('index');
    }
}
