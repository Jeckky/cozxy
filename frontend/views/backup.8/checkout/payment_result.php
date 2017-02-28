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
                    <a class="logo" href="<?php echo $baseUrl; ?>"><img class="col-md-8" src="<?php echo Yii::$app->homeUrl; ?>images/logo/costfit.png" alt="Cozxy.com"></a>
                    <br><br>
                </div>
            </div>
            <!--Left Column-->
            <div class="col-lg-1 col-md-1">
                &nbsp;
            </div>
            <div class="col-lg-5 col-md-5">
                <?php if ($res['status'] == 1): ?>
                    <h2 class="title">Cozxy.com - ชำระเงินค้าสินค้าเสร็จสมบูรณ์ </h2>
                <?php elseif ($res['status'] == 2): ?>
                    <h2 class="title"  style="color:orange">Cozxy.com - การชำระเงินไม่สมบูรณ์รอพิจารณาและติดต่อจาก Cozxy.com </h2>
                <?php else: ?>
                    <h2 class="title" style="color:red">Cozxy.com - ชำระเงินค้าสินค้าไม่สำเร็จ </h2>
                <?php endif; ?>
                <div class="row space-top">
                    <div class="clo-lg-12 col-md-12 col-sm-12 space-bottom">
                        <?php if ($res['status'] == 1): ?>
                            <h4 class="light-weight uppercase">
                                หมายเลขใบเสร็จรับเงินของท่านคือ  <a href="<?= Yii::$app->homeUrl . "profile/order" ?>"><?= isset($res['invoiceNo']) ? $res['invoiceNo'] : "-" ?></a>
                            </h4>
                        <?php else: ?>
                            <h4 class="light-weight uppercase">
                                <?= $res["message"]; ?>
                            </h4>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                <a href="<?= Yii::$app->homeUrl ?>" class="btn btn-primary">ไปเลือกซื้อสินค้าต่อ</a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                <a href="<?= Yii::$app->homeUrl . "profile/order" ?>" class="btn btn-warning">ดูรายการสั่งซื้อสินค้า</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Sidebar-->
            <div class="col-lg-5 col-lg-offset-1 col-md-5">
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

