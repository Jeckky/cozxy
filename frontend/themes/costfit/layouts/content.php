<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
?>
<?php
$this->beginContent('@app/themes/costfit/layouts/main.php');
$logo = common\helpers\Content::ContentLogo('logoImageTop');
?>
<?= $this->render('_modal_login') ?>
<?= $this->render('_header', compact('logo')) ?>
<div class="page-content">
    <?php echo $content; ?>
</div>
<?php
$logoImage = common\helpers\Content::ContentLogo('logoImage');
$news = common\helpers\Content::ContentLogo('NEWS');
$footerContact = common\helpers\Content::ContentLogo('contactFooter');
echo $this->render('_footer', compact('logoImage', 'news', 'footerContact'));
?>
<?php $this->registerJs("
", \yii\web\View::POS_END); ?>
<?php $this->endContent(); ?>
