<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPostRating */

$this->title = $model->productPostRatingId;
$this->params['breadcrumbs'][] = ['label' => 'Product Post Ratings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-post-rating-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">With buttons</span>
            <div class="panel-heading-controls">
                <?= Html::a('Update', ['update', 'id' => $model->productPostRatingId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->productPostRatingId], [
                'class' => 'btn btn-xs btn-outline btn-danger',
                'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
                ],
                ]) ?>
            </div> <!-- / .panel-heading-controls -->
        </div> <!-- / .panel-heading -->
        <div class="panel-body">
            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
            					'productPostRatingId',
					'productPostId',
					'userId',
					'score',
					'status',
					'createDateTime',
					'updateDateTime',
            ],
            ]) ?>
                    </div>
    </div>

</div>
