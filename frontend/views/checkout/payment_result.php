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

            <!--Left Column-->
            <div class="col-lg-1 col-md-1">
                &nbsp;
            </div>
            <div class="col-lg-5 col-md-5">
                <?php if ($res['status'] == 1): ?>
                    <h2 class="title">Cozxy.com - Payment is complete. </h2>
                <?php elseif ($res['status'] == 2): ?>
                    <h2 class="title"  style="color:orange">Cozxy.com - Payments are not complete, wait for a review and contact from Cozxy.com </h2>
                <?php else: ?>
                    <h2 class="title" style="color:red">Cozxy.com - Payment failed.</h2>
                <?php endif; ?>
                <div class="row space-top">
                    <div class="clo-lg-12 col-md-12 col-sm-12 space-bottom">
                        <?php if ($res['status'] == 1): ?>
                            <h4 class="light-weight uppercase">
                                Your Cozxy.com Order  <a href="<?= Yii::$app->homeUrl . "profile/order" ?>"><?= isset($res['invoiceNo']) ? $res['invoiceNo'] : "-" ?></a>
                            </h4>
                        <?php else: ?>
                            <h4 class="light-weight uppercase">
                                <?= $res["message"]; ?>
                            </h4>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                <a href="<?= Yii::$app->homeUrl ?>" class="btn btn-primary">Go shopping</a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                <a href="<?= Yii::$app->homeUrl . "profile/order" ?>" class="btn btn-warning">View order list</a>
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
                                <li><i class="fa fa-building"></i>Cozxy Dot Com Co.,Ltd.</li>
                                <li><i class="fa fa-building"></i>5 Soi Ram Intra 5 Yeak 4, Anusawari, Bang Ken,Bangkok 10220 </li>
                                <li><a href="#"><i class="fa fa-envelope"></i>info@cozxy.com</a></li>
                                <li><i class="fa fa-phone"></i> 064-184-7414 | 9.00-18.00</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--Support Close-->

