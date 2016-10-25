<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="panel-heading">
    <div class="widget-profile-bg-icon"><i class="fa fa-twitter"></i></div>
    <div class="widget-profile-header">
        <span></span><br>
    </div>
</div> <!-- / .panel-heading -->
<div class="panel-body">
    <?php if ($warning == 'roundone') { //รอบเดียว ?>
        <!-- Info -->
        <div id="uidemo-modals-alerts-info" class="modal modal-alert modal-success fade in" aria-hidden="false" style="display: block; margin-top: 10%;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <div class="modal-title">ปิดช่อง กดปุ่ม Ok</div>
                    <div class="modal-body">กดปุ่ม Ok เพื่อกลับหน้าหลัก..</div>
                    <div class="modal-footer">
                        <a class="btn btn-success" href="close-channel?close=yes&bagNo=<?php echo $bagNo; ?>&model=<?php echo $model; ?>&code=<?php echo $code; ?>&boxcode=<?php echo $boxcode; ?>&pickingItemsId=<?php echo $pickingItemsId; ?>&orderId=<?php echo $orderId; ?>&orderItemPackingId=<?php echo $orderItemPackingId; ?>" >OK</a>
                        <a class="btn btn-success" href="lockers?boxcode=<?php echo $boxcode; ?>" >No</a>
                    </div>
                </div> <!-- / .modal-content -->
            </div> <!-- / .modal-dialog -->
        </div>
        <script language="JavaScript" type="text/javascript">
            //confirm("Do you want to continue ?");
            //var retVal = confirm("ต้องการปิด 'ช่อง' นี้");
            //if (retVal == true) {
            //window.location.href = 'lockers?boxcode=<?php echo $boxcode; ?>';
            //} else {
            //window.location.href = 'lockers?boxcode=<?php echo $boxcode; ?>';
            //}
            //alert("ปิด 'ช่อง' นี้");
        </script>
        <!--
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>ปิดช่องเรียบร้อยแล้ว</strong> กรุณารอสักครู่...&nbsp; <img src="<?php echo Yii::$app->homeUrl; ?>/images/icon/default-loader.gif" height="30" >
        </div>
        -->
        <!--<meta http-equiv="refresh" content="1; url=lockers?boxcode=<?php echo $boxcode; ?>">-->
    <?php } elseif ($warning == 'duplicate') { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>ช่องใน Lockers ไม่ว่าง </strong> กรุณาเปลียนช่องใหม่ ขอบคุณคะ...&nbsp; <img src="<?php echo Yii::$app->homeUrl; ?>/images/icon/default-loader.gif" height="30" >
        </div>
        <meta http-equiv="refresh" content="2; url=lockers?boxcode=<?php echo $boxcode; ?>">
    <?php } elseif ($warning == 'bagerror') { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>ช่องใน Lockers ไม่ถูกต้อง </strong> กรุณาลองใหม่ ขอบคุณคะ...&nbsp; <img src="<?php echo Yii::$app->homeUrl; ?>/images/icon/default-loader.gif" height="30" >
        </div>
        <meta http-equiv="refresh" content="2; url=scan-bag?model=<?php echo $model ?>&code=<?php echo $code; ?>&boxcode=<?php echo $boxcode; ?>&pickingItemsId=<?php echo $pickingItemsId; ?>&orderId=<?php echo $orderId; ?>&orderItemPackingId=<?php echo $orderItemPackingId; ?>&bagNo=<?php echo $bagNo; ?>&c=b">
    <?php } elseif ($warning == 'close') { ?>
        <script language="JavaScript" type="text/javascript">
            //confirm("Do you want to continue ?");
            var retVal = confirm("ต้องการปิด 'ช่อง' นี้");
            if (retVal == true) {
                window.location.href = 'lockers?boxcode=<?php echo $boxcode; ?>';
            } else {
                window.location.href = 'lockers?boxcode=<?php echo $boxcode; ?>';
            }
        </script>
    <?php } ?>
</div>