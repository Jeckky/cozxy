<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\models\costfit\OrderItemPacking;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reprint bag label';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="order-index">
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
        </div>
        <div class="panel-body">


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bag number</th>
                        <th>Item(s)</th>
                        <th>Reprint</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($orderItemPacking) && count($orderItemPacking) > 0) {
                        $i = 1;
                        foreach ($orderItemPacking as $bag):
                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $bag->bagNo ?></td>
                                <td>
                                    <a class="links" status="<?= $order->status ?>" orderId="<?= $order->orderId ?>" style="cursor: pointer">Item (<?= OrderItemPacking::countItemInBag($bag->bagNo) ?>)</a>
                                </td>
                                <td><a href="<?= Yii::$app->homeUrl ?>store/packing/reprint-bag-label?bagNo=<?= $bag->bagNo ?>" target="_blank">Reprint</a></td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h4>รายละเอียด</h4>
                <div class="pull-right" data-dismiss="modal" style="margin-top: -50px;cursor: pointer;"><h3>X</h3></div>
            </div>
            <div class="modal-body col-md-12 text-left" style="font-size: 12px; white-space: wrap;">
                <div class="item col-md-12 text-left"></div>
            </div>
        </div>
    </div>
</div>