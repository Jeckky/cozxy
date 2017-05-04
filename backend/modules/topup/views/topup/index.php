<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\costfit\User;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bill payment Top up';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topup-index">
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
        </div>

        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
            ]);
            ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="vertical-align: middle;text-align: center;"><h4><b>Upload file .xls,csv : </b></h4></th>
                        <td>
                            <input class="btn btn-lg btn-warning" type="file" name="fileCsv[csv]" value="Upload" style="float: left;" required="true" disabled="true">
                            <input type="hidden" name="fileCsv[csv]" value="">
                            &nbsp;&nbsp;&nbsp;<button  class="btn btn-lg btn-primary" type="submit" disabled="true">Update</button>
                            <input type="hidden" name="check" value="update">
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php ActiveForm::end(); ?>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                        'attribute' => 'User',
                        'format' => 'raw',
                        'value' => function($model) {
                            return common\models\costfit\Address::userName($model->userId);
                        }
                    ],
                        [
                        'attribute' => 'Point',
                        'format' => 'raw',
                        'value' => function($model) {
                            return $model->point;
                        }
                    ],
                        [
                        'attribute' => 'Money',
                        'format' => 'raw',
                        'value' => function($model) {
                            return number_format($model->money, 2);
                        }
                    ],
                        [
                        'attribute' => 'Date Time',
                        'format' => 'raw',
                        'value' => function($model) {
                            return $this->context->dateThai($model->createDateTime, 2);
                        }
                    ],
                        [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function($model) {
                            return 'กำลังชำระเงิน';
                        }
                    ],
                        [
                        'attribute' => 'Image',
                        'format' => 'raw',
                        'value' => function($model) {
                            $imgLink = '<a href="#"  data-toggle="modal" data-target="#seePic' . $model->topUpId . '">Image</a>';
                            $img = '<img src="' . Yii::$app->homeUrl . $model->image . '">';
                            if (($model->image == '') || ($model->image == null)) {
                                return '<i> No pic.</i>';
                            } else {
                                return $imgLink;
                            }
                        }
                    ],
                        [
                        'attribute' => 'Confirm',
                        'format' => 'raw',
                        'value' => function($model) {
                            $accept = '<a href="' . Yii::$app->homeUrl . 'topup/topup/accept-billpayment?id=' . $model->topUpId . ' "class="btn btn-success" onclick="return ConfirmCheck()">Accept</a>';
                            $notAccept = '<a href="' . Yii::$app->homeUrl . 'topup/topup/not-accept-billpayment?id=' . $model->topUpId . '" class="btn btn-danger" onclick="return ConfirmCheck2()">Not accept</a>';
                            return $accept . ' ' . $notAccept;
                        }
                    ],
                // 'updateDateTime',
                //  ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php
    if (isset($dataChange)) {
        ?>
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;">รายการที่ชำระเงินแล้ว</h3></span>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProviderChange,
                'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                        'attribute' => 'User',
                        'format' => 'raw',
                        'value' => function($model) {
                            return User::userName($model->userId);
                        }
                    ],
                        [
                        'attribute' => 'Point',
                        'format' => 'raw',
                        'value' => function($model) {
                            return $model->point;
                        }
                    ],
                        [
                        'attribute' => 'Money',
                        'format' => 'raw',
                        'value' => function($model) {
                            return number_format($model->money, 2);
                        }
                    ],
                        [
                        'attribute' => 'Date Time',
                        'format' => 'raw',
                        'value' => function($model) {
                            return $this->context->dateThai($model->createDateTime, 2);
                        }
                    ],
                        [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function($model) {

                            return \common\models\costfit\TopUp::statusText($model->status);
                        }
                    ],
                        [
                        'attribute' => 'Image',
                        'format' => 'raw',
                        'value' => function($model) {
                            $img = '<img src="' . Yii::$app->homeUrl . $model->image . '">';
                            return $img;
                        }
                    ],
                // 'updateDateTime',
                //  ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
<?php } ?>
<?php
if (isset($readyData) && count($readyData) > 0) {
    foreach ($readyData as $ready):
        ?>

        <div class="modal fade" id="seePic<?= $ready->topUpId ?>" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i>
                        </button>
                        <h3><?= $ready->topUpNo ?></h3>
                        <h3 class="pull-right" style="margin-top: -30px;"><?= User::userName($ready->userId) ?></h3>
                    </div>
                    <div class="modal-body" style="padding-left: 120px;">
                        <img src="<?= Yii::$app->homeUrl . $ready->image ?>" style="width:300px;height: 400px;">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    <?php endforeach; ?>

<?php }
?>
<script type="text/javascript">
    function ConfirmCheck()
    {
        if (confirm('Are you sure to accept?'))
        {
            return true;
        } else {
            return false;
        }
    }
    function ConfirmCheck2()
    {
        if (confirm('Are you sure to refuse?'))
        {
            return true;
        } else {
            return false;
        }
    }
</script>