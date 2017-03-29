<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\costfit\TopUp */

$this->title = 'Create Top Up';
$this->params['breadcrumbs'][] = ['label' => 'Top Ups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-up-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
