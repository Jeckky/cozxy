<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

?>
<?php $this->beginContent('@app/themes/costfit/layouts/main.php'); ?>
<?=$this->render('_modal_login')?>
<?=$this->render('_header')?>
<div class="page-content">
    <?php echo $content; ?>
</div>
<?php $this->registerJs("
", \yii\web\View::POS_END); ?>
<?php $this->endContent(); ?>
