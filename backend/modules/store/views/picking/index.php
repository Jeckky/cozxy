<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Picking List';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="order-index">

    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?//= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Order', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'method' => 'GET',
                        'action' => ['picking/index'],
            ]);
            //throw new Exception(print_r($querys, true));
            foreach ($querys as $query):
                ///echo '<input type="hidden" name="selection[]" value="' . $query . '">';
            endforeach;
            ?>

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
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                    ],
                    ['class' => 'yii\grid\SerialColumn'],
                    'orderNo',
                    [
                        'attribute' => 'countItem',
                        'format' => 'html',
                        'value' => function($model) {
                            $countItemsArray = common\models\costfit\OrderItem::countPickingItemsArray($model->orderId);
                            return $countItemsArray['countItems'] . " รายการ<br>" . $countItemsArray['sumQuantity'] . " ชิ้น";
                        }
                    ],
                    [
                        'attribute' => 'สถานะ',
                        'value' => function($model) {
                            return $model->getStatusText($model->status);
                        }
                    ]
                ],
            ]);
            ?>
            <?= Html::submitButton("Pick", ['class' => 'btn btn-success btn-lg']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
