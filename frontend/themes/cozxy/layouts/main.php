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
        <meta name="KeyWords" content="">
        <meta name="author" content="cozxy.com">
        <meta itemprop="name" content="cozxy.com">
        <meta itemprop="description" content="Shop luxury items, duty-free products, cosmetics, sunglasses and more online at cozxy.com. See where to get the best prices. Find our opening discounts here!">
        <?php $this->head() ?>
        <link rel="shortcut icon" type="image/png" href="<?= Yii::$app->homeUrl ?>imgs/c_ico.png">
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
<?php
$this->registerJs("
<!-- Hotjar Tracking Code for www.cozxy.com -->
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:565530,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');

", \yii\web\View::POS_END);
?>
<?php $this->endPage() ?>
