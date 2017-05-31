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
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode(isset($this->context->title) ? $this->context->title : "My Cozxy.com") ?></title>
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
