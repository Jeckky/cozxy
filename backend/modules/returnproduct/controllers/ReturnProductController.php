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
class ReturnProductController extends ReturnProductMasterController
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($ticketId)
    {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        } else {
            return $this->render('index', [
                'ticketId' => $ticketId
            ]);
        }
    }

    public function actionDetail()
    {
        $ticketId = $_GET['ticketId'];
        if (isset($_GET['orderId'])) {
            $order = Order::find()->where("orderId='" . $_GET['orderId'] . "' and status=" . Order::ORDER_STATUS_RECEIVED)->one();
            if (isset($order) && !empty($order)) {
                return $this->redirect(['order-detail',
                    'orderId' => $order->orderId,
                    'ticketId' => $ticketId
                ]);
            } else {
                $ms = 'ไม่มีออร์เดอร์ กรุณาลองใหม่อีกครั้ง';
                return $this->redirect(['request-ticket']);
            }
        }
    }

    public function actionRequestTicket()
    {
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
        $waitCozxy = Ticket::find()->where("status=5")//
        ->orderBy("updateDateTime DESC")
        ->limit(30)
        ->all();
        $success = Ticket::find()->where("status=7")//
        ->orderBy("updateDateTime DESC")
        ->limit(30)
        ->all();
        return $this->render('ticket_request', [
            'tickets' => $tickets,
            'approved' => $approved,
            'notApproved' => $notApproved,
            'waitCozxy' => $waitCozxy,
            'success' => $success
        ]);
    }

    public function actionTicketDetail($ticketId)
    {
        if (isset($ticketId)) {
            $ticket = Ticket::find()->where("ticketId=" . $ticketId)->orderBy("createDateTime DESC")->one();
//$orderItems = OrderItem::find()->where("orderId=" . $ticket->orderId)->all();
            $returnProduct = ReturnProduct::find()->where("ticketId=" . $ticketId)->all();
            $province = \common\models\dbworld\States::find()->where("stateId=" . $ticket->provinceId)->one();
            $amphur = \common\models\dbworld\Cities::find()->where("cityId=" . $ticket->amphurId)->one();
            $pickingPoint = \common\models\costfit\PickingPoint::find()->where("pickingId=" . $ticket->pickingId)->one();
            $textReturn = "Boots " . $pickingPoint->title . ", " . $amphur->cityName . ", " . $province->stateName;
            return $this->render('ticket_detail', [
//'orderItems' => $orderItems,
                'orderId' => $ticket->orderId,
                'ticket' => $ticket,
                'textReturn' => $textReturn,
                'returnProduct' => $returnProduct
            ]);
        }
    }

    public function actionContact($ticketId)
    {
        $ticket = Ticket::find()->where("ticketId=" . $ticketId)->one();
        $order = Order::find()->where("orderId=" . $ticket->orderId)->one();
        return $this->render('contact', [
            'ticket' => $ticket,
            'orderNo' => $order->orderNo
        ]);
    }

    public function actionApproveTicket()
    {
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

    public function actionApproveTicketCozxy()
    {
        if (isset($_POST["ticketId"])) {
            $orderId = $_POST['orderId'];
            if (isset($_POST['isAccept'])) {
                //throw new \yii\base\Exception($_POST['remark'][2]);
                $allReturn = ReturnProduct::find()->where("orderId=" . $orderId . " and status=4 and ticketId=" . $_POST['ticketId'])->all();
                $countReturn = count($allReturn);
                $countCheck = count($_POST['isAccept']);
                if ($countCheck < $countReturn) {
                    $ms = "กรุณาเลือก รับคืน / ไม่รับคืน ให้ครบทุกช่อง";
                    return $this->redirect(['cozxy-confirm',
                        'ticketId' => $_POST['ticketId'],
                        'ms' => $ms
                    ]);
                } else {
                    $check = false;
                    foreach ($_POST['isAccept'] as $index => $res):
                        if ($res == 0 && $_POST['remark'][$index] == '') {
                            $ms = "กรุณาเลือกใส่เหตุผลในช่องที่ไม่รับคืน";
                            return $this->redirect(['cozxy-confirm',
                                'ticketId' => $_POST['ticketId'],
                                'ms' => $ms
                            ]);
                        }
                    endforeach;
                }
            } else {
                $ms = "กรุณาเลือก รับคืน / ไม่รับคืน ให้ครบทุกช่อง";
                return $this->redirect(['cozxy-confirm',
                    'orderId' => $orderId,
                    'ticketId' => $_POST['ticketId'],
                    'ms' => $ms
                ]);
            }
            $ticket = Ticket::find()->where("ticketId=" . $_POST["ticketId"])->one();
            $totalCredit = 0;
            $returnCoin = 0;
            $returnProduct = ReturnProduct::find()->where("ticketId=" . $_POST["ticketId"] . " and status=4")->all();
            if (isset($returnProduct) && count($returnProduct) > 0) {
                foreach ($returnProduct as $item):
                    if ($_POST['isAccept'][$item->returnProductId] == 1) {
                        $item->status = 5; //อนุมัติ//รับคืน
                        $totalCredit += $item->credit;
                    } else {
                        $item->status = 6; //ไม่อนุมัติ//ส่งคืน
                        $item->cozxyRemark = $_POST['remark'][$item->returnProductId];
                    }
                    $item->updateDateTime = new \yii\db\Expression('NOW()');
                    $item->save(false);
                endforeach;
            }
            $checkTicketSuccess = ReturnProduct::find()->where("ticketId=" . $_POST["ticketId"] . " and orderId=" . $ticket->orderId . " and status=5")->all();
            if (isset($checkTicketSuccess) && count($checkTicketSuccess) > 0) {
                $ticket->status = Ticket::TICKET_STATUS_SUCCESSFULL;
            } else {
                $ticket->status = Ticket::TICKET_STATUS_NOT_SUCCESSFULL;
            }
            $ticket->updateDateTime = new \yii\db\Expression('NOW()');
            $ticket->save(false);
            $order = Order::find()->where("orderId=" . $ticket->orderId)->one();
            if (isset($order) && !empty($order)) {
                $topUp = new \common\models\costfit\TopUp();
                $topUp->userId = $order->userId;
                $topUp->point = $totalCredit;
                $topUp->money = $totalCredit;
                $topUp->paymentMethod = 4;
                $topUp->type = 1;
                $topUp->status = 3;
                $topUp->description = "Return product";
                $topUp->createDateTime = new \yii\db\Expression('NOW()');
                $topUp->updateDateTime = new \yii\db\Expression('NOW()');
                $topUp->save(false);
                $userPoint = \common\models\costfit\UserPoint::find()->where("userId=" . $order->userId)->one();
                //$userPoint->currentPoint += $totalCredit;
                //$userPoint->totalPoint += $totalCredit;
                $userPoint->updateDateTime = new \yii\db\Expression('NOW()');
                $userPoint->save(false);
                $returnCoin = $totalCredit;
                $this->sendEmail($_POST["ticketId"], $ticket->orderId, $returnCoin);
                return $this->redirect(['cozxy-approve-return']);
            }
//}
            /* else {
              $ticket->status = Ticket::TICKET_STATUS_NOT_SUCCESSFULL;
              $ticket->cozxyRemark = $_POST['remark'];
              $returnProduct = ReturnProduct::find()->where("ticketId=" . $_POST["ticketId"] . " and status=2")->one();
              if (isset($returnProduct) && count($returnProduct) > 0) {
              foreach ($returnProduct as $items):
              $item->status = 4; //ไม่อนุมัติ
              $item->updateDateTime = new \yii\db\Expression('NOW()');
              $item->save(false);
              endforeach;
              }
              $ticket->updateDateTime = new \yii\db\Expression('NOW()');
              $ticket->save(false);
              $res["status"] = FALSE;
              $this->sendEmail($_POST["ticketId"], $ticket->orderId, $returnCoin);
              }

              return \yii\helpers\Json::encode($res); */
        } else {
            return $this->redirect(['cozxy-approve-return']);
        }
    }

    public function sendEmail($ticketId, $orderId, $returnCoin)
    {
        $ticket = Ticket::find()->where("ticketId=" . $ticketId . " and orderId=" . $orderId)->one();
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $user = User::find()->where("userId=" . $order->userId)->one();
        $userPoint = \common\models\costfit\UserPoint::find()->where("userId=" . $order->userId)->one();
        $pickingPoints = PickingPoint::find()->where("pickingId=" . $ticket->pickingId)->one();
        if ($ticket->status == Ticket::TICKET_STATUS_SUCCESSFULL) {
            $status = "Successful";
            $remark = '';
        }if ($ticket->status == Ticket::TICKET_STATUS_NOT_SUCCESSFULL) {
            $status = "Not successful";
            $remark = $ticket->cozxyRemark;
        }
        $ticketNo = $ticket->ticketNo;
        $currentPoint = $userPoint->currentPoint;
        $returnPoint = $returnCoin;
        $mailTo = $user->email;
        $username = $user->firstname . " " . $user->lastname;
        $pickingPoint = $pickingPoints->title;
        $listReturn = ReturnProduct::find()->where("ticketId=" . $ticketId . " and orderId=" . $orderId)->all();
        $sendMail = \common\helpers\Email::mailReturnResult($mailTo, $ticketNo, $currentPoint, $returnPoint, $order->orderNo, $username, $status, $remark, $pickingPoint, $listReturn);
    }

    public function actionOrderDetail($orderId, $ticketId)
    {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $addressText = '';
        $ms = '';
        if (isset($_GET['ms'])) {
            $ms = $_GET['ms'];
        }
        if (isset($_GET['reEdit'])) {
            $returnList = ReturnProduct::find()->where("orderId=" . $orderId . " and ticketId=" . $ticketId)->all();
            foreach ($returnList as $re):
                $re->status = 1;
                $re->save(false);
            endforeach;
        }
        $returnList = ReturnProduct::find()->where("orderId=" . $orderId . " and status=1 and ticketId=" . $ticketId)->all();
        $address = Address::find()->where("userId=" . $order->userId . " and isDefault=1")->one();
        if (isset($address) && !empty($address)) {
            $addressText = User::userAddressText($address->addressId, true);
        }
        $pickingPoint = PickingPoint::find()->where("pickingId=" . $order->pickingId)->one();
        return $this->render('order_detail', [
            'order' => $order,
            'addressText' => $addressText,
            'pickingPoint' => isset($pickingPoint) && !empty($pickingPoint) ? $pickingPoint->title : '',
            'returnList' => $returnList,
            'ticketId' => $ticketId,
            'ms' => $ms
        ]);
    }

    public function actionReturnList()
    {
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
                        $checkQuantity = false;
                        $checkQuantity = $this->checkQuantityItem($item->orderItemId, $_POST["orderId"]);
                        $check = $this->checkDupplicateItem($item->orderItemId, $_POST['ticketId'], $_POST["orderId"]);
                        if ($check == true) {
                            if ($checkQuantity == true) {
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
                            } else {
                                $res["errors"] = "Max quantity for this product in this order";
                            }
                        } else {
                            $res["errors"] = "Max quantity for this product in this order";
                        }
                    endforeach;
                    $returnItems = ReturnProduct::find()->where("orderId=" . $_POST["orderId"] . " and status=1")->all();
                    $i = 1;
                    if (isset($returnItems) && count($returnItems) > 0) {
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
                    }
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

    public function checkDupplicateItem($orderItemId, $ticketId, $orderId)
    {
        $returns = ReturnProduct::find()->where("orderItemId=" . $orderItemId . " and ticketId=" . $ticketId . " and orderId=" . $orderId)->one();
        if (isset($returns) && !empty($returns)) {
            return false;
        } else {
            return true;
        }
    }

    public function checkQuantityItem($orderItemId, $orderId)
    {
        $returns = ReturnProduct::find()->where("orderItemId=" . $orderItemId . " and orderId=" . $orderId)->all();
        if (isset($returns) && count($returns) > 0) {//ถ้าเกินจำนวนใน order คืนไมได้
            $total = 0;
            foreach ($returns as $return):
                $total += $return->quantity;
            endforeach;
            $orderItems = OrderItem::find()->where("orderItemId=" . $orderItemId)->one();
            if ($total >= $orderItems->quantity) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    public function actionConfirmReturn()
    {
        if (isset($_POST["orderId"])) {
            $orderId = $_POST["orderId"];
//throw new \yii\base\Exception(print_r($_POST["remark"], true));
            $ticketId = '';
            $ms = '';
            if (isset($_POST['isAccept'])) {
                $allReturn = ReturnProduct::find()->where("orderId=" . $orderId . " and status=1 and ticketId=" . $_POST['ticketId'])->all();
                $countReturn = count($allReturn);
                $countCheck = count($_POST['isAccept']);
                if ($countCheck < $countReturn) {
                    $ms = "กรุณาเลือก รับคืน / ไม่รับคืน ให้ครบทุกช่อง";
                    return $this->redirect(['order-detail',
                        'orderId' => $orderId,
                        'ticketId' => $_POST['ticketId'],
                        'ms' => $ms
                    ]);
                }
            } else {
                $ms = "กรุณาเลือก รับคืน / ไม่รับคืน ให้ครบทุกช่อง";
                return $this->redirect(['order-detail',
                    'orderId' => $orderId,
                    'ticketId' => $_POST['ticketId'],
                    'ms' => $ms
                ]);
            }
            if (isset($_POST["remark"]) && !empty($_POST["remark"])) {
                foreach ($_POST["remark"] as $returnProductId => $remark):

                    $returnProduct = ReturnProduct::find()->where("returnProductId=" . $returnProductId)->one();
                    $returnProduct->remark = $remark;
                    if ($_POST["isAccept"][$returnProductId] == 1) {
                        $returnProduct->status = 2;
                    } else {
                        $returnProduct->status = 3;
                    }
                    $returnProduct->updateDateTime = new \yii\db\Expression('NOW()');

                    $returnProduct->save(false);
                    $ticketId = $returnProduct->ticketId;
                endforeach;
            }
            $returnProducts = ReturnProduct::find()->where("ticketId=" . $ticketId . " and orderId=" . $orderId)->all();
            if (isset($returnProducts) && count($returnProducts) > 0) {
                return $this->render('confirm_return', [
                    'orderId' => $orderId,
                    'returnProducts' => $returnProducts,
                    'ticketId' => $ticketId
                ]);
            }
        }
        if (isset($_POST['confirm'])) {//มาจากการกด ยืนยันการคืนสินค้า
            $orderId = $_POST['confirm'];
            $order = Order::find()->where("orderId=" . $orderId)->one();
            $totalCredit = 0;
            $returnProduct = ReturnProduct::find()->where("orderId=" . $orderId . " and status=2 and ticketId=" . $_POST['ticketId'])->all(); //ยอดเครดิตที่ลูกค้าเพิ่งคืน
            if (isset($returnProduct) && count($returnProduct) > 0) {
                foreach ($returnProduct as $item):
                    $item->status = 4; //เปลี่ยน สถานะเป็น 4 (รอ cozxy ตรวจสอบ)
                    $item->updateDateTime = new \yii\db\Expression('NOW()');
                    $item->save(FALSE);
                endforeach;
                $ticket = Ticket::find()->where("ticketId=" . $_POST['ticketId'])->one();
                $ticket->status = 5; //เปลี่ยน สถานะเป็น 5 (รอ cozxy ตรวจสอบ)
                $ticket->updateDateTime = new \yii\db\Expression('NOW()');
                $ticket->save(false);
                $returnHistory = ReturnProduct::find()
                ->select(`order.*`, `return_product.*`)
                ->join('LEFT JOIN', 'order', 'order.orderId=return_product.orderId')
                ->where("order.userId=" . $order->userId . " and return_product.status=4 and return_product.ticketId=" . $_POST['ticketId'])
                ->orderBy("return_product.updateDateTime DESC")
                ->all();
                $lastReturn = ReturnProduct::find()->where("orderId=" . $order->orderId . " and ticketId=" . $_POST['ticketId'])->all();
                return $this->render('wait_cozxy', [
                    'userId' => $order->userId,
                    'returnHistory' => $returnHistory,
                    'lastReturn' => $lastReturn
                ]);
            }else {
//ถ้าไม่มีที่ผ่านการอนุมัติ จากบูธ
                $ticket = Ticket::find()->where("ticketId=" . $_POST['ticketId'])->one();
                $ticket->status = Ticket::TICKET_STATUS_REJECT;
                $ticket->save(false);
                /* $lastTicket = ReturnProduct::find()->where("orderId=" . $orderId . " and ticketId=" . $_POST['ticketId'])
                  ->orderBy('updateDateTime DESC')
                  ->one();

                  return $this->redirect(['approve-detail', 'orderId' => $orderId, 'flag' => 2, 'ticketId' => $lastTicket->ticketId]); */
                return $this->redirect(['request-ticket']);
            }
            /* if (isset($returnProduct) && count($returnProduct)>0) {
              foreach ($returnProduct as $return):
              $totalCredit += $return->credit;
              $orderId = $return->orderId;
              endforeach;
              $order = Order::find()->where("orderId=" . $orderId)->one();
              if (isset($order) && !empty($order)) {
              $topUp = new \common\models\costfit\TopUp();
              $topUp->userId = $order->userId;
              $topUp->point = $totalCredit;
              $topUp->money = $totalCredit;
              $topUp->paymentMethod = 4;
              $topUp->type = 1;
              $topUp->status = 3;
              $topUp->description = "Return product";
              $topUp->createDateTime = new \yii\db\Expression('NOW()');
              $topUp->updateDateTime = new \yii\db\Expression('NOW()');
              $topUp->save(false);
              $userPoint = \common\models\costfit\UserPoint::find()->where("userId=" . $order->userId)->one();
              $userPoint->currentPoint += $totalCredit;
              $userPoint->totalPoint += $totalCredit;
              $userPoint->updateDateTime = new \yii\db\Expression('NOW()');
              $userPoint->save(false);
              foreach ($returnProduct as $return):
              $return->status = 2; //เปลี่ยน สถานะเป็น 2 (การคืนเสร็จสิ้นสำหรับ order นี้)
              $return->updateDateTime = new \yii\db\Expression('NOW()');
              $return->save(FALSE);
              endforeach;
              $ticket = Ticket::find()->where("ticketId=" . $_POST['ticketId'])->one();
              $ticket->status = 5;
              $ticket->updateDateTime = new \yii\db\Expression('NOW()');
              $ticket->save(false);
              $returnHistory = ReturnProduct::find()
              ->select(`order.*`, `return_product.*`)
              ->join('LEFT JOIN', 'order', 'order.orderId=return_product.orderId')
              ->where("order.userId=" . $order->userId . " and return_product.status=2")
              ->orderBy("return_product.updateDateTime DESC")
              ->all();
              // $userTotalCredit = \common\models\costfit\UserCredit::find()->where("userId=" . $order->userId)->one();
              $userTotalCredit = \common\models\costfit\UserPoint::find()->where("userId=" . $order->userId)->one();
              $lastReturn = ReturnProduct::find()->where("orderId=" . $order->orderId)->all();
              return $this->render('successful_return', [
              'userId' => $order->userId,
              'returnHistory' => $returnHistory,
              'userTotalCredit' => $userTotalCredit,
              'lastReturn' => $lastReturn
              ]);
              } else {
              return $this->redirect(['approve-detail', 'orderId' => $orderId]);
              }
              } else {
              return $this->redirect(['approve-detail', 'orderId' => $orderId]);
              } */
        }
    }

    public function actionApproveDetail($orderId, $flag, $ticketId)
    {
        $order = Order::find()->where("orderId=" . $orderId)->one();
        $returnHistory = ReturnProduct::find()
        ->select(`order.*`, `return_product.*`)
        ->join('LEFT JOIN', 'order', 'order.orderId=return_product.orderId')
        ->where("order.userId=" . $order->userId . " and return_product.status=4 and return_product.ticketId=" . $ticketId)
        ->orderBy("return_product.updateDateTime DESC")
        ->all();
        $userTotalCredit = \common\models\costfit\UserPoint::find()->where("userId=" . $order->userId)->one();
        $lastReturn = ReturnProduct::find()->where("orderId=" . $order->orderId)->all();
        if ($flag == 1) {
            return $this->render('successful_return', [
                'userId' => $order->userId,
                'returnHistory' => $returnHistory,
                'userTotalCredit' => $userTotalCredit,
                'lastReturn' => $lastReturn
            ]);
        } else {
            return $this->render('wait_cozxy', [
                'userId' => $order->userId,
                'returnHistory' => $returnHistory,
                'userTotalCredit' => $userTotalCredit,
                'lastReturn' => $lastReturn
            ]);
        }
    }

    public function actionCozxyConfirm($ticketId)
    {
        $ms = '';
        if (isset($ticketId)) {
            if (isset($_GET['ms'])) {
                $ms = $_GET['ms'];
            }
            $ticket = Ticket::find()->where("ticketId=" . $ticketId)->orderBy("createDateTime DESC")->one();
//$orderItems = OrderItem::find()->where("orderId=" . $ticket->orderId)->all();
            if ($ticket->status == Ticket::TICKET_STATUS_WAIT_COZXY) {
                $returnProduct = ReturnProduct::find()->where("ticketId=" . $ticketId . " and status=4")->all();
            } else if ($ticket->status == Ticket::TICKET_STATUS_SUCCESSFULL) {
                $returnProduct = ReturnProduct::find()->where("ticketId=" . $ticketId . " and status=5")->all();
            } else if ($ticket->status == Ticket::TICKET_STATUS_NOT_SUCCESSFULL) {
                $returnProduct = ReturnProduct::find()->where("ticketId=" . $ticketId . " and status=6")->all();
            }
            $province = \common\models\dbworld\States::find()->where("stateId=" . $ticket->provinceId)->one();
            $amphur = \common\models\dbworld\Cities::find()->where("cityId=" . $ticket->amphurId)->one();
            $pickingPoint = \common\models\costfit\PickingPoint::find()->where("pickingId=" . $ticket->pickingId)->one();
            $textReturn = "Boots " . $pickingPoint->title . ", " . $amphur->cityName . ", " . $province->stateName;
            return $this->render('ticket_detail_cozxy', [
//'orderItems' => $orderItems,
                'orderId' => $ticket->orderId,
                'ticket' => $ticket,
                'textReturn' => $textReturn,
                'returnProduct' => $returnProduct,
                'ms' => $ms
            ]);
        }
    }

    public function actionDeleteReturnList()
    {
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

    public function actionCozxyApproveReturn()
    {
        $waitCozxyApprove = Ticket::find()->where("status=5")//
        ->orderBy("updateDateTime DESC")
        ->limit(30)
        ->all();
        $cozxyApprove = Ticket::find()->where("status=7")//
        ->orderBy("updateDateTime DESC")
        ->limit(30)
        ->all();
        $cozxyReject = Ticket::find()->where("status=8")//
        ->orderBy("updateDateTime DESC")
        ->limit(30)
        ->all();
        return $this->render('return_wait_cozxy', [
            'waitCozxyApprove' => $waitCozxyApprove,
        //'cozxyApprove' => $cozxyApprove,
        //'cozxyReject' => $cozxyReject,
        ]);
    }

    public function actionCheckRemark()
    {
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

    public function actionChangeQuantityReturnList()
    {
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
            //} else if ($newQuantity > $orderItem->quantity) {
        } else if ($newQuantity > $return->rQuantity) {
            $res["quantity"] = $return->rQuantity;
            $res["messege"] = "จำนวนที่ต้องการคืนต้องไม่มากกว่าจำนวนที่ซื้อ(" . $return->rQuantity . " รายการ)";
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

    public function supplierId($isbn, $orderId)
    {
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

    public function tableHeader()
    {
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

    public function tableFooter()
    {
        return $footer = '</table>' . '<a class="btn-lg  pull-right" id="confirm-return" style="background-color: #000;color: #ffcc00;cursor: pointer;"><i class="fa fa-check-square-o" aria-hidden="true"></i> คืนสินค้า</a>';
    }

    public function actionSaveMessage()
    {
        $messege = new \common\models\costfit\Messege();
        $res = [];
        if ($_POST["message"] != '') {
            $messege->orderId = $_POST["orderId"];
            $messege->userId = $_POST["userId"];
            $messege->ticketId = $_POST["ticketId"];
            $messege->message = $_POST["message"];
            $messege->messageType = 2; //customer   2=> cozxy
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

    public function actionShowMessage()
    {
        $messeges = \common\models\costfit\Messege::find()->where("ticketId=" . $_POST["ticketId"])
        ->orderBy("createDateTime ASC")
        ->all();
        $ms = '';
        $setFull = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
        $customer = 'คุณ';
        $ScrollPosition = 300;
        $res = [];
        if (isset($messeges) && !empty($messeges)) {
            foreach ($messeges as $messege):
                $showTime = substr($messege->createDateTime, 11, 5);
                if ($messege->messageType == 2) {//ข้อความทางฝั่ง cozxy ชิดขวา
                    $ms = $ms . '<div class="message-yellow-right">' . $messege->message . '</div>' . '<div class="pull-right" style="color:#cccccc;font-size:9pt;margin-top:12px;margin-right:2px;">' . $showTime . '</div><div class="' . $setFull . '"></div>';
                } else {///ฝั่ง customer ชิดซ้าย
                    $ms = $ms . '<div class="message-black-left">' . $messege->message . '</div>' . '<div class="pull-left" style="color:#cccccc;font-size:9pt;margin-top:12px;margin-left:2px;">' . $showTime . '</div><div  class="' . $setFull . '"></div>';
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

    public function actionSearchWait()
    {
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
                "<td style='text-align: center;width: 15%;'><a href=" . $baseUrl . 'ticket-detail?ticketId=' . $ticket->ticketId . " >รายละเอียด</a></td></tr>";
                $i++;
            endforeach;
            $res["wait"] = $text;
        } else {
            $res["wait"] = '<td colspan="7" style="text-align: center;color:red;font-size:14pt;"><i>ไม่มีข้อมูล</i></td>';
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionSearchApprove()
    {
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
                "<td style='text-align: center;width: 35%;'>" . User::userName($ticket->userId) . "</td>" .
                "<td style='text-align: center;width: 35%;'>" . $ticket->ticketNo . "</td>" .
                "<td style='text-align: center;width: 15%;'><a href=" . $baseUrl . 'contact?ticketId=' . $ticket->ticketId . " >รายละเอียด</a></td></tr>";
                $i++;
            endforeach;
            $res["wait"] = $text;
        } else {
            $res["wait"] = '<td colspan="4" style="text-align: center;color:red;font-size:14pt;"><i>ไม่มีข้อมูล</i></td>';
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionSearchApproveCozxy()
    {
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $res = [];
        $text = '';
        $ms = $_POST['ms'];
        $userId = $this->findUserId($_POST['ms']);
        $orderId = $this->findOrderId($_POST['ms']);
        if ($userId == '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_SUCCESSFULL . " and ticketNo like'%" . $_POST['ms'] . "%'")->all();
        } else if ($userId != '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_SUCCESSFULL . " and (ticketNo like'%" . $_POST['ms'] . "%' or userId in ($userId))")->all();
        } else if ($userId == '' && $orderId != '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_SUCCESSFULL . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId))")->all();
        } else {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_SUCCESSFULL . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId) or userId in ($userId))")->all();
        }

        if (isset($tickets) && !empty($tickets)) {
            $i = 1;
            foreach ($tickets as $ticket):
                $text = $text . "<tr><td style='text-align: center;width: 15%;'>" . Order::invoiceNo($ticket->orderId) . "</td>" .
                "<td style='text-align: center;width: 35%;'>" . User::userName($ticket->userId) . "</td>" .
                "<td style='text-align: center;width: 35%;'>" . $ticket->ticketNo . "</td>" .
                "<td style='text-align: center;width: 15%;'><a href=" . $baseUrl . 'cozxy-confirm?ticketId=' . $ticket->ticketId . " >รายละเอียด</a></td></tr>";
                $i++;
            endforeach;
            $res["wait"] = $text;
        } else {
            $res["wait"] = '<td colspan="4" style="text-align: center;color:red;font-size:14pt;"><i>ไม่มีข้อมูล</i></td>';
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionSearchWaitCozxy()
    {
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $res = [];
        $text = '';
        $ms = $_POST['ms'];
        $userId = $this->findUserId($_POST['ms']);
        $orderId = $this->findOrderId($_POST['ms']);
        if ($userId == '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_WAIT_COZXY . " and ticketNo like'%" . $_POST['ms'] . "%'")->all();
        } else if ($userId != '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_WAIT_COZXY . " and (ticketNo like'%" . $_POST['ms'] . "%' or userId in ($userId))")->all();
        } else if ($userId == '' && $orderId != '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_WAIT_COZXY . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId))")->all();
        } else {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_WAIT_COZXY . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId) or userId in ($userId))")->all();
        }

        if (isset($tickets) && !empty($tickets)) {
            $i = 1;
            foreach ($tickets as $ticket):
                $text = $text . "<tr><td style='text-align: center;width: 15%;'>" . Order::invoiceNo($ticket->orderId) . "</td>" .
                "<td style='text-align: center;width: 35%;'>" . User::userName($ticket->userId) . "</td>" .
                "<td style='text-align: center;width: 35%;'>" . $ticket->ticketNo . "</td>" .
                "<td style='text-align: center;width: 15%;'><a href=" . $baseUrl . 'approve-detail?orderId=' . $ticket->orderId . '&flag=2&ticketId=' . $ticket->ticketId . " >รายละเอียด</a></td></tr>";
                $i++;
            endforeach;
            $res["wait"] = $text;
        } else {
            $res["wait"] = '<td colspan="4" style="text-align: center;color:red;font-size:14pt;"><i>ไม่มีข้อมูล</i></td>';
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionSearchWaitCozxyConfirm()
    {
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $res = [];
        $text = '';
        $ms = $_POST['ms'];
        $header = '';
        $userId = $this->findUserId($_POST['ms']);
        $orderId = $this->findOrderId($_POST['ms']);
        if ($userId == '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_WAIT_COZXY . " and ticketNo like'%" . $_POST['ms'] . "%'")->all();
        } else if ($userId != '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_WAIT_COZXY . " and (ticketNo like'%" . $_POST['ms'] . "%' or userId in ($userId))")->all();
        } else if ($userId == '' && $orderId != '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_WAIT_COZXY . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId))")->all();
        } else {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_WAIT_COZXY . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId) or userId in ($userId))")->all();
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
                "<td style='text-align: center;width: 15%;'><a href=" . $baseUrl . 'cozxy-confirm?ticketId=' . $ticket->ticketId . " >รายละเอียด</a></td></tr>";
                $i++;
            endforeach;
            $res["wait"] = $text;
        } else {
            $res["wait"] = '<td colspan="7" style="text-align: center;color:red;font-size:14pt;"><i>ไม่มีข้อมูล</i></td>';
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionSearchNotApprove()
    {
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
                "<td style='text-align: center;width: 30%;'><a href=" . $baseUrl . 'ticket-detail?ticketId=' . $ticket->ticketId . " >รายละเอียด</a></td></tr>";
                $i++;
            endforeach;
            $res["wait"] = $text;
        } else {
            $res["wait"] = '<td colspan="3" style="text-align: center;color:red;font-size:14pt;"><i>ไม่มีข้อมูล</i></td>';
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionSearchNotApproveCozxy()
    {
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $res = [];
        $text = '';
        $ms = $_POST['ms'];
        $userId = $this->findUserId($_POST['ms']);
        $orderId = $this->findOrderId($_POST['ms']);
        if ($userId == '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_NOT_SUCCESSFULL . " and ticketNo like'%" . $_POST['ms'] . "%'")->all();
        } else if ($userId != '' && $orderId == '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_NOT_SUCCESSFULL . " and (ticketNo like'%" . $_POST['ms'] . "%' or userId in ($userId))")->all();
        } else if ($userId == '' && $orderId != '') {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_NOT_SUCCESSFULL . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId))")->all();
        } else {
            $tickets = Ticket::find()->where("status=" . Ticket::TICKET_STATUS_NOT_SUCCESSFULL . " and (ticketNo like'%" . $_POST['ms'] . "%' or orderId in ($orderId) or userId in ($userId))")->all();
        }

        if (isset($tickets) && !empty($tickets)) {
            $i = 1;
            foreach ($tickets as $ticket):
                $text = $text . "<tr><td style='text-align: center;width: 15%;'>" . Order::invoiceNo($ticket->orderId) . "</td>" .
                "<td style='text-align: center;width: 35%;'>" . User::userName($ticket->userId) . "</td>" .
                "<td style='text-align: center;width: 35%;'>" . $ticket->ticketNo . "</td>" .
                "<td style='text-align: center;width: 15%;'><a href=" . $baseUrl . 'cozxy-confirm?ticketId=' . $ticket->ticketId . " >รายละเอียด</a></td></tr>";
                $i++;
            endforeach;
            $res["wait"] = $text;
        } else {
            $res["wait"] = '<td colspan="3" style="text-align: center;color:red;font-size:14pt;"><i>ไม่มีข้อมูล</i></td>';
        }
        return \yii\helpers\Json::encode($res);
    }

    public function findUserId($ms)
    {
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

    public function findOrderId($ms)
    {
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
