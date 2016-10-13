<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = 'แสดงข้อมูลของถึงทั้งหมดในถาดนี้';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
if (isset($listPointItems)) {
    ?>
    <h1>Shippings / Picking Points Items / เลือก  <?php echo $listPointItems->code; ?></h1>
    <?php if ($listPointItems == '1') { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Oh snap!</strong> Change a few things up and try submitting again.
        </div>
    <?php } else { ?>
        <div class="panel panel-info panel-dark widget-profile">
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
            <input type="text" placeholder="Code Lockers  : <?php echo $listPoint->code; ?>" class="form-control input-lg widget-profile-input">
            <div class="widget-profile-text">
                Code Channels : <?php echo $listPointItems->code; ?>
            </div>
        </div>
        <div class="order-index col-md-12">
            <div class="panel colourable">

                <?php
                $form = ActiveForm::begin([
                            'method' => 'GET',
                            'action' => ['scan-bag?model=' . $model . '&code=' . $channel . '&boxcode=' . $listPoint->pickingId . '&pickingItemsId=' . $pickingItemsId . '&orderId=' . $orderId . '&orderItemPackingId=' . $orderItemPackingId],
                ]);
                ?>
                <div class="panel-heading">
                    <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> Scan Qr Code <?php echo isset($bagNo) ? 'ช่องล็อคเกอร์.' : 'ถุงใส่ช่องล็อคเกอร์.' ?></span>

                </div>

                <div class="panel-body ">
                    <div class="col-sm-12">
                        <?php if ($bagNo != '') { ?>
                            <input type="text" name="channels" autofocus="true" id="channels" class="form-control" placeholder="Search or Scan Qr code">
                            <div id="character-limit-input-label" class="limiter-label form-group-margin">หมายเหตุ :
                                <span class="limiter-count">
                                    <?php
                                    if (isset($c)) {
                                        echo '<span class="text-danger">ไม่พบ Scan Qr Code Channels. ลองใหม่อีกครั้ง</span>';
                                    } else {
                                        echo 'Scan Qr Code Channels.';
                                    }
                                    ?>
                                </span>
                            </div>
                        <?php } else { ?>
                            <input type="text" name="bagNo" autofocus="true" id="bagNo" class="form-control" placeholder="Search or Scan Qr code">
                            <div id="character-limit-input-label" class="limiter-label form-group-margin">
                                หมายเหตุ : <span class="limiter-count">
                                    <?php
                                    if (isset($c)) {
                                        echo '<span class="text-danger">ไม่พบ Scan Qr Code bag No. ลองใหม่อีกครั้ง</span>';
                                    } else {
                                        echo 'Scan Qr Code bag No.';
                                    }
                                    ?></span>
                            </div>
                        <?php } ?>

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
            <div class="panel-body">
                <a href="lockers?boxcode=<?php echo $boxcode; ?>" class="btn btn-primary btn-rounded">ต้องการเปลียนช่องของ Lockers</a>
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
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'orderItemPackingId',
                            'pickingItemsId',
                            'orderItemId',
                            'bagNo',
                            //'orderNo',
                            //'bagNo',
                            //'status',
                            [
                                'attribute' => 'status',
                                'value' => function($model) {
                                    if ($model->status == 4) {
                                        $txt = ' ปิดถุงแล้ว';
                                    } else if ($model->status == 5) {
                                        $txt = 'กำลังจะใส่ในช่อง';
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
        <?php
    }
} else {
    ?> <h1>Shippings / Picking Points Items / </h1>
    <div class="panel-body">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>ไม่พบข้อมูล</strong> ชื่อช่องนี้ ลองใหม่อีกครั้ง...&nbsp; <img src="<?php echo Yii::$app->homeUrl; ?>/images/icon/default-loader.gif" height="30" >
        </div>
        <!--<meta http-equiv="refresh" content="1; url=lockers?boxcode=<?php //echo $pickingId;                                                                                         ?>">-->
    </div>
    <?php
}
?>