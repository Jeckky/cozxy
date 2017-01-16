<?php

namespace backend\modules\management\controllers;

use Yii;
use common\models\costfit\ImportCategory;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\Upload;

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
                $folderName = "file"; //  file
                $folderThumbnail = "brand"; //  file
                $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail;
                $newFileName = Upload::UploadCSVBrand('File[image]', $folderName, $uploadPath);
                return $this->redirect(['/management/importer']);
            }
        } else {
            return $this->render('brand');
        }
    }

    public function actionCategory() {
        $model = new ImportCategory;
        $request = Yii::$app->request;
        if ($request->isPost) {
            if (isset($_POST["File"])) {
                $folderName = "file"; //  file
                $folderThumbnail = "category"; //  file
                $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail;
                $newFileName = Upload::UploadCSVCategory('File[image]', $folderName, $uploadPath);
                return $this->redirect(['/management/importer']);
            }
        } else {
            return $this->render('category');
        }
    }

    public function actionProduct() {
        $model = new ImportCategory;
        $request = Yii::$app->request;
        if ($request->isPost) {
            if (isset($_POST["File"])) {
                $folderName = "file"; //  file
                $folderThumbnail = "product"; //  file
                $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail;
                $newFileName = Upload::UploadCSVProduct('File[image]', $folderName, $uploadPath);
                return $this->redirect(['/management/importer']);
            }
        } else {
            return $this->render('product');
        }
    }

}
