<?php

namespace backend\modules\management\controllers;

use Yii;
use common\models\costfit\ImportCategory;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\Upload;
use yii\db\ActiveQuery;

class ImporterController extends ManagementMasterController {

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
     * Lists all Importer models.
     * @return mixed
     */
    public function actionIndex() {

        return $this->render('index');
    }

    public function actionBrand() {

        $model = new ImportCategory;
        $request = Yii::$app->request;
        if ($request->isPost) {
            if (isset($_POST["File"])) {
                $folderName = "file"; //  folderName
                $folderThumbnail = "brand"; //  folderName
                $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail; //Path
                $newFileName = Upload::UploadCSVBrand('File[image]', $folderName, $uploadPath);
                //return $this->redirect(['/management/importer']);
                if ($newFileName == 'warning') {
                    //return $this->render('category');
                    $notify = 'warning';
                    return $this->render('brand', [
                        'notify' => $notify
                    ]);
                } else if ($newFileName == 'success') {
                    $notify = 'success';
                    return $this->render('brand', [
                        'notify' => $notify
                    ]);
                }
            }
        } else {
            //return $this->render('brand');
            $notify = '';
            return $this->render('brand', [
                'notify' => $notify
            ]);
        }
    }

    public function actionCategory() {
        $model = new ImportCategory;
        $request = Yii::$app->request;
        if ($request->isPost) {
            if (isset($_POST["File"])) {
                $folderName = "file"; //  folderName
                $folderThumbnail = "category"; //  folderName
                $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail; // Path
                $newFileName = Upload::UploadCSVCategory('File[image]', $folderName, $uploadPath);
                if ($newFileName == 'warning') {
                    //return $this->render('category');
                    $notify = 'warning';
                    return $this->render('category', [
                        'notify' => $notify
                    ]);
                } else if ($newFileName == 'success') {
                    $notify = 'success';
                    return $this->render('category', [
                        'notify' => $notify
                    ]);
                }
            }
        } else {
            $notify = '';
            return $this->render('category', [
                'notify' => $notify
            ]);
        }
    }

    public function actionProduct() {
        $model = new ImportCategory;
        $request = Yii::$app->request;
        if ($request->isPost) {
            if (isset($_POST["File"])) {
                $folderName = "file"; //  folderName
                $folderThumbnail = "product"; //  folderName
                $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail; // Path
                $newFileName = Upload::UploadCSVProduct('File[image]', $folderName, $uploadPath);
                //return $this->redirect(['/management/importer']);
                if ($newFileName == 'warning') {
                    //return $this->render('category');
                    $notify = 'warning';
                    return $this->render('product', [
                        'notify' => $notify
                    ]);
                } else if ($newFileName == 'success') {
                    $notify = 'success';
                    return $this->render('product', [
                        'notify' => $notify
                    ]);
                }
            }
        } else {
            //return $this->render('product');
            $notify = '';
            return $this->render('product', [
                'notify' => $notify
            ]);
        }
    }

    public function actionClear() {
        return $this->render('clear');
    }

    public function actionClearBrand() {
        $title = 'Clear Error <span class="text-danger">Brand</span> Importer CSV Importer to Database';
        $model = \common\models\costfit\ImportBrand::deleteAll();
        //$model->deleteAll();
        return $this->render('clear_error', [
            'title' => $title
        ]);
    }

    public function actionClearCategory() {
        $title = 'Clear Error <span class="text-danger">Category</span> Importer CSV Importer to Database';
        $model = \common\models\costfit\ImportCategory::deleteAll();
        //$model->deleteAll();
        $notify = 'success';
        return $this->render('clear_error', [
            'title' => $title, 'notify' => $notify
        ]);
    }

    public function actionClearProduct() {
        $title = 'Clear Error <span class="text-danger">Product</span> Importer CSV Importer to Database';
        $model = \common\models\costfit\ImportProduct::deleteAll();
        //$model->deleteAll();
        $notify = 'success';
        return $this->render('clear_error', [
            'title' => $title, 'notify' => $notify
        ]);
    }

}
