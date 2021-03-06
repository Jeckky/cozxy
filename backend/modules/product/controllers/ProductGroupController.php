<?php

namespace backend\modules\product\controllers;

use common\models\costfit\ProductSuppliers;
use Yii;
use common\models\costfit\ProductGroup;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use beastbytes\wizard\WizardBehavior;
use common\helpers\Upload;
use common\models\costfit\ProductGroupTemplate;
use common\models\costfit\ProductGroupTemplateOption;
use common\models\costfit\ProductGroupOptionValue;
use common\models\costfit\ProductGroupOption;

/**
 * ProductGroupController implements the CRUD actions for ProductGroup model.
 */
class ProductGroupController extends ProductMasterController {

    public function behaviors() {
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
    public function actionIndex() {
        $categoryId = Yii::$app->request->get('categoryId');
        $brandId = Yii::$app->request->get('brandId');
        $status = Yii::$app->request->get('status');
        $title = Yii::$app->request->get('title');
//        $isOwner = Yii::$app->request->post('isOwner');
//User Type 4 = Supplier , 5= Content
//if (Yii::$app->user->identity->type == 4 || Yii::$app->user->identity->type == 5 || Yii::$app->user->id == 43) {
//if (Yii::$app->user->identity->type == 2 || Yii::$app->user->identity->type == 3 || Yii::$app->user->id == 43) {
        if (Yii::$app->user->id != 36 || Yii::$app->user->id == 43) {

            if (isset($_GET["supplier"]) && $_GET["supplier"] != '') {

                if (isset($categoryId) || isset($brandId) || isset($status) || isset($title)) {
                    $query = \common\models\costfit\Product::find()
                            ->join("LEFT JOIN", "user u", "u.userId = product.userId")
                            ->where("product.parentId is null AND u.type in (2, 3, 4, 5) AND product.status = 1")
//                    ->andWhere("(SELECT COUNT(*) FROM product pc WHERE parentId = product.productId) > 0")
                            ->orderBy("product.createDateTime DESC");
                }
            } else {

                $query = \common\models\costfit\Product::find()
                        ->select("product.title,product.createDateTime,product.productId as productTempId,product.status,ps.userId ,product.productGroupTemplateId,product.step,ps.productSuppId,ps.userId as productSuppUserId")
                        ->join("LEFT JOIN", "user u", "u.userId = product.userId")
                        ->join("LEFT JOIN", "product pc", "pc.parentId = product.productId")
                        ->join("LEFT JOIN", "product_suppliers ps", "ps.productId = pc.productId ")
                        ->where("product.parentId is null ")
//                ->andWhere("1 =  (case when ps.productSuppId IS NULL  then (CASE WHEN (product.status = 99 || product.status = 0) THEN 1 AND product.userId = " . Yii::$app->user->id . " ELSE 0 END) else (CASE WHEN ps.status = 99 THEN 1 AND ps.userId = " . Yii::$app->user->id . " ELSE 0 END) end)")
                        ->andWhere("1 =  (case when ps.productSuppId IS NULL  then  1 AND product.userId = " . Yii::$app->user->id . " else  1 AND ps.userId = " . Yii::$app->user->id . " end)")
                        ->groupBy("product.productId")
                        ->orderBy("product.createDateTime DESC");
            }
        } else {
            $user_group_Id = Yii::$app->user->identity->user_group_Id;
            $userRe = str_replace('[', '', str_replace(']', '', $user_group_Id));
            $userEx = explode(',', $userRe);
            $ress = array_search(26, $userEx);
            $rss = \common\helpers\menuBackend::getMenuRbac();
            //echo '<pre>';
            //print_r($rss[0]);
            //exit();
            if ($ress !== FALSE) {
                if (!isset($_GET["supplier"]) || $_GET["supplier"] == '') {
                    /* $query = \common\models\costfit\Product::find()
                      ->select("product.title,product.createDateTime,product.productId as productTempId,product.status,product.productGroupTemplateId,product.step,ps.productSuppId,ps.userId as productSuppUserId")
                      ->join("LEFT JOIN", "product pc", "pc.parentId = product.productId")
                      ->join("LEFT JOIN", "product_suppliers ps", "ps.productId = pc.productId ")
                      ->where("product.parentId is null  AND 1 =  (case when ps.productSuppId IS NULL  then (CASE WHEN product.status = 99 THEN 1 ELSE 0 END) else (CASE WHEN ps.status = 99 THEN 1 ELSE 0 END) end)")
                      //                ->where("product.parentId is null  ")
                      ->groupBy("ps.userId , pc.parentId")
                      ->orderBy("product.createDateTime DESC"); */
                    $query = \common\models\costfit\Product::find()
                            ->join("LEFT JOIN", "product pc", "pc.parentId = product.productId")
                            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId = pc.productId ")
                            ->where("product.parentId is null  AND 1 =  (case when ps.productSuppId IS NULL  then (CASE WHEN product.status = 99 THEN 1 ELSE 0 END) else (CASE WHEN ps.status = 99 THEN 1 ELSE 0 END) end)")
//                ->where("product.parentId is null  ")
                            ->groupBy("ps.userId , pc.parentId")
                            ->orderBy("product.createDateTime DESC");
                } else {
                    if (isset($categoryId) || isset($brandId) || isset($status) || isset($title)) {
                        $query = \common\models\costfit\Product::find()
                                ->join("LEFT JOIN", "user u", "u.userId = product.userId")
                                ->where("product.parentId is null AND u.type in (2, 3, 4, 5) AND product.status = 1")
//                    ->andWhere("(SELECT COUNT(*) FROM product pc WHERE parentId = product.productId) > 0")
                                ->orderBy("product.createDateTime DESC");
                    }
                }
            } else {

                $query = \common\models\costfit\Product::find()
                                ->where("parentId is null AND userId = " . Yii::$app->user->identity->userId)
                                ->orderBy("createDateTime DESC")->all();
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
            $query->addOrderBy('product.createDateTime DESC');
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
    public function actionView() {
        $model = \common\models\costfit\Product::find()->where("productId = " . $_GET["productGroupId"])->one();
        if (isset($_GET["userId"])) {
            $userId = $_GET["userId"];
            if ($userId == 0) {
                $isMaster = TRUE;
            } else {
                $isMaster = FALSE;
            }
        } else {
            $userId = \Yii::$app->user->id;
            $isMaster = FALSE;
        }
        $dataProvider = new ActiveDataProvider([
            'query' => \common\models\costfit\Product::find()->orderBy("createDateTime DESC")
                    ->where("parentId = " . $_GET["productGroupId"]),
        ]);

        $dataProvider2 = new ActiveDataProvider([
            'query' => \common\models\costfit\ProductSuppliers::find()
                    ->join("RIGHT JOIN", "product p", "p.productId = product_suppliers.productId")
                    ->join("RIGHT JOIN", "product pg", "pg.productId = p.parentId")
                    ->where("pg.productId = " . $_GET["productGroupId"] . " AND product_suppliers.userId = " . $userId)
                    ->orderBy("createDateTime DESC"),
        ]);
        return $this->render('101/view', [
                    'model' => $model,
                    'dataProvider' => $dataProvider,
                    'dataProvider2' => $dataProvider2,
                    'userId' => $userId,
                    'isMaster' => $isMaster,
                    'productGroupId' => $_GET["productGroupId"],
                    'templateId' => $_GET["productGroupTemplateId"]
        ]);
    }

    /**
     * Creates a new ProductGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateOld() {
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
    public function actionUpdate($id) {
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
    public function actionDelete($id) {
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
    protected function findModel($id) {
        if (($model = ProductGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

// Version 1.01 Wizard Of Product Group

    public function actionCreate($step = null) {
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
//User Type 4 = Supplier , 5= Content
//                    if (Yii::$app->user->identity->type == 4) {
//                        return $this->redirect(['create', 'step' => 3, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->productId]);
//                    } else {
                    if ($model->step) {
                        if ($model->step != 1) {
                            return $this->redirect(['create',
                                        'step' => $model->step,
                                        'productGroupTemplateId' => $model->productGroupTemplateId,
                                        //'productGroupId' => $_GET["productGroupId"]
                                        'productGroupId' => $model->productId
                            ]);
                        }
                    }
//                    }
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
                        return $this->redirect(['create',
                                    'step' => 2,
                                    'productGroupTemplateId' => $model->productGroupTemplateId,
                                    'productGroupId' => $productGroupId
                        ]);
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
                if (isset($_GET["productGroupTemplateId"])) {
                    $productGroupTemplateOptions = ProductGroupTemplateOption::find()->where("productGroupTemplateId = " . $_GET["productGroupTemplateId"])->all();
                    foreach ($productGroupTemplateOptions as $pto) {
                        $pgo = ProductGroupOption::find()->where("productGroupId = " . $_GET["productGroupId"] . ' AND productGroupTemplateOptionId = ' . $pto->productGroupTemplateOptionId)->one();
                        if (isset($pgo)) {
                            continue;
                        } else {
                            $pgo = new ProductGroupOption();
                        }

                        $pgo->productGroupId = $_GET["productGroupId"];
                        $pgo->productGroupTemplateOptionId = $pto->productGroupTemplateOptionId;
                        $pgo->name = $pto->title;
                        $pgo->createDateTime = new \yii\db\Expression("NOW()");
                        if (!$pgo->save()) {
                            throw new \yii\base\Exception(print_r($pgo->errors, TRUE));
                        }
                    }
                } else {
                    $this->saveProductGroupStep($_GET["productGroupId"], 1);
                    return $this->redirect(['create', 'step' => 1, 'productGroupId' => $_GET["productGroupId"]]);
                }
                if (isset($_POST["ProductGroupOptionValue"])) {
                    $this->saveProductsWithOption($_POST["ProductGroupOptionValue"], $_GET["productGroupId"]);
                    return $this->redirect(['create', 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]);
                }
                break;
            case 4:

                $this->saveProductGroupStep($_GET["productGroupId"], 4);
                if (isset($_POST["next"])) {

                    return $this->redirect(['create',
                                'step' => 5,
                                'productGroupTemplateId' => $_GET["productGroupTemplateId"],
                                'productGroupId' => $_GET["productGroupId"]]);
                }
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
                break;
            case 5:// For Access direct link without get step parameter
//                return $this->redirect(['create', 'step' => 1]);
                $this->saveProductGroupStep($_GET["productGroupId"], 5);
                $model = \common\models\costfit\Product::find()->where("productId = " . $_GET["productGroupId"])->one();
                $countProduct = \common\models\costfit\Product::find()->where("parentId = " . $_GET["productGroupId"])->count();
                if (isset($_POST["finish"])) {
                    if ($model->status != 1) {
                        $model->status = 99;
                        $model->save();
                        foreach ($model->products as $product) {
                            $productSupp = \common\models\costfit\ProductSuppliers::find()->where("productId = $product->productId AND userId = " . \Yii::$app->user->id)->one();
                            if (isset($productSupp)) {
                                $productSupp->status = 99;
                                $productSupp->save();
                            }
                        }
                    }
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
                    'dataProvider2' => isset($dataProvider2) ? $dataProvider2 : NULL,
                    'gridColumns' => isset($gridColumns) ? $gridColumns : NULL,
                    'countProduct' => isset($countProduct) ? $countProduct : NULL,
                    'productGroupId' => isset($_GET["productGroupId"]) ? $_GET["productGroupId"] : NULL,
                    'productGroupTemplateId' => isset($_GET["productGroupTemplateId"]) ? $_GET["productGroupTemplateId"] : NULL,
        ]);
    }

    public function actionDraft() {
        $drafts = new ActiveDataProvider([
            'query' => \common\models\costfit\Product::find()->where("userId = $userId AND parentId IS NULL AND status = 99"),
        ]);
        return $this->render(["101/draft", "drafts" => $drafts]);
    }

    public function saveProductsWithOption($options, $productGroupId) {
        $res = $this->prepareOptionArray($options);
        $productGroup = \common\models\costfit\Product::find()->where("productId = $productGroupId")->one();
        $productGroupImages = \common\models\costfit\ProductImage::find()->where("productId = $productGroupId")->all();
//        throw new \yii\base\Exception(print_r($productGroup->attributes, true));

        foreach ($res as $options) {
            $optionStr = "";
            $oCount = 1;
            foreach ($options as $productGroupOptionId => $value) {
                $optionStr .= $productGroupOptionId;
                $oCount++;
                if ($oCount < count($options)) {
                    $optionStr .= ", ";
                }
            }
            $productGroupOptionValues = ProductGroupOptionValue::find()->where("productGroupId = $productGroupId AND productGroupOptionId in ($optionStr)")->all();
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
                    $productGroupOptionValue = new ProductGroupOptionValue();
//                    }
                    $productGroupOptionValue->productId = $productId;
                    $productGroupOptionValue->productGroupId = $productGroupId;
                    $productGroupOptionValue->productGroupTemplateOptionId = $productGroupTemplateOptionId;
                    $pgo = ProductGroupOption::find()->where("productGroupId = $productGroupId AND productGroupTemplateOptionId = $productGroupTemplateOptionId")->one();
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

    public function prepareOptionArray($options) {
        $res = [];
        foreach ($options as $productGroupTemplateOptionId => $optionArray) {
//$res[$productGroupTemplateOptionId] = explode(", ", $optionArray);
            $res[$productGroupTemplateOptionId] = $optionArray;
        }
        return $this->array_cartesian($res); // 2D array
    }

    function array_cartesian($arrays) {
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

    public function actionUpload() {
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

    public function actionUploadSupplier() {
        ini_set('memory_limit', '1024M');

//$model = new \common\models\costfit\productImageSuppliers();

        $model = new \common\models\costfit\ProductImageSuppliers();
        $model->productSuppId = $_GET["id"];
        /*
         * helpers Upload
         * path : common/helpers/Upload.php
         * use : Upload::UploadSuppliers($model)
         * กรณีพิเศษ
         */
        \common\helpers\Upload::UploadSuppliers($model);
//
    }

    public function actionUpdateGridEdit() {
        if (!isset($_POST["type"]) || $_POST["type"] == 1) {
            $model = \common\models\costfit\Product::find()->where("productId = " . $_POST["productId"])->one();
            if (isset($_POST["Product"])) {
                $model->attributes = $_POST["Product"];
                $model->save();
            }
        } else {
            $model = \common\models\costfit\ProductSuppliers::find()->where("productSuppId = " . $_POST["productId"])->one();
            if (isset($_POST["ProductSuppliers"])) {
                $model->attributes = $_POST["ProductSuppliers"];


                if (isset($_POST["ProductSuppliers"]["quantity"])) {
                    $model->quantity = $_POST["ProductSuppliers"]["quantity"];
                    $model->result = $model->quantity;
                }

                if (isset($_POST["ProductPriceSuppliers"])) {
                    \common\models\costfit\ProductPriceSuppliers::updateAll(['status' => 0], "productSuppId = " . $_POST["productId"]);
                    $price = new \common\models\costfit\ProductPriceSuppliers();
                    $price->productSuppId = $_POST["productId"];
                    $price->price = $_POST["ProductPriceSuppliers"]["price"];
                    $price->discountType = 1;
                    $price->createDateTime = new yii\db\Expression("NOW()");
                    $price->save();
                }

                $model->save();
            }
        }


        return $this->renderAjax('101/_product_grid_form', [
                    'model' => $model,
                    'id' => $_POST["productId"],
                    'gridId' => isset($_POST['gridId']) ? $_POST['gridId'] : NULL,
                    'type' => isset($_POST['type']) ? $_POST['type'] : NULL
        ]);
    }

    public function actionUpdateProduct() {
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
            \common\models\costfit\CategoryToProduct::saveCategoryToProduct($model->categoryId, $model->productId);
            $this->saveBrandToParent($_POST["Product"]["brandId"], $_GET["id"]); //เมื่อมีการแก้ไข แบรนด์ที่ตัวลูก ตัวแม่เปลี่ยนด้วย เดิมไม่เปลี่ยน // edit by sak
            if (isset($_POST["Product"]["isbn"]) && !empty($_POST["Product"]["isbn"])) {
                \common\models\costfit\Product::saveProductIsbn($model->productId, $_POST["Product"]["isbn"]); //save
            }
            if ($model->save()) {
                if (isset($_POST["ProductSuppliers"]["quantity"]) && !empty($_POST["ProductSuppliers"]["quantity"])) {
//                    throw new \yii\base\Exception;
                    $prodSupp->attributes = $model->attributes;
                    $prodSupp->productId = $model->productId;
                    $prodSupp->quantity = $_POST["ProductSuppliers"]["quantity"];
                    $prodSupp->result = $prodSupp->result + $_POST["ProductSuppliers"]["quantity"];
                    $prodSupp->approve = 'new';
                    $prodSupp->createDateTime = new \yii\db\Expression("NOW()");
                    if ($prodSupp->save(FALSE)) {
                        if (isset($_POST["ProductPriceSuppliers"]['price'])) {
                            \common\models\costfit\ProductPriceSuppliers::updateAll(['status' => 0], 'productSuppId = ' . $prodSupp->productSuppId);
                            $pps = new \common\models\costfit\ProductPriceSuppliers();
                            $pps->price = !empty($_POST["ProductPriceSuppliers"]['price']) ? $_POST["ProductPriceSuppliers"]['price'] : 0;
                            $pps->productSuppId = $prodSupp->productSuppId;
                            $pps->discountType = 1;
                            $pps->createDateTime = new \yii\db\Expression("NOW()");
                            $pps->save();
                        }

                        $productOptionValuess = ProductGroupOptionValue::find()->where("productId = $model->productId AND productSuppId IS NULL")->all();
//                        throw new \yii\base\Exception(count($productOptionValues));
                        foreach ($productOptionValuess as $ov) {
                            $productOptionValues = ProductGroupOptionValue::find()->where("productId = $model->productId AND productSuppId = $prodSupp->productSuppId AND productGroupTemplateOptionId = $ov->productGroupTemplateOptionId")->one();
                            if (!isset($productOptionValues)) {
                                $productOptionValues = new ProductGroupOptionValue();
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
//throw new \yii\base\Exception($_POST["productGroupTemplateId"]);
                return $this->redirect(['view',
                            'step' => 4,
                            'productGroupTemplateId' => $_POST["productGroupTemplateId"],
                            'productGroupId' => $model->parentId,
                            'tab' => 1
                ]);
            }
        }
//throw new \yii\base\Exception($model->productGroupTemplateId);
        return $this->render("101/_product_form", [
                    'model' => $model,
                    'prodPriceSupp' => $prodPriceSupp,
                    'prodSupp' => $prodSupp,
                    'productGroupId' => $model->parentId,
                    'productGroupTemplateId' => $_GET["productGroupTemplateId"],
        ]);
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

    public function actionMultipleDeleteProduct() {
        $pk = Yii::$app->request->post('row_id');
        $productGroupId = Yii::$app->request->post('productGroupId');
        $productGroupTemplateId = Yii::$app->request->post('productGroupTemplateId');
        $model = NULL;
        $tab = 1;
        if (count($pk) > 0) {
            foreach ($pk as $key => $value) {
                if (!isset($_POST["type"]) || empty($_POST["type"]) || $_POST["type"] == 1) {
                    if (!isset($model)) {
                        $model = \common\models\costfit\Product::find()->where("productId = " . $value)->one();
                    }
                    ProductGroupOptionValue::deleteAll("productId = " . $value);
                    \common\models\costfit\ProductImage::deleteAll("productId = " . $value);
                    \common\models\costfit\ProductSuppliers::deleteAll("productId = " . $value);
                    \common\models\costfit\Product::deleteAll("productId = " . $value);
                } else {
                    $model = \common\models\costfit\ProductSuppliers::find()->where("productSuppId = " . $value)->one();
                    ProductGroupOptionValue::deleteAll("productSuppId = " . $value);
                    \common\models\costfit\ProductImageSuppliers::deleteAll("productSuppId = " . $value);
                    \common\models\costfit\ProductSuppliers::deleteAll("productSuppId = " . $value);
                    $tab = 2;
                }
            }
        }

        return $this->redirect(['view',
                    'step' => 4,
                    'productGroupTemplateId' => $productGroupTemplateId,
                    'userId' => Yii::$app->user->id,
                    'productGroupId' => $productGroupId,
                    'tab' => $tab
        ]);
    }

    public function actionDeleteProduct() {
//        throw new \yii\base\Exception(print_r($_POST, TRUE));
        $model = \common\models\costfit\Product::find()->where("productId = " . $_GET["id"])->one();
        ProductGroupOptionValue::deleteAll("productId = " . $_GET["id"]);
        \common\models\costfit\ProductImage::deleteAll("productId = " . $_GET["id"]);
        \common\models\costfit\ProductSuppliers::deleteAll("productId = " . $_GET["id"]);
        \common\models\costfit\Product::deleteAll("productId = " . $_GET["id"]);

        return $this->redirect(['create', 'step' => 4, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->parentId]);
    }

    public function actionDeleteProductGroup() {
//throw new \yii\base\Exception(print_r($_GET["id"]));
//throw new \yii\base\Exception(print_r(Yii::$app->request->get(), true));
        $childs = \common\models\costfit\Product::find()->where("parentId = " . $_GET["id"])->all();
        foreach ($childs as $pg) {
            ProductGroupOptionValue::deleteAll("productId = " . $pg->productId);
            \common\models\costfit\ProductImage::deleteAll("productId = " . $pg->productId);
            \common\models\costfit\Product::deleteAll("productId = " . $pg->productId);
//            \common\models\costfit\ProductGroupOption::deleteAll("productGroupId = " . $pg->productId);
        }
        ProductGroupOptionValue::deleteAll("productId = " . Yii::$app->request->get('id'));
        \common\models\costfit\ProductImage::deleteAll("productId = " . Yii::$app->request->get('id'));
        ProductGroupOption::deleteAll("productGroupId = " . Yii::$app->request->get('id'));
        \common\models\costfit\Product::deleteAll("productId = " . Yii::$app->request->get('id'));


        return $this->redirect(['index',
                    'brandId' => isset($_GET["brandId"]) ? $_GET["brandId"] : '',
                    'categoryId' => isset($_GET["categoryId"]) ? $_GET["categoryId"] : '',
                    'title' => isset($_GET["title"]) ? $_GET["title"] : '',
                    'supplier' => isset($_GET["supplier"]) ? $_GET["supplier"] : '',
                    'status' => isset($_GET["status"]) ? $_GET["status"] : '',
        ]);
    }

    public function actionDeleteProductImage() {
        $model = \common\models\costfit\ProductImage::find()->where("productImageId = " . $_GET["id"])->one();
        $product = \common\models\costfit\Product::find()->where("productId = " . $model->productId)->one();
        if (\common\models\costfit\ProductImage::deleteAll("productImageId = " . $_GET["id"]) > 0) {
            if (isset($_GET["action"]) && $_GET["action"] == "update") {
                return $this->redirect(['update-product',
                            'id' => $model->productId,
                            'step' => 4,
                            'productGroupTemplateId' => $_GET["productGroupTemplateId"],
                            'productGroupId' => $_GET["productGroupId"]]);
            } else {
                return $this->redirect(['create',
                            'step' => $_GET["step"],
                            'productGroupTemplateId' => $_GET["productGroupTemplateId"],
                            'productGroupId' => isset($product->parentId) ? $product->parentId : $product->productId]);
            }
        }
    }

    public function actionDeleteProductSuppImage() {
        $model = \common\models\costfit\ProductImageSuppliers::find()->where("productImageId = " . $_GET["id"])->one();
        $product = \common\models\costfit\Product::find()->where("productId = " . $model->productSupp->productId)->one();
        if (\common\models\costfit\ProductImageSuppliers::deleteAll("productImageId = " . $_GET["id"]) > 0) {
            if (isset($_GET["action"]) && $_GET["action"] == "update") {
                return $this->redirect(['update-product', 'id' => $model->productId, 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]);
            } else if (isset($_GET["action"]) && $_GET["action"] == "delete") {
                return $this->redirect(['update-product-supp',
                            'id' => $_GET['productSuppId'],
                            'step' => $_GET["step"],
                            'productGroupTemplateId' => $_GET["productGroupTemplateId"],
                            'productGroupId' => $_GET["productGroupId"],
                ]);
            } else {
                return $this->redirect(['create', 'step' => $_GET["step"], 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => isset($product->parentId) ? $product->parentId : $product->productId, 'tab' => 2]);
            }
        }
    }

    public function saveProductGroupStep($id, $step) {
        $product = \common\models\costfit\Product::find()->where("productId = " . $id)->one();
        $product->step = $step;
        $product->save();
    }

    public function actionApproveProductGroup($id) {
        $product = \common\models\costfit\Product::find()->where("productId = $id")->one();
        $product->status = 1;
        $product->save();

        return $this->redirect('index');
    }

    public function actionChangeImageOrder() {
//            throw new \yii\base\Exception(print_r($_POST, TRUE));
        $model = \common\models\costfit\ProductImage::find()->where("productImageId = " . $_GET['id'])->one();
        if (isset($_POST["ProductImage"])) {
            $model->ordering = $_POST["ProductImage"]["ordering"];
            $model->save();

            return $this->redirect(['create', 'step' => $_GET["step"], 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]);
        }

        return $this->render("101/_product_image_form", ['model' => $model]);
    }

    public function actionChangeImageSuppOrder() {
//            throw new \yii\base\Exception(print_r($_POST, TRUE));
        $model = \common\models\costfit\ProductImageSuppliers::find()->where("productImageId = " . $_GET['id'])->one();
        if (isset($_POST["ProductImageSuppliers"])) {
            $model->ordering = $_POST["ProductImageSuppliers"]["ordering"];
            $model->save();

            return $this->redirect(['create', 'step' => $_GET["step"], 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"], 'tab' => 2]);
        }

        return $this->render("101/_product_image_form", ['model' => $model]);
    }

    public function actionBackToDraft($id) {
        $model = \common\models\costfit\Product::find()->where("productId = $id")->one();
        $model->status = 0;
        $model->save();

        return $this->redirect(['create', 'step' => 4, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->productId]);
    }

    public function actionCreateMyProduct() {
        $model = \common\models\costfit\Product::find()->where("productId = " . $_GET["productGroupId"])->one();
//        throw new \yii\base\Exception(count($model->products));
        foreach ($model->products as $product) {
            $ps = \common\models\costfit\ProductSuppliers::find()->where("productId = $product->productId AND userId = " . \Yii::$app->user->id)->one();
            if (!isset($ps)) {
                $ps = new \common\models\costfit\ProductSuppliers();
            }
            $ps->attributes = $product->attributes;
            $ps->productId = $product->productId;
            $ps->userId = \Yii::$app->user->id;
            $ps->approve = 'new';
//$ps->code = \common\helpers\Product::generateProductCode();
            $ps->status = 0;
            $ps->createDateTime = new \yii\db\Expression("NOW()");
            if ($ps->save(FALSE)) {
                \common\models\costfit\ProductImageSuppliers::deleteAll("productSuppId = " . $ps->productSuppId);
                foreach ($product->productImages as $k => $image) {
                    $pi = new \common\models\costfit\ProductImageSuppliers();
                    $pi->attributes = $image->attributes;
                    $pi->productSuppId = $ps->productSuppId;
                    $pi->createDateTime = new \yii\db\Expression("NOW()");
                    if (!isset($image->ordering)) {
                        $pi->ordering = $k + 1;
                    }
                    if ($pi->save(FALSE)) {

                    }
                }

                $povs = ProductGroupOptionValue::find()->where("productId = $product->productId AND productSuppId IS NULL")->all();
                foreach ($povs as $pov) {
                    $psov = new ProductGroupOptionValue();
                    $psov->attributes = $pov->attributes;
                    $psov->productSuppId = $ps->productSuppId;
                    $psov->createDateTime = new \yii\db\Expression("NOW()");
                    $psov->save(FALSE);
                }
            } else {
                throw new \yii\base\Exception(print_r($ps->errors, TRUE));
            }
        }
        if (isset($_GET["step"]) && $_GET["step"] == 4) {
            return $this->redirect(["create",
                        "step" => 4,
                        'productGroupTemplateId' => $model->productGroupTemplateId,
                        'productGroupId' => $_GET["productGroupId"],
                        'tab' => 2
            ]);
        } else {
//throw new \yii\base\Exception($_GET["productGroupId"]);
            return $this->redirect(["view",
                        "step" => $model->step,
                        "productGroupId" => $_GET["productGroupId"],
                        'productGroupTemplateId' => $model->productGroupTemplateId,
                        'tab' => 2
            ]);
        }
    }

    public function actionSendApproveMyProduct() {
        $model = \common\models\costfit\Product::find()->where("productId = " . $_GET["productGroupId"])->one();
//        throw new \yii\base\Exception(count($model->products));
        foreach ($model->products as $product) {
            $product->status = 99;
            $product->save();
            $ps = \common\models\costfit\ProductSuppliers::find()->where("productId = $product->productId AND userId = " . \Yii::$app->user->id . " AND status = 0")->one();
            if (isset($ps)) {
                $ps->userId = \Yii::$app->user->id;
                $ps->approve = 'new';
                $ps->status = 99;
                if ($ps->save(FALSE)) {

                } else {
                    throw new \yii\base\Exception(print_r($ps->errors, TRUE));
                }
            }
        }

        return $this->redirect(["view", "step" => $model->step, "productGroupId" => $_GET["productGroupId"], 'productGroupTemplateId' => $model->productGroupTemplateId, 'userId' => $_GET["userId"]]);
    }

    public function actionApproveMyProduct() {
        $model = \common\models\costfit\Product::find()->where("productId = " . $_GET["productGroupId"])->one();
        $model->status = 1;
        $model->approve = 'approve';
        $model->save();
//        throw new \yii\base\Exception(count($model->products));
        foreach ($model->products as $product) {
            \common\models\costfit\CategoryToProduct::saveCategoryToProduct($product->categoryId, $product->productId);
            $product->status = 1;
            $product->approve = 'approve';
            $product->save();
            if (isset($_GET["userId"]) && $_GET["userId"] != 0) {
                $ps = \common\models\costfit\ProductSuppliers::find()->where("productId = $product->productId AND userId = " . $_GET["userId"] . " AND status = 99")->one();
                if (isset($ps)) {
//                    $ps->userId = \Yii::$app->user->id;
                    $ps->approve = 'approve';
                    $ps->code = \common\helpers\Product::generateProductCode();
                    $ps->approvecreateDateTime = new \yii\db\Expression("NOW()");
                    $ps->status = 1;
                    if ($ps->save(FALSE)) {

                    } else {
                        throw new \yii\base\Exception(print_r($ps->errors, TRUE));
                    }
                }
            }
        }

//        return $this->redirect(["view", "productGroupId" => $_GET["productGroupId"], 'userId' => $_GET["userId"], 'productGroupTemplateId' => $model->productGroupTemplateId, 'step' => $model->step]);
        return $this->redirect(['index']);
    }

    public function actionUpdateAllCategoryProduct() {
        Yii::$app->db->createCommand()->truncateTable('category_to_product')->execute();
        $models = \common\models\costfit\Product::find()
                        ->where("status = 1")->all();
        foreach ($models as $model) {
            \common\models\costfit\CategoryToProduct::saveCategoryToProduct($model->categoryId, $model->productId);
        }
    }

    public function actionDeleteProductSupp() {

        $model = \common\models\costfit\ProductSuppliers::find()->where("productSuppId = " . $_GET["id"])->one();
        $productGroupId = $model->product->parentId;
        $productGroupTemplateId = $model->product->productGroupTemplateId;
        $step = $model->product->step;
//throw new \yii\base\Exception($model->productId);
        $userId = $model->userId;
        ProductGroupOptionValue::deleteAll("productSuppId = " . $_GET["id"]);
        \common\models\costfit\ProductImageSuppliers::deleteAll("productSuppId = " . $_GET["id"]);
        \common\models\costfit\ProductSuppliers::deleteAll("productSuppId = " . $_GET["id"]);

        if (isset($_GET["step"])) {
            return $this->redirect(['create',
                        'step' => 4,
                        'productGroupTemplateId' => $productGroupTemplateId,
                        'productGroupId' => $productGroupId,
                        'tab' => 2
            ]);
        } else {
            return $this->redirect(["view",
                        'step' => 4,
                        "productGroupId" => $productGroupId,
                        'productGroupTemplateId' => $productGroupTemplateId,
                        'userId' => isset($_GET["userId"]) ? $_GET["userId"] : $userId,
                        'tab' => 2
            ]);
        }
    }

    public function actionUpdateProductSupp() {
        $model = \common\models\costfit\ProductSuppliers::find()->where("productSuppId=" . $_GET["id"])->one();
        $prodPriceSupp = \common\models\costfit\ProductPriceSuppliers::find()->where("productSuppId=" . $_GET["id"] . " AND status = 1")->one();
        if (!isset($prodPriceSupp)) {
            $prodPriceSupp = new \common\models\costfit\ProductPriceSuppliers();
        }

        if (isset($_POST["ProductSuppliers"])) {
            $model->attributes = $_POST["ProductSuppliers"];
            $model->result = $model->result + $model->quantity;
            if ($model->save()) {
                if (isset($_POST["ProductPriceSuppliers"]["price"])) {
                    \common\models\costfit\ProductPriceSuppliers::updateAll(['status' => 0], "productSuppId=" . $_GET["id"]);
                    $prodPriceSupp = new \common\models\costfit\ProductPriceSuppliers();
                    $prodPriceSupp->price = $_POST["ProductPriceSuppliers"]["price"];
                    $prodPriceSupp->productSuppId = $_GET["id"];
                    $prodPriceSupp->createDateTime = new \yii\db\Expression("NOW()");
                    $prodPriceSupp->discountType = 1;
                    $prodPriceSupp->save();
                }

                if (isset($_GET["step"]) && $_GET["step"] == "view") {
                    return $this->redirect(['view',
                                'productGroupId' => $model->product->parentId,
                                'userId' => isset($_GET["userId"]) ? $_GET["userId"] : NULL,
                                'productGroupTemplateId' => $model->product->productGroupTemplateId,
                                'productGroupId' => $model->product->parentId,
                                'tab' => 2,
                                'step' => 4
                    ]);
                } else {
                    return $this->redirect(['create',
                                'step' => 4,
                                'productGroupTemplateId' => $model->product->productGroupTemplateId,
                                'productGroupId' => $model->product->parentId,
                                'tab' => 2
                    ]);
                }
            }
        }

//        throw new \yii\base\Exception(print_r($_POST, TRUE));
        return $this->render("101/supplier/_product_supp_form", ['model' => $model,
                    'prodPriceSupp' => $prodPriceSupp,
                    'productGroupTemplateId' => $_GET["productGroupTemplateId"],
        ]);
    }

    public function actionMultipleDelete() {
// throw new \yii\base\Exception(print_r($_GET['selection'], true));
        if (isset($_GET['selection']) && count($_GET['selection']) > 0) {

            foreach ($_GET['selection'] as $productId):
                $childs = \common\models\costfit\Product::find()->where("parentId = " . $productId)->all();
                foreach ($childs as $pg) {
                    ProductGroupOptionValue::deleteAll("productId = " . $pg->productId);
                    \common\models\costfit\ProductImage::deleteAll("productId = " . $pg->productId);
                    \common\models\costfit\Product::deleteAll("productId = " . $pg->productId);
//            \common\models\costfit\ProductGroupOption::deleteAll("productGroupId = " . $pg->productId);
                }
                ProductGroupOptionValue::deleteAll("productId = " . $productId);
                \common\models\costfit\ProductImage::deleteAll("productId = " . $productId);
                ProductGroupOption::deleteAll("productGroupId = " . $productId);
                \common\models\costfit\Product::deleteAll("productId = " . $productId);
            endforeach;
        }
        return $this->redirect(['index',
                    'brandId' => isset($_GET["brandId"]) ? $_GET["brandId"] : '',
                    'categoryId' => isset($_GET["categoryId"]) ? $_GET["categoryId"] : '',
                    'title' => isset($_GET["title"]) ? $_GET["title"] : '',
                    'supplier' => isset($_GET["supplier"]) ? $_GET["supplier"] : '',
                    'status' => isset($_GET["status"]) ? $_GET["status"] : ''
        ]);
        /* if (isset($_GET['selection']) && count($_GET['selection']) > 0) {
          foreach ($_GET['selection'] as $productId):
          $products = \common\models\costfit\Product::find()->where("productId=$productId or parentId=$productId")->all();
          if (isset($products) && count($products) > 0) {
          foreach ($products as $product):
          $productSuppliers = ProductSuppliers::find()->where("productId=$product->productId")->all();
          if (isset($productSuppliers) && count($productSuppliers) > 0) {
          foreach ($productSuppliers as $productSupp):
          $productSupp->delete();
          endforeach;
          }
          $product->delete();
          endforeach;
          }
          endforeach;
          } */
        return $this->redirect(['index']);
    }

    public function actionAddOption() {
        $productGroupId = '';
        $templateId = '';
        $options = [];
        $optionValue = [];
        if (isset($_GET['id']) && isset($_GET['template'])) {
            $productGroupId = $_GET['id'];
            $templateId = $_GET['template'];
            $productOptions = ProductGroupTemplateOption::find()->where("productGroupTemplateId=" . $templateId)
                    ->orderBy("createDateTime")
                    ->all();
            if (isset($productOptions) && count($productOptions) > 0) {
                foreach ($productOptions as $option):
                    $options[$option->productGroupTemplateOptionId] = $option->title; //option
                endforeach;
            }
            return $this->render('101/_add_product_options', [
                        'templateId' => $_GET['template'],
                        'productGroupId' => $_GET['id'],
                        'options' => $options,
                        'error' => isset($_GET['error']) ? $_GET['error'] : ''
            ]);
        } else {
//throw new \yii\base\ErrorException('เกิดข้อผิดพลาด!!! กรุณาตรวจสอบความถูกต้องของ Product Master');
            throw new \ErrorException('เกิดข้อผิดพลาด!!! กรุณาตรวจสอบความถูกต้องของ Product Master');
        }
//        throw new \yii\base\Exception($productGroupId);
    }

    public function actionEditOption() {
        $optionValueId = $_POST['id'];
        $newVal = $_POST['newVal'];
        $res = [];
        $productGroupOptionValue = ProductGroupOptionValue::find()->where("productGroupOptionValueId=" . $optionValueId)->one();
        if (isset($productGroupOptionValue)) {
            $checkDup = ProductGroupOptionValue::find()
                    ->where("productGroupTemplateOptionId=" . $productGroupOptionValue->productGroupTemplateOptionId . " and productGroupId=" . $productGroupOptionValue->productGroupId . " and value='" . $newVal . "'")
                    ->all();
            if (isset($checkDup) && count($checkDup) > 0) {
                $res['status'] = false;
                $res['error'] = 'Option ซ้ำ';
            } else {
                $allOld = ProductGroupOptionValue::find()
                        ->where("productGroupTemplateOptionId=" . $productGroupOptionValue->productGroupTemplateOptionId . " and productGroupId=" . $productGroupOptionValue->productGroupId . " and value='" . $productGroupOptionValue->value . "'")
                        ->all();
                if (isset($allOld) && count($allOld) > 0) {
                    foreach ($allOld as $value):
                        $value->value = $newVal;
                        $value->updateDateTime = new \yii\db\Expression('NOW()');
                        $value->save(false);
                    endforeach;
                }

                $productGroupOptionValue->value = $newVal;
                $productGroupOptionValue->updateDateTime = new \yii\db\Expression('NOW()');
                $productGroupOptionValue->save(false);
                $res['status'] = true;
            }
        } else {
            $res['status'] = false;
        }
        return json_encode($res);
    }

    public function actionAddNewProduct() {
        if (isset($_POST['newProduct'])) {
            $empty = $this->checkEmptyInput($_POST['newProduct']);
            $dupplicate = $this->checkDupplicate($_POST['newProduct'], $_POST['productGroupId'], $_POST['templateId']);
            if ($empty) {
                $error = '<code>กรุณากรอกข้อมูล</code>';
            }
            if ($dupplicate) {
                $error = '<code>มีข้อมูลที่นี้อยู่แล้ว</code>';
            }
            if ($empty || $dupplicate) {
                return $this->redirect(['add-option',
                            'id' => $_POST['productGroupId'],
                            'template' => $_POST['templateId'],
                            'error' => isset($error) ? $error : ''
                ]);
            }
            $parent = \common\models\costfit\Product::find()->where("productId=" . $_POST['productGroupId'])->one();
            $product = new \common\models\costfit\Product();
            $product->userId = Yii::$app->user->id;
            $product->parentId = $parent->productId;
            $product->brandId = $parent->brandId;
            $product->categoryId = $parent->categoryId;
            $product->productGroupTemplateId = $parent->productGroupTemplateId;
            $product->title = $parent->title;
            $product->shortDescription = $parent->shortDescription;
            $product->description = $parent->description;
            $product->specification = $parent->specification;
            $product->price = $parent->price;
            $product->approve = $parent->approve;
            $product->status = $parent->status;
            $product->createDateTime = new \yii\db\Expression('NOW()');
            $product->updateDateTime = new \yii\db\Expression('NOW()');
            $product->save(false);
            $id = Yii::$app->db->getLastInsertID();
            $this->saveProductImage($parent->productId, $id);

            foreach ($_POST['newProduct'] as $productGroupTemplateOptionId => $value):
                $productGroupOption = ProductGroupOptionValue::find()
                        ->where("productGroupId=" . $_POST['productGroupId'] . " and productGroupTemplateOptionId=" . $productGroupTemplateOptionId)
                        ->one();
                if (isset($productGroupOption) && $value != '' && $value != null) {

                    $productGroup = new ProductGroupOptionValue();
                    $productGroup->productGroupTemplateOptionId = $productGroupTemplateOptionId;
                    $productGroup->value = $value;
                    $productGroup->productGroupId = $_POST['productGroupId'];
                    $productGroup->productGroupTemplateId = $_POST['templateId'];
                    $productGroup->createDateTime = new \yii\db\Expression('NOW()');
                    $productGroup->updateDateTime = new \yii\db\Expression('NOW()');
                    $productGroup->status = 1;
                    $productGroup->productGroupOptionId = $productGroupOption->productGroupOptionId;
                    $productGroup->productId = $id;
                    $productGroup->save(false);
                }
            endforeach;
//            return $this->redirect(['update-product',
//                        'productGroupId' => $_POST['productGroupId'],
//                        'productGroupTemplateId' => $_POST['templateId'],
//                        'step' => '4',
//                        'userId' => Yii::$app->user->id,
//                        'id' => $id
//            ]);
            return $this->redirect(['/productmanager/product/view', 'id'=>$_POST['productGroupId']]);
        } else {
            throw new \ErrorException('เกิดข้อผิดพลาด!!!');
        }
    }

    public function actionEditTitle() {
        $productGroupId = $_POST['id'];
        $res = [];
        $productGroup = \common\models\costfit\Product::find()->where("productId=" . $productGroupId)->one();
        if (isset($productGroup)) {
            $productGroup->title = $_POST['newVal'];
            $productGroup->updateDateTime = new \yii\db\Expression('NOW()');
            $productGroup->save(false);
            $res["message"] = "Success";
            $res["status"] = true;
        } else {
            $res["message"] = "Error";
            $res["status"] = false;
        }
        return json_encode($res);
    }

    public function actionEditSortImage() {
        $imageId = $_POST["id"];
        $type = $_POST["action"];
        $totalImgage = $_POST["total"];
        $res = [];
        $productImage = \common\models\costfit\ProductImageSuppliers::find()->where("productImageId=" . $imageId)->one();
        if ($type == 1) {
            $ordering = $productImage->ordering + 1;
            if ($ordering > $totalImgage) {
                $ordering = $totalImgage;
                $res["status"] = false;
            } else {
                $res["status"] = true;
            }
        } else {
            $ordering = $productImage->ordering - 1;
            if ($ordering <= 0) {
                $ordering = 1;
                $res["status"] = false;
            } else {
                $res["status"] = true;
            }
        }
        $productImage->ordering = $ordering;
        $productImage->save(false);
        $res["ordering"] = $ordering;
        return json_encode($res);
    }

    public function actionEditSortImageMaster() {
        $imageId = $_POST["id"];
        $type = $_POST["action"];
        $totalImgage = $_POST["total"];
        $res = [];
        $productImage = \common\models\costfit\ProductImage::find()->where("productImageId=" . $imageId)->one();
        if ($type == 1) {
            $ordering = $productImage->ordering + 1;
            if ($ordering > $totalImgage) {
                $ordering = $totalImgage;
                $res["status"] = false;
            } else {
                $res["status"] = true;
            }
        } else {
            $ordering = $productImage->ordering - 1;
            if ($ordering <= 0) {
                $ordering = 1;
                $res["status"] = false;
            } else {
                $res["status"] = true;
            }
        }
        $productImage->ordering = $ordering;
        $productImage->save(false);
        $res["ordering"] = $ordering;
        return json_encode($res);
    }

    public function actionImageActive() {
        $productImageId = $_POST['id'];
        $res = [];
        $productImage = \common\models\costfit\ProductImageSuppliers::find()->where("productImageId=" . $productImageId)->one();
        if ($productImage->status == 1) {
            $productImage->status = 2;
        } else if ($productImage->status == 2) {
            $productImage->status = 1;
        } else {
            $productImage->status = 1;
        }
        if ($productImage->save(false)) {
            $res["status"] = true;
        } else {
            $res["status"] = false;
        }
        return json_encode($res);
    }

    public function actionImageMasterActive() {
        $productImageId = $_POST['id'];
        $res = [];
        $productImage = \common\models\costfit\ProductImage::find()->where("productImageId=" . $productImageId)->one();
        if ($productImage->status == 1) {
            $productImage->status = 2;
        } else if ($productImage->status == 2) {
            $productImage->status = 1;
        } else {
            $productImage->status = 1;
        }
        if ($productImage->save(false)) {
            $res["status"] = true;
        } else {
            $res["status"] = false;
        }
        return json_encode($res);
    }

    public function saveBrandToParent($brandId, $productId) {
        $product = \common\models\costfit\Product::find()->where("productId=" . $productId)->one();
        if (isset($product)) {
            $parent = \common\models\costfit\Product::find()->where("productId=" . $product->parentId)->one();
            if (isset($parent)) {
                $parent->brandId = $brandId;
                $parent->save();
            }
        }
    }

    public function checkEmptyInput($data) {
        $i = 0;
        $allAtrributes = count($data);
        foreach ($data as $value):
            if ($value == '') {
                $i++;
            }
        endforeach;
        if ($i == $allAtrributes) {
            return 1; //ไม่มีการกรอกข้อมูล
        } else {
            return 0;
        }
    }

    public function checkDupplicate($data, $productGroupId, $templateId) {
        $allAtrributes = count($data);

        $productGroup = ProductGroupOptionValue::find()
                ->where("productGroupId=" . $productGroupId . " and productGroupTemplateId=" . $templateId)
                ->groupBy('productId')
                ->all(); //เพื่อหา ProductId แต่ละตัวออกมาที่มีtemplateIdเดียวกัน
        if (isset($productGroup) && count($productGroup) > 0) {
            foreach ($productGroup as $product):
                $i = 0;
                foreach ($data as $productGroupTemplateOptionId => $value):
                    $productId = ProductGroupOptionValue::find()
                            ->where("productGroupId=" . $productGroupId . " and productGroupTemplateId=" . $templateId . " and productId=" . $product->productId . " and productGroupTemplateOptionId=" . $productGroupTemplateOptionId . " and value='" . $value . "'")
                            ->one();
                    if (isset($productId)) {
                        $i++;
                        if ($i == $allAtrributes) {
                            return 1;
                        }
                    }

                endforeach;
            endforeach;
        }
        return 0;
    }

    public function saveProductImage($masterId, $newId) {
        $productImages = \common\models\costfit\ProductImage::find()->where("productId=" . $masterId)->all();
        if (isset($productImages)) {
            foreach ($productImages as $productImage):
                $productNewImage = new \common\models\costfit\ProductImage();
                $productNewImage->productId = $newId;
                $productNewImage->title = $productImage->title;
                $productNewImage->image = $productImage->image;
                $productNewImage->imageThumbnail1 = $productImage->imageThumbnail1;
                $productNewImage->imageThumbnail2 = $productImage->imageThumbnail2;
                $productNewImage->ordering = $productImage->ordering;
                $productNewImage->createDateTime = new \yii\db\Expression('NOW()');
                $productNewImage->updateDateTime = new \yii\db\Expression('NOW()');
                $productNewImage->save(false);
            endforeach;
        }
    }

}
