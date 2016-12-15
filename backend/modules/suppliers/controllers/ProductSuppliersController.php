<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductShippingPriceSuppliers;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

/**
 * ProductSuppliersController implements the CRUD actions for ProductSuppliers model.
 */
class ProductSuppliersController extends SuppliersMasterController {

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view', 'products'],
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
     * Lists all ProductSuppliers models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductSuppliers::find()
            ->select('`product_suppliers`.* ,  (SELECT product_price_suppliers.price  FROM costfit_test.product_price_suppliers
            where product_price_suppliers.productSuppId = product_suppliers.productSuppId and product_price_suppliers.status = 1  limit 1)
            AS `priceSuppliers`')
            ->where('userId=' . Yii::$app->user->identity->userId)->orderBy('product_suppliers.productSuppId desc'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductSuppliers model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        //$images = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId =' . $id)->one();
        $dataProviderImages = new ActiveDataProvider([
            'query' => \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $id),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id), 'dataProviderImages' => $dataProviderImages
        ]);
    }

    /**
     * Creates a new ProductSuppliers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $searchProducts = \common\models\costfit\Product::find()->all();
        $model = new ProductSuppliers();

        if (isset($_POST['ProductSuppliers'])) {
            $model->attributes = $_POST["ProductSuppliers"];
            $model->userId = Yii::$app->user->identity->userId;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->approve = Yii::$app->request->post('approve');
            $model->productId = Yii::$app->request->post('productIds');
            if ($model->save(FALSE)) {

            }
            //ECHO 'approve :' . Yii::$app->request->post('approve');
            //ECHO '<BR> productIds:' . Yii::$app->request->post('productIds');
            if (Yii::$app->request->post('approve') == 'new' && Yii::$app->request->post('productIds') == '') {
                $modelSys = new Product();
                $modelSys->attributes = $_POST["ProductSuppliers"];
                $modelSys->userId = Yii::$app->user->identity->userId;
                $modelSys->createDateTime = new \yii\db\Expression('NOW()');
                $modelSys->approve = Yii::$app->request->post('approve');
                $modelSys->productSuppId = $model->productSuppId;
                if ($modelSys->save(FALSE)) {
                    //throw new \yii\base\Exception(1);
                    $productId = Yii::$app->db->lastInsertID;
                    \common\models\costfit\CategoryToProduct::saveCategoryToProduct($model->categoryId, $productId); //เพื่อให้รู้ว่าอยู่ภายใต้ Category ไหน
                    $model->productId = $productId;
                    $model->save(FALSE);
                    //return $this->redirect('image-form?id=' . $model->productSuppId);
                }
            }
            //return $this->redirect('image-form?productSuppId=' . $model->productSuppId);
            return $this->redirect('/suppliers/product-price-suppliers/create?productSuppId=' . $model->productSuppId);
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing ProductSuppliers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        //echo '<pre>';
        //print_r($model->attributes['productId']);

        if (isset($_POST["ProductSuppliers"])) {
            $model->attributes = $_POST["ProductSuppliers"];
            $model->userId = Yii::$app->user->identity->userId;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->approve = Yii::$app->request->post('approve');
            $model->productId = (Yii::$app->request->post('productIds') != '') ? Yii::$app->request->post('productIds') : $model->attributes['productId']; //

            if ($model->save()) {
                \common\models\costfit\CategoryToProduct::saveCategoryToProduct($model->categoryId, $model->productId);
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductSuppliers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductSuppliers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductSuppliers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductSuppliers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImageForm() {
        $productSuppId = Yii::$app->request->get('productSuppId');
        if (isset($productSuppId)) {
            //$model = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId =' . $id)->one();
            $dataProvider = new ActiveDataProvider([
                'query' => \common\models\costfit\ProductImageSuppliers:: find()
                ->where('productSuppId =' . $productSuppId),
            ]);
            $productTitle = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $productSuppId)->one();
        } else {
            $dataProvider = new \common\models\costfit\ProductImageSuppliers();
            $productTitle = NULL;
        }

        return $this->render('/image-form/_form', [
            'dataProvider' => $dataProvider, 'productTitle' => $productTitle
        ]);
    }

    public function actionUpload() {

        $model = new \common\models\costfit\productImageSuppliers();
        //$uploadPath = Yii::getAlias('@root') . '/uploads/';
        $folderName = "ProductImageSuppliers"; //  Size 553 x 484
        $folderThumbnail = "thumbnail"; // Size 553 x 484
        $folderThumbnail1 = "thumbnail1"; // Size 356 x 390
        $folderThumbnail2 = "thumbnail2"; // Size 137 x 130

        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;
        $uploadPath1 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail;
        $uploadPath2 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail1;
        $uploadPath3 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail2;
        if (isset($_FILES['image'])) {
            $file = \yii\web\UploadedFile::getInstanceByName('image');
            $original_name = $file->baseName;
            $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;

            $file->saveAs($uploadPath . '/' . $newFileName);
            $originalFile = $uploadPath . '/' . $newFileName; // originalFile

            $thumbFile0 = $uploadPath . '/' . $newFileName; // Size 553 x 484
            $thumbFile1 = $uploadPath1 . '/' . $newFileName;
            $thumbFile2 = $uploadPath2 . '/' . $newFileName; // Size 356 x 390
            $thumbFile3 = $uploadPath3 . '/' . $newFileName; // Size 137 x 130

            $saveThumb0 = Image::thumbnail($originalFile, 553, 484)->save($thumbFile0, ['quality' => 80]);
            //$saveThumb1 = Image::thumbnail($originalFile, 553, 484)->save($thumbFile1, ['quality' => 80]); // thumbnail file
            $saveThumb2 = Image::thumbnail($originalFile, 356, 390)->save($thumbFile2, ['quality' => 80]); // thumbnail file
            $saveThumb3 = Image::thumbnail($originalFile, 137, 130)->save($thumbFile3, ['quality' => 80]); // thumbnail file
            //mage::getImagine()->open($originalFile)->thumbnail(new Box(553, 484))->save($thumbFile1, ['quality' => 90]);

            $model->image = 'images/' . $folderName . '/' . $newFileName; // Size 553 x 484
            $model->imageThumbnail1 = 'images/' . $folderName . '/' . $folderThumbnail1 . '/' . $newFileName; // Size 356 x 390
            $model->imageThumbnail2 = 'images/' . $folderName . '/' . $folderThumbnail2 . '/' . $newFileName; // Size 137 x 130
            $model->productSuppId = Yii::$app->request->get('id');
            //$model->original_name = $file->name;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save(FALSE)) {
                echo \yii\helpers\Json::encode($file);
            } else {
                echo \yii\helpers\Json::encode($model->getErrors());
            }
            //}
        } else {
            /* return $this->render('upload', [
              'model' => $model,
              ]); */
            echo 'Test Upload images';
        }

        return false;
    }

    public function actionProductsSystem() {
        //productId
        $productId = Yii::$app->request->post('productId');
        $product = \common\models\costfit\Product::find()->where('productId = ' . $productId)->one();
        //print_r($product);
        return json_encode($product->attributes);
    }

}
