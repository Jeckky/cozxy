<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPromotion */

$this->title = 'Update Product Promotion: ' . ' ' . $model->productPromotionId;
$this->params['breadcrumbs'][] = ['label' => 'Product Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->productPromotionId, 'url' => ['view', 'id' => $model->productPromotionId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-promotion-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
