<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\costfit\User;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Bill payment Top up';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topup-index">
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
        </div>

        <div class="panel-body">

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
                        'attribute' => 'Cozxy coins',
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
                        'attribute' => 'Payment Type',
                        'format' => 'raw',
                        'value' => function($model) {
                            if ($model->paymentMethod == 1) {
                                return 'Bill payment';
                            } else {
                                return 'Credit card';
                            }
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
                        'attribute' => 'Bill',
                        'format' => 'raw',
                        'value' => function($model) {
                            if ($model->status == \common\models\costfit\TopUp::TOPUP_STATUS_E_PAYMENT_SUCCESS) {
                                return Html::a('สำเนาใบเสร็จ', [Yii::$app->homeUrl . 'topup/topup/bill-pay?epay=' . $model->topUpId], [
                                            'target' => '_blank'
                                                ]
                                );
                            }
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
                            <h3 class="pull-right" style="margin-top: -30px;"><?= common\models\costfit\Address::userName($ready->userId) ?></h3>
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
