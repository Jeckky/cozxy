<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductSuppliers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
        //$model = new \common\models\costfit\ProductImage();
        //$model->image = UploadedFile::getInstances($model, 'file');
        //exit();
        echo \Yii::$app->getBasePath(true);
        echo '<br>' . \Yii::getAlias('@webroot');
        $searchProducts = \common\models\costfit\Product::find()->all();
        $model = new ProductSuppliers();
        if (isset($_POST["ProductSuppliers"])) {
            $file = Yii::$app->request->get('file');
            $file2 = Yii::$app->request->post('file');
            echo '<pre>';
            print_r($file);
            print_r($file2);
            exit();

            $model->attributes = $_POST["ProductSuppliers"];
            $model->userId = Yii::$app->user->identity->userId;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model, 'searchProducts' => $searchProducts
        ]);
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

    public function actionUpload() {

        $model = new \common\models\costfit\productImageSuppliers();
        //$uploadPath = Yii::getAlias('@root') . '/uploads/';
        $folderName = "ProductImageSuppliers"; //  Size 553 x 484
        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;
        if (isset($_FILES['image'])) {
            $file = \yii\web\UploadedFile::getInstanceByName('image');
            //echo '<pre>';
            //print_r($file->tempName);
            $original_name = $file->baseName;
            $newFileName = \Yii::$app->security
            ->generateRandomString() . '.' . $file->extension;
            // you can write save code here before uploading.
            //$newFileName->resize(553, 484);
            if ($file->saveAs($uploadPath . '/' . $newFileName)) {
                $model->image = $newFileName;
                $model->original_name = $original_name;
                if ($model->save(false)) {
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

}
