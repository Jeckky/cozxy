<?php

namespace backend\modules\productmanager\controllers;

use common\helpers\Upload;
use common\models\costfit\Brand;
use backend\modules\productmanager\models\Category;
use common\models\costfit\ProductGroupOption;
use common\models\costfit\ProductGroupOptionValue;
use common\models\costfit\ProductGroupTemplate;
use common\models\costfit\ProductImage;
use common\models\costfit\ProductImageSuppliers;
use common\models\costfit\ProductPriceSuppliers;
use common\models\costfit\ProductSuppliers;
use Yii;
use backend\modules\productmanager\models\Product;
use backend\modules\productmanager\models\search\Product as ProductSearch;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\productmanager\models\search\ProductSuppliers as ProductSuppliersSearch;
use common\helpers\menuBackend;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends ProductManagerMasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProductSearch();
        $searchModel->status = 1;

        //remember params
        $params = Yii::$app->request->queryParams;
        if (count($params) <= 1) {
            $params = Yii::$app->session['productParentParams'];
            if (isset($params['page'])) {
                $_GET['page'] = $params['page'];
                if (isset($params['sort']) && !empty($params['sort'])) {
                    $_GET['sort'] = $params['sort'];
                }
            }
        } else {
            Yii::$app->session['productParentParams'] = $params;
        }


        $dataProvider = $searchModel->search($params);
        $dataProvider->sort = ['defaultOrder' => ['createDateTime' => SORT_DESC]];

        $brandFilter = self::brandFilter();
        $categoryFilter = self::categoryFilter();

        $getAuth = \common\helpers\menuBackend::getUser();
        //echo '<pre>';
        //print_r($getAuth);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'brandFilter' => $brandFilter,
                    'categoryFilter' => $categoryFilter,
                    'checkAuth' => $getAuth
        ]);
    }

    /**
     * Displays a single Product model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        $userGroup = \common\models\costfit\AuthAssignment::find()->where("item_name = 'Partner' ")->all();
        foreach ($userGroup as $value) {
            //$value[] = $value['user_id'];
            $textUserPartner[] = $value['user_id'];
        }
        //print_r($textUser);
        //echo 'userId : ' . Yii::$app->user->identity->userId;
        //$userSuppliers = \common\helpers\Suppliers::GetUserSuppliers();
        //$productCountents = \common\helpers\Suppliers::GetUserContents();
        //echo '<pre>';
        //print_r($productCountents);
        $productCountents = \common\models\costfit\AuthAssignment::find()->where("item_name = 'Content' ")->all();
        foreach ($productCountents as $value) {
            //$value[] = $value['user_id'];
            $textUserCountents[] = $value['user_id'];
        }


        //print_r($textUserCountents);

        $searchModel = new ProductSearch();

        $searchModel->parentId = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //echo 'parentId : ' . $id;

        $productSupplierDataProvider = ProductSuppliersSearch::searchByParentId($id, $textUserPartner, $textUserCountents);
        //print_r($productSupplierDataProvider);
        $getAuth = \common\helpers\menuBackend::getUser();
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'productSupplierDataProvider' => $productSupplierDataProvider,
                    'checkAuth' => $getAuth
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() { //step 1
        $model = new Product(['createDateTime' => new Expression('NOW()')]);
        $model->scenario = 'createProductGroup';
        $model->approve = 'approve';

        $brandFilter = self::brandFilter();
        $categoryFilter = self::categoryFilter();
        $productGroupTemplateFilter = self::productGroupTemplateFilter();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $productId = Yii::$app->db->lastInsertID;
            $model->userId = Yii::$app->user->id;
            $model->save();

            $productGroupTemplate = ProductGroupTemplate::find()->where(['productGroupTemplateId' => $model->productGroupTemplateId])->one();

            foreach ($productGroupTemplate->productGroupTemplateOptions as $productGroupTemplateOption) {
                $productGroupOption = new ProductGroupOption();
                $productGroupOption->productGroupId = $productId;
                $productGroupOption->productGroupTemplateOptionId = $productGroupTemplateOption->productGroupTemplateOptionId;
                $productGroupOption->name = $productGroupTemplateOption->title;
                $productGroupOption->createDateTime = new Expression('NOW()');
                $productGroupOption->updateDateTime = new Expression('NOW()');
                $productGroupOption->status = 1;
                $productGroupOption->save(false);
            }


            return $this->redirect(['create-product-images', 'id' => $model->productId]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'brandFilter' => $brandFilter,
                        'categoryFilter' => $categoryFilter,
                        'productGroupTemplateFilter' => $productGroupTemplateFilter
            ]);
        }
    }

    public function actionCreateProductImages($id) { //step 2
        //upload images
        $model = Product::findOne($id);
        return $this->render('create-product-image', ['productId' => $id, 'model' => $model]);
    }

    public function actionCreateProductOption($id) {
        $product = Product::findOne($id);
        $productGroupTemplate = ProductGroupTemplate::find()->where(['productGroupTemplateId' => $product->productGroupTemplateId])->one();
        $productWithOptions = [];
        $data = [];

        if (isset($_POST['previewOptions'])) {
            $data = $_POST['ProductGroupOptionValue'];
            $productWithOptions = $this->array_cartesian($data);

            $data2 = [];
            foreach ($data as $key => $value) {
                foreach ($value as $k => $v) {
                    $data2[$key][$v] = $v;
                }
            }

            $data = $data2;
        }

        if (isset($_POST['productOptions'])) {
            $data = $_POST['ProductGroupOptionValue'];
            $productGroupOptions = ProductGroupOption::find()->where(['productGroupId' => $id])->all();

            foreach ($data as $value) {
                //new product
                $p = new Product();
                $p->attributes = $product->attributes;
                $p->parentId = $product->productId;
                $p->isNewRecord = true;
                $p->approve = 'approve';
                $p->status = 1;
                $p->userId = Yii::$app->user->id;
                $p->save();

                $pid = Yii::$app->db->lastInsertID;

                //new product images
                foreach ($product->productImages as $productImage) {
                    $img = new ProductImage();
                    $img->attributes = $productImage->attributes;
                    $img->productId = $pid;
                    $img->save();
                }
                //product options
                foreach ($productGroupOptions as $productGroupOption) {
                    if (isset($value[$productGroupOption->productGroupTemplateOptionId])) {
                        $productGroupOptionValue = new ProductGroupOptionValue();
                        $productGroupOptionValue->productGroupOptionId = $productGroupOption->productGroupOptionId;
                        $productGroupOptionValue->productGroupTemplateOptionId = $productGroupOption->productGroupTemplateOptionId;
                        $productGroupOptionValue->productGroupId = $id;
                        $productGroupOptionValue->productId = $pid;
                        $productGroupOptionValue->productGroupTemplateId = $product->productGroupTemplateId;
                        $productGroupOptionValue->value = $value[$productGroupOption->productGroupTemplateOptionId];
                        $productGroupOptionValue->status = 1;
                        $productGroupOptionValue->createDateTime = new Expression('NOW()');
                        $productGroupOptionValue->updateDateTime = new Expression('NOW()');
                        $productGroupOptionValue->save(false);
                    }
                }
            }
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('create-product-option', compact('productGroupTemplate', 'product', 'productWithOptions', 'data'));
    }

    public function actionCreateProductSuppliers($id) {
        $product = Product::findOne($id);

        if (isset($_POST['createProductSuppliers'])) {
            foreach ($_POST['ProductSuppliers'] as $productId => $ps) {
                $child = Product::find()->where(['productId' => $productId])->one();
                $productSuppliers = new ProductSuppliers();
                $productSuppliers->attributes = $child->attributes;
                $productSuppliers->status = 1;
                $productSuppliers->approve = 'approve';
                $productSuppliers->productId = $productId;
                $productSuppliers->userId = Yii::$app->user->id;
                $productSuppliers->createDateTime = new Expression('NOW()');
                $productSuppliers->updateDateTime = new Expression('NOW()');
                $productSuppliers->quantity = $ps['result'];
                $productSuppliers->result = $ps['result'];
                $productSuppliers->save(false);

                $productSuppId = Yii::$app->db->lastInsertID;

                //product price suppliers
                $productPriceSuppliers = new ProductPriceSuppliers();
                $productPriceSuppliers->productSuppId = $productSuppId;
                $productPriceSuppliers->price = $ps['price'];
                $productPriceSuppliers->status = 1;
                $productPriceSuppliers->createDateTime = new Expression('NOW()');
                $productPriceSuppliers->updateDateTime = new Expression('NOW()');
                $productPriceSuppliers->save(false);

                //product image suppliers
                $productImages = ProductImage::find()->where(['productId' => $productId])->all();
                foreach ($productImages as $productImage) {
                    $productImageSuppliers = new ProductImageSuppliers();
                    $productImageSuppliers->attributes = $productImage->attributes;
                    $productImageSuppliers->productSuppId = $productSuppId;
                    $productImageSuppliers->status = 1;
                    $productImageSuppliers->createDateTime = new Expression('NOW()');
                    $productImageSuppliers->updateDateTime = new Expression('NOW()');
                    $productImageSuppliers->save(false);
                }
            }

            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('create-product-suppliers', compact('product'));
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $brandFilter = self::brandFilter();
        $categoryFilter = self::categoryFilter();
        $productGroupTemplateFilter = self::productGroupTemplateFilter();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //update brand & category in product master
            if ($model->parentId == null) {
                Product::updateAll(['brandId' => $model->brandId, 'categoryId' => $model->categoryId], ['parentId' => $model->productId]);
            }

            return $this->redirect(['view', 'id' => isset($model->parentId) ? $model->parentId : $model->productId]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'brandFilter' => $brandFilter,
                        'categoryFilter' => $categoryFilter,
                        'productGroupTemplateFilter' => $productGroupTemplateFilter
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
//        $this->findModel($id)->delete();
        //update to delete status
        $product = $this->findModel($id);
        $product->status = 2;
        $product->approve = 'delete';
        $product->save(false);

        if ($product->parentId == null) {
            $productChildModels = Product::find()->where(['parentId' => $id])->all();

            $pcs = ArrayHelper::map($productChildModels, 'productId', 'productId');

            Product::updateAll(['status' => 2, 'approve' => 'delete'], 'productId in (' . implode(',', $pcs) . ')');
            ProductSuppliers::updateAll(['status' => 2, 'approve' => 'delete'], 'productId in (' . implode(',', $pcs) . ')');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private static function brandFilter() {
        return ArrayHelper::map(Brand::find()->where(['status' => 1])->orderBy('title')->all(), 'brandId', 'title');
    }

    private static function categoryFilter() {
        return Category::categoryFilter();
    }

    private static function productGroupTemplateFilter() {
        return ArrayHelper::map(ProductGroupTemplate::find()->where('status=1')->orderBy('title')->all(), 'productGroupTemplateId', 'title');
    }

    public static function uploadImage($uploadedFile) {
        $mime = \yii\helpers\FileHelper::getMimeType($uploadedFile->tempName);
        $file = time() . "_" . $uploadedFile->name;

        $user_id = Yii::$app->user->id; //Yii::$app->user->getId();

        $url = Yii::$app->urlManager->createAbsoluteUrl('/images/product-content/' . $file);
        $uploadPath = Yii::getAlias('@webroot') . '/images/product-content/' . $file;


        //ตรวจสอบ
        if ($uploadedFile == null) {
            $message = "ไม่มีไฟล์ที่ Upload";
        } else if ($uploadedFile->size == 0) {
            $message = "ไฟล์มีขนาด 0";
        } else if ($mime != "image/jpeg" && $mime != "image/png" && $mime != "image/gif") {
            $message = "รูปภาพควรเป็น JPG หรือ PNG";
        } else if ($uploadedFile->tempName == null) {
            $message = "มีข้อผิดพลาด";
        } else {
            $message = "";
            $move = $uploadedFile->saveAs($uploadPath);
            if (!$move) {
                $message = "ไม่สามารถนำไฟล์ไปไว้ใน Folder ได้กรุณาตรวจสอบ Permission Read/Write/Modify";
            }
        }
        $funcNum = $_GET['CKEditorFuncNum'];
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
    }

    public function actionUploadDescriptionImage() {
        $uploadedFile = \yii\web\UploadedFile::getInstanceByName('upload');
        self::uploadImage($uploadedFile);
    }

    public function actionUploadSpecificationImage() {
        $uploadedFile = \yii\web\UploadedFile::getInstanceByName('upload');
        self::uploadImage($uploadedFile);
    }

    public function actionUploadProductImage($id) {
        $product = Product::findOne($id);
        $productImage = new ProductImage();
        $productImage->productId = $id;
        $productImage->status = isset($product->parentId) ? 1 : 3;

        $maxOrdering = ProductImage::find()->where(['productId' => $id])->orderBy(['ordering' => SORT_DESC])->one();
        $max = isset($maxOrdering) ? $maxOrdering->ordering + 1 : 1;
        $ordering = $max;

        Upload::UploadProductImage($productImage, $ordering);
    }

    public function actionMoveImageUp($id) {
        $productImage = ProductImage::findOne($id);
        $upper = ProductImage::find()->where(['productId' => $productImage->productId])->andWhere(['<', 'ordering', $productImage->ordering])->orderBy(['ordering' => SORT_DESC])->one();

        if (isset($upper)) {
            $newOrdering = $upper->ordering;
            $upper->ordering = $productImage->ordering;
            $productImage->ordering = $newOrdering;

            if ($productImage->save() && $upper->save()) {
                return Json::encode(['result' => true]);
            } else {
                return Json::encode(['result' => false]);
            }
        }
    }

    public function actionMoveImageDown($id) {
        $productImage = ProductImage::findOne($id);
        $lower = ProductImage::find()->where(['productId' => $productImage])->andWhere(['>', 'ordering', $productImage->ordering])->orderBy(['ordering' => SORT_ASC])->one();

        if (isset($lower)) {
            $newOrdering = $lower->ordering;
            $lower->ordering = $productImage->ordering;
            $productImage->ordering = $newOrdering;

            if ($productImage->save() && $lower->save()) {
                return Json::encode(['result' => true]);
            } else {
                return Json::encode(['result' => false]);
            }
        }
    }

    public function actionDeleteProductImage($id) {
        $productImage = ProductImage::findOne($id);
        $productImage->delete();

//        unlink(Yii::$app->basePath . '/web/' . $productImage->image);
//        unlink(Yii::$app->basePath . '/web/' . $productImage->imageThumbnail1);
//        unlink(Yii::$app->basePath . '/web/' . $productImage->imageThumbnail2);
    }

    public function actionPrepareProducts($id) {
        $data = $_POST['data'];
        $res = [];

        return Json::encode($res);
    }

    public function array_cartesian($arrays) {
        $result = array();
        $keys = array_keys($arrays);
        $arrays = array_values($arrays);

        $sizeIn = sizeof($arrays);

        $size = $sizeIn > 0 ? 1 : 0;
        foreach ($arrays as $array) {
            $size = $size * sizeof($array);
        }
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

    public function actionMultipleDelete() {
        $res = ['success' => false, 'error' => NULL];
        $productIds = explode(',', $_POST['productIds']);

        Product::updateAll(['status' => 2], ['in', 'productId', $productIds]);

        echo Json::encode($res);
    }

}
