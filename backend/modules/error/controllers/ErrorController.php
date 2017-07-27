<?php

namespace backend\modules\error\controllers;

class ErrorController extends ErrorMasterController
{

    public function actionIndex()
    {
        $exception = \Yii::$app->errorHandler->exception;

        return $this->render('index', ['exception' => $exception]);
    }

}
