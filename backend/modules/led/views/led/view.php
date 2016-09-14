<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Led */

$this->title = $model->ledId;
$this->params['breadcrumbs'][] = ['label' => 'Leds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="led-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ledId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ledId], [
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
            'ledId',
            'code',
            'ip',
            'shelf',
            'status',
            'createDateTime',
            'updateDateTime',
        ],
    ]) ?>

</div>
