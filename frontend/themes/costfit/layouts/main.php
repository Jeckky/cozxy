<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode(isset($this->context->getTitleProduct()->attributes['title']) ? $this->context->getTitleProduct()->attributes['title'] . ' : Cost.fit' : "My Cost.fit") ?></title>
        <meta http-equiv="Cache-Control" content="no-store">
        <meta http-equiv="Pragma" content="no-cache">
        <meta name="description" content="<?= Html::encode(isset($this->context->getTitleProduct()->attributes['title']) ? $this->context->getTitleProduct()->attributes['title'] . ' : Cost.fit' : "My Cost.fit") ?>">
        <meta name="KeyWords" content="<?= Html::encode(isset($this->context->getTitleProduct()->attributes['tags']) ? $this->context->getTitleProduct()->attributes['tags'] . ' : Cost.fit' : "My Cost.fit") ?>">
        <meta name="author" content="Cost.fit">
        <meta itemprop="name" content="Cost.fit">
        <meta itemprop="description" content="<?= Html::encode(isset($this->context->getTitleProduct()->attributes['title']) ? $this->context->getTitleProduct()->attributes['title'] . ' : Cost.fit' : "My Cost.fit") ?>">
        <meta itemprop="image" content="<?php echo $baseUrl; ?>/images/ContentGroup/DUHWYsdXVc.png">
        <link rel="image_src" type="image/jpeg" href="<?php echo $baseUrl; ?>/images/ContentGroup/DUHWYsdXVc.png">
        <?php $this->head() ?>
    </head>
    <body class="">
        <?php $this->beginBody() ?>
        <!--Page Content-->
        <?php echo $content; ?>
        <?php $this->endBody() ?>
        <?php
        if (Yii::$app->controller->id == 'site') {
            echo $this->render('@app/views/modal/re_form_member');
        }
        ?>

    </body>
</html>
<?php $this->endPage() ?>
