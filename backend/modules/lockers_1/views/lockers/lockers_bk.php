<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = 'ช่องของ Lockers';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<h1>Shippings / Picking Points / เลือกใช้งานตามความต้องการ</h1>
<!--<div class="note note-success ">
    <h3>สถานที่ตั้ง Lockers </h3>
    <h4 style="color: #003147">
        Code Lockers  : <?php echo $listPoint->code; ?>
        ,ที่<?php echo $listPoint->title; ?>
        ,<?php echo $citie->localName; ?>
        ,<?php echo $state->localName; ?>
        ,<?php echo $countrie->localName; ?>
    </h4>

</div>-->
<div class="panel panel-info panel-dark widget-profile ">
    <div class="panel-heading">
        <div class="widget-profile-bg-icon"><i class="fa fa-twitter"></i></div>
        <div class="widget-profile-header">
            <span>สถานที่ตั้งของ Lockers</span><br>
        </div>
    </div> <!-- / .panel-heading -->
    <div class="widget-profile-counters">
        <div class="col-xs-3"><span>ที่ <?php echo $listPoint->title; ?></span></div>
        <div class="col-xs-3"><span><?php echo $citie->localName; ?></span></div>
        <div class="col-xs-3"><span><?php echo $state->localName; ?></span></div>
        <div class="col-xs-3"><span><?php echo $countrie->localName; ?></span></div>
    </div>
    <input type="text" placeholder="Code Lockers  : <?php echo ($listPoint->code != '') ? $listPoint->code : ''; ?>" class="form-control input-lg widget-profile-input">
    <div class="widget-profile-text">
        &nbsp;
    </div>
</div>
<div class="order-index col-md-6">

    <div class="panel panel-warning panel-dark">

        <div class="panel-heading">
            <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> เลือกใช้งานแบบที่ 1 กดปุ่มจาก ช่องของ Lockers</span>
        </div>
        <div class="panel-body ">
            <div class="col-sm-12">
                <div class="form-control" style="border: 0px;"></div>
                <div id="character-limit-input-label" class="limiter-label form-group-margin">&nbsp;&nbsp;</div>
            </div>
        </div>

    </div>
    <div class="panel panel-warning">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">ข้อมูลของแบบที่ 1  ช่องของ Lockers </div>
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
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'pickingItemsId',
                    // 'pickingId',
                    [
                        'attribute' => 'Code Lockers',
                        'value' => function($model) {
                            return $model->pickingPoint->code;
                        }
                    ],
                    //'code',
                    [
                        'attribute' => 'Code Channels',
                        'value' => function($model) {
                            return $model->code;
                        }
                    ],
                    [
                        'attribute' => 'name',
                        'value' => function($model) {
                            return $model->name . ', มีทั้งหมด ' . \common\models\costfit\PickingPointItems::PickingPointDistinctCount($model->pickingItemsId, $model->pickingId) . ' ถุง';
                        }
                    ],
                    /* ['class' => 'yii\grid\ActionColumn'], */
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => ' {items} ',
                        'buttons' => [
                            'items' => function($url, $model) {
                                //echo $model->pickingItemsId . '<br>';
                                //echo \common\models\costfit\PickingPointItems::PickingPointDistinct($model->pickingItemsId);
                                if (\common\models\costfit\PickingPointItems::PickingPointDistinct($model->pickingItemsId) == 1) {
                                    return '<span class="text-danger">Channels เต็มแล้ว</span>';
                                } elseif (\common\models\costfit\PickingPointItems::PickingPointDistinct($model->pickingItemsId) == 0) {
                                    return Html::a('<button class="btn btn-rounded btn-xs text-success"> Channels ว่าง  </button>', Yii::$app->homeUrl . "lockers/lockers/channels?pickingItemsId=" . $model->pickingItemsId . "&code=" . $model->code . '&boxcode=' . $model->pickingId . '&model=1', [
                                                'title' => Yii::t('app', ' Channels ว่าง :' . $model->code),]);
                                }
                                //return '<button class="btn btn-rounded btn-xs"> เปิด Channels นี้ </button>';
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

            <div class="panel panel-info panel-dark">
                <?php
                $form = ActiveForm::begin([
                            'method' => 'GET',
                            'action' => ['/lockers/lockers/channels?boxcode=' . $listPoint->pickingId . '&model=2'],
                ]);
                ?>
                <div class="panel-heading">
                    <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> เลือกใช้งานแบบที่ 2  Scan Qr code จากช่องของ Lockers</span>
                </div>
                <div class="panel-body ">
                    <div class="col-sm-12">
                        <input type="text" name="code" autofocus="true" id="code" class="form-control" placeholder="Search or Scan Qr code">
                        <div id="character-limit-input-label" class="limiter-label form-group-margin">หมายเหตุ : <span class="limiter-count">Scan Qr Code ทุกครั้ง เพื่อตรวจความถูกต้องของ"ช่อง"ใน Lockers.</span></div>
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
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">ข้อมูลของแบบที่ 2 ช่องของ Lockers </div>
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
                            // 'pickingId',
                            [
                                'attribute' => 'Code Lockers',
                                'value' => function($model) {
                                    return $model->pickingPoint->code;
                                }
                            ],
                            //'code',
                            [
                                'attribute' => 'Code Channels',
                                'value' => function($model) {
                                    return $model->code;
                                }
                            ],
                            //name
                            [
                                'attribute' => 'name',
                                'value' => function($model) {
                                    return $model->name . ', มีทั้งหมด ' . \common\models\costfit\PickingPointItems::PickingPointDistinctCount($model->pickingItemsId, $model->pickingId) . ' ถุง';
                                }
                            ],
                            /* ['class' => 'yii\grid\ActionColumn'], */
                            ['class' => 'yii\grid\ActionColumn',
                                'header' => 'Actions',
                                'template' => ' {items} ',
                                'buttons' => [
                                    'items' => function($url, $model) {
                                        //echo $model->pickingItemsId . '<br>';
                                        //echo \common\models\costfit\PickingPointItems::PickingPointDistinct($model->pickingItemsId);
                                        if (\common\models\costfit\PickingPointItems::PickingPointDistinct($model->pickingItemsId) == 1) {
                                            return '<span class="text-danger">Channels เต็มแล้ว</span>';
                                        } elseif (\common\models\costfit\PickingPointItems::PickingPointDistinct($model->pickingItemsId) == 0) {
                                            return '<span class="text-success">Channels ว่าง</span>';
                                        }
                                        //return '<button class="btn btn-rounded btn-xs"> เปิด Channels นี้ </button>';
                                    }
                                ],
                            ],
                        ],
                    ]);
                    ?>


        </div>
    </div>

</div>




