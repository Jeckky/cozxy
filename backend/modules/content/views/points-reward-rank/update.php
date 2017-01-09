<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\PointsRewardRank */

$this->title = 'Update Points Reward Rank: ' . ' ' . $model->rankId;
$this->params['breadcrumbs'][] = ['label' => 'Points Reward Ranks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rankId, 'url' => ['view', 'id' => $model->rankId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="points-reward-rank-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
