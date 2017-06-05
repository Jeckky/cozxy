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
        $categoryId = Yii::$app->request->get('categoryId');
        $brandId = Yii::$app->request->get('brandId');
        $status = Yii::$app->request->get('status');
        $title = Yii::$app->request->get('title');
//        $isOwner = Yii::$app->request->post('isOwner');
//User Type 4 = Supplier , 5= Content
        if (Yii::$app->user->identity->type == 4 || Yii::$app->user->identity->type == 5) {

            if (isset($_GET["supplier"])) {

                if (isset($categoryId) || isset($brandId) || isset($status) || isset($title)) {
                    $query = \common\models\costfit\Product::find()
                    ->join("LEFT JOIN", "user u", "u.userId = product.userId")
                    ->where("product.parentId is null AND u.type in (2, 3, 4, 5) AND product.status = 1")
                    ->andWhere("(SELECT COUNT(*) FROM product pc WHERE parentId = product.productId) > 0")
                    ->orderBy("product.updateDateTime DESC");
                }
            } else {
                $query = \common\models\costfit\Product::find()
                ->select("product.title,product.createDateTime,product.productId,product.status,product.userId,product.productGroupTemplateId,product.step")
                ->join("LEFT JOIN", "user u", "u.userId = product.userId")
                ->join("RIGHT JOIN", "product pc", "pc.parentId = product.productId")
                ->join("LEFT JOIN", "product_suppliers ps", "ps.productId = product.productId AND ps.userId = " . Yii::$app->user->id)
                ->where("product.parentId is null ")
                ->groupBy("product.productId")
                ->orderBy("product.updateDateTime DESC");
            }
        } else {
            $user_group_Id = Yii::$app->user->identity->user_group_Id;
            $userRe = str_replace('[', '', str_replace(']', '', $user_group_Id));
            $userEx = explode(',', $userRe);
            $ress = array_search(26, $userEx);
            if ($ress !== FALSE) {
                $query = \common\models\costfit\Product::find()
                ->where("parentId is null AND status = 99")
                ->orderBy("updateDateTime DESC");
            } else {
                $query = \common\models\costfit\Product::find()
                ->where("parentId is null AND userId = " . Yii::$app->user->identity->userId)
                ->orderBy("updateDateTime DESC");
            }
        }

        if (isset($categoryId) && !empty($categoryId)) {
            $query->andWhere("product.categoryId = $categoryId");
        }
        if (isset($brandId) && !empty($brandId)) {
            $query->andWhere("product.brandId = $brandId");
        }
        if (isset($status) && !empty($status)) {
            if ($status == -1) {
                $query->andWhere("product.status = 0");
            } else {
                $query->andWhere("product.status = $status");
            }
        }
        if (isset($title) && !empty($title)) {
            $query->andWhere("product.title LIKE '%$title%'");
        }
        if (isset($query)) {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }

        return $this->render('101/index', [
            'dataProvider' => isset($dataProvider) ? $dataProvider : NULL,
        ]);
    }

    /**
     * Displays a single ProductGroup model.
     * @param string $id
     * @return mixed
     */
    public function actionView()
    {
        $model = \common\models\costfit\Product::find()->where("productId = " . $_GET["productGroupId"])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => \common\models\costfit\Product::find()->orderBy("productId ASC")
            ->where("parentId = " . $_GET["productGroupId"]),
        ]);

        $dataProvider2 = new ActiveDataProvider([
            'query' => \common\models\costfit\ProductSuppliers::find()
            ->join("RIGHT JOIN", "product p", "p.productId = product_suppliers.productId")
            ->join("RIGHT JOIN", "product pg", "pg.productId = p.parentId")
            ->where("pg.productId = " . $_GET["productGroupId"] . " AND product_suppliers.userId = " . \Yii::$app->user->id)
            ->orderBy("productId ASC"),
        ]);
        return $this->render('101/view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
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
            $productGroup = ProductGroup::find()->where("title = '" . $_POST["ProductGroup"]["title"] . "' and status = 1")->one();
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
        $model = new \common\models\costfit\Product(['scenario' => 'create_pg']);
        switch ($step) {
            case 1:
                if (isset($_GET["productGroupId"])) {
                    $model = \common\models\costfit\Product::find()->where("productId = " . $_GET["productGroupId"])->one();
                    if (isset($model->step)) {
                        return $this->redirect(['create', 'step' => $model->step, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->productId]);
                    }
                }
                if (isset($_POST["Product"])) {
                    $model->attributes = $_POST["Product"];
                    $model->userId = $userId;
                    $model->createDateTime = new \yii\db\Expression('NOW()');
                    $model->approve = "new";
                    $model->parentId = NULL;
                    $model->status = 0;
                    if ($model->save(false)) {
                        $productGroupId = \Yii::$app->db->lastInsertID;
                        if ($productGroupId == 0) {
                            $productGroupId = $model->productId;
                        }
                        return $this->redirect(['create', 'step' => 2, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $productGroupId]);
                    }
                }
                break;
            case 2:
                $this->saveProductGroupStep($_GET["productGroupId"], 2);
                $model = \common\models\costfit\Product::find()->where("productId = " . $_GET["productGroupId"])->one();
                if (count($model->images) == 0) {
                    if (!empty(\common\models\costfit\Product::productSuppId($_GET["productGroupId"], \Yii::$app->user->id))) {
                        $prodSuppImages = \common\models\costfit\ProductImageSuppliers::find()->where("productSuppId = " . \common\models\costfit\Product::productSuppId($_GET["productGroupId"], \Yii::$app->user->id))->all();
                        foreach ($prodSuppImages as $img) {
                            $pImg = new \common\models\costfit\ProductImage();
                            $pImg->attributes = $img->attributes;
                            $pImg->productId = $_GET["productGroupId"];
                            $pImg->createDateTime = new \yii\db\Expression("NOW()");
                            $pImg->save();
                        }
                    }
                }
                if (isset($_POST["next"]))
                    return $this->redirect(['create', 'step' => 3, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]);
                break;
            case 3:
                $this->saveProductGroupStep($_GET["productGroupId"], 3);
                $productGroupTemplateOptions = \common\models\costfit\ProductGroupTemplateOption::find()->where("productGroupTemplateId = " . $_GET["productGroupTemplateId"])->all();
                foreach ($productGroupTemplateOptions as $pto) {
                    $pgo = \common\models\costfit\ProductGroupOption::find()->where("productGroupId = " . $_GET["productGroupId"] . ' AND productGroupTemplateOptionId=' . $pto->productGroupTemplateOptionId)->one();
                    if (isset($pgo)) {
                        continue;
                    } else {
                        $pgo = new \common\models\costfit\ProductGroupOption();
                    }

                    $pgo->productGroupId = $_GET["productGroupId"];
                    $pgo->productGroupTemplateOptionId = $pto->productGroupTemplateOptionId;
                    $pgo->name = $pto->title;
                    $pgo->createDateTime = new \yii\db\Expression("NOW()");
                    if (!$pgo->save()) {
                        throw new \yii\base\Exception(print_r($pgo->errors, TRUE));
                    }
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
                    ->where("parentId = " . $_GET["productGroupId"]),
                ]);
                break;
            case 5:// For Access direct link without get step parameter
//                return $this->redirect(['create', 'step' => 1]);
                $this->saveProductGroupStep($_GET["productGroupId"], 5);
                $model = \common\models\costfit\Product::find()->where("productId = " . $_GET["productGroupId"])->one();
                $countProduct = \common\models\costfit\Product::find()->where("parentId = " . $_GET["productGroupId"])->count();
                if (isset($_POST["finish"])) {
                    $model->status = 99;
                    $model->save();
                    return $this->redirect(['index']);
                }
                if (isset($_POST["saveDraft"])) {
                    $model->status = 0;
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
                    $optionStr.=", ";
                }
            }
            $productGroupOptionValues = \common\models\costfit\ProductGroupOptionValue::find()->where("productGroupId = $productGroupId AND productGroupOptionId in ($optionStr)")->all();
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
                foreach ($options as $productGroupTemplateOptionId => $value) {
//                    $productGroupOptionValue = \common\models\costfit\ProductGroupOptionValue::find()->where("productGroupId = $productGroupId AND productGroupOptionId = $productGroupOptionId")->one();
//                    if (isset($productGroupOptionValue)) {
//                        $countOption++;
//                        continue;
//                    } else {
                    $productGroupOptionValue = new \common\models\costfit\ProductGroupOptionValue();
//                    }
                    $productGroupOptionValue->productId = $productId;
                    $productGroupOptionValue->productGroupId = $productGroupId;
                    $productGroupOptionValue->productGroupTemplateOptionId = $productGroupTemplateOptionId;
                    $pgo = \common\models\costfit\ProductGroupOption::find()->where("productGroupId = $productGroupId AND productGroupTemplateOptionId = $productGroupTemplateOptionId")->one();
                    $productGroupOptionValue->productGroupOptionId = $pgo->productGroupOptionId;
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
            //$res[$productGroupTemplateOptionId] = explode(", ", $optionArray);
            $res[$productGroupTemplateOptionId] = $optionArray;
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
        ini_set('memory_limit', '1024M');

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
        $model = \common\models\costfit\Product::find()->where("productId = " . $_GET["id"])->one();

        $prodSupp = \common\models\costfit\ProductSuppliers::find()->where("productId = $model->productId AND userId = " . Yii::$app->user->id)->one();
        if (!isset($prodSupp)) {
            $prodSupp = new \common\models\costfit\ProductSuppliers();
        }
        if (isset($prodSupp) && !$prodSupp->isNewRecord) {
            $prodPriceSupp = \common\models\costfit\ProductPriceSuppliers::find()->where("productSuppId = $prodSupp->productSuppId")->one();
        }
        if (!isset($prodPriceSupp)) {
            $prodPriceSupp = new \common\models\costfit\ProductPriceSuppliers();
        }
        if (isset($_POST["Product"])) {
            $model->attributes = $_POST["Product"];
            if ($model->save()) {
                if (isset($_POST["ProductSuppliers"]["quantity"]) && !empty($_POST["ProductSuppliers"]["quantity"])) {
//                    throw new \yii\base\Exception;
                    $prodSupp->attributes = $model->attributes;
                    $prodSupp->productId = $model->productId;
                    $prodSupp->quantity = $_POST["ProductSuppliers"]["quantity"];
                    $prodSupp->result = $_POST["ProductSuppliers"]["quantity"];
                    $prodSupp->approve = 'new';
                    $prodSupp->createDateTime = new \yii\db\Expression("NOW()");

                    if ($prodSupp->save()) {
                        if (isset($_POST["ProductPriceSuppliers"]['price']))
                            \common\models\costfit\ProductPriceSuppliers::updateAll(['status' => 0], 'productSuppId = ' . $prodSupp->productSuppId);
                        $pps = new \common\models\costfit\ProductPriceSuppliers();
                        $pps->price = !empty($_POST["ProductPriceSuppliers"]['price']) ? $_POST["ProductPriceSuppliers"]['price'] : 0;
                        $pps->productSuppId = $prodSupp->productSuppId;
                        $pps->discountType = 1;
                        $pps->createDateTime = new \yii\db\Expression("NOW()");
                        $pps->save();

                        $productOptionValuess = \common\models\costfit\ProductGroupOptionValue::find()->where("productId = $model->productId AND productSuppId IS NULL")->all();
//                        throw new \yii\base\Exception(count($productOptionValues));
                        foreach ($productOptionValuess as $ov) {
                            $productOptionValues = \common\models\costfit\ProductGroupOptionValue::find()->where("productId = $model->productId AND productSuppId = $prodSupp->productSuppId AND productGroupTemplateOptionId = $ov->productGroupTemplateOptionId")->one();
                            if (!isset($productOptionValues)) {
                                $productOptionValues = new \common\models\costfit\ProductGroupOptionValue();
                            }
                            $productOptionValues->attributes = $ov->attributes;
                            $productOptionValues->productSuppId = $prodSupp->productSuppId;
                            $productOptionValues->productGroupTemplateOptionId = $ov->productGroupTemplateOptionId;
                            $productOptionValues->createDateTime = new \yii\db\Expression("NOW()");
                            $productOptionValues->updateDateTime = new \yii\db\Expression("NOW()");
                            if (!$productOptionValues->save()) {
                                throw new \yii\base\Exception(print_r($productOptionValues->errors, true));
                            }
                        }

                        $productImages = \common\models\costfit\ProductImage::find()->where("productId = $model->productId")->all();
                        \common\models\costfit\ProductImageSuppliers::deleteAll("productSuppId = $prodSupp->productSuppId");
                        foreach ($productImages as $pi) {
                            $psi = new \common\models\costfit\ProductImageSuppliers();
                            $psi->attributes = $pi->attributes;
                            $psi->productSuppId = $prodSupp->productSuppId;
                            $psi->createDateTime = new \yii\db\Expression("NOW()");
                            $psi->updateDateTime = new \yii\db\Expression("NOW()");
                            $psi->save();
                        }
                    } else {
                        throw new \yii\base\Exception(print_r($prodSupp->errors, true));
                    }
                }

                return $this->redirect(['create', 'step' => 4, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->parentId]);
            }
        }

        return $this->render("101/_product_form", ['model' => $model, 'prodPriceSupp' => $prodPriceSupp, 'prodSupp' => $prodSupp]);
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
        $model = \common\models\costfit\Product::find()->where("productId = " . $_GET["id"])->one();
        \common\models\costfit\ProductGroupOptionValue::deleteAll("productId = " . $_GET["id"]);
        \common\models\costfit\ProductImage::deleteAll("productId = " . $_GET["id"]);
        \common\models\costfit\Product::deleteAll("productId = " . $_GET["id"]);

        return $this->redirect(['create', 'step' => 4, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->parentId]);
    }

    public function actionDeleteProductGroup()
    {
//        throw new \yii\base\Exception(print_r($_POST, TRUE));
        $childs = \common\models\costfit\Product::find()->where("parentId = " . $_GET["id"])->all();
        foreach ($childs as $pg) {
            \common\models\costfit\ProductGroupOptionValue::deleteAll("productId = " . $pg->productId);
            \common\models\costfit\ProductImage::deleteAll("productId = " . $pg->productId);
            \common\models\costfit\Product::deleteAll("productId = " . $pg->productId);
        }
        \common\models\costfit\ProductGroupOptionValue::deleteAll("productId = " . $_GET["id"]);
        \common\models\costfit\ProductImage::deleteAll("productId = " . $_GET["id"]);
        \common\models\costfit\Product::deleteAll("productId = " . $_GET["id"]);

        return $this->redirect(['index']);
    }

    public function actionDeleteProductImage()
    {
        $model = \common\models\costfit\ProductImage::find()->where("productImageId = " . $_GET["id"])->one();
        $product = \common\models\costfit\Product::find()->where("productId = " . $model->productId)->one();
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
        $product = \common\models\costfit\Product::find()->where("productId = " . $id)->one();
        $product->step = $step;
        $product->save();
    }

    public function actionApproveProductGroup($id)
    {
        $product = \common\models\costfit\Product::find()->where("productId = $id")->one();
        $product->status = 1;
        $product->save();

        return $this->redirect('index');
    }

    public function actionChangeImageOrder()
    {
//            throw new \yii\base\Exception(print_r($_POST, TRUE));
        $model = \common\models\costfit\ProductImage::find()->where("productImageId = " . $_GET['id'])->one();
        if (isset($_POST["ProductImage"])) {
            $model->ordering = $_POST["ProductImage"]["ordering"];
            $model->save();

            return $this->redirect(['create', 'step' => $_GET["step"], 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]);
        }

        return $this->render("101/_product_image_form", ['model' => $model]);
    }

    public function actionBackToDraft($id)
    {
        $model = \common\models\costfit\Product::find()->where("productId = $id")->one();
        $model->status = 0;
        $model->save();

        return $this->redirect(['create', 'step' => 4, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->productId]);
    }

    // Version 1.01 Wizard Of Product Group
}
