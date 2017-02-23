<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use common\models\costfit\Receive;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;
use common\models\costfit\User;
use common\models\costfit\Address;

/**
 * ReceiveController implements the CRUD actions for receive model.
 */
class ReceiveController extends MasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all receive models.
     * @return mixed
     */
    public function actionIndex() {
        $ms = '';
        $tel = '';
        $model = new \common\models\costfit\Receive();

        if (isset($_POST['Receive']['password']) && !empty($_POST['Receive']['password'])) {
            $order = Order::find()->where("password='" . $_POST['Receive']['password'] . "'")->one();
            if (isset($order) && !empty($order)) {
                if ($order->status == 16) {//16 = รับของแล้ว
                    $orderItem = \common\models\costfit\OrderItem::find()->where("orderId=" . $order->orderId . " and status<16")->all();
                    if (count($orderItem) == 0) { // เชคว่า มี สินค้าที่ยังไม่ได้ รับหรือไม่ ถ้าไม่มี รับไม่ได้
                        $ms = 'รายการนี้ได้รับสินค้าไปแล้ว'; //300
                        return $this->render('error', [
                                    'ms' => $ms
                        ]);
                    }
                }
                $user = User::find()->where("userId='" . $order->userId . "'")->one();
                if (isset($user) && !empty($user)) {
                    $address = Address::find()->where("userId='" . $user->userId . "' and isDefault=1")->one();
                    if (isset($address) && !empty($address)) {
                        $tel = $address->tel;
                    }
                    return $this->render('detail', [
                                'user' => $user,
                                'tel' => $tel,
                                'orderId' => $order->orderId
                    ]);
                } else {
                    $ms = 'ไม่เจอรายการสินค้า'; //301
                }
            } else {
                $ms = 'ไม่เจอรายการสินค้า'; //301
            }
            if ($ms != '') {//ถ้าไม่เจอรายการ แสดงข้อความ แล้วกลับไปหน้าเดิม
                return $this->render('error', [
                            'ms' => $ms
                ]);
            }
        }
        return $this->render('index', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single receive model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new receive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new receive();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->receiveId]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing receive model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->receiveId]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing receive model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSendSms() {
        $ms = '';
        $tel = $_POST['tel'];
        if (isset($_POST['orderId'])) {
            $order = Order::find()->where("orderId=" . $_POST['orderId'])->one();
            if (isset($order) && !empty($order)) {
                $user = User::find()->where("userId=" . $order->userId)->one();
                if (isset($user) && !empty($user)) {
                    $otp = $this->genOtp();
                    $ref = $this->genRefNo();
                    $order->otp = $otp;
                    $order->refNo = $ref;
                    $order->updateDateTime = new \yii\db\Expression('NOW()');
                    $order->save(false); //ส่งOTP ตรงนี้
                    $receive = new Receive();
                    $receive->orderId = $_POST['orderId'];
                    $receive->userId = $user->userId;
                    $receive->password = $order->password;
                    $receive->pickingId = $order->pickingId;
                    $receive->otp = $otp;
                    $receive->refNo = $ref;
                    $receive->isUse = 0;
                    $receive->status = 1;
                    $receive->createDateTime = new \yii\db\Expression('NOW()');
                    $receive->updateDateTime = new \yii\db\Expression('NOW()');
                    if ($receive->save(false)) {
                        return $this->render('receive', [
                                    'userId' => $user->userId,
                                    'tel' => $tel,
                                    'password' => $order->password,
                                    'orderId' => $order->orderId,
                                    'refNo' => $order->refNo
                        ]);
                    }
                } else {
                    $ms = 'ไม่พบผู้ใช้งาน';
                }
            } else {
                $ms = 'ไม่พบรายการพัสดุ';
            }
        }

        //throw new \yii\base\Exception($_POST['tel']);
    }

    public function actionReceived() {
        $ms = '';
        $allLocker = '';
        $orderItem = '';
        $check = [];
        $i = 0;
        $time = false;
        $receive = Receive::find()->where("otp='" . $_POST['otp'] . "' and orderId=" . $_POST['orderId'] . " and userId=" . $_POST['userId'] . " and password='" . $_POST['password'] . "' and refNo='" . $_POST['refNo'] . "' and status=1 and isUse=0")->one();
        if (isset($receive) && !empty($receive)) {
            $time = $this->checkTime($receive->updateDateTime);
            if ($time == true) {//ถ้าเวลา ไม่เกิน 5 นาที
                $order = Order::find()->where("orderId=" . $_POST['orderId'])->one(); //หา locker
                if (isset($order) && !empty($order)) {
                    //ยังไม่ได้เชค ว่า picking point ถูกต้องหรือไม่ ถ้าไม่ถูกให้บอกที่ถูก
                    $pickingPoint = $order->pickingId;
                    $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $order->orderId)->all();
                    if (isset($orderItems) && !empty($orderItems)) {
                        foreach ($orderItems as $item):
                            $orderItem = $orderItem . $item->orderItemId . ",";
                        endforeach;
                        $orderItem = substr($orderItem, 0, -1);
                        $lockers = \common\models\costfit\OrderItemPacking::find()->where("orderItemId in($orderItem) and status=7")->all();
                        if (isset($lockers) && !empty($lockers)) {
                            foreach ($lockers as $locker):
                                $total = 0;
                                $pickingLocker = \common\models\costfit\PickingPointItems::find()->where("pickingItemsId=" . $locker->pickingItemsId . " and pickingId=" . $pickingPoint)->one();
                                if (isset($pickingLocker)) {
                                    $flag = false;
                                    $flag = $this->check($check, $pickingLocker->pickingItemsId);
                                    $check[$i] = $pickingLocker->pickingItemsId;

                                    if ($flag == true) {
                                        $total = count(\common\models\costfit\OrderItemPacking::find()->where("pickingItemsId=" . $pickingLocker->pickingItemsId . " and status=7")->all());
                                        $allLocker = $allLocker . " ช่อง " . $pickingLocker->name . " จำนวน " . $total . " ถุง" . "<br>";
                                    }
                                    $i++;
                                }
                            endforeach;
                            //throw new \yii\base\Exception(print_r($check, true));
                            //$allLocker = substr($allLocker, 0, -1);
                            // รอ อัพเดทสถานะ เป็นลูกค้ารับของแล้ว order orderItem orderItemPacking
                            //$order->status=16;
                            //$order->save();//รับของแล้ว
                            $this->updateOrder($order->orderId, $_POST['otp'], $_POST['userId'], $_POST['password'], $_POST['refNo']);
                            return $this->render('thank', [
                                        'userId' => $_POST['userId'],
                                        'tel' => $_POST['tel'],
                                        'password' => $_POST['password'],
                                        'orderId' => $_POST['orderId'],
                                        'locker' => $allLocker,
                                        'ms' => $ms
                            ]);
                        } else {
                            $ms = 'ยังไม่มีรายการพัสดุของคุณใน locker ใดเลย';
                        }
                    } else {
                        $ms = 'ไม่เจอรายการสินค้า2';
                    }
                } else {
                    $ms = 'ไม่เจอรายการสินค้า1';
                }
            } else {
                $ms = 'รหัสผ่านหมดเวลาการใช้งาน กรุณากดรับรหัสใหม่';
                return $this->render('error', [
                            'ms' => $ms
                ]);
            }
        } else {
            $ms = 'รหัสผ่านไม่ถูกต้อง';
            return $this->render('receive', [
                        'userId' => $_POST['userId'],
                        'tel' => $_POST['tel'],
                        'password' => $_POST['password'],
                        'orderId' => $_POST['orderId'],
                        'ms' => $ms,
                        'refNo' => $_POST['refNo']
            ]);
        }
    }

    public function actionGenNewOtp() {
        $userId = $_POST["userId"];
        $orderId = $_POST["orderId"];
        $tel = $_POST["tel"];
        $otp = $this->genOtp();
        $refNo = $this->genRefNo();
        $order = Order::find()->where("orderId=" . $orderId . " and userId=" . $userId)->one();
        if (isset($order) && !empty($order)) {
            $order->otp = $otp;
            $order->refNo = $refNo;
            $order->updateDateTime = new \yii\db\Expression('NOW()');
            $order->save(FALSE);
            $receive = new Receive();
            $receive->orderId = $orderId;
            $receive->userId = $order->userId;
            $receive->password = $order->password;
            $receive->pickingId = $order->pickingId;
            $receive->otp = $otp;
            $receive->refNo = $refNo;
            $receive->isUse = 0;
            $receive->status = 1;
            $receive->createDateTime = new \yii\db\Expression('NOW()');
            $receive->updateDateTime = new \yii\db\Expression('NOW()');
            $receive->save(FALSE);
        }
        return $refNo;
    }

    protected function checkTime($time) {
        $now = date('Y-m-d H:i:s');
        $time_diff = strtotime($now) - strtotime($time);
        $time_diff_m = floor(($time_diff % 3600) / 60);
        if ($time_diff_m > 5) {
            return false;
        } else {
            return true;
        }
    }

    protected function check($alls, $new) {
        $a = 0;
        //throw new \yii\base\Exception(print_r($alls, true));
        foreach ($alls as $all):
            if ($all == $new) {
                $a++;
            }
        endforeach;
        if ($a == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Finds the receive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return receive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = receive::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function genOtp() {
        $flag = false;
        $otp = rand('000000', '999999');
        while ($flag == false) {
            $order = Order::find()->where("otp='" . $otp . "' and status!=16")->one(); //Gen OTP จนกว่าจะได้เลขไม่ซ้ำ
            if (isset($order) && !empty($order)) {
                $otp = rand('000000', '999999');
            } else {
                $flag = true;
            }
        }
        return $otp;
    }

    protected function genRefNo() {
        $flag = false;
        $characters = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $ref = '';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < 8; $i++) {
            $n = $characters[rand(0, $charactersLength - 1)];
            $ref = $ref . $n;
        }
        while ($flag == false) {
            $order = Order::find()->where("refNo='" . $ref . "' and status!=16")->one(); //Gen OTP จนกว่าจะได้เลขไม่ซ้ำ
            if (isset($order) && !empty($order)) {
                $ref = '';
                for ($j = 0; $j < 8; $j++) {
                    $n = $characters[rand(0, $charactersLength - 1)];
                    $ref = $ref . $n;
                }
            } else {
                $flag = true;
            }
        }
        return $ref;
    }

    protected function updateOrder($orderId, $otp, $userId, $password, $refNo) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        if (isset($order) && !empty($order)) {
            $orderItems = \common\models\costfit\OrderItem::find()->where("orderId=" . $order->orderId . " and status=15")->all(); //หาorderItem ที่สถานะ = นำจ่ายแล้ว
            foreach ($orderItems as $orderItem):
                $orderItem->status = 16; //update orderItem
                $orderItem->updateDateTime = new \yii\db\Expression('NOW()');
                $orderItem->save(false);
                $packings = \common\models\costfit\OrderItemPacking::find()->where("orderItemId=" . $orderItem->orderItemId)->all();
                foreach ($packings as $packing)://update orderItemPacking
                    $packing->status = 8;
                    $packing->updateDateTime = new \yii\db\Expression('NOW()');
                    $packing->save(false);
                    $locker = \common\models\costfit\PickingPointItems::find()->where("pickingItemsId=" . $packing->pickingItemsId)->one();
                    $locker->status = 1;
                    $locker->save(false);
                endforeach;
            endforeach;
            $order->status = 16;
            $order->updateDateTime = new \yii\db\Expression('NOW()');
            $order->save(false);
            $receive = Receive::find()->where("orderId=" . $order->orderId . " and userId=" . $userId . " and otp='" . $otp . "' and password='" . $password . "' and refNo='" . $refNo . "'")->one();
            $receive->status = 2;
            $receive->save(FALSE);
        }
    }

}
