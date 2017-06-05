<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPost */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-post-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">With buttons</span>
            <div class="panel-heading-controls">
                <?= Html::a('Update', ['update', 'id' => $model->productPostId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
                <?=
                Html::a('Delete', ['delete', 'id' => $model->productPostId], [
                    'class' => 'btn btn-xs btn-outline btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </div> <!-- / .panel-heading-controls -->
        </div> <!-- / .panel-heading -->
        <div class="panel-body">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'productPostId',
                    'productSuppId',
                    'productSelfId',
                    'brandId',
                    'userId',
                    'title',
                    'shortDescription',
                    'description:ntext',
                    'shopName',
                    'price',
                    'country',
                    'currency',
                    [
                        'attribute' => 'image',
                        'value' => Yii::$app->homeUrl . substr($model->image, 1),
                        'format' => ['image', ['width' => '100', 'height' => '100']],
                    ],
                    'isPublic',
                    'status',
                    'createDateTime',
                    'updateDateTime',
                ],
            ])
            ?>
        </div>
    </div>

</div>
