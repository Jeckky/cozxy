<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Webs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="web-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Web', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'webId',
            'title',
            'company',
            'status',
            'createDateTime',
            // 'updateDateTime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
