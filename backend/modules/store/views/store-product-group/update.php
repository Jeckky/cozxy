<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\StoreProductGroup */

$this->title = 'Update Store Product Group: ' . ' ' . $model->storeProductGroupId;
$this->params['breadcrumbs'][] = ['label' => 'Store Product Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->storeProductGroupId, 'url' => ['view', 'id' => $model->storeProductGroupId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="store-product-group-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
