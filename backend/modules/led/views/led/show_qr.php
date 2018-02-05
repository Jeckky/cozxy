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


            <?php foreach ($picking as $code): ?>
                <div class="col-md-4 text-center" style="margin-top: 30px;">
                    <?= $code->code ?><br><?= $code->title ?><br>
                    <?= Html::img("https://chart.googleapis.com/chart?chs=450x450&cht=qr&chl=" . $code->code, ['style' => 'width:7cm;']); ?><br>
                </div>

                <?php
            endforeach;
            ?>

        </div>
    </div>
</div>

