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
            <h3>โทร : <?= !empty($tel) ? $tel : 'ไม่ได้ระบุ' ?></h3>
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
    <?php if (!empty($tel)): ?>
        <div class="row">
            <div class="col-md-4"> </div>
            <div class="col-md-4 text-center">
                <?= Html::a('รับรหัสผ่านทาง SMS', $baseUrl . '/receive/send-sms', ['class' => 'btn btn-primary btn-lg col-md-12']) ?>
            </div>
            <div class="col-md-4"></div>

        </div>
    <?php endif; ?>
    <br>
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4 text-center">
            <?= Html::a('รับรหัสผ่านทาง Email', $baseUrl . '/receive/send-email', ['class' => 'btn btn-warning btn-lg col-md-12']) ?>
        </div>
        <div class="col-md-4"></div>

    </div>
</div><br><br>
