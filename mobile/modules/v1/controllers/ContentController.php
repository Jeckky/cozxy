<?php

namespace mobile\modules\v1\controllers;

use common\models\costfit\Content;
use Yii;
use yii\web\Controller;
use \yii\helpers\Json;

/**
 * Default controller for the `mobile` module
 */
class ContentController extends Controller
{
    public function actionIndex()
    {
        $contentModels = Content::find()
            ->where('contentGroupId=1 AND status=1')
            ->all();

        $res = [];
        $i = 0;

        foreach($contentModels as $contentModel) {
            $res[$i] = $contentModel->attributes;
            $res[$i]['image'] = Yii::$app->homeUrl.$contentModel->image;

            $i++;
        }

        echo Json::encode($res);
    }
}
