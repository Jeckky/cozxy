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
use common\models\costfit\ProductGroupTemplateOption;
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
class ImportProductController extends ProductManagerMasterController {

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
        $model = new Product(['createDateTime' => new Expression('NOW()')]);
        $model->scenario = 'createProductGroup';
        $model->approve = 'approve';
        $message = '';
        if (isset($_POST["fileCsv"]) && \yii\web\UploadedFile::getInstanceByName('fileCsv[csv]') != '') {
            $folderName = "file"; //  folderName
            $folderThumbnail = "importProduct"; //  folderName
            $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail; // Path
            $file = \yii\web\UploadedFile::getInstanceByName('fileCsv[csv]');
            $newFileName = \Yii::$app->security->generateRandomString(10) . '.' . $file->extension;
            $ext = explode('.', $file->name);
            if (end($ext) == 'csv') {
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777);
                }
                $upload = $file->saveAs($uploadPath . '/' . $newFileName);
                if ($upload) {
                    define('CSV_PATH', $uploadPath);
                    $csv_file = CSV_PATH . '/' . $newFileName;
                    $fcsv = fopen($csv_file, "r");
                    if ($fcsv) {
                        $r = 0;
                        $error = 0;
                        $transaction = \Yii::$app->db->beginTransaction();

                        while (($objArr = fgetcsv($fcsv, 1000, "|")) !== FALSE) {
                            if ($r != 0) {
                                if ($objArr[0] == 1) {
                                    if ($objArr[4] == '' || $objArr[6] == '' || $objArr[7] == '' || $objArr[8] == '') {
                                        $error++;
                                        break;
                                    } else {
                                        $perentId = self::saveProductGroup($objArr); //ไม่ต้องsave Option/productSuppliers
                                    }
                                } else {
                                    self::saveProduct($perentId, $objArr); //เป็นproduct master มี option
                                }
                            }
                            if ($r == 10) {
                                break;
                            }
                            $r++;
                        }
                        if ($error == 0) {
                            $transaction->commit();
                        } else {
                            $transaction->rollBack();
                            $message = '<span style="color: red;"><span class="glyphicon glyphicon-remove" aria-hidden="true" "></span> มีบางอย่างผิดพลาด กรุณาใส่ข้อมูลที่จำเป็นให้ครบถ้วน.</span><br>';
                            return $this->render('index', [
                                        'model' => $model,
                                        'message' => $message,
                            ]);
                        }
                        fclose($fcsv);
                        $message = '<span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: #33cc00;"></span> Upload products complete.<br>';
                        // return $this->redirect(['/productmanager/product']);
                    }
                }
            } else {
                //ประเภทไฟล์ ผิด
            }
        }

        return $this->render('index', [
                    'model' => $model,
                    'message' => $message,
        ]);
    }

    public function actionImportImage() {
        $message = '';
        if (isset($_FILES['fileImages']) && $_FILES['fileImages']['tmp_name'][0] != '') {
            foreach ($_FILES['fileImages']['tmp_name'] as $key => $val) {
                $file_name[$key] = $_FILES['fileImages']['name'][$key];
                $file_size[$key] = $_FILES['fileImages']['size'][$key];
                $file_tmp[$key] = $_FILES['fileImages']['tmp_name'][$key];
                $file_type[$key] = $_FILES['fileImages']['type'][$key];
            }
            $dupp = self::checkDupplicateFile($file_name);
            if ($dupp == '') {
                Upload::UploadAllImage();

                $message .= '<span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: #33cc00;"></span> Upload images complete.<br>';
            } else {
                $dupplicate = "มีชื่อรูปนี้อยู่แล้ว<br>" . $dupp . "กรุณาเปลี่ยนชื่อ";
                return $this->render('import_image', [
                            'message' => $message,
                            'dupplicate' => $dupplicate
                ]);
            }
        }
        return $this->render('import_image', [
                    'message' => $message,
        ]);
    }

    private static function saveProductGroup($productArr) {
        $templateId = ProductGroupTemplateOption::templateId($productArr[18]);
        $brandId = Brand::brandId($productArr[1]);
        $categoryId = \common\models\costfit\Category::categoryId($productArr[2]);
        $product = new \common\models\costfit\Product();
        $product->userId = \Yii::$app->user->id;
        $product->parentId = null;
        $product->brandId = $brandId;
        $product->categoryId = $categoryId;
        $product->productGroupTemplateId = $templateId;
        $product->step = 5;
        $product->approve = 'approve';
        $product->code = null;
        $product->title = $productArr[4];
        $product->optionName = $productArr[5];
        $product->shortDescription = $productArr[6];
        $product->description = $productArr[7];
        $product->specification = $productArr[8];
        $product->width = $productArr[9];
        $product->height = $productArr[10];
        $product->depth = $productArr[11];
        $product->weight = $productArr[12];
        $product->price = $productArr[13];
        $product->unit = $productArr[14];
        $product->smallUnit = $productArr[15];
        $product->tags = $productArr[17];
        $product->status = 99;
        $product->createDateTime = new Expression('NOW()');
        $product->updateDateTime = new Expression('NOW()');
        $product->approvecreateDateTime = new Expression('NOW()');
        $product->save();
        $parentId = \Yii::$app->db->getLastInsertID();
        $imgs = $productArr[3];
        $imgArr = explode(',', $imgs);
        self::saveProductImageName($parentId, $imgArr);
        return $parentId;
    }

    private static function saveProduct($parentId, $productArr) {
        $products = \common\models\costfit\Product::find()->where("productId=$parentId")->one();
        if (isset($products)) {
            $product = new \common\models\costfit\Product();
            $product->userId = \Yii::$app->user->id;
            $product->parentId = $parentId;
            $product->brandId = $products->brandId;
            $product->categoryId = $products->categoryId;
            $product->productGroupTemplateId = $products->productGroupTemplateId;
            $product->step = 5;
            $product->approve = 'approve';
            $product->code = \common\helpers\Product::generateProductCode2();
            $product->title = $productArr[4] != '' ? $productArr[4] : $products->title;
            $product->optionName = $productArr[5];
            $product->shortDescription = $productArr[6] != '' ? $productArr[6] : $products->shortDescription;
            $product->description = $productArr[7] != '' ? $productArr[7] : $products->description;
            $product->specification = $productArr[8] != '' ? $productArr[8] : $products->specification;
            $product->width = $productArr[9];
            $product->height = $productArr[10];
            $product->depth = $productArr[11];
            $product->weight = $productArr[12];
            $product->price = $productArr[13];
            $product->unit = $productArr[14];
            $product->smallUnit = $productArr[15];
            $product->tags = $productArr[17];
            $product->status = 99;
            $product->createDateTime = new Expression('NOW()');
            $product->updateDateTime = new Expression('NOW()');
            $product->approvecreateDateTime = new Expression('NOW()');
            $product->save();
            $productId = \Yii::$app->db->getLastInsertID();
            /* $productSuppliers = new ProductSuppliers();
              $productSuppliers->userId = \Yii::$app->user->id;
              $productSuppliers->brandId = $products->brandId;
              $productSuppliers->categoryId = $product->categoryId;
              $productSuppliers->approve = 'approve';
              $productSuppliers->code = $products->code;
              $productSuppliers->title = $productArr[4];
              $productSuppliers->optionName = $productArr[5];
              $productSuppliers->shortDescription = $productArr[6];
              $productSuppliers->description = $productArr[7];
              $productSuppliers->specification = $productArr[8];
              $productSuppliers->width = $productArr[9];
              $productSuppliers->height = $productArr[10];
              $productSuppliers->depth = $productArr[11];
              $productSuppliers->weight = $productArr[12];
              $productSuppliers->unit = $productArr[14];
              $productSuppliers->smallUnit = $productArr[15];
              $productSuppliers->tags = $productArr[17];
              $productSuppliers->quantity = $productArr[16];
              $productSuppliers->result = $productArr[16];
              $productSuppliers->productId = $productId;
              $productSuppliers->status = 1;
              $productSuppliers->createDateTime = new Expression('NOW()');
              $productSuppliers->updateDateTime = new Expression('NOW()');
              $productSuppliers->approvecreateDateTime = new Expression('NOW()');
              $productSuppliers->save();
              $productSuppId = \Yii::$app->db->getLastInsertID();
             */
            $imgs = $productArr[3];
            $imgArr = explode(',', $imgs);
            ProductGroupTemplateOption::saveOption($parentId, $product->productGroupTemplateId, $productId, $productArr);
            self::saveProductImageName($productId, $imgArr);
        }
    }

    public static function saveProductImageName($id, $imageName) {
        $product = Product::findOne($id);
        if (isset($imageName) && count($imageName) > 0) {
            foreach ($imageName as $newFileName):
                $productImage = new ProductImage();
                $productImage->productId = $id;
                $productImage->status = isset($product->parentId) ? 1 : 3;

                $maxOrdering = ProductImage::find()->where(['productId' => $id])->orderBy(['ordering' => SORT_DESC])->one();
                $max = isset($maxOrdering) ? $maxOrdering->ordering + 1 : 1;
                $ordering = $max;
                $imagePath = 'images/ProductImage/';
                $thumbnail1Path = $imagePath . 'thumbnail1/';
                $thumbnail2Path = $imagePath . 'thumbnail2/';
                $productImage->image = $imagePath . $newFileName;
                $productImage->imageThumbnail1 = $thumbnail1Path . $newFileName;
                $productImage->imageThumbnail2 = $thumbnail2Path . $newFileName;
                $productImage->ordering = $ordering;
                $productImage->title = $product->title;
                $productImage->createDateTime = new \yii\db\Expression('NOW()');
                $productImage->updateDateTime = new \yii\db\Expression('NOW()');
                $productImage->save(FALSE);
                $uploadBasePath = Yii::$app->basePath . '/web/';
                $uploadPath = $uploadBasePath . $imagePath;
                $objScan = scandir($uploadPath);
                foreach ($objScan as $oldFile):
                    if ($newFileName == $oldFile) {
                        $product = \common\models\costfit\Product::find()->where("productId=$id")->one();
                        if (isset($product)) {
                            $product->status = 1;
                            $product->save(false);
                        }
                    }
                endforeach;
            endforeach;
        }
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

    private static function checkDupplicateFile($fileName) {
        $imagePath = 'images/ProductImage/';
        $uploadBasePath = Yii::$app->basePath . '/web/';
        $uploadPath = $uploadBasePath . $imagePath;
        $dupplicateImg = '';
        if (count($fileName) > 0) {
            $objScan = scandir($uploadPath);
            foreach ($fileName as $newFile):
                foreach ($objScan as $oldFile):
                    if ($newFile == $oldFile) {
                        $dupplicateImg.=$oldFile . "<br>";
                    }
                endforeach;
            endforeach;
        }
        return $dupplicateImg;
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
