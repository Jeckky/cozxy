<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\dbworld\Countries */

$this->title = 'Update Countries: ' . ' ' . $model->countryId;
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->countryId, 'url' => ['view', 'id' => $model->countryId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="countries-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
