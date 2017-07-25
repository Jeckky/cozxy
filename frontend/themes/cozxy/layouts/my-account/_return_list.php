<?php

use yii\helpers\Html;
?>
<div class="table-responsive order-list">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ticket No</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($returnList) && count($returnList) > 0) {
                    foreach ($returnList as $list):
                        $i = 1;
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $list->ticketNo ?></td>
                            <td><?= $list->title ?></td>
                            <td><?= frontend\controllers\MasterController::dateThai($list->updateDateTime, 4) ?></td>
                            <td><?= common\models\costfit\Ticket::statusText($list->ticketId) ?></td>
                            <td><a href="<?= Yii::$app->homeUrl . 'return/ticket-detail-list?ticketId=' . $list->ticketId ?>" class="btn btn-black btn-xs" style='padding: 6px 9px;'><i class="fa fa-list-ul" aria-hidden="true"></i> Detail</a></td>
                        <tr>
                            <?php
                            $i++;
                        endforeach;
                    }
                    ?>

            </tbody>
        </table>

    </div>
</div>
