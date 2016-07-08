<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/daiibuy/assets');
?>
<?php $this->beginContent('@app/themes/daiibuy/layouts/main.php'); ?>

<?php echo $this->render('_section_menu_navbar'); ?>

<?php echo $this->render('_section_main_menu'); ?>
<div id="main-wrapper">
    <div id="content-wrapper">
        <ul class="breadcrumb breadcrumb-page">
            <div class="breadcrumb-label text-light-gray">You are here: </div>
            <li><a href="#">Home</a></li>
            <li class="active"><a href="#"><?php echo $this->title; ?></a></li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>
<div id="main-menu-bg"></div>
<?php $this->endContent(); ?>
