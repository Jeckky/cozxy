<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'กรุณากรอกรหัสที่ได้รับทาง SMS หรือ Email';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receive-index">

    <div class="col-md-12"> <h1 class="text-center"><strong><?= Html::encode($this->title) ?></strong></h1></div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?=
            $form->field($model, 'password')->textInput(['maxlength' => true,
                'autofocus' => true,
                'placeholder' => "ข้อความทาง SMS หรือ Email"
            ])->label('')
            ?>
        </div>
        <div class="col-md-4"> </div>
    </div>
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4 text-center">
            <?= Html::submitButton('ยืนยัน', ['class' => 'btn btn-primary btn-lg col-md-12']) ?>
        </div>
        <div class="col-md-4"></div>

    </div>

    <?php ActiveForm::end(); ?>
</div><br><br>
