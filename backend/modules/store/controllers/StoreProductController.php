<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\StoreProduct;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\StoreProductGroup;
use common\models\costfit\Po;
use common\models\costfit\PoItem;

/**
 * StoreProductController implements the CRUD actions for StoreProduct model.
 */
class StoreProductController extends StoreMasterController {

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
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        if (!isset(Yii::$app->user->identity->userId)) {
            return $this->redirect($baseUrl . '/auth');
        }
        $storeProductGroupId = '';
        // if (isset($_GET["storeId"])) {
        //  $query = StoreProduct::find()->where("storeId=" . $_GET["storeId"]);
        // } else {
        if (isset($_GET['poId'])) {
            $query = PoItem::find()->where("poId=" . $_GET["poId"]);
            $poId = $_GET['poId'];
        } else {
            $query = PoItem::find();
        }
        //  }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'poId' => $poId
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
        if (isset($_GET['poId'])) {
            $model = Po::find()->where("poId='" . $_GET['poId'] . "'")->one();
        }
        $msError = '';
        $errorId = '';
        if (isset($_POST["check"])) {
            $inPo = PoItem::find()->where("poItemId='" . $_POST['poItemId'] . "'")->one();
            if ($_POST["check"][$inPo->poItemId] == 1) {
                $inPo->importQuantity = $inPo->quantity;
                $inPo->status = 3;
                $inPo->save(FALSE);
                $this->checkPo($inPo->poId);
                $model = Po::find()->where("poId='" . $inPo->poId . "'")->one();
            } else {
                //throw new \yii\base\Exception($_POST["quantity"][$inPo->storeProductId]);
                if (!empty($_POST["remark"][$inPo->poItemId]) && !empty($_POST["quantity"][$inPo->poItemId])) {
                    if ($_POST["quantity"][$inPo->poItemId] + $inPo->importQuantity < $inPo->quantity) {
                        $inPo->importQuantity = $_POST["quantity"][$inPo->poItemId] + $inPo->importQuantity;
                        $inPo->remark = $_POST["remark"][$inPo->poItemId];
                        $inPo->status = 2;
                        $inPo->save(FALSE);
                        $this->checkPo($inPo->poId);
                        $model = Po::find()->where("poId='" . $inPo->poId . "'")->one();
                    } else if ($_POST["quantity"][$inPo->poItemId] + $inPo->importQuantity == $inPo->quantity) {
                        $inPo->importQuantity = $inPo->quantity;
                        $inPo->remark = $_POST["remark"][$inPo->poItemId];
                        $inPo->status = 3;
                        $inPo->save(FALSE);
                        $this->checkPo($inPo->poId);
                        $model = Po::find()->where("PoId='" . $inPo->poId . "'")->one();
                    } else if ($_POST["quantity"][$inPo->poItemId] + $inPo->importQuantity > $inPo->quantity) {
                        $msError = 'input wrong quantity';
                        $errorId = $inPo->poItemId;
                        $model = Po::find()->where("poId='" . $inPo->poId . "'")->one();
                    }
                } else {
                    // throw new \yii\base\Exception($inPo->storeProductId);
                    $msError = 'Empty import quantity or remark ';
                    $errorId = $inPo->poItemId;
                    $model = Po::find()->where("poId='" . $inPo->poId . "'")->one();
                }
            }
        } else if (isset($_POST["poId"])) {//if click submit but not choose
            $msError = 'Not selected';
            $errorId = $_POST["poItemId"];
            $model = Po::find()->where("poId='" . $_POST["poId"] . "'")->one();
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
        if (isset($_POST["po"]['poNo']) && !empty($_POST["po"]['poNo'])) {
            $po = Po::find()->where("poNo='" . $_POST["po"]['poNo'] . "' and status=2")->one(); // เชค ที่สถานะเท่ากับตรวจรับแล้วเท่านั้น
            if (isset($po)) {
                $poItems = PoItem::find()->where("poId=" . $po->poId)->all();
                if (isset($poItems) && !empty($poItems)) {
                    $this->saveChooesPo($userId, $po->poId);
                } else {
                    $ms = 'ไม่พบสินค้าใน PO นี้';
                }
            } else {
                $ms = 'ไม่พบ PO';
            }
        } else {
            $ms = '';
        }
        $chooseId = Po::find()->where("status=5 and arranger=" . $userId)->all();
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
        $delete = Po::find()->where("poId=" . $id)->one();
        if (isset($delete) && !empty($delete)) {
            $delete->status = 2;
            $delete->arranger = NULL;
            $delete->save(false);
            $deleteItems = PoItem::find()->where("poId=" . $id)->all();
            foreach ($deleteItems as $item):
                $item->status = 2;
                $item->save(FALSE);
            endforeach;
        }
        $chooseId = Po::find()->where("status=5 and arranger=" . $userId)->all();
        return $this->redirect(['choose-po',
                    'ms' => $ms,
                    'chooseId' => $chooseId
                        ]
        );
    }

