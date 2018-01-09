<?php

namespace mobile\modules\v1\controllers;

use common\models\costfit\Content;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use \yii\helpers\Json;

/**
 * Default controller for the `mobile` module
 */
class ContentController extends Controller
{
    public $enableCsrfValidation = false;
    public $pageSize = 12;

    public function actionIndex()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        $offset = $page * $this->pageSize;

        $contentModels = Content::find()
            ->where('contentGroupId=1 AND status=1')
            ->offset($offset)
            ->limit($this->pageSize)
            ->all();

        $res = [];
        $i = 0;
        $items = [];

        foreach($contentModels as $contentModel) {
            $items[$i] = $contentModel->attributes;
            $items[$i]['image'] = Url::home(true).$contentModel->image;

            $i++;
        }

        $res['items'] = $items;
        $res['pagination'] = [
            'pageSize'=>$this->pageSize,
            'page'=>$page
        ];

        echo Json::encode($res);
    }
}
