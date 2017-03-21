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
<h1>Lockers and Booth (ปลายทางจุดรับสินค้า)</h1>

<div class="panel   panel-success">
    <?php
    $form = ActiveForm::begin([
        'method' => 'POST',
        'action' => ['lockers/index'],
    ]);
    ?>
    <div class="panel-heading ">
        <span class="panel-title"><i class="fa fa-qrcode" aria-hidden="true"></i> Scan Qr Lockers : สแกน QR Code ของล็อกเกอร์</span>
    </div>
    <div class="panel-body ">
        <div class="col-sm-12">
            <input type="text" name="codes" autofocus="true" id="codes" class="form-control" placeholder="Search or Scan Qr code">
            <div id="character-limit-input-label" class="limiter-label form-group-margin">หมายเหตุ : <span class="limiter-count">สแกน QR Code ของล็อกเกอร์ทุกครั้ง เพื่อตรวจความถูกต้องของสถานที่ของตู้.</span></div>
        </div>
    </div>
    <?= $this->registerJS("
                $('#codes').blur(function(event){
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
                    <strong>Code Picking Points :</strong> <?php echo $txt; ?>.&nbsp; <img src="<?php echo Yii::$app->homeUrl; ?>/images/icon/default-loader.gif" height="30" >
                </div>
                <meta http-equiv="refresh" content="1; url=channels?boxcode=<?php echo $data; ?>">
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