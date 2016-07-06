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
<!--Blog Sidebar Left-->
<section class="blog">
    <div class="container">
        <div class="row">
            <!--Sidebar-->
            <div class="col-lg-3 col-md-3">
                <div class="latest-posts">
                    <div class="post" style="border-bottom: 1px #f5f5f5 solid;">
                        <a href="#">My Profile</a>
                    </div>
                    <div class="post" style="border-bottom: 1px #f5f5f5 solid;">
                        <a href="#">Order History</a>
                    </div>
                    <div class="post" style="border-bottom: 1px #f5f5f5 solid;">
                        <a href="#">Address Book</a>
                    </div>
                    <div class="post" style="border-bottom: 1px #f5f5f5 solid;">
                        <a href="#">Payment Methods</a>
                    </div>
                    <div class="post" style="border-bottom: 1px #f5f5f5 solid;">
                        <a href="#">Log Out</a>
                    </div>
                </div>
            </div>
            <!--Left Column-->
            <div class="col-lg-9 col-md-9">
                <h2 class="title">My Profile</h2>
                <!--Post-->
                <div class="post">
                    <h3 class="title"><a href="#">New awesome theme from 8Guild team</a></h3>

                    <p class="p-style3">Limo is the product which was born thanks to the involvement not only of the UI experts but also great marketers who have tremendous experience in outstanding implementations of e-commerce projects from different domains....</p>

                </div> <!--Post-->
            </div>
        </div>
    </div>
</section><!--Blog Sidebar Left Close-->

