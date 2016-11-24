<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductSuppliers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\Point;

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
            'query' => ProductSuppliers::find(),
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        // parameter request post //
        $ProductSuppliers = Yii::$app->request->post('ProductSuppliers');
        $productIds = Yii::$app->request->post('productIds');
        $approve = Yii::$app->request->post('approve');
        $categoryId = Yii::$app->request->post('categoryId');
        $brandId = Yii::$app->request->post('brandId');
        $isbn = Yii::$app->request->post('isbn');
        $code = Yii::$app->request->post('code');
        $title = Yii::$app->request->post('title');
        $optionname = Yii::$app->request->post('optionname');
        $shortdescription = Yii::$app->request->post('shortdescription');
        $description = Yii::$app->request->post('description');
        $specification = Yii::$app->request->post('specification');
        $width = Yii::$app->request->post('width');
        $height = Yii::$app->request->post('height');
        $depth = Yii::$app->request->post('depth');
        $weight = Yii::$app->request->post('weight');
        $price = Yii::$app->request->post('price');
        $unit = Yii::$app->request->post('unit');
        $smallUnit = Yii::$app->request->post('smallUnit');
        $tags = Yii::$app->request->post('tags');
        //if (isset($_POST["ProductSuppliers"])) {
        if (isset($_POST['ProductSuppliers'])) {
            //$model->attributes = $_POST["ProductSuppliers"];
            $model->userId = Yii::$app->user->identity->userId;
            //$model->productGroupId = $productGroupId;
            $model->brandId = $brandId;
            $model->categoryId = $categoryId;
            $model->isbn = $isbn;
            $model->code = $code;
            $model->title = $title;
            $model->optionName = $optionname;
            $model->shortDescription = $shortdescription;
            $model->description = $description;
            $model->specification = $specification;
            $model->width = $width;
            $model->height = $height;
            $model->depth = $depth;
            $model->weight = $weight;
            $model->price = $price;
            $model->unit = $unit;
            $model->smallUnit = $smallUnit;
            $model->tags = $tags;
            //$model->status = $status;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->approve = $approve;
            $model->productId = $productIds;
            if ($model->save()) {
                return $this->redirect('image-form?id=' . $model->productSuppId);
            }
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
        if (isset($_POST["ProductSuppliers"])) {
            $model->attributes = $_POST["ProductSuppliers"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $model->userId = Yii::$app->user->identity->userId;
            if ($model->save()) {
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
        $model = new \common\models\costfit\ProductImageSuppliers();
        return $this->render('/image-form/_form', [
            'model' => $model
        ]);
    }

    public function actionUpload() {

        $model = new \common\models\costfit\productImageSuppliers();
        //$uploadPath = Yii::getAlias('@root') . '/uploads/';
        $folderName = "ProductImageSuppliers"; //  Size 553 x 484
        $folderThumbnail1 = "thumbnail1"; // Size 356 x 390
        $folderThumbnail2 = "thumbnail2"; // Size 137 x 130

        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;
        $uploadPath1 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail1;
        $uploadPath2 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail2;
        if (isset($_FILES['image'])) {
            $file = \yii\web\UploadedFile::getInstanceByName('image');
            $original_name = $file->baseName;
            $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
            //$newFileName1 = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
            //$newFileName2 = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
            if ($file->saveAs($uploadPath . '/' . $newFileName)) {
                //Image::thumbnail('@webroot/images/ProductImageSuppliers/' . $newFileName, 137, 130)
                // ->resize(new Box(500, 300))
                //->save($uploadPath . '/' . $file->baseName . '.' . $file->extension, ['quality' => 70]);
                $model->image = $newFileName;
                $model->productSuppId = Yii::$app->request->get('id');
                $model->original_name = $file->name;
                if ($model->save(FALSE)) {
                    echo \yii\helpers\Json::encode($file);
                } else {
                    echo \yii\helpers\Json::encode($model->getErrors());
                }
            }
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
