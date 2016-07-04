<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<?php $this->beginContent('@app/themes/costfit/layouts/main.php'); ?>
<?= $this->render('_modal_login') ?>
<?= $this->render('_header') ?>
<div class="page-content">

    <!--Breadcrumbs-->
    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::$app->homeUrl; ?>">Home</a></li>
        <li><a href="<?php echo Yii::$app->homeUrl . Yii::$app->controller->id; ?>"><?= isset($this->context->subTitle) ? $this->context->subTitle : "subTitle" ?></a></li>
        <li><?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "sub sub Title" ?></li>
    </ol><!--Breadcrumbs Close-->

    <!--Checkout-->
    <?php echo $content; ?>
    <!--Checkout-->
    <!--Brands Carousel Widget-->

    <?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>

</div><!--page-content-->
<?php echo $this->render('_footer'); ?>
<?php $this->registerJs("
", \yii\web\View::POS_END); ?>
<?php $this->endContent(); ?>
