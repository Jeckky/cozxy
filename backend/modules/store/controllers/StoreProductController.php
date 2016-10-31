<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\StoreProduct;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\StoreProductGroup;

/**
 * StoreProductController implements the CRUD actions for StoreProduct model.
 */
class StoreProductController extends StoreMasterController {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all StoreProduct models.
     * @return mixed
     */
    public function actionIndex() {
        $storeProductGroupId = '';
        // if (isset($_GET["storeId"])) {
        //  $query = StoreProduct::find()->where("storeId=" . $_GET["storeId"]);
        // } else {
        if (isset($_GET['storeProductGroupId'])) {
            $query = StoreProduct::find()->where("storeProductGroupId=" . $_GET["storeProductGroupId"]);
            $storeProductGroupId = $_GET['storeProductGroupId'];
        } else {
            $query = StoreProduct::find();
        }
        //  }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'storeProductGroupId' => $storeProductGroupId
        ]);
    }

    /**
     * Displays a single StoreProduct model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StoreProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $storeProductGroupId = '';
        $model = new StoreProduct();
        if (isset($_GET["storeId"])) {
            $model->storeId = $_GET["storeId"];
        }
        if (isset($_GET['storeProductGroupId'])) {
            $model->storeProductGroupId = $_GET['storeProductGroupId'];
            $storeProductGroupId = $_GET['storeProductGroupId'];
        }
        if (isset($_POST["StoreProduct"])) {
            $model->attributes = $_POST["StoreProduct"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->total = $model->quantity * $model->price;

            if ($model->save()) {
                $this->updateStoreProductGroupSummary($model->storeProductGroupId);

                return $this->redirect(['index',
                    'storeId' => $model->storeId,
                    'storeProductGroupId' => $storeProductGroupId
                ]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'storeProductGroupId' => $storeProductGroupId
        ]);
    }

    /**
     * Updates an existing StoreProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $storeProductGroupId = '';
        $model = $this->findModel($id);
        if (isset($_GET['storeProductGroupId'])) {
            $storeProductGroupId = $_GET['storeProductGroupId'];
        }
        if (isset($_POST["StoreProduct"])) {
            $model->attributes = $_POST["StoreProduct"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $model->total = $model->quantity * $model->price;

            if ($model->save()) {
                $this->updateStoreProductGroupSummary($model->storeProductGroupId);
                return $this->redirect(['index', 'storeId' => $model->storeId, 'storeProductGroupId' => $_GET['storeProductGroupId']]);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'storeProductGroupId' => $storeProductGroupId
        ]);
    }

    /**
     * Deletes an existing StoreProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = StoreProduct::find()->where("storeProductId='" . $id . "'")->one();
        $store = $model->storeId;
        $storeProductGroupId = $model->storeProductGroupId;
        $model->delete();
        return $this->redirect(['index', 'storeId' => $store, 'storeProductGroupId' => $storeProductGroupId]);
    }

    /**
     * Finds the StoreProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StoreProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StoreProduct::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCheck() {
        if (isset($_GET['storeProductGroupId'])) {
            $model = StoreProductGroup::find()->where("storeProductGroupId='" . $_GET['storeProductGroupId'] . "'")->one();
        }
        $msError = '';
        $errorId = '';
        if (isset($_POST["check"])) {
            $inPo = StoreProduct::find()->where("storeProductId='" . $_POST['storeProductId'] . "'")->one();
            if ($_POST["check"][$inPo->storeProductId] == 1) {
                $inPo->importQuantity = $inPo->quantity;
                $inPo->status = 3;
                $inPo->save(FALSE);
                $this->checkPo($inPo->storeProductGroupId);
                $model = StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "'")->one();
            } else {
                if (!empty($_POST["remark"][$inPo->storeProductId]) && !empty($_POST["quantity"][$inPo->storeProductId])) {
                    if ($_POST["quantity"][$inPo->storeProductId] + $inPo->importQuantity < $inPo->quantity) {
                        $inPo->importQuantity = $_POST["quantity"][$inPo->storeProductId] + $inPo->importQuantity;
                        $inPo->remark = $_POST["remark"][$inPo->storeProductId];
                        $inPo->status = 2;
                        $inPo->save(FALSE);
                        $this->checkPo($inPo->storeProductGroupId);
                        $model = StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "'")->one();
                    } else if ($_POST["quantity"][$inPo->storeProductId] + $inPo->importQuantity == $inPo->quantity) {
                        $inPo->importQuantity = $inPo->quantity;
                        $inPo->remark = $_POST["remark"][$inPo->storeProductId];
                        $inPo->status = 3;
                        $inPo->save(FALSE);
                        $this->checkPo($inPo->storeProductGroupId);
                        $model = StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "'")->one();
                    } else if ($_POST["quantity"][$inPo->storeProductId] + $inPo->importQuantity > $inPo->quantity) {
                        $msError = 'input wrong quantity';
                        $errorId = $inPo->storeProductId;
                        $model = StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "'")->one();
                    }
                } else {
                    $msError = 'Empty import quantity or remark ';
                    $errorId = $inPo->storeProductId;
                    $model = StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "'")->one();
                }
            }
        } else if (isset($_POST["storeProductGroupId"])) {//if click submit but not choose
            $msError = 'Not selected';
            $errorId = $_POST["storeProductId"];
            $model = StoreProductGroup::find()->where("storeProductGroupId='" . $_POST["storeProductGroupId"] . "'")->one();
        }
        return $this->render('check', ['model' => $model,
            'msError' => $msError,
            'errorId' => $errorId
        ]);
    }

    public function actionChoosePo() {
        $ms = '';
        $userId = Yii::$app->user->identity->userId; //login
        $model = new StoreProduct();
        if (isset($_POST["StoreProductGroup"]['poNo']) && !empty($_POST["StoreProductGroup"]['poNo'])) {
            $storeProductGroup = StoreProductGroup::find()->where("poNo='" . $_POST["StoreProductGroup"]['poNo'] . "' and status=2")->one(); // เชค ที่สถานะเท่ากับตรวจรับแล้วเท่านั้น
            if (isset($storeProductGroup) && !empty($storeProductGroup)) {
                $storeProducts = \common\models\costfit\StoreProduct::find()->where("storeProductGroupId=" . $storeProductGroup->storeProductGroupId)->all();
                if (isset($storeProducts) && !empty($storeProducts)) {
                    $this->saveChooesPo($userId, $storeProductGroup->storeProductGroupId);
                } else {
                    $ms = 'ไม่พบสินค้าใน PO นี้';
                }
            } else {
                $ms = 'ไม่พบ PO';
            }
        } else {
            $ms = '';
        }
        $chooseId = StoreProductGroup::find()->where("status=5 and arranger=" . $userId)->all();
        return $this->render('choose_po', [
            'model' => $model,
            'ms' => $ms,
            'chooseId' => $chooseId
        ]
        );
    }

    public function actionDeleteChoosePo() {
        $userId = Yii::$app->user->identity->userId;
        $id = $_GET['id'];
        $ms = '';
        $delete = StoreProductGroup::find()->where("storeProductGroupId=" . $id)->one();
        if (isset($delete) && !empty($delete)) {
            $delete->status = 2;
            $delete->save(false);
        }
        $chooseId = StoreProductGroup::find()->where("status=5 and arranger=" . $userId)->all();
        return $this->redirect('choose-po', [
            'ms' => $ms,
            'chooseId' => $chooseId
        ]
        );
    }

    public function updateStoreProductGroupSummary($productStoreGroupId) {
        $summary = 0;
        $stg = StoreProductGroup::find()->where("storeProductGroupId =" . $productStoreGroupId)->one();
        foreach ($stg->storeProducts as $sp) {
            $summary+= $sp->total;
        }
        $stg->summary = $summary;
        $stg->save();
    }

    public function checkPo($id) {
        $checkPo = StoreProduct::find()->where("storeProductGroupId='" . $id . "' and status!=3")->all();
        if (count($checkPo) == 0) {
            $changePoStatus = StoreProductGroup::find()->where("storeProductGroupId='" . $id . "'")->one();
            $changePoStatus->status = 2;
            $changePoStatus->save(FALSE);
            return $this->redirect(['store-product-group/index']);
        }
    }

    public function saveChooesPo($userId, $storeProductGroupId) {
        $storeProductGroup = StoreProductGroup::find()->where("storeProductGroupId=" . $storeProductGroupId)->one();
        if (isset($storeProductGroup) && !empty($storeProductGroup)) {
            $storeProductGroup->status = 5;
            $storeProductGroup->arranger = $userId;
            $storeProductGroup->updateDateTime = new \yii\db\Expression('NOW()');
            $storeProductGroup->save(false);
            $storeProduct = StoreProduct::find()->where("storeProductGroupId=" . $storeProductGroupId)->all();
            if (isset($storeProduct) && !empty($storeProduct)) {
                foreach ($storeProduct as $item):
                    $item->status = 5;
                    $item->save(false);
                endforeach;
            }
        }
    }

    public function actionArrange() {
        $ms = '';
        $userId = Yii::$app->user->identity->userId;
        $model = new StoreProduct();
        $allPo = StoreProductGroup::find()->where("status=5 and arranger=" . $userId . " order by receiveDate")->all();
        if (isset($_POST["StoreProductGroup"]['poNo']) && !empty($_POST["StoreProductGroup"]['poNo'])) {
            $storeProductGroup = StoreProductGroup::find()->where("poNo='" . $_POST["StoreProductGroup"]['poNo'] . "' and status=5")->one(); // เชค ที่สถานะเท่ากับตรวจรับแล้วเท่านั้น
            if (isset($storeProductGroup) && !empty($storeProductGroup)) {
                $storeProducts = \common\models\costfit\StoreProduct::find()->where("storeProductGroupId=" . $storeProductGroup->storeProductGroupId)->all();
                if (isset($storeProducts) && !empty($storeProducts)) {
                    return $this->render('arrange_index', [
                        'ms' => $ms,
                        'storeProductGroupId' => $storeProductGroup->storeProductGroupId,
                        'storeProducts' => $storeProducts,
                        'model' => $model
                    ]);
                } else {
                    $ms = 'ไม่พบสินค้าใน PO นี้';
                }
            } else {
                $ms = 'ไม่พบ PO';
            }
        }//
        if (isset($_POST["StoreProduct"]['isbn']) && !empty($_POST["StoreProduct"]['isbn'])) {//สแกน บาร์โค้ดสินค้าเพื่อจัดเรียง
            $storeProductGroup = StoreProductGroup::find()->where("poNo='" . $_POST["StoreProductGroup2"]['poNo'] . "'")->one();
            if (isset($storeProductGroup) && !empty($storeProductGroup)) {
                $product = \common\models\costfit\Product::find()->select("product.*,sp.*")->where("isbn ='" . $_POST["StoreProduct"]['isbn'] . "'")
                ->join("LEFT JOIN", 'store_product sp', 'product.productId=sp.productId and sp.storeProductGroupId=' . $storeProductGroup->storeProductGroupId . ' and (sp.status=5 or sp.status=3)')
                ->orderBy('sp.createDateTime ASC')
                ->one();
                if (isset($product->productId)) {
                    return $this->render('arrange', [
                        'model' => $product,
                        'poNo' => $_POST["StoreProductGroup2"]['poNo'],
                        'isbn' => $_POST["StoreProduct"]['isbn']
                    ]);
                } else {//ถ้า ไม่เจอสินค้าหรือจัดเรียงไปแล้ว
                    $ms = 'Imported products not found.';
                    $storeProductGroup = StoreProductGroup::find()->where("poNo='" . $_POST["StoreProductGroup2"]['poNo'] . "' and status=5")->one(); // เชค ที่สถานะเท่ากับตรวจรับแล้วเท่านั้น
                    if (isset($storeProductGroup) && !empty($storeProductGroup)) {
                        $storeProducts = \common\models\costfit\StoreProduct::find()->where("storeProductGroupId=" . $storeProductGroup->storeProductGroupId)->all();
                        if (isset($storeProducts) && !empty($storeProducts)) {

                            return $this->render('arrange_index', [
                                'ms' => $ms,
                                'storeProductGroupId' => $storeProductGroup->storeProductGroupId,
                                'storeProducts' => $storeProducts,
                                'model' => $model
                            ]);
                        } else {
                            $ms = 'ไม่พบสินค้าใน PO นี้';
                        }
                    } else {
                        $ms = 'PO not found';
                    }
                }
            } else {
                $ms = 'PO not found.';
            }
        }
        if (isset($_POST['arrange']) && $_POST['arrange'] == 'arrange') {//มาจาหน้าจัดเรียง
            $product = \common\models\costfit\Product::find()->select("product.*,sp.*")->where("isbn ='" . $_POST['isbn'] . "'")
            ->join("LEFT JOIN", 'store_product sp', 'product.productId=sp.productId and sp.storeProductGroupId=' . $_POST['storeProductGroupId'] . ' and (sp.status=5 or sp.status=3)')
            ->orderBy('sp.createDateTime ASC')
            ->one();
            if (isset($_POST['quantity']) && isset($_POST['slot']) && !empty($_POST['quantity']) && !empty($_POST['slot'])) {//จัดเรียง
                $slot = \common\models\costfit\StoreSlot::find()->where("barcode='" . $_POST["slot"] . "'")->one();
                if (isset($slot) && !empty($slot)) {
                    $canSave = false;
                    $canSave = $this->checkOver($_POST['storeProductId'], $_POST['quantity'], $product->productId);
                    if ($canSave == true) {
                        StoreProduct::arrangeProductToSlot($_POST['storeProductId'], $slot->storeSlotId, $_POST['quantity']);
                        $clear = false;
                        $clear = $this->checkClear($product->storeProductGroupId);
                        if ($clear == true) {
                            $clearPo = false;
                            $clearPo = $this->checkClearPo($userId);
                            if ($clearPo == true) {
                                return $this->redirect('choose-po'); // ถ้าหมด PO ที่เลือกมาแล้ว กลับไปหน้าแรก
                            } else {
                                $allPo = StoreProductGroup::find()->where("status=5 order by receiveDate")->all(); //หมด สินค้าแล้วกลับไป po ถัดไป
                                return $this->render('scan_order', [
                                    'allPo' => $allPo,
                                    'ms' => $ms
                                ]);
                            }
                        } else {
                            $model = new StoreProduct();
                            $storeProducts = \common\models\costfit\StoreProduct::find()->where("storeProductGroupId=" . $product->storeProductGroupId)->all();
                            return $this->render('arrange_index', [
                                'ms' => $ms,
                                'storeProductGroupId' => $product->storeProductGroupId,
                                'storeProducts' => $storeProducts,
                                'model' => $model
                            ]);
                        }
                    } else {//ถ้าใส่จำนวนเกิน ยอดที่ import ใน po นั้น
                        $ms = 'ไม่สามารถจัดเรียงได้เนื่องจากใส่จำนวนเกิน';
                        return $this->render('arrange', [
                            'model' => $product,
                            'isbn' => $_POST['isbn'],
                            'ms' => $ms
                        ]);
                    }
                } else {
                    $ms = 'ไม่มี Slot " ' . $_POST['slot'] . ' "';
                    return $this->render('arrange', [
                        'model' => $product,
                        'isbn' => $_POST['isbn'],
                        'ms' => $ms
                    ]);
                }
            } else {
                return $this->render('arrange', [
                    'model' => $product,
                    'isbn' => $_POST['isbn'],
                    'ms' => $ms
                ]);
            }
        }
        return $this->render('scan_order', [
            'allPo' => $allPo,
            'ms' => $ms
        ]);
    }

    public static function checkOver($storeProductId, $quantity, $productId) {
        $total = 0;
        $storeProductArranges = \common\models\costfit\StoreProductArrange::find()->where("storeProductId=" . $storeProductId . " and productId=" . $productId)->all();
        if (isset($storeProductArranges) && !empty($storeProductArranges)) {
            foreach ($storeProductArranges as $storeProductArrange):
                $total+=$storeProductArrange->quantity;
            endforeach;
        }
        //throw new \yii\base\Exception($storeProductId . " total " . $total . " re " . $quantity);
        $storeProduct = StoreProduct::find()->where("storeProductId=" . $storeProductId . " and productId=" . $productId)->one();
        if (($quantity + $total) <= $storeProduct->importQuantity) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkClear($storeProductGroupId) {
        $storeProduct = count(StoreProduct::find()->where("storeProductGroupId=" . $storeProductGroupId . " and (status<4 or status=5)")->all());
        if ($storeProduct == 0) {//หมดสินค้าใน PO
            $storeProductGroup = StoreProductGroup::find()->where("storeProductGroupId=" . $storeProductGroupId)->one();
            $storeProductGroup->status = 4;
            $storeProductGroup->save(false);
            return true;
        } else {
            return false;
        }
    }

    public static function checkClearPo($userId) {
        $storeProductGroup = StoreProductGroup::find()->where("arranger=" . $userId . " and (status=5 or status=3)")->all();
        if (isset($storeProductGroup) && !empty($storeProductGroup)) {
            return false;
        } else {
            return true;
        }
    }

}
