<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\web\View;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
if (Yii::$app->controller->id == 'products') {
    $title = isset($this->params['listDataProvider']['tagMeta']) ? $this->params['listDataProvider']['tagMeta']->title : 'COZXY.COM LOWEST PRICE PRODUCTS';
    $keyWords = isset($this->params['listDataProvider']['tagMeta']) ? $this->params['listDataProvider']['tagMeta']->tags : 'COZXY.COM LOWEST PRICE PRODUCTS';
    $description = isset($this->params['listDataProvider']['tagMeta']) ? $this->params['listDataProvider']['tagMeta']->title : 'COZXY.COM LOWEST PRICE PRODUCTS';
} else {
    $title = '';
    $keyWords = '';
    $description = '';
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode(isset($title) ? $title : 'COZXY.COM LOWEST PRICE PRODUCTS') ?></title>
        <meta http-equiv="Cache-Control" content="no-store">
        <meta http-equiv="Pragma" content="no-cache">
        <meta name="KeyWords" content="<?= Html::encode(isset($keyWords) ? $keyWords : 'COZXY.COM LOWEST PRICE PRODUCTS') ?>">
        <meta name="author" content="cozxy.com">
        <meta itemprop="name" content="cozxy.com">
        <meta itemprop="description" content="<?= Html::encode(isset($description) ? $description : 'COZXY.COM LOWEST PRICE PRODUCTS') ?>">
        <meta itemprop="image" content="<?php echo $baseUrl; ?>/images/ContentGroup/TwpF5Rm9-d.png">
        <link rel="image_src" type="image/jpeg" href="<?php echo $baseUrl; ?>/images/ContentGroup/TwpF5Rm9-d.png">
        <meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
        <meta http-equiv="PRAGMA" content="NO-CACHE">
        <meta http-equiv="imagetoolbar" content="on">
        <meta name="robots" content="index,follow">
        <meta name="googlebot" content="index,follow">
        <meta name="revisit-after" content="1 days">
        <meta name="distribution" content="global">
        <meta name="rating" content="general">
        <meta name="content-Language" content="th">
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
