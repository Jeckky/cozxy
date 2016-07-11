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
                    <!--Post-->
                    <div class="post">

                        <?php echo $content; ?>

                    </div> <!--Post-->
                </div>
            </div>
        </div>
    </section><!--Blog Sidebar Left Close-->

</div>
<?php echo $this->render('_footer'); ?>
<?php $this->registerJs("
", \yii\web\View::POS_END); ?>
<?php $this->endContent(); ?>
