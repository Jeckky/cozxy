<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Verification Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('@app/themes/cozxy/layouts/register/_verification', compact('model', 'data')) ?>

