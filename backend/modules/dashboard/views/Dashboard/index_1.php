<?php
/* @var $this yii\web\View */
$this->title = 'Dashboard';
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
?>
<div class="page-header">

    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-dashboard page-header-icon"></i>&nbsp;&nbsp;<?php echo $this->title; ?></h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
                <div class="pull-right col-xs-12 col-sm-auto"></div>

                <!-- Margin -->
                <div class="visible-xs clearfix form-group-margin"></div>

                <!-- Search field -->
                <form action="" class="pull-right col-xs-12 col-sm-6">
                    <div class="input-group no-margin">
                        <span class="input-group-addon" style="border:none;background: #fff;background: rgba(0,0,0,.05);"><i class="fa fa-search"></i></span>
                        <input type="text" placeholder="Search..." class="form-control no-padding-hr" style="border:none;background: #fff;background: rgba(0,0,0,.05);">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- / .page-header -->
<div class="row">
    <div class="col-md-8">

        <!-- 5. $UPLOADS_CHART =============================================================================
        Uploads chart
        -->
        <!-- Javascript -->
        <script>
            init.push(function () {
                var uploads_data = [
<?php foreach ($circulations as $month => $value): ?>
    <?= "{day: $month, v: $value}," ?>
<?php endforeach; ?>
//                {day: '2014-03-10', v: 20},
//                {day: '2014-03-11', v: 10},
//                {day: '2014-03-12', v: 15},
//                {day: '2014-03-13', v: 12},
//                {day: '2014-03-14', v: 5},
//                {day: '2014-03-15', v: 5},
//                {day: '2014-03-16', v: 20}
                ];
                        Morris.Line({
                            element: 'hero-graph',
                            data: uploads_data,
                            xkey: 'day',
                            ykeys: ['v'],
                            labels: ['Value'],
                            lineColors: ['#fff'],
                            lineWidth: 2,
                            pointSize: 4,
                            gridLineColor: 'rgba(255,255,255,.5)',
                            resize: true,
                            gridTextColor: '#fff',
                            xLabels: "day",
                            xLabelFormat: function (d) {
                                return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
                            },
                        });
            });
        </script>
        <!-- / Javascript -->
        <div class="row" style="margin-bottom: 20px">
            <div class="col-lg-2">
                <a href="<?= Yii::$app->homeUrl . "store/virtual" ?>" class="btn btn-lg btn-success text-left" style="font-size: 14px;width: 100%;text-align: left">
                    <p><i class="fa fa-archive" style="font-size:30px;"></i>
                        <span class="pull-right" style="font-size: 14px;font-weight: bold">Virtual Store</span><br>
                        <span class="pull-right" style="text-decoration: underline">View >></span>
                    </p>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="<?= Yii::$app->homeUrl . "picking/picking/virtual" ?>" class="btn btn-lg btn-warning text-left" style="font-size: 14px;width: 100%;text-align: left">
                    <p><i class="fa fa-archive" style="font-size:30px;"></i>
                        <span class="pull-right" style="font-size: 14px;font-weight: bold">Virtual PP</span><br>
                        <!--<span class="pull-right" style="font-size: 7px;font-weight: bold;margin-top: -15px">Picking Point</span><br>-->
                        <span class="pull-right" style="text-decoration: underline">View >></span>
                    </p>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="<?= Yii::$app->homeUrl . "project" ?>" class="btn btn-lg btn-danger text-left" style="font-size: 14px;width: 100%;text-align: left">
                    <p><i class="fa fa-archive" style="font-size:30px;"></i>
                        <span class="pull-right" style="font-size: 16px;font-weight: bold"><?= count(1) ?> โครงการ</span><br>
                        <span class="pull-right" style="text-decoration: underline">View >></span>
                    </p>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="<?= Yii::$app->homeUrl . "project" ?>" class="btn btn-lg btn-info text-left" style="font-size: 14px;width: 100%;text-align: left">
                    <p><i class="fa fa-archive" style="font-size:30px;"></i>
                        <span class="pull-right" style="font-size: 16px;font-weight: bold"><?= count(1) ?> โครงการ</span><br>
                        <span class="pull-right" style="text-decoration: underline">View >></span>
                    </p>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="<?= Yii::$app->homeUrl . "project" ?>" class="btn btn-lg btn-default text-left" style="font-size: 14px;width: 100%;text-align: left">
                    <p><i class="fa fa-archive" style="font-size:30px;"></i>
                        <span class="pull-right" style="font-size: 16px;font-weight: bold"><?= count(1) ?> โครงการ</span><br>
                        <span class="pull-right" style="text-decoration: underline">View >></span>
                    </p>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="<?= Yii::$app->homeUrl . "project" ?>" class="btn btn-lg btn-success text-left" style="font-size: 14px;width: 100%;text-align: left">
                    <p><i class="fa fa-archive" style="font-size:30px;"></i>
                        <span class="pull-right" style="font-size: 16px;font-weight: bold"><?= count(1) ?> โครงการ</span><br>
                        <span class="pull-right" style="text-decoration: underline">View >></span>
                    </p>
                </a>
            </div>
        </div>

        <div class="stat-panel">
            <div class="stat-row">
                <!-- Small horizontal padding, bordered, without right border, top aligned text -->
                <div class="stat-cell col-sm-4 padding-sm-hr bordered no-border-r valign-top">
                    <!-- Small padding, without top padding, extra small horizontal padding -->
                    <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-list text-primary"></i>&nbsp;&nbsp;รายการสั่งซื้อสินค้าวันนี้</h4>
                    <!-- Without margin -->
                    <ul class="list-group no-margin">
                        <!-- Without left and right borders, extra small horizontal padding, without background, no border radius -->
                        <li class="list-group-item no-border-hr padding-xs-hr no-bg no-border-radius">
                            สั่งซื้อ <span class="label label-pa-purple pull-right"><?= $orderToday['all'] ?></span>
                        </li> <!-- / .list-group-item -->
                        <!-- Without left and right borders, extra small horizontal padding, without background -->
                        <li class="list-group-item no-border-hr padding-xs-hr no-bg">
                            รอชำระเงิน <span class="label label-danger pull-right"><?= $orderToday['checkout'] ?></span>
                        </li> <!-- / .list-group-item -->
                        <!-- Without left and right borders, without bottom border, extra small horizontal padding, without background -->
                        <li class="list-group-item no-border-hr no-border-b padding-xs-hr no-bg">
                            กำลังจัดส่ง <span class="label label-inverse pull-right"><?= $orderToday['shipping'] ?></span>
                        </li> <!-- / .list-group-item -->
                        <li class="list-group-item no-border-hr no-border-b padding-xs-hr no-bg">
                            จัดส่งแล้ว <span class="label label-success pull-right"><?= $orderToday['shipped'] ?></span>
                        </li> <!-- / .list-group-item -->
                    </ul>
                </div> <!-- /.stat-cell -->
                <!-- Primary background, small padding, vertically centered text -->
                <div class="stat-cell col-sm-8 bg-primary padding-sm valign-middle">
                    <div id="hero-graph" class="graph" style="height: 230px;"></div>
                </div>
            </div>
        </div> <!-- /.stat-panel -->
        <!-- /5. $UPLOADS_CHART -->

        <!-- 6. $EASY_PIE_CHARTS ===========================================================================
           Easy Pie charts
        -->
        <!-- Javascript -->
        <script>
            init.push(function () {
                // Easy Pie Charts
                var easyPieChartDefaults = {
                    animate: 2000,
                    scaleColor: false,
                    lineWidth: 6,
                    lineCap: 'square',
                    size: 90,
                    trackColor: '#e5e5e5'
                }
                $('#easy-pie-chart-1').easyPieChart($.extend({}, easyPieChartDefaults, {
                    barColor: PixelAdmin.settings.consts.COLORS[1]
                }));
                $('#easy-pie-chart-2').easyPieChart($.extend({}, easyPieChartDefaults, {
                    barColor: PixelAdmin.settings.consts.COLORS[1]
                }));
                $('#easy-pie-chart-3').easyPieChart($.extend({}, easyPieChartDefaults, {
                    barColor: PixelAdmin.settings.consts.COLORS[1]
                }));
            });
        </script>
        <!-- / Javascript -->

        <div class="row">
            <div class="col-xs-4">
                <!-- Centered text -->
                <div class="stat-panel text-center">
                    <div class="stat-row">
                        <!-- Dark gray background, small padding, extra small text, semibold text -->
                        <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
                            <i class="fa fa-globe"></i>&nbsp;&nbsp;BANDWIDTH
                        </div>
                    </div> <!-- /.stat-row -->
                    <div class="stat-row">
                        <!-- Bordered, without top border, without horizontal padding -->
                        <div class="stat-cell bordered no-border-t no-padding-hr">
                            <div class="pie-chart" data-percent="43" id="easy-pie-chart-1">
                                <div class="pie-chart-label">12.3TB</div>
                            </div>
                        </div>
                    </div> <!-- /.stat-row -->
                </div> <!-- /.stat-panel -->
            </div>
            <div class="col-xs-4">
                <div class="stat-panel text-center">
                    <div class="stat-row">
                        <!-- Dark gray background, small padding, extra small text, semibold text -->
                        <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
                            <i class="fa fa-flash"></i>&nbsp;&nbsp;PICK LOAD
                        </div>
                    </div> <!-- /.stat-row -->
                    <div class="stat-row">
                        <!-- Bordered, without top border, without horizontal padding -->
                        <div class="stat-cell bordered no-border-t no-padding-hr">
                            <div class="pie-chart" data-percent="93" id="easy-pie-chart-2">
                                <div class="pie-chart-label">93%</div>
                            </div>
                        </div>
                    </div> <!-- /.stat-row -->
                </div> <!-- /.stat-panel -->
            </div>
            <div class="col-xs-4">
                <div class="stat-panel text-center">
                    <div class="stat-row">
                        <!-- Dark gray background, small padding, extra small text, semibold text -->
                        <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
                            <i class="fa fa-cloud"></i>&nbsp;&nbsp;USED RAM
                        </div>
                    </div> <!-- /.stat-row -->
                    <div class="stat-row">
                        <!-- Bordered, without top border, without horizontal padding -->
                        <div class="stat-cell bordered no-border-t no-padding-hr">
                            <div class="pie-chart" data-percent="75" id="easy-pie-chart-3">
                                <div class="pie-chart-label">12GB <?//= memory_get_peak_usage() / 1000000000; ?></div>
                            </div>
                        </div>
                    </div> <!-- /.stat-row -->
                </div> <!-- /.stat-panel -->
            </div>
        </div>
    </div>
    <!-- /6. $EASY_PIE_CHARTS -->

    <div class="col-md-4">
        <div class="row">
            <!-- 7. $EARNED_TODAY_STAT_PANEL ===================================================================
                   Earned today stat panel
            -->
            <div class="col-sm-4 col-md-12">
                <div class="stat-panel">
                    <!-- Danger background, vertically centered text -->
                    <div class="stat-cell bg-danger valign-middle">
                        <!-- Stat panel bg icon -->
                        <i class="fa fa-trophy bg-icon"></i>
                        <!-- Extra large text -->
                        <span class="text-xlg"><span class="text-lg text-slim">฿</span> <strong><?= ($todaySummary > 0) ? $todaySummary : 0 ?></strong></span><br>
                        <!-- Big text -->
                        <span class="text-bg">Earned today</span><br>
                        <!-- Small text -->
                        <span class="text-sm"><a href="#">See details in your profile</a></span>
                    </div> <!-- /.stat-cell -->
                </div> <!-- /.stat-panel -->
            </div>
            <!-- /7. $EARNED_TODAY_STAT_PANEL -->

            <!-- 8. $RETWEETS_GRAPH_STAT_PANEL =================================================================
               Retweets graph stat panel
            -->
            <div class="col-sm-4 col-md-12">
                <!-- Javascript -->
                <script>
                    init.push(function () {
                        $("#stats-sparklines-3").pixelSparkline([275, 490, 397, 487, 339, 403, 402, 312, 300], {
                            type: 'line',
                            width: '100%',
                            height: '45px',
                            fillColor: '',
                            lineColor: '#fff',
                            lineWidth: 2,
                            spotColor: '#ffffff',
                            minSpotColor: '#ffffff',
                            maxSpotColor: '#ffffff',
                            highlightSpotColor: '#ffffff',
                            highlightLineColor: '#ffffff',
                            spotRadius: 4,
                            highlightLineColor: '#ffffff'
                        });
                    });
                </script>
                <!-- / Javascript -->

                <div class="stat-panel">
                    <div class="stat-row">
                        <!-- Purple background, small padding -->
                        <div class="stat-cell bg-pa-purple padding-sm">
                            <!-- Extra small text -->
                            <div class="text-xs" style="margin-bottom: 5px;">RETWEETS GRAPH</div>
                            <div class="stats-sparklines" id="stats-sparklines-3" style="width: 100%"></div>
                        </div>
                    </div> <!-- /.stat-row -->
                    <div class="stat-row">
                        <!-- Bordered, without top border, horizontally centered text -->
                        <div class="stat-counters bordered no-border-t text-center">
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>312</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs text-muted">TWEETS</span>
                            </div>
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>1000</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs text-muted">FOLLOWERS</span>
                            </div>
                            <!-- Small padding, without horizontal padding -->
                            <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                                <!-- Big text -->
                                <span class="text-bg"><strong>523</strong></span><br>
                                <!-- Extra small text -->
                                <span class="text-xs text-muted">FOLLOWING</span>
                            </div>
                        </div> <!-- /.stat-counters -->
                    </div> <!-- /.stat-row -->
                </div> <!-- /.stat-panel -->
            </div>
            <!-- /8. $RETWEETS_GRAPH_STAT_PANEL -->

            <!-- 9. $UNIQUE_VISITORS_STAT_PANEL ================================================================
                  Unique visitors stat panel
            -->
            <div class="col-sm-4 col-md-12">
                <!-- Javascript -->
                <script>
                    init.push(function () {
                        $("#stats-sparklines-2").pixelSparkline(
                                [275, 490, 397, 487, 339, 403, 402, 312, 300, 294, 411, 367, 319, 416, 355, 416, 371, 479, 279, 361, 312, 269, 402, 327, 474, 422, 375, 283, 384, 372], {
                            type: 'bar',
                            height: '36px',
                            width: '100%',
                            barSpacing: 2,
                            zeroAxis: false,
                            barColor: '#ffffff'
                        });
                    });
                </script>
                <!-- / Javascript -->

                <div class="stat-panel">
                    <div class="stat-row">
                        <!-- Warning background -->
                        <div class="stat-cell bg-warning">
                            <!-- Big text -->
                            <span class="text-bg">11% more</span><br>
                            <!-- Small text -->
                            <span class="text-sm">Unique visitors today</span>
                        </div>
                    </div> <!-- /.stat-row -->
                    <div class="stat-row">
                        <!-- Warning background, small padding, without top padding, horizontally centered text -->
                        <div class="stat-cell bg-warning padding-sm no-padding-t text-center">
                            <div id="stats-sparklines-2" class="stats-sparklines" style="width: 100%"></div>
                        </div>
                    </div> <!-- /.stat-row -->
                </div> <!-- /.stat-panel -->
            </div>
        </div>
    </div>
