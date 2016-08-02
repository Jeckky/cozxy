<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Web */

$this->title = 'Update Web: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Webs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->webId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="web-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
