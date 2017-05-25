<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductGroupTemplate */

$this->title = 'Update Product Group Template: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Group Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->productGroupTemplateId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-group-template-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
