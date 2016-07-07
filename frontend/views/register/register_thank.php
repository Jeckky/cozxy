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

<!--Support-->
<section class="support">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-lg-4 col-md-4">
                    <a class="logo" href="<?php echo $baseUrl; ?>"><img class="col-md-8" src="<?php echo Yii::$app->homeUrl; ?>images/logo/costfit.png" alt="cost.fit"></a>
                    <br><br>
                </div>
            </div>
            <!--Left Column-->
            <div class="col-lg-1 col-md-1">
                &nbsp;
            </div>
            <div class="col-lg-5 col-md-5">
                <h2 class="title">ขอบคุณที่ลงทะเบียนกับ COST.FIT</h2>
                <div class="row space-top">
                    <div class="clo-lg-12 col-md-12 col-sm-12 space-bottom">
                        <h4 class="light-weight uppercase">
                            กรุณากด  <a href="<?php echo Yii::$app->homeUrl; ?>register/confirm?token=1dqibNCP7K"> ลิงค์ เพื่อดู ยืนยันการสมัคร</a>
                        </h4>
                        <p>อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>
                    </div>
                </div>
            </div>

            <!--Sidebar-->
            <div class="col-lg-5 col-lg-offset-1 col-md-5">
                <!--Contact Info-->
                <h3>Contact info</h3>
                <div class="latest-posts">
                    <div class="post">
                        <a href="#">บริษัท ไดอิ กรุ๊ป จำกัด (มหาชน)</a>
                        <div class="cont-info-widget">
                            <ul>
                                <li><i class="fa fa-building"></i> บริษัท ไดอิ กรุ๊ป จำกัด (มหาชน)</li>
                                <li>Daii Group Public Company Limited</li>
                                <li>เลขที่ 1 ชั้น 7 ซอยลาดพร้าว 19 ถนนลาดพร้าว
                                    แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร 10900</li>
                                <!--<li><a href="#"><i class="fa fa-envelope"></i>mail@Limo.com</a></li>-->
                                <li><i class="fa fa-phone"></i>02-938-3464</li>
                                <li><i class="fa fa-mobile"></i>02-938-3463</li>
                                <li><i class="fa fa-support"></i> www.fenzer.biz</li>
                                <li><i class="fa fa-support"></i> www.qsaf.biz</li>
                                <li><i class="fa fa-support"></i> www.atechwindow.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--Support Close-->

