<?php
/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

frontend\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111426492-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag()
            {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'UA-111426492-1');
        </script>
        <meta name="google-site-verification" content="kZorTGw6QiPn0skm2DTMrfyD0ra6-FGCepIZTKQI3T8" />
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta name="KeyWords" content="cozxy ,online ,cosmetics">
        <meta name="author" content="cozxy.com">
        <meta itemprop="name" content="cozxy.com">
        <meta name="description" content="Shop luxury items, duty-free products, cosmetics, sunglasses and more online at cozxy.com. See where to get the best prices. Find our opening discounts here!">

        <?php $this->head() ?>
        <link rel="shortcut icon" type="image/png" href="<?= Yii::$app->homeUrl ?>imgs/c_ico.png">
        <!-- Google Tag Manager -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111315034-1"></script>
        <?php
        /* $this->registerJs("
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-99594678-1', 'auto');
          ga('send', 'pageview');
          "); */
        $this->registerJs("
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-111315034-1');
        ");
        $this->registerJs("
                 (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-KB5D282');

         ", \yii\web\View::POS_HEAD);
        ?><!-- End Google Tag Manager -->
    </head>
    <body>
        <?php $this->beginBody() ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KB5D282"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
        <?php
        //if (Yii::$app->controller->id == 'home') {
        echo $this->render('@app/themes/cozxy/layoutsV2/_menu');
        //} else {
        //echo $this->render('_menu');
        //}
        echo $content;
        //echo $this->render('_footer')
        echo $this->render('@app/themes/cozxy/layoutsV2/_footer');
        ?>
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
