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
    <?php
    if (isset($alert)) {
        if ($alert == 'false') {
            echo '<script type="text/javascript">alert("มีคนหยิบไปแล้ว กรุณากด Pick(ถ้ามี)")</script>';
        }
    }
    ?>
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
        </div>

        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'method' => 'GET',
                        'action' => ['picking/index'],
            ]);
            foreach ($selects as $select):
                echo '<input type="hidden" name="selection[]" value="' . $select->orderId . '">';
            endforeach;
            //throw new \yii\base\Exception(print_r($selects, true));
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
                        'format' => 'html',
                        'value' => function($model) {
                            return \common\models\costfit\OrderItem::creteStatus($model->orderId);
                        }
                    ]
                ],
            ]);
            ?>
            <?=
            Html::submitButton('หยิบ', ['class' => 'pull-right',
                'style' => 'background-color:#000;color:#ffcc00;border:#000 solid thin;width:90px;height:45px;font-size:12pt;'])
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
