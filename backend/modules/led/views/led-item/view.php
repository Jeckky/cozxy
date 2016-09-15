<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\LedItem */

$this->title = $model->ledItemId;
$this->params['breadcrumbs'][] = ['label' => 'Led Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="led-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ledItemId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ledItemId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ledItemId',
            'ledId',
            'color',
            'sortOrder',
            'status',
            'createDateTime',
            'updateDateTime',
        ],
    ]) ?>

</div>
