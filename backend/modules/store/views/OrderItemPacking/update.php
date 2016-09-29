<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\OrderItemPacking */

$this->title = 'Update Order Item Packing: ' . $model->orderItemPackingId;
$this->params['breadcrumbs'][] = ['label' => 'Order Item Packings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->orderItemPackingId, 'url' => ['view', 'id' => $model->orderItemPackingId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-item-packing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
