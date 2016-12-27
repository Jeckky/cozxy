<?php
/* @var $this yii\web\View */
?>
<h1>สินค้าของ Suppliers ทั้งหมด/index</h1>

<div class="row">
    <?php
    $num = 1;
    foreach ($userSuppliers as $value) {
        ?>
        <div class="col-xs-4">
            <!-- Centered text -->
            <div class="stat-panel text-center">
                <div class="stat-row">
                    <!-- Dark gray background, small padding, extra small text, semibold text -->
                    <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
                        <?php echo $num++; ?>.Suppliers&nbsp;::&nbsp;<?php echo $value->email; ?>
                    </div>
                </div> <!-- /.stat-row -->
                <div class="stat-row">
                    <!-- Bordered, without top border, without horizontal padding -->
                    <div class="stat-cell bordered no-border-t no-padding-hr">
                        <div class="pie-chart" id="easy-pie-chart-1">
                            <div class="col-sm-12" style="padding: 5px;">
                                จำนวนสินค้าทั้งหมด&nbsp;
                                <span class="label label-info ticket-label">
                                    <?php echo common\helpers\Suppliers::GetCountProduct($value->userId); ?>
                                </span>&nbsp;รายการ
                            </div>
                            <div class="col-sm-12" style="padding: 5px;">
                                รออนุมัติ
                                <span class="label label-success ticket-label">
                                    <?php echo common\helpers\Suppliers::GetCountProductApprove($value->userId); ?>
                                </span>&nbsp;รายการ
                            </div>
                            <div class="col-sm-12" style="padding: 5px;">
                                อนุมัติ <span class="label label-warning ticket-label">
                                    <?php echo common\helpers\Suppliers::GetCountProductWait($value->userId); ?>
                                </span>&nbsp;รายการ
                            </div>
                        </div>
                    </div>
                </div> <!-- /.stat-row -->
                <ul class="pager">
                    <li class=""><a href="<?php echo Yii::$app->homeUrl; ?>/suppliers/product-all?userId=<?php echo $value->userId; ?>">ดูทั้งหมด</a></li>
                </ul>
            </div> <!-- /.stat-panel -->
        </div>
    <?php } ?>
</div>
