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
                <div class="panel-body">
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
                                    <td>R<?php echo $i; ?>C<?php echo '1'; ?>S<?php echo $s; ?> <span class="badge badge-primary">1</span></td>
                                    <td>R<?php echo $i; ?>C<?php echo '2'; ?>S<?php echo $s; ?> <span class="badge badge-primary">1</span></td>
                                    <td>R<?php echo $i; ?>C<?php echo '3'; ?>S<?php echo $s; ?> <span class="badge badge-primary">1</span></td>
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
                <div class="panel-body">
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
                            $s1 = 1;
                            for ($x = 0; $x < 5; $x++) {
                                ?>
                                <tr>
                                    <th scope="row" class="bg-dark-gray">S<?php echo $s1; ?></th>
                                    <td>R<?php echo $i; ?>C<?php echo '1'; ?>S<?php echo $s1; ?> <span class="badge badge-primary">1</span></td>
                                    <td>R<?php echo $i; ?>C<?php echo '2'; ?>S<?php echo $s1; ?> <span class="badge badge-primary">1</span></td>
                                    <td>R<?php echo $i; ?>C<?php echo '3'; ?>S<?php echo $s1; ?> <span class="badge badge-primary">1</span></td>
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