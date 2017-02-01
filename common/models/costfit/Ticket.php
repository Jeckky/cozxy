<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\TicketMaster;

/**
 * This is the model class for table "ticket".
 *
 * @property string $ticketId
 * @property integer $orderId
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Ticket extends \common\models\costfit\master\TicketMaster {

    const TICKET_STATUS_CREATE = 1;
    const TICKET_STATUS_WAIT = 2;
    const TICKET_STATUS_APPROVED = 3;
    const TICKET_STATUS_NOT_APPROVE = 4;
    const TICKET_STATUS_SUCCESSFULL = 5;
    const TICKET_STATUS_REJECT = 6;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public static function statusText($ticketId) {
        $ticket = Ticket::find()->where("ticketId=" . $ticketId)->one();
        $status = '';
        if (isset($ticket) && !empty($ticket)) {
            if ($ticket->status == Ticket::TICKET_STATUS_CREATE) {
                $status = 'รอการอนุมัติ';
            }
            if ($ticket->status == Ticket::TICKET_STATUS_APPROVED) {
                $status = 'ผ่านการอนุมัติ';
            }
            if ($ticket->status == Ticket::TICKET_STATUS_NOT_APPROVE) {
                $status = 'ไม่อนุมัติ';
            }
            if ($ticket->status == Ticket::TICKET_STATUS_REJECT) {
                $status = 'ยกเลิกคำขอ';
            }
            if ($ticket->status == Ticket::TICKET_STATUS_SUCCESSFULL) {
                $status = 'สำเร็จ';
            }
        }
        return $status;
    }

}
