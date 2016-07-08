<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use backend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */
$this->title = 'Cost.Fit Admin';
AppAsset::register($this);
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8" lang="<?= Yii::$app->language ?>"> <![endif]-->
<!--[if IE 9]> <html class="ie9 gt-ie8" lang="<?= Yii::$app->language ?>"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie" lang="<?= Yii::$app->language ?>"> <!--<![endif]-->
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

        <!-- Open Sans font from Google CDN -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

        <meta name="description" content="">
        <meta name="author" content="">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

    </head>
    <body class="theme-default main-menu-animated">

        <script>var init = [];</script>
        <!-- Demo script --> <script src="<?php echo $directoryAsset; ?>/demo/demo.js"></script> <!-- / Demo script -->

        <?php $this->beginBody() ?>
        <?php echo $content; ?>

        <?php $this->endBody() ?>
        <!-- Get jQuery from Google CDN -->
        <!--[if !IE]>
                <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
        -->
        <!-- <![endif]-->
        <!--[if lte IE 9]>
                <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
        <![endif]-->

    </body>
</html>
<?php $this->registerJs("
            init.push(function () {
                // Javascript code here
            })
            window.PixelAdmin.start(init);

", \yii\web\View::POS_END); ?>
<?php $this->endPage() ?>
