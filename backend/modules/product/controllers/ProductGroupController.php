<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\ProductGroup;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use beastbytes\wizard\WizardBehavior;
use common\helpers\Upload;

/**
 * ProductGroupController implements the CRUD actions for ProductGroup model.
 */
class ProductGroupController extends ProductMasterController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductGroup::find()
            ->where("userId=" . Yii::$app->user->identity->userId . " and status=1"),
        ]);

        return $this->render('101/index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductGroup model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateOld()
    {
        $model = new ProductGroup();
        $ms = '';
        if (isset($_POST["ProductGroup"])) {
            $productGroup = ProductGroup::find()->where("title='" . $_POST["ProductGroup"]["title"] . "' and status=1")->one();
            if (!isset($productGroup)) {
                $model->userId = Yii::$app->user->identity->userId;
                $model->title = $_POST["ProductGroup"]["title"];
                $model->description = strip_tags($_POST["ProductGroup"]["description"]);
                $model->status = 1;
                $model->updateDateTime = new \yii\db\Expression('NOW()');
                $model->createDateTime = new \yii\db\Expression('NOW()');
                if ($model->save(false)) {
                    return $this->redirect(['index']);
                }
            } else {
                $ms = 'This title already exists.';
                $title = $_POST["ProductGroup"]["title"];
                $description = $_POST["ProductGroup"]["description"];
            }
        }
        return $this->render('create', [
            'model' => $model,
            'ms' => $ms,
            'title' => isset($title) ? $title : false,
            'description' => isset($description) ? $description : false
        ]);
    }

    /**
     * Updates an existing ProductGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $ms = '';
        $model = $this->findModel($id);
        if (isset($_POST["ProductGroup"])) {
            $model->attributes = $_POST["ProductGroup"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');



            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'description' => $model->description,
            'ms' => $ms,
        ]);
    }

    /**
     * Deletes an existing ProductGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // Version 1.01 Wizard Of Product Group

    public function actionCreate($step = null)
    {
        $userId = Yii::$app->user->identity->userId;
        $ms = '';
        if (!isset($step)) { // For Access direct link without get step parameter
            $step = 9;
        }
        $model = new \common\models\costfit\Product();
        switch ($step) {
            case 1:
                $drafts = \common\models\costfit\Product::find()->where("userId = $userId AND parentId IS NULL AND status = 99")->all();
                if (isset($drafts) && count($drafts) > 0) {
                    return $this->redirect(["draft", "drafts" => $drafts]);
                }
                if (isset($_POST["Product"])) {
                    $model->attributes = $_POST["Product"];
                    $model->userId = $userId;
                    $model->createDateTime = new \yii\db\Expression('NOW()');
                    $model->parentId = NULL;
                    $model->step = 2;
                    if ($model->save(false)) {
                        $productGroupId = \Yii::$app->db->lastInsertID;
                        return $this->redirect(['create', 'step' => 2, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $productGroupId]);
                    }
                }
                break;
            case 0: // For Save Draft is Status = 99
                if (isset($_POST["Product"])) {
                    $model->attributes = $_POST["ProductGroup"];
                    $model->userId = $userId;
                    $model->createDateTime = new \yii\db\Expression('NOW()');
                    $model->parentId = NULL;
                    $model->status = 99;
                    $model->step = 1;
                    if ($model->save(false)) {
                        $productGroupId = \Yii::$app->db->lastInsertID;
                        return $this->redirect(['create', 'step' => 2, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $productGroupId]);
                    }
                }
                break;
            case 2:
                if (isset($_POST["next"]))
                    return $this->redirect(['create', 'step' => 3, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]);
                break;
            case 3:
                $productGroupTemplateOptions = \common\models\costfit\ProductGroupTemplateOption::find()->where("productGroupTemplateId = " . $_GET["productGroupTemplateId"])->all();
                if (isset($_POST["ProductGroupOptionValue"])) {
                    $this->saveProductsWithOption($_POST["ProductGroupOptionValue"], $_GET["productGroupId"]);
                    return $this->redirect(['create', 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]);
                }
                break;
            case 4:
                $dataProvider = new ActiveDataProvider([
                    'query' => \common\models\costfit\Product::find()
                    ->where("parentId=" . $_GET["productGroupId"]),
                ]);
                $gridColumns = [
                    ['class' => 'kartik\grid\SerialColumn'],
//                    'productId',
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'title',
                        'pageSummary' => 'Page Total',
                        'vAlign' => 'middle',
                        'headerOptions' => ['class' => 'kv-sticky-column'],
                        'contentOptions' => ['class' => 'kv-sticky-column'],
                        'editableOptions' => ['header' => 'Title', 'size' => 'md']
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'description',
                        'pageSummary' => 'Page Total',
                        'vAlign' => 'middle',
                        'headerOptions' => ['class' => 'kv-sticky-column'],
                        'contentOptions' => ['class' => 'kv-sticky-column'],
                        'editableOptions' => ['header' => 'Title', 'size' => 'md']
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'specification',
                        'pageSummary' => 'Page Total',
                        'vAlign' => 'middle',
                        'headerOptions' => ['class' => 'kv-sticky-column'],
                        'contentOptions' => ['class' => 'kv-sticky-column'],
                        'editableOptions' => ['header' => 'Title', 'size' => 'md']
                    ],
//                    [
//                        'class' => 'kartik\grid\BooleanColumn',
//                        'attribute' => 'status',
//                        'vAlign' => 'middle',
//                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'dropdown' => true,
                        'vAlign' => 'middle',
                        'urlCreator' => function($action, $model, $key, $index) {
                            return '#';
                        },
//                        'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
//                        'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
                        'deleteOptions' => ['title' => "คุณต้องการลบสินค้านี้หรือไม่ ?", 'data-toggle' => 'tooltip'],
                    ],
                    ['class' => 'kartik\grid\CheckboxColumn']
                ];
                break;
            case 9:// For Access direct link without get step parameter
                return $this->redirect(['create', 'step' => 1]);
                break;
            default:

                break;
        }

        return $this->render('101/step', [
            'model' => $model,
            'step' => $step,
            'ms' => $ms,
            'title' => isset($title) ? $title : false,
            'description' => isset($description) ? $description : false,
            'productGroupTemplateOptions' => isset($productGroupTemplateOptions) ? $productGroupTemplateOptions : NULL,
            'dataProvider' => isset($dataProvider) ? $dataProvider : NULL,
            'gridColumns' => isset($gridColumns) ? $gridColumns : NULL,
        ]);
    }

    public function actionDraft()
    {
        $drafts = new ActiveDataProvider([
            'query' => \common\models\costfit\Product::find()->where("userId = $userId AND parentId IS NULL AND status = 99"),
        ]);
        return $this->render(["101/draft", "drafts" => $drafts]);
    }

    public function saveProductsWithOption($options, $productGroupId)
    {
        $res = $this->prepareOptionArray($options);
        $productGroup = \common\models\costfit\Product::find()->where("productId = $productGroupId")->one();
        $productGroupImages = \common\models\costfit\ProductImage::find()->where("productId = $productGroupId")->all();
//        throw new \yii\base\Exception(print_r($productGroup->attributes, true));
        foreach ($res as $options) {
            $model = new \common\models\costfit\Product();
            $model->attributes = $productGroup->attributes;
            $model->parentId = $productGroupId;
            $model->createDateTime = new yii\db\Expression("NOW()");
            $model->save(FALSE);
            $productId = \Yii::$app->db->lastInsertID;

            foreach ($options as $productGroupOptionId => $value) {
                $productGroupOptionValue = new \common\models\costfit\ProductGroupOptionValue();
                $productGroupOptionValue->productId = $productId;
                $productGroupOptionValue->productGroupOptionId = $productGroupOptionId;
                $productGroupOptionValue->value = $value;
                $productGroupOptionValue->createDateTime = new yii\db\Expression("NOW()");
                $productGroupOptionValue->save();
            }

            foreach ($productGroupImages as $image) {
                $productImage = new \common\models\costfit\ProductImage();
                $productImage->attributes = $image->attributes;
                $productImage->productId = $productId;
                $productImage->createDateTime = new yii\db\Expression("NOW()");
                $productImage->save();
            }
        }
    }

    public function prepareOptionArray($options)
    {
        $res = [];
        foreach ($options as $productGroupTemplateOptionId => $optionArray) {
            $res[$productGroupTemplateOptionId] = explode(",", $optionArray);
        }
        return $this->array_cartesian($res); // 2D array
    }

    function array_cartesian($arrays)
    {
        $result = array();
        $keys = array_keys($arrays);
        $arrays = array_values($arrays);

        $sizeIn = sizeof($arrays);

        $size = $sizeIn > 0 ? 1 : 0;
        foreach ($arrays as $array)
            $size = $size * sizeof($array);
        for ($i = 0; $i < $size; $i++) {
            $result[$i] = array();
            for ($j = 0; $j < $sizeIn; $j++) {
//            array_push($result[$i], current($arrays[$j]));
                $result[$i][$keys[$j]] = current($arrays[$j]);
            }

            for ($j = ($sizeIn - 1); $j >= 0; $j--) {
                if (next($arrays[$j]))
                    break;
                elseif (isset($arrays[$j]))
                    reset($arrays[$j]);
            }
        }
//        throw new \yii\base\Exception(print_r($result, TRUE));
        return $result;
    }

    public function actionUpload()
    {

        if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 5) {
            header("location: /auth");
            exit(0);
        }
        //$model = new \common\models\costfit\productImageSuppliers();
        $model = new \common\models\costfit\ProductImage();
        /*
         * helpers Upload
         * path : common/helpers/Upload.php
         * use : Upload::UploadSuppliers($model)
         * กรณีพิเศษ
         */
        \common\helpers\Upload::UploadSuppliers($model);
    }

    // Version 1.01 Wizard Of Product Group
}
