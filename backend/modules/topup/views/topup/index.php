<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\costfit\User;

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
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="vertical-align: middle;text-align: center;"><h4><b>Upload file .xls,csv : </b></h4></th>
                        <td>
                            <?= \yii\helpers\Html::textInput('fileName', NULL, ['class' => 'input-lg', 'autofocus' => 'autofocus']); ?><?= isset($ms) && $ms != '' ? ' <code> ' . $ms . '</code>' : '' ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
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
                    // 'topUpNo',
                    // 'status',
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
                // 'updateDateTime',
                //  ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>