<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment Methods';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="payment-method-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Payment Method', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'image',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::img(Yii::$app->homeUrl . $model->image, ['style' => 'width:150px']);
                        }
                    ],
                    'title',
                    'description:ntext',
                    'type',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete} {ePayment} {bankTransfer}',
                        'buttons' => [
                            'ePayment' => function($url, $model) {
                                if ($model->type == 2)
                                    return Html::a('<br><u>e Payment</u>', ['/payment/e-payment', 'paymentMethodId' => $model->paymentMethodId], [
                                        'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },
                            'bankTransfer' => function($url, $model) {
                                if ($model->type == 1)
                                    return Html::a('<br><u>Bank Transfer</u>', ['/payment/bank-transfer', 'paymentMethodId' => $model->paymentMethodId], [
                                        'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
