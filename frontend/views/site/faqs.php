<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Faqs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper-cozxy">
    <?=
    $this->render('@app/themes/cozxy/layouts/faqs/_faqs', [
        'content' => $content
    ])
    ?>
</div>


