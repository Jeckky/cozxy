<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$logoImage = common\helpers\Content::ContentLogo('logoImage');
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
                    <a class="logo" href="<?= Yii::$app->homeUrl ?>"><img src="<?php echo $baseUrl . $logoImage->image; ?>" alt="Cozxy" class="img-responsive" style="width: 50%;"/></a>
                    <br>
                </div>
            </div>
            <!--Left Column-->
            <div class="col-lg-1 col-md-1">
                &nbsp;
            </div>
            <div class="col-lg-6 col-md-6">
                <h2 class="title">Thank your for joining us at Cozxy.com </h2>
                <div class="row space-top">
                    <div class="clo-lg-12 col-md-12 col-sm-12 space-bottom">
                        <h4 class="light-weight uppercase">
                            <!--กรุณากด  <a href="<?php echo Yii::$app->homeUrl; ?>register/confirm?token=1dqibNCP7K"> ลิงค์ เพื่อดู ยืนยันการสมัคร</a>-->

                            <?php
                            //echo $_GET['status'];
                            if (isset($_GET['status'])) {
                                if ($_GET['status'] == 1) {
                                    echo '<span style="color: red">Email is already in the system </span> please again ';
                                } else if ($_GET['status'] == 2) {
                                    echo '<span style="color: red">Email is already in the system </span> please again ';
                                } else if ($_GET['status'] == 3) {
                                    echo ' Please check your email to confirm your registration.';
                                } else {
                                    echo ' Please check your email to confirm your registration.';
                                }
                            } else {
                                echo ' Please check your email to confirm your registration.';
                            }
                            ?>
                        </h4>
                        <p><!--อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ--></p>
                    </div>
                </div>
            </div>

            <!--Sidebar-->
            <div class="col-lg-4 col-lg-offset-1 col-md-4">
                <!--Contact Info-->
                <h3>Contact info</h3>
                <div class="latest-posts">
                    <div class="post">
                        <div class="cont-info-widget">
                            <ul>
                                <li><i class="fa fa-building"></i>บริษัท​ คอ​ซซี่​ ดอทคอม​ จํากัด​</li>
                                <li><i class="fa fa-building"></i>เลขที่ 5 ซอยรามอินทรา 5 แยก 4 แขวงอนุสวรีย์ เขตบางเขน กทม. 10220</li>
                                <li><a href="#"><i class="fa fa-envelope"></i>online@cozxy.com</a></li>
                                <li><i class="fa fa-phone"></i></li>
                                <li><i class="fa fa-mobile"></i></li>
                                <li><i class="fa fa-support"></i> </li>
                                <li><i class="fa fa-support"></i> </li>
                                <li><i class="fa fa-support"></i> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--Support Close-->

