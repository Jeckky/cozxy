<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use common\models\costfit\OrderItemPacking;

$this->title = 'ช่องของ Lockers';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>

<!--<div class="note note-success ">
    <h3>สถานที่ตั้ง Lockers </h3>
    <h4 style="color: #003147">
        Code Lockers  : <?php echo $listPoint->code; ?>
        ,ที่<?php echo $listPoint->title; ?>
        ,<?php echo $citie->localName; ?>
        ,<?php echo $state->localName; ?>
        ,<?php echo $countrie->localName; ?>
    </h4>

</div>-->
<div class="panel panel-info panel-dark widget-profile ">
    <div class="panel-heading">
        <div class="widget-profile-bg-icon"><i class="fa fa-twitter"></i></div>
        <div class="widget-profile-header">
            <span>OrderNo : <?= $order->orderNo ?></span><br>
        </div>
    </div> <!-- / .panel-heading -->
    <div class="widget-profile-counters">
        <div class="col-xs-3"><span>ที่ <?php echo $listPoint->title; ?></span></div>
        <div class="col-xs-3"><span><?php echo $citie->localName; ?></span></div>
        <div class="col-xs-3"><span><?php echo $state->localName; ?></span></div>
        <div class="col-xs-3"><span><?php echo $countrie->localName; ?></span></div>
    </div>
    <div class="widget-profile-text text-left" style="font-size: 16px;">
        <?php
        $bagInOrder = OrderItemPacking::bagInOrderToShip($order->orderId);
        $strBag = OrderItemPacking::strBag($bagInOrder);
        ?>
        ทั้งหมด <?= count($bagInOrder) ?> ถุง คือ <?= $strBag ?>
    </div>
    <div class="widget-profile-text text-center" style="font-size: 16px;">
        <?php echo $this->context->dateThai(date("Y-m-d"), 1, TRUE); ?> เวลา <div id="clockDisplay" class="clockStyle"></div>
    </div>
