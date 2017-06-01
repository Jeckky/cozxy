<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <?php
        $this->registerJs("
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

               ga('create', 'UA-99594678-1', 'auto');
                ga('send', 'pageview');
             ");
        ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?= $this->render('_menu') ?> 
        <?= $content ?>

        <?= $this->render('_footer') ?>

        <?php $this->endBody() ?>
<!--        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw" async-->
        <!--        defer></script>-->
    </body>
</html>
<?php $this->endPage() ?>
