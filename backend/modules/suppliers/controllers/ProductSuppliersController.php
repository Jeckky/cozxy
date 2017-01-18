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
//use yii\web\UploadedFile;
//use yii\imagine\Image;
//use Imagine\Gd;
//use Imagine\Image\Box;
//use Imagine\Image\BoxInterface;
use common\helpers\Upload;

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
        if (Yii::$app->user->identity->type != 4) {
            header("location: /auth");
            exit(0);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => ProductSuppliers::find()
            ->select('`product_suppliers`.* ,  (SELECT product_price_suppliers.price  FROM product_price_suppliers
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
        if (Yii::$app->user->identity->type != 4) {
            header("location: /auth");
            exit(0);
        }
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
        if (Yii::$app->user->identity->type != 4) {
            header("location: /auth");
            exit(0);
        }
        $searchProducts = \common\models\costfit\Product::find()->all();
        $model = new ProductSuppliers();

        if (isset($_POST['ProductSuppliers'])) {
            $model->attributes = $_POST["ProductSuppliers"];
            $model->userId = Yii::$app->user->identity->userId;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->approvecreateDateTime = $model->timestamp();
            $model->approve = Yii::$app->request->post('approve');
            $model->productId = Yii::$app->request->post('productIds');
            $model->result = $_POST['ProductSuppliers']['quantity'];
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
                    $productId = Yii::$app->db->lastInsertID; // idของProduct : ProductId
                    \common\models\costfit\CategoryToProduct::saveCategoryToProduct($model->categoryId, $productId); //เพื่อให้รู้ว่าอยู่ภายใต้ Category ไหน
                    $model->productId = $productId;
                    $model->save(FALSE);
                    //return $this->redirect('image-form?id=' . $model->productSuppId);
                }
            }
            //return $this->redirect('image-form?productSuppId=' . $model->productSuppId);
            //suppliers/product-price-suppliers
            return $this->redirect(Yii::$app->homeUrl . 'suppliers/product-price-suppliers/create?productSuppId=' . $model->productSuppId);
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
        if (Yii::$app->user->identity->type != 4) {
            header("location: /auth");
            exit(0);
        }
        $model = $this->findModel($id);
        //echo '<pre>';
        //print_r($model->attributes['productId']);

        if (isset($_POST["ProductSuppliers"])) {
            $model1 = ProductSuppliers::find()->where('productSuppId=' . $id)->one();
            $model->attributes = $_POST["ProductSuppliers"];
            $model->userId = Yii::$app->user->identity->userId;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->approve = Yii::$app->request->post('approve');
            $model->productId = (Yii::$app->request->post('productIds') != '') ? Yii::$app->request->post('productIds') : $model->attributes['productId']; //
            $model->quantity = $model1->quantity - $_POST['ProductSuppliers']['quantity'];
            $model->result = $model1->result - $_POST['ProductSuppliers']['quantity'];
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
        if (Yii::$app->user->identity->type != 4) {
            header("location: /auth");
            exit(0);
        }
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
        if (Yii::$app->user->identity->type != 4) {
            header("location: /auth");
            exit(0);
        }
        //$model = new \common\models\costfit\productImageSuppliers();
        $model = new \common\models\costfit\ProductImageSuppliers();
        /*
         * helpers Upload
         * path : common/helpers/Upload.php
         * use : Upload::UploadSuppliers($model)
         * กรณีพิเศษ
         */
        Upload::UploadSuppliers($model);
    }

    public function actionProductsSystem() {
        //productId
        $productId = Yii::$app->request->post('productId');
        $product = \common\models\costfit\Product::find()->where('productId = ' . $productId)->one();
        //print_r($product);
        return json_encode($product->attributes);
    }

}
