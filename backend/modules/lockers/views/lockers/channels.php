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
<h1>Shippings / Picking Points </h1>
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
    <div class="widget-profile-text">
        &nbsp;
    </div>
</div>
<div class="order-index col-md-12">
    <div class="panel panel-warning panel-dark">
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> กดปุ่มจาก ช่องของ Lockers</span>
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
                                                        <button class="btn">
                                                            <a href="lockers?boxcode=<?php echo $row->pickingId; ?>" style="font-size: 20px;font-weight: bold"><?= "เปิด Controller" ?></a>
                                                        </button>
                                                    <?php else: ?>
                                                        <?php
                                                        if ($row->status == 0) {
                                                            echo '<h4>ลูกค้ายังไม่มารับ Order</h4>';
                                                        } else {
                                                            ?>
                                                            <h4> ช่อง : <?= $row->name; ?></h4>
                                                            <?php
                                                            //echo $row->pickingItemsId;
                                                            $items = common\models\costfit\PickingPointItems::OrderNoChannels8($row->pickingItemsId);
                                                            $bagNo = common\models\costfit\PickingPointItems::bagNo8($row->pickingItemsId);

                                                            if ($items != '' && $bagNo != '') {
                                                                $BagNos = explode(",", $bagNo);
                                                                $orderNos = explode(",", $items);
                                                                ?>
                                                                <div class="list-group search-content search-content-new-<?php echo $row->pickingItemsId; ?>">
                                                                    <span class="list-group-item" style="color: #000;">
                                                                        <?php
                                                                        $itemsOrderNo = common\models\costfit\PickingPointItems::OrderNoList8(" $items ");
                                                                        if ($itemsOrderNo->status == 8) {
                                                                            echo 'OrderNo : ' . $itemsOrderNo->orderNo . '( ลูกค้ามารับสินค้าแล้ว.)<br><code> ** ok : เรียบร้อย , no : แจ้งปัญหา</code>';
                                                                            echo '<br>';
                                                                            for ($index = 0; $index < count($BagNos); $index++) {
                                                                                echo $BagNos[$index] . '<br>';
                                                                            }
                                                                            echo '<br>';
                                                                            ?>
                                                                            <button class="btn btn-success remark-chanels-ok" data-bind="<?php echo $row->pickingItemsId; ?>"><span class="reset-<?php echo $row->pickingItemsId; ?> ">Ok</span></button>

                                                                            <button class="btn btn-default remark-chanels" data-bind="<?php echo $row->pickingItemsId; ?>">No</button>
                                                                            <br>
                                                                        <?php } ?>
                                                                    </span>
                                                                    <?php if ($itemsOrderNo->status == 8) { ?>
                                                                        <span class="list-group-item remark-chanels-form-<?php echo $row->pickingItemsId; ?>"  style="display: none; text-align: left;">
                                                                            <textarea class="form-control" rows="5" placeholder="แจ้งปัญหา" name="remarkdesc" id="remarkDesc-<?php echo $row->pickingItemsId; ?>"></textarea><br>
                                                                            <input id="pickingItemsIdHidden" type="hidden" value="<?php echo $row->pickingItemsId; ?>">
                                                                            <button class="btn btn-warning btn-xs remark-submit">submit</button>
                                                                            <button class="btn btn-default btn-xs remark-cancel" data-bind="<?php echo $row->pickingItemsId; ?>">cancel</button>
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
                                                                            echo '<h4>' . $itemsOrderNo->remark . '</h4>';
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



