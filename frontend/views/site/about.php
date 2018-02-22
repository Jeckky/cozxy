<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper-cozxy">
    <?=
    $this->render('@app/themes/cozxy/layouts/about/_about', [
        'content' => $content
    ])
    ?>
</div>


