<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\Brand;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BrandController implements the CRUD actions for Brand model.
 */
class PromotionController extends ProductMasterController
{

    public function behaviors()
    {
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
     * Lists all Brand models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = \common\models\costfit\Configuration::find()->where("title = 'promotionIds'")->one();
//        $productSupps = \common\models\costfit\ProductSuppliers::find()
//        ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = product_suppliers.productSuppId")
//        ->where("pps.status = 1 AND product_suppliers.result > 0 AND pps.price > 0")
//        ->all();
        if (!isset($model)) {
            $newPs = \common\models\costfit\ProductSuppliers::find()->where("approve = 'approve' AND result > 0")->orderBy("updateDateTime DESC")->limit(6)->all();
            $promotionIds = "";
            foreach ($newPs as $i => $item) {
                $promotionIds .=$item->productSuppId;
                if ($i < count($newPs) - 1) {
                    $promotionIds .= ",";
                }
            }
            $model = new \common\models\costfit\Configuration();
            $model->title = "promotionIds";
            $model->description = "Product SupplierId สำหรับแสดง Promotion หน้าบ้าน";
            $model->value = $promotionIds;
            $model->createDateTime = new yii\db\Expression("NOW()");
            $model->save();
        } else {
            $promotionIds = $model->value;
        }
        $promotionIds = explode(",", $promotionIds);

        if (isset($_POST['Configuration'])) {
//            throw new \yii\base\Exception(print_r($_POST['Configuration']['value']));
            $model->value = implode(",", $_POST['Configuration']['value']);
            $model->save();
            return $this->redirect(['index']);
        }
        return $this->render('index', [
            'model' => $model,
            'promotionIds' => $promotionIds,
        ]);
    }

    protected function findModel()
    {

        if (isset($model)) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
