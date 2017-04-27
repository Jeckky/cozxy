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

    public function actionBrandMargin()
    {
        $title = "Brand margin setting";

        return $this->render('brandMargin', compact('title'));
    }

    public function actionBrandMarginUpdate()
    {
        $title = "Brand margin Create";

        $updateModel = \common\models\costfit\Brand::find()->where("brandId = " . $_GET["brandId"])->one();
        $model = \common\models\costfit\Margin::getBrandMargin($_GET["brandId"]);
        if (isset($_GET["searchText"])) {
            $beforeSearch = $_GET["searchText"];
        } else {
            $beforeSearch = NULL;
        }
        $historys = \common\models\costfit\Margin::find()->where("brandId=" . $_GET["brandId"] . " AND categoryId is NULL AND supplierId is NULL")->orderBy("createDateTime DESC")->all();
        if (!isset($model)) {
            $model = new \common\models\costfit\Margin();
        }

        if (isset($_POST["Margin"]) && $_POST["Margin"]["percent"] != $model->percent) {

            $model = new \common\models\costfit\Margin();
            $model->attributes = $_POST["Margin"];
            $model->brandId = $_GET["brandId"];
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save()) {
                $lastId = \Yii::$app->db->lastInsertID;

                \common\models\costfit\Margin::updateAll(['status' => 0], "marginId <> $lastId AND brandId =" . $_GET["brandId"] . " AND categoryId is NULL AND supplierId is NULL");
                $model = \common\models\costfit\Margin::find()->where("marginId = $lastId")->orderBy("marginId DESC")->one();
            }
        }
        return $this->render('_form', compact('model', 'title', 'historys', 'updateModel', 'beforeSearch'));
    }

    public function actionCategoryMargin()
    {
        $title = "Category margin setting";

        return $this->render('categoryMargin', compact('title'));
    }

    public function actionCategoryMarginUpdate()
    {
        $title = "Category margin setting";
        $updateModel = \common\models\costfit\Category::find()->where("categoryId = " . $_GET["categoryId"])->one();
        $model = \common\models\costfit\Margin::getCategoryMargin($_GET["categoryId"]);
        if (isset($_GET["searchText"])) {
            $beforeSearch = $_GET["searchText"];
        } else {
            $beforeSearch = NULL;
        }
        $historys = \common\models\costfit\Margin::find()->where("brandId IS NULL AND categoryId =" . $_GET["categoryId"] . " AND supplierId is NULL")->orderBy("createDateTime DESC")->all();
        if (!isset($model)) {
            $model = new \common\models\costfit\Margin();
        }

        if (isset($_POST["Margin"]) && $_POST["Margin"]["percent"] != $model->percent) {

            $model = new \common\models\costfit\Margin();
            $model->attributes = $_POST["Margin"];
            $model->categoryId = $_GET["categoryId"];
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save()) {
                $lastId = \Yii::$app->db->lastInsertID;

                \common\models\costfit\Margin::updateAll(['status' => 0], "marginId <> $lastId AND brandId is NULL AND categoryId =" . $_GET["categoryId"] . " AND supplierId is NULL");
                $model = \common\models\costfit\Margin::find()->where("marginId = $lastId")->orderBy("marginId DESC")->one();
            }
        }
        return $this->render('_form', compact('model', 'title', 'historys', 'updateModel', 'beforeSearch'));
    }

}
