<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'กรุณาใส่รหัสที่ได้รับทาง SMS ';
$this->params['breadcrumbs'][] = $this->title;
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="receive-index">
    <?php $form = ActiveForm::begin(['action' => 'received']); ?>
    <div class="col-md-12"> <h2 class="text-center"><strong><?= Html::encode($this->title) ?></strong></h2>
        <h3 class="text-center"> รหัสของคุณจะมีอายุการใช้งาน 5 นาที</h3>
    </div>
    <div class="col-md-12">
        <h4 class="text-center refNo"> Ref No : <?= $refNo ?></h4>
    </div>
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4 text-center">
            <input type="text" name="otp" style="height: 50px;width: 100%" placeholder=" รหัสผ่านที่ได้รับทาง SMS" required="required" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10"/>
            <input type="hidden" name="refNo" value="<?= $refNo ?>">

        </div>
        <div class="col-md-4"></div>

    </div><br>
    <?php if (isset($ms) && $ms != '') { ?>
        <div class="row">
            <div class="col-md-4"> </div>
            <div class="col-md-4 text-center">
                <h3><code><?= $ms ?></code></h3>
            </div>
            <div class="col-md-4"></div>

        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4 text-center">
            <?=
            Html::submitButton('ยืนยัน', ['class' => 'btn btn-primary btn-lg',
                'style' => 'width:100%;'])
            ?>
        </div>
        <div class="col-md-4"></div>


    </div><br>

    <input type="hidden" name="tel" id="tel" value="<?= $tel ?>">
    <input type="hidden" name="orderId" id="orderId" value="<?= $orderId ?>">
    <input type="hidden" name="userId" id="userId" value="<?= $userId ?>">
    <input type="hidden" name="password" id="password" value="<?= $password ?>">
    <?php ActiveForm::end(); ?>
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4 text-center">
            <button class ="btn btn-warning btn-lg" id="resetOtp" style="width:100%;color:#000">รีเซ็ทรหัสผ่าน</button>
        </div>
        <div class="col-md-4"></div>
    </div>
</div><br><br>