    public function updateStoreProductGroupSummary($poId) {
        $summary = 0;
        $stg = Po::find()->where("poId =" . $poId)->one();
        foreach ($stg->poItem as $sp) {
            $summary += $sp->total;
        }
        $stg->summary = $summary;
        $stg->save();
    }

    public function checkPo($id) {
        $checkPo = PoItem::find()->where("poId='" . $id . "' and status!=3")->all();
        if (count($checkPo) == 0) {
            $changePoStatus = Po::find()->where("poId='" . $id . "'")->one();
            $changePoStatus->receiveDate = new \yii\db\Expression('NOW()');
            $changePoStatus->status = 2;
            $changePoStatus->receiveBy = Yii::$app->user->identity->userId;
            $changePoStatus->save(FALSE);
            return $this->redirect(['store-product-group/index']);
        }
    }

    public function saveChooesPo($userId, $poId) {
        $po = Po::find()->where("poId=" . $poId)->one();
        if (isset($po)) {
            $po->status = 5;
            $po->arranger = $userId;
            $po->updateDateTime = new \yii\db\Expression('NOW()');
            $po->save(false);
            $poItems = PoItem::find()->where("poId=" . $poId)->all();
            if (isset($poItems) && !empty($poItems)) {
                foreach ($poItems as $item):
                    $item->status = 5;
                    $item->save(false);
                endforeach;
            }
        }
    }

