<?php

namespace backend\modules\productpost\controllers;

use Yii;
use common\models\costfit\Section;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\SectionItem;
use common\models\costfit\Product;
use common\models\costfit\ProductSuppliers;

/**
 * SectionController implements the CRUD actions for Section model.
 */
class SectionController extends ProductPostMasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
// 'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Section models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Section::find()->orderBy("sort"),
        ]);
        $model = new Section();
        $total = count(Section::find()->where(1)->all());
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'total' => $total
        ]);
    }

    /**
     * Displays a single Section model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Section model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Section();
// throw new \yii\base\Exception(print_r($_POST["Section"], true));
        if (isset($_POST["Section"])) {
            $model->title = $_POST["Section"]["title"];
            $model->description = $_POST["Section"]["description"];
            if (isset($_POST["Section"]["status"])) {
                $countShow = count(Section::find()->where("status=1")->all());
                if ($countShow >= 3) {
                    $model->status = 0;
                } else {
                    $model->status = 1;
                }
            } else {
                $model->status = 0;
            }
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $model->save();
        }
        return $this->redirect('index');
    }

    /**
     * Updates an existing Section model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if (isset($_POST["Section"])) {
            $model->title = $_POST["Section"]["title"];
            $model->description = $_POST["Section"]["description"];
            if (isset($_POST["Section"]["status"])) {
                $model->status = 1;
            } else {
                $model->status = 0;
            }
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $model->save();
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAddProduct($id) {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $dataProvider = new ActiveDataProvider([
            'query' => SectionItem::find()->where("sectionId=" . $id),
        ]);

        $model = new SectionItem();
        $section = Section::find()->where("sectionId=" . $id)->one();
        return $this->render('add_product', [
                    'section' => $section,
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChooseProduct() {
        $queryVariableProducts = Product::find()
                ->join('LEFT JOIN', 'product_suppliers', 'product.productId=product_suppliers.productId')
                ->where('product.approve="approve" and product.status=1 and product_suppliers.approve="approve" and product_suppliers.status=1 and product_suppliers.result>0');
        if (isset($_GET['title']) && $_GET['title'] != '') {
            $queryVariableProducts->andWhere("product.title like %'" . $_GET['title'] . "'%");
        }
        if (isset($_GET['CategoryId']) && $_GET['CategoryId'] != '') {
            $queryVariableProducts->andWhere("product.categoryId=" . $_GET['CategoryId']);
        }
        if (isset($_GET['BrandId']) && $_GET['BrandId'] != '') {
            $queryVariableProducts->andWhere("product.brandId=" . $_GET['BrandId']);
        }
        $varibleProduct = new ActiveDataProvider([
            'query' => $queryVariableProducts
        ]);
        $section = Section::find()->where("sectionId=" . $_GET["sectionId"])->one();
        return $this->render('choose_product', [
                    'varibleProduct' => $varibleProduct,
                    'section' => $section,
        ]);
    }

    public function actionAddProductToSection() {
        $productId = $_POST["productId"];
        $productSuppId = $_POST["productSuppId"];
        $sectionId = $_POST["sectionId"];
        $res = [];
        $section = Section::find()->where("sectionId=" . $sectionId)->one();
        $product = Product::find()->where("productId=" . $productId)->one();
        $sectionItem = SectionItem::find()->where("sectionId=" . $sectionId . " and productId=" . $productId . " and productSuppId=" . $productSuppId)->one();
        if (isset($sectionItem)) {
            $sectionItem->delete();
            $res["status"] = true;
            $res["text"] = "Delete " . $product->title . " from sectoin " . $section->title . " success.";
        } else {
            $sectionItems = new SectionItem();
            $sectionItems->productId = $productId;
            $sectionItems->productSuppId = $productSuppId;
            $sectionItems->sectionId = $sectionId;
            $sectionItems->status = 1;
            $sectionItems->createDateTime = new \yii\db\Expression('NOW()');
            $sectionItems->updateDateTime = new \yii\db\Expression('NOW()');
            if ($sectionItems->save(false)) {

                $res["status"] = true;
                $res["text"] = "Add " . $product->title . " to sectoin " . $section->title . " success.";
            } else {
                $res["status"] = false;
            }
        }
        return json_encode($res);
    }

    public function actionShowSectionItem() {
        $sectionItemId = $_POST["sectionItemId"];
        $sectionItem = SectionItem::find()->where("sectionItemId=" . $sectionItemId)->one();
        if ($sectionItem->status == 1) {
            $sectionItem->status = 0;
        } else {
            $sectionItem->status = 1;
        }
        $sectionItem->updateDateTime = new \yii\db\Expression("NOW()");
        $sectionItem->save();
    }

    public function actionShowSection() {
        $sectionId = $_POST["sectionId"];
        $section = section::find()->where("sectionId=" . $sectionId)->one();
        if ($section->status == 1) {
            $section->status = 0;
        } else {
            $section->status = 1;
        }
        $section->updateDateTime = new \yii\db\Expression("NOW()");
        $section->save();
    }

    /**
     * Deletes an existing Section model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteItem($id) {
        $sectionItem = SectionItem::find()->where("sectionItemId=" . $id)->one();
        $sectionId = $sectionItem->sectionId;
        $sectionItem->delete();
        return $this->redirect(['add-product?id=' . $sectionId]);
    }

    /**
     * Finds the Section model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Section the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Section::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSortSection() {
        $sectionId = $_POST["id"];
        $type = $_POST["action"];
        $total = $_POST["total"];
        $res = [];
        $section = Section::find()->where("sectionId=" . $sectionId)->one();
        if ($type == 1) {
            $sort = $section->sort + 1;
            if ($sort > $total) {
                $sort = $total;
                $res["status"] = false;
            } else {
                $res["status"] = true;
            }
        } else {
            $sort = $section->sort - 1;
            if ($sort <= 0) {
                $sort = 1;
                $res["status"] = false;
            } else {
                $res["status"] = true;
            }
        }
        $section->sort = $sort;
        $section->save(false);
        $res["sort"] = $sort;
        return json_encode($res);
    }

}
