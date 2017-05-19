<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\costfit\ContentGroup;
use common\models\costfit\Content;

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
        $this->title = 'Cozxy.com | How Cost Fit Works';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'Support';
        $top = ContentGroup::find()->where("lower(title)='howwork'")->one();
        $topContent = Content::find()->where("contentGroupId='" . $top->contentGroupId . "' order by contentId DESC limit 0,2")->all();
        $body = ContentGroup::find()->where("lower(title)='howwork2'")->one();
        $bodyContent = Content::find()->where("contentGroupId='" . $body->contentGroupId . "'")->all();
        $info = ContentGroup::find()->where("lower(title)='contactInfo'")->one();
        $contactInfo = Content::find()->where("contentGroupId='" . $info->contentGroupId . "'")->all();
        $web = ContentGroup::find()->where("lower(title)='website'")->one();
        $webSite = Content::find()->where("contentGroupId='" . $web->contentGroupId . "'")->all();
        return $this->render('@app/views/how/howcostfitworks', compact('topContent', 'top', 'bodyContent', 'contactInfo', 'webSite'));
    }

}
