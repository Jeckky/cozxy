<?php

namespace backend\modules\margin\controllers;

class MarginController extends MarginMasterController
{

    public function actionIndex()
    {
        $title = "System margin setting";
        $model = new \common\models\costfit\Margin();
        $systemMargin = \common\models\costfit\Margin::getSystemMargin();
        if (!isset($systemMargin)) {
            $systemMargin = new \common\models\costfit\Margin();
        }

        if (isset($_POST["Margin"]) && $_POST["Margin"]["percent"] != $systemMargin->percent) {

            $systemMargin = new \common\models\costfit\Margin();
            $systemMargin->attributes = $_POST["Margin"];
            $systemMargin->createDateTime = new \yii\db\Expression("NOW()");
            if ($systemMargin->save()) {
                $lastId = \Yii::$app->db->lastInsertID;

                \common\models\costfit\Margin::updateAll(['status' => 0], "marginId <> $lastId AND brandId is NULL AND categoryId is NULL AND supplierId is NULL");
                $systemMargin = \common\models\costfit\Margin::find()->where("marginId = $lastId")->orderBy("marginId DESC")->one();
            }
        }
        return $this->render('index', compact('systemMargin', 'title', 'model'));
    }

}
