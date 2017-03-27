<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\TopUp */

$this->title = $model->topUpId;
$this->params['breadcrumbs'][] = ['label' => 'Top Ups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-up-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->topUpId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->topUpId], [
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
            'topUpId',
            'userId',
            'money',
            'point',
            'status',
            'createDateTime',
            'updateDateTime',
        ],
    ]) ?>

</div>
