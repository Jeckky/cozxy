<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\models\costfit\PickingPoint;
use common\models\costfit\OrderItemPacking;
use common\models\costfit\Order;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scan bag to book locker';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>

<div class="panel panel-default">
    <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
        <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
    </div>
    <?php
    $form = ActiveForm::begin([
                'method' => 'GET',
                'action' => ['shipping/book-locker'],
    ]);
    ?>
    <div class="panel-body ">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="vertical-align: middle;text-align: right;"><h4><b>จุดส่ง : </b></h4></th>
                    <th style="vertical-align: middle;text-align: left;"><h4><b><?= $point ?></b></h4></th>
                </tr>
                <tr>
                    <th style="vertical-align: middle;text-align: right;"><h4><b>ช่องที่ : </b></h4></th>
                    <th style="vertical-align: middle;text-align: left;"><h4><b><?= $slot ?></b></h4></th>
                </tr>
                <tr>
                    <th style="vertical-align: middle;text-align: right;"><h4><b>BagNo QR code : </b></h4></th>
                    <td><?= \yii\helpers\Html::textInput('bagNo', NULL, ['class' => 'input-lg', 'autofocus' => 'autofocus']); ?><?= isset($ms) && $ms != '' ? ' <code> ' . $ms . '</code>' : '' ?></td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" name="boxcode" value="<?= $pickingId ?>">
        <input type="hidden" name="pickingItemsId" value="<?= $pickingItemId ?>">
        <input type="hidden" name="orderId" value="<?= $orderId ?>">
        <?= $this->registerJS("
                $('#orderNo').blur(function(event){
                    if(event.which == 13 || event.keyCode == 13)
                    {
                       $('#form').submit();
                    }
                });
    ") ?>
        <?php ActiveForm::end(); ?>

    </div>
</div>
<?php
if (isset($bagInLocker) && count($bagInLocker) > 0) {
    ?>
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #cccccc;vertical-align: middle;">
            <span class="panel-title"><h3>จุดส่ง : <?= $point ?>, ช่องที่ : <?= $slot ?></h3></span>
        </div>
        <div class="panel-body">
            <table class="table table-condensed" style="text-align: center;">
                <thead>
                    <tr >
                        <th><center>No.</center></th>
                <th><center>BagNo.</center></th>
                <th><center>Take Out</center></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $id = '';
                    foreach ($bagInLocker as $bag):
                        echo '<tr>';
                        echo '<td>' . $i . '</td>';
                        echo '<td>' . $bag->bagNo . '</td>';
                        echo '<td>' . Html::a('<i class="fa fa-minus" aria-hidden="true"></i>', ['remove-from-locker',
                            'bagNo' => $bag->bagNo,
                            'pickingItemsId' => $bag->pickingItemsId,
                            'pickingId' => $pickingId,
                            'orderId' => $orderId
                                ], ['class' => 'btn btn-sm btn-danger']) . '</td>';

                        echo '</tr>';
                        $id .= $bag->orderItemPackingId . ",";
                        $i++;
                    endforeach;
                    ?>
                    <tr><td colspan="3" style="text-align: right;">
                            <?=
                            Html::a('ยืนยัน', ['confirm-booking',
                                'orderItemPackingId' => substr($id, 0, -1),
                                'orderId' => $orderId,
                                'pickingItemId' => $pickingItemId
                                    ], ['class' => 'btn btn-lg btn-success'])
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>

