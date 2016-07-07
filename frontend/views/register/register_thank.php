<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Breadcrumbs-->
<ol class="breadcrumb">
    <li><a href="<?php echo Yii::$app->homeUrl; ?>"><?= isset($this->context->subTitle) ? $this->context->subTitle : "sub Title" ?></a></li>
    <li><a href="<?php echo Yii::$app->homeUrl . Yii::$app->controller->id; ?>"><?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "sub sub Title" ?></a></li>
</ol><!--Breadcrumbs Close-->

<!--Content-->
<div class="coming-soon">
    <section class="container">
        <div class="col-md-3">&nbsp;</div>
        <div class="col-md-6 text-center">
            <div class="col-md-12" style="padding: 5px;">
                <br>
                <a class="logo" href="<?php echo $baseUrl; ?>"><img class="col-md-8" src="<?php echo Yii::$app->homeUrl; ?>images/logo/costfit.png" alt="cost.fit"></a>
                <br>
            </div>
            <div class="post">
                <p class="p-style3">
                    ขอบคุณที่ลงทะเบียนกับ COST.FIT
                    <br>
                    กรุณากด  <a href="<?php echo Yii::$app->homeUrl; ?>register/confirm?token=1dqibNCP7K"> ลิงค์ เพื่อดู ยืนยันการสมัคร</a>
                    <br>
                    อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ
                    <br><br>
                    บริษัท ไดอิ กรุ๊ป จำกัด (มหาชน)<br>
                    Daii Group Public Company Limited<br>
                    เลขที่ 1 ชั้น 7 ซอยลาดพร้าว 19 ถนนลาดพร้าว<br>
                    แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร 10900<br><br>
                </p>
                <p class="p-style3">
                    <a href="#"><i class="fa fa-envelope"></i> support@Limo.com</a><br>
                    <i class="fa fa-phone"></i> 02-938-3464<br>
                    <i class="fa fa-mobile"></i> 02-938-3463<br>
                    <i class="fa fa-mobile"></i> <a href="#">www.fenzer.biz</a>, <a href="#">www.qsaf.biz</a>, <a href="#">www.atechwindow.com</a>
                </p>

            </div>
        </div>
        <div class="col-md-3">&nbsp;</div>
    </section>
</div><!--Content Close-->
