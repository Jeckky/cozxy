<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\models\costfit\Product;
use common\models\costfit\Order;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Picking Order Slots';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12"><?= $this->title ?></div>

        </div>
    </div>
    <div class="panel-body">
        <?php
        $form = ActiveForm::begin([
                    'method' => 'GET',
                    'action' => ['packing/packing'],
        ]);
        ?>
        <h3> Scan Product Code </h3><br>
        <h4>   Product code :  <input type="text" name="item" autofocus="true" id="item"></h4>

        <?= $this->registerJS("
                            $('#qrSlot').blur(function(event){
                                if(event.which == 13 || event.keyCode == 13)
                                {
                                   $('#form').submit();
                                }
                            });
                ") ?>

        <br>
        <input type="hidden" name="orderId" value="<?= $orderId ?>">
        <?php ActiveForm::end(); ?>
        <?php
        ?>
        <table class="table table-condensed" style="text-align: center;">
            <thead>
                <tr >
                    <th><center>No.</center></th>
            <th><center>Products</center></th>
            <th><center>Status</center></th>
            </tr>
            </thead>
            <tbody>
                <?php
                $items = common\models\costfit\OrderItemPacking::orderInPacking($orderId);
                $i = 1;
                if (isset($items) && !empty($items)) {
                    foreach ($items as $item):
                        echo '<tr>';
                        echo '<td>' . $i . '</td>';
                        echo '<td>' . Product::findProductInPack($item->orderItemId) . '</td>';
                        echo '<td> ใส่ถุงแล้ว ' . $item->quantity . ' / ' . common\models\costfit\OrderItemPacking::createStatus($item->orderItemId) . '</td>';
                        echo '</tr>';
                        $i++;
                    endforeach;
                }else {
                    echo '<td colspan="3"> ยังไม่มีสินค้าในถุง </td>';
                }
                //throw new \yii\base\Exception(print_r($order, true));
                ?>
            </tbody>
        </table>
        <div class="col-lg-12 text-center">
            <?php
            if (isset($ms) && !empty($ms)) {
                echo '<br><br><code>' . $ms . '</code><br><br>';
            }
            ?>
        </div>
        <div class="pull-right">
            <?= Html::submitButton("  ปิดถุง", ['class' => 'btn btn-success btn-lg fa fa-check-square-o']) ?></div>

    </div>
</div>
