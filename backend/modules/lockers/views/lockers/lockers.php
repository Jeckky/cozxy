<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = 'ช่องของ Lockers';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<h1><?php echo $typePickingPoint->name; ?> / แสดงช่องของ <?php echo $typePickingPoint->name; ?> ทั้งหมด </h1>
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
            <span>สถานที่ตั้งของ <?php echo $typePickingPoint->name; ?></span><br>
        </div>
    </div> <!-- / .panel-heading -->
    <div class="widget-profile-counters">
        <div class="col-xs-3"><span>ที่ <?php echo $listPoint->title; ?></span></div>
        <div class="col-xs-3"><span><?php echo $citie->localName; ?></span></div>
        <div class="col-xs-3"><span><?php echo $state->localName; ?></span></div>
        <div class="col-xs-3"><span><?php echo $countrie->localName; ?></span></div>
    </div>
    <input type="text" placeholder="Code <?php echo $typePickingPoint->name; ?>  : <?php echo ($listPoint->code != '') ? $listPoint->code : ''; ?>" class="form-control input-lg widget-profile-input">
    <div class="widget-profile-text text-center" style="font-size: 16px;">
        <?php echo $this->context->dateThai(date("Y-m-d"), 1, TRUE); ?> เวลา <div id="clockDisplay" class="clockStyle"></div>
    </div>
</div>
<div class="order-index col-md-12">
    <div class="panel panel-warning panel-dark">
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> กดปุ่มจาก ช่องของ <?php echo $typePickingPoint->name; ?></span>
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
                                                <td style="border:2px black solid ;text-align:center;vertical-align: middle; height: <?= $height ?>
                                                    ; background-color: <?php
                                                    if ($row->status == 1) {
                                                        echo $PickingPoints['color_lid'];
                                                    } else { //echo $PickingPoints['frame']
                                                        echo '#D24136';
                                                    }
                                                    ?>">
                                                        <?php
                                                        $Inspector = common\models\costfit\OrderItemPacking::checkInspector($row->pickingItemsId);
                                                        //echo $colIndex . '::';
                                                        //echo $rowIndex;
                                                        if ($colIndex == 2 && $rowIndex == 1): // if ($colIndex == 1 && $rowIndex == 1):
                                                            ?>
                                                        <p style="font-size: 20px;font-weight: bold; padding: 20px; background-color: <?php echo $PickingPoints['color_lid']; ?>;"><?= "Controller" ?></p>
                                                    <?php else: ?><h4>
                                                            <?php
                                                            if ($row->status == 0) {
                                                                echo 'ปิดช่องนี้แล้ว..';
                                                            } else {
                                                                if ($Inspector['status'] == 10) {
                                                                    echo '<span class="label label-danger">ช่อง' . $row->name . ' : มีปัญหา <br>รายละอียด : ' . $Inspector['remark'] . '</span>';
                                                                    // echo '<br>';
                                                                    /// echo '<small>ใส่ตู้ไป :' . $Inspector['DateOfPut'] . ' วันที่แล้ว';
                                                                    // echo '<br>';
                                                                    // echo 'ลูดค้ามารับไป :' . $Inspector['DateOfReceive'] . ' วันที่แล้ว</small>';
                                                                } else if ($Inspector['status'] < 8 || $Inspector['status'] == 9) {
                                                                    ?>
                                                                    <a class="btn btn-lg   btn-info" href="<?php echo Yii::$app->homeUrl; ?>lockers/lockers/scan-bag?pickingItemsId=<?php echo $row->pickingItemsId; ?>&code=<?php echo $row->code ?>&boxcode=<?php echo $row->pickingId; ?>&model=1">เปิดช่อง : <?= $row->name; ?></a>
                                                                    <?php
                                                                } else if ($Inspector['status'] == 8) {
                                                                    echo '<span class="label label-warning">ช่อง' . $row->name . ' :รอตรวจสอบจากเจ้าหน้าที่</span>';
                                                                    // echo '<br>';
                                                                    // echo '<small>ใส่ตู้ไป :' . $Inspector['DateOfPut'] . ' วันที่แล้ว';
                                                                    // echo '<br>';
                                                                    // echo 'ลูดค้ามารับไป :' . $Inspector['DateOfReceive'] . ' วันที่แล้ว</small>';
                                                                }
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
                                                    <?php endif; ?>

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

