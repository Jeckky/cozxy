<?php

namespace backend\modules\returnproduct\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;
use common\models\costfit\Address;
use common\models\costfit\User;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItem;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ReturnProduct;
use common\models\costfit\Ticket;

/**
 * Default controller for the `returnProduct` module
 */
class ReturnProductController extends ReturnProductMasterController {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($ticketId) {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        } else {
            return $this->render('index', [
                        'ticketId' => $ticketId
            ]);
        }
    }

    public function actionDetail() {
        $ticketId = $_POST['ticketId'];
        if (isset($_POST['orderNo']) && !empty($_POST['orderNo'])) {
            $order = Order::find()->where("orderNo='" . $_POST['orderNo'] . "' and status=" . Order::ORDER_STATUS_RECEIVED)->one();
            if (isset($order) && !empty($order)) {
                return $this->redirect(['order-detail',
                            'orderId' => $order->orderId,
                            'ticketId' => $ticketId
                ]);
            } else {
                $ms = 'ไม่มีออร์เดอร์ ' . $_POST['orderNo'] . ' กรุณาลองใหม่อีกครั้ง';
                return $this->render('index', [
                            'ms' => $ms,
                            'ticketId' => $ticketId
                ]);
            }
        }
    }

    public function actionRequestTicket() {
        $tickets = Ticket::find()->where("status=1")
                ->orderBy("createDateTime ASC")
                ->limit(30)
                ->all();
        $approved = Ticket::find()->where("status=3")
                ->orderBy("updateDateTime DESC")
                ->limit(30)
                ->all();
        $notApproved = Ticket::find()->where("status=4")
                ->orderBy("updateDateTime DESC")
                ->limit(30)
                ->all();
        return $this->render('ticket_request', [
                    'tickets' => $tickets,
                    'approved' => $approved,
                    'notApproved' => $notApproved
        ]);
    }

    public function actionTicketDetail($ticketId) {
        if (isset($ticketId)) {
            $ticket = Ticket::find()->where("ticketId=" . $ticketId)->orderBy("createDateTime DESC")->one();
            $orderItems = OrderItem::find()->where("orderId=" . $ticket->orderId)->all();
            return $this->render('ticket_detail', [
                        'orderItems' => $orderItems,
                        'orderId' => $ticket->orderId,
                        'ticket' => $ticket
            ]);
        }
    }

    public function actionContact($ticketId) {
        $ticket = Ticket::find()->where("ticketId=" . $ticketId)->one();
        return $this->render('contact', [
                    'ticket' => $ticket,
        ]);
    }

    public function actionApproveTicket() {
        $ticket = Ticket::find()->where("ticketId=" . $_POST["ticketId"])->one();
        $res = [];
        if ($_POST['approve'] == 'Approve') {
            $ticket->status = Ticket::TICKET_STATUS_APPROVED;
            $res["status"] = TRUE;
        } else {
            $ticket->status = Ticket::TICKET_STATUS_NOT_APPROVE;
            $ticket->remark = $_POST['remark'];
            $res["status"] = FALSE;
        }
        $ticket->updateDateTime = new \yii\db\Expression('NOW()');
        $ticket->save(false);
        return \yii\helpers\Json::encode($res);
    }

    public function actionOrderDetail($orderId, $ticketId) {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $addressText = '';
        $returnList = ReturnProduct::find()->where("orderId=" . $orderId . " and status=1")->all();
        $address = Address::find()->where("userId=" . $order->userId . " and isDefault=1")->one();
        if (isset($address) && !empty($address)) {
            $addressText = User::userAddressText($address->addressId);
        }
        $pickingPoint = PickingPoint::find()->where("pickingId=" . $order->pickingId)->one();
        return $this->render('order_detail', [
                    'order' => $order,
                    'addressText' => $addressText,
                    'pickingPoint' => isset($pickingPoint) && !empty($pickingPoint) ? $pickingPoint->title : '',
                    'returnList' => $returnList,
                    'ticketId' => $ticketId
        ]);
    }

    public function actionReturnList() {
        $res = [];
        $body = '';
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $productSuppId = $this->supplierId($_POST["isbn"], $_POST["orderId"]);

        if ($productSuppId != '') {
            $productSuppId = trim($productSuppId);
            $producSupp = ProductSuppliers::find()->where("isbn='" . $_POST["isbn"] . "' and productSuppId=" . $productSuppId)->one();
            if (isset($producSupp) && !empty($producSupp)) {
                $orderItems = OrderItem::find()->where("productSuppId=" . $producSupp->productSuppId . " and orderId=" . $_POST["orderId"])->all();
                if (isset($orderItems) && !empty($orderItems)) {
                    $header = $this->tableHeader();
                    foreach ($orderItems as $item):
                        $check = false;
                        $check = $this->checkDupplicateItem($item->orderItemId, $_POST['ticketId'], $_POST["orderId"]);
                        if ($check) {
                            $returns = new ReturnProduct();
                            $returns->orderId = $_POST["orderId"];
                            $returns->ticketId = $_POST["ticketId"];
                            $returns->orderItemId = $item->orderItemId;
                            $returns->discount = OrderItem::calculateReturnDiscount($item->orderItemId);
                            $returns->productSuppId = $item->productSuppId;
                            $returns->quantity = 1;
                            $returns->price = ProductSuppliers::productPrice($item->productSuppId);
                            $returns->totalPrice = $returns->quantity * $returns->price;
                            $returns->totalDiscount = $returns->discount * $returns->quantity;
                            $returns->credit = $returns->totalPrice - $returns->totalDiscount;
                            $returns->receiver = Yii::$app->user->identity->userId;
                            $returns->status = 1;
                            $returns->createDateTime = new \yii\db\Expression('NOW()');
                            $returns->updateDateTime = new \yii\db\Expression('NOW()');
                            $returns->save(false);
                        }
                    endforeach;

                    $returnItems = ReturnProduct::find()->where("orderId=" . $_POST["orderId"] . " and status=1")->all();
                    $i = 1;
                    foreach ($returnItems as $rItem):
                        $producSupp = ProductSuppliers::find()->where("productSuppId=" . $rItem->productSuppId)->one();
                        $body = $body . '<tr style="height: 50px;">' . '<td style="vertical-align: middle;text-align: center;">' . $i . '</td>' .
                                '<td style="vertical-align: middle;text-align: center;"><img src="' . $baseUrl . '/' . ProductSuppliers::productImagesSuppliers($rItem->productSuppId)[0]->image . '" style="width:150px;height: 100px;"><br>'
                                . $producSupp->title . '</td>' .
                                '<td style="vertical-align: middle;text-align: center;">' . $rItem->quantity . '</td>' .
                                '<td style="vertical-align: middle;text-align: center;"><a class="btn" id="incr-return">-</a> <input type="text" class="text-center" id="qnty-return' . $rItem->returnProductId . '" value="' . $rItem->quantity . '" style="width:35px;height:35px;" readonly="true"> <a class="btn" id="incr-return">+</a></td>' .
                                '<td style="vertical-align: middle;text-align: center;"><textarea name="remark[' . $rItem->returnProductId . ']" id="remark' . $rItem->returnProductId . '">' . $rItem->remark . '</textarea></td>' .
                                '<input type="hidden" id="pSuppId" value="' . $rItem->returnProductId . '">' .
                                '<input type="hidden" id="pOrderId" value="' . $rItem->orderId . '">' .
                                '<td style="vertical-align: middle;text-align: center;font-size:25pt;"><i class="fa fa-times-circle deleteR" id="deleteR"' . $rItem->returnProductId . '" aria-hidden="true" style="cursor: pointer;"></i></td>' .
                                '</tr>';
                        $i++;
                    endforeach;
                    $footer = $this->tableFooter();
                    $res["dataList"] = $header . $body . $footer;
                    $res["errors"] = '1';
                } else {
                    $res["errors"] = "Product not found in this order";
                }
            } else {
                $res["errors"] = "Product not found";
            }
        } else {
            $res["errors"] = "Product not found";
        }

        return \yii\helpers\Json::encode($res);
    }

    public function checkDupplicateItem($orderItemId, $ticketId, $orderId) {
        $returns = ReturnProduct::find()->where("orderItemId=" . $orderItemId . " and ticketId=" . $ticketId . " and orderId=" . $orderId)->one();
        if (isset($returns) && !empty($returns)) {
            return false;
        } else {
            return true;
        }
    }

    public function actionConfirmReturn() {
        if (isset($_POST["orderId"])) {
            $orderId = $_POST["orderId"];
            //throw new \yii\base\Exception(print_r($_POST["remark"], true));
            if (isset($_POST["remark"]) && !empty($_POST["remark"])) {
                foreach ($_POST["remark"] as $returnProductId => $remark):
                    $returnProduct = ReturnProduct::find()->where("returnProductId=" . $returnProductId)->one();
                    $returnProduct->remark = $remark;
                    $returnProduct->updateDateTime = new \yii\db\Expression('NOW()');
                    $returnProduct->save(false);
                endforeach;
            }
            $returnProducts = ReturnProduct::find()->where("orderId=" . $orderId)->all();
            if (isset($returnProducts) && !empty($returnProducts)) {
                return $this->render('confirm_return', [
                            'orderId' => $orderId,
                            'returnProducts' => $returnProducts]);
            }
        }
        if (isset($_POST['confirm'])) {
            $orderId = $_POST['confirm'];
            $totalCredit = 0;
            $returnProduct = ReturnProduct::find()->where("orderId=" . $orderId . " and status=1")->all(); //ยอดเครดิตที่ลูกค้าเพิ่งคืน
            if (isset($returnProduct) && !empty($returnProduct)) {
                foreach ($returnProduct as $return):
                    $totalCredit += $return->credit;
                    $orderId = $return->orderId;
                endforeach;
                $order = Order::find()->where("orderId=" . $orderId)->one();
                if (isset($order) && !empty($order)) {
                    $userCredit = \common\models\costfit\UserCredit::find()->where("userId=" . $order->userId)->one();
                    if (isset($userCredit) && !empty($userCredit)) {//ถ้ามีอยู่แล้วให้เพิ่มลงไปในเรคคอร์ดอันเก่า
                        $userCredit->totalCredit += $totalCredit;
                        $userCredit->updateDateTime = new \yii\db\Expression('NOW()');
                        $userCredit->save(false);
                    } else {//ถ้ายังไม่มี ให้สร้างใหม่
                        $userCredit = new \common\models\costfit\UserCredit();
                        $userCredit->userId = $order->userId;
                        $userCredit->totalCredit = $totalCredit;
                        $userCredit->createDateTime = new \yii\db\Expression('NOW()');
                        $userCredit->updateDateTime = new \yii\db\Expression('NOW()');
                        $userCredit->save();
                    }
                    foreach ($returnProduct as $return):
                        $return->status = 2; //เปลี่ยน สถานะเป็น 2 (การคืนเสร็จสิ้นสำหรับ order นี้)
                        $return->updateDateTime = new \yii\db\Expression('NOW()');
                        $return->save(FALSE);
                    endforeach;
                    $returnHistory = ReturnProduct::find()
                            ->select(`order.*`, `return_product.*`)
                            ->join('LEFT JOIN', 'order', 'order.orderId=return_product.orderId')
                            ->where("order.userId=" . $order->userId . " and return_product.status=2")
                            ->orderBy("return_product.updateDateTime DESC")
                            ->all();
                    $userTotalCredit = \common\models\costfit\UserCredit::find()->where("userId=" . $order->userId)->one();
                    $lastReturn = ReturnProduct::find()->where("orderId=" . $order->orderId)->all();
                    return $this->render('successful_return', [
                                'userId' => $order->userId,
                                'returnHistory' => $returnHistory,
                                'userTotalCredit' => $userTotalCredit,
                                'lastReturn' => $lastReturn
                    ]);
                } else {
                    return $this->redirect(['index']);
                }
            } else {
                return $this->redirect(['index']);
            }
        }
    }

    public function actionDeleteReturnList() {
        $res = [];
        $body = '';
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $returnProductId = $_POST["returnId"];
        $returnProduct = ReturnProduct::find()->where("returnProductId=" . $returnProductId)->one();
        if (isset($returnProduct) && !empty($returnProduct)) {
            $returnProduct->delete();
            $items = count(ReturnProduct::find()->where("orderId=" . $_POST['pOrderId'])->all());
            if ($items > 0) {
                $header = $this->tableHeader();
                $returnItems = ReturnProduct::find()->where("orderId=" . $_POST["pOrderId"])->all();
                $i = 1;
                foreach ($returnItems as $rItem):
                    $producSupp = ProductSuppliers::find()->where("productSuppId=" . $rItem->productSuppId)->one();
                    $body = $body . '<tr style="height: 50px;">' . '<td style="vertical-align: middle;text-align: center;">' . $i . '</td>' .
                            '<td style="vertical-align: middle;text-align: center;"><img src="' . $baseUrl . '/' . ProductSuppliers::productImagesSuppliers($rItem->productSuppId)[0]->image . '" style="width:150px;height: 100px;"><br>'
                            . $producSupp->title . '</td>' .
                            '<td style="vertical-align: middle;text-align: center;">' . $rItem->quantity . '</td>' .
                            '<td style="vertical-align: middle;text-align: center;"><a class="btn" id="incr-return">-</a> <input type="text" class="text-center" id="qnty-return' . $rItem->returnProductId . '" value="' . $rItem->quantity . '" style="width:35px;height:35px;" readonly="true"> <a class="btn" id="incr-return">+</a></td>' .
                            '<td style="vertical-align: middle;text-align: center;"><textarea name="remark[' . $rItem->returnProductId . ']" id="remark' . $rItem->returnProductId . '">' . $rItem->remark . '</textarea></td>' .
                            '<input type="hidden" id="pSuppId" value="' . $rItem->returnProductId . '">' .
                            '<input type="hidden" id="pOrderId" value="' . $rItem->orderId . '">' .
                            '<td style="vertical-align: middle;text-align: center;font-size:25pt;"><i class="fa fa-times-circle deleteR" id="deleteR"' . $rItem->returnProductId . '" aria-hidden="true" style="cursor: pointer;"></i></td>' .
                            '</tr>';
                    $i++;
                endforeach;
                $footer = $this->tableFooter();
                $res["dataList"] = $header . $body . $footer;
                $res["status"] = TRUE;
            }else {
                $res["status"] = FALSE;
            }
        }

        return \yii\helpers\Json::encode($res);
    }

    public function actionCheckRemark() {
        $orderId = $_POST['orderId'];
        $res = [];
        $id = [];
        $i = 0;
        $returnProduct = ReturnProduct::find()->where("orderId=" . $orderId . " and status=1")->all();
        if (isset($returnProduct) && !empty($returnProduct)) {
            foreach ($returnProduct as $return):
                $id[$i] = $return->returnProductId;
                $i++;
            endforeach;
            $res["status"] = TRUE;
            $res["returnId"] = $id;
            $res["counts"] = count(ReturnProduct::find()->where("orderId=" . $orderId . " and status=1")->all());
            // echo $orderId;
            // throw new \yii\base\Exception($orderId);
        }else {
            $res["status"] = FALSE;
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionChangeQuantityReturnList() {
        $orderId = $_POST["orderId"];
        $returnId = $_POST["returnId"];
        $currentQnty = $_POST["qnty"];
        $type = $_POST["incr"];
        $res = [];
        if ($type == "+") {
            $newQuantity = $currentQnty + 1;
        } else {
            $newQuantity = $currentQnty - 1;
        }
        $return = ReturnProduct::find()->where("returnProductId=" . $returnId)->one();
        $orderItem = OrderItem::find()->where("orderItemId=" . $return->orderItemId . " and orderId=" . $orderId)->one();
        if ($newQuantity <= 0) {
            $res["quantity"] = 1;
            $res["messege"] = "จำนวนที่ต้องการคืนต้องไม่น้อยกว่า 1 รายการ";
            $res["status"] = FALSE;
        } else if ($newQuantity > $orderItem->quantity) {
            $res["quantity"] = $orderItem->quantity;
            $res["messege"] = "จำนวนที่ต้องการคืนต้องไม่มากกว่าจำนวนที่ซื้อ(" . $orderItem->quantity . " รายการ)";
            $res["status"] = FALSE;
        } else {
            $res["quantity"] = $newQuantity;
            $res["status"] = TRUE;
        }
        $return->quantity = $res["quantity"];
        $return->totalPrice = $res["quantity"] * $return->price;
        $return->totalDiscount = $return->discount * $res["quantity"];
        $return->credit = $return->totalPrice - $return->totalDiscount;
        $return->save(false);
        return \yii\helpers\Json::encode($res);
    }

    public function supplierId($isbn, $orderId) {
        $id = OrderItem::find()
                ->join("LEFT JOIN", "product_suppliers ps", "order_item.productSuppId=ps.productSuppId")
                ->where("ps.isbn='" . $isbn . "' and order_item.orderId=" . $orderId)
                ->one();
        if (isset($id) && !empty($id)) {
            return $id->productSuppId;
        } else {
            return '';
        }
    }

    public function tableHeader() {
        return $header = '<table class="table">' .
                '<tr style="height: 50px;background-color: #999999;">' .
                '<th style="vertical-align: middle;text-align: center;width: 5%;">No.</th>' .
                '<th style="vertical-align: middle;text-align: center;width: 30%;">สินค้า</th>' .
                '<th style="vertical-align: middle;text-align: center;width: 10%;">สั่งซื้อ</th>' .
                '<th style="vertical-align: middle;text-align: center;width: 35%;">จำนวนที่ต้องการคืน</th>' .
                '<th style="vertical-align: middle;text-align: center;width: 15%;">Remark</th>' .
                '<th style="vertical-align: middle;text-align: center;width: 5%;">ยกเลิก</th>' .
                '</tr>';
    }

    public function tableFooter() {
        return $footer = '</table>' . '<a class="btn-lg  pull-right" id="confirm-return" style="background-color: #000;color: #ffcc00;cursor: pointer;"><i class="fa fa-check-square-o" aria-hidden="true"></i> คืนสินค้า</a>';
    }

    public function actionSaveMessege() {
        $messege = new \common\models\costfit\Messege();
        $res = [];
        if ($_POST["messege"] != '') {
            $messege->orderId = $_POST["orderId"];
            $messege->userId = $_POST["userId"];
            $messege->ticketId = $_POST["ticketId"];
            $messege->messege = $_POST["messege"];
            $messege->messegeType = 2; //customer   2=> cozxy
            $messege->status = 1;
            $messege->createDateTime = new \yii\db\Expression('NOW()');
            $messege->updateDateTime = new \yii\db\Expression('NOW()');
            $messege->save(false);
            $res["status"] = True;
        } else {
            $res["status"] = FALSE;
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionShowMessege() {
        $messeges = \common\models\costfit\Messege::find()->where("ticketId=" . $_POST["ticketId"])
                ->orderBy("createDateTime ASC")
                ->all();
        $ms = '';
        $customer = 'คุณ';
        $ScrollPosition = 300;
        $res = [];
        if (isset($messeges) && !empty($messeges)) {
            foreach ($messeges as $messege):
                if ($messege->messegeType == 2) {//ข้อความทางฝั่ง cozxy ชิดขวา
                    $ms = $ms . '<div class="message-yellow-right">' . $messege->messege . '</div><div class="col-lg-12"></div>';
                } else {///ฝั่ง customer ชิดซ้าย
                    $ms = $ms . '<div class="message-black-left">' . $messege->messege . '</div><div class="col-lg-12"></div>';
                }
                $ScrollPosition += 50;
            endforeach;
            $res["posi"] = $ScrollPosition;
            $res["ms"] = $ms;
        } else {
            $res["posi"] = $ScrollPosition;
            $res["ms"] = $ms;
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionSearchWait() {
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $res = [];
        $text = '';
        $ms = $_POST['ms'];
        $header = '';
        $userId = $this->findUserId($_POST['ms']);
        $orderId = $this->findOrderId($_POST['ms']);
        if ($userId == '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_CREATE . " and ticketNo like'%" . $_POST['ms'] . "%'")->all();
        } else if ($userId != '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_CREATE . " and (ticketNo like'%" . $_POST['ms'] . "%' or userId in ($userId))")->all();
        } else if ($userId == '' && $orderId != '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_CREATE . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId))")->all();
        } else {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_CREATE . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId) or userId in ($userId))")->all();
        }

        if (isset($tickets) && !empty($tickets)) {
            $i = 1;
            foreach ($tickets as $ticket):
                $text = $text . "<tr><td style='text-align: center;width: 5%;'>" . $i . "</td>" .
                        "<td style='text-align: center;width: 15%;'>" . Order::findOrderNo($ticket->orderId) . "</td>" .
                        "<td style='text-align: center;width: 15%;'>" . Order::invoiceNo($ticket->orderId) . "</td>" .
                        "<td style='text-align: center;width: 15%;'>" . $ticket->ticketNo . "</td>" .
                        "<td style='text-align: center;width: 15%;'>" . User::userName($ticket->userId) . "</td>" .
                        "<td style='text-align: center;width: 20%;'>" . substr($this->dateThai(Order::recieveDate($ticket->orderId), 1, true), 0, -8) . "</td>" .
                        "<td style='text-align: center;width: 15%;'><a href=" . $baseUrl . 'ticket-detail?orderId=' . $ticket->ticketId . " >รายละเอียด</a></td></tr>";
                $i++;
            endforeach;
            $res["wait"] = $text;
        } else {
            $res["wait"] = '<td colspan="7" style="text-align: center;color:red;font-size:14pt;"><i>ไม่มีข้อมูล</i></td>';
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionSearchApprove() {
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $res = [];
        $text = '';
        $ms = $_POST['ms'];
        $userId = $this->findUserId($_POST['ms']);
        $orderId = $this->findOrderId($_POST['ms']);
        if ($userId == '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_APPROVED . " and ticketNo like'%" . $_POST['ms'] . "%'")->all();
        } else if ($userId != '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_APPROVED . " and (ticketNo like'%" . $_POST['ms'] . "%' or userId in ($userId))")->all();
        } else if ($userId == '' && $orderId != '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_APPROVED . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId))")->all();
        } else {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_APPROVED . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId) or userId in ($userId))")->all();
        }

        if (isset($tickets) && !empty($tickets)) {
            $i = 1;
            foreach ($tickets as $ticket):
                $text = $text . "<tr><td style='text-align: center;width: 15%;'>" . Order::invoiceNo($ticket->orderId) . "</td>" .
                        "<td style='text-align: center;width: 35%;'>" . $ticket->ticketNo . "</td>" .
                        "<td style='text-align: center;width: 35%;'>" . User::userName($ticket->userId) . "</td>" .
                        "<td style='text-align: center;width: 15%;'><a href=" . $baseUrl . 'ticket-detail?orderId=' . $ticket->ticketId . " >รายละเอียด</a></td></tr>";
                $i++;
            endforeach;
            $res["wait"] = $text;
        } else {
            $res["wait"] = '<td colspan="4" style="text-align: center;color:red;font-size:14pt;"><i>ไม่มีข้อมูล</i></td>';
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionSearchNotApprove() {
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $res = [];
        $text = '';
        $ms = $_POST['ms'];
        $userId = $this->findUserId($_POST['ms']);
        $orderId = $this->findOrderId($_POST['ms']);
        if ($userId == '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_NOT_APPROVE . " and ticketNo like'%" . $_POST['ms'] . "%'")->all();
        } else if ($userId != '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_NOT_APPROVE . " and (ticketNo like'%" . $_POST['ms'] . "%' or userId in ($userId))")->all();
        } else if ($userId == '' && $orderId != '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_NOT_APPROVE . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId))")->all();
        } else {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_NOT_APPROVE . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId) or userId in ($userId))")->all();
        }

        if (isset($tickets) && !empty($tickets)) {
            $i = 1;
            foreach ($tickets as $ticket):
                $text = $text . "<tr><td style='text-align: center;width: 40%;'>" . Order::invoiceNo($ticket->orderId) . "</td>" .
                        "<td style='text-align: center;width: 30%;'>" . $ticket->ticketNo . "</td>" .
                        "<td style='text-align: center;width: 30%;'><a href=" . $baseUrl . 'ticket-detail?orderId=' . $ticket->ticketId . " >รายละเอียด</a></td></tr>";
                $i++;
            endforeach;
            $res["wait"] = $text;
        } else {
            $res["wait"] = '<td colspan="3" style="text-align: center;color:red;font-size:14pt;"><i>ไม่มีข้อมูล</i></td>';
        }
        return \yii\helpers\Json::encode($res);
    }

    public function findUserId($ms) {
        $id = '';
        $users = User::find()->where("firstname like '%" . $ms . "%' or lastname like '%" . $ms . "%'")->all();
        if (isset($users) && !empty($users)) {
            foreach ($users as $user):
                $id = $id . $user->userId . ",";
            endforeach;
        }
        if ($id != '') {
            $id = substr($id, 0, -1);
        }
        return $id;
    }

    public function findOrderId($ms) {
        $id = '';
        $orders = Order::find()->where("orderNo like'%" . $ms . "%' or invoiceNo like '%" . $ms . "%'")->all();
        if (isset($orders) && !empty($orders)) {
            foreach ($orders as $order):
                $id = $id . $order->orderId . ",";
            endforeach;
        }
        if ($id != '') {
            $id = substr($id, 0, -1);
        }
        return $id;
    }

}
