<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPost */

$this->title = 'Update Product Post: ' . ' ' . $model->productPostId;
$this->params['breadcrumbs'][] = ['label' => 'Product Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->productPostId, 'url' => ['view', 'id' => $model->productPostId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-post-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
