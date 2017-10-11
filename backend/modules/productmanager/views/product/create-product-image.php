<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\Product */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
    <div class="row">
        <div class="col-md-4">
            <?= $this->render('_image_form', ['productId' => $productId]) ?>
            <hr>
            <?php if($model->parentId === NULL): ?>
                <?= Html::a('Next', \yii\helpers\Url::to(['create-product-option', 'id' => $productId]), ['class' => 'btn btn-primary btn-block']) ?>
            <?php else: ?>
                <?= Html::a('Back', \yii\helpers\Url::to(['view', 'id' => $model->parentId]), ['class' => 'btn btn-primary btn-block']) ?>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <?= $this->render('_image_grid', ['productId' => $productId]) ?>
        </div>
    </div>

</div>
