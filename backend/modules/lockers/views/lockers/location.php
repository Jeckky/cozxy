<div class="panel-heading">
    <div class="widget-profile-bg-icon"><i class="fa fa-twitter"></i></div>
    <div class="widget-profile-header">
        <span></span><br>
    </div>
</div> <!-- / .panel-heading -->
<div class="panel-body">
    <?php if ($warning == 'roundone') { //รอบเดียว ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>ปิดช่องเรียบร้อยแล้ว</strong> กรุณารอสักครู่...&nbsp; <img src="<?php echo Yii::$app->homeUrl; ?>/images/icon/default-loader.gif" height="30" >
        </div>
        <meta http-equiv="refresh" content="1; url=lockers?boxcode=<?php echo $boxcode; ?>">
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
    <?php } ?>
</div>