</div>
<!-- /9. $UNIQUE_VISITORS_STAT_PANEL -->

<!-- Page wide horizontal line -->
<hr class="no-grid-gutter-h grid-gutter-margin-b no-margin-t">

<div class="row">

    <!-- 10. $SUPPORT_TICKETS ==========================================================================
              Support tickets
    -->
    <!-- Javascript -->
    <script>
        init.push(function () {
            $('#dashboard-support-tickets .panel-body > div').slimScroll({height: 300, alwaysVisible: true, color: '#888', allowPageScroll: true});
        })
    </script>
    <!-- / Javascript -->

    <div class="col-md-6">
        <div class="panel panel-success widget-support-tickets" id="dashboard-support-tickets">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i>Latest Buy</span>
                <div class="panel-heading-controls">
                    <div class="panel-heading-text"><a href="#">15 new tickets</a></div>
                </div>
            </div> <!-- / .panel-heading -->
            <div class="panel-body tab-content-padding">
                <!-- Panel padding, without vertical padding -->
                <div class="panel-padding no-padding-vr">

                    <div class="ticket">
                        <span class="label label-success ticket-label">Completed</span>
                        <a href="#" title="" class="ticket-title">Server unavaible<span>[#201798]</span></a>
                        <span class="ticket-info">
                            Opened by <a href="#" title="">Timothy Owens</a> today
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-warning ticket-label">Pending</span>
                        <a href="#" title="" class="ticket-title">Mobile App Problem<span>[#201797]</span></a>
                        <span class="ticket-info">
                            Opened by <a href="#">Denise Steiner</a> 2 days ago
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-info ticket-label">In progress</span>
                        <a href="#" title="" class="ticket-title">
                            <i class="fa fa-warning text-danger"></i>PayPal issue<span>[#201796]</span>
                        </a>
                        <span class="ticket-info">
                            Opened by <a href="#">Robert Jang</a> 3 days ago
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-danger ticket-label">Rejected</span>
                        <a href="#" title="" class="ticket-title">IE8 problem<span>[#201795]</span></a>
                        <span class="ticket-info">
                            Opened by <a href="#">Robert Jang</a> 4 days ago
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-success ticket-label">Completed</span>
                        <a href="#" title="" class="ticket-title">Server unavaible<span>[#201794]</span></a>
                        <span class="ticket-info">
                            Opened by <a href="#">Timothy Owens</a> 5 days ago
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-success ticket-label">Completed</span>
                        <a href="#" title="" class="ticket-title">Server unavaible<span>[#201798]</span></a>
                        <span class="ticket-info">
                            Opened by <a href="#" title="">Timothy Owens</a> today
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-warning ticket-label">Pending</span>
                        <a href="#" title="" class="ticket-title">Mobile App Problem<span>[#201797]</span></a>
                        <span class="ticket-info">
                            Opened by <a href="#">Denise Steiner</a> 2 days ago
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-info ticket-label">In progress</span>
                        <a href="#" title="" class="ticket-title">
                            <i class="fa fa-warning text-danger"></i>PayPal issue<span>[#201796]</span>
                        </a>
                        <span class="ticket-info">
                            Opened by <a href="#">Robert Jang</a> 3 days ago
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-danger ticket-label">Rejected</span>
                        <a href="#" title="" class="ticket-title">IE8 problem<span>[#201795]</span></a>
                        <span class="ticket-info">
                            Opened by <a href="#">Robert Jang</a> 4 days ago
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-success ticket-label">Completed</span>
                        <a href="#" title="" class="ticket-title">Server unavaible<span>[#201794]</span></a>
                        <span class="ticket-info">
                            Opened by <a href="#">Timothy Owens</a> 5 days ago
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-success ticket-label">Completed</span>
                        <a href="#" title="" class="ticket-title">Server unavaible<span>[#201798]</span></a>
                        <span class="ticket-info">
                            Opened by <a href="#" title="">Timothy Owens</a> today
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-warning ticket-label">Pending</span>
                        <a href="#" title="" class="ticket-title">Mobile App Problem<span>[#201797]</span></a>
                        <span class="ticket-info">
                            Opened by <a href="#">Denise Steiner</a> 2 days ago
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-info ticket-label">In progress</span>
                        <a href="#" title="" class="ticket-title">
                            <i class="fa fa-warning text-danger"></i>PayPal issue<span>[#201796]</span>
                        </a>
                        <span class="ticket-info">
                            Opened by <a href="#">Robert Jang</a> 3 days ago
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-danger ticket-label">Rejected</span>
                        <a href="#" title="" class="ticket-title">IE8 problem<span>[#201795]</span></a>
                        <span class="ticket-info">
                            Opened by <a href="#">Robert Jang</a> 4 days ago
                        </span>
                    </div> <!-- / .ticket -->

                    <div class="ticket">
                        <span class="label label-success ticket-label">Completed</span>
                        <a href="#" title="" class="ticket-title">Server unavaible<span>[#201794]</span></a>
                        <span class="ticket-info">
                            Opened by <a href="#">Timothy Owens</a> 5 days ago
                        </span>
                    </div> <!-- / .ticket -->
                </div>
            </div> <!-- / .panel-body -->
        </div> <!-- / .panel -->
    </div>
    <!-- /10. $SUPPORT_TICKETS -->

    <!-- 11. $RECENT_ACTIVITY ==========================================================================
          Recent activity
    -->
    <!-- Javascript -->
    <script>
        init.push(function () {
            $('#dashboard-recent .panel-body > div').slimScroll({height: 300, alwaysVisible: true, color: '#888', allowPageScroll: true});
        })
    </script>
    <!-- / Javascript -->

    <div class="col-md-6">

        <div class="panel panel-dark panel-light-green">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-smile-o"></i>New users</span>
                <div class="panel-heading-controls">
                    <ul class="pagination pagination-xs">
                        <li><a href="#">«</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul> <!-- / .pagination -->
                </div> <!-- / .panel-heading-controls -->
            </div> <!-- / .panel-heading -->
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>E-mail</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="valign-middle">
                    <tr>
                        <td>1</td>
                        <td>
                            <img src="<?php echo $directoryAsset; ?>/demo/avatars/2.jpg" alt="" style="width:26px;height:26px;" class="rounded">&nbsp;&nbsp;<a href="#" title="">@rjang</a>
                        </td>
                        <td>Robert Jang</td>
                        <td>rjang@example.com</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            <img src="<?php echo $directoryAsset; ?>/demo/avatars/3.jpg" alt="" style="width:26px;height:26px;" class="rounded">&nbsp;&nbsp;<a href="#" title="">@mbortz</a>
                        </td>
                        <td>Michelle Bortz</td>
                        <td>mbortz@example.com</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            <img src="<?php echo $directoryAsset; ?>/demo/avatars/4.jpg" alt="" style="width:26px;height:26px;" class="rounded">&nbsp;&nbsp;<a href="#" title="">@towens</a>
                        </td>
                        <td>Timothy Owens</td>
                        <td>towens@example.com</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>
                            <img src="<?php echo $directoryAsset; ?>/demo/avatars/5.jpg" alt="" style="width:26px;height:26px;" class="rounded">&nbsp;&nbsp;<a href="#" title="">@dsteiner</a>
                        </td>
                        <td>Denise Steiner</td>
                        <td>dsteiner@example.com</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>
                            <img src="<?php echo $directoryAsset; ?>/demo/avatars/2.jpg" alt="" style="width:26px;height:26px;" class="rounded">&nbsp;&nbsp;<a href="#" title="">@rjang</a>
                        </td>
                        <td>Robert Jang</td>
                        <td>rjang@example.com</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>
                            <img src="<?php echo $directoryAsset; ?>/demo/avatars/3.jpg" alt="" style="width:26px;height:26px;" class="rounded">&nbsp;&nbsp;<a href="#" title="">@mbortz</a>
                        </td>
                        <td>Michelle Bortz</td>
                        <td>mbortz@example.com</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>
                            <img src="<?php echo $directoryAsset; ?>/demo/avatars/4.jpg" alt="" style="width:26px;height:26px;" class="rounded">&nbsp;&nbsp;<a href="#" title="">@towens</a>
                        </td>
                        <td>Timothy Owens</td>
                        <td>towens@example.com</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div> <!-- / .panel -->

    </div>
    <!-- /11. $RECENT_ACTIVITY -->
</div>

<!-- Page wide horizontal line -->
<hr class="no-grid-gutter-h grid-gutter-margin-b no-margin-t">

<div class="row">

    <div class="col-md-5">
        <!-- Javascript -->
        <script>
            init.push(function () {
                $('.widget-tasks .panel-body').pixelTasks().sortable({
                    axis: "y",
                    handle: ".task-sort-icon",
                    stop: function (event, ui) {
                        // IE doesn't register the blur when sorting
                        // so trigger focusout handlers to remove .ui-state-focus
                        ui.item.children(".task-sort-icon").triggerHandler("focusout");
                    }
                });
                $('#clear-completed-tasks').click(function () {
                    $('.widget-tasks .panel-body').pixelTasks('clearCompletedTasks');
                });
            });
        </script>
        <!-- / Javascript -->

    </div>
    <!-- /13. $RECENT_TASKS -->

</div>
