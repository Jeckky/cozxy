<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Terms and conditions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper-cozxy">
    <?=
    $this->render('@app/themes/cozxy/layouts/terms-and-conditions/_terms_and_conditions', [
        'content' => $content
            ]
    )
    ?>
</div>


