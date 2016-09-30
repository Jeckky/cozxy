<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bag No List';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>

<div class="panel">
    <?php
    if (\Yii::$app->params['shippingScanTrayOnly'] == true) {
        $form = ActiveForm::begin([
                    'method' => 'GET',
                    'action' => ['shipping/index'],
        ]);
    } else if (\Yii::$app->params['shippingScanTrayOnly'] == False) {
        $form = ActiveForm::begin([
                    'method' => 'GET',
                    'action' => ['shipping/scanbag'],
        ]);
    }
    ?>
    <div class="panel-heading">
        <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> Scan Qr Code Bag No :</span>
    </div>
    <div class="panel-body">
        <div class="col-sm-5">
            <input type="text" name="bagNo" autofocus="true" id="bagNo" class="form-control" placeholder="Search or Scan Qr code">
            <input type="hidden" id="orderNo" name="orderNo" value="<?php echo $orderNo; ?>">
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

<div class="order-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?>  </div>
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
                    'bagNo',
                    'orderItemId',
                    //'orderNo',
                    //'bagNo',
                    //'status',
                    [
                        'attribute' => 'status',
                        'value' => function($model) {
                            if ($model->status == 4) {
                                $txt = ' ปิดถุงแล้ว';
                            } else if ($model->status == 5) {
                                $txt = 'กำลังจัดส่ง';
                            }
                            return isset($txt) ? $txt : ''; // status items 6 : แพ็คใส่ถุงแล้ว
                        }
                    ],
                    //'pickingId',
                    /* [
                      'attribute' => 'pickingId',
                      'value' => function($model) {
                      return 'จุดรับของที่' . $model->pickingpoint->title . ' , ' . $model->pickingpoint->citie->localName . ' , ' . $model->pickingpoint->state->localName . ' , ' . 'ประเทศ' . $model->pickingpoint->countrie->localName; // status items 6 : แพ็คใส่ถุงแล้ว
                      }
                      ], */
                    // 'type',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '  ',
                        'buttons' => [
                        /* 'items' => function($url, $model) {
                          return Html::a('รอ Picking Points ', Yii::$app->homeUrl . "picking/picking/index?pickingId=" . $model->pickingId, [
                          'title' => Yii::t('app', 'picking point'),]);
                          } */
                        ],
                    ],
                ],
            ]);
            ?>
        </div>
    </div>

</div>