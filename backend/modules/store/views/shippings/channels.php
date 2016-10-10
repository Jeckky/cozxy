<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = 'แสดงข้อมูลของ Order No.';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<h1>Shippings / Picking Points Items / Channels <?php echo $listPointItems->code; ?></h1>
<div class="panel panel-info panel-dark widget-profile">
    <div class="panel-heading">
        <div class="widget-profile-bg-icon"><i class="fa fa-twitter"></i></div>
        <div class="widget-profile-header">
            <span>สถานที่ตั้งของ Lockers</span><br>
        </div>
    </div> <!-- / .panel-heading -->
    <div class="widget-profile-counters">
        <div class="col-xs-3"><span><?php echo $listPoint->title; ?></span></div>
        <div class="col-xs-3"><span><?php echo $citie->localName; ?></span></div>
        <div class="col-xs-3"><span><?php echo $state->localName; ?></span></div>
        <div class="col-xs-3"><span><?php echo $countrie->localName; ?></span></div>
    </div>
    <input type="text" placeholder="Code Lockers  : <?php echo $listPoint->code; ?>" class="form-control input-lg widget-profile-input">
    <div class="widget-profile-text">
        Code Channels : <?php echo $listPointItems->code; ?>
    </div>
</div>
<div class="order-index col-md-12">
    <div class="panel colourable">
        <?php
        $form = ActiveForm::begin([
                    'method' => 'POST',
                    'action' => ['shippings/order'],
        ]);
        ?>
        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i>  Scan Qr code Order No. :</span>
        </div>
        <div class="panel-body ">
            <div class="col-sm-12">
                <input type="text" name="code" autofocus="true" id="code" class="form-control" placeholder="Search or Scan Qr code">
                <div id="character-limit-input-label" class="limiter-label form-group-margin">หมายเหตุ : <span class="limiter-count">Scan Qr Code Order No.</span></div>
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
    <div class="panel colourable">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        &nbsp;<span class="limiter-count">&nbsp;</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'rowOptions' => function($model) {
                    if ($model->status == 14) {
                        return ['class' => 'warning'];
                    } else if ($model->status == 15) {
                        return ['class' => 'success'];
                    }
                },
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'orderId',
                            //'orderItemId',
                            //'orderNo',
                            [
                                'attribute' => 'orderNo',
                                'value' => function($model) {
                                    //if ($model->status == 6) {
                                    //$txt = 'แพ็คใส่ถุงแล้ว';
                                    //} else if ($model->status == 14) {
                                    //$txt = 'กำลังจะส่ง';
                                    //}
                                    //return $model->orderNo . ' ,มี' . count($model->orderItemId) . 'รายการ';
                                    return $model->orderNo . ', มี ' . \common\models\costfit\Order::CountOrderItems($model->orderId) . ' รายการ';
                                }
                            ],
                            //'bagNo',
                            //'status',
                            [
                                'attribute' => 'status',
                                'value' => function($model) {
                                    if ($model->status == 6) {
                                        $txt = 'แพ็คใส่ถุงแล้ว';
                                    } else if ($model->status == 14) {
                                        $txt = 'กำลังจะส่ง';
                                    } else if ($model->status == 15) {
                                        $txt = 'สินค้ายังอยู่ใน lockers';
                                    } else if ($model->status == 13) {
                                        $txt = 'แพ็คเสร็จแล้ว';
                                    }
                                    return isset($txt) ? $txt : ''; // status items 6 : แพ็คใส่ถุงแล้ว
                                }
                            ],
                            [
                                'attribute' => 'จำนวน bagNo',
                                'value' => function($model) {
                                    return 'นำจ่ายอีก ' . \common\models\costfit\OrderItemPacking::shipPacking($model->orderItemId) . "  ถุง";
                                }
                            ],
                            //'pickingId',
                            [
                                'attribute' => 'pickingId',
                                'value' => function($model) {
                                    $name = isset($model->pickingpointitems->name) ? $model->pickingpointitems->name : '';
                                    $code = isset($model->pickingpointitems->code) ? $model->pickingpointitems->code : '';
                                    $title = isset($model->pickingpoint->title) ? $model->pickingpoint->title : '';
                                    $localNamecitie = isset($model->pickingpoint->citie->localName) ? $model->pickingpoint->citie->localName : '';
                                    $localNamestate = isset($model->pickingpoint->state->localName) ? $model->pickingpoint->state->localName : '';
                                    $localNamecountrie = isset($model->pickingpoint->countrie->localName) ? $model->pickingpoint->countrie->localName : '';

                                    return ' สถานที่ส่งของ : ' . $title . ' , ' . $localNamecitie . ' , ' . $localNamestate . ' , ' . 'ประเทศ' . $localNamecountrie . ' '; // status items 6 : แพ็คใส่ถุงแล้ว
                                }
                            ],
                            // 'type',
                            // 'createDateTime',
                            // 'updateDateTime',
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => ' {items} ',
                                'buttons' => [
                                    'items' => function($url, $model) {
                                        if (\common\models\costfit\OrderItemPacking::shipPacking($model->orderItemId) > 0) {
                                            return Html::a('นำใส่ lockers', Yii::$app->homeUrl . "store/lockers/index?orderId=" . $model->orderId, [
                                                        'title' => Yii::t('app', 'picking point'),]);
                                        } else {
                                            return Html::a('<i class="fa fa-eye"></i> ', Yii::$app->homeUrl . "store/lockers/index?orderId=" . $model->orderId, [
                                                        'title' => Yii::t('app', 'picking point'),]);
                                        }
                                    }
                                        ],
                                    ],
                                ],
                            ]);
                            ?>
        </div>
    </div>

</div>
