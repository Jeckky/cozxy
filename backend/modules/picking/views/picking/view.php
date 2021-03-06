<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\PickingPoint */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Picking Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picking-point-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pickingId, 'receive' => $receiveType], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->pickingId, 'receive' => $receiveType], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
        <?= Html::a('Back', ['index', 'pickingId' => $model->pickingId, 'receive' => $receiveType], ['class' => 'btn btn-warning']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pickingId',
            'title',
            'description',
            'countryId',
            'provinceId',
            'amphurId',
            'status',
            'type',
            'createDateTime',
            'updateDateTime',
        ],
    ])
    ?>

</div>
