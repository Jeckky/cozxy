<?php
/* @var $this yii\web\View */
?>
<div class="row">
    <div class="col-md-12">

        <!-- 13. $NOTIFICATIONS ======    Notifications -->
        <div class="panel widget-notifications">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-fire"></i>Notifications</span>
            </div> <!-- / .panel-heading -->
            <div class="panel-body padding-sm">
                <div class="notifications-list">

                    <div class="notification">
                        <div class="notification-title text-danger">SYSTEM COZXY</div>

                        <?php
                        if (isset($this->params['listDataProviderNotificationsSuppliers']['menuNotificationsSuppliers'])) {
                            $menuNotificationsSuppliers = $this->params['listDataProviderNotificationsSuppliers']['menuNotificationsSuppliers'];
                            foreach ($menuNotificationsSuppliers as $key => $value) {
                                ?>
                                <div class="notification-description"><strong>หัวข้ออนุมัติสินค้า</strong>: <?php echo $value->title; ?> (<strong class="notification-systme">ดู</strong>)</div>
                                <div class="notification-ago"><?php echo common\helpers\CozxyUnity::TimeElapsedString($value->createDateTime); ?></div>
                                <!--<div class="notification-icon fa fa-hdd-o bg-danger"></div>-->
                                <?php
                            }
                        }
                        ?>

                    </div> <!-- / .notification -->




                </div>
                <a href="#" class="notifications-link">MORE NOTIFICATIONS</a>
            </div> <!-- / .panel-body -->
        </div> <!-- / .panel -->
        <!-- /13. $NOTIFICATIONS -->


    </div>
</div>
