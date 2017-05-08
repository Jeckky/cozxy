<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\costfit\User;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'New Purchase Orders';
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
                        'attribute' => 'PO#',
                        'format' => 'raw',
                        'value' => function($model) {
                            return $model->poNo;
                        }
                    ],
                        [
                        'attribute' => 'Supplier',
                        'format' => 'raw',
                        'value' => function($model) {
                            return common\models\costfit\Address::CompanyName($model->supplierId);
                        }
                    ],
                        [
                        'attribute' => 'Summary',
                        'format' => 'raw',
                        'value' => function($model) {
                            return number_format($model->summary, 2);
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
                        'attribute' => 'Bill',
                        'format' => 'raw',
                        'value' => function($model) {

                            return Html::a('รายละเอียด', [Yii::$app->homeUrl . 'topup/topup/bill-pay?epay='], [
                                        'target' => '_blank'
                                            ]
                            );
                        }
                    ],
                // 'updateDateTime',
                //  ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>