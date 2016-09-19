<?php
/* @var $this yii\web\View */
?>

<h1>virtual/index</h1>
<style>
    .text-pink{
        color: #ff99ff;
    }
</style>
<div class="row">
    <?php
    $i = 1;
    foreach ($storeSlots as $row):
        ?>
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">ROW :<?php echo $row->code; ?></span>
                </div>
                <div class="panel-body"  style="padding: 4px;">
                    <table class="table table-bordered">
                        <thead class="bg-dark-gray">
                            <tr>
                                <th>#</th>
                                <?php foreach ($row->cols as $col): ?>
                                    <th><?= $col->code; ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $slots = \common\models\costfit\StoreSlot::getSlotsFromRow($row->storeSlotId);
                            $s = count($slots);
                            foreach ($slots as $slot):
                                ?>
                                <tr>
                                    <th scope="row" class="bg-dark-gray"><?php echo $slot->code; ?></th>
                                    <?php
                                    $c = 1;
                                    foreach ($row->cols as $col):
                                        if ($col->storeSlotId = $slot->parentId):
                                            ?>
                                            <td id="R<?php echo $i; ?>C<?php echo $c; ?>S<?php echo $s; ?>">
                                                <?php
                                                $led = common\models\costfit\Led::find()->where("slot ='" . $row->code . $col->code . $slot->code . "'")->one();
                                                $li = 1;
                                                $tagId = "R" . $i . "C" . $c . "S" . $s . "-" . $li;
                                                if (isset($led)):
                                                    $this->registerJs("
                                                        setTimeout(function(){
                                                            pingHardware('" . $led->ip . "','" . $tagId . "','" . Yii::$app->homeUrl . "store/virtual/ping-hardware" . "')
                                                    }, 3000);")
                                                    ?>
                                                    <?php
                                                    foreach ($led->ledItems as $ledItem):
                                                        ?>
                                                        <i id="<?= $tagId ?>" class="<?= ($ledItem->status == 1) ? "fa fa-circle" : "fa fa-circle-o" ?> <?= $ledItem->getColorText($ledItem->color) ?>" style="zoom: 2;"></i>
                                                        <?php
                                                        $li++;
                                                    endforeach;
                                                    ?>
                                                    <a href="#" class="label label-default">SLOT : R<?php echo $i; ?>C<?php echo $c; ?>S<?php echo $s; ?></a>
                                                    <a href="#" class="label label-tag <?= $tagId ?>">LED : <?= $led->code ?></a>
                                                    <a href="<?= Yii::$app->homeUrl . "store/virtual/remove-led-from-slot?id=" . $led->ledId ?>" class="btn btn-danger btn-xs" title="Remove LED from Slot" onclick="return confirm('คุณต้องการนำ LED <?= $led->code; ?> ออกจาก Slot')"><i class="glyphicon glyphicon-minus"></i></a>
                                                <?php else: ?>
                                                    NOT Set LED
                                                    <a href="#" class="label label-default">SLOT : R<?php echo $i; ?>C<?php echo $c; ?>S<?php echo $s; ?></a>
                                                    <a href="#" class="label label-tag">LED : NOT SET</a>
                                                    <a href="#" onclick="showLedList('R<?php echo $i; ?>C<?php echo $c; ?>S<?php echo $s . "','" . Yii::$app->homeUrl . "store/virtual/select-led" ?>')" class="btn btn-success btn-xs" title="Add LED to Slot"><i class="fa fa-plus"></i></a>
                                                <?php
                                                endif;
                                                ?>

                                            </td>
                                            <?php
                                        endif;
                                        $c++;
                                    endforeach;
                                    ?>
                                </tr>
                                <?php
                                $s--;
                            endforeach;
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
        $i++;
    endforeach;
    ?>
    <div class="divModal">

    </div>
</div>

<div id="cand">
</div>
