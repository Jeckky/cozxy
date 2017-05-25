<?php

use yii\helpers\Html;

$this->title = 'Invalid Step';
?>
<div class = "panel panel-default">
    <div class = "panel-heading" style = "background-color: #000;vertical-align: middle;">
        <span class = "panel-title"><h3 style = "color:#ffcc00;"><?= $this->title ?></h3></span>
    </div>

    <div class="panel-body text-center">
        <?php
        echo Html::tag('h1', $this->title);
        echo Html::tag('div', strtr('An invalid step ({step}) was detected.', [
            '{step}' => $event->step
        ]));
        echo "<br>" . Html::a('Choose Another Demo', ["create-wizard"], ['class' => 'btn btn-danger']);
        ?>
    </div>
</div>

