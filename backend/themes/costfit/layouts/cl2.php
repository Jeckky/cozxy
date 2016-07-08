<?php

//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<?php $this->beginContent('@app/themes/daiibuy/layouts/main.php'); ?>

<?php // echo $this->render('_section_slider'); ?>

<?php // echo $this->render('_section_title'); ?>

<?php echo $content; ?>

<?php //echo $this->render('_section_footer'); ?>

<?php $this->endContent(); ?>
