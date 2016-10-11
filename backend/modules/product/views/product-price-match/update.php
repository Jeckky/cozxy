<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPriceMatch */

$this->title = 'Update Product Price Match: ' . ' ' . $model->productPriceMatchId;
$this->params['breadcrumbs'][] = ['label' => 'Product Price Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->productPriceMatchId, 'url' => ['view', 'id' => $model->productPriceMatchId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-price-match-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
