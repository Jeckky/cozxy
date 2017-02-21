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
<h1>Lockers /  ตรวจสอบช่องที่ลูกค้ารับสินค้าแล้ว /</h1>
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
            <span>สถานที่ตั้งของ Lockers</span><br>
        </div>
    </div> <!-- / .panel-heading -->
    <div class="widget-profile-counters">
        <div class="col-xs-3"><span>ที่ <?php echo $listPoint->title; ?></span></div>
        <div class="col-xs-3"><span><?php echo $citie->localName; ?></span></div>
        <div class="col-xs-3"><span><?php echo $state->localName; ?></span></div>
        <div class="col-xs-3"><span><?php echo $countrie->localName; ?></span></div>
    </div>
    <input type="text" placeholder="Code Lockers  : <?php echo ($listPoint->code != '') ? $listPoint->code : ''; ?>" class="form-control input-lg widget-profile-input">
    <div class="widget-profile-text text-center" style="font-size: 16px;">
        <?php echo $this->context->dateThai(date("Y-m-d"), 1, TRUE); ?> เวลา <div id="clockDisplay" class="clockStyle"></div>
    </div>
</div>
<div class="order-index col-md-12">
    <div class="panel panel-warning panel-dark">
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> แสดงช่องทั้งหมดของ Lockers นี้</span>
        </div>
        <div class="panel-body ">
            <div class="col-sm-12">
                <h3><?= $point->title; ?></h3>
                <table class="table table-bordered">
                    <tbody>
                        <?php
                        $cols = common\models\costfit\PickingPointItems::find()
                        ->where(["pickingId" => $point->pickingId])
                        ->groupBy(["LEFT(portIndex,1)"])
                        ->all();
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
                                                <td style="border:2px black solid ;text-align:center;vertical-align: middle; height: <?= $height ?>" class="<?= ($row->status == 1) ? "alert-success" : "alert-danger" ?>">
                                                    <?php if ($colIndex == 1 && $rowIndex == 1): ?>
                                                        <span style="font-size: 20px;font-weight: bold"><?= "Controller" ?></span>
                                                    <?php else: ?>
                                                        <?php
                                                        $Inspector = common\models\costfit\OrderItemPacking::checkInspector($row->pickingItemsId);

                                                        if ($row->status == 0) {
                                                            echo '<h4>ช่อง : ' . $row->name . '<br> ลูกค้ายังไม่มารับสินค้า</h4>';
                                                        } else {
                                                            ?>
                                                            <h4><strong> ช่อง : <?= $row->name; ?> ว่าง</strong></h4>
                                                            <?php
                                                            $items = common\models\costfit\PickingPointItems::OrderNoChannels8($row->pickingItemsId);
                                                            $bagNo = common\models\costfit\PickingPointItems::bagNo8($row->pickingItemsId);
                                                            if ($items != '' && $bagNo != '') {
                                                                //$BagNos = explode(",", $bagNo);
                                                                $orderNos = explode(",", $items);
                                                                $itemsOrderNo = common\models\costfit\PickingPointItems::OrderNoList8(" $items ");
                                                                if ($itemsOrderNo->remark) {
                                                                    $bgWarning = 'note note-danger';
                                                                } else {
                                                                    $bgWarning = '';
                                                                }
                                                                ?>
                                                                <div class="list-group search-content search-content-new-<?php echo $row->pickingItemsId; ?> <?php echo $bgWarning; ?>">
                                                                    <span class="list-group-item" style="color: #000;">
                                                                        <?php
                                                                        //$itemsOrderNo = common\models\costfit\PickingPointItems::OrderNoList8(" $items ");
                                                                        $icon_new = '<img src="' . Yii::$app->homeUrl . '/images/icon/1148820182.gif" alt=" " alt="Cost Fit" broder ="0" class="img-responsive"/>';
                                                                        if ($itemsOrderNo->status == 8 || $itemsOrderNo->status == 10) {
                                                                            if ($itemsOrderNo->status == 8) {
                                                                                echo '<p class="text-right">' . $icon_new . '<p>';
                                                                            }
                                                                            echo '<h5><strong>OrderNo : </strong>' . $itemsOrderNo->orderNo . '</h5><span class="text-success"> '
                                                                            . '(ลูกค้ามารับสินค้าแล้ว) </span><br> <span class="text-warning">เมื่อ ' .
                                                                            $this->context->dateThai($itemsOrderNo->updateDateTime, 1, '0000-00-00 00:00:00') . '</span>'
                                                                            . '<br> ถุงที่หยิบไป : ';
                                                                            echo $bagNo;
                                                                            echo '<hr>';
                                                                            ?>

                                                                            <button class="btn btn-success remark-chanels-ok" data-bind="<?php echo $row->pickingItemsId; ?>,<?php echo $row->pickingId; ?>,<?php echo $itemsOrderNo->orderItemPackingId; ?>">
                                                                                <span class="reset-<?php echo $row->pickingItemsId; ?> ">Ok</span></button>
                                                                            <button class="btn btn-default remark-chanels" data-bind="<?php echo $row->pickingItemsId; ?>,<?php echo $row->pickingId; ?>,<?php echo $itemsOrderNo->orderItemPackingId; ?>">No</button>
                                                                            <div class="form-group text-left text-muted">
                                                                                อธิบาย<br> ปุ่ม Ok : กดปุ่มกรณีช่องเรียบร้อยเท่านั่น , ปุ่ม No : กดแจ้งปัญหาทุกกรณี
                                                                            </div> <!-- / .form-group -->
                                                                        <?php } ?>

                                                                    </span>

                                                                    <?php
                                                                    if ($itemsOrderNo->status == 8 || $itemsOrderNo->status == 10) {
                                                                        // isset($itemsOrderNo->remark) ? 'แจ้เงตือนอีกครั้ง' : 'submit'
                                                                        ?>
                                                                        <span class="list-group-item remark-chanels-form-<?php echo $row->pickingItemsId; ?> <?php
                                                                        if ($itemsOrderNo->status == 10) {
                                                                            echo 'show';
                                                                        }
                                                                        ?>"  style="display: none; text-align: left;">
                                                                            <div class="form-group text-left">
                                                                                <label class="col-sm-2 control-label">เลือก</label>
                                                                                <div class="col-sm-10">
                                                                                    <div class="radio">
                                                                                        <label>
                                                                                            <input type="radio" name="type-<?php echo $row->pickingItemsId; ?>" id="type-<?php echo $row->pickingItemsId; ?>" value="1" class="px" <?php
                                                                                            if ($itemsOrderNo->type == 1) {
                                                                                                echo 'checked';
                                                                                            }
                                                                                            ?>>
                                                                                            <span class="lbl">กรณีช่องมีปัญหา</span>
                                                                                        </label>
                                                                                    </div> <!-- / .radio -->
                                                                                    <div class="radio">
                                                                                        <label>
                                                                                            <input type="radio" name="type-<?php echo $row->pickingItemsId; ?>" id="type-<?php echo $row->pickingItemsId; ?>" value="2" class="px" <?php
                                                                                            if ($itemsOrderNo->type == 2) {
                                                                                                echo 'checked';
                                                                                            }
                                                                                            ?>>
                                                                                            <span class="lbl">กรณีลูกค้าไม่มารับสินค้า</span>
                                                                                        </label>
                                                                                    </div> <!-- / .radio -->
                                                                                </div> <!-- / .col-sm-10 -->
                                                                            </div> <!-- / .form-group -->
                                                                            <?php
                                                                            if ($itemsOrderNo->status == 10) {
                                                                                //echo $itemsOrderNo->orderItemPackingId;
                                                                                $orderItemPackingItems = \common\models\costfit\OrderItemPackingItems::find()->where('orderItemPackingId=' . $itemsOrderNo->orderItemPackingId . ' and pickingItemsId =' . $row->pickingItemsId)->all();
                                                                                //echo 'count ::' . count($orderItemPackingItems);
                                                                                echo '<div id="test-test" class="text-left col-sm-5 test-test"  data-bind="' . $row->pickingItemsId . ',' . $row->pickingId . ',' . $itemsOrderNo->orderItemPackingId . '" style="cursor: hand;">มีปัญหา<code>' . count($orderItemPackingItems) . '</code>ครั้ง (ดูเพิ่มเติม)</div>';
                                                                            }
                                                                            if ($itemsOrderNo->status != 8) {
                                                                                echo isset($itemsOrderNo->lastvisitDate) ? ' <div  class="text-right col-sm-7 ">ล่าสุด:' . $this->context->dateThai($itemsOrderNo->lastvisitDate, 1, TRUE) . '</div>' : '&nbsp;วันที่แจ้งปัญหา : 0000-00-00 00:00:00';
                                                                                //echo '<hr>';
                                                                            }
                                                                            if ($itemsOrderNo->status == 10) {
                                                                                echo '<div class="text-left col-sm-12" >&nbsp;</div>';
                                                                            }
                                                                            //echo '<div class="text-left col-sm-5"  data-toggle="modal" data-target="#uidemo-modals-alerts-info" data-bind="' . $row->pickingItemsId . ',' . $row->pickingId . ',' . $itemsOrderNo->orderItemPackingId . '" style="cursor: hand;">(ดูเพิ่มเติม)</div>';
                                                                            ?>
                                                                            <textarea class="form-control" rows="5" placeholder="แจ้งปัญหา" name="remarkDesc-<?php echo $row->pickingItemsId; ?>" id="remarkDesc-<?php echo $row->pickingItemsId; ?>" ><?= $itemsOrderNo->remark; ?></textarea><br>
                                                                            <input id="pickingItemsIdHidden" type="hidden" value="<?php echo $row->pickingItemsId; ?>">
                                                                            <input id="pickingIdHidden" type="hidden" value="<?php echo $row->pickingId; ?>">
                                                                            <button class="btn btn-warning btn-xs remark-submit" data-bind="<?php echo $row->pickingItemsId; ?>,<?php echo $row->pickingId; ?>,<?php echo $itemsOrderNo->orderItemPackingId; ?>"><?php echo isset($itemsOrderNo->remark) ? 'แจ้งเตือนอีกครั้ง' : 'submit' ?></button>
                                                                            <button class="btn btn-default btn-xs remark-cancel" data-bind="<?php echo $row->pickingItemsId; ?>,<?php echo $row->pickingId; ?>,<?php echo $itemsOrderNo->orderItemPackingId; ?>">cancel</button>
                                                                        </span>
                                                                    <?php } elseif ($itemsOrderNo->status == 9) { ?>
                                                                        <span class="list-group-item remark-chanels-form-<?php echo $row->pickingItemsId; ?>"  style="  text-align: center;">
                                                                            <?php
                                                                            echo '<h4>ตรวจสอบเรียบร้อย</h4>';
                                                                            ?>
                                                                        </span>
                                                                    <?php } elseif ($itemsOrderNo->status == 10) { ?>
                                                                        <span class="list-group-item remark-chanels-form-<?php echo $row->pickingItemsId; ?>"  style="  text-align: center;">
                                                                            <?php
                                                                            echo '<h4><code>' . $itemsOrderNo->remark . '</code></h4>';
                                                                            ?>
                                                                        </span>
                                                                    <?php } else { ?>

                                                                    <?php } ?>
                                                                </div>
                                                                <?php
                                                            }
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
<?php $this->registerJs("

", \yii\web\View::POS_END); ?>

<div id="uidemo-modals-alerts-info" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <!--<div id="uidemo-modals-alerts-info" class="modal modal-alert modal-info fade">-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                รายงานแจ้งปัญหา.
            </div>
            <div class="modal-body col-md-12 text-left" style="font-size: 12px; white-space: wrap;">
                <div class="tes-test col-md-12 text-left"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->

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