<?php
/* @var $this yii\web\View */
?>

<h1>virtual/index</h1>
<div class="row">
    <?php
    $s = 1;
    for ($i = 1; $i <= 10; $i++) {
        ?>
        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Row <?php echo $i; ?></span>
                </div>
                <div class="panel-body"  style="padding: 4px;">
                    <table class="table table-bordered">
                        <thead class="bg-dark-gray">
                            <tr>
                                <th>#</th>
                                <th>C1</th>
                                <th>C2</th>
                                <th>C3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $s = 1;
                            for ($y = 0; $y < 5; $y++) {
                                ?>
                                <tr>
                                    <th scope="row" class="bg-dark-gray">S<?php echo $s; ?></th>
                                    <td>
                                        <i class="fa fa-circle text-danger" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <a href="#" class="label label-tag">R<?php echo $i; ?>C<?php echo '1'; ?>S<?php echo $s; ?></a>
                                    </td>
                                    <td>
                                        <i class="fa fa-circle text-danger" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <a href="#" class="label label-tag">R<?php echo $i; ?>C<?php echo '2'; ?>S<?php echo $s; ?></a>
                                    </td>
                                    <td>
                                        <i class="fa fa-circle text-danger" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <a href="#" class="label label-tag">R<?php echo $i; ?>C<?php echo '3'; ?>S<?php echo $s; ?></a>
                                    </td>
                                </tr>
                                <?php
                                $s = ++$s;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Row <?php echo $i; ?></span>
                </div>
                <div class="panel-body" style="padding: 4px;">
                    <table class="table table-bordered">
                        <thead class="bg-dark-gray">
                            <tr>
                                <th>#</th>
                                <th>C4</th>
                                <th>C5</th>
                                <th>C6</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $s1 = 1;
                            for ($x = $y; $x < 10; $x++) {
                                ?>
                                <tr>
                                    <th scope="row" class="bg-dark-gray">S<?php echo $s1; ?></th>
                                    <td>
                                        <i class="fa fa-circle text-danger" style="zoom: 2;"></i>
                                        <i class="fa fa-circle text-success"  style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary"  style="zoom: 2;"></i>
                                        <i class="fa fa-circle text-warning"  style="zoom: 2;"></i>
                                        <i class="fa fa-circle text-primary"  style="zoom: 2;"></i>
                                        <a href="#" class="label label-tag">R<?php echo $i; ?>C<?php echo '4'; ?>S<?php echo $s1; ?></a>
                                    </td>
                                    <td>
                                        <i class="fa fa-circle text-danger" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary"  style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary"  style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary"  style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary"  style="zoom: 2;"></i>
                                        <a href="#" class="label label-tag">R<?php echo $i; ?>C<?php echo '5'; ?>S<?php echo $s1; ?></a>
                                    </td>
                                    <td>
                                        <i class="fa fa-circle text-danger" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <i class="fa fa-circle-o text-primary" style="zoom: 2;"></i>
                                        <a href="#" class="label label-tag">R<?php echo $i; ?>C<?php echo '6'; ?>S<?php echo $s1; ?></a>
                                    </td>
                                </tr>
                                <?php
                                $s1 = ++$s1;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>