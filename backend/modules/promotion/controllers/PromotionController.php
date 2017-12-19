<?php

namespace backend\modules\promotion\controllers;

use Yii;
use common\models\costfit\Promotion;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\BackendMasterController;
use common\models\costfit\CategoryToProduct;
use common\models\costfit\Brand;
use common\models\costfit\PromotionBrand;
use common\models\costfit\PromotionCategory;
use common\models\costfit\Category;

/**
 * PromotionController implements the CRUD actions for Promotion model.
 */
class PromotionController extends PromotionMasterController {

    /**
     * @inheritdoc
     */
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
                //  'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Promotion models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Promotion::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    ''
        ]);
    }

    /**
     * Displays a single Promotion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $brands = Brand::find()
                ->select("brand.title")
                ->join("LEFT JOIN", "promotion_brand pb", "pb.brandId=brand.brandId")
                ->where("pb.promotionId=" . $id)
                ->all();
        $textBrand = '';
        $textCate = '';
        if (isset($brands) && count($brands) > 0) {
            $i = 1;
            foreach ($brands as $brand):
                $textBrand.=$i . '. ' . $brand->title . '<br>';
                $i++;
            endforeach;
        }else {
            $textBrand = "All brands";
        }
        $categories = Category::find()
                ->select("category.title")
                ->join("LEFT JOIN", "promotion_category pc", "pc.categoryId=category.categoryId")
                ->where("pc.promotionId=" . $id)
                ->all();
        if (isset($categories) && count($categories) > 0) {
            $i = 1;
            foreach ($categories as $category):
                $textCate.=$i . '. ' . $category->title . '<br>';
                $i++;
            endforeach;
        }else {
            $textCate = "All categories";
        }
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'brands' => $textBrand,
                    'categories' => $textCate
        ]);
    }

    /**
     * Creates a new Promotion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Promotion();
        $categories = CategoryToProduct::find()
                ->select('`category`.categoryId , `category`.title , `category`.parentId ')
                ->join("LEFT JOIN", "category", "category.categoryId = category_to_product.categoryId")
                ->where("category.parentId IS NULL AND category.status=1")
                ->groupBy('category_to_product.categoryId')
                ->orderBy('category.title ASC')
                ->all();
        $brands = Brand::find()
                ->select('brand.image as image, brand.brandId as brandId, brand.title as title')
                ->leftJoin('product p', 'p.brandId=brand.brandId')
                ->where('p.parentId is not null')
                ->andWhere(['p.approve' => 'approve'])
                ->andWhere(['p.status' => 1])
                ->groupBy('brand.brandId')
                ->orderBy('title')
                ->all();
        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            if (isset($_POST["Promotion"]["promotionCode"]) && $_POST["Promotion"]["promotionCode"] != '') {
                $code = $_POST["Promotion"]["promotionCode"];
            } else {
                $code = $this->generatePromotionCode();
            }
            $model->promotionCode = $code;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $model->save(false);
            $brand = isset($_POST["Promotion"]["brand"]) ? $_POST["Promotion"]["brand"] : null;
            $categories = isset($_POST["Promotion"]["category"]) ? $_POST["Promotion"]["category"] : null;
            if (isset($brand) && count($brand) > 0 && !empty($brand)) {
                $this->saveBrandPromotion($brand, $model->promotionId);
            }
            if (isset($categories) && count($categories) > 0 && !empty($categories)) {
                $this->saveCategoryPromotion($categories, $model->promotionId);
            }
            return $this->redirect(['view', 'id' => $model->promotionId]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'categories' => $categories,
                        'brands' => $brands
            ]);
        }
    }

    /**
     * Updates an existing Promotion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $categories = CategoryToProduct::find()
                ->select('`category`.categoryId , `category`.title , `category`.parentId ')
                ->join("LEFT JOIN", "category", "category.categoryId = category_to_product.categoryId")
                ->where("category.parentId IS NULL AND category.status=1")
                ->groupBy('category_to_product.categoryId')
                ->orderBy('category.title ASC')
                ->all();
        $brands = Brand::find()
                ->select('brand.image as image, brand.brandId as brandId, brand.title as title')
                ->leftJoin('product p', 'p.brandId=brand.brandId')
                ->where('p.parentId is not null')
                ->andWhere(['p.approve' => 'approve'])
                ->andWhere(['p.status' => 1])
                ->groupBy('brand.brandId')
                ->orderBy('title')
                ->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $model->save(false);
            $brand = isset($_POST["Promotion"]["brand"]) ? $_POST["Promotion"]["brand"] : '';
            $categories = isset($_POST["Promotion"]["category"]) ? $_POST["Promotion"]["category"] : '';
            if (isset($brand) && count($brand) > 0 && !empty($brand)) {
                $this->saveBrandPromotion($brand, $model->promotionId);
            }
            if (isset($categories) && count($categories) > 0 && !empty($categories)) {
                $this->saveCategoryPromotion($categories, $model->promotionId);
            }
            return $this->redirect(['view', 'id' => $model->promotionId]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'categories' => $categories,
                        'brands' => $brands
            ]);
        }
    }

    /**
     * Deletes an existing Promotion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        $categories = PromotionCategory::find()->where("promotionId=" . $id)->all();
        if (isset($categories) && count($categories) > 0) {
            foreach ($categories as $category):
                $category->delete();
            endforeach;
        }
        $brands = PromotionBrand::find()->where("promotionId=" . $id)->all();
        if (isset($brands) && count($brands) > 0) {
            foreach ($brands as $brand):
                $brand->delete();
            endforeach;
        }
        return $this->redirect(['index']);
    }

    public function actionAllBrand() {
        $brands = Brand::find()
                ->select('brand.image as image, brand.brandId as brandId, brand.title as title')
                ->leftJoin('product p', 'p.brandId=brand.brandId')
                ->where('p.parentId is not null')
                ->andWhere(['p.approve' => 'approve'])
                ->andWhere(['p.status' => 1])
                ->groupBy('brand.brandId')
                ->all();
        $res = [];
        if (isset($brands) && count($brands) > 0) {
            $res["status"] = true;
            $res["count"] = count($brands);
            $i = 0;
            foreach ($brands as $brand):
                $res["brandId"][$i] = $brand->brandId;
                $i++;
            endforeach;
        } else {
            $res["status"] = false;
        }
        return json_encode($res);
    }

    public function actionAllCate() {
        $categories = CategoryToProduct::find()
                ->select('`category`.categoryId , `category`.title , `category`.parentId ')
                ->join("LEFT JOIN", "category", "category.categoryId = category_to_product.categoryId")
                ->where("category.parentId IS NULL AND category.status=1")
                ->groupBy('category_to_product.categoryId')
                ->all();
        $res = [];
        if (isset($categories) && count($categories) > 0) {
            $res["status"] = true;
            $res["count"] = count($categories);
            $i = 0;
            foreach ($categories as $cate):
                $res["cateId"][$i] = $cate->categoryId;
                $i++;
            endforeach;
        } else {
            $res["status"] = false;
        }
        return json_encode($res);
    }

    /**
     * Finds the Promotion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Promotion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Promotion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function generatePromotionCode() {
        $flag = false;
        $characters = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $code = '';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < 10; $i++) {
            $n = $characters[rand(0, $charactersLength - 1)];
            $code = $code . $n;
        }
        while ($flag == false) {
            $promotion = Promotion::find()->where("promotionCode='" . $code . "'")->one(); //Gen จนกว่าจะได้เลขไม่ซ้ำ
            if (isset($promotion)) {
                $code = '';
                for ($j = 0; $j < 10; $j++) {
                    $n = $characters[rand(0, $charactersLength - 1)];
                    $code = $code . $n;
                }
            } else {
                $flag = true;
            }
        }
        return $code;
    }

    public function saveBrandPromotion($brands, $promotionId) {
        $oldPro = PromotionBrand::find()->where("promotionId=" . $promotionId)->all();
        if (isset($oldPro) && count($oldPro) > 0) {
            foreach ($oldPro as $pro):
                $pro->delete();
            endforeach;
        }
        foreach ($brands as $brandId):
            $brandPromotion = PromotionBrand::find()->where("brandId=" . $brandId . " and promotionId=" . $promotionId . "")->one();
            if (!isset($brandPromotion)) {
                $brand = new PromotionBrand();
                $brand->promotionId = $promotionId;
                $brand->brandId = $brandId;
                $brand->createDateTime = new \yii\db\Expression('NOW()');
                $brand->updateDateTime = new \yii\db\Expression('NOW()');
                $brand->status = 1;
                $brand->save(false);
            }
        endforeach;
    }

    public function saveCategoryPromotion($categories, $promotionId) {
        $oldPro = PromotionCategory::find()->where("promotionId=" . $promotionId)->all();
        if (isset($oldPro) && count($oldPro) > 0) {
            foreach ($oldPro as $pro):
                $pro->delete();
            endforeach;
        }
        foreach ($categories as $categoryId):
            $categoryPromotion = PromotionCategory::find()->where("categoryId=" . $categoryId . " and promotionId=" . $promotionId . "")->one();
            if (!isset($categoryPromotion)) {
                $category = new PromotionCategory();
                $category->promotionId = $promotionId;
                $category->categoryId = $categoryId;
                $category->createDateTime = new \yii\db\Expression('NOW()');
                $category->updateDateTime = new \yii\db\Expression('NOW()');
                $category->status = 1;
                $category->save(false);
            }
        endforeach;
    }

}
