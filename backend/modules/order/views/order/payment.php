
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<div class="order-index">


    <?php
    Pjax::begin(['id' => 'employee-grid-view']);
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <h3> Invoice No : <?php echo $order->invoiceNo; ?></h3>
            <?=
            GridView::widget([
                // 'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'decision',
                    'reasonCode',
                    'reason',
                    'userIp',
                    'status',
                    'createDateTime',
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
