<?php

namespace frontend\controllers;

class ContentController extends \yii\web\Controller {

    public function actionIndex($hash = FALSE) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $content = \common\models\costfit\ProductPost::find()->where('productPostId=' . $params['productPostId'])->one();
        return $this->render('@app/themes/cozxy/layouts/content/_content', compact('content'));
    }

}