    public function actionArrange() {
        $ms = '';
        $failPo = '';
        $userId = Yii::$app->user->identity->userId;
        $po = '';
        $product = [];
        $allPo = Po::find()->where("status=5 and arranger=" . $userId . " order by receiveDate")->all();
        if (isset($_POST["poItem"]['isbn']) && !empty($_POST["poItem"]['isbn'])) {//สแกน บาร์โค้ดสินค้าเพื่อจัดเรียง
            /* $products = \common\models\costfit\Product::find()->select("product.*,sp.*")->where("isbn ='" . $_POST["StoreProduct"]['isbn'] . "'")
              ->join("LEFT JOIN", 'store_product sp', 'product.productId=sp.productId and sp.storeProductGroupId in (' . $_POST['storeProductGroupId'] . ') and (sp.status=5 or sp.status=3)')
              ->orderBy('sp.createDateTime ASC')
              ->all(); */
            //$isbn = \common\models\costfit\Product::find()->where("isbn='" . $_POST["StoreProduct"]['isbn'] . "'")->one();
            $poItems = PoItem::find()->where("poId in (" . $_POST['poId'] . ")")->all();
            $suppId = '';
            if (isset($poItems) && count($poItems) > 0) {
                foreach ($poItems as $poItem):
                    $suppId = $suppId . $poItem->productSuppId . ",";
                endforeach;
                $suppId = substr($suppId, 0, -1);
            }
            // throw new \yii\base\Exception(print_r($storeProductIds, true));
            $isbn = \common\models\costfit\ProductSuppliers::find()->where("isbn='" . $_POST["poItem"]['isbn'] . "' and productSuppId in (" . $suppId . ")")->one();
            if (isset($isbn) && !empty($isbn)) {
                //$products = StoreProduct::find()->where("productId=" . $isbn->productId . " and storeProductGroupId in (" . $_POST['storeProductGroupId'] . ") and status in (3,5)")->all();
                $products = PoItem::find()->where("productSuppId=" . $isbn->productSuppId . " and poId in (" . $_POST['poId'] . ") and status in (3,5)")->all();
            }
            //throw new \yii\base\Exception($isbn->productSuppId);
            if (isset($products) && count($products) > 0) {
                return $this->render('arrange', [
                            'model' => $products,
                            'choosePo' => $_POST['poId'],
                            'isbn' => $_POST["poItem"]['isbn'],
                            'allProducts' => $_POST['allProduct'],
                            'productSuppId' => $suppId
                ]);
            } else {//ถ้า ไม่เจอสินค้าหรือจัดเรียงไปแล้ว
                $ms = 'Imported products not found.';
                return $this->render('arrange_index', [
                            'ms' => $ms,
                            'choosePo' => $_POST['poId'],
                            'allProducts' => $_POST['allProduct'],
                            'productSuppId' => $suppId
                ]);
            }
        }
        if (isset($_POST['arrange']) && $_POST['arrange'] == 'arrange') {//มาจาหน้าจัดเรียง
            /* $product = \common\models\costfit\Product::find()->select("product.*,sp.*")->where("isbn ='" . $_POST['isbn'] . "'")
              ->join("LEFT JOIN", 'store_product sp', 'product.productId=sp.productId and sp.storeProductGroupId=' . $_POST['storeProductGroupId'] . ' and (sp.status=5 or sp.status=3)')
              ->orderBy('sp.createDateTime ASC')
              ->one(); */
            //$productId = \common\models\costfit\Product::find()->where("isbn ='" . $_POST['isbn'] . "'")->one();
            $productId = \common\models\costfit\ProductSuppliers::find()->where("isbn ='" . $_POST['isbn'] . "' and productSuppId in (" . $_POST['productSuppId'] . ")")->one();
            //$products = StoreProduct::find()->where("productId=" . $productId->productId . " and storeProductGroupId in (" . $_POST['storeProductGroupId'] . ") and status in (3,5)")->all();
            $products = PoItem::find()->where("productSuppId=" . $productId->productSuppId . " and poId in (" . $_POST['poId'] . ") and status in (3,5)")->all();
            if (isset($_POST['slot']) && !empty($_POST['slot'])) {//จัดเรียง
                $slot = \common\models\costfit\StoreSlot::find()->where("barcode='" . $_POST["slot"] . "'")->one();
                if (isset($slot)) {
                    if (isset($_POST['quantity']) && !empty($_POST['quantity'])) {
                        // throw new \yii\base\Exception(print_r($_POST['quantity'], true));
                        $i = 1; //เอาไว้นับจำนวน quantity ที่กรอกมา ว่ามีทั้งหมดกี่ po
                        foreach ($_POST['quantity'] as $poId => $quantity):
                            if (($quantity != NULL) && ($quantity != 0)) {//ทำเฉพาะที่ได้กรอกจำนวนมาเท่านั้น
                                $canSave = false;
                                $canSave = $this->checkOver($poId, $quantity, $productId->productSuppId); // ค้างเชคฟังก์ชันนี้
                                if ($canSave == true) {
                                    $poItemId = $this->findPoItemId($poId, $productId->productSuppId);
                                    StoreProduct::arrangeProductToSlot($poItemId, $slot->storeSlotId, $quantity); //จัดเรียง
                                    $clear = false;
                                    $clear = $this->checkClear($poId);
                                    if ($clear == true) {//ถ้า po นั้นจัดเรียงหมดแล้ว
                                        $clearPo = false;
                                        $clearPo = $this->checkClearPo($userId);
                                        if ($clearPo == true) {//ถ้า po ที่เลือกมาจัดเรียงหมดแล้ว กลับไปหน้าเลือก PO
                                            if ($i == count($_POST['quantity'])) {
                                                return $this->redirect('choose-po'); // ถ้าหมด PO ที่เลือกมาแล้ว กลับไปหน้าแรก
                                            }
                                        } else { // ถ้ายังไม่หมด กลับไปหน้า scan product (arrange_index)
//                                        $allPo = StoreProductGroup::find()->where("status=5 order by receiveDate")->all(); //หมด สินค้าแล้วกลับไป po ถัดไป
//                                        return $this->render('scan_order', [
//                                                    'allPo' => $allPo,
//                                                    'ms' => $ms
//                                        ]);
                                            if ($i == count($_POST['quantity'])) {
                                                if ($ms == '') {
                                                    return $this->render('arrange_index', [
                                                                'allProducts' => $_POST['allProduct'],
                                                                'choosePo' => $_POST['poId'],
                                                                'ms' => $ms
                                                    ]);
                                                } else {
                                                    //$products = StoreProduct::find()->where("productId=" . $productId->productId . " and storeProductGroupId in (" . $_POST['storeProductGroupId'] . ") and status in (3,5)")->all();
                                                    $products = PoItem::find()->where("productSuppId=" . $productId->productSuppId . " and poId in (" . $_POST['poId'] . ") and status in (3,5)")->all();
                                                    return $this->render('arrange', [
                                                                'model' => $products,
                                                                'choosePo' => $_POST['poId'],
                                                                'isbn' => $_POST['isbn'],
                                                                'allProducts' => $_POST['allProduct'],
                                                                'ms' => $ms,
                                                                'aSlot' => $_POST['slot'],
                                                                'productSuppId' => $_POST['productSuppId']
                                                    ]);
                                                }
                                            }
                                        }
                                    } else {//ถ้า po ที่เลือกมา จัดเรียงสินค้านั้นยังไม่หมด
//                                    $storeProducts = \common\models\costfit\StoreProduct::find()->where("storeProductGroupId=" . $product->storeProductGroupId)->all();
                                        if ($i == count($_POST['quantity'])) {
                                            if ($ms == '') {
                                                return $this->render('arrange_index', [
                                                            'allProducts' => $_POST['allProduct'],
                                                            'choosePo' => $_POST['poId'],
                                                ]);
                                            } else {
                                                $products = PoItem::find()->where("productSuppId=" . $productId->productSuppId . " and poId in (" . $_POST['poId'] . ") and status in (3,5)")->all();
                                                return $this->render('arrange', [
                                                            'model' => $products,
                                                            'choosePo' => $_POST['poId'],
                                                            'isbn' => $_POST['isbn'],
                                                            'allProducts' => $_POST['allProduct'],
                                                            'ms' => $ms,
                                                            'aSlot' => $_POST['slot'],
                                                            'productSuppId' => $_POST['productSuppId']
                                                ]);
                                            }
                                        }
                                    }
                                } else {//ถ้าใส่จำนวนเกิน ยอดที่ import ใน po นั้น
                                    $poNo = $this->findPo($poId);
                                    $failPo = $failPo . $poNo . ',';
                                    //$failPo = substr($failPo, 0, -1);
                                    $ms = $failPo . 'ไม่สามารถจัดเรียงได้เนื่องจากใส่จำนวนเกิน';
                                    if ($i == count($_POST['quantity'])) {
                                        $products = PoItem::find()->where("productSuppId=" . $productId->productSuppId . " and poId in (" . $_POST['poId'] . ") and status in (3,5)")->all();
                                        return $this->render('arrange', [
                                                    'model' => $products,
                                                    'choosePo' => $_POST['poId'],
                                                    'isbn' => $_POST['isbn'],
                                                    'allProducts' => $_POST['allProduct'],
                                                    'ms' => $ms,
                                                    'aSlot' => $_POST['slot'],
                                                    'productSuppId' => $_POST['productSuppId']
                                        ]);
                                    }
                                }
                            }
                            $i++;

                        endforeach;
                    }
                } else {
                    $ms = 'ไม่มี Slot " ' . $_POST['slot'] . ' "';
                    return $this->render('arrange', [
                                'model' => $products,
                                'choosePo' => $_POST['poId'],
                                'isbn' => $_POST['isbn'],
                                'allProducts' => $_POST['allProduct'],
                                'ms' => $ms,
                                'aSlot' => $_POST['slot'],
                                'productSuppId' => $_POST['productSuppId']
                    ]);
                }
            } else {
                $ms = 'Please scan slot.';
                return $this->render('arrange', [
                            'model' => $products,
                            'choosePo' => $_POST['storeProductGroupId'],
                            'isbn' => $_POST['isbn'],
                            'allProducts' => $_POST['allProduct'],
                            'ms' => $ms,
                            'productSuppId' => $_POST['productSuppId']
                ]);
            }
        }if (isset($allPo) && count($allPo) > 0) {
            foreach ($allPo as $all):
                $po = $po . $all->poId . ",";
            endforeach;
            $po = substr($po, 0, -1);
            $allProducts = PoItem::find()->where("poId in (" . $po . ")")
                    ->orderBy("status DESC,productId ASC")
                    ->all();
            if (isset($allProducts) && count($allProducts) > 0) {
                $i = 0;
                foreach ($allProducts as $pro):
                    $check = false;
                    $check = $this->checkDupProduct($pro->productSuppId, $product);
                    if ($check == true) {
                        //$product[$i] = $pro->productId;//เปลี่ยนเป็นใช้ ProductSuppId
                        $product[$i] = $pro->productSuppId;
                        $i++;
                    }
                endforeach;
                return $this->render('arrange_index', [
                            'allProducts' => $product,
                            'choosePo' => $po,
                            'ms' => $ms,
                ]);
            }
        }
    }

