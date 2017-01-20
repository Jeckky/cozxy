<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'กรุณาตรวจสอบความถูกต้อง';
$this->params['breadcrumbs'][] = $this->title;
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="receive-index">
    <?php $form = ActiveForm::begin(['action' => 'receive/send-sms']); ?>
    <div class="col-md-12"> <h2 class="text-center"><strong><?= Html::encode($this->title) ?></strong></h2></div>
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4 text-center">
            <h3>คุณ <?= $user->firstname . " " . $user->lastname ?></h3>
        </div>
        <div class="col-md-4"></div>

    </div>
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4 text-center">
            <h3>Email : <?= $user->email ?></h3>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4 text-center">
            <h3>เบอร์โทรศัพท์ : <?= $tel ?></h3>
        </div>
        <div class="col-md-4"></div>
        <input type="hidden" name="tel" value="<?= $tel ?>">
    </div><br>
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4 text-center">
            <?=
            Html::submitButton('รับรหัสผ่านทาง SMS (ไม่มีค่าบริการ)', ['class' => 'btn btn-primary btn-lg',
                'style' => 'width:100%;'])
            ?>
        </div>
        <div class="col-md-4"></div>

    </div>
    <input type="hidden" name="orderId" value="<?= $orderId ?>">
    <?php ActiveForm::end(); ?>
</div><br><br>
