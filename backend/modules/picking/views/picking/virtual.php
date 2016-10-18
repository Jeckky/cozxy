<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
?>
<div class="order-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><h3>Picking Point.</h3></div>
            </div>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin(['method' => 'GET']);
            ?>
            <div class="row">
                <div class="col-lg-9 col-md-9 col-xs-9">
                    <?php
                    echo $form->field($model, 'pickingId')->dropDownList(\yii\helpers\ArrayHelper::map($pickingPoint, "pickingId", 'title', function($model) {
                                return $model->state->localName;
                            }), ['prompt' => '-- Select Picking Point --'])->label('');
                    ?>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-3" style="margin-top: 18px;">
                    <?php
                    echo Html::submitButton('<i class="fa fa-search" aria-hidden="true"> ค้นหา </i>', ['class' => 'btn btn-success']);
                    ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
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
                                                <td style="border:2px black solid ;text-align:center;vertical-align: middle; height: <?= $height ?>" class="<?= ($row->status == 1) ? "alert-success" : "alert-danger" ?>">
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
        </div>
    </div>
</div>