    public static function checkOver($poId, $quantity, $productSuppId) {
        $total = 0;
        //$storeProducts = StoreProduct::find()->where("storeProductGroupId=" . $storeProductGroupId . " and productId=" . $productId)->one();
        $poItem = PoItem::find()->where("poId=" . $poId . " and productSuppId=" . $productSuppId)->one();
        if (isset($poItem)) {
            //$storeProductArranges = \common\models\costfit\StoreProductArrange::find()->where("storeProductId=" . $storeProducts->storeProductId . " and productId=" . $productId)->all();
            $storeProductArranges = \common\models\costfit\StoreProductArrange::find()->where("poItemId=" . $poItem->poItemId . " and productSuppId=" . $productSuppId)->all();
            if (isset($storeProductArranges) && !empty($storeProductArranges)) {
                foreach ($storeProductArranges as $storeProductArrange):
                    $total += $storeProductArrange->quantity;
                endforeach;
            }

            //throw new \yii\base\Exception($storeProductId . " total " . $total . " re " . $quantity);
            //$storeProduct = StoreProduct::find()->where("storeProductId=" . $storeProducts->storeProductId . " and productId=" . $productId)->one();
            $poItem = PoItem::find()->where("poItemId=" . $poItem->poItemId . " and productSuppId=" . $productSuppId)->one();
            if (($quantity + $total) <= $poItem->importQuantity) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function checkClear($poId) {
        $poItem = count(PoItem::find()->where("poId=" . $poId . " and (status<4 or status=5)")->all()); //ยังไม่จัดเรียง จัดเรียงบางส่วน กำลังจัดเรียง
        if ($poItem == 0) {//หมดสินค้าใน po ทั้งหมด ที่เลือกมาแล้ว
            $po = Po::find()->where("poId=" . $poId)->one();
            //throw new \yii\base\Exception($storeProductGroupId);
            //foreach ($storeProductGroups as $storeProductGroup):
            $po->status = 4;
            $po->save(false);
            // endforeach;
            return true;
        } else {
            return false;
        }
    }

    public static function checkClearPo($userId) {
        $po = Po::find()->where("arranger=" . $userId . " and (status=5 or status=3)")->all();
        if (isset($po) && count($po) > 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function checkDupProduct($productId, $arrayProduct) {
        $i = 0;
        foreach ($arrayProduct as $array):
            if ($array == $productId) {
                $i++;
            }
        endforeach;
        if ($i == 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function findPoItemId($poId, $productSuppId) {
        //$storeProduct = StoreProduct::find()->where("productId=" . $productId . " and storeProductGroupId=" . $storeProductGroupId)->one();
        $poItem = PoItem::find()->where("productSuppId=" . $productSuppId . " and poId=" . $poId)->one();
        return $poItem->poItemId;
    }

    public static function findPo($poId) {
        $po = Po::find()->where("poId=" . $poId)->one();
        return $po->poNo;
    }

}
