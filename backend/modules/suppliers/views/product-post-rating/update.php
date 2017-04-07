<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPostRating */

$this->title = 'Update Product Post Rating: ' . ' ' . $model->productPostRatingId;
$this->params['breadcrumbs'][] = ['label' => 'Product Post Ratings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->productPostRatingId, 'url' => ['view', 'id' => $model->productPostRatingId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-post-rating-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
