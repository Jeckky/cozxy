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
                //throw new \yii\base\Exception($_POST["quantity"][$inPo->storeProductId]);
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
                    // throw new \yii\base\Exception($inPo->storeProductId);
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
            $delete->arranger = NULL;
            $delete->save(false);
            $deleteItems = StoreProduct::find()->where("storeProductGroupId=" . $id)->all();
            foreach ($deleteItems as $item):
                $item->status = 2;
                $item->save(FALSE);
            endforeach;
        }
        $chooseId = StoreProductGroup::find()->where("status=5 and arranger=" . $userId)->all();
        return $this->redirect(['choose-po',
                    'ms' => $ms,
                    'chooseId' => $chooseId
                        ]
        );
    }

    public function updateStoreProductGroupSummary($productStoreGroupId) {
        $summary = 0;
        $stg = StoreProductGroup::find()->where("storeProductGroupId =" . $productStoreGroupId)->one();
        foreach ($stg->storeProducts as $sp) {
            $summary += $sp->total;
        }
        $stg->summary = $summary;
        $stg->save();
    }

    public function checkPo($id) {
        $checkPo = StoreProduct::find()->where("storeProductGroupId='" . $id . "' and status!=3")->all();
        if (count($checkPo) == 0) {
            $changePoStatus = StoreProductGroup::find()->where("storeProductGroupId='" . $id . "'")->one();
            $changePoStatus->receiveDate = new \yii\db\Expression('NOW()');
            $changePoStatus->status = 2;
            $changePoStatus->receiveBy = Yii::$app->user->identity->userId;
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
        $failPo = '';
        $userId = Yii::$app->user->identity->userId;
        $po = '';
        $product = [];
        $allPo = StoreProductGroup::find()->where("status=5 and arranger=" . $userId . " order by receiveDate")->all();
        if (isset($_POST["StoreProduct"]['isbn']) && !empty($_POST["StoreProduct"]['isbn'])) {//สแกน บาร์โค้ดสินค้าเพื่อจัดเรียง
            /* $products = \common\models\costfit\Product::find()->select("product.*,sp.*")->where("isbn ='" . $_POST["StoreProduct"]['isbn'] . "'")
              ->join("LEFT JOIN", 'store_product sp', 'product.productId=sp.productId and sp.storeProductGroupId in (' . $_POST['storeProductGroupId'] . ') and (sp.status=5 or sp.status=3)')
              ->orderBy('sp.createDateTime ASC')
              ->all(); */
            //$isbn = \common\models\costfit\Product::find()->where("isbn='" . $_POST["StoreProduct"]['isbn'] . "'")->one();
            $storeProductIds = StoreProduct::find()->where("storeProductGroupId in (" . $_POST['storeProductGroupId'] . ")")->all();
            $suppId = '';
            if (isset($storeProductIds) && !empty($storeProductIds)) {
                foreach ($storeProductIds as $storeProductId):
                    $suppId = $suppId . $storeProductId->productSuppId . ",";
                endforeach;
                $suppId = substr($suppId, 0, -1);
            }
            // throw new \yii\base\Exception(print_r($storeProductIds, true));
            $isbn = \common\models\costfit\ProductSuppliers::find()->where("isbn='" . $_POST["StoreProduct"]['isbn'] . "' and productSuppId in (" . $suppId . ")")->one();
            if (isset($isbn) && !empty($isbn)) {
                //$products = StoreProduct::find()->where("productId=" . $isbn->productId . " and storeProductGroupId in (" . $_POST['storeProductGroupId'] . ") and status in (3,5)")->all();
                $products = StoreProduct::find()->where("productSuppId=" . $isbn->productSuppId . " and storeProductGroupId in (" . $_POST['storeProductGroupId'] . ") and status in (3,5)")->all();
            }
            //throw new \yii\base\Exception($isbn->productSuppId);
            if (isset($products) && !empty($products)) {
                return $this->render('arrange', [
                            'model' => $products,
                            'chooseStoreProductGroup' => $_POST['storeProductGroupId'],
                            'isbn' => $_POST["StoreProduct"]['isbn'],
                            'allProducts' => $_POST['allProduct'],
                ]);
            } else {//ถ้า ไม่เจอสินค้าหรือจัดเรียงไปแล้ว
                $ms = 'Imported products not found.';
                return $this->render('arrange_index', [
                            'ms' => $ms,
                            'chooseStoreProductGroup' => $_POST['storeProductGroupId'],
                            'allProducts' => $_POST['allProduct'],
                ]);
            }
        }
        if (isset($_POST['arrange']) && $_POST['arrange'] == 'arrange') {//มาจาหน้าจัดเรียง
            /* $product = \common\models\costfit\Product::find()->select("product.*,sp.*")->where("isbn ='" . $_POST['isbn'] . "'")
              ->join("LEFT JOIN", 'store_product sp', 'product.productId=sp.productId and sp.storeProductGroupId=' . $_POST['storeProductGroupId'] . ' and (sp.status=5 or sp.status=3)')
              ->orderBy('sp.createDateTime ASC')
              ->one(); */
            $productId = \common\models\costfit\Product::find()->where("isbn ='" . $_POST['isbn'] . "'")->one();
            $products = StoreProduct::find()->where("productId=" . $productId->productId . " and storeProductGroupId in (" . $_POST['storeProductGroupId'] . ") and status in (3,5)")->all();
            if (isset($_POST['slot']) && !empty($_POST['slot'])) {//จัดเรียง
                $slot = \common\models\costfit\StoreSlot::find()->where("barcode='" . $_POST["slot"] . "'")->one();
                if (isset($slot) && !empty($slot)) {
                    if (isset($_POST['quantity']) && !empty($_POST['quantity'])) {
                        // throw new \yii\base\Exception(print_r($_POST['quantity'], true));
                        $i = 1; //เอาไว้นับจำนวน quantity ที่กรอกมา ว่ามีทั้งหมดกี่ po
                        foreach ($_POST['quantity'] as $storeProductGroupId => $quantity):
                            if (($quantity != NULL) && ($quantity != 0)) {//ทำเฉพาะที่ได้กรอกจำนวนมาเท่านั้น
                                $canSave = false;
                                $canSave = $this->checkOver($storeProductGroupId, $quantity, $productId->productId); // ค้างเชคฟังก์ชันนี้
                                if ($canSave == true) {
                                    $storeProductId = $this->findStoreProductId($storeProductGroupId, $productId->productId);
                                    StoreProduct::arrangeProductToSlot($storeProductId, $slot->storeSlotId, $quantity); //จัดเรียง
                                    $clear = false;
                                    $clear = $this->checkClear($storeProductGroupId);
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
                                                                'chooseStoreProductGroup' => $_POST['storeProductGroupId'],
                                                                'ms' => $ms
                                                    ]);
                                                } else {
                                                    $products = StoreProduct::find()->where("productId=" . $productId->productId . " and storeProductGroupId in (" . $_POST['storeProductGroupId'] . ") and status in (3,5)")->all();
                                                    return $this->render('arrange', [
                                                                'model' => $products,
                                                                'chooseStoreProductGroup' => $_POST['storeProductGroupId'],
                                                                'isbn' => $_POST['isbn'],
                                                                'allProducts' => $_POST['allProduct'],
                                                                'ms' => $ms,
                                                                'aSlot' => $_POST['slot']
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
                                                            'chooseStoreProductGroup' => $_POST['storeProductGroupId'],
                                                ]);
                                            } else {
                                                $products = StoreProduct::find()->where("productId=" . $productId->productId . " and storeProductGroupId in (" . $_POST['storeProductGroupId'] . ") and status in (3,5)")->all();
                                                return $this->render('arrange', [
                                                            'model' => $products,
                                                            'chooseStoreProductGroup' => $_POST['storeProductGroupId'],
                                                            'isbn' => $_POST['isbn'],
                                                            'allProducts' => $_POST['allProduct'],
                                                            'ms' => $ms,
                                                            'aSlot' => $_POST['slot']
                                                ]);
                                            }
                                        }
                                    }
                                } else {//ถ้าใส่จำนวนเกิน ยอดที่ import ใน po นั้น
                                    $poNo = $this->findPo($storeProductGroupId);
                                    $failPo = $failPo . $poNo . ',';
                                    //$failPo = substr($failPo, 0, -1);
                                    $ms = $failPo . 'ไม่สามารถจัดเรียงได้เนื่องจากใส่จำนวนเกิน';
                                    if ($i == count($_POST['quantity'])) {
                                        $products = StoreProduct::find()->where("productId=" . $productId->productId . " and storeProductGroupId in (" . $_POST['storeProductGroupId'] . ") and status in (3,5)")->all();
                                        return $this->render('arrange', [
                                                    'model' => $products,
                                                    'chooseStoreProductGroup' => $_POST['storeProductGroupId'],
                                                    'isbn' => $_POST['isbn'],
                                                    'allProducts' => $_POST['allProduct'],
                                                    'ms' => $ms,
                                                    'aSlot' => $_POST['slot']
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
                                'chooseStoreProductGroup' => $_POST['storeProductGroupId'],
                                'isbn' => $_POST['isbn'],
                                'allProducts' => $_POST['allProduct'],
                                'ms' => $ms,
                                'aSlot' => $_POST['slot']
                    ]);
                }
            } else {
                $ms = 'Please scan slot.';
                return $this->render('arrange', [
                            'model' => $products,
                            'chooseStoreProductGroup' => $_POST['storeProductGroupId'],
                            'isbn' => $_POST['isbn'],
                            'allProducts' => $_POST['allProduct'],
                            'ms' => $ms
                ]);
            }
        }if (isset($allPo) && !empty($allPo)) {
            foreach ($allPo as $all):
                $po = $po . $all->storeProductGroupId . ",";
            endforeach;
            $po = substr($po, 0, -1);
            $allProducts = StoreProduct::find()->where("storeProductGroupId in (" . $po . ")")
                    ->orderBy("status DESC,productId ASC")
                    ->all();
            if (isset($allProducts) && !empty($allProducts)) {
                $i = 0;
                foreach ($allProducts as $pro):
                    $check = false;
                    $check = $this->checkDupProduct($pro->productId, $product);
                    if ($check == true) {
                        //$product[$i] = $pro->productId;//เปลี่ยนเป็นใช้ ProductSuppId
                        $product[$i] = $pro->productSuppId;
                        $i++;
                    }
                endforeach;
                return $this->render('arrange_index', [
                            'allProducts' => $product,
                            'chooseStoreProductGroup' => $po,
                            'ms' => $ms,
                ]);
            }
        }
    }

    public static function checkOver($storeProductGroupId, $quantity, $productId) {
        $total = 0;
        $storeProducts = StoreProduct::find()->where("storeProductGroupId=" . $storeProductGroupId . " and productId=" . $productId)->one();
        if (isset($storeProducts) && !empty($storeProducts)) {
            $storeProductArranges = \common\models\costfit\StoreProductArrange::find()->where("storeProductId=" . $storeProducts->storeProductId . " and productId=" . $productId)->all();
            if (isset($storeProductArranges) && !empty($storeProductArranges)) {
                foreach ($storeProductArranges as $storeProductArrange):
                    $total += $storeProductArrange->quantity;
                endforeach;
            }

            //throw new \yii\base\Exception($storeProductId . " total " . $total . " re " . $quantity);
            $storeProduct = StoreProduct::find()->where("storeProductId=" . $storeProducts->storeProductId . " and productId=" . $productId)->one();
            if (($quantity + $total) <= $storeProduct->importQuantity) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function checkClear($storeProductGroupId) {
        $storeProduct = count(StoreProduct::find()->where("storeProductGroupId=" . $storeProductGroupId . " and (status<4 or status=5)")->all()); //ยังไม่จัดเรียง จัดเรียงบางส่วน กำลังจัดเรียง
        if ($storeProduct == 0) {//หมดสินค้าใน po ทั้งหมด ที่เลือกมาแล้ว
            $storeProductGroups = StoreProductGroup::find()->where("storeProductGroupId=" . $storeProductGroupId)->one();
            //throw new \yii\base\Exception($storeProductGroupId);
            //foreach ($storeProductGroups as $storeProductGroup):
            $storeProductGroups->status = 4;
            $storeProductGroups->save(false);
            // endforeach;
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

    public static function findStoreProductId($storeProductGroupId, $productId) {
        $storeProduct = StoreProduct::find()->where("productId=" . $productId . " and storeProductGroupId=" . $storeProductGroupId)->one();
        return $storeProduct->storeProductId;
    }

    public static function findPo($storeProductGroupId) {
        $po = StoreProductGroup::find()->where("storeProductGroupId=" . $storeProductGroupId)->one();
        return $po->poNo;
    }

}
