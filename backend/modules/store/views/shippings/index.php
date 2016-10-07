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
<h1>Shippings/Picking Points</h1>

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
        <div class="col-sm-5">
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
<div class="order-index">
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
            <?php if ($codes == 'true') { ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert"> </button>
                    <strong>Code Picking Points :</strong> <?php echo $txt; ?>.
                </div>
                <meta http-equiv="refresh" content="1; url=lockers?boxcode=<?php echo $data; ?>">
            <?php } elseif ($codes == 'false') { ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert"> </button>
                    <strong>Code Picking Points :</strong> <?php echo $txt; ?>.
                </div>
                <!--<meta http-equiv="refresh" content="1; url=index">-->
            <?php } elseif ($codes == 'no') { ?>
                <div class="alert">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong>Code Picking Points :</strong> <?php echo $txt; ?>.
                </div>
            <?php } ?>

        </div>
    </div>

</div>