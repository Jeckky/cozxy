<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\data\ActiveDataProvider;
use common\models\costfit\Order;
use common\models\costfit\Ticket;
use common\models\costfit\ReturnProduct;
use common\helpers\PickingPoint;
use common\helpers\CozxyUnity;

/**
 * Description of ReturnController
 *
 * @author sna
 */
class ReturnController extends MasterController {

    public function actionReturning() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        //$this->layout = "/content_profile";
        $this->title = 'Cozxy.com | ขอคืนสินค้า';
        $this->subTitle = 'Home';
        $this->subSubTitle = "คำขอคืนสินค้า";
        $ms = '';
        $invoiceNo = '';
        //$checkStatus = Ticket::TICKET_STATUS_CREATE . "," . Ticket::TICKET_STATUS_WAIT . "," . Ticket::TICKET_STATUS_APPROVED;
        $histories = Ticket::find()->where("userId=" . Yii::$app->user->identity->userId)
                ->orderBy("updateDateTime DESC")
                ->all();
        if (isset($_GET['orderNo'])) {
            $inVoice = Order::find()->where("orderNo='" . $_GET['orderNo'] . "'")->one();
            $invoiceNo = $inVoice->invoiceNo;
        }
        if (isset($_POST["invoiceNo"])) {
            $order = Order::find()->where("invoiceNo='" . $_POST["invoiceNo"] . "' and status=" . Order::ORDER_STATUS_RECEIVED)->one();
            if (isset($order) && !empty($order)) {
                $tickets = Ticket::find()->where("orderId=" . $order->orderId . " and status!=" . Ticket::TICKET_STATUS_SUCCESSFULL)->one();
                if (isset($tickets) && !empty($tickets)) {//ถ้ายังมี order  ที่อยู่ระหว่างการคืน ไม่ให้สร้างใหม่
                    $tickets = Ticket::find()->where("ticketId=" . $tickets->ticketId)->one();
                    $ms = 'ERROR :This invoice already in process returning, please wait cozxy reply.';
                    return $this->render('@app/themes/cozxy/layouts/return/return_form', [
                                'tickets' => $tickets,
                                'histories' => $histories
                    ]);
                } else {
                    $ticket = new Ticket();
                    $ticket->orderId = $order->orderId;
                    $ticket->title = $_POST["tickeTitle"];
                    $ticket->description = $_POST["ticketDescription"];
                    $ticket->userId = Yii::$app->user->identity->userId;
                    $ticket->status = 1;
                    $ticket->ticketNo = $this->genNewTicket();
                    $ticket->createDateTime = new \yii\db\Expression('NOW()');
                    $ticket->updateDateTime = new \yii\db\Expression('NOW()');
                    $ticket->save(false);
                    $id = Yii::$app->db->getLastInsertID();
                    $tickets = Ticket::find()->where("ticketId=" . $id)->one();
                    return $this->render('@app/themes/cozxy/layouts/return/return_form', [
                                'tickets' => $tickets,
                                'histories' => $histories
                    ]);
                }
            } else {
                $ms = 'ERROR : Invoice not found';
                return $this->render('@app/themes/cozxy/layouts/return/return_form', [
                            'ms' => $ms,
                            'histories' => $histories
                ]);
            }
        } else {
            $ticket1 = Ticket::find()->where("userId=" . Yii::$app->user->identity->userId . " and status!=" . Ticket::TICKET_STATUS_SUCCESSFULL)->one();
            if (isset($ticket1) && !empty($ticket1)) {
                return $this->render('@app/themes/cozxy/layouts/return/return_form', [
                            'tickets' => $ticket1,
                            'histories' => $histories,
                            'invoiceNo' => $invoiceNo
                ]);
            } else {
                return $this->render('@app/themes/cozxy/layouts/return/return_form', [
                            'histories' => $histories,
                            'invoiceNo' => $invoiceNo
                ]);
            }
        }
        //$searchModel = new \common\models\costfit\Order();
        // $dataProvider = $searchModel->search(Yii::$app->request->get());
        //$dataProvider = $searchModel->search(Yii::$app->request->get());
    }

    public function actionSaveMessege() {
        $messege = new \common\models\costfit\Messege();
        $res = [];
        if ($_POST["messege"] != '') {
            $messege->orderId = $_POST["orderId"];
            $messege->userId = $_POST["userId"];
            $messege->ticketId = $_POST["ticketId"];
            $messege->messege = $_POST["messege"];
            $messege->messegeType = 1; //customer   2=> cozxy
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
        $ScrollPosition = 300;
        $res = [];
        if (isset($messeges) && !empty($messeges)) {
            foreach ($messeges as $messege):
                $showTime = substr($messege->createDateTime, 11, 5);
                if ($messege->messegeType == 1) {//ข้อความทางฝั่ง customer ชิดขวา
                    $ms = $ms . '<div class="message-yellow-right">' . $messege->messege . '</div><div class="pull-right" style="color:#cccccc;font-size:9pt;margin-top:12px;margin-right:2px;">' . $showTime . '</div><div class="col-lg-12"></div>';
                } else {///ฝั่ง cozxy ชิดซ้าย
                    $ms = $ms . '<div class="message-black-left">' . $messege->messege . '</div><div class="pull-left" style="color:#cccccc;font-size:9pt;margin-top:12px;margin-left:2px;">' . $showTime . '</div><div class="col-lg-12"></div>';
                }
                $ms = $ms;
                $ScrollPosition += 50;
            endforeach;
            //echo $ms;
            $res["posi"] = $ScrollPosition;
            $res["ms"] = $ms;
        } else {
            $res["posi"] = $ScrollPosition;
            $res["ms"] = $ms;
        }
        return \yii\helpers\Json::encode($res);
    }

    public function actionTicketDetail($ticketId) {
        $ticket = Ticket::find()->where("ticketId=" . $ticketId)->one();
        $returnProducts = ReturnProduct::find()->where("ticketId=" . $ticketId)->all();
        $chats = \common\models\costfit\Messege::find()->where("ticketId=" . $ticketId)
                ->orderBy("createDateTime ASC")
                ->all();
        return $this->render('@app/views/profile/ticket_detail', [
                    'ticket' => $ticket,
                    'returnProducts' => $returnProducts,
                    'chats' => $chats
        ]);
    }

    public function genNewTicket() {
        $ticket = Ticket::find()->max("ticketNo");
        if (isset($ticket) && !empty($ticket)) {
            $ticketNo = $ticket->ticketNo + 1;
        } else {
            $ticketNo = "00000001";
        }
        return $ticketNo;
    }

}
