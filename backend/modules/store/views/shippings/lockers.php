<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = 'Qr Code Picking Points List';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<h1>Shippings/Picking Points Items</h1>


<div class="order-index col-md-6">
    <div class="panel">

        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> Scan Qr code Order No :</span>
        </div>
        <div class="panel-body ">
            <div class="col-sm-5">


            </div>
        </div>


    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'pickingItemsId',
                    'pickingId',
                    'code',
                    'name',
                    /* ['class' => 'yii\grid\ActionColumn'], */
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => ' {items} ',
                        'buttons' => [
                            'items' => function($url, $model) {
                                return 'เลือก Lockers นี้';
                            }
                        ],
                    ],
                ],
            ]);
            ?>
        </div>
    </div>

</div>

<div class="order-index col-md-6">
    <div class="panel">
        <?php
        if (\Yii::$app->params['shippingScanTrayOnly'] == true) {
            $form = ActiveForm::begin([
                        'method' => 'POST',
                        'action' => ['shippings/index'],
            ]);
        } else if (\Yii::$app->params['shippingScanTrayOnly'] == False) {
            $form = ActiveForm::begin([
                        'method' => 'POST',
                        'action' => ['shippings/'],
            ]);
        }
        ?>
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> Scan Qr code Order No :</span>
        </div>
        <div class="panel-body ">
            <div class="col-sm-12">
                <input type="text" name="codes" autofocus="true" id="codes" class="form-control" placeholder="Search or Scan Qr code">
                <div id="character-limit-input-label" class="limiter-label form-group-margin">หมายเหตุ : <span class="limiter-count">Scan Qr Code Picking Points ทุกครั้ง เพื่อตรวจความถูกต้องของสถานที่ของตู้.</span></div>
            </div>
        </div>
        <?= $this->registerJS("
                $('#orderNo').blur(function(event){
                    if(event.which == 13 || event.keyCode == 13)
                    {
                       $('#form').submit();
                    }
                });
    ") ?>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'pickingItemsId',
                    'pickingId',
                    'code',
                    'name',
                    /* ['class' => 'yii\grid\ActionColumn'], */
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => ' {items} ',
                        'buttons' => [
                            'items' => function($url, $model) {
                                return 'เลือก Lockers นี้';
                            }
                        ],
                    ],
                ],
            ]);
            ?>
        </div>
    </div>

</div>