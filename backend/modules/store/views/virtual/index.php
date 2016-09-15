<?php
/* @var $this yii\web\View */
?>
<h1>virtual/index</h1>
<div class="row">
    <?php for ($i = 1; $i <= 10; $i++) { ?>
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
                            <tr>
                                <th scope="row" class="bg-dark-gray">S<?php echo $i; ?></th>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="bg-dark-gray">S<?php echo $i; ?></th>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="bg-dark-gray">S<?php echo $i; ?></th>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>

                            </tr>
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
                            <tr>
                                <th scope="row" class="bg-dark-gray">S<?php echo $i; ?></th>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="bg-dark-gray">S<?php echo $i; ?></th>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="bg-dark-gray">S<?php echo $i; ?></th>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>
                                <td>R<?php echo $i; ?>C<?php echo $i; ?>S<?php echo $i; ?></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
</div>