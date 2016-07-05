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
            <div class="col-lg-12 col-md-12">
                <h2 class="title">ข้อเสนอพิเศษจากพาร์ทเนอร์</h2>
                <div class="row space-top">
                    <?php for ($index = 0; $index <= 15; $index++) {
                        ?>
                        <div class="clo-lg-3 col-md-3 col-sm-3 space-bottom">
                            <img src="<?php echo Yii::$app->homeUrl; ?>images/coupon/Partnership-banners-for-Super-Brands-292x292-6.jpg" alt="a" class="img-responsive">
                        </div>
                        <?php
                        $index = $index++;
                    }
                    ?>
                </div>


            </div>


        </div>
    </div>
</section><!--Support Close-->
