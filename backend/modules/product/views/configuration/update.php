<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Configuration */

$this->title = 'Update Configuration: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Configurations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->configurationId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="configuration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
