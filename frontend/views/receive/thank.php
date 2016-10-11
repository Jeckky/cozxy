<?php

use yii\helpers\Html;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<meta http-equiv="refresh" content="60;url=<?= $baseUrl . '/receive' ?>">
<div class="text-center">
    <h2>หมายเลขตู้ของคุณคือ </h2>
</div>
<div class="text-center">
    <h2><?= $locker ?></h2>
</div>
<div class="text-center"><h2>ขอบคุณที่ใช้บริการ COZXY.COM</h2>
</div>
<div class="row">
    <div class="col-md-4"> </div>
    <div class="col-md-4 text-center">
        <?=
        Html::a('<i class="fa fa-home" aria-hidden="true"> กลับสู่หน้าหลัก </i>', $baseUrl . '/receive', ['class' => 'btn btn-danger btn-lg',
            'style' => 'width:100%;'])
        ?>
    </div>
    <div class="col-md-4"></div>

</div><br><br>
