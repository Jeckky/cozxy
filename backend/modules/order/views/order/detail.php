
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h2>Hello world</h2>',
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'cityModal',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'tabindex' => '-1']
]);
?>
<div id="modalContent">test</div>
<?php
Modal::end();
$this->registerJs("$(window).load(function () {
        $('.modal').modal('show');
    })");
?>
