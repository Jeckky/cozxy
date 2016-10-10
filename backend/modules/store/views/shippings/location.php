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