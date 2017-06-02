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
        //User Type 4 = Supplier , 5= Content
        if (Yii::$app->user->identity->type == 4) {
            $query = \common\models\costfit\Product::find()
            ->where("userId=" . Yii::$app->user->identity->userId . " AND parentId is null AND status = 1");
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        } elseif (Yii::$app->user->identity->type == 5) {
            $query = \common\models\costfit\Product::find()
            ->where("userId=" . Yii::$app->user->identity->userId . " AND parentId is null AND status = 1");
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        } else {
            $user_group_Id = Yii::$app->user->identity->user_group_Id;
            $userRe = str_replace('[', '', str_replace(']', '', $user_group_Id));
            $userEx = explode(',', $userRe);
            $ress = array_search(26, $userEx);
            $query = \common\models\costfit\Product::find()
            ->where("userId=" . Yii::$app->user->identity->userId . " AND parentId is null ");
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }


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
                if (isset($_GET["productGroupId"])) {
                    $model = \common\models\costfit\Product::find()->where("productId=" . $_GET["productGroupId"])->one();
                }
                if (isset($_POST["Product"])) {
                    $model->attributes = $_POST["Product"];
                    $model->userId = $userId;
                    $model->createDateTime = new \yii\db\Expression('NOW()');
                    $model->parentId = NULL;
                    $model->status = 0;
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
                $this->saveProductGroupStep($_GET["productGroupId"], 2);
                if (isset($_POST["next"]))
                    return $this->redirect(['create', 'step' => 3, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]);
                break;
            case 3:
                $this->saveProductGroupStep($_GET["productGroupId"], 3);
                $productGroupTemplateOptions = \common\models\costfit\ProductGroupTemplateOption::find()->where("productGroupTemplateId = " . $_GET["productGroupTemplateId"])->all();
                foreach ($productGroupTemplateOptions as $pto) {
                    $pgo = \common\models\costfit\ProductGroupOption::find()->where("productGroupId =" . $_GET["productGroupId"] . ' AND productGroupTemplateOptionId=' . $pto->productGroupTemplateOptionId)->one();
                    if (isset($pgo)) {
                        continue;
                    } else {
                        $pgo = new \common\models\costfit\ProductGroupOption();
                    }

                    $pgo->productGroupId = $_GET["productGroupId"];
                    $pgo->productGroupTemplateOptionId = $pto->productGroupTemplateOptionId;
                    $pgo->name = $pto->title;
                    $pgo->createDateTime = new \yii\db\Expression("NOW()");
                    $pgo->save();
                }
                if (isset($_POST["ProductGroupOptionValue"])) {
                    $this->saveProductsWithOption($_POST["ProductGroupOptionValue"], $_GET["productGroupId"]);
                    return $this->redirect(['create', 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]);
                }
                break;
            case 4:
                $this->saveProductGroupStep($_GET["productGroupId"], 4);
                if (isset($_POST["next"])) {
                    return $this->redirect(['create', 'step' => 5, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]);
                }
                $dataProvider = new ActiveDataProvider([
                    'query' => \common\models\costfit\Product::find()->orderBy("productId ASC")
                    ->where("parentId=" . $_GET["productGroupId"]),
                ]);
                break;
            case 5:// For Access direct link without get step parameter
//                return $this->redirect(['create', 'step' => 1]);
                $this->saveProductGroupStep($_GET["productGroupId"], 5);
                $model = \common\models\costfit\Product::find()->where("productId=" . $_GET["productGroupId"])->one();
                $countProduct = \common\models\costfit\Product::find()->where("parentId=" . $_GET["productGroupId"])->count();
                if (isset($_POST["finish"])) {
                    $model->status = 99;
                    $model->save();
                    return $this->redirect(['index']);
                }
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
            'countProduct' => isset($countProduct) ? $countProduct : NULL,
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
            $optionStr = "";
            $oCount = 1;
            foreach ($options as $productGroupOptionId => $value) {
                $optionStr.=$productGroupOptionId;
                $oCount++;
                if ($oCount < count($options)) {
                    $optionStr.=",";
                }
            }
            $productGroupOptionValues = \common\models\costfit\ProductGroupOptionValue::find()->where("productGroupId =$productGroupId AND productGroupOptionId in ($optionStr)")->all();
            if (count($productGroupOptionValues) == count($options)) {
                continue;
            }
            $flag = TRUE;
            try {
                $transaction = \Yii::$app->db->beginTransaction();
                $model = new \common\models\costfit\Product();
                $model->attributes = $productGroup->attributes;
                $model->parentId = $productGroupId;
                $model->createDateTime = new yii\db\Expression("NOW()");
                $model->save(FALSE);
                $productId = \Yii::$app->db->lastInsertID;

//                throw new \yii\base\Exception(print_r($options, TRUE));
                $countOption = 1;
                foreach ($options as $productGroupOptionId => $value) {
//                    $productGroupOptionValue = \common\models\costfit\ProductGroupOptionValue::find()->where("productGroupId =$productGroupId AND productGroupOptionId=$productGroupOptionId")->one();
//                    if (isset($productGroupOptionValue)) {
//                        $countOption++;
//                        continue;
//                    } else {
                    $productGroupOptionValue = new \common\models\costfit\ProductGroupOptionValue();
//                    }
                    $productGroupOptionValue->productId = $productId;
                    $productGroupOptionValue->productGroupId = $productGroupId;
                    $productGroupOptionValue->productGroupOptionId = $productGroupOptionId;
                    $productGroupOptionValue->productGroupTemplateId = $model->productGroupTemplateId;
                    $productGroupOptionValue->value = $value;
                    $productGroupOptionValue->createDateTime = new yii\db\Expression("NOW()");
                    $productGroupOptionValue->save();
                }
//                if ($countOption == count($options)) {
//                    $flag = FALSE;
//                }

                foreach ($productGroupImages as $image) {
                    $productImage = new \common\models\costfit\ProductImage();
                    $productImage->attributes = $image->attributes;
                    $productImage->productId = $productId;
                    $productImage->createDateTime = new yii\db\Expression("NOW()");
                    $productImage->save();
                }

                if ($flag) {
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $ex) {
                $transaction->rollBack();
                throw new \yii\base\Exception($ex->getMessage());
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

        //$model = new \common\models\costfit\productImageSuppliers();
        $model = new \common\models\costfit\ProductImage();
        $model->productId = $_GET["id"];
        /*
         * helpers Upload
         * path : common/helpers/Upload.php
         * use : Upload::UploadSuppliers($model)
         * กรณีพิเศษ
         */
        \common\helpers\Upload::UploadSuppliers($model);
    }

    public function actionUpdateProduct()
    {
//        throw new \yii\base\Exception(print_r($_POST, TRUE));
        $model = \common\models\costfit\Product::find()->where("productId=" . $_GET["id"])->one();
        if (isset($_POST["Product"])) {
            $model->attributes = $_POST["Product"];
            if ($model->save()) {

                return $this->redirect(['create', 'step' => 4, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->parentId]);
            }
        }

        return $this->render("101/_product_form", ['model' => $model]);
//        $model = new Proyecto;
//
//        if (isset($_POST['hasEditable'])) {
//
//            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//
//            if ($model->load($_POST)) {
//
//                if (isset($model->codigo))
//                    $value = $model->codigo;
//
//                return ['output' => $value, 'message' => ''];
//            }
//
//            else {
//
//                return ['output' => '', 'message' => ''];
//            }
//        }
//
//        return $this->render('view', ['model' => $model]);
    }

    public function actionDeleteProduct()
    {
//        throw new \yii\base\Exception(print_r($_POST, TRUE));
        $model = \common\models\costfit\Product::find()->where("productId=" . $_GET["id"])->one();
        \common\models\costfit\Product::deleteAll("productId=" . $_GET["id"]);
        return $this->redirect(['create', 'step' => 4, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->parentId]);
    }

    public function actionDeleteProductImage()
    {
        $model = \common\models\costfit\ProductImage::find()->where("productImageId = " . $_GET["id"])->one();
        $product = \common\models\costfit\Product::find()->where("productId=" . $model->productId)->one();
        if (\common\models\costfit\ProductImage::deleteAll("productImageId = " . $_GET["id"]) > 0) {
            if (isset($_GET["action"]) && $_GET["action"] == "update") {

                return $this->redirect(['update-product', 'id' => $model->productId, 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]);
            } else {
                return $this->redirect(['create', 'step' => $_GET["step"], 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => isset($product->parentId) ? $product->parentId : $product->productId]);
            }
        }
    }

    public function saveProductGroupStep($id, $step)
    {
        $product = \common\models\costfit\Product::find()->where("productId=" . $id)->one();
        $product->step = $step;
        $product->save();
    }

    public function actionApproveProductGroup($id)
    {
        $product = \common\models\costfit\Product::find()->where("productId=$id")->one();
        $product->status = 1;
        $product->save();

        return $this->redirect('index');
    }

    // Version 1.01 Wizard Of Product Group
}
