<div class="panel-heading">
    <div class="widget-profile-bg-icon"><i class="fa fa-twitter"></i></div>
    <div class="widget-profile-header">
        <span></span><br>
    </div>
</div> <!-- / .panel-heading -->
<div class="panel-body">
    <?php if ($warning == 'roundone') { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Success</strong> กรุณารอสักครู่...&nbsp; <img src="<?php echo Yii::$app->homeUrl; ?>/images/icon/default-loader.gif" height="30" >
        </div>
        <meta http-equiv="refresh" content="1; url=lockers?boxcode=<?php echo $boxcode; ?>">
    <?php } elseif ($warning == '*duplicate') { ?>
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>duplicate</strong> กรุณารอสักครู่...&nbsp; <img src="<?php echo Yii::$app->homeUrl; ?>/images/icon/default-loader.gif" height="30" >
        </div>
        <meta http-equiv="refresh" content="1; url=lockers?boxcode=<?php echo $boxcode; ?>">
    <?php } ?>
</div>