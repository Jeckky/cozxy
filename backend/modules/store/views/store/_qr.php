

<h3><?= $model->title; ?><?= (Yii::$app->controller->action->id == "qr") ? yii\helpers\Html::a("<i class='fa fa-print'></i> Print", ['print-qr', 'id' => $model->storeId], ['class' => 'btn btn-primary', 'target' => "_blank"]) : "" ?></h3>

<?php
$slots = common\models\costfit\StoreSlot::find()->where("storeId=" . $model->storeId . " AND level = 3 AND status = 1")->all();
?>

<?php
$i = 1;
?>
<table class="table">
    <?php
    foreach ($slots as $slot):
        ?>
        <?php if ($i == 1): ?>
            <tr>
            <?php endif; ?>
            <td style="border: 2px solid black;text-align: center">
                <?php echo yii\helpers\Html::img("https://chart.googleapis.com/chart?chs=450x450&cht=qr&chl=" . $slot->barcode, ['style' => 'width:200px']); ?>
                <p><?= $slot->barcode; ?></p>
            </td>
            <?php
            $i++;
            if ($i == 6) {
                $i = 1;
                ?>
            </tr>
        <?php } ?>
    <?php endforeach; ?>
</table>