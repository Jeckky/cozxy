<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
?>

<?php
$form = ActiveForm::begin(['method' => 'GET']);
?>
<?php
echo $form->field($model, 'pickingId')->dropDownList(\yii\helpers\ArrayHelper::map($pickingPoints, "pickingId", 'title', function($model) {
    return $model->state->localName;
}), ['prompt' => '-- Select Picking Point --']);
?>
<?php ActiveForm::end(); ?>

<?php foreach ($pickingPoints as $point): ?>
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
                    <td>
                        <table class="table">
                            <?php
                            $rows = common\models\costfit\PickingPointItems::find()
                            ->where(["pickingId" => $point->pickingId, 'LEFT(portIndex,1)' => substr($col->portIndex, 0, 1)])
//                            ->groupBy(["RIGHT(portIndex,1)"])
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
                                    <td style="border:2px black solid ;text-align:center;vertical-align: middle; height: <?= $height ?>" class="<?= ($model->status == 1) ? "alert-success" : "alert-success" ?>">
                                        <?php if ($colIndex == 1 && $rowIndex == 1): ?>
                                            <span style="font-size: 20px;font-weight: bold"><?= "Controller" ?></span>
                                        <?php else: ?>
                                            <?= $row->name; ?>
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
<?php endforeach; ?>
