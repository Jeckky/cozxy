<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductHot */

$this->title = 'Update Product Hot: ' . ' ' . $model->productHotId;
$this->params['breadcrumbs'][] = ['label' => 'Product Hots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->productHotId, 'url' => ['view', 'id' => $model->productHotId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-hot-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