</div>
<div class="order-index col-md-12">
    <div class="panel panel-warning panel-dark">
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> เลือกช่องที่จะนำสินค้าไปใส่ </span>
        </div>
        <div class="panel-body ">
            <div class="col-sm-12">
                <h3><?= $point->title; ?></h3>
                <table class="table table-bordered" style="background-color: <?php echo $PickingPoints['frame'] ?>;">
                    <tbody>
                        <?php
                        $cols = common\models\costfit\PickingPointItems::find()
                                ->where(["pickingId" => $point->pickingId])
                                ->groupBy(["LEFT(portIndex,1)"])
                                ->all();
                        //echo '<pre>';
                        //print_r($cols);
                        ?>
                        <tr>
                            <?php foreach ($cols as $colIndex => $col): ?>
                                <td style="width:33%">
                                    <table class="table">
                                        <?php
                                        $rows = common\models\costfit\PickingPointItems::find()
                                                ->where(["pickingId" => $point->pickingId, 'LEFT(portIndex,1)' => substr($col->portIndex, 0, 1)])
                                                // ->groupBy(["RIGHT(portIndex,1)"])
                                                ->all();
                                        foreach ($rows as $rowIndex => $row):
                                            $height = "70px";
                                            switch ($row->height) {
                                                case 20 ://User
                                                    $height = "70px";
                                                    break;
                                                case 40 ://User
                                                    $height = "140px";
                                                    break;
                                                case 60 ://User
                                                    $height = "210px";
                                                    break;
                                            }
                                            ?>
                                            <tr>
                                                <td style="border:2px solid ;text-align:center;vertical-align: middle; color: <?php echo $PickingPoints['front']; ?> ;height: <?= $row->height ?>px
                                                    ; background-color: <?php
                                                    if ($row->status == 1) {
                                                        echo $PickingPoints['color_lid'];
                                                    } else { //echo $PickingPoints['frame']
                                                        echo '#D24136';
                                                    }
                                                    ?>">
                                                        <?php
                                                        $Inspector = OrderItemPacking::checkInspector($row->pickingItemsId);
                                                        //echo $colIndex . '::';
                                                        //echo $rowIndex;
                                                        if ($colIndex == 2 && $rowIndex == 1) { // if ($colIndex == 1 && $rowIndex == 1):
                                                            if ($PickingPoints['type'] == 'booth') {

                                                            } else {
                                                                ?>
                                                            <p style="font-size: 20px;font-weight: bold; padding: 20px; background-color: <?php echo $PickingPoints['color_lid']; ?>;"><?= "Controller" ?></p>
                                                        <?php } ?>
                                                    <?php } else { ?><h4>
                                                            <?php
                                                            if ($row->status == 0) {
                                                                echo 'มีของอยู่แล้ว..';
                                                            } else if ($row->status == 99) {
                                                                ?>
                                                                มีการจองสำหรับ..<br>
                                                                <?= OrderItemPacking::bagInLocker($row->pickingItemsId) ?>
                                                                <?php
                                                                $orderId = OrderItemPacking::sameOrder($row->pickingItemsId);
                                                                if ($orderId == $order->orderId) {
                                                                    ?>
                                                                    <a class="btn btn-lg   btn-info"style="margin-top: 10px;" href="<?php echo Yii::$app->homeUrl; ?>store/shipping/book-locker?pickingItemsId=<?php echo $row->pickingItemsId; ?>&orderId=<?= $order->orderId ?>&boxcode=<?php echo $row->pickingId; ?>">ใส่เพิ่มในช่อง : <?= $row->name; ?></a>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <a class="btn btn-lg   btn-info" href="<?php echo Yii::$app->homeUrl; ?>store/shipping/book-locker?pickingItemsId=<?php echo $row->pickingItemsId; ?>&orderId=<?= $order->orderId ?>&boxcode=<?php echo $row->pickingId; ?>">เลือกช่อง : <?= $row->name; ?></a>
                                                                <?php
                                                                //}
                                                            }
                                                            ?>
                                                        </h4>
                                                        <?php
                                                        //echo $row->pickingItemsId;
                                                        $items = common\models\costfit\PickingPointItems::OrderNoChannels($row->pickingItemsId);
                                                        $bagNo = common\models\costfit\PickingPointItems::bagNo($row->pickingItemsId);
                                                        if ($items != '' && $bagNo != '') {
                                                            $BagNos = explode(",", $bagNo);
                                                            //echo '<pre>';
                                                            //print_r($BagNos);
                                                            $orderNos = explode(",", $items);
                                                            ?>
                                                            <div class="list-group search-content">
                                                                <span href="#" class="list-group-item">
                                                                    <?php
                                                                    $itemsOrderNo = common\models\costfit\PickingPointItems::OrderNoList(" $items ");
                                                                    echo 'OrderNo : ' . $itemsOrderNo;
                                                                    ?>
                                                                </span>
                                                                <span href="#" class="list-group-item">
                                                                    <?php
                                                                    for ($index = 0; $index < count($BagNos); $index++) {
                                                                        echo $BagNos[$index] . '<br>';
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    <?php } ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    .clockStyle {
        background-color:#000;
        /*border:#999 2px inset;*/
        padding:6px;
        color:#0FF;
        font-family:"Arial Black", Gadget, sans-serif;
        font-size:16px;
        font-weight:bold;
        letter-spacing: 2px;
        display:inline;
    }
</style>

<script>
    function renderTime() {
        var currentTime = new Date();
        var diem = "AM";
        var h = currentTime.getHours();
        var m = currentTime.getMinutes();
        var s = currentTime.getSeconds();
        setTimeout('renderTime()', 1000);
        if (h == 0) {
            h = 12;
        } else if (h > 12) {
            h = h - 12;
            diem = "PM";
        }
        if (h < 10) {
            h = "0" + h;
        }
        if (m < 10) {
            m = "0" + m;
        }
        if (s < 10) {
            s = "0" + s;
        }
        var myClock = document.getElementById('clockDisplay');
        myClock.textContent = h + ":" + m + ":" + s + " " + diem;
        myClock.innerText = h + ":" + m + ":" + s + " " + diem;
    }
    renderTime();
</script>

