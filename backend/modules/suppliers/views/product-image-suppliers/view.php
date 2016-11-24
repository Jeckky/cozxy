<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductImageSuppliers */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Image Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-image-suppliers-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">With buttons</span>
            <div class="panel-heading-controls">
                <?= Html::a('Update', ['update', 'id' => $model->productImageId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->productImageId], [
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
            					'productImageId',
					'productSuppId',
					'title',
					'description:ntext',
					'original_name',
					[
'attribute'=>'image',
'value'=>Yii::$app->homeUrl.$model->image,
'format' => ['image',['width'=>'100','height'=>'100']], 
],
					[
'attribute'=>'imageThumbnail1',
'value'=>Yii::$app->homeUrl.$model->imageThumbnail1,
'format' => ['image',['width'=>'100','height'=>'100']], 
],
					[
'attribute'=>'imageThumbnail2',
'value'=>Yii::$app->homeUrl.$model->imageThumbnail2,
'format' => ['image',['width'=>'100','height'=>'100']], 
],
					'status',
					'createDateTime',
					'updateDateTime',
            ],
            ]) ?>
                    </div>
    </div>

</div>
