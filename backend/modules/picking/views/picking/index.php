<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Picking Points';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picking-point-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Picking Point', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'pickingId',
            'title',
            'description',
            'countryId',
            'provinceId',
            'amphurId',
            // 'status',
            // 'type',
            // 'createDateTime',
            // 'updateDateTime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
