<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\dbworld\Cities */

$this->title = 'Update Cities: ' . ' ' . $model->cityId;
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cityId, 'url' => ['view', 'id' => $model->cityId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
$this->params['status'] = 'Update';
?>
<div class="cities-update">

    <?=
    $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ])
    ?>

</div>
