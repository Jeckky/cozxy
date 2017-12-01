<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\ProductGroupTemplateOption;
use common\models\costfit\ProductGroupTemplateOptionSearch;
use backend\modules\product\controllers\ProductMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\ProductGroupTemplate;
use common\models\costfit\ProductGroup;
use common\models\costfit\ProductGroupOption;

/**
 * ProductGroupTemplateOptionController implements the CRUD actions for ProductGroupTemplateOption model.
 */
class ProductGroupTemplateOptionController extends ProductMasterController {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductGroupTemplateOption models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProductGroupTemplateOptionSearch();
        if (isset($_GET["productGroupTemplateId"])) {
            $searchModel->productGroupTemplateId = $_GET["productGroupTemplateId"];
        }
        if (isset($_GET["productGroupTemplateId"])) {
            $searchModel->productGroupTemplateId = $_GET["productGroupTemplateId"];
        }
        $showED = 0;
        $isUse = \common\models\costfit\Product::find()->where("productGroupTemplateId=" . $_GET["productGroupTemplateId"])->one();
        if (isset($isUse)) {
            $showED = 1;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'showED' => $showED
        ]);
    }

    /**
     * Displays a single ProductGroupTemplateOption model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductGroupTemplateOption model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ProductGroupTemplateOption();
        if (isset($_GET["productGroupTemplateId"])) {
            $model->productGroupTemplateId = $_GET["productGroupTemplateId"];
        }
        if (isset($_POST["ProductGroupTemplateOption"])) {
            $dupp = $this->checkDupplicateTitle($_POST["ProductGroupTemplateOption"]["title"], $_POST["ProductGroupTemplateOption"]["productGroupTemplateId"]);
            if ($dupp == 1) {
                $error = 'ชื่อ Options ซ้ำ(Title)';
                $id = $_POST["ProductGroupTemplateOption"]["productGroupTemplateId"];
                //throw new \yii\base\Exception($_POST["ProductGroupTemplateOption"]["productGroupTemplateId"]);
                return $this->redirect(['create',
                            'productGroupTemplateId' => $id,
                            'error' => $error
                ]);
            }
            $model->attributes = $_POST["ProductGroupTemplateOption"];
            $model->createDateTime = new \yii\db\Expression('NOW()');

            if ($model->save()) {
                $newProductGroupTemplateOptionId = \Yii::$app->db->getLastInsertID();
                $this->saveToProductGroupOption($model->productGroupTemplateId, $newProductGroupTemplateOptionId);
                return $this->redirect(['index?productGroupTemplateId=' . $model->productGroupTemplateId]);
            }
        }
        return $this->render('create', [
                    'model' => $model,
                    'productGroupTemplateId' => isset($_GET["productGroupTemplateId"]) ? $_GET["productGroupTemplateId"] : '',
                    'error' => isset($_GET["error"]) ? $_GET["error"] : false
        ]);
    }

    public function checkDupplicateTitle($title, $productGroupTemplateId) {
        $productGroupTemplateOption = ProductGroupTemplateOption::find()->where("productGroupTemplateId=" . $productGroupTemplateId . " and title='" . $title . "'")->one();
        if (isset($productGroupTemplateOption)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function saveToProductGroupOption($productGroupTemplateId, $newProductGroupTemplateOptionId) {
        $productGroupTemplateOptions = ProductGroupTemplateOption::find()->where("productGroupTemplateId=" . $productGroupTemplateId)->all();
        $productGroupTemplateOption = '';
        if (isset($productGroupTemplateOptions) && count($productGroupTemplateOptions) > 0) {
            foreach ($productGroupTemplateOptions as $productGroupTemplateOptionId):
                $productGroupTemplateOption.=$productGroupTemplateOptionId->productGroupTemplateOptionId . ",";
            endforeach;
            $productGroupTemplateOption = substr($productGroupTemplateOption, 0, -1);
            $productGroupIds = ProductGroupOption::find()->where("productGroupTemplateOptionId in ($productGroupTemplateOption)")
                    ->groupBy("productGroupId")
                    ->all();
            $newName = ProductGroupTemplateOption::find()->where("productGroupTemplateOptionId=" . $newProductGroupTemplateOptionId)->one();
            if (isset($productGroupIds) && count($productGroupIds) > 0) {
                foreach ($productGroupIds as $productGroup):
                    $newIds = ProductGroupOption::find()->where("productGroupId=" . $productGroup->productGroupId . " and productGroupTemplateOptionId=" . $newProductGroupTemplateOptionId)->all();

                    if (!isset($newIds) || count($newIds) == 0) {
                        $productGroupOption = new ProductGroupOption();
                        $productGroupOption->productGroupId = $productGroup->productGroupId;
                        $productGroupOption->productGroupTemplateOptionId = $newProductGroupTemplateOptionId;
                        $productGroupOption->name = $newName->title;
                        $productGroupOption->status = 1;
                        $productGroupOption->createDateTime = new \yii\db\Expression('NOW()');
                        $productGroupOption->updateDateTime = new \yii\db\Expression('NOW()');
                        $productGroupOption->save(false);
                    }
                endforeach;
            }
        }
    }

    /**
     * Updates an existing ProductGroupTemplateOption model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["ProductGroupTemplateOption"])) {
            $model->attributes = $_POST["ProductGroupTemplateOption"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');



            if ($model->save()) {
                return $this->redirect(['index?productGroupTemplateId=' . $model->productGroupTemplateId]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductGroupTemplateOption model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index?productGroupTemplateId=' . $model->productGroupTemplateId]);
    }

    public function actionSortTemplateOption() {
        $productGroupTemplateOptionId = $_POST["id"];
        $type = $_POST["action"];
        $total = $_POST["total"];
        $res = [];
        $productGroupTemplateOption = ProductGroupTemplateOption::find()->where("ProductGroupTemplateOptionId=" . $productGroupTemplateOptionId)->one();
        if ($type == 1) {
            $sort = $productGroupTemplateOption->ordering + 1;
            if ($sort > $total) {
                $sort = $total;
                $res["status"] = false;
            } else {
                $res["status"] = true;
            }
        } else {
            $sort = $productGroupTemplateOption->ordering - 1;
            if ($sort <= 0) {
                $sort = 1;
                $res["status"] = false;
            } else {
                $res["status"] = true;
            }
        }
        $productGroupTemplateOption->ordering = $sort;
        $productGroupTemplateOption->save(false);
        $res["sort"] = $sort;
        return json_encode($res);
    }

    /**
     * Finds the ProductGroupTemplateOption model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductGroupTemplateOption the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductGroupTemplateOption::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
