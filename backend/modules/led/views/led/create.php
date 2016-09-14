<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Led */

$this->title = 'Create Led';
$this->params['breadcrumbs'][] = ['label' => 'Leds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="led-create">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
