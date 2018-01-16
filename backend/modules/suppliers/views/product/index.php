<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<h1>สินค้าของ Partner ทั้งหมด</h1>

<div class="row">
    <?php
    $num = 1;

    foreach ($userSuppliers as $items) {
        if ($items != 'No') {
            ?>
            <div class="col-xs-4">
                <!-- Centered text -->
                <div class="stat-panel text-center">
                    <div class="stat-row">
                        <!-- Dark gray background, small padding, extra small text, semibold text -->
                        <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold text-warning">
                            <?php echo $num++; ?>.Partner&nbsp;::&nbsp;<?php echo $items[0]->attributes['email']; ?>
                        </div>
                    </div> <!-- /.stat-row -->
                    <div class="stat-row">
                        <!-- Bordered, without top border, without horizontal padding -->
                        <div class="stat-cell bordered no-border-t no-padding-hr">
                            <div class="pie-chart" id="easy-pie-chart-1">
                                <div class="col-sm-12" style="padding: 5px; font-weight:bold;">
                                    <?php echo $items[0]->attributes['firstname'] . '&nbsp;' . $items[0]->attributes['lastname']; ?>
                                </div>
                                <div class="col-sm-12" style="padding: 5px;">
                                    จำนวน Product Master&nbsp;
                                    <span class="label label-info ticket-label">
                                        <?php echo common\helpers\Suppliers::GetCountProductMaster(Yii::$app->user->identity->userId); ?>
                                    </span>&nbsp;รายการ
                                </div>
                                <div class="col-sm-12" style="padding: 5px;">
                                    จำนวน My Product&nbsp;
                                    <span class="label label-info ticket-label">
                                        <?php echo common\helpers\Suppliers::GetCountMyProduct(Yii::$app->user->identity->userId); ?>
                                    </span>&nbsp;รายการ
                                </div>
                                <!--<div class="col-sm-12" style="padding: 5px;">
                                    อนุมัติ
                                    <span class="label label-success ticket-label">
                                <?php //echo common\helpers\Suppliers::GetCountProductApprove($items[0]->attributes['userId']); ?>
                                    </span>&nbsp;รายการ
                                </div>
                                <div class="col-sm-12" style="padding: 5px;">
                                    รออนุมัติ <span class="label label-warning ticket-label">
                                <?php //echo common\helpers\Suppliers::GetCountProductWait($items[0]->attributes['userId']); ?>
                                    </span>&nbsp;รายการ
                                </div>-->
                            </div>
                        </div>
                    </div> <!-- /.stat-row -->
                    <ul class="pager">
                        <li class=""><a href="<?php echo Yii::$app->homeUrl; ?>suppliers/product-all?userId=<?php echo $items[0]->attributes['userId']; ?>">ดูทั้งหมด</a></li>
                    </ul>
                </div> <!-- /.stat-panel -->
            </div>
            <?php
        }
    }
    ?>
</div>

<?php
if (Yii::$app->user->identity->userId == 39) {
    ?>
    <h1>สินค้าของ Content ทั้งหมด</h1>

    <div class="row">
        <?php
        $num = 1;
        //foreach ($productCountents as $value) {
        foreach ($productCountents as $key => $value) {
            //echo '<pre>';
            //print_r($value[0]->attributes);
            //exit();
            ?>
            <div class="col-xs-4">
                <!-- Centered text -->
                <div class="stat-panel text-center">
                    <div class="stat-row">
                        <!-- Dark gray background, small padding, extra small text, semibold text -->
                        <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold text-warning">
                            <?php echo $num++; ?>.Contents&nbsp;::&nbsp;<?php echo $value[0]->attributes['email']; ?>
                        </div>

                    </div> <!-- /.stat-row -->
                    <div class="stat-row">
                        <!-- Bordered, without top border, without horizontal padding -->
                        <div class="stat-cell bordered no-border-t no-padding-hr">
                            <div class="pie-chart" id="easy-pie-chart-1">
                                <div class="col-sm-12" style="padding: 5px; font-weight:bold;">
                                    <?php echo $value[0]->attributes['firstname'] . '&nbsp;' . $value[0]->attributes['lastname']; ?>
                                </div>
                                <div class="col-sm-12" style="padding: 5px;">
                                    จำนวน Product Master&nbsp;
                                    <span class="label label-info ticket-label">
                                        <?php echo common\helpers\Suppliers::GetCountProductMaster($value[0]->attributes['userId']); ?>
                                    </span>&nbsp;รายการ
                                </div>
                                <div class="col-sm-12" style="padding: 5px;">
                                    จำนวน My Product&nbsp;
                                    <span class="label label-info ticket-label">
                                        <?php echo common\helpers\Suppliers::GetCountMyProduct($value[0]->attributes['userId']); ?>
                                    </span>&nbsp;รายการ
                                </div>
                                <!--<div class="col-sm-12" style="padding: 5px;">
                                    อนุมัติ
                                    <span class="label label-success ticket-label">
                                <?php //echo common\helpers\Suppliers::GetCountProductApprove($value[0]->attributes['userId']);    ?>
                                    </span>&nbsp;รายการ
                                </div>
                                <div class="col-sm-12" style="padding: 5px;">
                                    รออนุมัติ <span class="label label-warning ticket-label">
                                <?php //echo common\helpers\Suppliers::GetCountProductWait($value[0]->attributes['userId']);    ?>
                                    </span>&nbsp;รายการ
                                </div>-->
                            </div>
                        </div>
                    </div> <!-- /.stat-row -->
                    <ul class="pager">
                        <li class=""><a href="<?php echo Yii::$app->homeUrl; ?>suppliers/product-all?userId=<?php echo $value[0]->attributes['userId']; ?>">ดูทั้งหมด</a></li>
                    </ul>
                </div> <!-- /.stat-panel -->
            </div>
        <?php } ?>
    </div>
<?php } ?>
