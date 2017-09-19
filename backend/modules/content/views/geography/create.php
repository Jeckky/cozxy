<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\dbworld\Geography */

$this->title = 'Create Geography';
$this->params['breadcrumbs'][] = ['label' => 'Geographies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="geography-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
