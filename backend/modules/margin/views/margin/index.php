<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
?>



<div class="panel-heading">
    <span class="panel-title"><?= $title ?></span>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-8">
            <?php
            $form = ActiveForm::begin([
                'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-7">{input}</div>',
                    'labelOptions' => [
                        'class' => 'col-sm-3 control-label'
                    ]
                ]
            ]);
            ?>
            <?= $form->errorSummary($systemMargin) ?>

            <h1 class="col-lg-offset-3" style="color:blue;font-weight: bold">The System Margin of <?= isset($systemMargin->percent) ? " <span class='label label-success' style='font-weight: bold'>$systemMargin->percent</span>" : "<span class='label label-danger'>Not Set</span>" ?></h1>
            <hr>
            <?= $form->field($systemMargin, 'percent', ['options' => ['class' => 'row form-group ']])->textInput(['maxlength' => 13])->label('Update System Margin (%)') ?>
            <div class="col-lg-offset-3 ">
                <span class="label label-warning"><?= isset($systemMargin->createDateTime) ? "วันที่แก้ไขล่าสุด " . $this->context->dateThai($systemMargin->createDateTime, 2, true) : "วันที่แก้ไขล่าสุด -"; ?></span>
            </div><br>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <?= Html::submitButton($systemMargin->isNewRecord ? 'Create' : 'Update', ['class' => $systemMargin->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1" style="font-weight: bold;text-decoration: underline">History <span class="badge badge-danger"> << Cick for see History Margin</span></a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                            <?php
                            $historys = \common\models\costfit\Margin::find()->where("brandId is NULL AND categoryId is NULL AND supplierId is NULL")->orderBy("createDateTime DESC")->all();
                            ?>
                            <table class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th>Seq</th>
                                        <th>Percent</th>
                                        <th>Create Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($historys) > 0):
                                        $seq = 1;
                                        foreach ($historys as $his):
                                            if ($his->marginId == $systemMargin->marginId) {
                                                continue;
                                            }
                                            ?>
                                            <tr>
                                                <td><?= $seq; ?></td>
                                                <td><?= $his->percent; ?></td>
                                                <td><?= $this->context->dateThai($his->createDateTime, 2, TRUE); ?></td>
                                            </tr>
                                            <?php
                                            $seq++;
                                        endforeach;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="3" style="text-align: center;color:red">
                                                --No have history--
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <span class="panel-title">Other Margin</span>
                </h4>
            </div>
            <div id="collapse1" class="panel-body">
                <?php
                $historys = \common\models\costfit\Margin::find()->where("brandId is NULL AND categoryId is NULL AND supplierId is NULL")->orderBy("createDateTime DESC")->all();
                ?>
                <table class="table table-bordered table-hover ">
                    <thead>
                        <tr>
                            <th>Seq</th>
                            <th>Percent</th>
                            <th>Create Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($historys) > 0):
                            $seq = 1;
                            foreach ($historys as $his):
                                if ($his->marginId == $systemMargin->marginId) {
                                    continue;
                                }
                                ?>
                                <tr>
                                    <td><?= $seq; ?></td>
                                    <td><?= $his->percent; ?></td>
                                    <td><?= $this->context->dateThai($his->createDateTime, 2, TRUE); ?></td>
                                </tr>
                                <?php
                                $seq++;
                            endforeach;
                        else:
                            ?>
                            <tr>
                                <td colspan="3" style="text-align: center;color:red">
                                    --No have history--
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
</div>

