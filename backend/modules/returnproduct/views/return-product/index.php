
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="order-index">
    <?php Pjax::begin(['id' => 'return-product']); ?>
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;">รับสินค้าคืน</h3></span>
        </div>
        <div class="panel-body">

            <?php
            $form = ActiveForm::begin([
                        'method' => 'POST',
                        'action' => ['return-product/index'],
            ]);
            ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="vertical-align: middle;text-align: center;"><h4><b>Order No QR code : </b></h4></th>
                        <td><?= \yii\helpers\Html::textInput('orderNo', NULL, ['class' => 'input-lg', 'autofocus' => 'autofocus']); ?><?= isset($ms) && $ms != '' ? ' <code> ' . $ms . '</code>' : '' ?></td>
                    </tr>
                </tbody>
            </table>
            <br><h4>:: สแกน Qr Code ของ Order ::</h4>
            <?= $this->registerJS("
                            $('#orderNo').blur(function(event){
                                if(event.which == 13 || event.keyCode == 13)
                                {
                                   $('#form').submit();
                                }
                            });
                ") ?>
        </div>
    </div>
    <!--    <div id="printableArea">
            <h1>Print me</h1>
        </div>-->

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
<div class="order-index">
    <?php Pjax::begin(['id' => 'return-product']); ?>
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #999999;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;">เงื่อนไขการรับคืน</h3></span>
        </div>
        <div class="panel-body">


        </div>
    </div>
    <?php Pjax::end(); ?>
</div>