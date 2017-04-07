<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPostRating */

$this->title = 'Create Product Post Rating';
$this->params['breadcrumbs'][] = ['label' => 'Product Post Ratings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-post-rating-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
