<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * HowCostFitWorks controller
 */
class HowCostFitWorksController extends MasterController {

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $this->title = 'Cost.fit | How Cost Fit Works';
        $this->subTitle = 'How Cost Fit Works';
        return $this->render('@app/views/how/howcostfitworks');
    }

}
