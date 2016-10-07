<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lockers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <?php
    $form = ActiveForm::begin([
                'method' => 'GET',
                'action' => ['lockers/bagno-lockers'],
    ]);
    ?>
    <div class="panel-heading">
        <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> Scan Qr code lockers No :</span>
    </div>
    <div class="panel-body ">
        <div class="col-sm-5">
            <input type="text" name="lockers" autofocus="true" id="lockers" class="form-control" placeholder="Search or Scan Qr code">
            <input type="hidden" id="bagNo" name="bagNo" value="<?php echo $bagNo; ?>">
           <div id="character-limit-input-label" class="limiter-label form-group-margin"><!--Characters left: <span class="limiter-count">20</span>--></div>
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
<div class="picking-point-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6"><?= $this->title ?></div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <?//= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Picking Point', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                </div>
            </div>
        </div>
    </div>
   <!--<p>
    <?//= Html::a('Create Picking Point', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <div class="panel-body">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'orderItemPackingId',
                //'orderItemId',
                'pickingItemsId',
                'bagNo',
                'quantity',
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        if ($model->status == 5) {
                            $txt = 'กำลังจัดส่ง';
                        } else if ($model->status == 7) {
                            $txt = 'นำจ่าย';
                        }
                        return isset($txt) ? $txt : ''; // status items 6 : แพ็คใส่ถุงแล้ว
                    }
                ],
            // 'createDateTime',
            // 'updateDateTime',
            /* ['class' => 'yii\grid\ActionColumn'], */
            /* ['class' => 'yii\grid\ActionColumn',
              'header' => 'Actions',
              'template' => ' ',
              'buttons' => [],
              ], */
            ],
        ]);
        ?>
    </div>

</div>
