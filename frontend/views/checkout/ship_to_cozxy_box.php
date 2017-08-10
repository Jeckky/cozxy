<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<?=

$this->render('@app/themes/cozxy/layouts/checkout/_ship_to_cozxy_box', [
    'content' => $content
])
?>
