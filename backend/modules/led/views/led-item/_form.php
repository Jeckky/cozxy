<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\LedItem */
/* @var $form yii\widgets\ActiveForm */
//$sort = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];
?>

<div class="led-item-form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><h4><?= $this->title ?></h4></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin();
            foreach ($allColor as $defult) {
                $flag = true;
                foreach ($oldColor as $old) {
                    if ($defult->ledColor == $old) {
                        $flag = false;
                    }
                }
                if ($flag == true) {
                    $showColor = $defult->htmlCode;
//                    if ($defult == 1) {
//                        $showColor = '#00cc66';
//                    } else if ($defult == 2) {
//                        $showColor = '#F00';
//                    } else if ($defult == 3) {
//                        $showColor = '#003eff';
//                    } else if ($defult == 4) {
//                        $showColor = '#ff99ff';
//                    } else if ($defult == 5) {
//                        $showColor = '#ffff00';
//                    }
                    ?>
                    <div  style="background-color: <?= $showColor ?>;height: 50px;width: 300px;"><input type="radio" value="<?= $defult->ledColor ?>" name="color"/></div><br>
                    <?php
                }
            }
            ?>
            <div  style="height: 50px;width: 300px;"><?= $form->field($model, 'sortOrder')->dropDownList($sort) ?></div><br>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
