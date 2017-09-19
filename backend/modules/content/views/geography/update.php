<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\dbworld\Geography */

$this->title = 'Update Geography: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Geographies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->geographyId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="geography-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
