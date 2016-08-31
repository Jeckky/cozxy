<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Breadcrumbs-->
<ol class="breadcrumb">
    <li><a href="<?php echo Yii::$app->homeUrl; ?>">Home</a></li>
    <li><a href="<?php echo Yii::$app->homeUrl . Yii::$app->controller->id; ?>"><?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "Delivery" ?></a></li>
</ol><!--Breadcrumbs Close-->

<!--Support-->
<section class="tracking">
    <div class="container">
        <div class="row" style="text-align: center;">
            <h2 class="title">Cost.fit ได้รับข้อความจากคุณแล้ว </h2>
            <div class="row space-top">
                <div class="clo-lg-12 col-md-12 col-sm-12 space-bottom">

                    <h4> กรุณารอ Email ตอบกลับจากทางเรา</h4>

                </div>

            </div>
        </div>
    </div>
</section><!--Support Close-->
