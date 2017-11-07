<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ship to customer home';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="order-index">
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;">#<?= $order->orderNo ?></h3></span>
        </div>
        <div class="panel-body">

            <?php
            $form = ActiveForm::begin([
                        'method' => 'GET',
            ]);
            ?>
            <input type="hidden" name="orderId" value="<?= $order->orderId ?>">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="vertical-align: middle;text-align: center;"><h4><b>Bag No QR code : </b></h4></th>
                <td><?= \yii\helpers\Html::textInput('bagNo', NULL, ['class' => 'input-lg', 'autofocus' => 'autofocus']); ?><?= isset($ms) && $ms != '' ? ' <code> ' . $ms . '</code>' : '' ?></td>
                </tr>
                </tbody>
            </table>
            <br><h4>สแกน Qr Code ของถุงเพื่อนำสินค้าไปส่ง</h4>
            <?= $this->registerJS("
                            $('#bagNo').blur(function(event){
                                if(event.which == 13 || event.keyCode == 13)
                                {
                                   $('#form').submit();
                                }
                            });
                ") ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #ffcc00;vertical-align: middle;">
        <span class="panel-title"><h4> ถุงที่สแกนแล้ว </h4></span>
    </div>
    <div class="panel-body">

        <table class="table table-bordered">
            <thead>
            <th>#</th>
            <th style="text-align: center;">Bag number</th>
            </thead>
            <tbody>
                <?php
                if (isset($sippedBag) && $shippedBag != null) {

                    $i = 1;
                    foreach ($sippedBag as $bag):
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $bag->bagno ?></td>
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