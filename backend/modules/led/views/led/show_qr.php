<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Led */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="led-form">
    <div class="panel panel-default">
        <div class="row">

            <?php foreach ($qr as $code): ?>
                <div class="col-md-3 text-center" style="margin-top: 30px;">
                    <?= Html::img("https://chart.googleapis.com/chart?chs=450x450&cht=qr&chl=" . $code, ['style' => 'width:3cm;']); ?><br>
                    <?= $code ?>
                </div>

                <?php
            endforeach;
            ?>

        </div>
    </div>
</div>

