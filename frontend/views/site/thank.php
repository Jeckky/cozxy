<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Thank';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('@app/themes/cozxy/layouts/thank/_thank', compact('modelUser')) ?>

