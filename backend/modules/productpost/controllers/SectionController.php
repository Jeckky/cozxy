<?php

namespace backend\modules\productpost\controllers;

use Yii;
use common\models\costfit\Section;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
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
        if (isset($_POST["Section"])) {
            //throw new \yii\base\Exception(print_r($_POST["Section"], true));
            $model->title = $_POST["Section"]["title"];
            $model->description = $_POST["Section"]["description"];
            if (isset($_POST["Section"]["status"])) {
                $countShow = count(Section::find()->where("status=1")->all());
                $maxSort = Section::find()->where("1")->orderBy("sort DESC")->one();
                if (isset($maxSort)) {
                    $model->sort = $maxSort->sort + 1;
                } else {
                    $model->sort = 1;
                }
                if ($countShow >= 3) {
                    $model->status = 0;
                } else {
                    $model->status = 1;
                }
            } else {
                $model->status = 0;
            }

            $imageObj = \yii\web\UploadedFile::getInstanceByName('Section[image]');
            if (isset($imageObj) && !empty($imageObj)) {
                $folderName = "section";
                $file = $imageObj->name;
                $filenameArray = explode('.', $file);
                $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile = $urlFolder . $fileName;
                $uploadFile = 'images/' . $folderName . "/" . $fileName;
                $model->image = $uploadFile;
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777);
                }
                $imageObj->saveAs($urlFile);
            }


            $model->type = $_POST["Section"]["type"];
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
            $imageObj = \yii\web\UploadedFile::getInstanceByName('Section[image]');
            if (isset($imageObj) && !empty($imageObj)) {
                $folderName = "section";
                $file = $imageObj->name;
                $filenameArray = explode('.', $file);
                $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile = $urlFolder . $fileName;
                $uploadFile = 'images/' . $folderName . "/" . $fileName;
                $model->image = $uploadFile;
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777);
                }
                $imageObj->saveAs($urlFile);
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
        /* $queryVariableProducts = ProductSuppliers::find()
          //->join('LEFT JOIN', 'section_item si', 'si.sectionId=' . $_GET["sectionId"])
          ->join('LEFT JOIN', 'section_item si', 'si.productSuppId=product_suppliers.productSuppId')
          ->join('RIGHT JOIN', 'product p', 'product_suppliers.productId=p.productId')
          ->join(" LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = product_suppliers.productSuppId")
          //->join('LEFT JOIN', 'section_item si', 'si.sectionId=' . $_GET["sectionId"])
          ->where('p.productSuppId is null and p.parentId is not null and p.approve="approve" and p.status=1 and product_suppliers.approve="approve" and product_suppliers.status=1 and product_suppliers.result>0 AND pps.status =1 AND  pps.price > 0')
          ->andWhere("si.sectionId=" . $_GET['sectionId'])
          ->orderBy("si.sectionId DESC"); */
        // ->orderBy("si.sectionId DESC");
        //->andWhere('product.status=1 and product_suppliers.status=1  and product_suppliers.result>0 AND pps.status =1 AND  pps.price > 0');
        if (isset($_GET['sort'])) {
            $sort = "percent " . $_GET['sort'];
        } else {
            $sort = "percent DESC";
        }
//        $queryVariableProducts = SectionItem::find()
//                ->select('p.productId as productId,ps.productSuppId as productSuppId, pps.price as price,ps.title as title,p.price as marketPrice,100-(100*(pps.price/p.price)) as percent')
//                ->join("RIGHT JOIN", "product_suppliers ps", "ps.productSuppId = section_item.productSuppId")
//                ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
//                ->join('LEFT JOIN', 'product p', 'ps.productId=p.productId')
//                // ->where('p.productSuppId is null and p.parentId is not null and p.approve="approve" and p.status=1 and ps.approve="approve" and ps.status=1 and ps.result>0 AND pps.status =1 AND  pps.price > 0 or (section_item.sectionId=' . $_GET["sectionId"] . ' or section_item.sectionId is null) or section_item.sectionId is not null')
//                ->where('p.productSuppId is null and p.parentId is not null and p.approve="approve" and p.status=1 and ps.approve="approve" and ps.status=1 and ps.result>0 AND pps.status =1 AND  pps.price > 0 and p.price>0 or section_item.productId is not null')
//                ->groupBy('ps.productSuppId,section_item.productSuppId,p.productSuppId')
//                ->orderBy("section_item.status DESC,section_item.sectionId ASC," . $sort);
        $sectionItemModels = SectionItem::find()->where(['sectionId'=>$_GET["sectionId"]])->select('productId')->all();
        $array = ArrayHelper::map($sectionItemModels, 'productId','productId');
        $productIdInSection = implode(',', $array);
        $queryVariableProducts = Product::find()
                            ->select('product.productId as productId,ps.productSuppId as productSuppId, pps.price as price,ps.title as title,product.price as marketPrice,100-(100*(pps.price/product.price)) as percent')
        ->leftJoin('product_suppliers ps', 'product.productId=ps.productId')
        ->leftJoin('product_price_suppliers pps', 'pps.productSuppId=ps.productSuppId')
        ->where('ps.productId is not null')
        ->andWhere(['product.approve'=>'approve', 'product.status'=>1])
        ->andWhere(['ps.approve'=>'approve', 'ps.status'=>1])
        ->andWhere('ps.result > 0')
        ->andWhere(['pps.status'=>1])
        ->andWhere('pps.price > 0');
            if($productIdInSection != '') {
                $queryVariableProducts->andWhere("product.productId not in ($productIdInSection)");
            }

        if (isset($_GET['title']) && $_GET['title'] != '') {
            $queryVariableProducts->andWhere("product.title like '%" . $_GET['title'] . "%'");
        }
        if (isset($_GET['categoryId']) && $_GET['categoryId'] != '') {
            $queryVariableProducts->andWhere("product.categoryId=" . $_GET['categoryId']);
        }
        if (isset($_GET['brandId']) && $_GET['brandId'] != '') {
            $queryVariableProducts->andWhere("product.brandId=" . $_GET['brandId']);
        }
        $varibleProduct = new ActiveDataProvider([
            'query' => $queryVariableProducts
        ]);
        $section = Section::find()->where("sectionId=" . $_GET["sectionId"])->one();
        return $this->render('choose_product', [
                    'varibleProduct' => $varibleProduct,
                    'section' => $section,
                    'sort' => isset($_GET['sort']) ? $_GET['sort'] : 'ASC'
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
        return $this->redirect(['add-product', 'id' => $sectionId]);
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
            throw new NotFoundHttpException('The requested page does not exist.



















        ');
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
