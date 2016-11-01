<?php
/* @var $this yii\web\View */
?>
<h1>settings/index</h1>
<div id="content-wrapper">
    <div class="page-header">
        <h1><i class="fa fa-th-large page-header-icon"></i>&nbsp;&nbsp;Widgets</h1>
    </div> <!-- / .page-header -->

    <div class="row">
        <div class="col-md-4">
            <!-- 5. $PROFILE_WIDGET_LINKS_EXAMPLE =====  Profile widget - Links example -->
            <div class="panel panel-success panel-dark widget-profile">
                <div class="panel-heading">
                    <div class="widget-profile-bg-icon"><i class="fa fa-flask"></i></div>
                    <div class="widget-profile-header">
                        <span>ตั้งค่าเมนู</span><br>
                    </div>
                </div> <!-- / .panel-heading -->
                <div class="list-group">
                    <a href="<?php echo Yii::$app->homeUrl; ?>management/level" class="list-group-item"><i class="fa fa-tasks list-group-icon"></i>เพิ่ม level</a>
                    <a href="<?php echo Yii::$app->homeUrl; ?>management/menu" class="list-group-item"><i class="fa fa-tasks list-group-icon"></i>เพิ่มเมนู</a>
                </div>
            </div> <!-- / .panel -->
            <!-- /5. $PROFILE_WIDGET_LINKS_EXAMPLE -->

        </div>
        <div class="col-md-4">
            <!-- 6. $PROFILE_WIDGET_COUNTERS_EXAMPLE ==   Profile widget - Counters example  -->
            <div class="panel panel-info panel-dark widget-profile">
                <div class="panel-heading">
                    <div class="widget-profile-bg-icon"><i class="fa fa-twitter"></i></div>
                    <div class="widget-profile-header">
                        <span>ตั้งค่า</span><br>
                    </div>
                </div> <!-- / .panel-heading -->
                <div class="widget-profile-counters">
                    <div class="col-xs-4"><span>131</span><br>TWEETS</div>
                    <div class="col-xs-4"><span>230</span><br>FOLLOWERS</div>
                    <div class="col-xs-4"><span>56</span><br>FOLLOWING</div>
                </div>
                <input type="text" placeholder="Write your tweet" class="form-control input-lg widget-profile-input">
                <div class="widget-profile-text">
                    Lorem ipsum dolor sit amet
                </div>
            </div> <!-- / .panel -->
            <!-- /6. $PROFILE_WIDGET_COUNTERS_EXAMPLE -->
        </div>

    </div> <!-- / .row -->
</div> <!-- / #content-wrapper -->