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
        if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 5) {
            header("location: /auth");
            exit(0);
        }
        //CategoryId BrandId
        $CategoryId = Yii::$app->request->get('CategoryId');
        $BrandId = Yii::$app->request->get('BrandId');
        //echo $CategoryId . '<br>';
        //echo $BrandId;
        //throw new \yii\base\Exception($BrandId);
        if ($CategoryId != '' && $BrandId == '') {
            $dataProvider = new ActiveDataProvider([
                'query' => ProductSuppliers::find()
                ->select('`product_suppliers`.* ,  (SELECT product_price_suppliers.price  FROM product_price_suppliers
            where product_price_suppliers.productSuppId = product_suppliers.productSuppId and product_price_suppliers.status = 1  limit 1)
            AS `priceSuppliers`')
                ->where('categoryId = ' . $CategoryId . ' and userId=' . Yii::$app->user->identity->userId)
                ->orderBy('product_suppliers.productSuppId desc'),
            ]);
        } else if ($BrandId != '' && $CategoryId == '') {
            $dataProvider = new ActiveDataProvider([
                'query' => ProductSuppliers::find()
                ->select('`product_suppliers`.* ,  (SELECT product_price_suppliers.price  FROM product_price_suppliers
            where product_price_suppliers.productSuppId = product_suppliers.productSuppId and product_price_suppliers.status = 1  limit 1)
            AS `priceSuppliers`')
                ->where('brandId = "' . $BrandId . '"  and userId=' . Yii::$app->user->identity->userId)
                ->orderBy('product_suppliers.productSuppId desc'),
            ]);
        } else if ($BrandId != '' && $CategoryId != '') {
            $dataProvider = new ActiveDataProvider([
                'query' => ProductSuppliers::find()
                ->select('`product_suppliers`.* ,  (SELECT product_price_suppliers.price  FROM product_price_suppliers
            where product_price_suppliers.productSuppId = product_suppliers.productSuppId and product_price_suppliers.status = 1  limit 1)
            AS `priceSuppliers`')
                ->where('brandId = "' . $BrandId . '" and categoryId = ' . $CategoryId . '  and userId=' . Yii::$app->user->identity->userId)
                ->orderBy('product_suppliers.productSuppId desc'),
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => ProductSuppliers::find()
                ->select('`product_suppliers`.* ,  (SELECT product_price_suppliers.price  FROM product_price_suppliers
            where product_price_suppliers.productSuppId = product_suppliers.productSuppId and product_price_suppliers.status = 1  limit 1)
            AS `priceSuppliers`')
                ->where('userId=' . Yii::$app->user->identity->userId)->orderBy('product_suppliers.productSuppId desc'),
            ]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'brandId' => isset($BrandId) ? $BrandId : '',
            'categoryId' => isset($CategoryId) ? $CategoryId : '',
        ]);
    }

    /**
     * Displays a single ProductSuppliers model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 5) {
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

    public function actionGen() {
        $productSupp = ProductSuppliers::find()->where("1")->all();
        foreach ($productSupp as $supp) {
            $supp->code = \common\helpers\Product::generateProductCode($supp->productSuppId);
            // $supp->code = null;
            $supp->save(false);
        }
    }

    public function actionGenCozxy() {
        $productSupp = Product::find()->where("1")->all();
        foreach ($productSupp as $supp) {
            //$supp->code = \common\helpers\Product::generateProductCode($supp->productSuppId);
            $supp->code = null;
            $supp->save(false);
        }
    }

    public function actionGenCozxy2() {
        $productSupp = ProductSuppliers::find()->where("1")->all();
        foreach ($productSupp as $products):
            if ($products->productId != '' && $products->productId != null) {
                $product = Product::find()->where("productId=" . $products->productId)->one();
                if (isset($product) && !empty($product)) {
                    $product->code = $products->code;
                    $product->save(false);
                }
            }
        endforeach;
    }

    public function actionGens() {
        $productSupp = ProductSuppliers::find()->where("1")->all();
        foreach ($productSupp as $supp) {
            $productCozxy = Product::find()->where('productId=' . $supp->productId)->one();
            $supp->code = \common\helpers\Product::generateProductCode($supp->productSuppId);
            //$supp->code = null;
            $productCozxy->code = \common\helpers\Product::generateProductCodeCozxy($supp->productSuppId);
            $supp->save(false);
            $productCozxy->save(false);
        }
    }

    /**
     * Creates a new ProductSuppliers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 5) {
            header("location: /auth");
            exit(0);
        }
        $searchProducts = \common\models\costfit\Product::find()->all();
        $model = new ProductSuppliers();
        $model->scenario = 'ProductSuppliers';
        //$model->result = 0;
        if (isset($_POST['ProductSuppliers'])) {
            $model->attributes = $_POST["ProductSuppliers"];
            $model->userId = Yii::$app->user->identity->userId;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            //$model->approvecreateDateTime = $model->timestamp();
            $model->approve = Yii::$app->request->post('approve');
            $model->productId = Yii::$app->request->post('productIds');
            $model->result = $_POST['ProductSuppliers']['quantity'];
            $model->code = \common\helpers\Product::generateProductCode();
            if ($model->save(FALSE)) {

            }


            //ECHO 'approve :' . Yii::$app->request->post('approve');
            //ECHO '<BR> productIds:' . Yii::$app->request->post('productIds');
            if (Yii::$app->request->post('approve') == 'new' && Yii::$app->request->post('productIds') == '') {
                $modelSys = new Product();
                $modelSys->attributes = $_POST["ProductSuppliers"];
                $modelSys->userId = Yii::$app->user->identity->userId;
                $modelSys->createDateTime = new \yii\db\Expression('NOW()');
                $modelSys->suppCode = $_POST["ProductSuppliers"]['suppCode'];
                $modelSys->merchantCode = $_POST["ProductSuppliers"]['merchantCode'];
                $modelSys->approve = Yii::$app->request->post('approve');
                $modelSys->productSuppId = $model->productSuppId;
                $modelSys->code = $model->code;
                if ($modelSys->save(FALSE)) {
                    //throw new \yii\base\Exception(1);
                }
                $productId = Yii::$app->db->lastInsertID; // idของProduct : ProductId
                \common\models\costfit\CategoryToProduct::saveCategoryToProduct($model->categoryId, $productId); //เพื่อให้รู้ว่าอยู่ภายใต้ Category ไหน
                $model->productId = $productId;
                $model->save(FALSE);
                //return $this->redirect('image-form?id=' . $model->productSuppId);
                $productPriceCozxy = \common\models\costfit\Product::updateAll(['price' => 0], ['productId' => $model->productId, 'productSuppId' => $model->productSuppId]);

                $productSuppliersPrice = new \common\models\costfit\ProductPriceSuppliers();
                $productSuppliersPrice->productSuppId = $model->productSuppId;
                $productSuppliersPrice->price = 0;
                $productSuppliersPrice->discountType = 1;
                $productSuppliersPrice->createDateTime = new \yii\db\Expression('NOW()');
                if ($productSuppliersPrice->save(FALSE)) {

                } else {
                    throw new \yii\base\Exception(print_r($productSuppliersPrice, true));
                }
            }
            //return $this->redirect('image-form?productSuppId = ' . $model->productSuppId);
            //suppliers/product-price-suppliers
            ///suppliers/product-suppliers/image-form?productSuppId=235
            if (Yii::$app->user->identity->type == 5) {
                //return $this->redirect(Yii::$app->homeUrl . 'suppliers/product-suppliers/image-form?productSuppId=' . $model->productSuppId);
                return $this->redirect(Yii::$app->homeUrl . 'suppliers/product-price-suppliers/create?productSuppId=' . $model->productSuppId);
            } else {
                return $this->redirect(Yii::$app->homeUrl . 'suppliers/product-price-suppliers/create?productSuppId=' . $model->productSuppId);
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
        if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 5) {
            header("location: /auth");
            exit(0);
        }
        $model = $this->findModel($id);
        //echo '<pre>';
        //print_r($model->attributes['productId']);
        $CategoryId = Yii::$app->request->get('CategoryId');
        $BrandId = Yii::$app->request->get('BrandId');
        if (isset($_POST["ProductSuppliers"])) {

            // $model1 = ProductSuppliers::find()->where('productSuppId = ' . $id)->one();
            //$productId = (Yii::$app->request->post('productIds') != '') ? Yii::$app->request->post('productIds') : $model->attributes['productId'];
            $model1 = ProductSuppliers::find()->where('productSuppId = ' . $id)->one();
            $model->attributes = $_POST["ProductSuppliers"];
            $model->userId = Yii::$app->user->identity->userId;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->approve = Yii::$app->request->post('approve');
            $model->productId = (Yii::$app->request->post('productIds') != '') ? Yii::$app->request->post('productIds') : $model->attributes['productId']; //
            $model->quantity = $model1->quantity - $_POST['ProductSuppliers']['quantity'];
            $model->result = $model1->result - $_POST['ProductSuppliers']['quantity'];
            if ($model->save()) {
                \common\models\costfit\CategoryToProduct::saveCategoryToProduct($model->categoryId, $model->productId);
                $product = \common\models\costfit\Product::updateAll(
<<<<<<< HEAD
                                [
                            'isbn' => $_POST['ProductSuppliers']['isbn'],
                            'title' => $_POST['ProductSuppliers']['title'],
                            'shortDescription' => $_POST['ProductSuppliers']['shortDescription'],
                            'description' => $_POST['ProductSuppliers']['description'],
                            'specification' => $_POST['ProductSuppliers']['specification'],
                            'width' => $_POST['ProductSuppliers']['width'],
                            'height' => $_POST['ProductSuppliers']['height'],
                            'depth' => $_POST['ProductSuppliers']['depth'],
                            'weight' => $_POST['ProductSuppliers']['weight'],
                            'tags' => $_POST['ProductSuppliers']['tags'],
                            'suppCode' => $_POST['ProductSuppliers']['suppCode'],
                                //'merchantCode' => $_POST['ProductSuppliers']['merchantCode'],
                                ], ['productId' => $model1->productId, 'productSuppId' => $id]);
                return $this->redirect(['index',
                            'CategoryId' => $model->categoryId,
                            'BrandId' => $model->brandId
                ]);
=======
                [
                    'isbn' => $_POST['ProductSuppliers']['isbn'],
                    'title' => $_POST['ProductSuppliers']['title'],
                    'shortDescription' => $_POST['ProductSuppliers']['shortDescription'],
                    'description' => $_POST['ProductSuppliers']['description'],
                    'specification' => $_POST['ProductSuppliers']['specification'],
                    'width' => $_POST['ProductSuppliers']['width'],
                    'height' => $_POST['ProductSuppliers']['height'],
                    'depth' => $_POST['ProductSuppliers']['depth'],
                    'weight' => $_POST['ProductSuppliers']['weight'],
                    'tags' => $_POST['ProductSuppliers']['tags'],
                    'suppCode' => $_POST['ProductSuppliers']['suppCode'],
                //'merchantCode' => $_POST['ProductSuppliers']['merchantCode'],
                ], ['productId' => $model1->productId, 'productSuppId' => $id]);
                return $this->redirect(['index?BrandId=' . $BrandId . '&CategoryId=' . $CategoryId]);
>>>>>>> origin/multi-suppliers
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
        if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 5) {
            header("location: /auth");
            exit(0);
        }
        $productSuppId = Yii::$app->request->get('productSuppId');
        if (isset($productSuppId)) {
            //$model = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId = ' . $id)->one();
            $dataProvider = new ActiveDataProvider([
                'query' => \common\models\costfit\ProductImageSuppliers:: find()
                ->where('productSuppId = ' . $productSuppId . ' order by ordering asc'),
            ]);
            $productTitle = \common\models\costfit\ProductSuppliers::find()->where('productSuppId = ' . $productSuppId)->one();


            if (isset($_POST["id"])) {

//                throw new \yii\base\Exception(print_r($_POST, true));
                $id = $_POST["id"];
                $model = $_POST['className' . $id]::find()->where($_POST['pkName' . $id] . "=" . $id)->one();
//            throw new \yii\base\Exception(print_r($model->attributes, true));
                $model->ordering = $_POST["sortOrder" . $id];
                if ($model->save(FALSE)) {
//            throw new \yii\base\Exception(print_r($model->attributes, true));
                } else {
                    throw new \yii\base\Exception(print_r($model->errors, true));
                }

                $params = [$_POST['action' . $id]];
                if (isset($_POST['followIdName' . $id])) {
                    $params[$_POST['followIdName' . $id]] = $_POST['followId' . $id];
                }
                if (isset($_POST['followId2Name' . $id])) {
                    $params[$_POST['followId2Name' . $id]] = $_POST['followId2' . $id];
                }
            }
        } else {
            $dataProvider = new \common\models\costfit\ProductImageSuppliers();
            $productTitle = NULL;
        }



        return $this->render('/image-form/_form', [
            'dataProvider' => $dataProvider, 'productTitle' => $productTitle
        ]);
    }

    public function actionUpload() {
        if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 5) {
            header("location: /auth");
            exit(0);
        }
        $productSuppId = Yii::$app->request->get('id');
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

    public function actionShowDetail() {

        return $this->render('/show-detail/index', [
        ]);
    }

    public function actionDuplicateProduct($productSuppId) {
        //$productSuppId = '';
        $modelx = $this->findModel($productSuppId);


        $model = new ProductSuppliers();
        $model->scenario = 'ProductSuppliers';
        if (isset($_POST['ProductSuppliers'])) {
            $model->attributes = $_POST["ProductSuppliers"];
            $model->userId = Yii::$app->user->identity->userId;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            //$model->approvecreateDateTime = $model->timestamp();
            $model->approve = Yii::$app->request->post('approve');
            $model->productId = Yii::$app->request->post('productIds');
            $model->result = $_POST['ProductSuppliers']['quantity'];
            $model->code = \common\helpers\Product::generateProductCode();
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
                $modelSys->code = $model->code;
                if ($modelSys->save(FALSE)) {
                    //throw new \yii\base\Exception(1);
                    $productId = Yii::$app->db->lastInsertID; // idของProduct : ProductId
                    \common\models\costfit\CategoryToProduct::saveCategoryToProduct($model->categoryId, $productId); //เพื่อให้รู้ว่าอยู่ภายใต้ Category ไหน
                    $model->productId = $productId;
                    $model->save(FALSE);
                    //return $this->redirect('image-form?id = ' . $model->productSuppId);
                }
            }
            //return $this->redirect('image-form?productSuppId = ' . $model->productSuppId);
            //suppliers/product-price-suppliers
            return $this->redirect(Yii::$app->homeUrl . 'suppliers/product-price-suppliers/create?productSuppId = ' . $model->productSuppId);
        } else {
            return $this->render('/duplicate/update', [
                'model' => $modelx,
            ]);
        }
        ///return $this->render('/duplicate/index', [
        //]);
    }

    public function actionOrderList() {

        $ms = '';
        $model = \common\models\costfit\Order::find()
        ->select(['`order`.*', '`product_suppliers`.*', '`order_item`.*'])
        ->join('LEFT JOIN', 'order_item', 'order.orderId = order_item.orderId')
        ->join('LEFT JOIN', 'product_suppliers', 'order_item.productSuppId = product_suppliers.productSuppId')
        ->where('`order`.status = ' . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS . '  '
        . 'and `product_suppliers`.userId =' . Yii::$app->user->identity->userId)
        ->all();
        $productSuppIds = [];
        $old = [];
        if (isset($model) && count($model) > 0) {

            $i = 0;
            $count = 0;
            foreach ($model as $productSuppId):
                $check = false;
                $check = $this->productSuppId($productSuppId->productSuppId, $old);
                if ($check == true) {
                    $old[$i] = $productSuppId->productSuppId;
                    $i++;
                }
            endforeach;
        }
        if (count($old) > 0) {
            $productSuppIds = $old;
        }
        return $this->render('/order-list/index', [
            'productSuppIds' => $productSuppIds
        ]);
    }

    public function productSuppId($new, $olds) {
        $i = 0;
        foreach ($olds as $old):
            if ($old == $new) {
                $i++;
            }
        endforeach;
        if ($i == 0) {
            return true;
        } else {
            return false;
        }
    }

}
