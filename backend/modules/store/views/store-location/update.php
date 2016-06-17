<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\StoreLocation */

$this->title = 'Update Store Location: ' . ' ' . $model->storeLocationId;
$this->params['breadcrumbs'][] = ['label' => 'Store Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->storeLocationId, 'url' => ['view', 'id' => $model->storeLocationId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="store-location-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
