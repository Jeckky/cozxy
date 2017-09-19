<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\dbworld\District */

$this->title = 'Update District: ' . ' ' . $model->districtId;
$this->params['breadcrumbs'][] = ['label' => 'Districts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->districtId, 'url' => ['view', 'id' => $model->districtId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
$this->params['status'] = 'Update';
?>
<div class="district-update">

    <?=
    $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ])
    ?>

</div>
